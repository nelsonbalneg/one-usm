<?php

namespace App\Http\Controllers\Utdc;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\scan_data_logs;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class UTDCScanLogsController extends Controller
{
    public function index()
    {
        return view('utdc.report.scan-logs');
    }

    public function getData(Request $request)
    {

        if ($request->ajax()) {
            $data = scan_data_logs::select([
                'id',
                'classname',
                'schoolyear',
                'employeeid',
                'employeename',
                'studentno',
                'studentname',
                'date',
                'time',
                'created_at',
                'updated_at',
            ]);
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
