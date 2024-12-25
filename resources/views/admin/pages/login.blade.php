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

</head>

<body class="bg-gray-300 min-h-screen flex items-center justify-center font-HellixR">
    <form name='login-branch' id='login-branch' method='post' class="bg-white p-8 rounded-lg shadow-lg w-full max-w-sm">
        @csrf
        <h2 class="text-primary text-3xl font-HellixB text-center mb-4">Welcome, Branch</h2>
        <p class="text-center text-gray-700 mb-6">Please log in</p>

        <input type="text" placeholder="Branch Id"
            class="w-full border border-gray-300 rounded-md p-3 mb-4 focus:outline-none focus:border-primary transition" />
        <input type="password" placeholder="Password"
            class="w-full border border-gray-300 rounded-md p-3 mb-4 focus:outline-none focus:border-primary transition" />
        <input type="submit" value="Log In"
            class="w-full bg-[#313131] text-white font-bold py-3 rounded-md hover:bg-[#000] transition cursor-pointer" />
    </form>
</body>
</html>
