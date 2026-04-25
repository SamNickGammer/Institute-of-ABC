<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Branch Login - Institute of ABC</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    @include('layout.fonts')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            min-height: 100vh; display: flex; background: #f5f5f5;
            font-family: 'Hellix-Regular', sans-serif;
        }

        /* Left panel */
        .login-left {
            flex: 1; background: #0a0a0a; position: relative; overflow: hidden;
            display: flex; flex-direction: column; justify-content: center; align-items: center;
            padding: 60px;
        }
        .login-left-glow {
            position: absolute; width: 500px; height: 500px; border-radius: 50%;
            background: radial-gradient(circle, rgba(96,165,250,0.1) 0%, transparent 70%);
            top: 30%; left: 50%; transform: translate(-50%, -50%); pointer-events: none;
        }
        .login-left-pattern {
            position: absolute; inset: 0; opacity: 0.03;
            background-image: radial-gradient(circle at 1px 1px, #fff 1px, transparent 0);
            background-size: 40px 40px;
        }
        .login-left-content { position: relative; z-index: 1; text-align: center; max-width: 400px; }
        .login-left-logo { height: 56px; filter: brightness(0) invert(1); margin-bottom: 32px; }
        .login-left-title {
            font-size: 32px; color: #fff; margin: 0 0 12px; letter-spacing: -0.02em;
        }
        .login-left-desc {
            font-size: 15px; color: rgba(255,255,255,0.45); line-height: 1.7; margin: 0 0 40px;
        }
        .login-left-features { text-align: left; }
        .login-left-feature {
            display: flex; align-items: center; gap: 12px; margin-bottom: 16px;
        }
        .login-left-feature-icon {
            width: 36px; height: 36px; border-radius: 10px;
            background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.08);
            display: flex; align-items: center; justify-content: center; flex-shrink: 0;
        }
        .login-left-feature-icon svg { width: 18px; height: 18px; stroke: rgba(255,255,255,0.5); }
        .login-left-feature-text { font-size: 14px; color: rgba(255,255,255,0.55); }

        /* Right panel */
        .login-right {
            width: 480px; display: flex; flex-direction: column;
            justify-content: center; padding: 60px;
            background: #fff;
        }
        .login-back {
            display: inline-flex; align-items: center; gap: 6px; font-size: 13px;
            color: #9ca3af; text-decoration: none; margin-bottom: 40px;
            transition: color 0.2s;
        }
        .login-back:hover { color: #111; }
        .login-back svg { width: 16px; height: 16px; }
        .login-header-label {
            font-size: 12px; text-transform: uppercase; letter-spacing: 0.1em;
            color: #9ca3af; margin-bottom: 8px;
        }
        .login-header-title {
            font-size: 28px; color: #111; margin: 0 0 6px; letter-spacing: -0.02em;
        }
        .login-header-desc {
            font-size: 14px; color: #9ca3af; margin: 0 0 32px;
        }
        .login-group { margin-bottom: 18px; }
        .login-label {
            display: block; font-size: 12px; color: #6b7280;
            text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 7px;
        }
        .login-input-wrap {
            position: relative; display: flex; align-items: center;
        }
        .login-input-icon {
            position: absolute; left: 14px; width: 18px; height: 18px; color: #9ca3af;
            pointer-events: none;
        }
        .login-input {
            width: 100%; border: 1px solid #e5e7eb; border-radius: 12px;
            padding: 13px 16px 13px 42px; font-size: 14px; outline: none;
            transition: border-color 0.2s; font-family: 'Hellix-Regular';
        }
        .login-input:focus { border-color: #111; }
        .login-input::placeholder { color: #c9cdd3; }
        .login-toggle-pass {
            position: absolute; right: 14px; background: none; border: none;
            cursor: pointer; color: #9ca3af; padding: 4px;
        }
        .login-toggle-pass:hover { color: #6b7280; }
        .login-toggle-pass svg { width: 18px; height: 18px; }
        .login-submit {
            width: 100%; background: #121212; color: #fff; border: none;
            border-radius: 12px; padding: 14px; font-size: 15px;
            cursor: pointer; transition: all 0.2s; margin-top: 8px;
            display: flex; align-items: center; justify-content: center; gap: 8px;
            font-family: 'Hellix-SemiBold';
        }
        .login-submit:hover { background: #2a2a2a; transform: translateY(-1px); }
        .login-submit:disabled { opacity: 0.5; cursor: not-allowed; transform: none; }
        .login-submit svg { width: 18px; height: 18px; }
        .login-footer {
            margin-top: 32px; padding-top: 24px; border-top: 1px solid #f3f4f6;
            text-align: center; font-size: 13px; color: #9ca3af;
        }
        .login-footer a { color: #6b7280; text-decoration: none; transition: color 0.2s; }
        .login-footer a:hover { color: #111; }

        /* Mobile */
        @media (max-width: 900px) {
            body { flex-direction: column; }
            .login-left {
                flex: none; padding: 40px 24px; min-height: auto;
            }
            .login-left-features { display: none; }
            .login-left-title { font-size: 24px; }
            .login-left-desc { margin-bottom: 0; font-size: 14px; }
            .login-right { width: 100%; padding: 32px 24px; }
            .login-back { margin-bottom: 24px; }
        }
    </style>
</head>
<body>
    {{-- Left Panel --}}
    <div class="login-left">
        <div class="login-left-glow"></div>
        <div class="login-left-pattern"></div>
        <div class="login-left-content">
            <img src="{{ asset('assets/images/logo/abc_logo.svg') }}" alt="ABC Logo" class="login-left-logo">
            <h1 class="login-left-title" style="font-family:'Hellix-Bold';">Branch Management Portal</h1>
            <p class="login-left-desc">Access your branch dashboard to manage students, marksheets, and certifications.</p>
            <div class="login-left-features">
                <div class="login-left-feature">
                    <div class="login-left-feature-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197"/></svg>
                    </div>
                    <span class="login-left-feature-text">Manage student admissions & records</span>
                </div>
                <div class="login-left-feature">
                    <div class="login-left-feature-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <span class="login-left-feature-text">Update marksheets & request certifications</span>
                </div>
                <div class="login-left-feature">
                    <div class="login-left-feature-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    </div>
                    <span class="login-left-feature-text">Track performance & branch analytics</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Right Panel --}}
    <div class="login-right">
        <a href="/" class="login-back">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Back to website
        </a>

        <div class="login-header-label" style="font-family:'Hellix-SemiBold';">Branch Login</div>
        <h2 class="login-header-title" style="font-family:'Hellix-Bold';">Welcome back</h2>
        <p class="login-header-desc">Enter your branch credentials to continue.</p>

        <div class="login-group">
            <label class="login-label" style="font-family:'Hellix-SemiBold';">Branch Code</label>
            <div class="login-input-wrap">
                <svg class="login-input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                <input type="text" id="branchId" class="login-input" placeholder="Enter your branch code" autocomplete="off">
            </div>
        </div>

        <div class="login-group">
            <label class="login-label" style="font-family:'Hellix-SemiBold';">Password</label>
            <div class="login-input-wrap">
                <svg class="login-input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                <input type="password" id="password" class="login-input" placeholder="Enter your password" autocomplete="current-password">
                <button type="button" class="login-toggle-pass" onclick="togglePassword()" id="togglePassBtn">
                    <svg id="eyeIcon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                </button>
            </div>
        </div>

        <button class="login-submit" id="loginBtn" onclick="loginBranch()">
            Sign In
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
        </button>

        <div class="login-footer">
            <a href="/">Institute of ABC</a> &middot; &copy; {{ date('Y') }}
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" defer></script>

    <script>
        var API_URL_WEB = '{{ url("/api") }}';

        function togglePassword() {
            var input = document.getElementById('password');
            var icon = document.getElementById('eyeIcon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>';
            } else {
                input.type = 'password';
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>';
            }
        }

        // Enter key to submit
        document.addEventListener('DOMContentLoaded', function() {
            checkSessionExpiration();

            document.getElementById('password').addEventListener('keydown', function(e) {
                if (e.key === 'Enter') loginBranch();
            });
            document.getElementById('branchId').addEventListener('keydown', function(e) {
                if (e.key === 'Enter') document.getElementById('password').focus();
            });
        });

        function loginBranch() {
            var branchId = document.getElementById('branchId').value.trim();
            var password = document.getElementById('password').value;

            if (!branchId || !password) {
                toastr.error('Please fill in both fields.');
                return;
            }

            var btn = document.getElementById('loginBtn');
            btn.disabled = true;
            btn.innerHTML = 'Signing in...';

            fetch(API_URL_WEB + '/admin-login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ branchCode: branchId, password: password, portal: 'branch' })
            })
            .then(function(r) { return r.json().then(function(d) { return { ok: r.ok, data: d }; }); })
            .then(function(res) {
                btn.disabled = false;
                btn.innerHTML = 'Sign In <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="18" height="18"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>';

                if (res.ok) {
                    toastr.success(res.data.message || 'Login successful.');
                    var branchData = res.data.data;
                    var expiryTime = Date.now() + 30 * 60 * 1000;
                    sessionStorage.setItem('branchData', JSON.stringify({ branchData: branchData, expiryTime: expiryTime }));
                    window.location.href = '/branch';
                } else {
                    if (res.data && res.data.redirect_url) {
                        toastr.info(res.data.message || 'Redirecting...');
                        setTimeout(function() {
                            window.location.href = res.data.redirect_url;
                        }, 500);
                        return;
                    }
                    toastr.error(res.data.message || 'Login failed.');
                }
            })
            .catch(function() {
                btn.disabled = false;
                btn.innerHTML = 'Sign In <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="18" height="18"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>';
                toastr.error('An error occurred. Please try again.');
            });
        }

        function checkSessionExpiration() {
            var adminSession = sessionStorage.getItem('adminData');
            if (adminSession) {
                var parsedAdmin = JSON.parse(adminSession);
                if (Date.now() <= parsedAdmin.expiryTime && parsedAdmin.adminData && parsedAdmin.adminData.role === 'admin') {
                    window.location.href = '/admin-abc';
                    return;
                }
            }

            var sessionData = sessionStorage.getItem('branchData');
            if (sessionData) {
                var parsed = JSON.parse(sessionData);
                if (Date.now() <= parsed.expiryTime) {
                    window.location.href = '/branch';
                }
            }
        }
    </script>
</body>
</html>
