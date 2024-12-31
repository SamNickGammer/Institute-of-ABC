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
</head>

<body class="bg-gray-300 min-h-screen flex items-center justify-center font-HellixR">
    <form name="login-branch" id="login-branch" method="post" class="bg-white p-8 rounded-lg shadow-lg w-full max-w-sm">
        @csrf
        <h2 class="text-primary text-3xl font-HellixB text-center mb-4">Welcome, Branch</h2>
        <p class="text-center text-gray-700 mb-6">Please log in</p>

        <input type="text" id="branchId" name="branchId" placeholder="Branch Id"
            class="w-full border border-gray-300 rounded-md p-3 mb-4 focus:outline-none focus:border-primary transition" />
        <input type="password" id="password" name="password" placeholder="Password"
            class="w-full border border-gray-300 rounded-md p-3 mb-4 focus:outline-none focus:border-primary transition" />
        <input type="button" value="Log In"
            class="w-full bg-[#313131] text-white font-bold py-3 rounded-md hover:bg-[#000] transition cursor-pointer"
            onclick="loginBranch()" />
    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        const API_URL_WEB = "http://localhost:8000/api";

        async function loginBranch() {
            const branchId = document.getElementById('branchId').value;
            const password = document.getElementById('password').value;

            if (!branchId || !password) {
                toastr.error('Please fill in both fields.');
                return;
            }

            try {
                const response = await fetch(`${API_URL_WEB}/admin/login`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        branchCode: branchId,
                        password: password
                    })
                });

                const result = await response.json();

                if (response.ok) {
                    toastr.success(result.message || 'Login successful.');

                    const branchData = result.data;
                    const expiryTime = Date.now() + 30 * 60 * 1000; 
                    sessionStorage.setItem('branchData', JSON.stringify({ branchData, expiryTime }));

                    window.location.href = '/admin';
                } else {
                    toastr.error(result.message || 'Login failed.');
                }
            } catch (error) {
                toastr.error('An error occurred while logging in.');
                console.error('Login Error:', error);
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            checkSessionExpiration();
        });

        function checkSessionExpiration() {
            const sessionData = sessionStorage.getItem('branchData');
            
            if (sessionData) {
                const parsedData = JSON.parse(sessionData);
                const { expiryTime } = parsedData;

                if (Date.now() > expiryTime) {
                    return;
                } else {
                    window.location.href = '/admin';
                    return;
                }
            }
        }
    </script>
</body>
</html>
