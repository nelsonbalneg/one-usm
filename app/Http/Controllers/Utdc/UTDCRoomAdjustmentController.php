<?php

namespace App\Http\Controllers\Utdc;

use App\Models\Room;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Mail\RoomStatusNotification;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;

class UTDCRoomAdjustmentController extends Controller
{
    public function index(Request $request)
    {
        $room = Room::findOrFail($request->roomId);
        return view('utdc.rooms.room-adjustment', compact('room'));
    }


    public function getData(Request $request)
    {
        if ($request->ajax()) {

            $roomId = $request->get('roomid');

            $data = DB::table('reservations')
                ->join('cee_sessions', 'reservations.cee_session_id', '=', 'cee_sessions.id')
                ->join('users', 'reservations.user_id', '=', 'users.id')
                ->join('rooms', 'reservations.room_id', '=', 'rooms.id')
                ->select(
                    'reservations.*',
                    'cee_sessions.id as cee_session_id',
                    'cee_sessions.name as cee_session_name',
                    'cee_sessions.status',
                    'rooms.id as room_id',
                    'rooms.room_name',
                    'rooms.college_name',
                    'rooms.capacity',
                    'rooms.exam_session',
                    'rooms.campus',
                    'rooms.time',
                    'rooms.schedule',
                    'users.email',
                    DB::raw("CONCAT(users.lastname, ', ', users.firstname, ' ', ISNULL(users.middlename, ''), ' ', ISNULL(users.suffix, '')) AS fullname")
                )
                ->where('reservations.room_id', $roomId)
                ->where('cee_sessions.status', 'active')
                ->orderBy('fullname', 'asc')  // Sort by lastname in ascending order
                ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '<div class="flex gap-3">
                                        <a data-id=' . $row->id . ' class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md adjust-room size-8 bg-slate-100 text-slate-500 hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500"><i data-lucide="arrow-right-left" class="size-4"></i></a>
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
                ->addColumn('sessionId', function ($row) {
                    return $row->cee_session_id;
                })
                ->rawColumns(['action', 'fullname'])
                ->make(true);
        }
    }

    public function getRoomsByExamSession(Request $request)
    {
        $session = $request->input('ceesession');

        // Retrieve rooms based on session
        $rooms = Room::where('exam_session', $session)
            //->where('status', 'active')
            ->where('capacity', '>', 0)
            ->get(['id', 'room_name', 'capacity', 'college_name', 'status']);

        return response()->json($rooms);
    }

    public function edit(string $id)
    {
        $reservationDetails = Reservation::findOrFail($id);
        return response()->json([
            'reservationDetails' => $reservationDetails
        ]);
    }

    public function update(Request $request, string $id)
    {

        $reservationDetails = Reservation::findOrFail($id);

        //retrieve the old room id to icrement the capacity to 1
        $old_room_id = $reservationDetails->room_id;

        $oldroom = Room::findOrFail($old_room_id);
        $oldroomCap = $oldroom->capacity;
        $newRoomcap = $oldroomCap + 1;
        $oldroom->capacity = $newRoomcap;
        $oldroom->save();

        $request->validate(
            [
                'room' => 'required|string|max:100',
            ]
        );

        $reservationDetails->room_id = trim($request->room);
        $reservationDetails->save();

        //update new room cap after successful re-assignment
        $newroom = Room::findOrFail($request->room);
        $newroomCap = $newroom->capacity;
        $roomcap = $newroomCap - 1;
        $newroom->capacity = $roomcap;
        $newroom->save();

        // Fetch the user details
        $data = DB::table('reservations')
            ->leftJoin('rooms', 'reservations.room_id', '=', 'rooms.id')
            ->leftJoin('users', 'reservations.user_id', '=', 'users.id')
            ->select(
                'rooms.room_name',
                'rooms.college_name',
                'rooms.capacity',
                'rooms.exam_session',
                'rooms.campus',
                'rooms.time',
                'rooms.schedule',
                'rooms.exam_session',
                'users.email',
                DB::raw("CONCAT(users.lastname, ', ', users.firstname, ' ', COALESCE(users.middlename, ''), ' ', COALESCE(users.suffix, '')) AS fullname")
            )
            ->where('reservations.id', operator: $id) // Ensure you're targeting the right reservation
            ->first(); // Fetch only one record

        if (!$data || empty($data->email)) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to send email: Email address not found.',
            ], 400);
        }

        // Send the email
        Mail::to($data->email)->queue(new RoomStatusNotification((array) $data)); // Cast $data to an array

        // Return a response
        return response()->json([
            'success' => true,
            'message' => 'Room re-assignment successful!',
        ]);
    }
}

