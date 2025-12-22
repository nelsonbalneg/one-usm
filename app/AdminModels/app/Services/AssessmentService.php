<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class AssessmentService
{
    protected string $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('academic.base_url');
    }

    public function fetchStudentTrialProgram($trialProgramId, $tenantId)
    {
        $url = "{$this->baseUrl}sar/SarTrialPrograms/{$trialProgramId}?tenantId={$tenantId}";
        return $this->get($url);
    }

    public function fetchCurriculumByStudent($studentNo, $tenantId)
    {
        $url = "{$this->baseUrl}TrialProgram/curriculum/student/{$studentNo}?tenantId={$tenantId}";
        return $this->get($url);
    }

    public function fetchGrades($studentNo, $tenantId)
    {
        $url = "{$this->baseUrl}Grades/studentreport/{$studentNo}?tenantId={$tenantId}";
        return $this->get($url);
    }

    public function fetchClassSections($termId, $programId, $tenantId)
    {
        $url = "{$this->baseUrl}ClassSections/by-program/term/{$termId}/program/{$programId}?tenantId={$tenantId}";
        return $this->get($url);
    }

    public function fetchYearLevels()
    {
        return Cache::remember('year_levels', 3600, function () {
            $url = "{$this->baseUrl}YearLevel/list";
            return $this->get($url);
        });
    }

    public function fetchCurriculumsByPolicy($policyId, $tenantId)
    {
        $url = "{$this->baseUrl}Curriculums/filter/by-policyId/{$policyId}?tenantId={$tenantId}";
        return $this->get($url);
    }

    public function fetchTableFees($termId, $tenantId)
    {
        $url = "{$this->baseUrl}TableOfFees/term/{$termId}?tenantId={$tenantId}";
        return $this->get($url);
    }

    public function fetchScholarships($tenantId)
    {
        $url = "{$this->baseUrl}SchoProviders?tenantId={$tenantId}";
        return $this->get($url);
    }

    public function fetchGrantTemplates($providerId, $termId, $tenantId)
    {
        $url = "{$this->baseUrl}SchoProviders/{$providerId}/get-grant-templates/{$termId}?tenantId={$tenantId}";
        return $this->get($url);
    }

    public function fetchBlockSections($termId, $sectionId, $tenantId)
    {
        $url = "{$this->baseUrl}ClassSchedules/get-schedules-by-section/{$termId}/{$sectionId}?tenantId={$tenantId}";
        return $this->get($url);
    }

    public function fetchPreRegisteredSubjects($studentNo, $termId, $tenantId)
    {
        $url = "{$this->baseUrl}sar/SarTrialPrograms/by-student/{$studentNo}/{$termId}?tenantId={$tenantId}";
        return $this->get($url);
    }

    public function countPreRegisteredRows($studentNo, $termId, $tenantId)
    {
        $data = $this->fetchPreRegisteredSubjects($studentNo, $termId, $tenantId);
        return isset($data['details']) ? count($data['details']) : 0;
    }

    public function removeSubject($subjectDetailId)
    {
        $url = "{$this->baseUrl}sar/SarTrialProgramDetailDetails/{$subjectDetailId}";

        $response = Http::delete($url);

        return $response->successful()
            ? ['status' => 'success', 'message' => 'Subject removed']
            : ['status' => 'error', 'message' => 'Failed to remove subject', 'code' => $response->status()];
    }

    public function fetchSchedules($termId, $subjectId, $campusId)
    {
        $url = "{$this->baseUrl}ClassSchedules/get-schedule-by-subject/term/{$termId}/subject/{$subjectId}?tenantId={$campusId}";
        return $this->get($url);
    }

    public function fetchSectionList($campusId, $termId, $tenantId)
    {
        $url = "{$this->baseUrl}ClassSections/campus/{$campusId}/term/{$termId}?tenantId={$tenantId}";
        return $this->get($url);
    }

    public function fetchSectionSchedules($sectionId, $termId, $tenantId)
    {
        $url = "{$this->baseUrl}ClassSchedules/get-schedules-by-section/{$termId}/{$sectionId}?tenantId={$tenantId}";
        return $this->get($url); // Assuming there's a `get()` method for sending HTTP GET requests
    }

    public function fetchGetScheduleBySection($sectionId, $termId, $tenantId)
    {
        $url = "{$this->baseUrl}api/v2/ClassSchedules/get-schedules-by-section/{$termId}/{$sectionId}?tenantId={$tenantId}";

        $response = Http::withHeaders([
            'Accept' => 'application/json'
        ])->get($url);

        if ($response->successful()) {
            return $response->json();
        }

        return ['error' => 'API call failed', 'status' => $response->status()];
    }

    public function processForAssessment($id)
    {
        $url = "{$this->baseUrl}CeeV/student-profile/{$id}/process-for-assessment";

        $response = Http::post($url);

        if (!$response->successful()) {
            return null;
        }

        $data = $response->json();

        // Return only the specific fields
        return [
            'id' => $data['id'] ?? null,
            'studentNo' => $data['studentNo'] ?? null,
            'studentName' => $data['studentName'] ?? null,
            'campusId' => $data['campusId'] ?? null,
            'campusName' => $data['campusName'] ?? null,
            'programId' => $data['programId'] ?? null,
            'programName' => $data['programName'] ?? null,
            'collegeId' => $data['collegeId'] ?? null,
            'collegeName' => $data['collegeName'] ?? null,
            'departmentId' => $data['departmentId'] ?? null,
            'realCampusId' => $data['realCampusId'] ?? null,
            'termId' => $data['termId'] ?? null,
            'ceeUserId' => $data['ceeUserId'] ?? null,
            'majorId' => $data['majorId'] ?? null,
            'majorName' => $data['majorName'] ?? null,
        ];
    }

    private function get($url)
    {
        $response = Http::withHeaders(['Accept' => 'application/json'])->get($url);
        return $response->successful() ? $response->json() : [];
    }
}

?>