<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\CeeSession;
use Illuminate\Http\Request;
use App\Models\scan_data_logs;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ScanLogsController extends Controller
{
    public function index()
    {
         $cee_term_active = CeeSession::where('status', 'active')->first();
        return view('admin.logs.scan-logs', compact('cee_term_active'));
    }

    public function getData(Request $request)
    {

        if ($request->ajax()) {
            $data = DB::table('scan_data_logs')
                ->join('cee_sessions', function ($join) {
                    $join->on('scan_data_logs.cee_term_id', '=', 'cee_sessions.id')
                        ->where('cee_sessions.status', '=', 'active');
                })
                ->select('scan_data_logs.*')
                 ->where('cee_sessions.status', 'active');

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('date', function ($row) {
                    $date = $row->date ? Carbon::parse($row->date)->format('F j, Y') : 'N/A';
                    $time = $row->time;

                    return $date . ' | ' . $time;
                })
                ->addColumn('created_at', function ($row) {
                    $date = $row->created_at ? Carbon::parse($row->created_at)->format('F j, Y') : 'N/A';

                    return $date;
                })
                ->addColumn('updated_at', function ($row) {
                    $date = $row->updated_at ? Carbon::parse($row->updated_at)->format('F j, Y') : 'N/A';

                    return $date;
                })
                ->filter(function ($query) use ($request) {
                    if ($request->has('search')) {
                        $searchValue = $request->get('search')['value'];
                        $query->where('classname', 'like', "%{$searchValue}%")
                            ->orWhere('employeeid', 'like', "%{$searchValue}%")
                            ->orWhere('studentno', 'like', "%{$searchValue}%")
                            ->orWhere('studentname', 'like', "%{$searchValue}%")
                            ->orWhere('employeename', 'like', "%{$searchValue}%");
                    }
                })
                ->rawColumns(['date'])
                ->make(true);
        }
    }
}
