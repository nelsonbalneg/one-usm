<?php

namespace App\Http\Controllers\Backend;

use DB;
use App\Models\User;
use App\Models\SchoolName;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class SchoolNamesController extends Controller
{
    public function index()
    {
        return view("admin.schools.school-names");
    }

    public function getData(Request $request)
    {

        if (!$request->hasHeader('X-Requested-With') || $request->header('X-Requested-With') !== 'XMLHttpRequest') {
            return response()->json(['error' => 'Invalid request'], 400);
        }

        $data = SchoolName::select([
            'id',
            'schoolid',
            'school_name',
            'school_address'
        ]);

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($query) {
                return '<div class="flex gap-3">
                <a data-id=' . $query->id . ' class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md edit-entry size-8 bg-slate-100 text-slate-500 hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500"><i data-lucide="pencil" class="inline-block size-3"></i> </a>
                <a href=' . route('admin.cee.school-name.destroy', $query->id) . ' class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md delete-entry size-8 bg-slate-100 text-slate-500 hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500"><i data-lucide="trash-2" class="size-4"></i></a>
            </div>';
            })
            ->filter(function ($query) use ($request) {
                if ($request->has('search')) {
                    $searchValue = $request->get('search')['value'];
                    $query->where('schoolid', 'like', "%{$searchValue}%")
                        ->orWhere('school_name', 'like', "%{$searchValue}%")
                        ->orWhere('school_address', 'like', "%{$searchValue}%");
                }
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'schoolid' => ['required', 'max:255'],
                'school_name' => ['required', 'max:255'],
                'school_address' => ['required', 'max:255'],
            ]
        );

        $schoolname = new SchoolName();
        $schoolname->schoolid = $request->schoolid;
        $schoolname->school_name = $request->school_name;
        $schoolname->school_address = $request->school_address;
        $schoolname->save();

        // Return a response
        return response()->json([
            'success' => true,
            'message' => 'New School added successfully!',
        ]);
    }

    public function edit(string $id)
    {
        $schoolname = SchoolName::findOrFail($id);
        return response()->json([
            'schoolname' => $schoolname
        ]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'school_id' => ['required'],
                'schoolid' => ['required', 'max:255'],
                'school_name' => ['required', 'max:255'],
                'school_address' => ['required', 'max:255'],
            ]
        );

        $schoolname = SchoolName::findOrFail($id);
        $schoolname->schoolid = $request->schoolid;
        $schoolname->school_name = $request->school_name;
        $schoolname->school_address = $request->school_address;
        $schoolname->save();

        // Return a response
        return response()->json([
            'success' => true,
            'message' => 'School Information Updated successfully!',
        ]);
    }

    public function destroy(string $id)
    {
        $schoolname = SchoolName::findOrFail($id);

        $user = User::where('schoolid',$schoolname->schoolid)->first();
        if($user){
            return response(['status' => 'error', 'message' => 'Unable to delete! There are associated data to it.']);
        }
        else{
            $schoolname->delete();
            return response(['status' => 'success', 'message' => 'Deleted successfully!']);
        }
    }
}
