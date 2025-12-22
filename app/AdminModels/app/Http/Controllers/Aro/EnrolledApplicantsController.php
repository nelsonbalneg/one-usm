<?php

namespace App\Http\Controllers\Aro;

use Illuminate\Http\Request;
use App\Models\StundentProfile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Yajra\DataTables\Facades\DataTables;

class EnrolledApplicantsController extends Controller
{
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
                    'reservationStatus' => $matchedProgram['reservationStatus'] ?? 'Unknown',
                    'policyId' => $policyId,
                ];
            } else {
                $programData[$policyId] = [
                    'programName' => 'Unknown Program',
                    'ceeSlotsRemaining' => 0,
                    'reservationStatus' => 'Unknown',
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

        return view('aro.enrolled.index', compact(
            'count_per_college',
            'programData',
        ));
    }

    public function enrolledApplicantsIndex($policyId)
    {
        $programName = StundentProfile::where('policyId', $policyId)->first();
        $policyId = $programName->policyId;
        return view('aro.enrolled.enrolled-list-per-pid', compact('policyId', 'programName'));
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
                    'stundent_profiles.user_id',
                    'stundent_profiles.reg_no',
                    'stundent_profiles.student_no',
                    'stundent_profiles.is_school_id_created',
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
                                ->orWhere('stundent_profiles.student_no', 'like', "%{$searchValue}%")
                                ->orWhere('stundent_profiles.last_name', 'like', "%{$searchValue}%")
                                ->orWhere('stundent_profiles.mobile_no', 'like', "%{$searchValue}%");
                        });
                    }
                })

                ->addColumn('is_school_id_created', function ($row) {
                    $id = $row->id;
                    $switchId = 'greenDefaultSwitch_' . $id;

                    // if (is_null($row->is_school_id_created)) {
                    //     // No toggle, just a disabled red icon
                    //     return '<a href="#!" class="flex items-center justify-center text-red-500 transition-all duration-200 ease-linear bg-red-100 rounded size-9 hover:bg-red-200 dark:bg-red-500/20 dark:hover:bg-red-500/30">
                    //                 <i data-lucide="x" class="size-4"></i>
                    //             </a>';
                    // }

                    $isChecked = $row->is_school_id_created == 1 ? 'checked' : '';

                    return '<div class="flex">
                                <div class="relative inline-block w-10 align-middle transition duration-200 ease-in">
                                    <input type="checkbox"
                                           data-id="' . $id . '"
                                           name="greenDefaultSwitch"
                                           id="' . $switchId . '"
                                           class="absolute block transition duration-300 ease-linear border-2 rounded-full appearance-none cursor-pointer change-type size-5 border-slate-200 dark:border-zink-500 bg-white/80 dark:bg-zink-400 peer/published checked:bg-white dark:checked:bg-white ltr:checked:right-0 rtl:checked:left-0 checked:bg-none checked:border-green-500 dark:checked:border-green-500 arrow-none"
                                           ' . $isChecked . '>
                                    <label for="' . $switchId . '"
                                           class="block h-5 overflow-hidden duration-300 ease-linear border rounded-full cursor-pointer border-slate-200 dark:border-zink-500 bg-slate-200 dark:bg-zink-600 peer-checked/published:bg-green-500 peer-checked/published:border-green-500"></label>
                                </div>
                            </div>';
                })
                ->addColumn('action', function ($row) {

                    return '<div class="flex gap-3">

                         <a title="View Profile Picture"
                                data-id="' . $row->id . '"
                                class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md view-photo size-8 bg-slate-100 text-slate-500 hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500">
                                <i data-lucide="file-image" class="inline-block size-5"></i>
                        </a>

                         <a title="Download Certificate of Registration"
                        href="' . route('aro.prereg.enrolled-applicants.download-cor', ['reg_no' => $row->reg_no]) . '"
                        class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md size-8 bg-slate-100 text-slate-500 hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500">
                        <i data-lucide="newspaper" class="inline-block size-5"></i>
                        </a>
                    </div>';
                })
                ->rawColumns(['action', 'is_school_id_created'])
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

    public function viewPhoto(string $id)
    {
        $data = DB::table('stundent_profiles')
            ->join('users', 'stundent_profiles.user_id', '=', 'users.id')
            ->where('stundent_profiles.id', $id)
            ->select(
                'stundent_profiles.id',
                'stundent_profiles.user_id',
                'stundent_profiles.student_no',
                'stundent_profiles.last_name',
                'stundent_profiles.first_name',
                'stundent_profiles.middle_initial',
                'stundent_profiles.ext_name',
                'stundent_profiles.date_of_birth',
                'stundent_profiles.mobile_no',
                'stundent_profiles.emergency_contact',
                'stundent_profiles.emergency_mobileno',
                'stundent_profiles.emergency_address',
                'users.photo',
                'users.firstname',
            )
            ->first();

        return response()->json([
            'data' => $data  // wrap the actual result
        ]);
    }

    public function downloadProfilePhoto(string $id)
    {
        $profile = DB::table('stundent_profiles')
            ->join('users', 'stundent_profiles.user_id', '=', 'users.id')
            ->where('stundent_profiles.id', $id)
            ->select(
                'stundent_profiles.student_no',
                'stundent_profiles.last_name',
                'stundent_profiles.first_name',
                'users.photo'
            )
            ->first();

        if (!$profile || !$profile->photo) {
            abort(404, 'Photo not found.');
        }

        $photoFileName = basename($profile->photo);
        $remoteUrl = "http://172.16.0.43/uploads/{$photoFileName}";

        try {
            // Stream context
            $context = stream_context_create([
                'http' => [
                    'method' => 'GET',
                    'timeout' => 30,
                    'user_agent' => 'Laravel/12.0'
                ]
            ]);

            $extension = pathinfo($photoFileName, PATHINFO_EXTENSION);
            $filename = "{$profile->student_no}_{$profile->last_name}_{$profile->first_name}.{$extension}";

            // Get content type
            $headers = get_headers($remoteUrl, 1);
            $contentType = $headers['Content-Type'] ?? 'application/octet-stream';
            if (is_array($contentType)) {
                $contentType = end($contentType);
            }

            return response()->streamDownload(function () use ($remoteUrl, $context) {
                $handle = fopen($remoteUrl, 'rb', false, $context);

                if ($handle === false) {
                    throw new \Exception('Failed to open remote file');
                }

                while (!feof($handle)) {
                    $chunk = fread($handle, 8192);
                    if ($chunk === false) {
                        break;
                    }
                    echo $chunk;
                    flush();
                }

                fclose($handle);
            }, $filename, [
                'Content-Type' => $contentType,
                'Content-Disposition' => "attachment; filename=\"{$filename}\"",
                'Content-Transfer-Encoding' => 'binary',
                'Cache-Control' => 'no-cache, no-store, must-revalidate',
                'Pragma' => 'no-cache',
                'Expires' => '0'
            ]);

        } catch (\Exception $e) {
            Log::error("Error streaming photo for profile ID {$id}: " . $e->getMessage());
            abort(500, 'Error downloading photo.');
        }
    }

    public function updateStatus(Request $request)
    {
        $user = StundentProfile::where('id', $request->id)->first();

        if (!$user) {
            return response()->json(['message' => 'User profile not found'], 404);
        }

        $user->is_school_id_created = $request->status;
        $user->save();

        return response()->json(['message' => 'School ID status updated successfully!']);
    }
}
