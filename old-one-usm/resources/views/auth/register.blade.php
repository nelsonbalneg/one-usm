<!DOCTYPE html>
<html lang="en" class="light scroll-smooth group" data-layout="vertical" data-sidebar="light" data-sidebar-size="lg"
    data-mode="light" data-topbar="light" data-skin="default" data-navbar="sticky" data-content="fluid" dir="ltr">

<head>

    <meta charset="utf-8">
    <title>One USM | Register </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta content="Minimal Admin & Dashboard Template" name="description">
    <meta content="Themesdesign" name="author">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('backend/assets/images/logo/hiraya.png') }}">
    <!-- Layout config Js -->
    <script src="{{ asset('backend/assets/js/layout.js') }}"></script>
    <!-- Icons CSS -->

    <!-- Tailwind CSS -->


    <link rel="stylesheet" href="{{ asset('backend/assets/css/tailwind2.css') }}">
</head>

<body
    class="flex items-center justify-center min-h-screen py-16 lg:py-10 bg-slate-50 dark:bg-zink-800 dark:text-zink-100 font-public">

    <div class="relative">
        <div class="absolute hidden opacity-50 ltr:-left-16 rtl:-right-16 -top-10 md:block">
            <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 125 316" width="125" height="316">
                <title>&lt;Group&gt;</title>
                <g id="&lt;Group&gt;">
                    <path id="&lt;Path&gt;" class="fill-custom-100/50 dark:fill-custom-950/50"
                        d="m23.4 221.8l-1.3-3.1v-315.3l1.3 3.1z" />
                    <path id="&lt;Path&gt;" class="fill-custom-100 dark:fill-custom-950"
                        d="m31.2 229.6l-1.3-3.1v-315.3l1.3 3.1z" />
                    <path id="&lt;Path&gt;" class="fill-custom-200/50 dark:fill-custom-900/50"
                        d="m39 237.4l-1.3-3.1v-315.3l1.3 3.1z" />
                    <path id="&lt;Path&gt;" class="fill-custom-200/75 dark:fill-custom-900/75"
                        d="m46.8 245.2l-1.3-3.1v-315.3l1.3 3.1z" />
                    <path id="&lt;Path&gt;" class="fill-custom-200 dark:fill-custom-900"
                        d="m54.6 253.1l-1.3-3.1v-315.4l1.3 3.1z" />
                    <path id="&lt;Path&gt;" class="fill-custom-300/50 dark:fill-custom-800/50"
                        d="m62.4 260.9l-1.2-3.1v-315.4l1.2 3.1z" />
                    <path id="&lt;Path&gt;" class="fill-custom-300/75 dark:fill-custom-800/75"
                        d="m70.3 268.7l-1.3-3.1v-315.4l1.3 3.1z" />
                    <path id="&lt;Path&gt;" class="fill-custom-300 dark:fill-custom-800"
                        d="m78.1 276.5l-1.3-3.1v-315.3l1.3 3.1z" />
                    <path id="&lt;Path&gt;" class="fill-custom-400/50 dark:fill-custom-700/50"
                        d="m85.9 284.3l-1.3-3.1v-315.3l1.3 3.1z" />
                    <path id="&lt;Path&gt;" class="fill-custom-400/75 dark:fill-custom-700/75"
                        d="m93.7 292.1l-1.3-3.1v-315.3l1.3 3.1z" />
                    <path id="&lt;Path&gt;" class="fill-custom-400 dark:fill-custom-700"
                        d="m101.5 299.9l-1.3-3.1v-315.3l1.3 3.1z" />
                    <path id="&lt;Path&gt;" class="fill-custom-500/50 dark:fill-custom-600/50"
                        d="m109.3 307.8l-1.3-3.1v-315.4l1.3 3.1z" />
                </g>
            </svg>
        </div>

        <div class="absolute hidden -rotate-180 opacity-50 ltr:-right-16 rtl:-left-16 -bottom-10 md:block">
            <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 125 316" width="125" height="316">
                <title>&lt;Group&gt;</title>
                <g id="&lt;Group&gt;">
                    <path id="&lt;Path&gt;" class="fill-custom-100/50 dark:fill-custom-950/50"
                        d="m23.4 221.8l-1.3-3.1v-315.3l1.3 3.1z" />
                    <path id="&lt;Path&gt;" class="fill-custom-100 dark:fill-custom-950"
                        d="m31.2 229.6l-1.3-3.1v-315.3l1.3 3.1z" />
                    <path id="&lt;Path&gt;" class="fill-custom-200/50 dark:fill-custom-900/50"
                        d="m39 237.4l-1.3-3.1v-315.3l1.3 3.1z" />
                    <path id="&lt;Path&gt;" class="fill-custom-200/75 dark:fill-custom-900/75"
                        d="m46.8 245.2l-1.3-3.1v-315.3l1.3 3.1z" />
                    <path id="&lt;Path&gt;" class="fill-custom-200 dark:fill-custom-900"
                        d="m54.6 253.1l-1.3-3.1v-315.4l1.3 3.1z" />
                    <path id="&lt;Path&gt;" class="fill-custom-300/50 dark:fill-custom-800/50"
                        d="m62.4 260.9l-1.2-3.1v-315.4l1.2 3.1z" />
                    <path id="&lt;Path&gt;" class="fill-custom-300/75 dark:fill-custom-800/75"
                        d="m70.3 268.7l-1.3-3.1v-315.4l1.3 3.1z" />
                    <path id="&lt;Path&gt;" class="fill-custom-300 dark:fill-custom-800"
                        d="m78.1 276.5l-1.3-3.1v-315.3l1.3 3.1z" />
                    <path id="&lt;Path&gt;" class="fill-custom-400/50 dark:fill-custom-700/50"
                        d="m85.9 284.3l-1.3-3.1v-315.3l1.3 3.1z" />
                    <path id="&lt;Path&gt;" class="fill-custom-400/75 dark:fill-custom-700/75"
                        d="m93.7 292.1l-1.3-3.1v-315.3l1.3 3.1z" />
                    <path id="&lt;Path&gt;" class="fill-custom-400 dark:fill-custom-700"
                        d="m101.5 299.9l-1.3-3.1v-315.3l1.3 3.1z" />
                    <path id="&lt;Path&gt;" class="fill-custom-500/50 dark:fill-custom-600/50"
                        d="m109.3 307.8l-1.3-3.1v-315.4l1.3 3.1z" />
                </g>
            </svg>
        </div>

        <div class="mb-0 w-screen lg:mx-auto lg:w-[500px] card shadow-lg border-none shadow-slate-100 relative">
            <div class="!px-10 !py-12 card-body">
                <a href="#!">
                    <img src="{{ asset('backend/assets/images/logo/hiraya.png') }}" alt=""
                        class="hidden h-6 mx-auto dark:block">
                    <img src="{{ asset('backend/assets/images/logo/hiraya.png') }}" alt=""
                        class="block mx-auto h-15 dark:hidden">
                </a>

                <div class="mt-8 text-center">
                    <h4 class="mb-1 text-info-500 dark:text-green-500">Create your account</h4>
                </div>
                {{-- Email errors --}}
                @if ($errors->has('email'))
                    <ul class="text-red-500 text-sm mt-1 list-disc list-inside">
                        @foreach ($errors->get('email') as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                {{-- Password errors --}}
                @if ($errors->has('password'))
                    <ul class="text-red-500 text-sm mt-1 list-disc list-inside">
                        @foreach ($errors->get('password') as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="inline-block mb-2 text-base font-medium">Email <sup
                                class="text-red-500">*</sup></label>
                        <input type="email" name="email" id="email" required
                            class="form-input border-slate-200 focus:outline-none focus:border-custom-500"
                            placeholder="Enter email" value="{{ old('email') }}">
                    </div>

                    <div class="flex gap-4 mb-3 flex-col-2 md:flex-row">
                        <span class="text-base font-small text-sky-600"> <strong>Only USM institutional email addresses
                                are allowed.</strong><br>
                            * Personal or non-USM email accounts are not permitted for creating a student portal
                            account.<br>
                            * This ensures secure access to password resets and official university
                            communications.</span>
                    </div>

                    <!-- Password Field -->
                    <div class="mb-3">
                        <label for="password" class="inline-block mb-2 text-base font-medium">
                            Password <sup class="text-red-500">*</sup>
                        </label>
                        <input type="password" name="password" id="password" required
                            class="form-input border-slate-200 focus:outline-none focus:border-custom-500"
                            placeholder="Enter password">

                    </div>

                    <!-- Confirm Password Field -->
                    <div class="mb-3">
                        <label for="password_confirmation" class="inline-block mb-2 text-base font-medium">
                            Confirm Password <sup class="text-red-500">*</sup>
                        </label>
                        <input type="password" name="password_confirmation" id="password_confirmation" required
                            class="form-input border-slate-200 focus:outline-none focus:border-custom-500"
                            placeholder="Confirm password">
                    </div>




                    <div class="mb-3">
                        <label for="campus_id" class="inline-block mb-2 text-base font-medium">Campus <sup
                                class="text-red-500">*</sup></label>
                        <select name="campus_id" id="campus_id" required
                            class="form-input border-slate-200 focus:outline-none focus:border-custom-500">
                            <option value="">-Select Campus-</option>
                            <option value="1">Main Campus - Undegraduate</option>
                            <option value="4">Main Campus - Graduate School</option>
                            <option value="4">Main Campus - Medicine</option>
                            <option value="3">KCC Campus</option>
                        </select>
                    </div>

                     <div class="mt-5 cf-turnstile" data-sitekey="{{ config('services.turnstile.sitekey') }}"></div>

                    <div class="mt-5 text-center">
                        <button type="submit" class="w-full bg-green-500 text-white py-2 rounded">
                            Create Account
                        </button>
                    </div>
                </form>


                <div class="mt-8 text-center">
                    <p class="mb-0 text-slate-500 dark:text-zink-200">Already have an account ? <a
                            href="{{ route('login') }}"
                            class="font-semibold underline transition-all duration-150 ease-linear text-slate-500 dark:text-zink-200 hover:text-custom-500 dark:hover:text-custom-500">Login</a>
                    </p>
                </div>


                <div id="drawerterms" drawer-end
                    class="fixed inset-y-0 flex flex-col w-full transition-transform duration-300 ease-in-out transform bg-white shadow ltr:right-0 rtl:left-0 md:w-80 z-drawer show dark:bg-zink-600">
                    <div
                        class="flex items-center justify-between p-4 border-b card-body border-slate-200 dark:border-zink-500">
                        <h6 class="text-15">Terms & Conditions</h6>
                        <button data-drawer-close="drawerterms"><i data-lucide="x"
                                class="transition-all duration-200 ease-linear size-4 text-slate-500 hover:text-slate-700 dark:text-zink-200 dark:hover:text-zink-50"></i></button>
                    </div>
                    <div class="h-full p-2 overflow-y-auto">
                        <div class="card-body">
                            <p class='text-justify'>
                                Welcome to the University of Southern Mindanao (USM) College Entrance Examination
                                Registration Website. By accessing and using this website, you agree to comply with and
                                be bound by these Terms and Conditions, which govern your use of this application. If
                                you do not agree, please refrain from using this site.
                            </p>
                            <br>
                            <div
                                class="flex gap-1 px-3 py-3 mb-5 text-sm border border-yellow-200 rounded-md md:items-center text-black-500 bg-yellow-50 dark:bg-yellow-400/20 dark:border-yellow-500/50">
                                <h6 class="mb-1 font-bold">Eligibility and Accurate Information</h6>
                            </div>

                            <ul class="px-3 space-y-3 text-justify list-disc list-inside rounded-md">
                                <li>Only eligible applicants, specifically senior high school students, may use this
                                    website to register for the USM College Entrance Examination.
                                </li>
                                <li>All information provided must be complete, accurate, and truthful. By submitting
                                    your application, you confirm that you meet the eligibility requirements.</li>
                                <li>Providing false information or misrepresenting your qualifications may lead to
                                    disqualification from the application process and will be handled in accordance with
                                    Republic Act No. 10175 (Cybercrime Prevention Act of 2012) and Article 172
                                    (Falsification by Private Individual) and Article 315 (Swindling/Estafa) of the
                                    Revised Penal Code of the Philippines.</li>

                            </ul>
                            <div
                                class="flex gap-1 px-3 py-3 mt-5 mb-5 text-sm border border-yellow-200 rounded-md md:items-center text-black-500 bg-yellow-50 dark:bg-yellow-400/20 dark:border-yellow-500/50">
                                <h6 class="mb-1 font-bold">Data Privacy and Confidentiality
                                </h6>
                            </div>

                            <ul class="px-3 space-y-3 text-justify list-disc list-inside rounded-md">
                                <li>Your information will be used solely for processing your application, in compliance
                                    with the Data Privacy Act of 2012 (Republic Act No. 10173). USM is committed to
                                    handling your data according to principles of transparency, legitimate purpose, and
                                    proportionality.

                                </li>
                                <li>By using this site, you consent to the collection, use, and processing of your
                                    personal information as per USM’s Privacy Policy and in line with the Data Privacy
                                    Act. We will use your data only as necessary to process your application and for
                                    communications relevant to the entrance examination.
                                </li>
                                <li>USM will take appropriate measures to protect your data from unauthorized access.
                                    However, it is your responsibility to maintain the confidentiality of your login
                                    credentials and promptly report any suspected unauthorized use of your account.
                                </li>

                            </ul>

                            <div
                                class="flex gap-1 px-3 py-3 mt-5 mb-5 text-sm border border-yellow-200 rounded-md md:items-center text-black-500 bg-yellow-50 dark:bg-yellow-400/20 dark:border-yellow-500/50">
                                <h6 class="mb-1 font-bold">Prohibition Against Fraud and Misrepresentation
                                </h6>
                            </div>

                            <ul class="px-3 space-y-3 text-justify list-disc list-inside rounded-md">
                                <li>Any form of fraud or misrepresentation, including the submission of falsified
                                    documents or impersonation, is strictly prohibited. Violations may result in
                                    penalties under Article 172 (Falsification by Private Individuals) and Article 315
                                    (Swindling/Estafa) of the Revised Penal Code.
                                </li>
                                <li>USM reserves the right to take disciplinary and legal actions for fraudulent
                                    applications, including but not limited to the denial of admission, cancellation of
                                    registration, and potential prosecution under applicable Philippine laws.
                                </li>
                            </ul>
                            <div
                                class="flex gap-1 px-3 py-3 mt-5 mb-5 text-sm border border-yellow-200 rounded-md md:items-center text-black-500 bg-yellow-50 dark:bg-yellow-400/20 dark:border-yellow-500/50">
                                <h6 class="mb-1 font-bold">Use of the Web Application
                                </h6>
                            </div>

                            <ul class="px-3 space-y-3 text-justify list-disc list-inside rounded-md">
                                <li>This application is intended exclusively for entrance examination applications.
                                    Unauthorized uses, including disruptive or damaging activities, may constitute
                                    violations of Republic Act No. 8792 (Electronic Commerce Act of 2000) and Republic
                                    Act No. 10175 (Cybercrime Prevention Act of 2012).
                                </li>
                                <li>Actions that interfere with, disable, or cause harm to the application may lead to
                                    suspension of your access and possible legal action as permitted under relevant
                                    Philippine laws.
                                </li>
                            </ul>

                            <div
                                class="flex gap-1 px-3 py-3 mt-5 mb-5 text-sm border border-yellow-200 rounded-md md:items-center text-black-500 bg-yellow-50 dark:bg-yellow-400/20 dark:border-yellow-500/50">
                                <h6 class="mb-1 font-bold">Acceptance and Changes to Terms
                                </h6>
                            </div>

                            <ul class="px-3 space-y-3 text-justify list-disc list-inside rounded-md">
                                <li>By submitting your application, you acknowledge that you have read, understood, and
                                    agree to these Terms and Conditions.
                                </li>
                                <li>Modifications: USM reserves the right to modify these Terms and Conditions as
                                    necessary to reflect changes in university policies or applicable laws. Any updates
                                    will be posted on this portal.
                                </li>
                            </ul>

                            <div
                                class="flex gap-1 px-3 py-3 mt-5 mb-5 text-sm border border-yellow-200 rounded-md md:items-center text-black-500 bg-yellow-50 dark:bg-yellow-400/20 dark:border-yellow-500/50">
                                <h6 class="mb-1 font-bold">Limitation of Liability
                                </h6>
                            </div>

                            <ul class="px-3 space-y-3 text-justify list-disc list-inside rounded-md">
                                <li>USM will not be liable for any damages, losses, or liabilities arising from your use
                                    of this website, including errors, interruptions, or technical malfunctions, except
                                    as required by law. This limitation of liability applies to the fullest extent
                                    permitted under Philippine law.
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="flex items-center justify-between p-4 border-t border-slate-200 dark:border-zink-500">
                        <h6 class="text-15">University of Southern Mindanao</h6>
                    </div>
                </div>

            </div>
        </div>

        <script src='{{ asset('backend/assets/libs/choices/public/assets/scripts/choices.min.js') }}'></script>
        <script src="{{ asset('backend/assets/libs/@popperjs/core/umd/popper.min.js') }}"></script>
        <script src="{{ asset('backend/assets/libs/tippy.js/tippy-bundle.umd.min.js') }}"></script>
        <script src="{{ asset('backend/assets/libs/simplebar/simplebar.min.js') }}"></script>
        <script src="{{ asset('backend/assets/libs/prismjs/prism.js') }}"></script>
        <script src="{{ asset('backend/assets/libs/lucide/umd/lucide.js') }}"></script>
        <script src="{{ asset('backend/assets/js/tailwick.bundle.js') }}"></script>
        <script src="{{ asset('backend/assets/libs/flatpickr/flatpickr.min.js') }}"></script>
        <!-- cleave.js -->
        <script src="{{ asset('backend/assets/libs/cleave.js/cleave.min.js') }}"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
        <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

        <!--apexchart js-->
        <script src="{{ asset('backend/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

        <!--dashboard ecommerce init js-->
        <script src="{{ asset('backend/assets/js/pages/dashboards-ecommerce.init.js') }}"></script>

        <!-- App js -->
        <script src="{{ asset('backend/assets/js/app.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <!-- cleave.js -->
        <script src="{{ asset('backend/assets/libs/cleave.js/cleave.min.js') }}"></script>
        <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
        <script>
            if (document.querySelector("#cleavePhone")) {
                var cleaveBlocks = new Cleave('#cleavePhone', {
                    delimiters: ['-', '-'],
                    blocks: [4, 3, 4], // Adjusted for xx-xxx-xxxx format
                    numericOnly: true
                });
            }

            document.addEventListener("DOMContentLoaded", function() {
                const phoneInput = document.getElementById("cleavePhone");

                // Validate phone input on blur
                phoneInput.addEventListener("blur", function() {
                    const phone = phoneInput.value.trim(); // Trim whitespace

                    // Check if phone number is complete (e.g., xxxx-xxx-xxxx format, 12 characters including dashes)
                    if (phone && phone.length !== 13) {
                        phoneInput.value = ""; // Clear invalid phone input

                        // Show a toast notification
                        Toastify({
                            text: 'Please enter a complete phone number in the format xxxx-xxx-xxxx.',
                            duration: 5000,
                            gravity: "top",
                            position: "right",
                            backgroundColor: "#f56565", // Red color for error
                            className: "error",
                        }).showToast();
                    }
                });
            });

            document.addEventListener("DOMContentLoaded", function() {
                flatpickr("#birthdate", {
                    dateFormat: "M d, Y", // Display format for the date
                    maxDate: "2009-12-31", // Limit selection to November 6, 2010, for 14 years or older
                    disable: [{
                        from: "2009-12-31", // Disable all dates from November 7, 2010, onwards
                        to: new Date() // Current date or any future date
                    }],
                    onReady: function(selectedDates, dateStr, instance) {
                        instance.jumpToDate("2009-12-31"); // Opens calendar at the last allowed date
                    },
                    onChange: function(selectedDates, dateStr, instance) {
                        const selectedDate = selectedDates[0];
                        if (selectedDate && selectedDate > new Date("2009-12-31")) {
                            instance.clear(); // Clears selection if date is beyond November 6, 2010
                            Toastify({
                                text: 'Only students aged 14 years old or older can apply.',
                                duration: 5000,
                                gravity: "top",
                                position: "right",
                                backgroundColor: "#f56565", // Red color for error
                                className: "error",
                            }).showToast();
                        }
                    }
                });
            });

            document.addEventListener("DOMContentLoaded", function() {
                const emailInput = document.getElementById("email");

                emailInput.addEventListener("blur", function() {
                    const email = emailInput.value.trim(); // Trim whitespace
                    const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

                    // Only validate if email is not empty
                    if (email && !emailPattern.test(email)) {
                        emailInput.value = ""; // Clear invalid email input
                        Toastify({
                            text: 'Please enter a valid email address.',
                            duration: 5000,
                            gravity: "top",
                            position: "right",
                            backgroundColor: "#f56565", // Red color for error
                            className: "error",
                        }).showToast();
                    }
                });
            });

            const checkbox = document.getElementById("defaultCheck1");
            const submitButton = document.getElementById("submitButton");

            // Enable/disable submit button based on checkbox state
            checkbox.addEventListener("change", function() {
                submitButton.disabled = !checkbox.checked;
            });

            // Display success message if session has success
            @if (session('success'))
                Swal.fire({
                    title: 'Success!',
                    text: "{{ session('success') }}",
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{ route('login') }}";
                    }
                });
            @endif
        </script>

</body>

</html>
