<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&family=Hellix:wght@100;200;300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    @vite('resources/css/app.css')
    <style>
        @layer base {
            @font-face {
                font-family: 'Hellix-Black';
                src: url("{{ asset('assets/fonts/Hellix-Black.woff2') }}") format('woff2'),
                    url("{{ asset('assets/fonts/Hellix-Black.woff') }}") format('woff');
            }

            @font-face {
                font-family: 'Hellix-Bold';
                src: url("{{ asset('assets/fonts/Hellix-Bold.woff2') }}") format('woff2'),
                    url("{{ asset('assets/fonts/Hellix-Bold.woff') }}") format('woff');
            }

            @font-face {
                font-family: 'Hellix-ExtraBold';
                ;
                src: url("{{ asset('assets/fonts/Hellix-ExtraBold.woff2') }}") format('woff2'),
                    url("{{ asset('assets/fonts/Hellix-ExtraBold.woff') }}") format('woff');
            }

            @font-face {
                font-family: 'Hellix-Light';
                src: url("{{ asset('assets/fonts/Hellix-Light.woff2') }}") format('woff2'),
                    url("{{ asset('assets/fonts/Hellix-Light.woff') }}") format('woff');
            }

            @font-face {
                font-family: 'Hellix-Medium';
                src: url("{{ asset('assets/fonts/Hellix-Medium.woff2') }}") format('woff2'),
                    url("{{ asset('assets/fonts/Hellix-Medium.woff') }}") format('woff');
            }

            @font-face {
                font-family: 'Hellix-Regular';
                src: url("{{ asset('assets/fonts/Hellix-Regular.woff2') }}") format('woff2'),
                    url("{{ asset('assets/fonts/Hellix-Regular.woff') }}") format('woff');
            }

            @font-face {
                font-family: 'Hellix-SemiBold';
                src: url("{{ asset('assets/fonts/Hellix-SemiBold.woff2') }}") format('woff2'),
                    url("{{ asset('assets/fonts/Hellix-SemiBold.woff') }}") format('woff');
            }

            @font-face {
                font-family: 'Hellix-Thin';
                src: url("{{ asset('assets/fonts/Hellix-Thin.woff2') }}") format('woff2'),
                    url("{{ asset('assets/fonts/Hellix-Thin.woff') }}") format('woff');
            }

        }
    </style>
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
</head>
<body class="min-h-screen font-HellixR">

    <div id="not-supported" class="hidden fixed inset-0 bg-white flex-col items-center justify-center text-center p-4">
        <div class="loader mb-4"></div>
        <h1 class="text-2xl font-HellixB text-gray-800">Mobile Not Supported</h1>
        <p class="text-gray-600 mt-2">Kindly log in using a desktop browser for the best experience.</p>
    </div>

    <div id='main' style="display: none">
        @include('admin.layout.header')
        @include('admin.layout.content')
        {{-- @include('admin.layout.footer') --}}
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            checkDeviceCompatibility();
            // checkSessionExpiration();
        });

        function checkDeviceCompatibility() {
            const mainContent = document.getElementById('main');
            const notSupportedMessage = document.getElementById('not-supported');

            // Check for mobile screen size or user agent
            const isMobile = window.innerWidth <= 768 || /Mobi|Android/i.test(navigator.userAgent);

            if (isMobile) {
                mainContent.style.display = 'none';
                notSupportedMessage.style.display = 'flex';
            } else {
                notSupportedMessage.style.display = 'none';
                checkSessionExpiration();
            }
        }

        function checkSessionExpiration() {
            const mainContent = document.getElementById('main');
            const sessionData = sessionStorage.getItem('branchData');
            
            if (!sessionData) {
                window.location.href = '/admin/login';
                return;
            }

            const parsedData = JSON.parse(sessionData);
            const { expiryTime } = parsedData;

            if (Date.now() > expiryTime) {
                sessionStorage.removeItem('branchData'); 
                window.location.href = '/admin/login';
                return;
            }

            mainContent.style.display = 'block';
        }

        // Re-check device compatibility on window resize
        window.addEventListener('resize', checkDeviceCompatibility);
    </script>
</body>
</html>