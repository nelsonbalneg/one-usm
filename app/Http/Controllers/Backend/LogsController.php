<?php

namespace App\Http\Controllers\Backend;

use DB;
use App\Models\OperationLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class LogsController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.logs.logs');
    }

    public function getData(Request $request)
    {

        if ($request->ajax()) {
            $data = OperationLog::select([
                'id',
                'user_id',
                'model',
                'action',
                'data',
                'created_at',
                'updated_at',
            ]);
            return DataTables::of($data)
                ->filter(function ($query) use ($request) {
                    if ($request->has('search')) {
                        $searchValue = $request->get('search')['value'];
                        $query->where('data', 'like', "%{$searchValue}%")
                            ->orWhere('model', 'like', "%{$searchValue}%")
                            ->orWhere('action', 'like', "%{$searchValue}%");
                    }
                })
                ->make(true);
        }
    }

}
