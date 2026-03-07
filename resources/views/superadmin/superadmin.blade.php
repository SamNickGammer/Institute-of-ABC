<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Institute of ABC</title>
    @vite('resources/css/app.css')
    @include('layout.fonts')
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
</head>
<body class="min-h-screen font-HellixR">

    <div id="not-supported" class="hidden fixed inset-0 bg-white flex-col items-center justify-center text-center p-4">
        <h1 class="text-2xl font-HellixB text-gray-800">Mobile Not Supported</h1>
        <p class="text-gray-600 mt-2">Please use a desktop browser.</p>
    </div>

    <div id='main' style="display: none">
        @include('superadmin.layout.header')
        @include('superadmin.layout.content')
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
                checkAdminSession();
            }
        }

        function checkAdminSession() {
            const mainContent = document.getElementById('main');
            const sessionData = sessionStorage.getItem('adminData');

            if (!sessionData) {
                window.location.href = '/admin-abc/login';
                return;
            }

            const parsedData = JSON.parse(sessionData);
            if (Date.now() > parsedData.expiryTime) {
                sessionStorage.removeItem('adminData');
                window.location.href = '/admin-abc/login';
                return;
            }

            if (parsedData.adminData.role !== 'admin') {
                sessionStorage.removeItem('adminData');
                window.location.href = '/admin-abc/login';
                return;
            }

            mainContent.style.display = 'block';
        }

        window.addEventListener('resize', checkDeviceCompatibility);
    </script>
</body>
</html>
