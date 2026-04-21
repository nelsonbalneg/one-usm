<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\StudentYearbook;
use Auth;
use Illuminate\Http\Request;

class StudentYearBookController extends Controller
{
    /**
     * Show the form to edit the yearbook profile
     */
    public function edit()
    {
        $user = Auth::user();

        if (!$user) {
            abort(403, 'Unauthorized');
        }

        // Get or create a profile for the logged-in student
         $profile = StudentYearbook::firstOrCreate(
            [
                'student_id' => $user->student_id,
                'campus_id'  => $user->campus_id,
                'tenant_id'  => $user->tenant_id,
            ],
            [
                'student_id' => $user->student_id,
                'campus_id'  => $user->campus_id,
                'tenant_id'  => $user->tenant_id,
            ]
        );

        return view('student.my-profile.index', compact('profile'));
    }

    /**
     * Update the yearbook profile
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $data = $request->only([
            'motto',
            'ojt_experience',
            'memorable_experience',
            'career_goal',
            'favorite_quote',
            'facebook',
            'linkedin'
        ]);

        // Convert dynamic fields to JSON arrays, remove empty entries
        $data['awards'] = array_filter($request->input('awards', []));
        $data['hobbies'] = array_filter($request->input('hobbies', []));
        $data['organizations'] = array_filter($request->input('organizations', []));
        $data['trainings'] = array_filter($request->input('trainings', []));

        // Always enforce tenant & campus ownership
        $data['campus_id'] = $user->campus_id;
        $data['tenant_id'] = $user->tenant_id;

        // Update or create profile
        StudentYearbook::updateOrCreate(
            [
                'student_id' => $user->student_id,
                'campus_id'  => $user->campus_id,
                'tenant_id'  => $user->tenant_id,
            ],
            $data
        );

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}
