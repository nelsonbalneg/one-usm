<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Log;

class SarService
{
    protected string $apiUrl;
    protected string $redirectUrl;
    protected int $tenantId;
    protected int $campusId;
    protected string $baseUrl;
    protected string $ccdRedirectUrl;
    protected int $ccdTenantId;
    protected int $ccdCampusId;
    protected string $fpesApiUrl;

    public function __construct()
    {
        $this->baseUrl = config('academic.base_url');
        $this->apiUrl = config('academic.sar_api_url');
        $this->redirectUrl = config('academic.sar_redirect_url');
        $this->tenantId = config('academic.sar_tenant_id');
        $this->campusId = config('academic.sar_campus_id');
        $this->ccdRedirectUrl = config('academic.ccd_redirect_url');
        $this->ccdTenantId = config('academic.ccd_tenant_id');
        $this->ccdCampusId = config('academic.ccd_campus_id');
        $this->fpesApiUrl = config('academic.fpes_api_url');

    }

    /**
     * Generate SAR token
     */
    public function generateToken(string $studentNo, int $campusId, int $tenantId): ?string
    {
        $studentNo = rawurlencode($studentNo);
        $campusId = rawurlencode($campusId);
        $tenantId = rawurlencode($tenantId);

        // Example:
        // http://IP/Auth/token/{studentNo}/{campusId}?tenantId=1
        $url = "{$this->apiUrl}/{$studentNo}/{$campusId}?tenantId={$tenantId}";

        $response = Http::post($url);

        if ($response->ok()) {
            return trim($response->body());
        }

        return null;
    }

    public function fpesGenerateToken(int $campusId, string $studentNo, int $tenantId): ?string
    {
        $url = "{$this->fpesApiUrl}student/student-portal-token";

        // Try POST request
        $response = Http::withHeaders([
            'Accept' => 'application/json'
        ])->post($url, [
                    'campusId' => $campusId,
                    'studentNo' => $studentNo,
                    'tenantId' => $tenantId,
                ]);

        if ($response->ok()) {
            $token = trim($response->body());
            if (!empty($token)) {
                return $token;
            }
        }

        // Optional: fallback GET request
        $responseGet = Http::withHeaders([
            'Accept' => 'application/json'
        ])->get($url, [
                    'campusId' => $campusId,
                    'studentNo' => $studentNo,
                    'tenantId' => $tenantId,
                ]);

        if ($responseGet->ok()) {
            $token = trim($responseGet->body());
            if (!empty($token)) {
                return $token;
            }
        }

        // If still null, return null
        return null;
    }


    /**
     * Build redirect URL
     */
    public function getRedirectUrl(string $token): string
    {
        return "{$this->redirectUrl}{$token}";
    }

    public function getCddRedirectUrl(string $token): string
    {
        return "{$this->ccdRedirectUrl}{$token}";
    }

    public function getStudentGrades(string $studentNo): ?array
    {
        $url = "{$this->baseUrl}/Grades/studentreport/{$studentNo}?tenantId={$this->tenantId}";

        $response = Http::get($url);

        if ($response->ok()) {
            return $response->json();
        }

        return null;
    }

    public function activeSemesters()
    {
        $apiUrl = "{$this->baseUrl}/ActiveSemesters/active-only";
        $response = Http::get($apiUrl);

        if ($response->successful()) {
            return $response->json(); // <-- returns array
        }

        return null;
    }

    public function getFacultyEvaluationStatus(string $studentNo, int $termId, int $campusId)
    {
        $url = "{$this->baseUrl}/FacultyEvaluations/campus/{$campusId}/term/{$termId}/student/{$studentNo}";
        $response = Http::get($url);

        if ($response->ok()) {
            $data = $response->json();

            return [
                'totalFacultyEvaluated' => $data['totalFacultyEvaluated'] ?? 0,
                'totalSubjectsEnrolled' => $data['totalSubjectsEnrolled'] ?? 0,
            ];
        }

        return null;
    }

    public function getStudentCurriculumId(string $studentNo, int $tenantId)
    {
        $url = "{$this->baseUrl}/Students/{$studentNo}?tenantId={$tenantId}";
        $response = Http::get($url);

        if ($response->ok()) {
            $data = $response->json();
            return [
                'curriculumId' => $data['curriculumId'] ?? null,
                'progId' => $data['progId'] ?? null,
            ];
        }

        return null;
    }

    public function getCurriculumListByProgId(int $progId, int $tenantId, int $curriculumId)
    {
        $url = "{$this->baseUrl}/Curriculums/filter/program/{$progId}?tenantId={$tenantId}";
        $response = Http::get($url);

        if ($response->ok()) {
            $data = $response->json();

            // If the API returns an array of curriculums, filter by curriculumId
            if (is_array($data)) {
                foreach ($data as $curriculum) {
                    if (isset($curriculum['indexId']) && $curriculum['indexId'] == $curriculumId) {
                        return [
                            'curriculumId' => $curriculum['indexId'],
                            'curriculumCode' => $curriculum['curriculumCode'] ?? null,
                            'progId' => $progId
                        ];
                    }
                }
            }
        }

        return null; // Return null if no match is found
    }

    public function getCurriculumByStudent(string $studentNo, int $tenantId): ?array
    {
        $url = "{$this->baseUrl}/TrialProgram/curriculum/student/{$studentNo}?tenantId={$tenantId}";

        $response = Http::get($url);

        if ($response->ok()) {
            return $response->json();
        }

        return null;
    }

    public function getStudentDetails($encodedEmail, $campusIdSelected, $tenantId)
    {
        $url = "{$this->baseUrl}Students/campus/{$campusIdSelected}/getbyemail/{$encodedEmail}?tenantId={$tenantId}";

        $response = Http::get($url);

        if ($response->ok()) {
            return $response->json();
        }

        return null;
    }

    public function getStudentAccountabilities(string $studentNo, int $tenantId): ?array
    {
        $url = "{$this->baseUrl}/Registrations/student-accountabilities/{$studentNo}?tenantId={$tenantId}";

        $response = Http::get($url);

        if ($response->ok()) {
            return $response->json();
        }

        return null;
    }

}
