<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Term;
use Yajra\DataTables\Facades\DataTables;

class TermIDController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.termid.index');
    }

    public function getData(Request $request)
    {

        if (!$request->hasHeader('X-Requested-With') || $request->header('X-Requested-With') !== 'XMLHttpRequest') {
            return response()->json(['error' => 'Invalid request'], 400);
        }
        $data = DB::table('terms as term_ids')
            ->select(
                'term_ids.id',
                'term_ids.campus_name',
                'term_ids.is_active',
                'term_ids.description',
                'term_ids.real_campus_id',
                'term_ids.termid',
            );


        return DataTables::of($data)
            ->addIndexColumn()
            ->filter(function ($query) use ($request) {
                if ($request->has('search')) {
                    $searchValue = $request->get('search')['value'];
                    $query->where('term_ids.id', 'like', "%{$searchValue}%") // Use original column name
                        ->orWhere('term_ids.campus_name', 'like', "%{$searchValue}%") // Use original column name
                        ->orWhere('term_ids.is_active', 'like', "%{$searchValue}%"); // Use original column name
                }
            })
            ->addColumn('status', function ($query) {
                if ($query->is_active == 1) {
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
            ->addColumn('action', function ($row) {
                return '<div class="flex gap-3">
                            <a data-id=' . $row->id . ' class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md edit-entry size-8 bg-slate-100 text-slate-500 hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500"><i data-lucide="pencil" class="inline-block size-3"></i> </a>
                            <a href=' . route('admin.exam-session.destroy', $row->id) . ' class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md delete-entry size-8 bg-slate-100 text-slate-500 hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500"><i data-lucide="trash-2" class="size-4"></i></a>
                        </div>';
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }

    public function changeStatus(Request $request)
    {
        $checklistTemplate = Term::findOrFail($request->id);
        $checklistTemplate->is_active = $request->status ? 1 : 0;
        $checklistTemplate->save();

        return response(['message' => 'Status has been updated']);
    }


    /**
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
        //
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
         $booklet = Term::findOrFail($id);

        $user = $booklet->applicant;
        return response()->json([
            'booklet' => $booklet,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
