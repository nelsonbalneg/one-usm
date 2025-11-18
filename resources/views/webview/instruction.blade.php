<!DOCTYPE html>
<html lang="en" class="light scroll-smooth group" data-layout="vertical" data-sidebar="light" data-sidebar-size="lg"
    data-mode="light" data-topbar="light" data-skin="default" data-navbar="sticky" data-content="fluid" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Open in External Browser</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta content="Minimal Admin & Dashboard Template" name="description">
    <meta content="Themesdesign" name="author">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('backend/assets/images/favicon.ico')}}">
    <!-- Layout config Js -->
    <script src="{{asset('backend/assets/js/layout.js')}}"></script>
    <!-- Icons CSS -->
    <!-- Tailwind CSS -->
    <link rel="stylesheet" href="{{asset('backend/assets/css/tailwind2.css')}}">
</head>

<body
    class="flex items-center justify-center min-h-screen py-16 bg-cover bg-auth-pattern dark:bg-auth-pattern-dark font-public">

    <div class="mb-0 border-none shadow-none lg:w-[500px] card bg-white/70 dark:bg-zink-500/70">
        <div class="!px-10 !py-12 card-body">
            <a href="index">
                <img src="{{asset('backend/assets/images/logo-light.png')}}" alt=""
                    class="hidden h-15 mx-auto dark:block">
                <img src="{{asset('backend/assets/images/logo-dark.png')}}" alt=""
                    class="block h-15 mx-auto dark:hidden">
            </a>

            <div class="mt-10">
                <img src="{{asset('backend/assets/images/error-404.png')}}" alt="" class="h-64 mx-auto">
            </div>
            <div class="mt-8 text-center">
                <h4 class="mb-2 text-purple-500">Open in External Browser</h4>
                <p class="mb-6 text-slate-500 dark:text-zink-200">It looks like you're using an in-app browser. For the
                    best experience, please open this link in your device's default browser.</p>
                <p class="mb-6 text-slate-500 dark:text-zink-200">To do this, tap on the menu options and select "Open
                    in Browser."</p>

                <!-- Add button for opening in external browser -->
                <button id="openInBrowserBtn" class="px-4 py-2 mt-4 text-white bg-purple-500 rounded">
                    Open in External Browser
                </button>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('openInBrowserBtn').addEventListener('click', function () {
            const externalUrl = 'https://cee.usm.edu.ph'; // Replace with your desired URL

            // Check if the browser is likely to be a WebView (e.g., Facebook or Instagram)
            const isWebView = /FBAN|FBAV|Instagram/.test(navigator.userAgent);

            if (isWebView) {
                // On Android WebView, attempt to open in the default browser using an intent
                const androidUrl = `intent://${externalUrl.replace(/^https?:\/\//, '')}#Intent;scheme=https;package=com.android.chrome;end;`;
                window.location.href = androidUrl;
            } else {
                // For other browsers, open in a new tab
                window.open(externalUrl, '_blank');
            }
        });
    </script>

    <script src='{{asset('backend/assets/libs/choices.js/public/assets/scripts/choices.min.js')}}'></script>
    <script src="{{asset('backend/assets/libs/@popperjs/core/umd/popper.min.js')}}"></script>
    <script src="{{asset('backend/assets/libs/tippy.js/tippy-bundle.umd.min.js')}}"></script>
    <script src="{{asset('backend/assets/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{asset('backend/assets/libs/prismjs/prism.js')}}"></script>
    <script src="{{asset('backend/assets/libs/lucide/umd/lucide.js')}}"></script>
    <script src="{{asset('backend/assets/js/tailwick.bundle.js')}}"></script>
</body>

</html>