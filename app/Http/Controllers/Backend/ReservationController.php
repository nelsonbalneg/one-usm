<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Room;
use App\Models\User;
use App\Models\CeeSession;
use App\Models\PastCeeData;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use App\Exports\ReservationconfirmedExport;
use App\Models\Term;

class ReservationController extends Controller
{
    public function index()
    {
        $ceeSessions = CeeSession::all();
        $activeSession = CeeSession::where('status', 'active')->first(); // Get active session
        return view("admin.reservation.reservation", compact('ceeSessions', 'activeSession'));
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('reservations')
                ->leftJoin('rooms', 'reservations.room_id', '=', 'rooms.id') //cee_session_id  cee_sessions
                ->leftJoin('users', 'reservations.user_id', '=', 'users.id')
                ->leftJoin('booklet_numbers', 'reservations.user_id', '=', 'booklet_numbers.user_id')
                ->leftJoin('cee_sessions', 'reservations.cee_session_id', '=', 'cee_sessions.id')
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
                    'reservations.cee_session_id',
                    'reservations.status',
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
                    'booklet_numbers.bookletNo',
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
                    $encryptedreid = Crypt::encryptString($row->id);

                    return
                        '<div class="flex gap-3">
                            <a href=' . route('admin.cee.exam-slip', ['app_no' => $encryptedAppNo]) . ' target="_blank" class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md size-8 bg-slate-100 text-slate-500 hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500"><i data-lucide="download" class="size-4"></i></a>
                            <a href=' . route('admin.cee.send.exam-slip', ['app_no' => $row->app_no]) . ' class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md send-email size-8 bg-slate-100 text-slate-500 hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500"><i data-lucide="mail" class="size-4"></i></a>
                            <a href=' . route('admin.reservation.reservation.edit', ['id' => $encryptedreid]) . ' target="_blank" class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md size-8 bg-slate-100 text-slate-500 hover:text-yellow-500 hover:bg-yellow-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500"><i data-lucide="pen" class="inline-block size-3"></i> </a>
                            <a href=' . route('admin.reservation.destroy', $row->id) . ' class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md delete-reservation size-8 bg-slate-100 text-slate-500 hover:text-red-500 hover:bg-red-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500"><i data-lucide="trash-2" class="size-4"></i></a>
                    </div>';

                })
                ->filterColumn('fullname', function ($query, $keyword) {
                    $query->whereRaw("CONCAT(users.firstname, ' ', users.lastname, ' ', ISNULL(users.suffix, '')) like ?", ["%{$keyword}%"])
                        ->orWhere('users.email', 'like', "%{$keyword}%")
                        ->orWhere('reservations.app_no', 'like', "%{$keyword}%");
                })
                ->addColumn('sessionId', function ($row) {
                    return $row->sessionId;
                })
                ->addColumn('bookletNo', function ($row) {

                    if ($row->bookletNo == null) {
                        return '<div class="flex gap-3">
                                    <a data-id=' . $row->user_id . '
                                    data-session-id=' . $row->cee_session_id . '
                                    data-app-no=' . $row->app_no . '
                                    class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md add_booklet_no size-8 bg-slate-100 text-slate-500 hover:text-green-500 hover:bg-green-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500">
                                    <i data-lucide="plus" class="size-4"></i>
                                    </a>
                                </div>';
                    } else {
                        return $row->bookletNo;
                    }
                })
                ->addColumn('is_repeat_exam', function ($query) {

                    if ($query->is_repeat_exam == 'Yes') {
                        $id = $query->id;
                        $switchId = 'greenDefaultSwitch_' . $id;

                        return '<div class="flex items-center justify-center">
                            <div class="relative inline-block w-10 align-middle transition duration-200 ease-in">
                                <input type="checkbox"
                                       data-id="' . $id . '"
                                       name="greenDefaultSwitch"
                                       id="' . $switchId . '"
                                       class="absolute block transition duration-300 ease-linear border-2 rounded-full appearance-none cursor-pointer change-status size-5 border-slate-200 dark:border-zink-500 bg-white/80 dark:bg-zink-400 peer/published checked:bg-white dark:checked:bg-white ltr:checked:right-0 rtl:checked:left-0 checked:border-green-500 dark:checked:border-green-500 arrow-none"
                                       checked>
                                <label for="' . $switchId . '"
                                       class="block h-5 overflow-hidden duration-300 ease-linear border rounded-full cursor-pointer border-slate-200 dark:border-zink-500 bg-slate-200 dark:bg-zink-600 peer-checked/published:bg-green-500 peer-checked/published:border-green-500"></label>
                            </div>
                        </div>';
                    } else {
                        $id = $query->id;
                        $switchId = 'greenDefaultSwitch_' . $id;

                        return '<div class="flex items-center justify-center">
                            <div class="relative inline-block w-10 align-middle transition duration-200 ease-in">
                                <input type="checkbox"
                                       data-id="' . $id . '"
                                       name="greenDefaultSwitch"
                                       id="' . $switchId . '"
                                       class="absolute block transition duration-300 ease-linear border-2 rounded-full appearance-none cursor-pointer change-status size-5 border-slate-200 dark:border-zink-500 bg-white/80 dark:bg-zink-400 peer/published checked:bg-white dark:checked:bg-white ltr:checked:right-0 rtl:checked:left-0 checked:border-green-500 dark:checked:border-green-500 arrow-none">
                                <label for="' . $switchId . '"
                                       class="block h-5 overflow-hidden duration-300 ease-linear border rounded-full cursor-pointer border-slate-200 dark:border-zink-500 bg-slate-200 dark:bg-zink-600 peer-checked/published:bg-green-500 peer-checked/published:border-green-500"></label>
                            </div>
                        </div>';
                    }
                })
                ->addColumn('college_name', function ($query) {
                    $room = $query->room_name;
                    $batch = $query->exam_session;
                    $schedule = $query->schedule ? Carbon::parse($query->schedule)->format('F j, Y') : 'N/A';
                    $time = $query->time;
                    $building = $query->college_name;
                    $cee_term = $query->cee_session_id;

                    return '  <div class="flex items-center gap-2">
                                <div class="grow">
                                 <h6 class="mb-1"><a href="#!" class="name">' . $query->campus . '</a></h6>
                                    <h6 class="mb-1"><a href="#!" class="name">' . $building . ' - ' . $room . '</a></h6>
                                    <span class="delivery_status px-2.5 py-0.5 text-xs inline-block font-medium rounded border bg-sky-100 border-sky-200 text-sky-500 dark:bg-sky-500/20 dark:border-sky-500/20">' . $cee_term . ' - ' . $batch . '</span>
                                    <span class="delivery_status px-2.5 py-0.5 text-xs inline-block font-medium rounded border bg-purple-100 border-purple-200 text-purple-500 dark:bg-purple-500/20 dark:border-purple-500/20">' . $schedule . ' ( ' . $time . ' )</span>
                                 </div>
                            </div>';
                })
                ->addColumn('fullname', function ($query) {
                    $app_no = $query->app_no;
                    $fullname = strtoupper($query->fullname);
                    $email = $query->email;
                    return '  <div class="flex items-center gap-2">
                                <div class="grow">
                                 <h6 class="mb-1">' . $app_no . '</h6>
                                   <h6 class="mb-1">' . $fullname . '</h6>
                                 <span class="delivery_status px-2.5 py-0.5 text-xs inline-block font-medium rounded border bg-green-100 border-green-200 text-green-500 dark:bg-green-500/20 dark:border-green-500/20"> ' . $email . '</span>
                                 </div>
                            </div>';
                })
                ->addColumn('status', function ($query) {
                    return '<select class="form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                onchange="updateStatus(' . $query->id . ', this.value)">
                                <option value="pending" ' . ($query->status == 'pending' ? 'selected' : '') . '>Pending</option>
                                <option value="confirmed" ' . ($query->status == 'confirmed' ? 'selected' : '') . '>Confirm</option>
                                <option value="cancelled" ' . ($query->status == 'cancelled' ? 'selected' : '') . '>Cancel</option>
                            </select>';
                })
                ->rawColumns(['status', 'fullname', 'action', 'college_name', 'sessionId', 'is_repeat_exam', 'bookletNo'])
                ->make(true);
        }
    }

    public function destroy(string $id)
    {
        // $reservation = Reservation::findOrFail($id);
        // $roomcurrcap = $reservation->capacity;

        // // Retrieve the room based on the room_id from the reservation
        // $room = Room::find($reservation->room_id);
        // if ($room) {
        //     // Increment the room's capacity by 1
        //     $room->capacity = $roomcurrcap + 1;
        //     $room->save();
        // }

        // $reservation->delete();
        // return response(['status' => 'success', 'message' => 'Deleted successfully!']);

        $reservation = Reservation::findOrFail($id);

        // Retrieve room
        $room = Room::findOrFail($reservation->room_id);

        // Add back the reservation capacity to the room
        $room->capacity += $reservation->capacity;  // increment properly
        $room->save();

        $reservation->delete();

        return response([
            'status' => 'success',
            'message' => 'Deleted successfully!'
        ]);
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


    public function updateCEEType(Request $request)
    {

        $examinee_type = Reservation::findOrFail($request->id);
        $examinee_type->is_repeat_exam = $request->status == 'true' ? 'Yes' : 'No';
        $examinee_type->save();

        return response(['message' => 'Examinee type has been updated']);
    }

    public function exportConfirmedReservations()
    {
        return Excel::download(new ReservationconfirmedExport, 'cee-confirmed_reservations.xlsx');
    }

    public function checkifRetaker(Request $request)
    {

        $request->validate([
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'birthdate' => 'required|date',
        ]);

        // Check if the user exists in PastCeeData
        $isRetaker = PastCeeData::where('firstname', $request->firstname)
            ->where('lastname', $request->lastname)
            ->where('birthdate', $request->birthdate)
            ->exists();

        return response()->json([
            'isRetaker' => $isRetaker,
        ]);
    }

    public function createReservationindex(Request $request)
    {

        $response = Http::get('http://172.16.0.60/academic/api/v2/Campus/list');

        if ($response->successful()) {

            $campusList = collect($response->json())->filter(function ($campus) {
                return $campus['campusName'] !== 'USM-ULS';
            })->values()->all();
        } else {

            $campusList = [];
        }

        $users = DB::table('users')
            ->select(
                DB::raw("CONCAT(users.lastname, ', ', users.firstname, ' ', COALESCE(users.middlename, ''), ' ', COALESCE(users.suffix, '')) AS fullname"),
                'users.lrn',
                'users.id',
                'users.lastname',
                'users.firstname',
                'users.birthdate',
                'cee_sessions.name as session_name',
                'cee_sessions.id as session_id'
            )
            ->join('cee_sessions', 'cee_sessions.id', '=', 'users.exam_session_id') // inner join
            ->where('users.lrn', '!=', '')
            ->where('cee_sessions.status', 'active') // only active sessions
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('reservations')
                    ->whereColumn('reservations.user_id', 'users.id')
                    ->where('reservations.status', '!=', 'cancelled');
            })
            ->get();
        // dd($users);


        $campusNames = Term::where('is_active', 1)->get();

        $ceeSession = CeeSession::where('status', 'active')->first();

        return view('admin.reservation.create-reservation', compact('ceeSession', 'campusList', 'users', 'campusNames'));
    }

    public function editReservationindex(Request $request)
    {
        $decryptedId = Crypt::decryptString($request->id);
        $reservation = DB::table('reservations')
            ->leftJoin('users', 'reservations.user_id', '=', 'users.id')
            ->leftJoin('rooms', 'reservations.room_id', '=', 'rooms.id')
            ->leftJoin('cee_sessions', 'reservations.cee_session_id', '=', 'cee_sessions.id')
            ->select(
                'reservations.app_no',
                'reservations.id',
                'reservations.firstpriorty',
                'reservations.firstpriorty_desc',
                'reservations.secondpriorty',
                'reservations.secondpriority_desc',
                'reservations.thirdpriorty',
                'reservations.thirdpriorty_desc',
                'reservations.campus_id',
                'reservations.campus_id_prio_prog_2',
                'reservations.campus_id_prio_prog_3',
                'rooms.room_name',
                'rooms.college_name',
                'rooms.schedule',
                'cee_sessions.name AS cee_term_name',
                DB::raw("CONCAT(users.lastname, ', ', users.firstname, ' ', ISNULL(users.middlename, ''), ' ', ISNULL(users.suffix, '')) AS fullname")
            )
            ->where('reservations.id', $decryptedId)
            ->first();

        $campusNames = Term::where('is_active', 1)->get();

        return view('admin.reservation.edit-reservation', compact('reservation', 'campusNames'));
    }

    public function updateReservationindex(Request $request, string $id)
    {
        $request->validate([

            'campus' => 'required|string|max:100',
            'firstprioprog' => 'required|string|max:100',
            'secondprioprog' => 'required|string|max:100',
            'thirdprioprog' => 'required|string|max:100',
        ]);

        $application = Reservation::findOrFail($id);
        $application->campus_id = trim($request->campus);
        $application->campus_id_prio_prog_2 = trim($request->campus2);
        $application->campus_id_prio_prog_3 = trim($request->campus3);
        $application->firstpriorty = trim($request->firstprioprog);
        $application->firstpriorty_desc = trim($request->firstprioprog_desc);
        $application->secondpriorty = trim($request->secondprioprog);
        $application->secondpriority_desc = trim($request->secondprioprog_desc);
        $application->thirdpriorty = trim($request->thirdprioprog);
        $application->thirdpriorty_desc = trim($request->thirdprioprog_desc);
        $application->firstprogram_policy_id = trim($request->firstprogram_policy_id ?? '');
        $application->secondprogram_policy_id = trim($request->secondprogram_policy_id ?? '');
        $application->thirdprogram_policy_id = trim($request->thirdprogram_policy_id ?? '');
        $application->save();

        return redirect()->back()->with([
            'message' => 'Update reservation Successful.',
            'status' => 'success'
        ]);
    }

    public function getProgramByRealCampusId(Request $request)
    {

        $termId = $request->query('termId');
        $realCampusId = $request->query('realCampusId');



        // Validate parameters
        if (!$termId || !$realCampusId) {
            return response()->json(['error' => 'Missing termId or realCampusId'], 400);
        }

        $cacheKey = "program_policies_{$termId}_{$realCampusId}";

        $programs = Cache::remember($cacheKey, now()->addHour(), function () use ($termId, $realCampusId) {
            try {
                // Make the API call with timeout
                $response = Http::timeout(10)->get("http://172.16.0.60/academic/api/v2/ProgramPolicies/cee-list/term/{$termId}/realcampus/{$realCampusId}");

                if ($response->successful()) {
                    return $response->json();
                } else {
                    // Log unsuccessful responses for debugging
                    Log::error('Failed API response from ProgramPolicies', [
                        'url' => $response->effectiveUri(),
                        'status' => $response->status(),
                        'body' => $response->body(),
                    ]);
                    return null;
                }
            } catch (\Exception $e) {
                // Log exceptions during API call
                Log::error('Exception during API fetch', [
                    'message' => $e->getMessage(),
                    'termId' => $termId,
                    'realCampusId' => $realCampusId,
                ]);
                return null;
            }
        });

        // Return JSON with proper structure and status
        return response()->json(
            is_array($programs) ? $programs : ['error' => 'Failed to fetch programs'],
            is_array($programs) ? 200 : 500
        );
    }

    public function resgetRoomsByExamSession(Request $request)
    {
        $session = $request->input('ceesession');

        // Get the active cee session
        $activeSession = CeeSession::where('status', 'active')->first();

        // Check if an active session exists
        if (!$activeSession) {
            return response()->json(['error' => 'No active CEE session found'], 404);
        }

        // Retrieve rooms based on session
        $rooms = Room::where('exam_session', $session)
            ->where('capacity', '>', 0)
            ->where('cee_session_id', $activeSession->id) // Use ID, not status
            ->get(['id', 'room_name', 'capacity', 'college_name', 'status']);

        return response()->json($rooms);
    }
    public function store(Request $request)
    {
        $request->validate([
            'ceesession' => 'required|integer',
            'campus' => 'required|string|max:100',
            'firstprioprog' => 'required|string|max:100',
            'secondprioprog' => 'required|string|max:100',
            'thirdprioprog' => 'required|string|max:100',
            'ceeexamsession' => 'required|string|max:50',
            'room' => 'required|string|max:100',
        ]);

        //userid holder
        $userid = $request->user;
        $userfullname = $request->fullname;

        //check if record exists
        $isReserved = Reservation::where('user_id', $userid)
            ->where('status', 'confirmed')->exists();
        if ($isReserved) {
            return redirect()->back()->with([
                'message' => 'You have reserved a slot already!',
                'status' => 'error'
            ]);
        }

        // Check room availability
        $checkifzero = Room::where('exam_session', $request->room)
            ->where('status', 'active')
            ->where('capacity', '<=', 0)
            ->exists();

        if ($checkifzero) {
            return redirect()->back()->with([
                'message' => 'We are sorry! No more slots are available for this room. Please select a different session or room.',
                'status' => 'error'
            ]);
        } else {
            $userId = $userid; //change to the userid from request
            $ceeSession = $request->ceesession;
            $lastRow = Reservation::find(Reservation::max('id'));
            $lastId = $lastRow ? $lastRow->id : 0; // If no rows, start with 0

            //Format the date
            $formattedDate = Carbon::parse($request->created_at)->format('y');

            //Concatenate the formatted date with the last ID incremented by 1
            $appno = 'CEE-' . $formattedDate . $userId . $ceeSession . ($lastId + 1);

            $checkifzero = Room::where('id', $request->room)
                ->where('status', 'active')
                ->where('capacity', '<=', 0)
                ->exists();

            if ($checkifzero) {
                return redirect()->back()->with([
                    'message' => 'We are sorry! No more slots are available for this room. Please select a different session or room.',
                    'status' => 'error'
                ]);
            }

            $application = new Reservation();
            $application->cee_session_id = trim($ceeSession);
            $application->user_id = trim($userId);
            $application->app_no = trim($appno);
            $application->campus_id = trim($request->campus);
            $application->campus_id_prio_prog_2 = trim($request->campus2);
            $application->campus_id_prio_prog_3 = trim($request->campus3);
            $application->firstpriorty = trim($request->firstprioprog);
            $application->firstpriorty_desc = trim($request->firstprioprog_desc);
            $application->secondpriorty = trim($request->secondprioprog);
            $application->secondpriority_desc = trim($request->secondprioprog_desc);
            $application->thirdpriorty = trim($request->thirdprioprog);
            $application->thirdpriorty_desc = trim($request->thirdprioprog_desc);
            $application->firstprogram_policy_id = trim($request->firstprogram_policy_id ?? '');
            $application->secondprogram_policy_id = trim($request->secondprogram_policy_id ?? '');
            $application->thirdprogram_policy_id = trim($request->thirdprogram_policy_id ?? '');
            $application->exam_session = trim($request->ceeexamsession);
            $application->room_id = trim($request->room);
            $application->is_repeat_exam = trim($request->is_repeat_exam);
            $application->save();

            // Update room quantity
            $room = Room::findOrFail($request->room);
            $roomCap = $room->capacity;
            $newRoomcap = $roomCap - 1;
            $room->capacity = $newRoomcap;
            $room->save();
        }

        return redirect()->back()->with([
            'message' => 'USMCEE Slot reservation Successful.',
            'status' => 'success'
        ]);
    }

    public function getConfirmResDataindex()
    {
        return view('admin.reservation.confirm-reservation');
    }

    public function getConfirmResData(Request $request)
    {
        if ($request->ajax()) {

            $data = DB::table('reservations')
                ->leftJoin('rooms', 'reservations.room_id', '=', 'rooms.id') //cee_session_id  cee_sessions
                ->leftJoin('users', 'reservations.user_id', '=', 'users.id')
                ->leftJoin('cee_sessions', 'reservations.cee_session_id', '=', 'cee_sessions.id')
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
                // ->where('cee_sessions.status', 'active')
                ->where('reservations.status', 'confirmed');

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $encryptedAppNo = Crypt::encryptString($row->app_no);
                    return '<div class="flex gap-3">
                                <a href=' . route('admin.cee.exam-slip', ['app_no' => $encryptedAppNo]) . ' target="_blank" class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md size-8 bg-slate-100 text-slate-500 hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500"><i data-lucide="download" class="size-4"></i></a>
                                <a data-id=' . $row->id . ' class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md view-detail size-8 bg-slate-100 text-slate-500 hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500"><i data-lucide="eye" class="inline-block size-3"></i> </a>
                        </div>';
                })
                ->filterColumn('fullname', function ($query, $keyword) {
                    $query->whereRaw("CONCAT(users.firstname, ' ', users.lastname, ' ', ISNULL(users.suffix, '')) like ?", ["%{$keyword}%"])
                        ->orWhere('users.email', 'like', "%{$keyword}%");
                })
                ->addColumn('sessionId', function ($row) {
                    return $row->sessionId;
                })
                ->addColumn('is_repeat_exam', function ($query) {
                    if ($query->is_repeat_exam == 'Yes') {
                        $id = $query->id;
                        $switchId = 'greenDefaultSwitch_' . $id;

                        return '<div class="flex items-center justify-center">
                            <div class="relative inline-block w-10 align-middle transition duration-200 ease-in">
                                <input type="checkbox"
                                       data-id="' . $id . '"
                                       name="greenDefaultSwitch"
                                       id="' . $switchId . '"
                                       class="absolute block transition duration-300 ease-linear border-2 rounded-full appearance-none cursor-pointer change-status size-5 border-slate-200 dark:border-zink-500 bg-white/80 dark:bg-zink-400 peer/published checked:bg-white dark:checked:bg-white ltr:checked:right-0 rtl:checked:left-0 checked:border-green-500 dark:checked:border-green-500 arrow-none"
                                       checked>
                                <label for="' . $switchId . '"
                                       class="block h-5 overflow-hidden duration-300 ease-linear border rounded-full cursor-pointer border-slate-200 dark:border-zink-500 bg-slate-200 dark:bg-zink-600 peer-checked/published:bg-green-500 peer-checked/published:border-green-500"></label>
                            </div>
                        </div>';
                    } else {
                        $id = $query->id;
                        $switchId = 'greenDefaultSwitch_' . $id;

                        return '<div class="flex items-center justify-center">
                            <div class="relative inline-block w-10 align-middle transition duration-200 ease-in">
                                <input type="checkbox"
                                       data-id="' . $id . '"
                                       name="greenDefaultSwitch"
                                       id="' . $switchId . '"
                                       class="absolute block transition duration-300 ease-linear border-2 rounded-full appearance-none cursor-pointer change-status size-5 border-slate-200 dark:border-zink-500 bg-white/80 dark:bg-zink-400 peer/published checked:bg-white dark:checked:bg-white ltr:checked:right-0 rtl:checked:left-0 checked:border-green-500 dark:checked:border-green-500 arrow-none">
                                <label for="' . $switchId . '"
                                       class="block h-5 overflow-hidden duration-300 ease-linear border rounded-full cursor-pointer border-slate-200 dark:border-zink-500 bg-slate-200 dark:bg-zink-600 peer-checked/published:bg-green-500 peer-checked/published:border-green-500"></label>
                            </div>
                        </div>';
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
                ->rawColumns(['status', 'fullname', 'action', 'college_name', 'sessionId', 'is_repeat_exam'])
                ->make(true);
        }
    }

    public function updateStatus(Request $request)
    {
        $reservation = Reservation::find($request->id);

        if (!$reservation) {
            return response()->json(['message' => 'Reservation not found'], 404);
        }

        $reservation->status = $request->status;
        $reservation->save();

        return response()->json(['message' => 'Reservation status updated successfully!']);
    }


}
