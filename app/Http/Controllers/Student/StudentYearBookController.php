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

        // Get or create a profile
        $profile = StudentYearbook::firstOrCreate(
            ['student_id' => $user->student_id],
            ['student_id' => $user->student_id]
        );

        return view('student.profile.edit', compact('profile'));
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

        // Convert dynamic fields to JSON arrays
        $data['awards'] = $request->input('awards', []);
        $data['hobbies'] = $request->input('hobbies', []);
        $data['organizations'] = $request->input('organizations', []);
        $data['trainings'] = $request->input('trainings', []);

        // Update or create profile
        StudentYearbook::updateOrCreate(
            ['student_id' => $user->student_id],
            $data
        );

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}
