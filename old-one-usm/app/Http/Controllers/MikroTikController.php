<?php

namespace App\Http\Controllers;

use App\Jobs\CreateMikroTikAccount;
use App\Models\MikroTikRequest;
use App\Services\SarService;
use Http;
use Illuminate\Http\Request;
use App\Services\MikroTikService;
use Str;

class MikroTikController extends Controller
{
    protected $mikrotik;
    protected SarService $sarService;

    public function __construct(MikroTikService $mikrotik, SarService $sarService)
    {
        $this->mikrotik = $mikrotik;
        $this->sarService = $sarService;
    }

    public function showForm()
    {
        $studentId = auth()->user()->student_id;

        // Fetch active semester from service (already returns array)
        $data = $this->sarService->activeSemesters();

        $activeTermId = null;
        $activeTermName = null;

        if ($data) {
            $active = collect($data)->firstWhere('campusId', 1);

            if ($active) {
                $activeTermId = $active['termId'];      // e.g., 102
                $activeTermName = $active['term'];      // e.g., 2025-2026 2nd Semester
            }
        }

        // Get all requested accounts for this student
        $requests = MikroTikRequest::where('student_no', 'like', $studentId . '%')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('student.mikrotik.add-user', compact('requests', 'activeTermId', 'activeTermName'));
    }



    public function addHotspotUser(Request $request)
    {
        $studentId = auth()->user()->student_id;
        $password = Str::random(12);

        // Fetch active semester from service (already returns array)
        $data = $this->sarService->activeSemesters();

        if (!$data) {
            return back()->with('error', 'Cannot fetch active semester.');
        }

        $active = collect($data)->firstWhere('campusId', 1);

        if (!$active) {
            return back()->with('error', 'No active semester for this campus.');
        }

        $semester = $active['term'];   // e.g., "2025-2026 2nd Semester"
        $termId = $active['termId'];   // e.g., 102

        // Combine student ID with termId
        $studentNoWithTerm = $studentId . '-' . $termId;

        // Check if already requested
        $existing = MikroTikRequest::where('student_no', $studentNoWithTerm)
            ->where('semester', $semester)
            ->first();

        if ($existing) {
            return back()->with('error', 'You already requested an internet account for this semester.');
        }

        // Dispatch the job
        CreateMikroTikAccount::dispatch($studentNoWithTerm, $password, $semester);

        return back()->with('success', 'Your request is being processed. You will see the account once it is created.');
    }


}
