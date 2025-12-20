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

class CcdCaresController extends Controller
{
    protected SarService $sarService;

    public function __construct(SarService $sarService)
    {
        $this->sarService = $sarService;
    }

    public function index(){
        return view('student.ccd-cares.index');
    }

    public function connect()
    {
        try {
            $studentNo = auth()->user()->getAttribute('student_id');
            $campusId = auth()->user()->getAttribute('campus_id');
            $tenantId = auth()->user()->getAttribute('tenant_id');

            $token = $this->sarService->generateToken($studentNo, $campusId, $tenantId);

            if (!$token) {
                return back()->with('error', 'Unable to generate SAR token.');
            }

            $redirectUrl = $this->sarService->getCddRedirectUrl($token);

            return redirect()->away($redirectUrl);

        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred while connecting to SAR.');
        }
    }
}
