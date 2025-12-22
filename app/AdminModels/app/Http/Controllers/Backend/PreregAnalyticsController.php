<?php

namespace App\Http\Controllers\Backend;

use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\FirstGenStudentsExport;

class PreregAnalyticsController extends Controller
{
    public function index()
    {
        // This method will handle the logic for displaying the analytics dashboard
        $cee_sessions = DB::table('cee_sessions')
            ->select('id', 'name')
            ->orderBy('name')
            ->get();
        return view('admin.prereg.analytics.index', compact('cee_sessions'));
    }

    public function firstGenStudentsStats()
    {
        // Fetch data
        $data = DB::table('ched_applicant_profiles as cap')
            ->join('stundent_profiles as sp', 'cap.user_id', '=', 'sp.user_id')
            ->join('cee_sessions as cs', 'sp.preregistration_id', '=', 'cs.id')
            ->select('sp.preregistration_id', 'cap.sex', 'cs.name', DB::raw('COUNT(*) as total'))
            ->where('sp.prereg_status', 'enrolled')
            ->where('cap.first_generation_student', 1)
            ->groupBy('sp.preregistration_id', 'cap.sex', 'cs.name')
            ->orderBy('sp.preregistration_id')
            ->orderBy('cap.sex')
            ->get();

        // Categories = session names
        $categories = $data->pluck('name')->unique()->values()->all();
        $sexes = $data->pluck('sex')->unique()->values()->all();

        $series = [];

        foreach ($sexes as $index => $sex) {
            $seriesData = [];

            foreach ($categories as $category) {
                $record = $data->firstWhere(function ($item) use ($category, $sex) {
                    return $item->name == $category && $item->sex == $sex;
                });
                $seriesData[] = $record ? $record->total : 0;
            }

            $series[] = [
                'name' => $sex,
                'type' => $index % 2 == 0 ? 'area' : 'line',
                'data' => $seriesData
            ];
        }

        // Overall totals per preregistration_id
        $overallTotalsByPrereg = [];
        foreach ($data->pluck('preregistration_id')->unique() as $preregId) {
            $overallTotalsByPrereg[$preregId] = $data->where('preregistration_id', $preregId)->sum('total');
        }

        // Build categories with totals
        $categoriesWithTotals = [];
        foreach ($data->pluck('preregistration_id', 'name')->unique() as $name => $preregId) {
            $categoriesWithTotals[] = $name . ' (' . $overallTotalsByPrereg[$preregId] . ')';
        }

        return response()->json([
            'categories' => $categoriesWithTotals,
            'series' => $series
        ]);
    }
    public function showturnoutprereg()
    {
        // Step 0: Get all unique session IDs
        $terms = Result::distinct()->pluck('cee_session_id')->toArray();

        // Step 1: Get session names
        $ceeSessions = DB::table('cee_sessions')
            ->whereIn('id', $terms)
            ->pluck('name', 'id')
            ->toArray();

        // Step 2: Define score bins and mapping
        $scoreRanges = [];
        $scoreRangeIndexMap = [];
        for ($i = 25, $index = 0; $i <= 100; $i += 5, $index++) {
            $upper = min($i + 4, 100);
            $label = "{$i}-{$upper}";
            $scoreRanges[] = $label;
            $scoreRangeIndexMap[$i] = $index;
        }

        $allDataPerRange = array_fill(0, count($scoreRanges), 0);
        $series = [];
        $enrolledSeries = [];

        foreach ($ceeSessions as $id => $name) {
            // All takers with CSA > 24
            $distribution = Result::where('cee_session_id', $id)
                ->where('csa', '>', 24)
                ->select(DB::raw('FLOOR(csa / 5) * 5 as score_range'), DB::raw('COUNT(*) as count'))
                ->groupBy(DB::raw('FLOOR(csa / 5) * 5'))
                ->pluck('count', 'score_range')
                ->toArray();

            // Enrolled takers with CSA > 24
            $enrolledDistribution = DB::table('results')
                ->join('stundent_profiles', 'results.user_id', '=', 'stundent_profiles.user_id')
                ->where('results.cee_session_id', $id)
                ->where('results.csa', '>', 24)
                ->where('stundent_profiles.prereg_status', 'like', 'enrolled')
                ->select(DB::raw('FLOOR(results.csa / 5) * 5 as score_range'), DB::raw('COUNT(*) as count'))
                ->groupBy(DB::raw('FLOOR(results.csa / 5) * 5'))
                ->pluck('count', 'score_range')
                ->toArray();

            // Populate "All" data
            $data = array_fill(0, count($scoreRanges), 0);
            $totalAll = 0;
            foreach ($distribution as $range => $count) {
                if (isset($scoreRangeIndexMap[$range])) {
                    $index = $scoreRangeIndexMap[$range];
                    $data[$index] = $count;
                    $allDataPerRange[$index] += $count;
                    $totalAll += $count;
                }
            }

            // Populate "Enrolled" data
            $enrolledData = array_fill(0, count($scoreRanges), 0);
            $totalEnrolled = 0;
            foreach ($enrolledDistribution as $range => $count) {
                if (isset($scoreRangeIndexMap[$range])) {
                    $index = $scoreRangeIndexMap[$range];
                    $enrolledData[$index] = $count;
                    $totalEnrolled += $count;
                }
            }

            // Compute percentage
            $turnoutPercent = $totalAll > 0 ? round(($totalEnrolled / $totalAll) * 100, 2) : 0;

            // Push with updated series name
            $series[] = [
                'name' => "{$name} - All ({$totalAll})",
                'data' => $data
            ];

            $enrolledSeries[] = [
                'name' => "{$name} - Enrolled ({$totalEnrolled}, {$turnoutPercent}%)",
                'data' => $enrolledData
            ];
        }

        // Only include categories used
        $filteredCategories = [];
        foreach ($scoreRanges as $index => $label) {
            if ($allDataPerRange[$index] > 0) {
                $filteredCategories[] = $label;
            }
        }

        // Filter unused bins
        $filteredSeries = [];
        foreach (array_merge($series, $enrolledSeries) as $s) {
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

    public function firstGenStudentsIndex($termid)
    {
        //fetch all the data here
        $data = DB::table('ched_applicant_profiles as cap')
            ->join('stundent_profiles as sp', 'cap.user_id', '=', 'sp.user_id')
            ->join('cee_sessions as cs', 'sp.preregistration_id', '=', 'cs.id')
            ->select(
                DB::raw("COALESCE(sp.campusName, 'TOTAL') as campusName"),
                DB::raw("COALESCE(sp.programName, 'TOTAL') as programName"),
                DB::raw("SUM(CASE WHEN cap.first_generation_student = 1 THEN 1 ELSE 0 END) as first_generation_students"),
                DB::raw("cs.name as session_name")
            )
            ->where('sp.prereg_status', 'enrolled')
            ->where('sp.preregistration_id', $termid)
            ->where('cap.first_generation_student', 1)
            ->groupByRaw('cs.name, ROLLUP(sp.campusName, sp.programName)')
            ->orderByRaw("
                CASE WHEN sp.campusName IS NULL THEN 1 ELSE 0 END,
                sp.campusName,
                CASE WHEN sp.programName IS NULL THEN 1 ELSE 0 END,
                sp.programName
            ")
            ->get();


        return view('admin.prereg.analytics.first-gen-students', compact('data', 'termid'));
    }

    public function exportToExcelFirstGenStudents($termid)
    {
        $data = DB::table('ched_applicant_profiles as cap')
            ->join('stundent_profiles as sp', 'cap.user_id', '=', 'sp.user_id')
            ->join('cee_sessions as cs', 'sp.preregistration_id', '=', 'cs.id')
            ->select(
                DB::raw("cs.name as session_name"),
                DB::raw("COALESCE(sp.campusName, 'TOTAL') as campusName"),
                DB::raw("COALESCE(sp.programName, 'TOTAL') as programName"),
                DB::raw("SUM(CASE WHEN cap.first_generation_student = 1 THEN 1 ELSE 0 END) as first_generation_students")

            )
            ->where('sp.prereg_status', 'enrolled')
            ->where('sp.preregistration_id', $termid)
            ->where('cap.first_generation_student', 1)
            ->groupByRaw('cs.name, ROLLUP(sp.campusName, sp.programName)')
            ->orderByRaw("
            CASE WHEN sp.campusName IS NULL THEN 1 ELSE 0 END,
            sp.campusName,
            CASE WHEN sp.programName IS NULL THEN 1 ELSE 0 END,
            sp.programName
        ")
            ->get();

        return Excel::download(new FirstGenStudentsExport($data), 'first_generation_students.xlsx');
    }

    public function getFirstStudentsData()
    {

    }

    public function getSexOrientationChartData()
    {
        $data = DB::table('ched_applicant_profiles as cap')
            ->join('stundent_profiles as sp', 'cap.user_id', '=', 'sp.user_id')
            ->join('cee_sessions as cs', 'sp.preregistration_id', '=', 'cs.id')
            ->select('cs.name as session_name', 'cap.sex', DB::raw('COUNT(*) as total'))
            ->where('sp.prereg_status', 'enrolled')
            ->where('cap.first_generation_student', 1)
            ->groupBy('cs.name', 'cap.sex')
            ->orderBy('cs.name')
            ->get();

        $sessions = $data->pluck('session_name')->unique()->values();
        $maleData = [];
        $femaleData = [];
        $totals = [];

        foreach ($sessions as $session) {
            $male = $data->firstWhere(fn($item) => $item->session_name == $session && strtolower($item->sex) == 'male')->total ?? 0;
            $female = $data->firstWhere(fn($item) => $item->session_name == $session && strtolower($item->sex) == 'female')->total ?? 0;

            $maleData[] = $male;
            $femaleData[] = $female;
            $totals[] = $male + $female;
        }

        return response()->json([
            'sessions' => $sessions,
            'maleData' => $maleData,
            'femaleData' => $femaleData,
            'totals' => $totals,
        ]);
    }

    public function getPWDChartData()
    {
        $data = DB::table('ched_applicant_profiles as cap')
            ->join('stundent_profiles as sp', 'cap.user_id', '=', 'sp.user_id')
            ->join('cee_sessions as cs', 'sp.preregistration_id', '=', 'cs.id')
            ->select('cs.name as session_name', 'cap.sex', DB::raw('COUNT(*) as total'))
            ->where('sp.prereg_status', 'enrolled')
            ->where('cap.is_pwd', 1)
            ->groupBy('cs.name', 'cap.sex')
            ->orderBy('cs.name')
            ->get();

        $sessions = $data->pluck('session_name')->unique()->values();
        $maleData = [];
        $femaleData = [];
        $totals = [];

        foreach ($sessions as $session) {
            $male = $data->firstWhere(fn($item) => $item->session_name == $session && strtolower($item->sex) == 'male')->total ?? 0;
            $female = $data->firstWhere(fn($item) => $item->session_name == $session && strtolower($item->sex) == 'female')->total ?? 0;

            // Male as negative for left side of bar chart
            $maleData[] = $male;
            $femaleData[] = $female;
            $totals[] = $male + $female;
        }

        return response()->json([
            'sessions' => $sessions,
            'maleData' => $maleData,
            'femaleData' => $femaleData,
            'totals' => $totals,
        ]);
    }

    public function getIPChartData()
    {
        $data = DB::table('ched_applicant_profiles as cap')
            ->join('stundent_profiles as sp', 'cap.user_id', '=', 'sp.user_id')
            ->join('cee_sessions as cs', 'sp.preregistration_id', '=', 'cs.id')
            ->select('cs.name as session_name', 'cap.sex', DB::raw('COUNT(*) as total'))
            ->where('sp.prereg_status', 'enrolled')
            ->where('cap.is_ip', 1)
            ->groupBy('sp.preregistration_id', 'cap.sex', 'cs.name')
            ->orderBy('sp.preregistration_id')
            ->get();

        $sessions = $data->pluck('session_name')->unique()->values();

        $male = [];
        $female = [];
        $totals = [];

        foreach ($sessions as $session) {
            $m = $data->where('session_name', $session)->where('sex', 'Male')->sum('total');
            $f = $data->where('session_name', $session)->where('sex', 'Female')->sum('total');

            $male[] = $m;
            $female[] = $f;
            $totals[] = $m + $f;   // ✅ correct per-term total
        }

        return response()->json([
            'sessions' => $sessions,
            'male' => $male,
            'female' => $female,
            'totals' => $totals,
        ]);
    }





}
