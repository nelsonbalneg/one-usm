<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Models\Result;
use App\Exports\CEEExport;
use App\Models\CeeSession;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use App\Exports\SchoolResultsExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class AnalyticsController extends Controller
{
    public function index()
    {
        $cee_term_active = CeeSession::where('status', 'active')->first();

        //get the school performance
        $results = DB::table('results as r')
            ->join('users as u', 'r.user_id', '=', 'u.id')
             ->join('cee_sessions as cs', 'r.cee_session_id', '=', 'cs.id')
            ->select(
                'u.shs_school as school',
                DB::raw('COUNT(r.user_id) as total_examinees'),
                DB::raw('SUM(CASE WHEN r.csa > 25 THEN 1 ELSE 0 END) as total_passed'),
                DB::raw('SUM(CASE WHEN r.csa < 25 THEN 1 ELSE 0 END) as total_failed'),
                DB::raw('CAST(100.0 * SUM(CASE WHEN r.csa > 25 THEN 1 ELSE 0 END) / COUNT(r.user_id) AS DECIMAL(5,2)) as passing_rate_percent')
            )
            ->where('cs.status', 'active')
            ->groupBy('u.shs_school')
            ->orderByDesc('total_examinees')
            ->paginate(40);

        // Fetch the top 20 highest CSA scores with the user's full name and school name
        $top20 = DB::table('results')
            ->join('users', 'results.user_id', '=', 'users.id')
              ->join('cee_sessions as cs', 'results.cee_session_id', '=', 'cs.id')
            ->select('results.fullname', 'users.shs_school', 'results.csa')
              ->where('cs.status', 'active')
            ->orderByDesc(column: 'results.csa') // Order by CSA in descending order
            ->limit(40) // Get the top 20
            ->get();

        return view('admin.analytics.index', compact('cee_term_active', 'results', 'top20'));
    }

    public function getScoreDistPerSchoolIndex($schoolName): View
    {
        return view('admin.analytics.score-dist-per-school', compact('schoolName'));
    }
    public function getScoreDistPerSchool($schoolName)
    {
        $schoolNameDecoded = urldecode($schoolName);

        // Step 1: Get all unique CEE session IDs used
        $terms = Result::distinct()->pluck('cee_session_id')->toArray();

        // Step 2: Get the names of the sessions
        $ceeSessions = DB::table('cee_sessions')
            ->whereIn('id', $terms)
            ->pluck('name', 'id') // [id => name]
            ->toArray();

        // Step 3: Define score range bins and map them to index
        $scoreRanges = [];
        $scoreRangeIndexMap = [];
        for ($i = 100, $index = 0; $i >= 0; $i -= 5, $index++) {
            $upper = min($i + 4, 100);
            $rangeLabel = "{$i}-{$upper}";
            $scoreRanges[] = $rangeLabel;
            $scoreRangeIndexMap[$i] = $index;
        }

        $allDataPerRange = array_fill(0, count($scoreRanges), 0); // for filtering empty ranges
        $series = [];

        foreach ($ceeSessions as $sessionId => $sessionName) {
            $distribution = Result::join('users', 'results.user_id', '=', 'users.id')
                ->where('users.shs_school', $schoolNameDecoded)
                ->where('cee_session_id', $sessionId)
                ->select(
                    DB::raw('FLOOR(csa / 5) * 5 as score_range'),
                    DB::raw('COUNT(*) as count')
                )
                ->groupBy(DB::raw('FLOOR(csa / 5) * 5'))
                ->pluck('count', 'score_range')
                ->toArray();

            $totalExaminees = array_sum($distribution);
            $data = array_fill(0, count($scoreRanges), 0);

            foreach ($distribution as $range => $count) {
                if (isset($scoreRangeIndexMap[$range])) {
                    $index = $scoreRangeIndexMap[$range];
                    $data[$index] = $count;
                    $allDataPerRange[$index] += $count;
                }
            }

            $series[] = [
                'name' => "{$sessionName} ({$totalExaminees})",
                'data' => $data
            ];
        }

        // Step 5: Remove ranges with no data
        $filteredCategories = [];
        $filteredSeries = [];

        foreach ($scoreRanges as $index => $label) {
            if ($allDataPerRange[$index] > 0) {
                $filteredCategories[] = $label;
            }
        }

        foreach ($series as $s) {
            $filteredData = [];
            foreach ($scoreRanges as $index => $label) {
                if ($allDataPerRange[$index] > 0) {
                    $filteredData[] = $s['data'][$index];
                }
            }
            $filteredSeries[] = [
                'name' => $s['name'],
                'data' => $filteredData
            ];
        }

        return response()->json([
            'categories' => $filteredCategories,
            'series' => $filteredSeries
        ]);
    }

    public function getReservationStackbar()
    {
        // Get unique CEE sessions involved in reservations
        $terms = Reservation::distinct()->pluck('cee_session_id')->toArray();

        // Fetch the session names by ID
        $ceeSessions = DB::table('cee_sessions')
            ->whereIn('id', $terms)
            ->pluck('name', 'id')
            ->toArray();

        // Initialize arrays for chart
        $categories = [];
        $registered = [];
        $pending = [];
        $confirmed = [];
        $cancelled = [];

        foreach ($ceeSessions as $id => $name) {
            $categories[] = $name;

            $registered[] = User::where('exam_session_id', $id)->count();

            $pending[] = Reservation::where('cee_session_id', $id)
                ->where('status', 'pending')
                ->count();

            $confirmed[] = Reservation::where('cee_session_id', $id)
                ->where('status', 'confirmed')
                ->count();

            $cancelled[] = Reservation::where('cee_session_id', $id)
                ->where('status', 'cancelled')
                ->count();
        }

        return response()->json([
            'categories' => $categories,
            'series' => [
                ['name' => 'Registered Users', 'data' => $registered], // Blue
                ['name' => 'Confirmed Reservations', 'data' => $confirmed], // Green
                ['name' => 'Pending Reservations', 'data' => $pending], // Yellow
                ['name' => 'Cancelled Reservations', 'data' => $cancelled], // Red
            ]
        ]);
    }

    public function getCeeScoreDistribution()
    {
        $terms = Result::distinct()->pluck('cee_session_id')->toArray();

        $ceeSessions = DB::table('cee_sessions')
            ->whereIn('id', $terms)
            ->pluck('name', 'id')
            ->toArray();

        // Step 1: Define score bins and index map
        $scoreRanges = [];
        $scoreRangeIndexMap = [];
        for ($i = 0, $index = 0; $i <= 100; $i += 5, $index++) {
            $upper = min($i + 4, 100);
            $label = "{$i}-{$upper}";
            $scoreRanges[] = $label;
            $scoreRangeIndexMap[$i] = $index;
        }

        $allDataPerRange = array_fill(0, count($scoreRanges), 0);
        $series = [];

        foreach ($ceeSessions as $id => $name) {
            $distribution = Result::where('cee_session_id', $id)
                ->select(DB::raw('FLOOR(csa / 5) * 5 as score_range'), DB::raw('COUNT(*) as count'))
                ->groupBy(DB::raw('FLOOR(csa / 5) * 5'))
                ->pluck('count', 'score_range')
                ->toArray();

            $data = array_fill(0, count($scoreRanges), 0);
            foreach ($distribution as $range => $count) {
                if (isset($scoreRangeIndexMap[$range])) {
                    $index = $scoreRangeIndexMap[$range];
                    $data[$index] = $count;
                    $allDataPerRange[$index] += $count;
                }
            }

            $series[] = [
                'name' => $name,
                'data' => $data
            ];
        }

        // Step 2: Filter out unused score bins
        $filteredCategories = [];
        foreach ($scoreRanges as $index => $label) {
            if ($allDataPerRange[$index] > 0) {
                $filteredCategories[] = $label;
            }
        }

        $filteredSeries = [];
        foreach ($series as $s) {
            $filteredData = [];
            foreach ($scoreRanges as $index => $_) {
                if ($allDataPerRange[$index] > 0) {
                    $filteredData[] = $s['data'][$index];
                }
            }
            $filteredSeries[] = [
                'name' => $s['name'],
                'data' => $filteredData
            ];
        }

        return response()->json([
            'categories' => $filteredCategories,
            'series' => $filteredSeries
        ]);
    }

    public function getReservationGroupChart()
    {
        // Get the distinct CEE sessions that have results
        $terms = Result::distinct()->pluck('cee_session_id')->toArray();

        // Get CEE session names
        $ceeSessions = DB::table('cee_sessions')
            ->whereIn('id', $terms)
            ->pluck('name', 'id')
            ->toArray();

        // Prepare chart data
        $categories = [];
        $passed = [];
        $failed = [];

        foreach ($ceeSessions as $id => $name) {
            $categories[] = $name;

            $passed[] = Result::where('cee_session_id', $id)
                ->where('csa', '>=', 25)
                ->count();

            $failed[] = Result::where('cee_session_id', $id)
                ->where('csa', '<', 25)
                ->count();
        }

        return response()->json([
            'categories' => $categories,
            'series' => [
                ['name' => 'Passed > 25', 'data' => $passed],
                ['name' => 'Failed < 25', 'data' => $failed],
            ]
        ]);
    }

    public function gettopschoolCeePassers()
    {
        $results = DB::table('results as r')
            ->join('users as u', 'r.user_id', '=', 'u.id')
            ->join('cee_sessions as cs', 'r.cee_session_id', '=', 'cs.id')
            ->select(
                'u.shs_school as school',
                DB::raw('COUNT(r.user_id) as total_examinees'),
                DB::raw('SUM(CASE WHEN r.csa > 25 THEN 1 ELSE 0 END) as total_passed'),
                DB::raw('SUM(CASE WHEN r.csa < 25 THEN 1 ELSE 0 END) as total_failed'),
                DB::raw('CAST(100.0 * SUM(CASE WHEN r.csa > 25 THEN 1 ELSE 0 END) / COUNT(r.user_id) AS DECIMAL(5,2)) as passing_rate_percent')
            )
            ->where('cs.status', 'active')
            ->groupBy('u.shs_school')
            ->orderByDesc('total_examinees')
            ->get();

        return response()->json($results);
    }

    public function getSchoolPerformancePerArea(Request $request)
    {

        if ($request->ajax()) {
            $data = DB::table('users as u')
                ->join('results as r', 'u.id', '=', 'r.user_id')
                ->join('cee_sessions as cs', 'r.cee_session_id', '=', 'cs.id')
                ->select(
                    'u.shs_school',
                    DB::raw('COUNT(DISTINCT u.id) as total_users_with_results'),
                    DB::raw('AVG(r.science) as avg_science'),
                    DB::raw('AVG(r.math) as avg_math'),
                    DB::raw('AVG(r.humanities) as avg_humanities'),
                    DB::raw('AVG(r.inductive) as avg_inductive'),
                    DB::raw('AVG(r.csa) as avg_csa')
                )
                ->where('cs.status', 'active')
                ->groupBy('u.shs_school');

            return DataTables::of($data)
                ->addIndexColumn()
                // Only filter on the actual database column, not calculated fields
                ->filter(function ($query) use ($request) {
                    if ($request->has('search') && $request->get('search')['value'] != '') {
                        $searchValue = $request->get('search')['value'];
                        $query->whereRaw("u.shs_school like ?", ["%{$searchValue}%"]);
                    }
                })
                ->make(true);
        }

    }

    public function exportSchoolResults()
    {
        // return Excel::download(new SchoolResultsExport, 'cee_school_results_per_subject_area.xlsx');
        return Excel::download(new CEEExport, 'cee_summary.xlsx');
    }

}
