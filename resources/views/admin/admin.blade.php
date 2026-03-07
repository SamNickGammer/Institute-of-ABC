<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN</title>
    @vite('resources/css/app.css')
    @include('layout.fonts')
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
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" defer></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            checkDeviceCompatibility();
        });

        function checkDeviceCompatibility() {
            const mainContent = document.getElementById('main');
            const notSupportedMessage = document.getElementById('not-supported');
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
                window.location.href = '/branch/login';
                return;
            }

            const parsedData = JSON.parse(sessionData);
            const { expiryTime } = parsedData;

            if (Date.now() > expiryTime) {
                sessionStorage.removeItem('branchData');
                window.location.href = '/branch/login';
                return;
            }

            mainContent.style.display = 'block';
        }

        window.addEventListener('resize', checkDeviceCompatibility);
    </script>
</body>
</html>
