<?php

namespace App\Http\Controllers\Backend;

use App\Models\Result;
use App\Models\CeeSession;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;

class CeeExamSessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("admin.exam-session.cee-exam-session");
    }

    public function getData(Request $request)
    {

        if (!$request->hasHeader('X-Requested-With') || $request->header('X-Requested-With') !== 'XMLHttpRequest') {
            return response()->json(['error' => 'Invalid request'], 400);
        }
        $data = DB::table('cee_sessions')
            ->leftJoin('reservations', 'cee_sessions.id', '=', 'reservations.cee_session_id')
            ->select(
                'cee_sessions.id',
                'cee_sessions.name',
                'cee_sessions.status',
                'cee_sessions.created_at',
                DB::raw('COUNT(reservations.id) as reservation_count') // Count reservation IDs
            )
            ->groupBy(
                'cee_sessions.id',
                'cee_sessions.name',
                'cee_sessions.status',
                'cee_sessions.created_at'
            );


        return DataTables::of($data)
            ->addIndexColumn()
            ->filter(function ($query) use ($request) {
                if ($request->has('search')) {
                    $searchValue = $request->get('search')['value'];
                    $query->where('cee_sessions.id', 'like', "%{$searchValue}%") // Use original column name
                        ->orWhere('cee_sessions.name', 'like', "%{$searchValue}%") // Use original column name
                        ->orWhere('cee_sessions.status', 'like', "%{$searchValue}%"); // Use original column name
                }
            })
            ->addColumn('status', function ($query) {
                if ($query->status == 'active') {
                    $id = $query->id;
                    $switchId = 'greenDefaultSwitch_' . $id;

                    return '<div class="flex items-center justify-center">
                        <div class="relative inline-block w-10 align-middle transition duration-200 ease-in">
                            <input type="checkbox"
                                   data-id="' . $id . '"
                                   name="greenDefaultSwitch"
                                   id="' . $switchId . '"
                                   class="absolute block transition duration-300 ease-linear border-2 rounded-full appearance-none cursor-pointer change-status size-5 border-slate-200 dark:border-zink-500 bg-white/80 dark:bg-zink-400 peer/published checked:bg-white dark:checked:bg-white ltr:checked:right-0 rtl:checked:left-0 checked:border-green-500 dark:checked:border-green-500 arrow-none"
                                   checked>
                            <label for="' . $switchId . '"
                                   class="block h-5 overflow-hidden duration-300 ease-linear border rounded-full cursor-pointer border-slate-200 dark:border-zink-500 bg-slate-200 dark:bg-zink-600 peer-checked/published:bg-green-500 peer-checked/published:border-green-500"></label>
                        </div>
                    </div>';
                } else {
                    $id = $query->id;
                    $switchId = 'greenDefaultSwitch_' . $id;

                    return '<div class="flex items-center justify-center">
                        <div class="relative inline-block w-10 align-middle transition duration-200 ease-in">
                            <input type="checkbox"
                                   data-id="' . $id . '"
                                   name="greenDefaultSwitch"
                                   id="' . $switchId . '"
                                   class="absolute block transition duration-300 ease-linear border-2 rounded-full appearance-none cursor-pointer change-status size-5 border-slate-200 dark:border-zink-500 bg-white/80 dark:bg-zink-400 peer/published checked:bg-white dark:checked:bg-white ltr:checked:right-0 rtl:checked:left-0 checked:border-green-500 dark:checked:border-green-500 arrow-none">
                            <label for="' . $switchId . '"
                                   class="block h-5 overflow-hidden duration-300 ease-linear border rounded-full cursor-pointer border-slate-200 dark:border-zink-500 bg-slate-200 dark:bg-zink-600 peer-checked/published:bg-green-500 peer-checked/published:border-green-500"></label>
                        </div>
                    </div>';
                }

            })
            ->addColumn('created_at', function ($row) {
                return Carbon::parse($row->created_at)->format('F j, Y');
            })
            ->addColumn('action', function ($row) {
                return '<div class="flex gap-3">
                            <a href=' . route('admin.cee.exam-session.view-results.index', $row->id) . ' class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md view-detail size-8 bg-slate-100 text-slate-500 hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500"><i data-lucide="eye" class="inline-block size-3"></i></a>
                            <a data-id=' . $row->id . ' class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md edit-entry size-8 bg-slate-100 text-slate-500 hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500"><i data-lucide="pencil" class="inline-block size-3"></i> </a>
                            <a href=' . route('admin.exam-session.destroy', $row->id) . ' class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md delete-entry size-8 bg-slate-100 text-slate-500 hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500"><i data-lucide="trash-2" class="size-4"></i></a>
                        </div>';
            })
            ->rawColumns(['action', 'created_at', 'status'])
            ->make(true);
    }

    public function changeStatus(Request $request)
    {
        //update all
        CeeSession::query()->update(['status' => 'inactive']);

        $examSessionById = CeeSession::findOrFail($request->id);
        $examSessionById->status = $request->status == 'true' ? 'active' : 'inactive';
        //save to db
        $examSessionById->save();

        return response(['message' => 'Status has been updated']);
    }

    /**s
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => ['required', 'max:255'],
            ]
        );

        $ceeSession = new CeeSession;
        $ceeSession->name = $request->name;
        $ceeSession->status = 'inactive';
        $ceeSession->save();

        // Return a response
        return response()->json([
            'success' => true,
            'message' => 'CEE Exam Session added successfully!',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $ceeSession = CeeSession::findOrFail($id);
        return response()->json([
            'ceeSession' => $ceeSession
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $ceeSession = CeeSession::findOrFail($id);

        $request->validate(
            [
                'name' => ['required', 'max:255'],
                'ceesessionid' => ['required', 'integer'],
            ]
        );

        $ceeSession->name = $request->name;
        $ceeSession->save();

        // Return a response
        return response()->json([
            'success' => true,
            'message' => 'CEE Exam Session updated successfully!',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ceeSession = CeeSession::findOrFail($id);

        // Retrieve the room based on the room_id from the reservation
        $res = Reservation::where('cee_session_id', $id)->first();

        if ($res) {
            return response(['status' => 'error', 'message' => 'Unable to Delete this Session! There are data associated to it in Reservations']);
        }

        $ceeSession->delete();

        return response(['status' => 'success', 'message' => 'Deleted successfully!']);
    }

    public function viewresultindex($id)
    {

        $data = DB::table('cee_sessions')
            ->where('id', $id)
            ->first();

        return view('admin.result.index', compact('data'));
    }

    public function getResult(Request $request)
    {
        if ($request->ajax()) {

            // Retrieve the cee_session_id from the request
            $ceeSessionId = $request->input('cee_session_id');

            $data = Result::select(
                'results.id',
                'results.app_no',
                'results.fullname',
                'results.cee_session_id',
                'results.science',
                'results.math',
                'results.humanities',
                'results.inductive',
                'results.status',
                'results.csa',
                'results.ispending_edit',
                'results.remarks',
                'results.created_at',
                'results.updated_at',
                'cee_sessions.status AS ceesesstatus',
                DB::raw('(SELECT COUNT(*) FROM results r2 WHERE r2.app_no = results.app_no) AS duplicate_count')
            )
                ->join('cee_sessions', 'results.cee_session_id', '=', 'cee_sessions.id')
                ->where('cee_sessions.id', '=', $ceeSessionId);

            return datatables()->of($data)
                ->filter(function ($query) use ($request) {

                    if ($request->has('search')) {
                        $searchValue = $request->get('search')['value'];
                        $query->where(function ($subQuery) use ($searchValue) {
                            $subQuery->where('results.app_no', 'like', "%{$searchValue}%")
                                ->orWhere('results.fullname', 'like', "%{$searchValue}%");
                        });
                    }
                })
                ->editColumn('app_no', function ($row) {
                    return $row->duplicate_count > 1
                        ? '<span class="font-bold text-red-500">' . $row->app_no . '</span>'
                        : $row->app_no;
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == '' || empty($row->status)) {
                    } else if ($row->status == 'saved') {
                        return '<span class="delivery_status px-2.5 py-0.5 text-xs inline-block font-medium rounded border bg-purple-100 border-purple-200 text-purple-500 dark:bg-purple-500/20 dark:border-purple-500/20"><i data-lucide="layers" class="inline-block size-3"></i> Saved</span>';
                    } else if ($row->status == 'posted') {
                        return '<span class="delivery_status px-2.5 py-0.5 text-xs inline-block font-medium rounded border bg-green-100 border-green-200 text-green-500 dark:bg-green-500/20 dark:border-green-500/20"><i data-lucide="check" class="inline-block size-3"></i> Posted</span>';
                    } else if ($row->status == 'pending') {
                        return '<span class="delivery_status px-2.5 py-0.5 text-xs inline-block font-medium rounded border bg-yellow-100 border-yellow-200 text-yellow-500 dark:bg-yellow-500/20 dark:border-yellow-500/20"><i data-lucide="circle-dot-dashed" class="inline-block size-3"></i> Pending</span>';
                    }
                })
                ->addColumn('ispending_edit', function ($row) {
                    if ($row->ispending_edit == '' || empty($row->status)) {
                    } else if ($row->ispending_edit == 'yes') {
                        return '  <span class="px-2.5 py-0.5 text-xs inline-block font-medium rounded border bg-slate-100 border-slate-200 text-slate-500 dark:bg-slate-500/20 dark:border-slate-500/20 dark:text-zink-200"><i data-lucide="loader" class="inline-block size-3"></i> Waiting for Approval</span>';
                    } else if ($row->ispending_edit == 'approved') {
                        return ' <span class="delivery_status px-2.5 py-0.5 text-xs inline-block font-medium rounded border bg-sky-100 border-sky-200 text-sky-500 dark:bg-sky-500/20 dark:border-sky-500/20">Approved</span>';
                    }
                })
                ->rawColumns(['action', 'app_no', 'ispending_edit', 'status'])
                ->make(true);
        }
    }
}
