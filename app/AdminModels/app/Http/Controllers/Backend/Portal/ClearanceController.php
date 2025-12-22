<?php

namespace App\Http\Controllers\Backend\Portal;

use App\Models\Term;
use App\Models\Office;
use App\Models\Clearance;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ClearanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $offices = Office::where('is_active', 1)->get();

        // Cache the semester data for 60 minutes
        $semesters = Cache::remember('active_semesters_with_campus', 60, function () {

            $apiSemesters = Http::get('http://172.16.0.60/academic/api/v2/ActiveSemesters/active-only')->json();
            return collect($apiSemesters)
                ->sortByDesc(fn($item) => $item['isActive']) //
                ->values()
                ->map(function ($item) {

                    $term = Term::where('campus_id', $item['campusId'])->first();

                    $item['campus_name'] = $term ? $term->campus_name : 'Unknown Campus';

                    return $item;
                });
        });

        return view('admin.portal.clearance.index', compact('offices', 'semesters'));
    }

    public function getallData(Request $request)
    {
        if ($request->ajax()) {
            $data = Clearance::select([
                'clearances.id',
                'clearances.student_id',
                'clearances.status',
                'clearances.remarks',
                'clearances.created_at',
                'clearances.updated_at',
                'clearances.settled_date',
                'clearances.school_year',
                'clearances.description',
                'clearances.semester',
                'clearances.office_id',
                'offices.name as office_name',

                DB::raw("
                    CONCAT(
                        portal_users.lastname, ', ',
                        portal_users.firstname, ' ',
                        ISNULL(portal_users.middlename, '')
                    ) AS student_fullname
                "),

                DB::raw("
                    CONCAT(
                        updated_by_user.lastname, ', ',
                        updated_by_user.firstname, ' ',
                        ISNULL(updated_by_user.middlename, '')
                    ) AS updated_by_fullname
                "),

                DB::raw("
                    CONCAT(
                        cleared_by_user.lastname, ', ',
                        cleared_by_user.firstname, ' ',
                        ISNULL(cleared_by_user.middlename, '')
                    ) AS cleared_by_fullname
                "),
                'portal_users.email'
            ])
                ->leftJoin('portal_users', 'portal_users.student_id', '=', 'clearances.student_id')
                ->leftJoin('offices', 'offices.id', '=', 'clearances.office_id')
                ->leftJoin('users as updated_by_user', 'updated_by_user.id', '=', 'clearances.updated_by')
                ->leftJoin('users as cleared_by_user', 'cleared_by_user.id', '=', 'clearances.cleared_by');

            return datatables()->of($data)
                ->addIndexColumn()
                ->filterColumn('fullname', function ($query, $keyword) {
                    $query->whereRaw("CONCAT(portal_users.firstname, ' ', portal_users.lastname, ' ', ISNULL(portal_users.suffix, '')) like ?", ["%{$keyword}%"])
                        ->orWhere('clearances.student_id', 'like', "%{$keyword}%")
                        ->orWhere('clearances.office', 'like', "%{$keyword}%")
                        ->orWhere('clearances.status', 'like', "%{$keyword}%");
                })
                ->filterColumn('updated_by_fullname', function ($query, $keyword) {
                    $query->whereRaw("CONCAT(users.lastname, ', ', users.firstname, ' ', ISNULL(users.middlename, '')) LIKE ?", ["%{$keyword}%"]);
                })
                ->addColumn('action', function ($row) {
                    return ' <div class="flex gap-2">
                                <a  class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md update-clearance-status size-8 bg-slate-100 text-slate-500 hover:text-purple-500 hover:bg-purple-100 dark:bg-purple-600 dark:text-purple-200 dark:hover:bg-purple-500/20 dark:hover:text-purple-500" data-id=' . $row->id . '><i data-lucide="brush-cleaning" class="size-4"></i></a>
                                <a  class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md size-8 edit-entry bg-slate-100 text-slate-500 hover:text-yellow-500 hover:bg-yellow-100 dark:bg-yellow-600 dark:text-yellow-200 dark:hover:bg-yellow-500/20 dark:hover:text-yellow-500" data-id=' . $row->id . '><i data-lucide="pencil" class="size-4"></i></a>
                                <a href=' . route('admin.portal.clearance.destroy', ['clearance' => $row->id]) . ' class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md size-8 delete-entry bg-slate-100 text-slate-500 hover:text-red-500 hover:bg-red-100 dark:bg-red-600 dark:text-red-200 dark:hover:bg-red-500/20 dark:hover:text-red-500"><i data-lucide="trash-2" class="size-4"></i></a>
                                </div>';
                })
                ->addColumn('fullname', function ($query): string {
                    $fullname = strtoupper($query->student_fullname);
                    $email = $query->email;
                    return '  <div class="flex items-center gap-2">
                                <div class="grow">
                                   <h6 class="mb-1">' . $fullname . '</h6>
                                 <span class="delivery_status px-2.5 py-0.5 text-xs inline-block font-medium rounded border bg-green-100 border-green-200 text-green-500 dark:bg-green-500/20 dark:border-green-500/20"> ' . $email . '</span>
                                 <span class="delivery_status px-2.5 py-0.5 text-xs inline-block font-medium rounded border bg-purple-100 border-purple-200 text-purple-500 dark:bg-purple-500/20 dark:border-purple-500/20"> ' . $query->student_id . '</span>
                                 </div>
                            </div>';
                })
                ->addColumn('causer', function ($query): string {
                    $updated_by = strtoupper($query->updated_by_fullname);
                    $cleared_by = $query->cleared_by_fullname ? strtoupper($query->cleared_by_fullname) : '---';
                    return ' <div class="flex gap-2">
                                    <div class="grow">
                                             <p class="text-slate-500 dark:text-zink-200">Logged by: ' . $updated_by . '</p>
                                             <p class="text-green-600 dark:text-zink-200">Cleared by: ' . $cleared_by . '</p>
                                         </div>
                                    </div>';
                })
                ->addColumn('status', function ($query) {
                    if ($query->status == 'cleared') {
                        $date_settled = Carbon::parse($query->settled_date)
                            ->format('F j, Y g:i A');
                        $button = '<span class="mb-2 px-2.5 py-0.5 text-xs font-medium rounded border bg-green-100 border-transparent text-green-500 dark:bg-green-500/20 dark:border-transparent inline-flex items-center status"><i data-lucide="check-circle" class="size-3 mr-1.5"></i> Cleared</span>
                           <div class="px-4 py-3 text-sm bg-white border rounded-md text-slate-500 border-slate-300 dark:bg-zink-700 dark:border-zink-500 dark:text-zink-200">
                                        <span class="font-bold">' . $query->description . '</span>  on ' . $date_settled . '
                                    </div>';

                    } else if ($query->status == 'pending') {

                        $button = '<span class="px-2.5 py-0.5 inline-flex items-center text-xs font-medium rounded border bg-yellow-100 border-transparent text-yellow-500 dark:bg-yellow-500/20 dark:text-yellow-200 dark:border-transparent status"><i data-lucide="loader" class="size-3 mr-1.5"></i>Pending</span>';
                    } else {
                        $button = '<span class="px-2.5 py-0.5 inline-flex items-center text-xs font-medium rounded border bg-red-100 border-transparent text-red-500 dark:bg-red-500/20 dark:border-transparent status"><i data-lucide="x" class="size-3 mr-1.5"></i>Deliquent</span>';
                    }
                    return $button;
                })
                ->rawColumns(['fullname', 'action', 'status', 'causer'])
                ->make(true);
        }
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.portal.clearance.create');
    }

    public function getStudent($studentId)
    {
        $student = DB::table('portal_users')
            ->where('student_id', $studentId)
            ->first();

        if (!$student) {
            return response()->json(['success' => false]);
        }

        return response()->json([
            'success' => true,
            'student' => [
                'firstname' => $student->firstname,
                'lastname' => $student->lastname,
                'middlename' => $student->middlename,
                'suffix' => $student->suffix,
            ]
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'remarks' => 'nullable|string',
            'status' => 'required',
            'semester_id' => 'required',
            'semester' => 'required',
            'office_id' => 'required',
        ]);

        // Get office name
        $office = Office::find($request->office_id);

        // Save to database
        Clearance::create([
            'student_id' => $request->student_id,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'middlename' => $request->middlename,
            'suffix' => $request->suffix,

            'remarks' => $request->remarks,
            'status' => $request->status,

            // Semester fields
            'semester_id' => $request->semester_id,
            'school_year' => $request->semester,

            // Office fields
            'office_id' => $request->office_id,
            'office_name' => $office->name ?? null,

            // Audit fields
            'updated_by' => Auth::user()->id,
            'updated_date_time' => now()
        ]);

        // Return a response
        return response()->json([
            'success' => true,
            'message' => 'Added successfully!',
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
        $clearance = Clearance::findOrFail($id);
        return response()->json([
            'clearance' => $clearance
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the incoming request
        $request->validate([
            'student_id' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'remarks' => 'nullable|string',
            'status' => 'required',
            'semester_id' => 'required',
            'semester' => 'required',
            'office_id' => 'required',
        ]);

        // Find the existing clearance record
        $clearance = Clearance::findOrFail($id);

        // Get office name
        $office = Office::find($request->office_id);

        // Update the clearance record
        $clearance->update([
            'student_id' => $request->student_id,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'middlename' => $request->middlename,
            'suffix' => $request->suffix,
            'remarks' => $request->remarks,
            'status' => $request->status,
            'semester_id' => $request->semester_id,
            'school_year' => $request->semester,
            'office_id' => $request->office_id,
            'office_name' => $office->name ?? null,
            'updated_by' => Auth::user()->id,
            'updated_date_time' => now(),
        ]);

        // Return a JSON response
        return response()->json([
            'success' => true,
            'message' => 'Updated successfully!',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $clearance = Clearance::findOrFail($id);
            $clearance->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Deleted successfully!'
            ], 200);

        } catch (ModelNotFoundException $e) {

            return response()->json([
                'status' => 'error',
                'message' => 'Record not found.'
            ], 404);

        } catch (\Exception $e) {

            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong while deleting.',
            ], 500);
        }
    }

    public function updateClearanceStatus(Request $request, $clearance_id)
    {
        $request->validate([
            'status' => 'required|in:cleared,delinquent',
            'description' => 'nullable|string',
        ]);

        $clearance = Clearance::findOrFail($clearance_id);

        $clearance->update([
            'status' => $request->status,
            'description' => $request->description,
            'cleared_by' => Auth::user()->id,
            'settled_date' => now(),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Clearance status updated successfully!'
        ]);
    }
}
