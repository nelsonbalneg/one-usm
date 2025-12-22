<?php

namespace App\Http\Controllers\Utdc;

use App\Models\User;
use Illuminate\Http\Request;
use App\Trait\ImageUploadTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UTDCProfileController extends Controller
{
    use ImageUploadTrait;
    public function userProfileIndex()
    {
        $user = User::findOrFail(Auth::user()->id);
        return view('utdc.profile.user-profile', compact('user'));
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
