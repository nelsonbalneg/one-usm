<?php

namespace App\Http\Controllers\Utdc;

use Carbon\Carbon;
use App\Models\CeeSession;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;
use App\Exports\ReservationconfirmedExport;

class UTDCReservationController extends Controller
{
    public function index()
    {
        $ceeSessions = CeeSession::all();
        $activecee_session = CeeSession::where('status', 'active')->first();
        return view("utdc.reservation.reservation", compact('ceeSessions', 'activecee_session'));
    }


    public function getData(Request $request)
    {
        if ($request->ajax()) {

            $data = DB::table('reservations')
                ->leftJoin('rooms', 'reservations.room_id', '=', 'rooms.id') //cee_session_id  cee_sessions
                ->leftJoin('users', 'reservations.user_id', '=', 'users.id')
                ->leftJoin('cee_sessions','reservations.cee_session_id', '=','cee_sessions.id')
                ->select(
                    'reservations.user_id',
                    'reservations.app_no',
                    'reservations.id',
                    'reservations.firstpriorty_desc',
                    'reservations.secondpriority_desc',
                    'reservations.thirdpriorty_desc',
                    'reservations.campus_id',
                    'reservations.campus_id_prio_prog_2',
                    'reservations.campus_id_prio_prog_3',
                    'reservations.is_repeat_exam',
                    'reservations.created_at',
                    'rooms.room_name',
                    'rooms.college_name',
                    'rooms.capacity',
                    'rooms.exam_session',
                    'rooms.campus',
                    'rooms.time',
                    'rooms.schedule',
                    'rooms.exam_session',
                    'users.firstname',
                    'users.lastname',
                    'users.email',
                    'users.sex',
                    'users.phone',
                    'users.birthdate',
                    'users.suffix',
                    'cee_sessions.id AS sessionId',
                    DB::raw("CONCAT(users.lastname, ', ', users.firstname, ' ', ISNULL(users.middlename, ''), ' ', ISNULL(users.suffix, '')) AS fullname")
                )
                ->when($request->cee_session_id, function ($query) use ($request) {
                    return $query->where('reservations.cee_session_id', $request->cee_session_id);
                });
                // ->where('cee_sessions.status', 'active');

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $encryptedAppNo = Crypt::encryptString($row->app_no);
                    return '<div class="flex gap-3">
                                <a href=' . route('utdc.cee.exam-slip', ['app_no' => $encryptedAppNo]) . ' target="_blank" class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md size-8 bg-slate-100 text-slate-500 hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500"><i data-lucide="download" class="size-4"></i></a>
                                <a data-id=' . $row->id . ' class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md view-detail size-8 bg-slate-100 text-slate-500 hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500"><i data-lucide="eye" class="inline-block size-3"></i> </a>
                        </div>';
                })
                ->filterColumn('fullname', function ($query, $keyword) {
                    $query->whereRaw("CONCAT(users.firstname, ' ', users.lastname, ' ', ISNULL(users.suffix, '')) like ?", ["%{$keyword}%"])
                    ->orWhere('users.email', 'like', "%{$keyword}%");
                })
                ->addColumn('sessionId', function ($row) {
                    return  $row->sessionId;;
                })
                ->addColumn('college_name', function ($query) {
                    $room = $query->room_name;
                    $batch = $query->exam_session;
                    $schedule = $query->schedule ? Carbon::parse($query->schedule)->format('F j, Y') : 'N/A';
                    $time = $query->time;
                    $building = $query->college_name;

                    return '  <div class="flex items-center gap-2">
                    <div class="grow">
                     <h6 class="mb-1"><a href="#!" class="name">' . $query->campus . '</a></h6>
                        <h6 class="mb-1"><a href="#!" class="name">' . $building . ' - ' . $room . '</a></h6>
                        <span class="delivery_status px-2.5 py-0.5 text-xs inline-block font-medium rounded border bg-sky-100 border-sky-200 text-sky-500 dark:bg-sky-500/20 dark:border-sky-500/20">'. $batch .'</span>
                        <span class="delivery_status px-2.5 py-0.5 text-xs inline-block font-medium rounded border bg-purple-100 border-purple-200 text-purple-500 dark:bg-purple-500/20 dark:border-purple-500/20">' . $schedule . ' ( ' . $time . ' )</span>
                     </div>
                </div>';
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
                ->rawColumns(['status', 'fullname', 'action', 'college_name','sessionId'])
                ->make(true);
        }
    }


    public function viewDetails(string $id)
    {

        $reservation = Reservation::findOrFail($id);
        return response()->json([
            'reservation' => $reservation
        ]);
    }

    public function loadCeeSessions()
    {
        $ceeSession = CeeSession::all();
        return response()->json([
            'ceeSession' => $ceeSession
        ]);
    }

    public function exportConfirmedReservations(){
        return Excel::download(new ReservationconfirmedExport, 'cee-confirmed_reservations.xlsx');
    }

}
