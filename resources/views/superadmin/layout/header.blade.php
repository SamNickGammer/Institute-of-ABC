<style>
    .sa-header {
        position: fixed;
        top: 0; left: 0; right: 0;
        height: 60px;
        z-index: 999;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 24px;
        backdrop-filter: blur(12px);
        background: rgba(17,17,17,0.97);
        border-bottom: 1px solid rgba(255,255,255,0.08);
    }
    .sa-header-left {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .sa-header-logo {
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .sa-header-logo img {
        height: 34px;
        width: auto;
        filter: brightness(0) invert(1);
    }
    .sa-header-right {
        display: flex;
        align-items: center;
        gap: 14px;
    }
    .sa-logout-btn {
        background: rgba(239,68,68,0.15);
        color: #f87171;
        border: 1px solid rgba(239,68,68,0.25);
        border-radius: 8px;
        padding: 8px 18px;
        font-size: 12px;
        cursor: pointer;
        font-family: inherit;
        transition: all 0.15s;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .sa-logout-btn:hover {
        background: #dc2626;
        color: #fff;
        border-color: #dc2626;
    }
</style>

<div class="sa-header">
    <div class="sa-header-left">
        <a href="{{ route('superadmin.dashboard') }}" class="sa-header-logo">
            <img src="{{ asset('assets/images/logo/abc_logo.svg') }}" alt="Institute of ABC">
        </a>
        <span class="font-HellixB" style="font-size: 11px; color: rgba(255,255,255,0.3); margin-left: 4px; letter-spacing: 0.05em; text-transform: uppercase;">Admin Panel</span>
    </div>

    <div class="sa-header-right">
        <span id="saAdminName" class="font-HellixR" style="font-size: 12px; color: rgba(255,255,255,0.5);"></span>
        <button id="saLogoutBtn" class="sa-logout-btn font-HellixB">
            <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
            Logout
        </button>
    </div>
</div>

<script>
    document.getElementById('saLogoutBtn').addEventListener('click', function() {
        sessionStorage.removeItem('adminData');
        window.location.href = '/admin-abc/login';
    });

    document.addEventListener('DOMContentLoaded', function() {
        var session = (typeof getAdminData === 'function') ? getAdminData() : null;
        if (session) {
            document.getElementById('saAdminName').textContent = session.adminData.branchName || 'Admin';
        }
    });
</script>
