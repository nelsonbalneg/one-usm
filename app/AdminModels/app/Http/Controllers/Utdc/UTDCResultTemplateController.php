<?php

namespace App\Http\Controllers\Utdc;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class UTDCResultTemplateController extends Controller
{
    public function index()
    {
        return view('utdc.result.template.index');
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
                'result_templates.created_at',
                'result_templates.updated_at'
            )
            ->where('result_templates.status', 'active');

        return DataTables::of($data)
            ->addIndexColumn()
            ->filter(function ($query) use ($request) {
                if ($request->has('search')) {
                    $searchValue = $request->get('search')['value'];
                    $query->where(function ($subQuery) use ($searchValue) {
                        $subQuery->where('result_templates.id', 'like', "%{$searchValue}%") // Use original column name
                            ->orWhere('result_templates.filename', 'like', "%{$searchValue}%") // Use original column name
                            ->orWhere('result_templates.description', 'like', "%{$searchValue}%"); // Use original column name
                    });
                }
            })
            ->addColumn('created_at', function ($row) {
                return Carbon::parse($row->created_at)->setTimezone('Asia/Manila')->format('F j, Y h:i A');
            })
            ->addColumn('attachment', function ($row) {
                return $button = '<div class="flex gap-3">
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
            ->order(function ($query) {
                $query->orderBy('result_templates.created_at', 'desc'); // Order by latest
            })
            ->rawColumns(['created_at', 'attachment'])
            ->make(true);
    }

}
