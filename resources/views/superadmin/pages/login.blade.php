<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Institute of ABC</title>
    @vite('resources/css/app.css')
    @include('layout.fonts')
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <style>
        .sa-login-bg {
            min-height: 100vh;
            background: #111;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }
        .sa-login-bg::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle at 30% 40%, rgba(99,102,241,0.08) 0%, transparent 50%),
                        radial-gradient(circle at 70% 60%, rgba(168,85,247,0.06) 0%, transparent 50%);
            animation: sa-bg-drift 20s ease-in-out infinite alternate;
        }
        @keyframes sa-bg-drift {
            0% { transform: translate(0, 0); }
            100% { transform: translate(-5%, 3%); }
        }
        .sa-login-card {
            position: relative;
            z-index: 1;
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.08);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 48px 40px;
            width: 100%;
            max-width: 400px;
        }
        .sa-login-input {
            width: 100%;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 10px;
            padding: 14px 16px;
            color: #fff;
            font-size: 14px;
            outline: none;
            transition: border-color 0.2s;
        }
        .sa-login-input::placeholder { color: rgba(255,255,255,0.25); }
        .sa-login-input:focus { border-color: rgba(255,255,255,0.3); }
        .sa-login-btn {
            width: 100%;
            background: #fff;
            color: #111;
            border: none;
            border-radius: 10px;
            padding: 14px;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.2s;
        }
        .sa-login-btn:hover { background: #e5e7eb; }
        .sa-login-btn:disabled { opacity: 0.5; cursor: not-allowed; }
    </style>
</head>

<body class="font-HellixR" style="margin: 0;">
    <div class="sa-login-bg">
        <div class="sa-login-card">
            <div style="text-align: center; margin-bottom: 36px;">
                <img src="{{ asset('assets/images/logo/abc_logo.svg') }}" alt="Institute of ABC" style="height: 40px; filter: brightness(0) invert(1); margin-bottom: 16px;">
                <h1 class="font-HellixB" style="color: #fff; font-size: 22px; margin: 0 0 6px;">Admin Portal</h1>
                <p style="color: rgba(255,255,255,0.35); font-size: 13px; margin: 0;">Authorized access only</p>
            </div>

            <form id="adminLoginForm" onsubmit="return false;">
                <div style="margin-bottom: 16px;">
                    <label style="display: block; color: rgba(255,255,255,0.4); font-size: 11px; text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 6px;" class="font-HellixB">Admin ID</label>
                    <input type="text" id="adminId" class="sa-login-input font-HellixR" placeholder="Enter admin ID" autocomplete="off">
                </div>
                <div style="margin-bottom: 28px;">
                    <label style="display: block; color: rgba(255,255,255,0.4); font-size: 11px; text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 6px;" class="font-HellixB">Password</label>
                    <input type="password" id="adminPassword" class="sa-login-input font-HellixR" placeholder="Enter password">
                </div>
                <button type="submit" id="loginBtn" class="sa-login-btn font-HellixB" onclick="loginAdmin()">Sign In</button>
            </form>

            <div style="text-align: center; margin-top: 24px;">
                <a href="/branch/login" style="color: rgba(255,255,255,0.2); font-size: 12px; text-decoration: none;" class="font-HellixR">Branch Login &rarr;</a>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" defer></script>

    <script>
        const API_URL = `{{ rtrim(config('app.url'), '/') }}/api`;

        async function loginAdmin() {
            var adminId = document.getElementById('adminId').value.trim();
            var password = document.getElementById('adminPassword').value;
            var btn = document.getElementById('loginBtn');

            if (!adminId || !password) {
                toastr.error('Please fill in both fields.');
                return;
            }

            btn.disabled = true;
            btn.textContent = 'Signing in...';

            try {
                var response = await fetch(API_URL + '/admin-login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ branchCode: adminId, password: password })
                });

                var result = await response.json();

                if (response.ok) {
                    var data = result.data;

                    if (data.role !== 'admin') {
                        toastr.error('Access denied. Admin credentials required.');
                        btn.disabled = false;
                        btn.textContent = 'Sign In';
                        return;
                    }

                    var expiryTime = Date.now() + 60 * 60 * 1000; // 1 hour for admin
                    sessionStorage.setItem('adminData', JSON.stringify({
                        adminData: {
                            branch_id: data.branch_id,
                            branchCode: data.branchCode,
                            branchName: data.branchName,
                            role: data.role,
                            email: data.email,
                        },
                        expiryTime: expiryTime
                    }));

                    toastr.success('Welcome, Admin.');
                    setTimeout(function() {
                        window.location.href = '/admin-abc';
                    }, 500);
                } else {
                    toastr.error(result.message || 'Invalid credentials.');
                    btn.disabled = false;
                    btn.textContent = 'Sign In';
                }
            } catch (error) {
                toastr.error('Connection error. Please try again.');
                btn.disabled = false;
                btn.textContent = 'Sign In';
            }
        }

        // If already logged in as admin, redirect
        document.addEventListener('DOMContentLoaded', function() {
            var raw = sessionStorage.getItem('adminData');
            if (raw) {
                var parsed = JSON.parse(raw);
                if (Date.now() <= parsed.expiryTime && parsed.adminData.role === 'admin') {
                    window.location.href = '/admin-abc';
                }
            }
        });

        // Enter key support
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') loginAdmin();
        });
    </script>
</body>
</html>
