<?php

namespace App\Http\Controllers\Backend\Portal;

use Illuminate\Http\Request;
use App\Models\MikrotikRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class InternetAccountRequestController extends Controller
{
    public function index()
    {
        return view('admin.portal.internet-account.index');
    }

    public function getallData(Request $request)
    {

        // 
        if ($request->ajax()) {
            $data = MikrotikRequest::select([
                'mikrotik_requests.id',
                'mikrotik_requests.student_no',
                'mikrotik_requests.password',
                'mikrotik_requests.semester',
                'mikrotik_requests.created_at',
                DB::raw("CONCAT(portal_users.lastname, ', ', portal_users.firstname, ' ', ISNULL(portal_users.middlename, '')) AS fullname"),
                'portal_users.email'
            ])
                ->leftJoin('portal_users', function ($join) {
                    $join->on(DB::raw("LEFT(mikrotik_requests.student_no, CHARINDEX('-', mikrotik_requests.student_no, 4) - 1)"), '=', 'portal_users.student_id');
                });
            return datatables()->of($data)
                ->addIndexColumn()
                ->filterColumn('fullname', function ($query, $keyword) {
                    $query->whereRaw("CONCAT(portal_users.firstname, ' ', portal_users.lastname, ' ', ISNULL(portal_users.suffix, '')) like ?", ["%{$keyword}%"])
                        ->orWhere('mikrotik_requests.student_no', 'like', "%{$keyword}%")
                        ->orWhere('mikrotik_requests.semester', 'like', "%{$keyword}%");
                })
                ->addColumn('fullname', function ($query) {
                    $fullname = strtoupper($query->fullname);
                    $email = $query->email;
                    return '  <div class="flex items-center gap-2">
                                <div class="grow">
                                   <h6 class="mb-1">' . $fullname . '</h6>
                                 <span class="delivery_status px-2.5 py-0.5 text-xs inline-block font-medium rounded border bg-green-100 border-green-200 text-green-500 dark:bg-green-500/20 dark:border-green-500/20"> ' . $email . '</span>
                                 </div>
                            </div>';
                })
                ->rawColumns(['fullname'])
                ->make(true);
        }

    }
}
