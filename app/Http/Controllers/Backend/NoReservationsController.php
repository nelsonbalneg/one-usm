<?php

namespace App\Http\Controllers\Backend;

use App\Models\CeeSession;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersNoReservationExport;

class NoReservationsController extends Controller
{


    public function index(){

        $activecee_session = CeeSession::where('status', 'active')->first();
        return view('admin.report.user-no-reservation',compact('activecee_session'));
    }

    public function getData(Request $request){
        if ($request->ajax()) {
            $data = DB::table('users')
            ->leftJoin('reservations', 'users.id', '=', 'reservations.user_id')
            ->join('cee_sessions', 'users.exam_session_id', '=', 'cee_sessions.id')
            ->whereNull('reservations.user_id')
            ->where('cee_sessions.status','active')
            ->select(
                DB::raw("CONCAT(users.lastname, ', ', users.firstname, ' ', COALESCE(users.middlename, ''), ' ', COALESCE(users.suffix, '')) AS fullname"),
                'users.email',
                'users.phone',
                'users.lrn',
                'users.email',
                'users.created_at'
            );

            return DataTables::of($data)
            ->make(true);
        }
    }

    public function exportNoReservations(){
        return Excel::download(new UsersNoReservationExport, 'cee-no-reservations-user.xlsx');
    }
}
