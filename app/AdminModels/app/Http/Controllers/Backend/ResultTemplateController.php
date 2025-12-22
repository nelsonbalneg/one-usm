<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\ResultTemplate;
use App\Trait\ImageUploadTrait;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class ResultTemplateController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('admin.result.template.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function getData(Request $request)
    {

        if (!$request->hasHeader('X-Requested-With') || $request->header('X-Requested-With') !== 'XMLHttpRequest') {
            return response()->json(['error' => 'Invalid request'], 400);
        }
        $data = DB::table('result_templates')
            ->select(
                'result_templates.id',
                'result_templates.filename',
                'result_templates.attachment',
                'result_templates.description',
                'result_templates.status',
                'result_templates.created_at',
                'result_templates.updated_at'
            );

        return DataTables::of($data)
            ->addIndexColumn()
            ->filter(function ($query) use ($request) {
                if ($request->has('search')) {
                    $searchValue = $request->get('search')['value'];
                    $query->where('result_templates.id', 'like', "%{$searchValue}%") // Use original column name
                        ->orWhere('result_templates.filename', 'like', "%{$searchValue}%") // Use original column name
                        ->orWhere('result_templates.description', 'like', "%{$searchValue}%"); // Use original column name
                }
            })
            ->addColumn('status', function ($query) {

                if ($query->status == 'active') {
                    return $button = ' <div class="flex items-center">
                    <div class="relative inline-block w-10 align-middle transition duration-200 ease-in ltr:mr-2 rtl:ml-2">
                        <input type="checkbox"  data-id=' . $query->id . ' name="greenDefaultSwitch" id="greenDefaultSwitch" class="absolute block transition duration-300 ease-linear border-2 rounded-full appearance-none cursor-pointer change-status size-5 border-slate-200 dark:border-zink-500 bg-white/80 dark:bg-zink-400 peer/published checked:bg-white dark:checked:bg-white ltr:checked:right-0 rtl:checked:left-0 checked:bg-none checked:border-green-500 dark:checked:border-green-500 arrow-none" checked>
                        <label for="greenDefaultSwitch" class="block h-5 overflow-hidden duration-300 ease-linear border rounded-full cursor-pointer cursor-pointertransition border-slate-200 dark:border-zink-500 bg-slate-200 dark:bg-zink-600 peer-checked/published:bg-green-500 peer-checked/published:border-green-500"></label>
                    </div>
                </div>';

                } else {
                    return $button = ' <div class="flex items-center">
                    <div class="relative inline-block w-10 align-middle transition duration-200 ease-in ltr:mr-2 rtl:ml-2">
                        <input type="checkbox" data-id=' . $query->id . ' name="greenDefaultSwitch" id="greenDefaultSwitch" class="absolute block transition duration-300 ease-linear border-2 rounded-full appearance-none cursor-pointer change-status size-5 border-slate-200 dark:border-zink-500 bg-white/80 dark:bg-zink-400 peer/published checked:bg-white dark:checked:bg-white ltr:checked:right-0 rtl:checked:left-0 checked:bg-none checked:border-green-500 dark:checked:border-green-500 arrow-none">
                        <label for="greenDefaultSwitch" class="block h-5 overflow-hidden duration-300 ease-linear border rounded-full cursor-pointer cursor-pointertransition border-slate-200 dark:border-zink-500 bg-slate-200 dark:bg-zink-600 peer-checked/published:bg-green-500 peer-checked/published:border-green-500"></label>
                    </div>
                </div>';
                }

            })
            ->addColumn('created_at', function ($row) {
                return Carbon::parse($row->created_at)->setTimezone('Asia/Manila')->format('F j, Y h:i A');
            })
            ->addColumn('attachment', function ($row) {
                return $button = '<div class="flex gap-3">
                            <a data-id=' . $row->id . ' class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md attach-file size-8 bg-slate-100 text-slate-500 hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500"><i data-lucide="paperclip" class="inline-block size-3"></i> </a>
                            <a href=' . url($row->attachment) . ' target="_blank"
                                                    class="flex items-center justify-center w-[37.5px] h-[37.5px] transition-all duration-200 ease-linear text-sky-500 btn bg-sky-100 hover:text-white hover:bg-sky-600 focus:text-white focus:bg-sky-600 focus:ring focus:ring-sky-100 active:text-white active:bg-sky-600 active:ring active:ring-sky-100 dark:bg-sky-500/20 dark:text-sky-400 dark:hover:bg-sky-500 dark:hover:text-white dark:focus:bg-sky-500 dark:focus:text-white dark:active:bg-sky-500 dark:active:text-white dark:ring-sky-400/20"
                                                    target="_blank">
                                                    <i class="ri-download-2-line"></i>
                                                </a>
                        </div>';
            })
            ->addColumn('updated_at', function ($row) {
                return Carbon::parse($row->created_at)->setTimezone('Asia/Manila')->format('F j, Y h:i A');
            })
            ->addColumn('action', function ($row) {
                return '<div class="flex gap-3">
                            <a data-id=' . $row->id . ' class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md edit-entry size-8 bg-slate-100 text-slate-500 hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500"><i data-lucide="pencil" class="inline-block size-3"></i> </a>
                            <a href=' . route('admin.cee.result-template.destroy', $row->id) . ' class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md delete-entry size-8 bg-slate-100 text-slate-500 hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500"><i data-lucide="trash-2" class="size-4"></i></a>
                        </div>';
            })
            ->order(function ($query) {
                $query->orderBy('result_templates.created_at', 'desc'); // Order by latest
            })
            ->rawColumns(['action', 'created_at', 'status', 'attachment'])
            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'filename' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'attachment_name' => 'file|mimes:xls,xlsx,csv|max:10240',
            'status' => 'required|string|in:active,inactive',
        ]);

        $result_template = new ResultTemplate();

        // Handle attachment upload
        if ($request->hasFile('attachment_name')) {
            $path = 'uploads/result-templates';
            $result_template->attachment = $this->uploadFile($request, 'attachment_name', $path);
        }

        $result_template->filename = $request->filename;
        $result_template->description = $request->description;
        $result_template->status = $request->status;
        $result_template->save();

        // Return a response
        return response()->json([
            'success' => true,
            'message' => 'New template added successfully!',
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
        $result_template = ResultTemplate::findOrFail($id);
        return response()->json([
            'result_template' => $result_template
        ]);
    }

    // public function updateNstp(){

    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'filename' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'status' => 'required|string|in:active,inactive',
        ]);

        $result_template = ResultTemplate::findOrFail($id);

        $result_template->filename = $request->filename;
        $result_template->description = $request->description;
        $result_template->status = $request->status;
        $result_template->save();

        // Return a response
        return response()->json([
            'success' => true,
            'message' => 'Template details upated successfully!',
        ]);
    }

    public function updateAttachment(Request $request, string $id)
    {
        $request->validate([
            'file_attachment_id' => 'required|integer|max:20',
            'attachment_name' => 'file|mimes:xls,xlsx,csv|max:10240',
        ]);

        $result_template = ResultTemplate::findOrFail($id);

        //Handle attachment upload
        if ($request->hasFile('attachment_name')) {
            $path = 'uploads/result-templates';
            $result_template->attachment = $this->updateFile($request, 'attachment_name', $path, $result_template->attachment);
        }
        $result_template->save();

        //Return a response
        return response()->json([
            'success' => true,
            'message' => 'Template details upated successfully!',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $result_template = ResultTemplate::findOrFail($id);

        if (empty($result_template->attachment)) {
            $result_template->delete();
        } else {
            $result_template->delete();
            $this->deleteImage($result_template->attachment);
        }
        return response(['status' => 'success', 'message' => 'Deleted successfully!']);
    }

    public function changeStatus(Request $request)
    {
        $result_template = ResultTemplate::findOrFail($request->id);
        $result_template->status = $request->status == 'true' ? 'active' : 'inactive';
        //save to db
        $result_template->save();

        return response(['message' => 'Status has been updated']);
    }

    public function attachform(Request $request, string $id)
    {
        //update
        $result_template = ResultTemplate::findOrFail($request->id);

        if (!empty($result_template->attachment)) {
            // Handle file upload
            if ($request->hasFile('attachment')) {
                $filePath = $this->updateImage($request, 'attachment', 'uploads/result-templates', $result_template->attachment);
                $result_template->attachment = $filePath;
            }

            $result_template->save();
        } else {
            // Handle file upload
            if ($request->hasFile('attachment')) {
                $filePath = $this->uploadFile($request, 'attachment', 'uploads/result-templates');
                $result_template->attachment = $filePath;
            }
            $result_template->save();
        }
        return response(['status' => 'success', 'message' => 'Result Template Successfully!']);
    }
}
