<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\StudentYearbook;
use Auth;
use Illuminate\Http\Request;

class MyProfileController extends Controller
{
    /**
     * Display the student's profile.
     */
    public function index()
    {
        $user = Auth::user();
        $profile = StudentYearbook::where('student_id', $user->student_id)->first();

        return view('student.my-profile.index', compact('profile'));
    }

    /**
     * Show the form for editing the profile.
     */
    public function edit()
    {
        $user = Auth::user();

        $profile = StudentYearbook::firstOrCreate(
            ['portal_user_id' => $user->student_id],
            ['student_id' => $user->student_id]
        );

        return view('student.my-profile.edit', compact('profile'));
    }

    /**
     * Update the student's profile.
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
            'linkedin',
        ]);

        // Convert dynamic fields to JSON arrays
        $data['awards'] = $request->input('awards', []);
        $data['hobbies'] = $request->input('hobbies', []);
        $data['organizations'] = $request->input('organizations', []);
        $data['trainings'] = $request->input('trainings', []);

        // Ensure foreign key is included
        $data['portal_user_id'] = $user->student_id;
        $data['student_id'] = $user->student_id;

        StudentYearbook::updateOrCreate(
            ['portal_user_id' => $user->student_id],
            $data
        );

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}
