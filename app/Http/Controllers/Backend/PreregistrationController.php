<?php

namespace App\Http\Controllers\Backend;

use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\StundentProfile;
use App\Models\StudentRequirement;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;
use App\Exports\NoRequirementsApplicantsExport;


class PreregistrationController extends Controller
{
    public function preregDashboard()
    {

        //count the number of preregistrations pending
        // $prereg_pending = StundentProfile::where('prereg_status', 'pending')
        //     ->whereNotNull('policyId')
        //     ->count();

        $prereg_pending = StundentProfile::join('cee_sessions', 'cee_sessions.id', '=', 'stundent_profiles.preregistration_id')
            ->where('stundent_profiles.prereg_status', 'pending')
            ->whereNotNull('stundent_profiles.policyId')
            ->where('cee_sessions.status', 'active')
            ->count();


        // $preregCountAll = StundentProfile::whereIn('prereg_status', ['pending', 'enrolled'])->count();
        $preregCountAll = StundentProfile::join('cee_sessions', 'cee_sessions.id', '=', 'stundent_profiles.preregistration_id')
            ->whereIn('stundent_profiles.prereg_status', ['pending', 'enrolled'])
            ->where('cee_sessions.status', 'active')
            ->count();



        // $prereg_for_ranking = StundentProfile::where('prereg_status', 'for_ranking')
        //     ->whereNotNull('campus_id')
        //     ->whereNotNull('prog_id')
        //     ->count();
        $prereg_for_ranking = StundentProfile::join('cee_sessions', 'cee_sessions.id', '=', 'stundent_profiles.preregistration_id')
            ->where('stundent_profiles.prereg_status', 'for_ranking')
            ->whereNotNull('stundent_profiles.campus_id')
            ->whereNotNull('stundent_profiles.prog_id')
            ->where('cee_sessions.status', 'active')
            ->count();


        $total_pend_for_ranking = $prereg_pending + $prereg_for_ranking;

        $site_settings = SiteSetting::select(
            'start_prereg_second_batch',
            'end_prereg_second_batch'
        )->first();

        // $prereg_step_6 = StundentProfile::where('prereg_status', 'enrolled')->count();
        $prereg_step_6 = StundentProfile::join('cee_sessions', 'cee_sessions.id', '=', 'stundent_profiles.preregistration_id')
            ->where('stundent_profiles.prereg_status', 'enrolled')
            ->where('cee_sessions.status', 'active')
            ->count();


        $results = DB::select("
            SELECT
                'Step ' + CAST(sp.current_step AS VARCHAR) AS label,
                COUNT(*) AS step_count,
                sp.current_step AS sort_order
            FROM stundent_profiles sp
            JOIN cee_sessions cs ON cs.id = sp.preregistration_id
            WHERE sp.current_step IN (1, 2, 3, 4, 5, 6)
            AND cs.status = 'active'
            GROUP BY sp.current_step

            UNION ALL

            SELECT
                'Total' AS label,
                COUNT(*) AS step_count,
                999 AS sort_order
            FROM stundent_profiles sp
            JOIN cee_sessions cs ON cs.id = sp.preregistration_id
            WHERE sp.current_step IN (1, 2, 3, 4, 5, 6)
            AND cs.status = 'active'

            ORDER BY sort_order
        ");


        // count first batch and secon bactg

        $count_per_batch = DB::select("
            SELECT 'Batch 1' AS status, COUNT(*) AS total
            FROM stundent_profiles sp
            JOIN cee_sessions cs ON cs.id = sp.preregistration_id
            WHERE sp.prereg_status = 'pending'
            AND sp.confirmation_batch IS NULL
            AND cs.status = 'active'

            UNION ALL

            SELECT 'Batch 2' AS status, COUNT(*) AS total
            FROM stundent_profiles sp
            JOIN cee_sessions cs ON cs.id = sp.preregistration_id
            WHERE sp.prereg_status = 'pending'
            AND sp.confirmation_batch = 2
            AND cs.status = 'active'

            UNION ALL

            SELECT 'Total' AS status,
                (SELECT COUNT(*)
                FROM stundent_profiles sp
                JOIN cee_sessions cs ON cs.id = sp.preregistration_id
                WHERE sp.prereg_status = 'pending'
                AND (sp.confirmation_batch IS NULL OR sp.confirmation_batch = 2)
                AND cs.status = 'active'
                ) AS total
        ");


        //count all for_ranking
        $count_applicant_program_for_ranking = DB::table('stundent_profiles as sp')
            ->join('cee_sessions as cs', 'cs.id', '=', 'sp.preregistration_id')
            ->select('sp.policyId', DB::raw('COUNT(*) as total_pending'))
            ->where('sp.prereg_status', 'for_ranking')
            ->whereNotNull('sp.campus_id')
            ->whereNotNull('sp.prog_id')
            ->where('cs.status', 'active')
            ->groupBy('sp.policyId')
            ->orderByDesc('total_pending')
            ->get();


        // Add program name for each policyId
        foreach ($count_applicant_program_for_ranking as $result) {
            $prog_policy_id = $result->policyId;
            $response = Http::get("http://172.16.0.60/academic/api/v2/ProgramPolicies/{$prog_policy_id}");

            if ($response->successful()) {
                $data = $response->json(); // Decode the JSON

                // Assuming the API returns something like: { program: { name: "BSIT" } }
                $result->programName = $data['programName'] . '-' . $data['majorDiscDesc'] ?? 'Unknown Program';
            } else {
                $result->programName = 'Unknown Program'; // fallback if API fails
            }
        }

        //count and group per collegeName
        $count_per_college = DB::select("
                SELECT
                    COALESCE(sp.campusName, 'All Campuses') AS campusName,
                    COALESCE(
                        sp.collegeName,
                        CASE
                            WHEN sp.campusName IS NOT NULL THEN 'Total'
                            ELSE 'Overall Total'
                        END
                    ) AS collegeName,
                    sp.policyId,
                    SUM(CASE WHEN sp.prereg_status = 'pending' THEN 1 ELSE 0 END) AS total_pending,
                    SUM(CASE WHEN sp.prereg_status = 'enrolled' THEN 1 ELSE 0 END) AS total_enrolled
                FROM stundent_profiles sp
                JOIN cee_sessions cs
                    ON cs.id = sp.preregistration_id
                WHERE
                    (sp.prereg_status = 'pending' OR sp.prereg_status = 'enrolled')
                    AND sp.policyId IS NOT NULL
                    AND cs.status = 'active'
                GROUP BY GROUPING SETS (
                    (sp.campusName, sp.collegeName, sp.policyId),
                    (sp.campusName, sp.collegeName),
                    (sp.campusName),
                    ()
                )
                ORDER BY
                    CASE WHEN COALESCE(sp.campusName, '') = 'All Campuses' THEN 1 ELSE 0 END,
                    sp.campusName,
                    CASE
                        WHEN COALESCE(sp.collegeName, '') = 'Overall Total' THEN 2
                        WHEN COALESCE(sp.collegeName, '') = 'Total' THEN 1
                        ELSE 0
                    END,
                    sp.collegeName,
                    sp.policyId
            ");


        // Create program name map (fetch once per policyId)
        $policyIds = collect($count_per_college)
            ->whereNotNull('policyId')
            ->pluck('policyId')
            ->unique();

        $programNames = [];

        // Fetch the full list of programs only once
        $programListResponse = Http::get('http://172.16.0.60/academic/api/v2/CeeV/get-list-of-programs');
        $programList = [];

        if ($programListResponse->successful()) {
            foreach ($programListResponse->json() as $program) {
                $programList[$program['id']] = $program; // Use ID as the key for quick lookup
            }
        }

        $programData = [];

        foreach ($policyIds as $policyId) {
            $response = Http::timeout(5)->get("http://172.16.0.60/academic/api/v2/ProgramPolicies/{$policyId}");

            if ($response->successful()) {
                $data = $response->json();

                // Find the matching program from list
                $matchedProgram = collect(value: $programList)->first(function ($program) use ($policyId) {
                    return isset($program['id']) && (int) $program['id'] === (int) $policyId;
                });

                $programData[$policyId] = [
                    'programName' => ($data['programName'] ?? 'Unknown Program') . ' - ' . ($data['majorDiscDesc'] ?? ''),
                    'ceeSlotsRemaining' => $data['ceeSlotsRemaining'] ?? 0,
                    'reservationStatus' => $matchedProgram['reservationStatus'] ?? 'Unknown', // ✅ add this line
                    'policyId' => $policyId,
                ];
            } else {
                $programData[$policyId] = [
                    'programName' => 'Unknown Program',
                    'ceeSlotsRemaining' => 0,
                    'reservationStatus' => 'Unknown', // ✅ default fallback
                ];
            }
        }


        // Attach program name to each row
        foreach ($count_per_college as $row) {
            if ($row->policyId) {
                $row->programName = $programData[$row->policyId]['programName'] ?? 'Unknown Program';
                $row->ceeSlotsRemaining = $programData[$row->policyId]['ceeSlotsRemaining'] ?? 0;
                $row->availableSlots = ($row->ceeSlotsRemaining - $row->total_pending) - $row->total_enrolled;
            } else {
                $row->programName = null;
                $row->ceeSlotsRemaining = null;
                $row->availableSlots = null;
            }
        }

        return view('admin.prereg.dashboard', compact(
            'prereg_pending',
            'prereg_for_ranking',
            'prereg_step_6',
            'total_pend_for_ranking',
            'results',
            'count_per_batch',
            'count_applicant_program_for_ranking',
            'count_per_college',
            'site_settings',
            'programData',
            'preregCountAll'
        ));
    }

    public function index()
    {
        // Count the number with requirements
        $counts = DB::table('stundent_profiles')
            ->leftJoin('student_requirements', 'stundent_profiles.id', '=', 'student_requirements.student_id')
            ->leftJoin('cee_sessions', 'cee_sessions.id', '=', 'stundent_profiles.preregistration_id')
            ->select(
                DB::raw("
                                        CASE
                                            WHEN stundent_profiles.student_type = 3 THEN 'With Requirements'
                                            WHEN stundent_profiles.student_type = 1 AND (
                                                student_requirements.goodmoral = 1 OR
                                                student_requirements.psa = 1 OR
                                                student_requirements.card = 1 OR
                                                student_requirements.affidavit = 1
                                            ) THEN 'With Requirements'
                                            WHEN stundent_profiles.student_type = 2 AND (
                                                student_requirements.goodmoral = 1 OR
                                                student_requirements.hdismissal = 1 OR
                                                student_requirements.certificatetransfer = 1 OR
                                                student_requirements.psa = 1 OR
                                                student_requirements.transcript = 1 OR
                                                student_requirements.affidavit = 1
                                            ) THEN 'With Requirements'
                                            ELSE 'No Requirements'
                                        END AS has_requirements
                                    "),
                    DB::raw("COUNT(*) as total")
            )
            ->where('stundent_profiles.prereg_status', 'pending')
            ->where('cee_sessions.status', 'active')
            ->groupBy(DB::raw("
        CASE
            WHEN stundent_profiles.student_type = 3 THEN 'With Requirements'
            WHEN stundent_profiles.student_type = 1 AND (
                student_requirements.goodmoral = 1 OR
                student_requirements.psa = 1 OR
                student_requirements.card = 1 OR
                student_requirements.affidavit = 1
            ) THEN 'With Requirements'
            WHEN stundent_profiles.student_type = 2 AND (
                student_requirements.goodmoral = 1 OR
                student_requirements.hdismissal = 1 OR
                student_requirements.certificatetransfer = 1 OR
                student_requirements.psa = 1 OR
                student_requirements.transcript = 1 OR
                student_requirements.affidavit = 1
            ) THEN 'With Requirements'
            ELSE 'No Requirements'
        END
    "))
            ->pluck('total', 'has_requirements');

        return view('admin.prereg.pending.index', compact('counts'));
    }

    public function getData(Request $request)
    {
        $columns = [
            'sp.id',
            'sp.student_no',
            'sp.prereg_status',
            'sp.student_type',
            'sp.app_no',
            'sp.last_name',
            'sp.first_name',
            'sp.campusName',
            'sp.programName',
            'sp.applicant_profile_status',
            'sp.campus_id',
            'sp.prog_id',
            'sp.policyId',
            'sp.status_id',
            'sp.nstp',
            'r.csa',
            'r.status',
            'sp.majorDiscDesc',
            'sp.created_at',
            'sp.reg_no'
        ];

        $length = $request->input('length', 10);
        $start = $request->input('start', 0);
        $columnIndex = $request->input('order')[0]['column'] ?? 0;
        $dir = $request->input('order')[0]['dir'] ?? 'asc';
        $search = $request->input('search')['value'] ?? '';

        if (!isset($columns[$columnIndex])) {
            $columnIndex = 0;
        }

        $query = DB::table('stundent_profiles as sp')
            ->leftJoin('results as r', 'sp.user_id', '=', 'r.user_id')
            ->leftJoin('student_requirements as sr', 'sp.id', '=', 'sr.student_id')
            ->leftJoin('cee_sessions as cs', 'cs.id', '=', 'sp.preregistration_id')
            ->select(
                'sp.id',
                'sp.user_id',
                'sp.student_no',
                'sp.app_no',
                'sp.student_type',
                'sp.last_name',
                'sp.first_name',
                'sp.middle_name',
                'sp.campusName',
                'sp.programName',
                'sp.majorDiscDesc',
                'sp.prereg_status',
                'sp.applicant_profile_status',
                'sp.campus_id',
                'sp.prog_id',
                'sp.policyId',
                'sp.status_id',
                'sp.nstp',
                'sp.created_at',
                'r.csa',
                'r.status',
                'sr.goodmoral',
                'sr.card',
                'sr.psa',
                'sr.hdismissal',
                'sr.certificatetransfer',
                'sr.transcript',
                'sp.reg_no'
            )
            ->where('cs.status', 'active')
            ->whereIn('sp.prereg_status', ['pending', 'for_ranking', 'enrolled']);


        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('sp.student_no', 'like', "%{$search}%")
                    ->orWhere('sp.app_no', 'like', "%{$search}%")
                    ->orWhere('sp.last_name', 'like', "%{$search}%")
                    ->orWhere('sp.first_name', 'like', "%{$search}%")
                    ->orWhere('sp.programName', 'like', "%{$search}%")
                    ->orWhere('sp.prereg_status', 'like', "%{$search}%")
                    ->orWhere('r.status', 'like', "%{$search}%");
            });
        }

        // Add your logs here
        Log::info('Search value:', ['search' => $search]);
        Log::info('Filtered query SQL:', ['sql' => $query->toSql(), 'bindings' => $query->getBindings()]);

        // $filteredRecords = $query->count();
        $filteredQuery = clone $query;
        $recordsFiltered = $filteredQuery->count();
        $recordsTotal = $query->count();

        $results = $query
            ->orderBy($columns[$columnIndex], $dir)
            ->skip($start)
            ->take($length)
            ->get();

        $data = $results->map(function ($item) {
            $studentTypes = [
                1 => 'New Student',
                2 => 'Transferee',
                3 => 'Shiftee',
            ];

            $studentTypeBadges = [
                1 => 'green',    // New Student
                2 => 'custom',   // Transferee
                3 => 'yellow',   // Shifty
            ];

            //check the prereg status of the applicant
            $preregStatusBadge = '';

            if (
                !is_null($item->policyId) &&
                $item->prereg_status === 'for_ranking' &&
                is_null($item->prog_id) &&
                is_null($item->campus_id)
            ) {
                $preregStatusBadge = "<span class='inline-block bg-orange-200 text-orange-500 text-xs font-medium mr-1 px-2.5 py-0.5 rounded dark:bg-orange-900 dark:text-orange-300 mb-1'>Selected</span>";
            } elseif (
                $item->prereg_status === 'for_ranking' &&
                !is_null($item->prog_id) &&
                !is_null($item->campus_id) &&
                !is_null($item->policyId)
            ) {
                $preregStatusBadge = "<span class='inline-block bg-custom-200 text-custom-500 text-xs font-medium mr-1 px-2.5 py-0.5 rounded dark:bg-custom-900 dark:text-custom-300 mb-1'>For Ranking</span>";
            } elseif ($item->prereg_status === 'pending' && $item->status_id == null) {
                $preregStatusBadge = "<span class='inline-block bg-yellow-200 text-yellow-500 text-xs font-medium mr-1 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300 mb-1'>Pending</span>";
            } elseif ($item->prereg_status === 'enrolled' && $item->status_id == 1) {
                $preregStatusBadge = "<span class='inline-block bg-green-200 text-green-500 text-xs font-medium mr-1 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300 mb-1'>Enrolled</span>";
            } elseif ($item->prereg_status === 'pending' && $item->status_id == 0) {
                $preregStatusBadge = "<span class='inline-block bg-purple-200 text-purple-500 text-xs font-medium mr-1 px-2.5 py-0.5 rounded dark:bg-purple-900 dark:text-purple-300 mb-1'>For Assessment</span>";
            } else {
                $preregStatusBadge = $item->prereg_status ?? 'Unknown';
            }

            return [
                'id' => $item->id,
                'student_no' => $item->student_no,
                'prereg_status' => $preregStatusBadge,
                'nstp' => ($item->nstp == '1'
                    ? "<span class='inline-block bg-green-200 text-green-500 text-xs font-medium mr-1 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300 mb-1'>CWTS</span>"
                    : "<span class='inline-block bg-custom-200 text-custom-500 text-xs font-medium mr-1 px-2.5 py-0.5 rounded dark:bg-custom-900 dark:text-custom-300 mb-1'>ROTC</span>")
                    . "<a data-id='$item->id'
                        class='flex items-center justify-center ml-1 transition-all duration-200 ease-linear rounded-md addnstpPreference size-6 bg-slate-100 text-slate-500 hover:text-green-500 hover:bg-green-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500'>
                        <i data-lucide='pen' class='size-3'></i>
                    </a>",

                'student_type' => isset($studentTypes[$item->student_type])
                    ? "<span class='inline-block bg-{$studentTypeBadges[$item->student_type]}-200 text-{$studentTypeBadges[$item->student_type]}-500 text-xs font-medium mr-1 px-2.5 py-0.5 rounded dark:bg-{$studentTypeBadges[$item->student_type]}-900 dark:text-{$studentTypeBadges[$item->student_type]}-300 mb-1'>{$studentTypes[$item->student_type]}</span>"
                    : 'Unknown',
                'fullname' => "<span class='text-custom-500'>{$item->app_no}</span><br><span class='font-bold'>" . strtoupper($item->last_name . ', ' . $item->first_name . ' ' . ($item->middle_name ?? '')) . "</span>",
                'created_at' => Carbon::parse($item->created_at)->format('F j, Y g:i A'),
                'program' => "<span class='text-slate-500'>{$item->campusName}</span><br><span class='font-bold'>{$item->programName}</span>" . ($item->majorDiscDesc ? " - {$item->majorDiscDesc}" : ""),
                'applicant_profile_status' => match ($item->applicant_profile_status) {
                    '0' => "<span class='inline-block bg-yellow-200 text-yellow-500 text-xs font-medium mr-1 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300 mb-1'>Draft</span>",
                    '1' => "<span class='inline-block bg-green-200 text-green-500 text-xs font-medium mr-1 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300 mb-1'>Published</span>",
                    default => $item->applicant_profile_status ?? '---',
                },
                'csa' => $item->csa,
                'status' => $item->status,
                'requirements' => collect([
                    'Good Moral' => $item->goodmoral,
                    'Card' => $item->card,
                    'PSA' => $item->psa,
                    'H. Dismissal' => $item->hdismissal,
                    'Cert. Transfer' => $item->certificatetransfer,
                    'Transcript' => $item->transcript
                ])->filter(fn($v) => $v == 1)->map(fn($v, $k) => "<span class='inline-block bg-green-100 text-green-500 text-xs font-medium mr-1 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300 mb-1'>{$k}</span><br>")->implode(' '),
                'actions' => view('admin.prereg.pending.action-buttons', [
                    'id' => $item->id,
                    'student_type' => $item->student_type,
                    'fullname' => strtoupper($item->last_name . ', ' . $item->first_name . ' ' . ($item->middle_name ?? '')),
                    'prereg_status_raw' => $item->prereg_status,
                    'reg_no' => $item->reg_no,
                ])->render()
            ];
        });

        return response()->json([
            'data' => $data,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
        ]);
    }

    public function editNstp($id)
    {
        $nstpPref = StundentProfile::findOrFail($id);
        return response()->json([
            'nstpPref' => $nstpPref
        ]);
    }

    public function updateNstp(Request $request, $id)
    {
        try {

            // Find the user's student profile
            $studentProfile = StundentProfile::find($id);

            if (!$studentProfile) {
                return response()->json(['success' => false, 'message' => 'Student profile not found.'], 404);
            }

            // Update profile status to published (1)
            $studentProfile->update(
                [
                    'nstp' => $request->nstp
                ]
            );

            return response()->json(['success' => true, 'message' => 'NSTP Preference updated successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    // public function cancelConfirmation(Request $request, $id)
    // {
    //     $student = StundentProfile::find($id);

    //     if (!$student) {
    //         return response()->json(['message' => 'Student not found'], 404);
    //     }

    //     $student->prereg_status = NULL;
    //     $student->policyId = NULL;
    //     $student->campus_id = NULL;
    //     $student->prog_id = NULL;
    //     $student->confirmation_batch = NULL;
    //     $student->date_program_selected = NULL;
    //     $student->date_cancelled = now();
    //     $student->remarks = $request->input('reason');

    //     $student->save();

    //     return response()->json(['message' => 'Preregistration has been cancelled'], 200);
    // }

    public function cancelConfirmation(Request $request, $id)
    {
        $baseUrl = config('academic.base_url');

        $student = StundentProfile::find($id);

        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        $reason = $request->input('reason');

        if (!$reason) {
            return response()->json(['message' => 'Cancellation reason is required'], 400);
        }

        // External API endpoint
        $externalApiUrl = "{$baseUrl}CeeV/reset-applicant/{$id}?reason=" . urlencode($reason);

        // Send DELETE request
        $response = Http::withHeaders([
            'Accept' => 'application/json',
        ])->delete($externalApiUrl);

        // Safely handle and log the API response
        try {
            $responseData = $response->json();
        } catch (\Exception $e) {
            $responseData = ['response' => $response->body()];
        }

        // Optionally log the API response for debugging
        Log::info('API response from cancelConfirmation', [
            'url' => $externalApiUrl,
            'response' => $responseData,
        ]);

        // Only update the student if API request is successful
        if ($response->successful()) {
            $student->prereg_status = null;
            $student->policyId = null;
            $student->remarks = $reason;
            $student->campus_id = null;
            $student->prog_id = null;
            $student->status_id = null;
            $student->save();

            return response()->json(['message' => 'Preregistration has been cancelled'], 200);
        } else {
            return response()->json([
                'message' => 'Failed to cancel preregistration via external API',
                'api_response' => $responseData,
            ], $response->status() ?: 500);
        }

        //     // Update student status
        //     $student->prereg_status = null;
        //     $student->policyId = null;
        //     $student->remarks = $reason;
        //     $student->campus_id = null;
        //     $student->prog_id = null;
        //   //  $student->status_id = null;
        //     $student->save();

        //     return response()->json(['message' => 'Preregistration has been cancelled'], 200);
    }




    public function getRequirements($id)
    {
        $requirement = StudentRequirement::where('student_id', $id)->first();

        if (!$requirement) {
            return response()->json(null);
        }

        return response()->json($requirement);
    }

    public function saveRequirements(Request $request)
    {
        try {
            $data = $request->validate([
                'student_id' => 'required|integer',
                'student_type' => 'required|integer',
                'goodmoral' => 'boolean',
                'card' => 'boolean',
                'psa' => 'boolean',
                'hdismissal' => 'boolean',
                'certificatetransfer' => 'boolean',
                'transcript' => 'boolean',
            ]);

            $requirement = StudentRequirement::updateOrCreate(
                ['student_id' => $data['student_id']],
                $data
            );

            return response()->json(['message' => 'Saved successfully', 'data' => $requirement]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['message' => 'Something went wrong'], 500);
        }
    }

    public function viewRank($policyId)
    {
        //fetch the Program Name from the policyId passed
        $programName = StundentProfile::where('policyId', $policyId)->first();
        $policyId = $programName->policyId;

        return view('admin.prereg.for-ranking-list', compact('programName'));
    }

    public function getListForRanking(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('stundent_profiles')
                ->leftJoin('results', 'stundent_profiles.user_id', '=', 'results.user_id')
                ->select(
                    'stundent_profiles.id', // Fix: include this
                    'results.csa',
                    'stundent_profiles.date_program_selected',
                    DB::raw("CONCAT(stundent_profiles.last_name, ', ', stundent_profiles.first_name, ' ', ISNULL(stundent_profiles.middle_name, ''), ' ', ISNULL(stundent_profiles.ext_name, '')) AS fullname")
                )
                ->where('stundent_profiles.prereg_status', 'for_ranking')
                ->whereNotNull('stundent_profiles.campus_id')
                ->whereNotNull('stundent_profiles.prog_id')
                ->where('stundent_profiles.policyId', $request->policy_id);

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '<button type="button" class="text-green-500 bg-green-100 btn hover:text-white hover:bg-green-600 focus:text-white focus:bg-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:ring active:ring-green-100 dark:bg-green-500/20 dark:text-green-400 dark:hover:bg-green-500 dark:hover:text-white dark:focus:bg-green-500 dark:focus:text-white dark:active:bg-green-500 dark:active:text-white dark:ring-green-400/20">Approve    </button>'; // Or customize action buttons
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function confirmedApplicantsIndex($policyId)
    {
        //fetch the Program Name from the policyId passed
        $programName = StundentProfile::where('policyId', $policyId)->first();
        $policyId = $programName->policyId;

        return view('admin.prereg.pending.confirmed-list', compact('programName'));
    }

    public function getConfirmedApplicants(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('stundent_profiles')
                ->leftJoin('student_requirements', 'stundent_profiles.id', '=', 'student_requirements.student_id')
                ->select(
                    'stundent_profiles.id',
                    'stundent_profiles.policyId',
                    'stundent_profiles.mobile_no',
                    'stundent_profiles.email',
                    'stundent_profiles.date_program_selected',
                    'stundent_profiles.student_type',
                    DB::raw("CONCAT(
            stundent_profiles.last_name, ', ',
            stundent_profiles.first_name, ' ',
            ISNULL(stundent_profiles.middle_name, ''), ' ',
            ISNULL(stundent_profiles.ext_name, '')
        ) AS fullname"),
                    DB::raw("
            CASE
                WHEN stundent_profiles.student_type = 3 THEN 'With Requirements'

                WHEN stundent_profiles.student_type = 1 AND (
                    student_requirements.goodmoral = 1 OR
                    student_requirements.psa = 1 OR
                    student_requirements.card = 1 OR
                    student_requirements.affidavit = 1
                ) THEN 'With Requirements'

                WHEN stundent_profiles.student_type = 2 AND (
                    student_requirements.goodmoral = 1 OR
                    student_requirements.hdismissal = 1 OR
                    student_requirements.certificatetransfer = 1 OR
                    student_requirements.psa = 1 OR
                    student_requirements.transcript = 1 OR
                    student_requirements.affidavit = 1
                ) THEN 'With Requirements'

                ELSE 'No Requirements'
            END AS has_requirements
        ")

                )
                ->where('stundent_profiles.prereg_status', 'pending')
                ->where('stundent_profiles.policyId', $request->policy_id);



            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('has_requirements', function ($row) {
                    if ($row->has_requirements == 'With Requirements') {
                        return '<span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium bg-green-100 text-green-500">
                        With Requirements
                    </span>';
                    } else {
                        return '<span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium bg-red-200 text-red-500">
                        No Requirements
                    </span>';
                    }
                })
                ->filter(function ($query) use ($request) {
                    if ($request->has('search')) {
                        $searchValue = $request->get('search')['value'];
                        $query->where(function ($q) use ($searchValue) {
                            $q->where('stundent_profiles.id', 'like', "%{$searchValue}%")
                                ->orWhere('stundent_profiles.last_name', 'like', "%{$searchValue}%")
                                ->orWhere('stundent_profiles.mobile_no', 'like', "%{$searchValue}%");
                        });
                    }
                })
                ->rawColumns(['has_requirements'])
                ->make(true);
        }
    }

    //rank all
    public function rankAll()
    {
        Http::withHeaders([
            'accept' => 'text/plain',
            'x-api-version' => '2.0'
        ])->put("http://172.16.0.60/academic/api/v2/CeeV/commit-ranking-all-progreams");

        return redirect()->back()->with('rank_success', 'Applicants ranked successfully!');
    }

    //rank by policyId
    public function rankByPolicyId(Request $request)
    {
        $policyId = $request->input('policyId');

        Http::withHeaders([
            'accept' => 'text/plain',
            'x-api-version' => '2.0'
        ])->post("http://172.16.0.60/academic/api/v2/CeeV/commit-ranking-list-by-policy/{$policyId}");

        return redirect()->back()->with('rank_success', 'Applicants ranked successfully!');
    }

    public function toggleProgramPolicy(Request $request, $policyId)
    {
        // Log the incoming values
        Log::info('Received request to toggle program policy', [
            'policyId' => $policyId,
            'isOpen' => $request->isOpen
        ]);

        $request->validate([
            'isOpen' => 'required|boolean',
        ]);

        // Build full URL with correct ternary usage
        $url = "http://172.16.0.60/academic/api/v2/CeeV/toggle-program-policy-for-ranking/{$policyId}?isOpen=" . ($request->isOpen ? 'true' : 'false');

        // Log the full URL before making the request
        Log::info('Calling API URL', ['url' => $url]);

        try {
            $response = Http::withHeaders([
                'Accept' => 'text/plain; x-api-version=2.0',
            ])->put($url);

            // Log the API response
            Log::info('API Response from CeeV', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);

            if ($response->successful()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Policy updated successfully',
                    'status' => $request->isOpen ? 'Open' : 'Closed',
                    'policyId' => $policyId
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to update policy',
                    'error' => $response->body()
                ], $response->status());
            }
        } catch (\Exception $e) {
            Log::error('Exception while updating policy', [
                'message' => $e->getMessage()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating the policy',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function enrolledApplicantsSummaryIndex()
    {
        //count and group per collegeName
        $count_per_college = DB::select("
           SELECT
            COALESCE(campusName, 'All Campuses') AS campusName,
            COALESCE(collegeName,
                CASE
                    WHEN campusName IS NOT NULL THEN 'Total'
                    ELSE 'Overall Total'
                END
                    ) AS collegeName,
                    policyId,
                    COUNT(*) AS total_pending
                FROM stundent_profiles
                WHERE prereg_status = 'enrolled'  AND policyId IS NOT NULL
                GROUP BY GROUPING SETS (
                    (campusName, collegeName, policyId),  -- Detailed per policy
                    (campusName, collegeName),            -- College total
                    (campusName),                         -- Campus total
                    ()                                    -- Overall total
                )
                ORDER BY
                    CASE WHEN COALESCE(campusName, '') = 'All Campuses' THEN 1 ELSE 0 END,
                    campusName,
                    CASE
                        WHEN COALESCE(collegeName, '') = 'Overall Total' THEN 2
                        WHEN COALESCE(collegeName, '') = 'Total' THEN 1
                        ELSE 0
                    END,
                    collegeName,
                    policyId;
                ");

        // Create program name map (fetch once per policyId)
        $policyIds = collect($count_per_college)
            ->whereNotNull('policyId')
            ->pluck('policyId')
            ->unique();

        $programNames = [];

        // Fetch the full list of programs only once
        $programListResponse = Http::get('http://172.16.0.60/academic/api/v2/CeeV/get-list-of-programs');
        $programList = [];

        if ($programListResponse->successful()) {
            foreach ($programListResponse->json() as $program) {
                $programList[$program['id']] = $program; // Use ID as the key for quick lookup
            }
        }


        foreach ($policyIds as $policyId) {
            $response = Http::timeout(5)->get("http://172.16.0.60/academic/api/v2/ProgramPolicies/{$policyId}");

            if ($response->successful()) {
                $data = $response->json();

                // Find the matching program from list
                $matchedProgram = collect(value: $programList)->first(function ($program) use ($policyId) {
                    return isset($program['id']) && (int) $program['id'] === (int) $policyId;
                });

                $programData[$policyId] = [
                    'programName' => ($data['programName'] ?? 'Unknown Program') . ' - ' . ($data['majorDiscDesc'] ?? ''),
                    'ceeSlotsRemaining' => $data['ceeSlotsRemaining'] ?? 0,
                    'reservationStatus' => $matchedProgram['reservationStatus'] ?? 'Unknown', // ✅ add this line
                    'policyId' => $policyId,
                ];
            } else {
                $programData[$policyId] = [
                    'programName' => 'Unknown Program',
                    'ceeSlotsRemaining' => 0,
                    'reservationStatus' => 'Unknown', // ✅ default fallback
                ];
            }
        }


        // Attach program name to each row
        foreach ($count_per_college as $row) {
            if ($row->policyId) {
                $row->programName = $programData[$row->policyId]['programName'] ?? 'Unknown Program';
                $row->ceeSlotsRemaining = $programData[$row->policyId]['ceeSlotsRemaining'] ?? 0;
                $row->availableSlots = $row->ceeSlotsRemaining - $row->total_pending;
            } else {
                $row->programName = null;
                $row->ceeSlotsRemaining = null;
                $row->availableSlots = null;
            }
        }

        $site_settings = SiteSetting::select(
            'start_prereg_second_batch',
            'end_prereg_second_batch'
        )->first();

        return view('admin.prereg.enrollment.index', compact(
            'count_per_college',
            'site_settings',
            'programData',
        ));
    }

    public function enrolledApplicantsIndex($policyId)
    {
        $programName = StundentProfile::where('policyId', $policyId)->first();
        $policyId = $programName->policyId;
        return view('admin.prereg.enrollment.enrolled', compact('policyId', 'programName'));
    }

    public function getEnrolledApplicantsData(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('stundent_profiles')
                ->select(
                    'stundent_profiles.id',
                    'stundent_profiles.policyId',
                    'stundent_profiles.mobile_no',
                    'stundent_profiles.date_enrolled',
                    'stundent_profiles.reg_no',
                    DB::raw("CONCAT(stundent_profiles.last_name, ', ', stundent_profiles.first_name, ' ', ISNULL(stundent_profiles.middle_name, ''), ' ', ISNULL(stundent_profiles.ext_name, '')) AS fullname")
                )
                ->where('stundent_profiles.prereg_status', 'enrolled')
                ->where('stundent_profiles.policyId', $request->policy_id);

            return DataTables::of($data)
                ->addIndexColumn()
                ->filter(function ($query) use ($request) {
                    if ($request->has('search')) {
                        $searchValue = $request->get('search')['value'];
                        $query->where(function ($q) use ($searchValue) {
                            $q->where('stundent_profiles.id', 'like', "%{$searchValue}%")
                                ->orWhere('stundent_profiles.last_name', 'like', "%{$searchValue}%")
                                ->orWhere('stundent_profiles.mobile_no', 'like', "%{$searchValue}%");
                        });
                    }
                })
                ->addColumn('action', function ($row) {

                    return '<div class="flex gap-3">
                        <a title="Download Certificate of Registration"
                        href="' . route('admin.prereg.enrolled-applicants.download-cor', ['reg_no' => $row->reg_no]) . '"
                        class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md size-8 bg-slate-100 text-slate-500 hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500">
                        <i data-lucide="newspaper" class="inline-block size-5"></i>
                        </a>
                    </div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function downloadCOR($reg_no)
    {
        //get the details from $reg_no\

        $campusName = StundentProfile::where('reg_no', $reg_no)
            ->value('campusName');

        $apiUrl = '';
        $queryParams = [];

        if ($campusName == 'USM Kidapawan City Campus') {
            $apiUrl = 'http://172.16.0.41/api/app/reports/get-pdf-report';

            $queryParams = [
                'folder' => 'enrollment',
                'reportName' => 'COR_KCC',
            ];
        } else {
            $apiUrl = 'http://172.16.0.41/api/app/reports/get-pdf-report';
            $queryParams = [
                'folder' => 'enrollment',
                'reportName' => 'COR',
            ];
        }

        Log::info('Sending API request to: ' . $apiUrl . '?' . http_build_query($queryParams));

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'X-Requested-With' => 'XMLHttpRequest',
        ])->post($apiUrl . '?' . http_build_query($queryParams), [
                    'RegID' => $reg_no,
                ]);

        // Log full response details
        Log::info('API Response Status: ' . $response->status());

        if ($response->successful()) {
            $base64 = $response->body();
            $pdfContent = base64_decode($base64);

            Log::info('COR PDF successfully decoded and ready for download.');

            return response($pdfContent)
                ->header('Content-Type', 'application/pdf')
                ->header('Content-Disposition', 'attachment; filename="COR-' . $reg_no . '.pdf"');
        }

        Log::error('Failed to fetch COR. Status: ' . $response->status() . ' Body: ' . $response->body());

        return response()->json([
            'message' => 'Failed to fetch Certificate of Registration.',
            'status' => $response->status(),
        ], $response->status());
    }

    public function noRequirementsApplicantsIndex()
    {
        return view('admin.prereg.pending.list-no-requirements');
    }

    public function getNoRequirementsApplicants(Request $request)
    {
        if ($request->ajax()) {
            $noRequirementsApplicants = StundentProfile::from('stundent_profiles as sp')
                ->leftJoin('student_requirements as sr', 'sp.id', '=', 'sr.student_id')
                ->where(function ($q) {
                    $q->where('sp.status_id', 0)
                        ->orWhere('sp.status_id', 1)
                        ->orWhereNull('sp.status_id');
                })
                ->where(function ($q) {
                    $q->where(function ($sub) {
                        $sub->where('sp.student_type', 1)
                            ->where(function ($s) {
                                $s->where(function ($x) {
                                    $x->where('sr.goodmoral', 0)->orWhereNull('sr.goodmoral');
                                })->where(function ($x) {
                                    $x->where('sr.psa', 0)->orWhereNull('sr.psa');
                                })->where(function ($x) {
                                    $x->where('sr.card', 0)->orWhereNull('sr.card');
                                })->where(function ($x) {
                                    $x->where('sr.affidavit', 0)->orWhereNull('sr.affidavit');
                                });
                            });
                    })
                        ->orWhere(function ($sub) {
                            $sub->where('sp.student_type', 2)
                                ->where(function ($s) {
                                    $s->where(function ($x) {
                                        $x->where('sr.goodmoral', 0)->orWhereNull('sr.goodmoral');
                                    })->where(function ($x) {
                                        $x->where('sr.hdismissal', 0)->orWhereNull('sr.hdismissal');
                                    })->where(function ($x) {
                                        $x->where('sr.certificatetransfer', 0)->orWhereNull('sr.certificatetransfer');
                                    })->where(function ($x) {
                                        $x->where('sr.psa', 0)->orWhereNull('sr.psa');
                                    })->where(function ($x) {
                                        $x->where('sr.transcript', 0)->orWhereNull('sr.transcript');
                                    })->where(function ($x) {
                                        $x->where('sr.affidavit', 0)->orWhereNull('sr.affidavit');
                                    });
                                });
                        });
                })
                ->where('sp.campus_id', '!=', null)
                ->where('sp.prereg_status', 'pending')
                ->select(
                    'sp.id as student_profile_id',
                    'sp.student_type',
                    'sp.first_name',
                    'sp.last_name',
                    'sp.gender',
                    'sp.programName',
                    'sp.campusName',
                    'sp.majorDiscDesc',
                    'sp.mobile_no',
                    'sp.email',
                    'sp.status_id',
                    'sp.policyId',
                    'sr.goodmoral',
                    'sr.card',
                    'sr.psa',
                    'sr.affidavit',
                    'sr.hdismissal',
                    'sr.certificatetransfer',
                    'sr.transcript',
                    'sp.date_confirmed',
                    DB::raw("CONCAT(sp.last_name, ', ', sp.first_name, ' ', ISNULL(sp.middle_name, ''), ' ', ISNULL(sp.ext_name, '')) AS full_name")
                );

            return DataTables::of($noRequirementsApplicants)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '<div class="flex gap-3">
                                <a href=' . route('admin.student.cancel-confirmation.update', $row->student_profile_id) . ' class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md cancel-prereg size-8 bg-slate-100 text-slate-500 hover:text-red-500 hover:bg-red-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-red-500/20 dark:hover:text-red-500"><i data-lucide="trash-2" class="size-4"></i></a>
                            </div>';
                })
                ->filter(function ($query) use ($request) {
                    if ($search = $request->get('search')['value']) {
                        $query->where(function ($q) use ($search) {
                            $q->where('sp.first_name', 'like', "%{$search}%")
                                ->orWhere('sp.last_name', 'like', "%{$search}%")
                                ->orWhere('sp.middle_name', 'like', "%{$search}%")
                                ->orWhere('sp.ext_name', 'like', "%{$search}%")
                                ->orWhere(DB::raw("CONCAT(sp.last_name, ', ', sp.first_name, ' ', ISNULL(sp.middle_name, ''), ' ', ISNULL(sp.ext_name, ''))"), 'like', "%{$search}%")
                                ->orWhere('sp.email', 'like', "%{$search}%")
                                ->orWhere('sp.mobile_no', 'like', "%{$search}%")
                                ->orWhere('sp.programName', 'like', "%{$search}%")
                                ->orWhere('sp.majorDiscDesc', 'like', "%{$search}%");
                        });
                    }
                })
                ->make(true);
        }
    }

    public function exportNoRequirementsApplicants()
    {
        return Excel::download(new NoRequirementsApplicantsExport, 'No_Requirements_Applicants.xlsx');
    }

    public function cancelNoRequirementsConfirmation(Request $request, $id)
    {
        $userId = Auth::id();
        $baseUrl = config('academic.base_url');

        $student = StundentProfile::find($id);

        if (!$student) {
            return response()->json(['status' => 'error', 'message' => 'Student not found'], 404);
        }

        $reason = $request->input('reason');

        if (!$reason) {
            return response()->json(['status' => 'error', 'message' => 'Cancellation reason is required'], 400);
        }

        $externalApiUrl = "{$baseUrl}CeeV/reset-applicant/{$id}?reason=" . urlencode($reason);

        $response = Http::withHeaders([
            'Accept' => 'application/json',
        ])->delete($externalApiUrl); // keep DELETE to external API

        if ($response->successful()) {
            $student->prereg_status = null;
            $student->status_id = null;
            $student->policyId = null;
            $student->prog_id = null;
            $student->campus_id = null;
            $student->remarks = $reason;
            $student->status_remarks = 'Cancelled by ' . $userId;
            $student->save();

            return response()->json(['status' => 'success', 'message' => 'Preregistration has been cancelled'], 200);
        } else {
            try {
                $responseData = $response->json();
            } catch (\Exception $e) {
                $responseData = ['response' => $response->body()];
            }

            Log::error('Failed to cancel preregistration', [
                'url' => $externalApiUrl,
                'response' => $responseData,
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to cancel preregistration',
                'details' => $responseData
            ], $response->status());
        }
    }

}
