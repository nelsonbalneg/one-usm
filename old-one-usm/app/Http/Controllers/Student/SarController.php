<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Services\SarService;
use Http;
use Illuminate\Http\Request;
use Log;

/**
 * @property string $student_id
 * @property int $campus_id
 * @property int $tenant_id
 */

class SarController extends Controller
{
    protected SarService $sarService;

    public function __construct(SarService $sarService)
    {
        $this->sarService = $sarService;
    }


    public function index()
    {
        return view('student.sar.index');
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

            $redirectUrl = $this->sarService->getRedirectUrl($token);

            return redirect()->away($redirectUrl);

        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred while connecting to SAR.');
        }
    }
}
