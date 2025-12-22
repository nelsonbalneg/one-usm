<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use App\Trait\ImageUploadTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class SiteSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     use ImageUploadTrait;
    public function index()
    {
        $sitesetting = SiteSetting::first();
        return view('admin.site-settings.index', compact('sitesetting'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'utdc_head' => ['required', 'max:50'],
            'aro_head' => ['required', 'max:50'],
            'di_head' => ['required', 'max:50'],
            'vpaa' => ['required', 'max:50'],
            'footer_one' => ['required', 'max:50'],
            'footer_two' => ['required', 'max:50'],
            'endreservation' => ['required'],
            'status' => ['required'],
        ]);

        $data = [
            'utdc_head' => $request->utdc_head,
            'aro_head' => $request->aro_head,
            'di_head' => $request->di_head,
            'vpaa' => $request->vpaa,
            'footer_one' => $request->footer_one,
            'footer_two' => $request->footer_two,
            'endreservation' => $request->endreservation,
            'openreservation' => $request->openreservation,
            'status' => $request->status,
            'is_maintenance' => $request->is_maintenance,
            'site_name' => $request->site_name,
            'endregistration' => $request->endregistration,
            'start_prereg_second_batch' => $request->start_prereg_second_batch,
            'end_prereg_second_batch' => $request->end_prereg_second_batch,
            'start_enrollment' => $request->start_enrollment,
            'end_enrollment' => $request->end_enrollment,
            'enrollment_announcement' => $request->enrollment_announcement,
            'enrollment_hy_reg_status' => $request->enrollment_hy_reg_status,
            'enrollment_hy_ireg_status' => $request->enrollment_hy_ireg_status
        ];


        SiteSetting::updateOrCreate(
            ['id' => 1],
            $data
        );

        return response()->json(['status' => 'success', 'message' => 'Site settings updated successfully!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function userProfileIndex()
    {
        $user = User::findOrFail(Auth::user()->id);
        return view('admin.site-settings.user-profile', compact('user'));
    }

    public function updateProfile(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'lastname' => 'required|string|max:255',
            'firstname' => 'required|string|max:255',
            'middlename' => 'nullable|string|max:255',
            'suffix' => 'nullable|string|max:10',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // Update user details
        $user->lastname = $request->lastname;
        $user->firstname = $request->firstname;
        $user->middlename = $request->middlename;
        $user->suffix = $request->suffix;
        $user->email = $request->email;

         // Handle photo upload
         $imagePath = $this->updateImage($request, 'photo', 'uploads', $user->photo);
         $user->photo = empty(!$imagePath) ? $imagePath : $user->photo;

        $user->save();

        return redirect()->back()->with('success', 'User updated successfully!');
    }


    //updatePassword
    public function updatePassword(Request $request, User $user)
    {
        // Validate input fields
        $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()->symbols()],
        ]);

        // Check if the current password matches
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        // Update password
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Password updated successfully.');
    }


}
