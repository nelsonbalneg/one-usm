<?php

namespace App\Http\Controllers\Aro;
use App\Http\Controllers\Controller;
use App\Models\StudentRequirement;
use Illuminate\Http\Request;

class AROStudentRequirementsController extends Controller
{
    public function index()
    {
        return view('aro.students.requirements',);
    }

    public function getRequirements($id)
    {
        $requirement = StudentRequirement::where('student_id', $id)->first();

        if (!$requirement) {
            return response()->json(null);
        }

        return response()->json($requirement);
    }

    public function saveRequirements(Request $request)
    {
        try {
            $data = $request->validate([
                'student_id' => 'required|integer',
                'student_type' => 'required|integer',
                'goodmoral' => 'boolean',
                'card' => 'boolean',
                'psa' => 'boolean',
                'hdismissal' => 'boolean',
                'certificatetransfer' => 'boolean',
                'transcript' => 'boolean',
                'affidavit' => 'boolean',
            ]);

            $requirement = StudentRequirement::updateOrCreate(
                ['student_id' => $data['student_id']],
                $data
            );

            return response()->json(['message' => 'Saved successfully', 'data' => $requirement]);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json(['message' => 'Something went wrong'], 500);
        }
    }
}
