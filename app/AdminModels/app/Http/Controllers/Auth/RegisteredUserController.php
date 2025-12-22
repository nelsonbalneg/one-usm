<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate reCAPTCHA response with a custom error message
        $request->validate([
            'g-recaptcha-response' => 'required',
        ], [
            'g-recaptcha-response.required' => '* reCAPTCHA field is required.',
        ]);

        // Retrieve the reCAPTCHA token from the request
        $recaptchaResponse = $request->input('g-recaptcha-response');
        $secretKey = env('RECAPTCHA_SECRET_KEY'); // Your reCAPTCHA secret key

        // Use file_get_contents to verify the reCAPTCHA response
        $data = [
            'secret' => $secretKey,
            'response' => $recaptchaResponse,
            'remoteip' => $request->ip(),
        ];

        $options = [
            'http' => [
                'method' => 'POST',
                'header' => 'Content-type: application/x-www-form-urlencoded',
                'content' => http_build_query($data),
            ],
        ];
        $context = stream_context_create($options);
        $response = file_get_contents('https://www.google.com/recaptcha/api/siteverify', false, $context);
        $responseBody = json_decode($response);

        // Log the reCAPTCHA response for debugging
        //Log::info('reCAPTCHA response from Google', (array) $responseBody);

        // Check if reCAPTCHA verification was successful
        if (!$responseBody->success) {
            return redirect()->back()->withErrors(['recaptcha' => '* reCAPTCHA verification failed. Please try again.']);
        }

        // Validate user inputs
        $request->validate(
            [
                'firstname' => ['required', 'string', 'max:255'],
                'lastname' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
                'phone' => ['required', 'string', 'unique:' . User::class, 'regex:/^09\d{2}-\d{3}-\d{4}$/'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ],
            [
                'phone.unique' => 'The phone number is already in use. Please use a different number.',
                'email.unique' => 'The email address is already taken. Please use a different email.',
                'phone.regex' => 'The phone number contain exactly 11 digits.',
            ]
        );

        // Create the user
        $user = User::create([
            'firstname' => $request->firstname,
            'middlename' => $request->middlename,
            'lastname' => $request->lastname,
            'suffix' => $request->suffix,
            'sex' => $request->sex,
            'phone' => $request->phone,
            'email' => $request->email,
            'birthdate' => $request->birthdate,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        // Auth::login($user); // Uncomment if you want to log in the user automatically after registration

        return redirect(route('register'))->with('success', 'Registration successful! Please log in.');
    }
}
