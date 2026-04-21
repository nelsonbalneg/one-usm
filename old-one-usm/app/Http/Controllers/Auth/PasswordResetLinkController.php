<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rules\Password as PasswordRule;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status == Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withInput($request->only('email'))
                ->withErrors(['email' => __($status)]);
    }

    public function resetPassword(Request $request)
    {
         // Validate that the Turnstile response is present
         $request->validate([
            'cf-turnstile-response' => 'required',
        ], [
            'cf-turnstile-response.required' => 'Turnstile verification is required.',
        ]);

        // Retrieve the Turnstile response from the request
        $turnstileResponse = $request->input('cf-turnstile-response');
        // $secretKey = env('TURNSTILE_SECRET_KEY'); // Your Turnstile secret key
        $secretKey = config('services.turnstile.secret');

        // Send the Turnstile response for verification
        $verifyResponse = Http::asForm()
            ->timeout(seconds: 60) // Set timeout to 20 seconds
            ->post("https://challenges.cloudflare.com/turnstile/v0/siteverify", [
                'secret' => $secretKey,
                'response' => $turnstileResponse,
                'remoteip' => $request->ip(),
            ]);

        $result = $verifyResponse->json();
        // Log::info('Turnstile secret key used', ['key' => env('TURNSTILE_SECRET_KEY')]);

        // Log the Turnstile response for debugging
        Log::info('Turnstile response from Cloudflare', (array) $result);

        // Check if Turnstile verification was successful
        if (!$result['success']) {
            return redirect()->back()->withErrors(['turnstile' => 'Turnstile verification failed. Please try again.']);
        }
        // Step 1: Validate the inputs
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
            'phone' => ['required', 'digits:4'],
            'new_password' => ['required', 'confirmed', 'min:8'],
        ], [
            'new_password.min' => 'The password must be at least 8 characters.',
            'email.exists' => 'The email does not exist in our records.',
        ]);

        // Step 2: Find the user by email
        $user = User::where('email', $request->email)->first();

        // Step 3: Extract the last 4 digits of the stored phone number
        $storedLastFour = substr(preg_replace('/[^0-9]/', '', $user->phone), -4);

        // Step 4: Check if the last 4 digits match
        if ($storedLastFour !== $request->phone) {
            return redirect()->route('student.forgot-password')
                ->withErrors(['phone' => 'The phone number does not match our records.'])
                ->withInput();
        }

        // Step 5: Update the user's password
        $user->password = Hash::make($request->new_password);
        $user->save();

        // Step 6: Redirect with success message
        return redirect()->route('student.forgot-password')->with('status', 'Password reset successful. You can now log in.');
    }


    public function forgotPassword()
    {
        return view('student.profile.forgot-password');
    }
}
