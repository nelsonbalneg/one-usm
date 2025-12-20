<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Services\SarService;


/**
 * @property string $student_id
 * @property int $campus_id
 * @property int $tenant_id
 */


class StudentController extends Controller
{
    protected SarService $sarService;

    public function __construct(SarService $sarService)
    {
        $this->sarService = $sarService;
    }

    public function dashboard()
    {
        $studentNo = auth()->user()->getAttribute('student_id');
        $tenantId = auth()->user()->getAttribute('tenant_id');

        $response = $this->sarService->getStudentAccountabilities($studentNo, $tenantId);

        $accountabilities = [];

        if ($response && isset($response['accountabilities'])) {
            $accountabilities = $response['accountabilities'];
        }

        return view('student.dashboard', compact('accountabilities'));
    }

}
