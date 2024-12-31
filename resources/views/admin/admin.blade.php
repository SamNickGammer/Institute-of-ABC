<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
    <style>
        .loader {
        width: 50px;
        aspect-ratio: 1;
        border-radius: 50%;
        border: 8px solid;
        border-color: #000 #0000;
        animation: l1 1s infinite;
        }
        @keyframes l1 {to{transform: rotate(.5turn)}}
    </style>
</head>

<body class="min-h-screen font-HellixR">

    {{-- <div id="spinner" class="fixed inset-0 bg-white flex items-center justify-center z-50 transition-opacity duration-300 opacity-100">
        <div class="animate-spin rounded-full h-12 w-12 border-t-4 border-blue-500 border-solid"></div>
    </div>
     --}}

    <div id='main' style="display: none">

        @include('admin.layout.header')
        
        @include('admin.layout.content')
        
        @include('admin.layout.footer')
        
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            checkSessionExpiration();
        });

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
    </script>
</body>
</html>
