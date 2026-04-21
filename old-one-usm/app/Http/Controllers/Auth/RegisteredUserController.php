<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\SarService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RegisteredUserController extends Controller
{
    protected SarService $sarService;

    public function __construct(SarService $sarService)
    {
        $this->sarService = $sarService;
    }
    /**
     * Display registration page.
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle registration request.
     */
    public function store(Request $request)
    {
        // 1. Validate form inputs
        $request->validate([
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'regex:/^[A-Za-z0-9._%+-]+@(usm\.edu\.ph|mail\.usm\.edu\.ph)$/i',
                'unique:portal_users,email'
            ],
            'password' => [
                'required',
                'confirmed',
                Password::min(11)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
            ],
            'campus_id' => ['required', 'integer'],
            'cf-turnstile-response' => ['required'], // ensure Turnstile token exists
        ], [
            'email.regex' => 'Only USM institutional email addresses are allowed (example: yourname@usm.edu.ph).',
            'email.unique' => 'This email is already registered.',
            'password.required' => 'Password is required.',
            'password.confirmed' => 'Password confirmation does not match.',
            'password.min' => 'Password must be at least 11 characters long.',
            'password.letters' => 'Password must contain at least one letter.',
            'password.mixedCase' => 'Password must include both uppercase and lowercase letters.',
            'password.numbers' => 'Password must contain at least one number.',
            'password.symbols' => 'Password must include at least one special character (symbol).',
            'cf-turnstile-response.required' => 'Turnstile verification failed. Please try again.',
        ]);

        // 2. Turnstile verification
        $turnstileResponse = $request->input('cf-turnstile-response');
        $secretKey = config('services.turnstile.secret');

        try {
            $verifyResponse = Http::asForm()
                ->timeout(10)
                ->post("https://challenges.cloudflare.com/turnstile/v0/siteverify", [
                    'secret' => $secretKey,
                    'response' => $turnstileResponse,
                    'remoteip' => $request->ip(),
                ]);

            $verifyJson = $verifyResponse->json();

            if (empty($verifyJson['success']) || $verifyJson['success'] !== true) {
                return back()->withInput()->withErrors([
                    'cf-turnstile-response' => 'Turnstile verification failed. Please try again.',
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Turnstile verification failed: ' . $e->getMessage());
            return back()->withInput()->withErrors([
                'cf-turnstile-response' => 'Turnstile verification failed. Please try again.',
            ]);
        }

        // 3. Normalize inputs
        $email = strtolower($request->input('email'));
        $campusIdSelected = (int)$request->input('campus_id');
        $tenantId = match ($campusIdSelected) {
            1 => 1,
            3 => 3,
            4 => 4,
            default => 1,
        };

        $encodedEmail = urlencode($email);
        $apiUrl = $this->sarService->getStudentDetails($encodedEmail, $campusIdSelected, $tenantId);

        // 4. Call Academic API
        try {
            $apiResponse = Http::timeout(10)->get($apiUrl);

            if ($apiResponse->status() === 404) {
                return back()->withInput()->withErrors([
                    'email' => 'Student record not found in the system.'
                ]);
            }

            if (!$apiResponse->successful()) {
                return back()->withInput()->withErrors([
                    'email' => 'Unable to verify email with the Academic system. Please try again later.'
                ]);
            }

            $student = $apiResponse->json();

        } catch (\Exception $e) {
            Log::error('Student API request failed: ' . $e->getMessage());
            return back()->withInput()->withErrors([
                'email' => 'Unable to verify email with the Academic system. Please try again later.'
            ]);
        }

        // 5. Validate student data from API
        if (empty($student) || (empty($student['studentNo']) && empty($student['firstName']))) {
            return back()->withInput()->withErrors([
                'email' => 'Student record not found in the system.'
            ]);
        }

        if (isset($student['campusId']) && (int)$student['campusId'] !== $campusIdSelected) {
            return back()->withInput()->withErrors([
                'campus_id' => 'The selected campus does not match the campus on file for this student email.'
            ]);
        }

        $studentNo = $student['studentNo'] ?? null;

        if ($studentNo && User::where('student_id', $studentNo)->exists()) {
            return back()->withInput()->withErrors([
                'student_id' => 'A portal account for this student number already exists.'
            ]);
        }

        if (User::where('email', $email)->exists()) {
            return back()->withInput()->withErrors([
                'email' => 'This email is already registered.'
            ]);
        }

        // 6. Map API fields
        $firstName = $student['firstName'] ?? $student['first_name'] ?? null;
        $lastName = $student['lastName'] ?? $student['last_name'] ?? null;
        $middleName = $student['middlename'] ?? $student['middleName'] ?? null;
        $extName = $student['extName'] ?? $student['extname'] ?? null;

        $genderRaw = isset($student['gender']) ? trim($student['gender']) : null;
        $gender = null;
        if ($genderRaw !== null) {
            $g = strtoupper(substr($genderRaw, 0, 1));
            $gender = match($g) {
                'M' => 'M',
                'F' => 'F',
                default => $genderRaw,
            };
        }

        $dob = $student['dateOfBirth'] ?? null;
        $dob = $dob ? substr($dob, 0, 10) : null;

        // 7. Create portal user
        $user = User::create([
            'student_id' => $studentNo,
            'firstname' => $firstName,
            'middlename' => $middleName,
            'lastname' => $lastName,
            'suffix' => $extName,
            'gender' => $gender,
            'campus_id' => $student['campusId'] ?? $campusIdSelected,
            'tenant_id' => $student['campusId'] ?? $tenantId,
            'birthdate' => $dob,
            'email' => $email,
            'isemailverified' => true,
            'email_verified_at' => now(),
            'role' => 'student',
            'status' => 'active',
            'password' => Hash::make($request->input('password')),
        ]);

        $user->sendEmailVerificationNotification();
        Auth::login($user);

        return redirect()->route('student.dashboard')->with('success', 'Registration successful!');
    }
}
