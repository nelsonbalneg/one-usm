<!DOCTYPE html>
<html lang="en" class="light scroll-smooth group" data-layout="vertical" data-sidebar="light" data-sidebar-size="lg"
    data-mode="light" data-topbar="light" data-skin="default" data-navbar="sticky" data-content="fluid" dir="ltr">

<head>

    <meta charset="utf-8">
    <title>One USM | Sign in </title>
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

    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-EJPB3BXP56');
    </script>

    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>

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

                <div class="mt-2 mb-8 text-center">
                    <p class="text-slate-500 dark:text-zink-200">Sign in to continue to One USM</p>
                </div>

                @if ($errors->any())
                    <div class="mt-2 mb-5 text-sm text-red-500 text-center">
                        <ul class="list-none">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="mb-3">
                    <select id="campus" name="campus" required
                        class="form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                        <option value="" selected disabled>Select Campus</option>
                        <option value="1" {{ old('campus') == '1' ? 'selected' : '' }}>Main Campus</option>
                        <option value="1" {{ old('campus') == '1' ? 'selected' : '' }}>PPALMA Campus</option>
                        <option value="3" {{ old('campus') == '3' ? 'selected' : '' }}>M'lang Campus</option>
                        <option value="3" {{ old('campus') == '3' ? 'selected' : '' }}>Arakan Campus</option>
                        <option value="3" {{ old('campus') == '3' ? 'selected' : '' }}>KCC Campus</option>
                    </select>

                </div>
                <form id="google-login-form" method="GET" action="{{ route('google.login') }}">
                    <input type="hidden" name="campus" id="google-campus" value="">
                    <button type="submit"
                        class="w-full flex items-center justify-center gap-2 border border-gray-300 rounded-md py-2 hover:bg-gray-50">
                        <img src="https://developers.google.com/identity/images/g-logo.png" alt="Google"
                            class="w-5 h-5">
                        <span>Continue with Google</span>
                    </button>
                </form>

            </div>
        </div>
    </div>

    <script src="{{ asset('backend/assets/js/tailwick.bundle.js') }}"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script>
        // Copy selected campus to the hidden input before submitting
        const campusSelect = document.getElementById('campus');
        const googleCampusInput = document.getElementById('google-campus');
        const googleForm = document.getElementById('google-login-form');

        googleForm.addEventListener('submit', function(e) {
            if (!campusSelect.value) {
                e.preventDefault();
                alert('Please select a campus before logging in.');
            } else {
                googleCampusInput.value = campusSelect.value;
            }
        });
    </script>
</body>

</html>
