<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\EvaluationRequest;
use App\Services\SarService;
use Auth;
use Http;
use Illuminate\Http\Request;
use Log;

class AcademicEvaluationController extends Controller
{
    protected SarService $sarService;

    public function __construct(SarService $sarService)
    {
        $this->sarService = $sarService;
    }

    public function index()
    {
        $requests = EvaluationRequest::where('student_id', Auth::user()->student_id)
            ->orderBy('created_at', 'desc')
            ->get();

        $hasPending = $requests->contains('status', 'Pending');

        return view('student.academic-evaluation.index', compact('requests', 'hasPending'));
    }

    public function store()
    {
        $datePart = now()->format('Ymd'); // e.g., 20251204

        // Get the last request_id for today
        $lastRequest = EvaluationRequest::whereDate('created_at', today())
            ->orderBy('created_at', 'desc')
            ->first();

        if ($lastRequest) {
            // Extract the numeric part after the dash
            $lastNumber = (int) substr($lastRequest->request_id, 9); // 8 chars for date + 1 dash
            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 1;
        }

        $uniqueId = $datePart . '-' . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);

        EvaluationRequest::create([
            'request_id' => $uniqueId,
            'student_id' => Auth::user()->student_id,
            'status' => 'Pending',
            'remarks' => null,
        ]);

        return redirect()->back()->with('success', 'Evaluation request submitted successfully!');
    }



    public function cancel($id)
    {
        $request = EvaluationRequest::where('id', $id)
            ->where('student_id', Auth::user()->student_id)
            ->where('status', 'Pending')
            ->first();

        if (!$request) {
            return redirect()->back()->with('error', 'Unable to cancel request.');
        }

        // Check if request was created less than 24 hours ago
        if ($request->created_at->diffInHours(now()) >= 24) {
            return redirect()->back()->with('error', 'Cancellation period has expired. Requests older than 24 hours cannot be cancelled.');
        }

        $request->update(['status' => 'Cancelled']);

        return redirect()->back()->with('success', 'Request cancelled successfully.');
    }

}
