<?php

namespace App\Http\Controllers\Backend;

use App\Models\Room;
use App\Models\CeeSession;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Support\Facades\Cache;

class RoomsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ceeSessions = CeeSession::all();
        $activeSession = CeeSession::where('status', 'active')->first(); // Get active session
        return view('admin.rooms.rooms', compact('activeSession', 'ceeSessions'));
    }

    public function getallRooms(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('rooms')
                ->leftJoin('reservations', 'rooms.id', '=', 'reservations.room_id')
                ->leftJoin('cee_sessions', 'rooms.cee_session_id', '=', 'cee_sessions.id')
                ->select(
                    'rooms.id',
                    'rooms.college_name',
                    'rooms.room_name',
                    'rooms.capacity',
                    'rooms.status',
                    'rooms.exam_session',
                    'rooms.schedule',
                    'rooms.time',
                    'rooms.sequence_no',
                    'rooms.created_at',
                    DB::raw('COUNT(reservations.id) AS total_reservations') // Count reservations per room
                )
                ->when($request->cee_session_id, function ($query) use ($request) {
                    return $query->where('rooms.cee_session_id', $request->cee_session_id);
                })
                ->groupBy(
                    'rooms.id',
                    'rooms.college_name',
                    'rooms.room_name',
                    'rooms.capacity',
                    'rooms.status',
                    'rooms.exam_session',
                    'rooms.schedule',
                    'rooms.time',
                    'rooms.sequence_no',
                    'rooms.created_at'
                ) // Grouping by all selected columns
                ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return ' <div class="flex gap-3">
                         <a data-id=' . $row->id . '  class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md add-slot size-8 edit-item-btn bg-slate-100 text-slate-500 hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500"><i data-lucide="plus" class="size-4"></i></a>
                         <a data-id=' . $row->id . ' class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md edit-entry size-8 bg-slate-100 text-slate-500 hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500"><i data-lucide="pen" class="inline-block size-3"></i> </a>
                         <a href=' . route('admin.rooms.destroy', $row->id) . ' class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md delete-entry size-8 bg-slate-100 text-slate-500 hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500"><i data-lucide="trash-2" class="size-4"></i></a>
                    </div>';
                })
                ->addColumn('status', function ($query) {

                    if ($query->status == 'active') {
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
                ->addColumn('capacity', function ($row) {
                    if ($row->capacity != 0) {
                        return ' <span class="flex items-center justify-center text-xs font-medium border border-transparent rounded size-8 bg-custom-100 text-custom-500 dark:bg-custom-500/20 dark:border-transparent">' . $row->capacity . '</span>';
                    } else {
                        return '<span class="flex items-center justify-center text-xs font-medium text-red-500 bg-red-100 border border-red-500 rounded size-8 dark:bg-red-500/20 dark:border-red-500">' . $row->capacity . '</span>';
                    }
                })
                ->rawColumns(['action', 'status', 'capacity'])
                ->make(true);
        }
        // In case of a non-AJAX request, return an error or appropriate response.
        return response()->json(['error' => 'Invalid request'], 400);
    }

    public function changeStatus(Request $request)
    {
        $checklistTemplate = Room::findOrFail($request->id);
        $checklistTemplate->status = $request->status == 'true' ? 'active' : 'inactive';
        $checklistTemplate->save();

        return response(['message' => 'Status has been updated']);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'campus' => ['required', 'max:255'],
                'college_name' => ['required', 'max:255'],
                'room_name' => ['required', 'max:255'],
                'batch' => ['required', 'max:255'],
                'capacity' => ['required', 'numeric', 'min:1'],
                'schedule' => ['required'],
                'time' => ['required'],
                'sequence_no' => ['required', 'integer', 'min:0']
            ]
        );

        //get the active cee_session_id
        $cee_session_id_active = CeeSession::where('status', 'active')->pluck('id')->first();

        $room = new Room;
        $room->campus = $request->campus;
        $room->college_name = $request->college_name;
        $room->room_name = $request->room_name;
        $room->exam_session = $request->batch;
        $room->capacity = $request->capacity;
        $room->schedule = $request->schedule;
        $room->time = $request->time;
        $room->cee_session_id = $cee_session_id_active;
        $room->status = 'inactive';
        $room->sequence_no = $request->sequence_no;
        $room->save();

        // Return a response
        return response()->json([
            'success' => true,
            'message' => 'New Room added successfully!',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $room = Room::findOrFail($id);
        return response()->json([
            'room' => $room
        ]);
    }

    public function addSlot(Request $request, $id)
    {
        $request->validate(
            [
                'capacity' => ['required', 'numeric', 'min:1'],
            ]
        );


        $room = Room::findOrFail($id);

        //get the current room capacity
        $curr_room_capacity = $room->capacity;
        $slot_to_add = $request->capacity;
        $total = $curr_room_capacity + $slot_to_add;

        $room->capacity = $total;
        $room->save();

        return response()->json([
            'success' => true,
            'message' => 'New Slot Added Successfully!',
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'campus' => ['required', 'max:255'],
                'college_name' => ['required', 'max:255'],
                'room_name' => ['required', 'max:255'],
                'batch' => ['required', 'max:255'],
                'capacity' => ['required', 'numeric', 'min:1'],
                'schedule' => ['required'],
                'time' => ['required'],
                'sequence_no' => ['required', 'integer', 'min:0']
            ]
        );

        $room = Room::findOrFail($id);
        $room->campus = $request->campus;
        $room->college_name = $request->college_name;
        $room->room_name = $request->room_name;
        $room->exam_session = $request->batch;
        $room->capacity = $request->capacity;
        $room->schedule = $request->schedule;
        $room->time = $request->time;
        $room->sequence_no = $request->sequence_no;
        $room->save();

        // Return a response
        return response()->json([
            'success' => true,
            'message' => 'Room details updated successfully!',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $room = Room::findOrFail($id);

        // Retrieve the room based on the room_id from the reservation
        $isRoomExistInReservation = Reservation::where('room_id', $room->id)->exists();
        if ($isRoomExistInReservation) {
            return response(['status' => 'error', 'message' => 'Room cannot be deleted because it is in use!']);
        } else {
            $room->delete();
            return response(['status' => 'success', 'message' => 'Deleted successfully!']);
        }

    }

    public function viewRooms(Request $request)
    {
        $ceeSessions = CeeSession::all();
        $activeSession = CeeSession::where('status', 'active')->first(); // Get active session
        $search = $request->input('search');

        $rooms = DB::table('rooms')
                ->leftJoin('reservations', 'rooms.id', '=', 'reservations.room_id')
                ->leftJoin('cee_sessions', 'rooms.cee_session_id', '=', 'cee_sessions.id')
                ->select(
                    'rooms.id',
                    'rooms.college_name',
                    'rooms.room_name',
                    'rooms.capacity',
                    'rooms.status',
                    'rooms.exam_session',
                    'rooms.schedule',
                    'rooms.time',
                    'rooms.sequence_no',
                    'rooms.created_at',
                    'rooms.map_file',
                    'rooms.cee_session_id',
                    DB::raw('COUNT(reservations.id) AS total_reservations') // Count reservations per room
                )
                ->where('cee_sessions.status', 'active')
                ->when($search, function ($query, $search) {
                    return $query->where(function ($query) use ($search) {
                        $query->where('rooms.room_name', 'like', "%{$search}%")
                              ->orWhere('rooms.college_name', 'like', "%{$search}%")
                              ->orWhere('rooms.exam_session', 'like', "%{$search}%");
                    });
                })
                ->groupBy(
                    'rooms.id',
                    'rooms.college_name',
                    'rooms.room_name',
                    'rooms.capacity',
                    'rooms.status',
                    'rooms.exam_session',
                    'rooms.schedule',
                    'rooms.time',
                    'rooms.sequence_no',
                    'rooms.created_at',
                    'rooms.map_file',
                    'rooms.cee_session_id',
                ) // Grouping by all selected columns
                ->paginate(16); // Paginate with 16 per page
        return view('admin.rooms.view-rooms', compact('activeSession', 'ceeSessions', 'rooms'));
    }
    public function getAvailableSlots()
    {
        $rooms = Room::leftJoin('reservations', 'rooms.id', '=', 'reservations.room_id')
            ->select(
                'rooms.id',
                'rooms.capacity',
                DB::raw('COUNT(reservations.id) AS total_reservations')
            )
            ->groupBy('rooms.id', 'rooms.capacity')
            ->get();

        return response()->json($rooms);
    }
}
