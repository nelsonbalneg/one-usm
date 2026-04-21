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

class ReportOfGradesController extends Controller
{
    protected SarService $sarService;

    public function __construct(SarService $sarService)
    {
        $this->sarService = $sarService;
    }

    public function index()
    {
        $studentNo = auth()->user()->getAttribute('student_id');
        $campusId = auth()->user()->getAttribute('campus_id');
        $tenantId = auth()->user()->getAttribute('tenant_id');

        // Get all term grades
        $gradesData = $this->sarService->getStudentGrades($studentNo, $tenantId);

        $finalTerms = [];
        $lastTermIndex = count($gradesData) - 1; // get index of last term

        foreach ($gradesData as $index => $term) {

            $termId = $term['termId'] ?? null;
            if (!$termId)
                continue;

            $evaluated = true; // default: true for all terms except last

            // Only check evaluation for the last term
            if ($index === $lastTermIndex) {
                $evaluation = $this->sarService->getFacultyEvaluationStatus(
                    $studentNo,
                    $termId,
                    $campusId
                );

                if ($evaluation) {
                    $totalEvaluated = $evaluation['totalFacultyEvaluated'] ?? 0;
                    $totalRequired = $evaluation['totalSubjectsEnrolled'] ?? 0;

                    $evaluated = ($totalEvaluated == $totalRequired);
                }
            }

            $term['evaluated'] = $evaluated;
            $finalTerms[] = $term;
        }

        return view('student.report-of-grades.index', [
            'gradesData' => $finalTerms
        ]);
    }

}
