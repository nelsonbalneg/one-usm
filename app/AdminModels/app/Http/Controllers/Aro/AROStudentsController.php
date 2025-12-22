<?php

namespace App\Http\Controllers\Aro;


use App\Models\SiteSetting;
use Illuminate\Http\Request;
use App\Models\StundentProfile;
use App\Models\StudentRequirement;
use Illuminate\Support\Facades\DB;
use App\Services\AssessmentService;
use Illuminate\Support\Facades\Log;


use App\Http\Controllers\Controller;
use App\Models\UsersAssignedProgram;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\UsersAssignedAcademicStatus;


class AROStudentsController extends Controller
{
    public function index()
    {

        return view('aro.students.index');
    }

    public function cancelConfirmation(Request $request, $id)
    {
        // $student = StundentProfile::find($id);

        // if (!$student) {
        //     return response()->json(['message' => 'Student not found'], 404);
        // }

        // $student->prereg_status = NULL;
        // $student->policyId = NULL;
        // $student->campus_id = NULL;
        // $student->prog_id = NULL;
        // $student->confirmation_batch = NULL;
        // $student->date_program_selected = NULL;
        // $student->date_cancelled = now();
        // $student->remarks = $request->input('reason');

        // $student->save();

        // return response()->json(['message' => 'Preregistration has been cancelled'], 200);

        $userId = Auth::id();
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

         // Check if the API call was successful
        if ($response->successful()) {
            // Update student status only if API call succeeded
            $student->prereg_status = null;
            $student->status_id = null;
            $student->policyId = null;
            $student->prog_id = null;
            $student->campus_id = null;
            $student->remarks = $reason;
            $student->status_remarks = 'Cancelled by'.$userId;
            $student->save();

            return response()->json(['message' => 'Preregistration has been cancelled'], 200);
        } else {
            // Log failure details
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
                'message' => 'Failed to cancel preregistration',
                'details' => $responseData
            ], $response->status());
        }
    }

    public function getData(Request $request)
    {
        $userId = Auth::id();
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
            'sp.nstp',
            'r.csa',
            'r.status',
            'sp.majorDiscDesc'
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
            ->join('users_assigned_program as uap', 'sp.policyId', '=', 'uap.policyId')
            ->leftJoin('results as r', 'sp.user_id', '=', 'r.user_id')
            ->leftJoin('student_requirements as sr', 'sp.id', '=', 'sr.student_id')
            ->distinct()
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
                'sp.nstp',
                'r.csa',
                'r.status',
                'sr.goodmoral',
                'sr.card',
                'sr.psa',
                'sr.hdismissal',
                'sr.certificatetransfer',
                'sr.transcript',
                'sr.affidavit'
            )
            ->where('sp.prereg_status', 'pending')
            ->where('uap.user_id', $userId);

        $filteredQuery = clone $query;
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('sp.student_no', 'like', "%{$search}%")
                    ->orWhere('sp.app_no', 'like', "%{$search}%")
                    ->orWhere('sp.last_name', 'like', "%{$search}%")
                    ->orWhere('sp.first_name', 'like', "%{$search}%")
                    ->orWhere('sp.programName', 'like', "%{$search}%")
                    ->orWhere('sp.campusName', 'like', "%{$search}%")
                    ->orWhere('sp.prereg_status', 'like', "%{$search}%")
                    ->orWhere('r.status', 'like', "%{$search}%");
            });
        }

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
                3 => 'yellow',   // Shiftee
            ];

            return [
                'id' => $item->id,
                'student_no' => $item->student_no,
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
                'app_no' => $item->app_no,
                'fullname' => $item->last_name . ', ' . $item->first_name . ' ' . ($item->middle_name ?? ''),
                'campusName' => $item->campusName,
                'program' => '
                    <h6 class="mb-1">' . e($item->campusName) . '</h6>
                    <span class="col-span-12 delivery_status px-2.5 py-0.5 text-xs inline-block font-medium rounded border bg-green-100 border-green-200 text-green-500 dark:bg-green-500/20 dark:border-green-500/20">
                        ' . e($item->programName) . (!empty($item->majorDiscDesc) ? ' – ' . e($item->majorDiscDesc) : '') . '
                    </span>',
                'major' => $item->majorDiscDesc,
                'csa' => $item->csa,
                'status' => $item->status,
                'requirements' => collect([
                    'Good Moral' => $item->goodmoral,
                    'Card' => $item->card,
                    'PSA' => $item->psa,
                    'H. Dismissal' => $item->hdismissal,
                    'Cert. Transfer' => $item->certificatetransfer,
                    'Transcript' => $item->transcript,
                    'Affidavit' => $item->affidavit,
                ])->filter(fn($v) => $v == 1)
                    ->map(fn($v, $k) => "<span class='inline-block bg-green-100 text-green-500 text-xs font-medium mr-1 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300 mb-1'>{$k}</span><br>")
                    ->implode(' '),

                'details' => '
                    <h6 class="mb-1">' . e($item->last_name . ',' . $item->first_name) . '</h6>
                    <span class="col-span-12 delivery_status px-2.5 py-0.5 text-xs inline-block font-medium rounded border bg-sky-100 border-sky-200 text-sky-500 dark:bg-sky-500/20 dark:border-sky-500/20">
                        ' . e($item->app_no) . '
                    </span>',

                'actions' => view('aro.students.action-buttons', [
                    'id' => $item->id,
                    'student_type' => $item->student_type,
                    'fullname' => $item->last_name . ', ' . $item->first_name . ' ' . ($item->middle_name ?? '')
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

    public function programPolicy()
    {
        $setting = SiteSetting::first(); // or use `find(1)` if you have a single row

        // Convert to true or false explicitly
        $enrollmentRegStatus = (bool) $setting->enrollment_hy_reg_status;

        $baseUrl = config('academic.base_url');
        $url = "{$baseUrl}CeeV/get-list-of-programs";
        // Make the HTTP request
        $response = Http::get($url);

        $programs = [];
        if ($response->successful()) {
            $programs = $response->json();
        }

        // Get the logged-in user's ID
        $userId = Auth::user()->id;

        // Get the user's assigned policy IDs
        $selectedPolicyIds = UsersAssignedProgram::where('user_id', $userId)
            ->pluck('policyId')
            ->toArray();

        $counts = [];
        $totalCounts = [
            'pending_for_enrollment' => 0,
            'for_assessment' => 0,
            'enrolled' => 0,
        ];

        foreach ($selectedPolicyIds as $policyId) {
            $counts[$policyId] = [
                'pending_for_enrollment' => DB::table('stundent_profiles')
                    ->leftJoin('student_requirements', 'stundent_profiles.id', '=', 'student_requirements.student_id')
                    ->where('policyId', $policyId)
                    ->where('prereg_status', 'pending')
                    ->whereNull('status_id')
                    ->where(function ($q) {
                        $q->where(function ($sub) {
                            $sub->where('stundent_profiles.student_type', 1)
                                ->where(function ($s) {
                                    $s->where('student_requirements.goodmoral', 1)
                                        ->orWhere('student_requirements.psa', 1)
                                        ->orWhere('student_requirements.card', 1)
                                        ->orWhere('student_requirements.affidavit', 1);
                                });
                        })
                            ->orWhere(function ($sub) {
                                $sub->where('stundent_profiles.student_type', 2)
                                    ->where(function ($s) {
                                        $s->where('student_requirements.goodmoral', 1)
                                            ->orWhere('student_requirements.hdismissal', 1)
                                            ->orWhere('student_requirements.certificatetransfer', 1)
                                            ->orWhere('student_requirements.psa', 1)
                                            ->orWhere('student_requirements.transcript', 1)
                                            ->orWhere('student_requirements.affidavit', 1);
                                    });
                            })
                            ->orWhere(function ($sub) {
                                $sub->where('stundent_profiles.student_type', 3);
                            });
                    })
                    ->count(),

                'for_assessment' => DB::table('stundent_profiles')
                    ->where('policyId', $policyId)
                    ->where('prereg_status', 'pending')
                    ->where('status_id', 0)
                    ->count(),

                'enrolled' => DB::table('stundent_profiles')
                    ->where('policyId', $policyId)
                    ->where('prereg_status', 'enrolled')
                    ->where('status_id', 1)
                    ->count(),
            ];

            // Add to total
            $totalCounts['pending_for_enrollment'] += $counts[$policyId]['pending_for_enrollment'];
            $totalCounts['for_assessment'] += $counts[$policyId]['for_assessment'];
            $totalCounts['enrolled'] += $counts[$policyId]['enrolled'];
        }

        //get the PAO
        $paoUsers = UsersAssignedProgram::join('users', 'users.id', '=', 'users_assigned_program.user_id')
            ->where('users.role', 'like', 'pao')
            ->select('users_assigned_program.policyId', 'users.firstname', 'users.lastname')
            ->get()
            ->groupBy('policyId')
            ->map(function ($group) {
                return $group->map(function ($user) {
                    // return $user->lastname . ', ' . $user->firstname;
                    return $user->lastname . ', ' . $user->firstname;
                })->join(' | ');
            })
            ->toArray();

        // Filter the programs using the selected policy IDs
        $selectedPrograms = collect($programs)->filter(function ($program) use ($selectedPolicyIds) {
            return in_array($program['id'], $selectedPolicyIds);
        })->map(function ($program) {
            return [
                'programName' => $program['programName'],
                'majorDiscDesc' => $program['majorDiscDesc'],
                'realCampus' => $program['realCampus'],
                'collegeName' => $program['collegeName'],
                'term' => $program['term'],
                'policyId' => $program['id'],
            ];
        })->values();

        return view('aro.sar.index', compact('selectedPrograms', 'counts', 'totalCounts', 'paoUsers', 'enrollmentRegStatus'));
    }

    public function setTransactionType(Request $request, $id)
    {
        $baseUrl = config('academic.base_url');
        // Validate the input
        $request->validate([
            'transactionType' => 'required|in:Regular,Irregular',
        ]);

        // External API endpoint
        $externalApiUrl = "{$baseUrl}sar/SarTrialPrograms/{$id}/set-transaction-type";

        // Forward the request to the external API
        $response = Http::withHeaders([
            'Accept' => 'application/json',
        ])->post($externalApiUrl, [
                    'transactionType' => $request->input('transactionType'),
                ]);

        // Return appropriate response to the frontend
        if ($response->successful()) {
            return response()->json(['message' => 'Transaction type updated successfully.']);
        } else {
            return response()->json([
                'error' => 'Failed to update transaction type in external API.',
                'details' => $response->body()
            ], $response->status());
        }
    }

    public function setClassSection(Request $request, $id)
    {
        $baseUrl = config('academic.base_url');

        try {

            // Validate the request data
            $validatedData = $request->validate([
                'classSectionId' => 'required|integer',
                'classSectionName' => 'required|string|max:255',
                'tenantId' => 'required|integer',
            ]);

            $classSectionId = $validatedData['classSectionId'];
            $classSectionName = $validatedData['classSectionName'];
            $tenantId = $validatedData['tenantId'];


            // External API URL
            $externalApiUrl = "{$baseUrl}sar/SarTrialPrograms/{$id}/profile/class-section?tenantId={$tenantId}";

            // Data to send
            $data = [
                'id' => $classSectionId,
                'name' => $classSectionName,
            ];

            // Send PUT request
            $response = Http::withHeaders([
                'Accept' => 'application/json',
            ])->put($externalApiUrl, $data);

            // Safely handle and log the API response
            $responseData = $response->json();
            if (!is_array($responseData)) {
                $responseData = ['response' => $response->body()];
            }

            // Return response based on status
            if ($response->successful()) {
                return response()->json([
                    'message' => 'Class Section updated successfully!',
                    'status' => 'success'
                ]);
            } else {
                return response()->json([
                    'message' => 'Failed to update Class Section.',
                    'status' => 'error'
                ], 400);
            }

        } catch (\Exception $e) {

            // Return error response
            return response()->json([
                'message' => 'An error occurred while updating the class section.',
                'status' => 'error'
            ], 500);
        }
    }

    public function setYearLevel(Request $request, $id)
    {
        $baseUrl = config('academic.base_url');

        try {
            // Validate the input
            $validatedData = $request->validate([
                'yearLevelId' => 'required|integer',
                'yearLevelName' => 'required|string|max:255',
            ]);

            $yearLevelId = $validatedData['yearLevelId'];
            $yearLevelName = $validatedData['yearLevelName'];

            // External API endpoint
            $externalApiUrl = "{$baseUrl}sar/SarTrialPrograms/{$id}/profile/year-level";

            // Data to send
            $data = [
                'id' => $yearLevelId,
                'name' => $yearLevelName,
            ];

            // Send PUT request
            $response = Http::withHeaders([
                'Accept' => 'application/json',
            ])->put($externalApiUrl, $data);

            // Safely handle and log the API response
            $responseData = $response->json();
            if (!is_array($responseData)) {
                $responseData = ['response' => $response->body()];
            }

            // Return response based on status
            if ($response->successful()) {
                return response()->json([
                    'message' => 'Year Level updated successfully!',
                    'status' => 'success'
                ]);
            } else {
                return response()->json([
                    'message' => 'Failed to update Year Level.',
                    'status' => 'error'
                ], 400);
            }
        } catch (\Exception $e) {

            // Return error response
            return response()->json([
                'message' => 'An error occurred while updating the Year Level.',
                'status' => 'error'
            ], 500);
        }
    }

    public function setCurriculum(Request $request, $id)
    {
        $baseUrl = config('academic.base_url');

        try {
            // Validate the input
            $validatedData = $request->validate([
                'curriculumId' => 'required|integer',
                'curriculumName' => 'required|string|max:255',
            ]);

            $curriculumId = $validatedData['curriculumId'];
            $curriculumName = $validatedData['curriculumName'];

            // External API endpoint
            $externalApiUrl = "{$baseUrl}sar/SarTrialPrograms/{$id}/profile/curriculum";

            // Data to send in the body
            $data = [
                'id' => $curriculumId,
                'name' => $curriculumName,
            ];

            // Send PUT request with JSON body
            $response = Http::asJson()->put($externalApiUrl, $data);

            // Safely handle and log the API response
            $responseData = $response->json();
            if (!is_array($responseData)) {
                $responseData = ['response' => $response->body()];
            }

            // Return response based on status
            if ($response->successful()) {
                return response()->json([
                    'message' => 'Curriculum updated successfully!',
                    'status' => 'success'
                ]);
            } else {
                return response()->json([
                    'message' => 'Failed to update Curriculum.',
                    'status' => 'error'
                ], 400);
            }
        } catch (\Exception $e) {
            // Return error response
            return response()->json([
                'message' => 'An error occurred while updating the Curriculum.',
                'status' => 'error'
            ], 500);
        }
    }

    public function setTableOfFee(Request $request, $id)
    {
        $baseUrl = config('academic.base_url');

        try {
            // Validate the input
            $validatedData = $request->validate([
                'tableFeeId' => 'required|integer',
                'tableFeeName' => 'required|string|max:255',
            ]);

            $tableFeeId = $validatedData['tableFeeId'];
            $tableFeeName = $validatedData['tableFeeName'];

            // External API endpoint
            $externalApiUrl = "{$baseUrl}sar/SarTrialPrograms/{$id}/profile/table-of-fee";

            // Data to send in the body
            $data = [
                'id' => $tableFeeId,
                'name' => $tableFeeName,
            ];

            // Send PUT request with JSON body
            $response = Http::asJson()->put($externalApiUrl, $data);

            // Safely handle and log the API response
            $responseData = $response->json();
            if (!is_array($responseData)) {
                $responseData = ['response' => $response->body()];
            }

            // Return response based on status
            if ($response->successful()) {
                return response()->json([
                    'message' => 'Table of Fees updated successfully!',
                    'status' => 'success',
                    'apiResponse' => $responseData
                ]);
            } else {
                return response()->json([
                    'message' => 'Failed to update Table of Fees.',
                    'status' => 'error',
                    'apiResponse' => $responseData
                ], 400);
            }
        } catch (\Exception $e) {
            // Return error response
            return response()->json([
                'message' => 'An error occurred while updating the Table of Fees.',
                'status' => 'error',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function setScholarshipProvider(Request $request, $id)
    {
        $baseUrl = config('academic.base_url');

        try {
            // Validate the input
            $validatedData = $request->validate([
                'scholarshipId' => 'required|integer',
                'scholarshipName' => 'required|string|max:255',
            ]);

            // External API endpoint
            $externalApiUrl = "{$baseUrl}sar/SarTrialPrograms/{$id}/profile/scho-provider";

            // Data to send in the body
            $data = [
                'id' => $validatedData['scholarshipId'],
                'name' => $validatedData['scholarshipName'],
            ];

            // Send PUT request with JSON body
            $response = Http::asJson()->put($externalApiUrl, $data);

            // Safely handle and log the API response
            $responseData = $response->json();
            if (!is_array($responseData)) {
                $responseData = ['response' => $response->body()];
            }

            // Return response based on status
            if ($response->successful()) {
                return response()->json([
                    'message' => 'Scholarship Provider updated successfully!',
                    'status' => 'success'
                ]);
            } else {
                return response()->json([
                    'message' => 'Failed to update Scholarship Provider.',
                    'status' => 'error'
                ], 400);
            }
        } catch (\Exception $e) {
            // Return error response
            return response()->json([
                'message' => 'An error occurred while updating the Scholarship Provider.',
                'status' => 'error'
            ], 500);
        }
    }

    public function setGrantTemplate(Request $request, $id)
    {
        $baseUrl = config('academic.base_url');

        try {
            // Validate the input
            $validatedData = $request->validate([
                'grantTemplateId' => 'required|integer',
                'grantTemplateName' => 'required|string|max:255',
            ]);

            // External API endpoint
            $externalApiUrl = "{$baseUrl}sar/SarTrialPrograms/{$id}/profile/grant-template";

            // Data to send in the body
            $data = [
                'id' => $validatedData['grantTemplateId'],
                'name' => $validatedData['grantTemplateName'],
            ];

            // Send PUT request with JSON body
            $response = Http::asJson()->put($externalApiUrl, $data);

            // Safely handle and log the API response
            $responseData = $response->json();
            if (!is_array($responseData)) {
                $responseData = ['response' => $response->body()];
            }

            // Return response based on status
            if ($response->successful()) {
                return response()->json([
                    'message' => 'Grant Template updated successfully!',
                    'status' => 'success'
                ]);
            } else {
                return response()->json([
                    'message' => 'Failed to update Grant Template.',
                    'status' => 'error'
                ], 400);
            }
        } catch (\Exception $e) {
            // Return error response
            return response()->json([
                'message' => 'An error occurred while updating the Grant Template.',
                'status' => 'error'
            ], 500);
        }
    }

    public function removeSubjects(Request $request, AssessmentService $assessmentService)
    {
        $subjectDetailId = $request->input('subjectDetailId');

        if (!$subjectDetailId) {
            return response()->json(['status' => 'error', 'message' => 'Subject ID is required.'], 400);
        }

        $result = $assessmentService->removeSubject($subjectDetailId);

        return response()->json($result);
    }

    public function setClassSchedules(Request $request, $id)
    {
        $baseUrl = config('academic.base_url');

        try {
            // Validate the input
            $validatedData = $request->validate([
                'trialProgramId' => 'required|integer',
                'scheduleId' => 'required|integer',
                'campusId' => 'required|integer',
            ]);

            $scheduleId = $validatedData['scheduleId'];
            $campusId = $validatedData['campusId'];

            $externalApiUrl = "{$baseUrl}sar/SarTrialProgramDetailDetails/{$id}/update-schedule/{$scheduleId}/campus/{$campusId}?tenantId={$campusId}";

            Log::info("Sending PUT request to external API", [
                'url' => $externalApiUrl,
                'payload' => [],
                'method' => 'PUT',
                'detailId' => $id,
                'trialProgramId' => $validatedData['trialProgramId'],
                'scheduleId' => $scheduleId,
                'campusId' => $campusId
            ]);

            $response = Http::asJson()->put($externalApiUrl);
            $responseData = $response->json();

            Log::info("Received response from external API", [
                'response_status' => $response->status(),
                'response_data' => $responseData
            ]);

            if (isset($responseData['message']) && $responseData['message'] === 'Schedule Conflict') {
                Log::warning("Schedule conflict detected", ['scheduleId' => $scheduleId]);
                return response()->json([
                    'message' => 'Unable to assign schedule due to a conflict with another existing schedule.',
                    'status' => 'error'
                ]);
            }

            if (isset($responseData['message']) && $responseData['message'] === 'Class is full') {
                Log::warning("Class is full", ['scheduleId' => $scheduleId]);
                return response()->json([
                    'message' => 'The class has reached its maximum capacity and is no longer available for enrollment.',
                    'status' => 'error'
                ]);
            }

            if ($response->successful()) {
                Log::info("Schedule updated successfully");
                return response()->json([
                    'message' => 'Class Schedules updated successfully!',
                    'status' => 'success'
                ]);
            } else {
                Log::error("Failed to update schedule", [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);
                return response()->json([
                    'message' => $responseData['message'] ?? 'Failed to update Class Schedules.',
                    'status' => 'error'
                ]);
            }
        } catch (\Exception $e) {
            Log::error("Exception thrown while updating schedule", [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'message' => 'An error occurred while updating the Class Schedules.',
                'status' => 'error'
            ]);
        }
    }

    public function processEnrollmentFreshmen(Request $request, $id)
    {
        $employeeId = Auth::user()->employee_id;
        $baseUrl = config('academic.base_url');

        try {
            // Validate the input
            $validatedData = $request->validate([
                'tenantId' => 'required|integer',
                'studentNo' => 'required|string|max:255',
            ]);
            $tenantId = $validatedData['tenantId'];
            $studentNo = $validatedData['studentNo'];

            // External API endpoint
            $externalApiUrl = "{$baseUrl}sar/SarTrialPrograms/{$id}/enroll2/{$employeeId}?tenantId={$tenantId}";

            // Send POST request
            $response = Http::withHeaders([
                'Accept' => 'application/json',
            ])->post($externalApiUrl);

            // Decode response
            $responseData = $response->json();
            $corNumber = $responseData['corNumber'] ?? null;

            // Check if request was successful AND corNumber is present
            if ($response->successful() && $corNumber) {
                // Update StudentProfile
                // StundentProfile::where('student_no', $studentNo)
                //     ->update([
                //         'reg_no' => $corNumber,
                //         'prereg_status' => 'enrolled',
                //         'added_by' => $employeeId
                //     ]);

                return response()->json([
                    'status' => 'success',
                    'message' => $responseData['message'] ?? 'Enrollment processed successfully.',
                    'corNumber' => $corNumber,
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to process enrollment',
                    'details' => $response->body()
                ], 400);
            }

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while processing enrollment.',
                'exception' => $e->getMessage()
            ], 500);
        }
    }

    public function processEnrollment(Request $request, $id)
    {
        $employeeId = Auth::user()->employee_id;
        $baseUrl = config('academic.base_url');

        try {
            // Validate the input
            $validatedData = $request->validate([
                'tenantId' => 'required|integer',
                'studentNo' => 'required|string|max:255',
                'policyId' => 'required|integer',
            ]);
            $tenantId = $validatedData['tenantId'];
            $studentNo = $validatedData['studentNo'];
            $policyId = $validatedData['policyId'];

            // External API endpoint
            $externalApiUrl = "{$baseUrl}sar/SarTrialPrograms/{$id}/enroll2/{$employeeId}?tenantId={$tenantId}";

            // Send POST request
            $response = Http::withHeaders([
                'Accept' => 'application/json',
            ])->post($externalApiUrl);

            // Decode response
            $responseData = $response->json();
            $corNumber = $responseData['corNumber'] ?? null;

            // Check if request was successful AND corNumber is present
            if ($response->successful() && $corNumber) {
                // Update StudentProfile
                // StundentProfile::where('student_no', $studentNo)
                //     ->update([
                //         'reg_no' => $corNumber,
                //         'prereg_status' => 'enrolled',
                //         'added_by' => $employeeId
                //     ]);

                return response()->json([
                    'status' => 'success',
                    'message' => $responseData['message'] ?? 'Enrollment processed successfully.',
                    'corNumber' => $corNumber,
                    'policyId' => $policyId
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to process enrollment',
                    'details' => $response->body()
                ], 400);
            }

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while processing enrollment.',
                'exception' => $e->getMessage()
            ], 500);
        }
    }

    public function getSchedules($subjectId, $termId, Request $request, AssessmentService $assessmentService)
    {
        $campusId = $request->query('campusId'); // still via query string

        if (!$termId || !$subjectId || !$campusId) {
            return response()->json(['status' => 'error', 'message' => 'Term ID, Subject ID, and Campus ID are required.'], 400);
        }

        $schedules = $assessmentService->fetchSchedules($termId, $subjectId, $campusId);

        return response()->json($schedules);
    }

    public function selectSection(Request $request, $sectionId)
    {
        session(['selected_section_id' => (int) $sectionId]);

        return response()->json([
            'status' => 'success',
            'message' => 'Section ID stored',
        ]);
    }


    public function addSubjects(Request $request)
    {
        $baseUrl = config('academic.base_url');

        try {
            // Validate the input
            $validatedData = $request->validate([
                'subjectId' => 'required|integer',
                'subjectTitle' => 'required|string|max:255',
                'trialProgramId' => 'required|integer',
            ]);

            // External API endpoint
            $externalApiUrl = "{$baseUrl}sar/SarTrialProgramDetailDetails";

            // Data to send in the body
            $data = [
                'trialProgramId' => $validatedData['trialProgramId'],
                'subjectId' => $validatedData['subjectId'],
                'subjectName' => $validatedData['subjectTitle'],
            ];

            // Send POST request with JSON body
            $response = Http::asJson()->post($externalApiUrl, $data);

            // Safely handle and log the API response
            $responseData = $response->json();
            if (!is_array($responseData)) {
                $responseData = ['response' => $response->body()];
            }

            // Return response based on status
            if ($response->successful()) {
                return response()->json([
                    'message' => 'Subjects added successfully!',
                    'status' => 'success',
                ]);
            } else {
                return response()->json([
                    'message' => 'Failed to add subjects.',
                    'status' => 'error',
                ], 400);
            }
        } catch (\Exception $e) {
            // Return error response
            return response()->json([
                'message' => 'An error occurred while adding subjects.',
                'status' => 'error',
            ], 500);
        }
    }

    public function getSarStudents(Request $request, $id)
    {
        $setting = SiteSetting::first(); // or use `find(1)` if you have a single row

        // Convert to true or false explicitly
        $enrollmentRegStatus = (bool) $setting->enrollment_hy_reg_status;

        $baseUrl = config('academic.base_url');
        $url = "{$baseUrl}ProgramPolicies/{$id}";
        // Make the HTTP request
        $response = Http::get($url);

        if ($response->successful()) {
            $data = $response->json();

            $programName = $data['programName'] ?? 'N/A';
            $campusName = $data['campusName'] ?? 'N/A';
            $collegeName = $data['collegeName'] ?? 'N/A';
        } else {
            $programName = 'Unavailable';
            $campusName = 'Unavailable';
            $collegeName = 'Unavailable';
        }

        return view('aro.sar.students', compact('programName', 'campusName', 'collegeName', 'id', 'enrollmentRegStatus'));
    }

    public function getStudentsDataByPolicyId(Request $request)
    {
        // Get the authenticated user's ID
        $user_id = Auth::user()->id;

        // Fetch status from users_assigned_academic_statuses
        $assignedStatus = UsersAssignedAcademicStatus::where('user_id', $user_id)->first();

        // Set status value (default to 0 if no record)
        $academicStatus = $assignedStatus ? $assignedStatus->status : 0;

        // Show "Irregular" if status is 0, otherwise blank
        $statusLabel = $academicStatus == 0 ? 'Regular' : '';

        $id = $request->input('id');
        $length = $request->input('length', 10);
        $start = $request->input('start', 0);
        $draw = $request->input('draw', 1);
        $search = $request->input('search')['value'] ?? '';
        $baseUrl = config('academic.base_url');

        $params = [
            'PolicyId' => $id,
            'Row' => $start,
            'PageSize' => $length,
            'Keyword' => $search,
            'TransactionType' => $statusLabel,
            'Status' => 'Submitted'
        ];

        Log::info('Fetching SAR student data', [
            'request_params' => compact('id', 'length', 'start', 'draw', 'search', 'statusLabel'),
            'api_params' => $params
        ]);

        try {
            $url = "{$baseUrl}sar/SarTrialPrograms/datatable/paged";

            $response = Http::timeout(10)->get($url, $params);

            Log::info('SAR API Response Status', ['status' => $response->status()]);
            Log::info('SAR API Raw Body', ['body' => $response->body()]);
            Log::info('SAR API Headers', $response->headers());

            if ($response->successful()) {
                $apiData = $response->json();
                $paginationHeader = $response->header('Pagination');

                if ($paginationHeader) {
                    // Extract total and filtered counts from header
                    $paginationData = json_decode($paginationHeader, true);

                    $total = $paginationData['totalItems'] ?? 0;
                    $filtered = $paginationData['filteredTotalItems'] ?? $total;

                    Log::info('Using pagination header', compact('total', 'filtered'));

                    return response()->json([
                        'draw' => $draw,
                        'data' => $apiData,
                        'recordsTotal' => $total,
                        'recordsFiltered' => $filtered,
                    ]);
                }

                // If API returns paginated structure inside body
                if (isset($apiData['data']) && is_array($apiData['data'])) {
                    $total = $apiData['totalCount'] ?? count($apiData['data']);
                    $filtered = $apiData['filteredCount'] ?? $total;

                    Log::info('Using paginated body', compact('total', 'filtered'));

                    return response()->json([
                        'draw' => $draw,
                        'data' => $apiData['data'],
                        'recordsTotal' => $total,
                        'recordsFiltered' => $filtered,
                    ]);
                }

                // Flat array fallback (no pagination data at all)
                if (is_array($apiData) && isset($apiData[0])) {
                    $total = count($apiData);
                    $paged = array_slice($apiData, $start, $length);

                    Log::warning('Using fallback pagination for flat array.', ['total' => $total]);

                    return response()->json([
                        'draw' => $draw,
                        'data' => $paged,
                        'recordsTotal' => $total,
                        'recordsFiltered' => $total,
                    ]);
                }

                Log::error('Unexpected SAR API structure', ['data' => $apiData]);
            } else {
                Log::error('SAR API request failed', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);
            }
        } catch (\Exception $e) {
            Log::error('SAR API Exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
        }

        return response()->json([
            'draw' => $draw,
            'data' => [],
            'recordsTotal' => 0,
            'recordsFiltered' => 0
        ]);
    }


    public function getSarAssessment(AssessmentService $assessmentService, Request $request, $id = null)
    {
        if ($id === null) {
            return redirect()->route('aro.sar.students')->with('error', 'Please select a student to view the assessment.');
        }

        $trialProgramId = $id; // from route
        $campusId = $request->query('campusId');
        $policyId = $request->query('policyId');

        $baseUrl = config('academic.base_url');
        $url = "{$baseUrl}sar/SarTrialPrograms/{$trialProgramId}?tenantId={$campusId}";

        // API request to get program policy data
        // Make the HTTP request
        $response = Http::get($url);
        $data = $response->json();
        $studentNo = $data['studentNo'] ?? 0;
        $tenantId = $data['campusId'] ?? 0;
        $termId = $data['termId'] ?? 0;
        $programId = $data['programId'] ?? 0;
        $selectedtransactionType = $data['transactionType'] ?? null;
        $selectedclassSectionId = $data['classSectionId'] ?? null;
        $selectedyearLevelId = $data['yearLevelId'] ?? null;
        $selectedCurriculumId = $data['curriculumId'] ?? null;
        $selectedtableOfFeeId = $data['tableOfFeeId'] ?? null;
        $schoProviderId = $data['schoProviderId'] ?? null;
        $selectedschoProviderId = $data['schoProviderId'] ?? null;
        $selectedGrantTemplateId = $data['grantTemplateId'] ?? null;
        $selectedclassSectionIdSession = session('selected_section_id');

        $curriculums = $assessmentService->fetchCurriculumByStudent($studentNo, $tenantId);
        $reportofgrades = $assessmentService->fetchGrades($studentNo, $tenantId);
        $classsections = $assessmentService->fetchClassSections($termId, $programId, $tenantId);
        $yearlevels = $assessmentService->fetchYearLevels();
        $curriculumsByPolicies = $assessmentService->fetchCurriculumsByPolicy($policyId, $tenantId);
        $tableFees = $assessmentService->fetchTableFees($termId, $tenantId);
        $scholarships = $assessmentService->fetchScholarships($tenantId);
        $grantTemplates = $assessmentService->fetchGrantTemplates($schoProviderId, $termId, $tenantId);
        $blockSections = $assessmentService->fetchBlockSections($termId, $selectedclassSectionId, $tenantId);
        $preregisteredsubjects = $assessmentService->fetchPreRegisteredSubjects($studentNo, $termId, $tenantId);
        $countSubjects = $assessmentService->countPreRegisteredRows($studentNo, $termId, $tenantId);
        $sectionList = $assessmentService->fetchSectionList($campusId, $termId, $tenantId);
        $fetchSectionSchedules = $assessmentService->fetchSectionSchedules($selectedclassSectionIdSession, $termId, $tenantId);

        if ($response->successful()) {
            $data = $response->json();

            $studentNo = $data['studentNo'] ?? 'N/A';
            $studentName = $data['studentName'] ?? 'N/A';
            $campusName = $data['campusName'] ?? 'N/A';
            $programId = $data['programId'] ?? 'N/A';
            $programName = $data['programName'] ?? 'N/A';
            $transactionType = $data['transactionType'] ?? 'N/A';
            $status = $data['status'] ?? 'N/A';
            $curriculumId = $data['curriculumId'] ?? 'N/A';
            $curriculum = $data['curriculum'] ?? 'N/A';
            $majorName = $data['majorName'] ?? '---';

        } else {
            $studentNo = 'N/A';
            $studentName = 'N/A';
            $campusName = 'N/A';
            $programId = 'N/A';
            $programName = 'N/A';
            $transactionType = 'N/A';
            $status = 'N/A';
            $curriculumId = 'N/A';
            $curriculum = 'N/A';
            $majorName = 'N/A';
        }

        return view('aro.sar-assessment.index', compact(
            'trialProgramId',
            'tenantId',
            'studentNo',
            'studentName',
            'campusName',
            'programId',
            'programName',
            'transactionType',
            'status',
            'curriculumId',
            'curriculum',
            'majorName',
            'curriculums',
            'reportofgrades',
            'selectedtransactionType',
            'selectedclassSectionId',
            'classsections',
            'yearlevels',
            'selectedyearLevelId',
            'curriculumsByPolicies',
            'selectedCurriculumId',
            'tableFees',
            'selectedtableOfFeeId',
            'scholarships',
            'grantTemplates',
            'selectedschoProviderId',
            'selectedGrantTemplateId',
            'blockSections',
            'preregisteredsubjects',
            'termId',
            'campusId',
            'countSubjects',
            'sectionList',
            'fetchSectionSchedules',
            'selectedclassSectionIdSession',
            'policyId'
        ));
    }
}
