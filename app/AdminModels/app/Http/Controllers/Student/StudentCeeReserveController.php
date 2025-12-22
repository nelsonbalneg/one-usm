<?php

namespace App\Http\Controllers\Student;

use App\Models\Room;
use App\Models\CeeSession;
use App\Models\PastCeeData;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class StudentCeeReserveController extends Controller
{


    public function index()
    {
        $response = Http::get('http://172.16.0.60/academic/api/v2/Campus/list');

        if ($response->successful()) {

            $campusList = collect($response->json())->filter(function ($campus) {
                return $campus['campusName'] !== 'USM-ULS';
            })->values()->all();
        } else {

            $campusList = [];
        }

        $firstname = Auth::user()->firstname;
        $lastname = Auth::user()->lastname;
        $birthdate = Auth::user()->birthdate;

        $ceeSession = CeeSession::where('status', 'active')->first();
        $application = Reservation::where('user_id', Auth::user()->id)->exists();
        $existingReservation = Reservation::where('user_id', Auth::user()->id)->first();

        //check if name exist in the past cee data session
        $isRetaker = PastCeeData::where('firstname', $firstname)
            ->where('lastname', $lastname)
            ->where('birthdate', $birthdate)
            ->exists();

        return view("student.reserve.reserve", compact('ceeSession', 'campusList', 'application', 'existingReservation', 'isRetaker'));
    }

    public function getProgramsByTenant(Request $request)
    {

        $tenantId = $request->query('tenantId');

        if (!$tenantId) {
            return response()->json(['error' => 'Tenant ID is required'], 400);
        }

        try {
            // Make the HTTP request with a timeout of 10 seconds
            $response = Http::timeout(10)->get("http://172.16.0.60/academic/api/v2/Programs/list", [
                'tenantId' => $tenantId
            ]);

            if ($response->successful()) {
                $programs = collect($response->json());
                $filteredPrograms = $programs->filter(function ($program) {
                    return !str_contains($program['progName'], 'Master') && !str_contains($program['progName'], 'Doctor') && !str_contains($program['progName'], 'Default');
                })->values();

                return response()->json($filteredPrograms);
            }

            return response()->json(['error' => 'Unable to fetch programs'], 500);

        } catch (\Illuminate\Http\Client\RequestException $e) {
            return response()->view('errors.500', [], 500);
        }
    }

    public function getProgramByRealCampusId(Request $request)
    {
        $termId = $request->query('termId');
        $realCampusId = $request->query('realCampusId');

        // Define a unique cache key based on termId and realCampusId
        $cacheKey = "program_policies_{$termId}_{$realCampusId}";

        // Cache the response for 60 minutes
        $programs = Cache::remember($cacheKey, 60, function () use ($termId, $realCampusId) {
            $response = Http::get("http://172.16.0.60/academic/api/v2/ProgramPolicies/list/term/{$termId}/realcampus/{$realCampusId}");

            if ($response->successful()) {
                return collect($response->json());
            } else {
                // Handle the case where the API request was unsuccessful
                return null; // Return null if the request fails
            }
        });

        if ($programs) {
            return response()->json($programs);
        } else {
            return response()->json(['error' => 'Failed to fetch programs'], 500);
        }
    }

    public function getRoomsByExamSession(Request $request)
    {
        $session = $request->input('ceesession');

        // Retrieve rooms based on session
        $rooms = Room::where('exam_session', $session)
            ->where('status', 'active')
            ->where('capacity', '>', 0)
            ->get(['id', 'room_name', 'capacity', 'college_name']);

        return response()->json($rooms);
    }


    public function getCampusList()
    {
        // $response = Http::get('http://172.16.0.60/academic/api/v1/Campus/list');

        // if ($response->successful()) {
        //     // Assuming the API returns a JSON response with a data array
        //     $campusList = $response->json();
        // } else {
        //     // Handle the error
        //     $campusList = [];
        // }
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

        //check if record exists
        $isReserved = Reservation::where('user_id', Auth::user()->id)->exists();
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
            $userId = Auth::user()->id;
            $ceeSession = $request->ceesession;
            $lastRow = Reservation::find(Reservation::max('id'));
            $lastId = $lastRow ? $lastRow->id : 0; // If no rows, start with 0

            // Format the date
            $formattedDate = Carbon::parse($request->created_at)->format('Ymd');

            // Concatenate the formatted date with the last ID incremented by 1
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
            'message' => 'Congratulations! USMCEE Slot reservation Successful.',
            'status' => 'success'
        ]);
    }

}
