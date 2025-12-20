<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Services\SarService;
use Illuminate\Http\Request;

/**
 * @property string $student_id
 * @property int $campus_id
 * @property int $tenant_id
 */

class CurriculumController extends Controller
{
    protected SarService $sarService;

    public function __construct(SarService $sarService)
    {
        $this->sarService = $sarService;
    }

    public function index()
    {
        $studentNo = auth()->user()->getAttribute('student_id');
        $tenantId = auth()->user()->getAttribute('tenant_id');

        $studentCurriculumId = $this->sarService->getStudentCurriculumId($studentNo, $tenantId);
        $studentCurriculumDetails = $this->sarService->getCurriculumByStudent($studentNo, $tenantId);

        if (!$studentCurriculumId) {
            return view('student.curriculum.index', [
                'curriculumCode' => null,
                'curriculumDetails' => null
            ]);
        }

        $curriculumId = $studentCurriculumId['curriculumId'] ?? null;
        $progId = $studentCurriculumId['progId'] ?? null;

        $curriculum = $this->sarService->getCurriculumListByProgId($progId, $tenantId, $curriculumId);

        return view('student.curriculum.index', [
            'curriculumCode' => $curriculum['curriculumCode'] ?? null,
            'curriculumDetails' => $studentCurriculumDetails // pass full details
        ]);
    }

}
