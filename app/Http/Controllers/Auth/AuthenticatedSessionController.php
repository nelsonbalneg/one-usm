<?php

namespace App\Http\Controllers\Auth;

use Illuminate\View\View;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Auth\LoginRequest;


class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        // $siteSetting = SiteSetting::first();
        // $endofregistration = $siteSetting ? $siteSetting->endregistration : null;

        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
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

        // Proceed with the usual login logic
        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            $role = $request->user()->role;

            // Redirect based on user role
            return match ($role) {
                'student' => redirect()->route('student.dashboard'),
                'admin' => redirect()->route('admin.dashboard'),
                'aro' => redirect()->route('aro.dashboard'),
                'osa' => redirect()->route('osa.dashboard'),
                'parent' => redirect()->route('parent.dashboard'),
                default => redirect()->route('dashboard.default'),
            };
        }

        // If login fails, redirect back with an error message
        return redirect()->back()->withErrors(['email' => 'Login failed. Please check your credentials.']);
    }


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
