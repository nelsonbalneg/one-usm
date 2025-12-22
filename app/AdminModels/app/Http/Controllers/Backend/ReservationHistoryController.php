<?php

namespace App\Http\Controllers\Backend;

use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use function PHPUnit\Framework\isEmpty;

class ReservationHistoryController extends Controller
{
    public function reservationHistoryindex(Request $request)
    {
        $userid = Crypt::decryptString($request->id);
        $user = User::findOrFail($userid);
        return view('admin.reservation.reservation-history', compact('user'));
    }

    public function reservationHistoryData(Request $request)
    {
        if ($request->ajax()) {

            $userid = intval($request->input('userid')); // Explicit cast to integer

            $reservations = DB::table('users')
                ->select([
                    'reservations.user_id',
                    'reservations.app_no',
                    'reservations.id',
                    'reservations.firstpriorty_desc',
                    'reservations.secondpriority_desc',
                    'reservations.thirdpriorty_desc',
                    'reservations.is_repeat_exam',
                    'reservations.created_at',
                    'reservations.cee_session_id',
                    'reservations.status AS status',
                    'rooms.room_name',
                    'rooms.college_name',
                    'rooms.capacity',
                    'rooms.exam_session',
                    'rooms.campus',
                    'rooms.time',
                    'rooms.schedule',
                    'cee_sessions.name AS ceesesionname',
                    'results.csa'
                ])
                ->leftJoin('reservations', 'reservations.user_id', '=', 'users.id')
                ->leftJoin('rooms', 'reservations.room_id', '=', 'rooms.id')
                ->leftJoin('cee_sessions', 'reservations.cee_session_id', '=', 'cee_sessions.id')
                ->leftJoin('results', 'reservations.app_no', '=', 'results.app_no')
                ->where('reservations.user_id', $userid)
                ->get();

            return DataTables::of($reservations)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $encryptedAppNo = Crypt::encryptString($row->app_no);

                    return '<div class="flex gap-3">
                                <a href=' . route('admin.cee.exam-slip', ['app_no' => $encryptedAppNo]) . ' target="_blank" class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md size-8 bg-slate-100 text-slate-500 hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500"><i data-lucide="download" class="size-4"></i></a>
                                 <a href=' . route('admin.cee.result-slip', ['app_no' => $encryptedAppNo]) . ' target="_blank" class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md size-8 bg-slate-100 text-slate-500 hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500"><i data-lucide="file-digit" class="size-4"></i></a>
                        </div>';
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 'confirmed') {
                        return '  <span class="delivery_status px-2.5 py-0.5 text-xs inline-block font-medium rounded border bg-green-100 border-green-200 text-green-500 dark:bg-green-500/20 dark:border-green-500/20">Confirmed</span>';
                    } else {
                        return '-';
                    }
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
                                    <span class="delivery_status px-2.5 py-0.5 text-xs inline-block font-medium rounded border bg-sky-100 border-sky-200 text-sky-500 dark:bg-sky-500/20 dark:border-sky-500/20">' . $batch . '</span>
                                    <span class="delivery_status px-2.5 py-0.5 text-xs inline-block font-medium rounded border bg-purple-100 border-purple-200 text-purple-500 dark:bg-purple-500/20 dark:border-purple-500/20">' . $schedule . ' ( ' . $time . ' )</span>
                                 </div>
                            </div>';
                })

                ->addColumn('priority_programs', function ($query) {
                    $first = $query->firstpriorty_desc;
                    $second = $query->secondpriority_desc;
                    $third = $query->thirdpriorty_desc;
                    return '  <div class="flex items-center gap-2">
                                <div class="grow">
                                  <span class="mb-2 delivery_status px-2.5 py-0.5 text-xs inline-block font-medium rounded border bg-green-100 border-green-200 text-green-500 dark:bg-green-500/20 dark:border-green-500/20"> ' . $first . '</span><br>
                                    <span class="mb-2 delivery_status px-2.5 py-0.5 text-xs inline-block font-medium rounded border bg-sky-100 border-sky-200 text-sky-500 dark:bg-sky-500/20 dark:border-sky-500/20">' . $second . '</span> <br>
                                    <span class="mb-2 delivery_status px-2.5 py-0.5 text-xs inline-block font-medium rounded border bg-purple-100 border-purple-200 text-purple-500 dark:bg-purple-500/20 dark:border-purple-500/20">' . $third . '</span>
                                 </div>
                            </div>';
                })
                ->addColumn('date_created', function ($row) {
                    $datecreated = $row->created_at
                        ? Carbon::parse($row->created_at)->timezone('Asia/Manila')->format('F j, Y g:i A')
                        : 'N/A';
                    return $datecreated;
                })
                ->addColumn('ceesesionname', function ($row) {
                    return $row->ceesesionname;
                })

                ->rawColumns(['action', 'status', 'college_name', 'date_created','ceesesionname','priority_programs'])
                ->make(true);
        }
    }

    public function generateceeResultSlip(Request $request){

        $decryptapp_no = Crypt::decryptString($request->app_no);

        $ceeresult = DB::table('reservations')
        ->join('results', 'reservations.app_no', '=', 'results.app_no')
        ->join('users', 'reservations.user_id', '=', 'users.id')
        ->join('cee_sessions', 'reservations.cee_session_id', '=', 'cee_sessions.id')
        ->join('rooms', 'reservations.room_id', '=', 'rooms.id')
        ->where('reservations.app_no',$decryptapp_no)
        ->select(
            'reservations.user_id',
            'reservations.app_no',
            'reservations.firstpriorty_desc',
            'reservations.secondpriority_desc',
            'reservations.thirdpriorty_desc',
            'reservations.campus_id',
            'reservations.is_repeat_exam',
            'users.email',
            'users.sex',
            'users.phone',
            'users.photo',
            'users.birthdate',
            'results.fullname',
            'results.science',
            'results.math',
            'results.humanities',
            'results.inductive',
            'results.csa',
            'results.created_at',
            'cee_sessions.name',
            'rooms.schedule',
        )

        ->first();

         // Pass the base64 QR code string to the view for inclusion in the PDF
         $pdf = PDF::loadView('admin.result.result-slip', compact('ceeresult'));

         // Stream the PDF instead of downloading it
         return $pdf->stream("{$ceeresult->app_no}-usmcee-result.pdf");
    }


}
