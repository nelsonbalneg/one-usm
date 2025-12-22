<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\StundentProfile;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Models\PreregistrationTerm;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class PreregTermController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.prereg.term.index');
    }

    public function getData(Request $request)
    {

        if (!$request->hasHeader('X-Requested-With') || $request->header('X-Requested-With') !== 'XMLHttpRequest') {
            return response()->json(['error' => 'Invalid request'], 400);
        }
        $data = DB::table('preregistration_terms as pt')
            ->leftJoin('stundent_profiles as sp', 'pt.id', '=', 'sp.prereg_term_id')
            ->select(
                'pt.id',
                'pt.term_name',
                'pt.description',
                'pt.status',
                'pt.created_at',
                DB::raw('COUNT(sp.id) as prereg_count') // Count reservation IDs
            )
            ->groupBy(
                'pt.id',
                'pt.term_name',
                'pt.description',
                'pt.status',
                'pt.created_at'
            );


        return DataTables::of($data)
            ->addIndexColumn()
            ->filter(function ($query) use ($request) {
                if ($request->has('search')) {
                    $searchValue = $request->get('search')['value'];
                    $query->where('pt.id', 'like', "%{$searchValue}%") // Use original column name
                        ->orWhere('pt.term_name', 'like', "%{$searchValue}%") // Use original column name
                        ->orWhere('pt.status', 'like', "%{$searchValue}%"); // Use original column name
                }
            })
            ->addColumn('status', function ($query) {

                if ($query->status == 1) {
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
                            <a data-id=' . $row->id . ' class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md edit-entry size-8 bg-slate-100 text-slate-500 hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500"><i data-lucide="pencil" class="inline-block size-3"></i> </a>
                            <a href=' . route('admin.prereg-term.settings.destroy', $row->id) . ' class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md bg-slate-100 text-slate-500 delete-entry size-8 hover:text-red-500 hover:bg-red-100 dark:bg-zink-600 dark:text-red-200 dark:hover:bg-red-500/20 dark:hover:text-red-500"><i data-lucide="trash-2" class="size-4"></i></a>
                        </div>';
            })
            ->rawColumns(['action', 'created_at', 'status'])
            ->make(true);
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
        $request->validate(
            [
                'term_name' => ['required', 'string', 'max:255', 'unique:preregistration_terms,term_name'],
            ]
        );

        $preregterm = new PreregistrationTerm;
        $preregterm->term_name = $request->term_name;
        $preregterm->description = $request->description;
        $preregterm->save();

        // Return a response
        return response()->json([
            'success' => true,
            'message' => 'Prereg term added successfully!',
        ]);
    }

    public function changeStatus(Request $request)
    {
        //update all
        PreregistrationTerm::query()->update(['status' => 0]);

        $preregterm = PreregistrationTerm::findOrFail($request->id);
        $preregterm->status = $request->status == 'true' ? 1 : 0;
        //save to db
        $preregterm->save();

        return response(['message' => 'Status has been updated']);
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
        $preregterm = PreregistrationTerm::findOrFail($id);
        return response()->json([
            'preregterm' => $preregterm
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'term_name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('preregistration_terms', 'term_name')->ignore($id),
            ],
        ]);

        $preregterm = PreregistrationTerm::findOrFail($id);
        $preregterm->term_name = $request->term_name;
        $preregterm->description = $request->description;
        $preregterm->save();

        return response()->json([
            'success' => true,
            'message' => 'Prereg term updated successfully!',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $preregTerm = PreregistrationTerm::findOrFail($id);

        // Check if associated with any student profiles
        $associatedProfile = StundentProfile::where('prereg_term_id', $id)->exists();

        // Prevent deletion if associated or status is active
        if ($associatedProfile || $preregTerm->status == 1) {
            return response([
                'status' => 'error',
                'message' => 'Unable to delete! This term is either active or has associated student applicant profiles.'
            ]);
        }

        $preregTerm->delete();

        return response([
            'status' => 'success',
            'message' => 'Deleted successfully!'
        ]);
    }

}
