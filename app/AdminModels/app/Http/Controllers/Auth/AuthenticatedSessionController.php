<?php

namespace App\Http\Controllers\Auth;

use Illuminate\View\View;
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
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {

        // Proceed with the usual login logic
        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            $role = $request->user()->role;

            // Redirect based on user role
            return match ($role) {
                'admin' => redirect()->intended('admin/dashboard'),
                'utdc' => redirect()->intended('utdc/dashboard'),
                'pao' => redirect()->intended('pao/dashboard'),
                'aro' => redirect()->intended('aro/dashboard'),
                'dean' => redirect()->intended('dean/dashboard'),
                'osa' => redirect()->intended('osa/dashboard'),
                default => redirect()->intended(default: route('student/dashboard', absolute: false)),
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
