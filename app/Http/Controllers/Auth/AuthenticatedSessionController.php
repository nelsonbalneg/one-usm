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
        // 1. Validate email format first
        $request->validate([
            'email' => 'required|email',  // <--- email format validation
            'password' => 'required',
            'cf-turnstile-response' => 'required',
        ], [
            'email.email' => 'Please enter a valid email address.',
            'cf-turnstile-response.required' => 'Turnstile verification is required.',
        ]);

        // 2. Turnstile verification
        $turnstileResponse = $request->input('cf-turnstile-response');
        $secretKey = config('services.turnstile.secret');

        $verifyResponse = Http::asForm()
            ->timeout(60)
            ->post("https://challenges.cloudflare.com/turnstile/v0/siteverify", [
                'secret' => $secretKey,
                'response' => $turnstileResponse,
                'remoteip' => $request->ip(),
            ]);

        $result = $verifyResponse->json();
        Log::info('Turnstile response', (array) $result);

        if (!$result['success']) {
            return back()->withErrors([
                'turnstile' => 'Turnstile verification failed. Please try again.',
            ]);
        }

        // 3. Check if email exists in database
        if (!\App\Models\User::where('email', $request->email)->exists()) {
            return back()->withErrors([
                'email' => 'Invalid login credentials.',
            ])->withInput();
        }

        // 4. Attempt login
        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            $role = $request->user()->role;

            return match ($role) {
                'student' => redirect()->route('student.dashboard'),
                'admin' => redirect()->route('admin.dashboard'),
                'aro' => redirect()->route('aro.dashboard'),
                'osa' => redirect()->route('osa.dashboard'),
                'parent' => redirect()->route('parent.dashboard'),
                default => redirect()->route('dashboard.default'),
            };
        }

        // 5. Email exists but password is incorrect
        return back()->withErrors([
            'password' => 'Incorrect password. Please try again.',
        ])->withInput();
    }



    /**
     * Destroy an authenticated session.
     */
public function destroy(Request $request)
{
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('login'); // go to login page after logout
}

}
