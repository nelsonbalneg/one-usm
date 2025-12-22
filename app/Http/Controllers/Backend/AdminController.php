<?php

namespace App\Http\Controllers\Backend;

use App\Models\Room;
use App\Models\User;
use App\Models\CeeSession;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function dashboard()
    {

        $ceesessionactive = CeeSession::where('status', 'active')->first();

        $reg_user = DB::table('users')
            ->leftJoin('cee_sessions', 'users.exam_session_id', '=', 'cee_sessions.id')
            ->select(
                DB::raw('COUNT(users.id) as user_count')
            )
            ->where('cee_sessions.status', '=', 'active')
            ->first();

        // Access the property correctly
        $userCount = $reg_user->user_count ?? 0; // Provide a default if null

        // Define the online timeframe (e.g., last 5 minutes)
        $onlineThreshold = Carbon::now()->subMinutes(5);
        $onlineUserCount = User::where('last_seen', '>=', $onlineThreshold)->count();


        $activeslots = DB::table('rooms')
            ->leftJoin('cee_sessions', 'rooms.cee_session_id', '=', 'cee_sessions.id')
            ->where('cee_sessions.status', 'active')
            ->where('rooms.status', 'active')
            ->where('rooms.capacity', 0)
            ->count();

        $activerooms = DB::table('rooms')
            ->leftJoin('cee_sessions', 'rooms.cee_session_id', '=', 'cee_sessions.id')
            ->where('cee_sessions.status', 'active')
            ->where('rooms.status', 'active')
            ->where('rooms.capacity', '>', 0)
            ->count();



        // $sexStatistics = User::select('sex', DB::raw('count(*) as total'))
        //     ->whereNotNull('sex')
        //     ->where('sex', '!=', '')
        //     ->groupBy('sex')
        //     ->pluck('total', 'sex')
        //     ->toArray();

        $sexStatistics = User::select('cee_sessions.name as session_name', 'users.sex', DB::raw('COUNT(*) as total'))
            ->leftJoin('cee_sessions', 'users.exam_session_id', '=', 'cee_sessions.id')
            ->whereNotNull('users.sex')
            ->where('users.sex', '!=', '')
            ->groupBy('cee_sessions.name', 'users.sex')
            ->get()
            ->groupBy('session_name')
            ->map(function ($group) {
                $male = $group->firstWhere('sex', 'Male')->total ?? 0;
                $female = $group->firstWhere('sex', 'Female')->total ?? 0;
                $total = $male + $female;

                return [
                    'male' => $male,
                    'female' => $female,
                    'total' => $total,
                ];
            });



        $reservationDataByCEESession = DB::table('reservations')
            ->leftJoin('cee_sessions', 'reservations.cee_session_id', '=', 'cee_sessions.id')
            ->select(
                DB::raw('COUNT(reservations.id) as reservation_count')
            )
            ->where('cee_sessions.status', '=', 'active')->first();

        return view('admin.dashboard', compact('userCount', 'activeslots', 'activerooms', 'sexStatistics', 'ceesessionactive', 'reservationDataByCEESession', 'onlineUserCount'));
    }

    public function getDatabyFirstPriority(Request $request)
    {
        if ($request->ajax()) {
            $databyCeeSession = DB::table('reservations')
                ->leftJoin('cee_sessions', 'reservations.cee_session_id', '=', 'cee_sessions.id')
                ->select(
                    'reservations.firstpriorty',
                    'reservations.firstpriorty_desc',
                    'reservations.campus_id',
                    DB::raw('count(reservations.id) as total')
                )
                ->where('cee_sessions.status', '=', 'active')
                ->groupBy(
                    'reservations.firstpriorty',
                    'reservations.firstpriorty_desc',
                    'reservations.campus_id'
                );

            return DataTables::of($databyCeeSession)
                ->addIndexColumn()
                ->filter(function ($query) use ($request) {
                    if ($search = $request->get('search')['value']) {
                        $query->where('firstpriorty_desc', 'LIKE', "%{$search}%");
                    }
                })
                ->addColumn('firstpriorty_desc', function ($row) {
                    $campuses = [
                        "1" => "USM Main",
                        "3" => "USM KCC",
                        "5" => "USM PALMA CLUSTER",
                        "6" => "USM MLANG",
                        "7" => "USM Antipas",
                        "8" => "USM Pigcawayan"
                    ];

                    $campus_name = $row->firstpriorty_desc . ' - ' . ($campuses[$row->campus_id] ?? 'Unknown');
                    return $campus_name;
                })
                ->rawColumns(['firstpriority_desc'])
                ->make(true);
        }
    }

    public function getDataMunicipality(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('reservations')
                ->leftJoin('users', 'reservations.user_id', '=', 'users.id')
                ->leftJoin('cee_sessions', 'reservations.cee_session_id', '=', 'cee_sessions.id')
                ->select(
                    'users.city',
                    DB::raw('count(reservations.id) as total')
                )
                ->where('cee_sessions.status', '=', 'active')
                ->groupBy('users.city');

            return DataTables::of($data)
                ->addIndexColumn()
                ->filter(function ($query) use ($request) {
                    if ($search = $request->get('search')['value']) {
                        $query->where('city', 'LIKE', "%{$search}%");
                    }
                })
                ->make(true);
        }
    }

    public function getDataBySchool(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('reservations')
                ->leftJoin('users', 'reservations.user_id', '=', 'users.id')
                ->leftJoin('cee_sessions', 'reservations.cee_session_id', '=', 'cee_sessions.id')
                ->select(
                    'users.shs_school',
                    DB::raw('count(reservations.id) as total') // Count reservations per city
                )
                ->where('cee_sessions.status', '=', 'active')
                ->whereNotNull('users.shs_school') // Exclude null values
                ->where('users.shs_school', '!=', '') // Exclude empty values
                ->groupBy('users.shs_school');

            return DataTables::of($data)
                ->addIndexColumn()
                ->filter(function ($query) use ($request) {
                    if ($search = $request->get('search')['value']) {
                        $query->where('shs_school', 'LIKE', "%{$search}%");
                    }
                })
                ->make(true);
        }
    }

    public function getReservationsPerDay(Request $request)
    {
        $data = DB::table('reservations')
            ->leftJoin('cee_sessions', 'reservations.cee_session_id', '=', 'cee_sessions.id')
            ->select(
                DB::raw('CONVERT(DATE, reservations.created_at) AS reservation_date'),
                DB::raw('COUNT(*) AS daily_total'),
                DB::raw('(SELECT COUNT(*) FROM reservations) AS overall_total')
            )
            ->where('cee_sessions.status', '=', 'active')
            ->groupBy(DB::raw('CONVERT(DATE, reservations.created_at)'))
            ->orderBy(DB::raw('CONVERT(DATE, reservations.created_at)'), 'asc')
            ->get();


        return response()->json($data, 200, [], JSON_NUMERIC_CHECK);
    }

    public function calculateRegistrationReservationPercentage()
    {
        // Total Registrations
        $totalRegistrations = DB::table('users')
            ->join('cee_sessions', 'users.exam_session_id', '=', 'cee_sessions.id')
            ->where('cee_sessions.status', '=', 'active')
            ->count();

        // Total Reservations
        $totalReservations = DB::table('reservations')
            ->leftJoin('cee_sessions', 'reservations.cee_session_id', '=', 'cee_sessions.id')
            ->where('cee_sessions.status', '=', 'active')
            ->count();

        // Avoid division by zero
        $percentage = $totalRegistrations > 0
            ? ($totalReservations / $totalRegistrations) * 100
            : 0;

        return response()->json([
            'percentage' => round($percentage, 2), // Rounded to 2 decimal places
        ]);
    }

    public function calcReserveationToConfirmed()
    {
        // Total Pending Reservations
        $totalPendingReservations = DB::table('reservations')
            ->leftJoin('cee_sessions', 'reservations.cee_session_id', '=', 'cee_sessions.id')
            ->where(function ($query) {
                $query->whereNull('reservations.status')
                    ->orWhere('reservations.status', '');
            })
            ->where('cee_sessions.status', '=', 'active')
            ->count();

        // Total Confirmed Reservations
        $totalConfirmedReservations = DB::table('reservations')
            ->leftJoin('cee_sessions', 'reservations.cee_session_id', '=', 'cee_sessions.id')
            ->where('reservations.status', 'confirmed')
            ->where('cee_sessions.status', '=', 'active')
            ->count();

        // Compute Percentage
        $percentage = ($totalPendingReservations > 0)
            ? ($totalConfirmedReservations / $totalPendingReservations) * 100
            : 100;

        return response()->json([
            'percentage' => round($percentage, 2), // Rounded to 2 decimal places
        ]);
    }

    public function getReservationsbystackbar()
    {
        $campuses = [
            "1" => "USM Main", // Convert keys to string
            "3" => "USM KCC",
            "5" => "USM PALMA CLUSTER",
            "6" => "USM MLANG",
            "7" => "USM Antipas",
            "8" => "USM Pigcawayan"
        ];

        // Fetch all unique terms
        $terms = Reservation::select('cee_session_id')
            ->distinct()
            ->orderBy('cee_session_id', 'asc')
            ->pluck('cee_session_id');

        // Fetch session names from cee_sessions table
        $ceeSessions = DB::table('cee_sessions')
            ->whereIn('id', $terms) // Match only the relevant session IDs
            ->pluck('name', 'id') // Get session names indexed by ID
            ->toArray();

        $data = [];
        foreach ($campuses as $campus_id => $campus_name) {
            $reservations = [];
            foreach ($terms as $term) {
                // Get reservation count per campus per term
                $reservations[] = Reservation::where('campus_id', (string) $campus_id)
                    ->where('cee_session_id', $term)
                    ->count();
            }
            $data[] = [
                "name" => $campus_name,
                "data" => $reservations
            ];
        }

        return response()->json([
            "categories" => array_map(fn($id) => $ceeSessions[$id] ?? "Unknown", $terms->toArray()), // Map IDs to names
            "series" => $data
        ]);
    }

}
