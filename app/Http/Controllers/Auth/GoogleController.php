<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Services\SarService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class GoogleController extends Controller
{
    /**
     * STEP 1: Validate Turnstile + Campus
     * STEP 2: Redirect to Google
     */

    protected SarService $sarService;

    public function __construct(SarService $sarService)
    {
        $this->sarService = $sarService;
    }

    public function redirect(Request $request)
    {
        // ✅ Validate required fields
        $request->validate([
            'campus' => 'required',
            'cf-turnstile-response' => 'required',
        ]);

        // ✅ Verify Turnstile with Cloudflare
        $turnstile = Http::asForm()->post(
            'https://challenges.cloudflare.com/turnstile/v0/siteverify',
            [
                'secret'   => config('services.turnstile.secret_key'),
                'response' => $request->input('cf-turnstile-response'),
                'remoteip' => $request->ip(),
            ]
        );

        if (!($turnstile->json('success') === true)) {
            return redirect()->route('login')
                ->withErrors(['cf-turnstile-response' => 'Turnstile verification failed. Please try again.']);
        }

        // ✅ Store campus in session
        session(['campus' => $request->campus]);

        // ✅ Redirect to Google OAuth
        return Socialite::driver('google')->redirect();
    }

    /**
     * Google OAuth callback
     */
    public function callback()
    {
        $campus = session('campus');

        if (!$campus) {
            return redirect()->route('login')
                ->withErrors(['google' => 'Campus selection is missing. Please try again.']);
        }

        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
        } catch (\Exception $e) {
            return redirect()->route('login')
                ->withErrors(['google' => 'Google login failed.']);
        }

        $email = $googleUser->getEmail();

        // Map tenant ID
        $tenantId = match ($campus) {
            1 => 1,
            3 => 3,
            default => $campus,
        };

        // Verify student via API
        $apiUrl = "http://172.16.0.60/academic/api/v2/Students/campus/{$campus}/getbyemail/"
            . urlencode($email) . "?tenantId={$tenantId}";
        


        $response = Http::get($apiUrl);

        if ($response->status() === 404 || str_contains($response->body(), 'Student not Found')) {
            return redirect()->route('login')
                ->withErrors(['google' => 'You are not allowed to log in for this campus.']);
        }

        if ($response->failed()) {
            return redirect()->route('login')
                ->withErrors(['google' => 'Failed to verify student data from API.']);
        }

        $apiData = $response->json();

        // Create or update user
        $user = User::firstOrCreate(
            ['email' => $email],
            [
                'student_id'        => $apiData['studentNo'] ?? null,
                'birthdate'         => isset($apiData['dateOfBirth'])
                                        ? date('Y-m-d', strtotime($apiData['dateOfBirth']))
                                        : null,
                'firstname'         => $apiData['firstName'] ?? $googleUser->getName(),
                'middlename'        => $apiData['middlename'] ?? '',
                'lastname'          => $apiData['lastName'] ?? '',
                'gender'            => $apiData['gender'] ?? '',
                'password'          => Hash::make(Str::random(32)),
                'role'              => 'student',
                'status'            => 'active',
                'isemailverified'   => true,
                'email_verified_at' => now(),
                'tenant_id'         => $tenantId,
                'campus_id'         => $apiData['campusId'] ?? $campus,
            ]
        );

        Auth::login($user, true);

        return match ($user->role) {
            'student' => redirect()->route('student.dashboard'),
            'admin'   => redirect()->route('admin.dashboard'),
            'aro'     => redirect()->route('aro.dashboard'),
            default   => redirect()->route('dashboard.default'),
        };
    }
}
