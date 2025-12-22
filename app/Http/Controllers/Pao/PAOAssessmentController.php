<?php

namespace App\Http\Controllers\Pao;

use App\Http\Controllers\Controller;
use App\Models\Requirement;
use App\Models\SiteSetting;
use App\Models\StudentRequirement;
use App\Models\StundentProfile;
use App\Models\User;
use App\Models\UsersAssignedAcademicStatus;
use App\Models\UsersAssignedProgram;
use Auth;
use DB;
use Http;
use Illuminate\Http\Request;
use Log;
use App\Services\AssessmentService;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class PAOAssessmentController extends Controller
{
    public function index(AssessmentService $assessmentService, $id = null)
    {

        try {
            if ($id === null) {
                return redirect()->route('pao.students.index')->with('error', 'Please select a student to view the assessment.');
            }

            $id = Crypt::decrypt($id); // 🔐 Decrypt here
        } catch (DecryptException $e) {
            return redirect()->route('pao.students.index')->with('error', 'Invalid student identifier.');
        }

        $student = StundentProfile::findOrFail($id);

        // null is pending
        // 0 - for assessment
        // 1 - enrolled
        // 2 - cancelled

        // if ($student->status_id === '1') {
        //     return redirect()->route('pao.students.index')->with('error_enroll', 'Student has already enrolled.');
        // }

        /* Trial Program API ------------------------------------------ */
        $processEnrollmentData = $assessmentService->processForAssessment($id);

        if (!$processEnrollmentData) {
            return redirect()->route('pao.students.index')->with('error', 'Failed to retrieve assessment data');
        }

        $trialProgramId = $processEnrollmentData['id'] ?? null;
        $studentNo = $processEnrollmentData['studentNo'] ?? null;
        $studentName = $processEnrollmentData['studentName'] ?? null;
        $campusName = $processEnrollmentData['campusName'] ?? null;
        $tenantId = $processEnrollmentData['campusId'] ?? null;
        $realCampusId = $processEnrollmentData['realCampusId'] ?? null;
        $campusId = $processEnrollmentData['campusId'] ?? null;
        $programName = $processEnrollmentData['programName'] ?? null;
        $programId = $processEnrollmentData['programId'] ?? null;
        $majorId = $processEnrollmentData['majorId'] ?? null;
        $majorName = $processEnrollmentData['majorName'] ?? null;
        $collegeName = $processEnrollmentData['collegeName'] ?? null;
        $collegeId = $processEnrollmentData['collegeId'] ?? null;
        $termId = $processEnrollmentData['termId'] ?? null;
        $ceeUserId = $processEnrollmentData['ceeUserId'] ?? null;
        $selectedclassSectionIdSession = session('selected_section_id');
        /* Trial Program API ------------------------------------------ */

        /* New values (from request or API response) ------------------------------------------ */
        $student->student_no = $processEnrollmentData['studentNo'] ?? $student->student_no;
        $student->prereg_term_id = $processEnrollmentData['termId'] ?? $student->prereg_term_id;
        $student->save();
        /* New values (from request or API response) ------------------------------------------ */

        /* Fetch the user's photo and other details from StundentProfile Model ------------------------------------------ */
        $fullname = "{$student->last_name}, {$student->first_name}";
        $photo = $student->user->photo;
        $policyId = $student->policyId;
        $user_id = $student->user_id;
        $status_id = $student->status_id; // Added status_id to track enrollment status
        /* Fetch the user's photo and other details from StundentProfile Model ------------------------------------------ */

        $requirements = Requirement::where('user_id', $user_id)
            ->where(function ($query) {
                $query->whereNotNull('hepa_b_test')
                    ->orWhereNotNull('chest_x_ray')
                    ->orWhereNotNull('preg_test');
            })
            ->get();



        /* Fetch from Trial Program API ------------------------------------------ */
        $trialProgram = $assessmentService->fetchStudentTrialProgram($trialProgramId, $tenantId);
        $schoProviderId = $trialProgram['schoProviderId'] ?? null;

        $selectedCurriculumId = $trialProgram['curriculumId'] ?? null;
        $selectedtransactionType = $trialProgram['transactionType'] ?? null;
        $selectedclassSectionId = $trialProgram['classSectionId'] ?? null;
        $selectedyearLevelId = $trialProgram['yearLevelId'] ?? null;
        $selectedtableOfFeeId = $trialProgram['tableOfFeeId'] ?? null;
        $selectedschoProviderId = $trialProgram['schoProviderId'] ?? null;
        $selectedGrantTemplateId = $trialProgram['grantTemplateId'] ?? null;

        $curriculum = $assessmentService->fetchCurriculumByStudent($studentNo, $tenantId);
        $reportofgrades = $assessmentService->fetchGrades($studentNo, $tenantId);
        $classsections = $assessmentService->fetchClassSections($termId, $programId, $tenantId);
        $yearlevels = $assessmentService->fetchYearLevels();
        $curriculums = $assessmentService->fetchCurriculumsByPolicy($policyId, $tenantId);
        $tableFees = $assessmentService->fetchTableFees($termId, $tenantId);
        $scholarships = $assessmentService->fetchScholarships($tenantId);
        $grantTemplates = $assessmentService->fetchGrantTemplates($schoProviderId, $termId, $tenantId);
        $blockSections = $assessmentService->fetchBlockSections($termId, $selectedclassSectionId, $tenantId);
        $preregisteredsubjects = $assessmentService->fetchPreRegisteredSubjects($studentNo, $termId, $tenantId);
        $countSubjects = $assessmentService->countPreRegisteredRows($studentNo, $termId, $tenantId);
        $sectionList = $assessmentService->fetchSectionList($campusId, $termId, $tenantId);
        $fetchSectionSchedules = $assessmentService->fetchSectionSchedules($selectedclassSectionIdSession, $termId, $tenantId);


        return view("pao.assessment.index", compact(
            'curriculum',
            'reportofgrades',
            'classsections',
            'yearlevels',
            'curriculums',
            'tableFees',
            'scholarships',
            'trialProgramId',
            'id',
            'fullname',
            'programName',
            'photo',
            'tenantId',
            'schoProviderId',
            'campusId',
            'termId',
            'studentNo',
            'programId',
            'grantTemplates',
            'blockSections',
            'preregisteredsubjects',
            'selectedCurriculumId',
            'selectedtransactionType',
            'selectedclassSectionId',
            'selectedyearLevelId',
            'selectedtableOfFeeId',
            'selectedschoProviderId',
            'selectedGrantTemplateId',
            'countSubjects',
            'requirements',
            'user_id',
            'majorId',
            'majorName',
            'sectionList',
            'fetchSectionSchedules',
            'selectedclassSectionIdSession',
            'status_id'
        ));
    }


    public function getGrantTemplates($providerId, Request $request)
    {
        $baseUrl = config('academic.base_url');
        $termId = 96; // Or get dynamically from $request if needed
        $tenantId = 1;

        $grantUrl = "{$baseUrl}SchoProviders/{$providerId}/get-grant-templates/{$termId}?tenantId={$tenantId}";
        $grantResponse = Http::withHeaders([
            'Accept' => 'application/json',
        ])->get($grantUrl);

        $granttemplates = $grantResponse->successful() ? $grantResponse->json() : [];

        return response()->json($granttemplates);
    }

    public function getTrialProgram()
    {
        return redirect()->route('pao.assessment.index');
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

    public function getSchedules($subjectId, $termId, Request $request, AssessmentService $assessmentService)
    {
        $campusId = $request->query('campusId'); // still via query string

        if (!$termId || !$subjectId || !$campusId) {
            return response()->json(['status' => 'error', 'message' => 'Term ID, Subject ID, and Campus ID are required.'], 400);
        }

        $schedules = $assessmentService->fetchSchedules($termId, $subjectId, $campusId);

        return response()->json($schedules);
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

    public function processEnrollment(Request $request, $id)
    {
        $employeeId = Auth::user()->employee_id;
        $baseUrl = config('academic.base_url');

        Log::info('Enrollment process started', [
            'employeeId' => $employeeId,
            'requestId' => $id,
            'requestData' => $request->all()
        ]);

        try {
            $validatedData = $request->validate([
                'tenantId' => 'required|integer',
                'studentNo' => 'required|string|max:255',
                'policyId' => 'required|integer',
            ]);
            $tenantId = $validatedData['tenantId'];
            $studentNo = $validatedData['studentNo'];
            $policyId = $validatedData['policyId'];

            $externalApiUrl = "{$baseUrl}sar/SarTrialPrograms/{$id}/enroll2/{$employeeId}?tenantId={$tenantId}";

            Log::info('Sending enrollment request to API', [
                'url' => $externalApiUrl
            ]);

            $response = Http::withHeaders([
                'Accept' => 'application/json',
            ])->post($externalApiUrl);

            $responseData = $response->json();
            $corNumber = $responseData['corNumber'] ?? null;

            Log::info('Received API response', [
                'status' => $response->status(),
                'response' => $responseData
            ]);

            if ($response->successful() && $corNumber) {
                // Optional: update StudentProfile here
                Log::info('Enrollment successful', [
                    'studentNo' => $studentNo,
                    'corNumber' => $corNumber,
                    'policyId' => $policyId
                ]);

                return response()->json([
                    'status' => 'success',
                    'message' => $responseData['message'] ?? 'Enrollment processed successfully.',
                    'corNumber' => $corNumber,
                    'policyId' => $policyId
                ]);
            } else {
                Log::warning('Enrollment failed', [
                    'studentNo' => $studentNo,
                    'api_response' => $response->body()
                ]);

                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to process enrollment',
                    'details' => $response->body()
                ], 400);
            }

        } catch (\Exception $e) {
            Log::error('Exception during enrollment process', [
                'error' => $e->getMessage(),
                'stack' => $e->getTraceAsString()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while processing enrollment.',
                'exception' => $e->getMessage()
            ], 500);
        }
    }

    public function processEnrollment2(Request $request, $id)
    {
        $employeeId = Auth::user()->employee_id;
        $baseUrl = config('academic.base_url');

        Log::info('Enrollment process started', [
            'employeeId' => $employeeId,
            'requestId' => $id,
            'requestData' => $request->all()
        ]);

        try {
            $validatedData = $request->validate([
                'tenantId' => 'required|integer',
                'studentNo' => 'required|string|max:255',
            ]);
            $tenantId = $validatedData['tenantId'];
            $studentNo = $validatedData['studentNo'];

            $externalApiUrl = "{$baseUrl}sar/SarTrialPrograms/{$id}/enroll2/{$employeeId}?tenantId={$tenantId}";

            Log::info('Sending enrollment request to API', [
                'url' => $externalApiUrl
            ]);

            $response = Http::withHeaders([
                'Accept' => 'application/json',
            ])->post($externalApiUrl);

            $responseData = $response->json();
            $corNumber = $responseData['corNumber'] ?? null;

            Log::info('Received API response', [
                'status' => $response->status(),
                'response' => $responseData
            ]);

            if ($response->successful() && $corNumber) {
                // Optional: update StudentProfile here
                Log::info('Enrollment successful', [
                    'studentNo' => $studentNo,
                    'corNumber' => $corNumber,
                ]);

                return response()->json([
                    'status' => 'success',
                    'message' => $responseData['message'] ?? 'Enrollment processed successfully.',
                    'corNumber' => $corNumber
                ]);
            } else {
                Log::warning('Enrollment failed', [
                    'studentNo' => $studentNo,
                    'api_response' => $response->body()
                ]);

                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to process enrollment',
                    'details' => $response->body()
                ], 400);
            }

        } catch (\Exception $e) {
            Log::error('Exception during enrollment process', [
                'error' => $e->getMessage(),
                'stack' => $e->getTraceAsString()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while processing enrollment.',
                'exception' => $e->getMessage()
            ], 500);
        }
    }

    public function getRequirements($id)
    {
        // Get all requirement records for the given user
        $requirements = Requirement::where('user_id', $id)->get();

        // Get the user data
        $user = User::findOrFail($id);

        return view('pao.students.requirements', compact('requirements', 'user'));

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

    public function noAdmissionRequirements($id)
    {
        $students = StundentProfile::from('stundent_profiles as sp')
            ->leftJoin('student_requirements as sr', 'sp.id', '=', 'sr.student_id')
            ->where('sp.policyId', $id)
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
            ->select(
                'sp.id as student_profile_id',
                'sp.student_type',
                'sp.first_name',
                'sp.last_name',
                'sp.gender',
                'sp.programName',
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
                'sp.date_confirmed'
            )
            ->orderBy('sp.last_name', 'asc')
            ->get();

        // Build program title from the first student
        $programTitle = '';
        if ($students->isNotEmpty()) {
            $first = $students->first();
            $programTitle = $first->programName;
            if (!empty($first->majorDiscDesc)) {
                $programTitle .= ' - ' . $first->majorDiscDesc;
            }
        }

        return view('pao.no-admission-requirements.index', compact('students', 'programTitle'));
    }

    public function programPolicy()
    {
        $setting = SiteSetting::first(); // or use `find(1)` if you have a single row

        // Convert to true or false explicitly
        $enrollmentIrregStatus = (bool) $setting->enrollment_hy_ireg_status;

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

        return view('pao.sar.index', compact('selectedPrograms', 'counts', 'totalCounts', 'paoUsers', 'enrollmentIrregStatus'));
    }

    public function getSarStudents(Request $request, $id)
    {
        $setting = SiteSetting::first(); // or use `find(1)` if you have a single row

        // Convert to true or false explicitly
        $enrollmentIrregStatus = (bool) $setting->enrollment_hy_ireg_status;

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

        return view('pao.sar.students', compact('programName', 'campusName', 'collegeName', 'id', 'enrollmentIrregStatus'));
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
        $statusLabel = $academicStatus == 0 ? 'Irregular' : '';

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
            return redirect()->route('pao.sar.students')->with('error', 'Please select a student to view the assessment.');
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

        return view('pao.sar-assessment.index', compact(
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
