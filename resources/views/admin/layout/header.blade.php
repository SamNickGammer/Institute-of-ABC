<style>
    .admin-header {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        height: 60px;
        background: #ffffff;
        border-bottom: 1px solid #e5e7eb;
        z-index: 999;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 24px;
        backdrop-filter: blur(12px);
        background: rgba(255,255,255,0.92);
    }
    .admin-header-left {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .admin-header-logo {
        font-size: 16px;
        color: #111;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .admin-header-logo img {
        height: 36px;
        width: auto;
        object-fit: contain;
    }
    .admin-header-right {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .header-credit-box {
        display: flex;
        align-items: center;
        gap: 8px;
        background: #f9fafb;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        padding: 7px 14px;
        font-size: 13px;
        transition: background 0.15s;
    }
    .header-credit-icon {
        width: 22px;
        height: 22px;
        background: #f0fdf4;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .header-credit-value {
        font-variant-numeric: tabular-nums;
        min-width: 40px;
    }
    .header-refresh-btn {
        width: 30px;
        height: 30px;
        border: none;
        background: transparent;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
        transition: background 0.15s;
        color: #9ca3af;
    }
    .header-refresh-btn:hover {
        background: #f3f4f6;
        color: #111;
    }
    .header-refresh-btn.spinning svg {
        animation: hdr-spin 0.8s linear infinite;
    }
    @keyframes hdr-spin { to { transform: rotate(360deg); } }
    .header-logout-btn {
        background: #fef2f2;
        color: #dc2626;
        border: 1px solid #fecaca;
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
    .header-logout-btn:hover {
        background: #dc2626;
        color: #fff;
        border-color: #dc2626;
    }
    .header-branch-name {
        font-size: 12px;
        color: #9ca3af;
        max-width: 160px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
</style>

<div class="admin-header">
    <div class="admin-header-left">
        <a href="{{ route('branch.dashboard') }}" class="admin-header-logo">
            <img src="{{ asset('assets/images/logo/abc_logo.svg') }}" alt="Institute of ABC">
        </a>
        <span class="font-HellixR" style="font-size: 11px; color: #d1d5db; margin-left: 4px;">Branch Panel</span>
    </div>

    <div class="admin-header-right">
        {{-- Credit Display --}}
        <div class="header-credit-box" id="headerCreditBox">
            <div class="header-credit-icon">
                <svg width="13" height="13" fill="none" stroke="#16a34a" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <span class="font-HellixR" style="font-size: 11px; color: #9ca3af;">Credit</span>
            <span id="headerCreditValue" class="font-HellixB header-credit-value" style="color: #16a34a;">--</span>
            <button id="headerRefreshBtn" class="header-refresh-btn" title="Refresh credit">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
            </button>
        </div>

        <div class="header-branch-name font-HellixR" id="headerBranchName"></div>

        <button id="logoutButtonAdmin" class="header-logout-btn font-HellixB">
            <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
            Logout
        </button>
    </div>
</div>

<script>
    // Logout
    document.getElementById('logoutButtonAdmin').addEventListener('click', function() {
        sessionStorage.removeItem('branchData');
        window.location.href = '/branch/login';
    });

    // Global credit refresh function — can be called from any page
    window.refreshHeaderCredit = function() {
        var session = getBranchData ? getBranchData() : null;
        if (!session) return;

        var btn = document.getElementById('headerRefreshBtn');
        var valEl = document.getElementById('headerCreditValue');
        btn.classList.add('spinning');

        fetch((typeof API_URL !== 'undefined' ? API_URL : '') + '/admin/branch/get_credit', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ branch_id: session.branchData.branch_id })
        })
        .then(function(r) { return r.json(); })
        .then(function(result) {
            btn.classList.remove('spinning');
            if (!result.error && result.data) {
                var credit = result.data.credit || 0;
                valEl.textContent = credit.toLocaleString();
                valEl.style.color = credit < (result.data.credit_per_certificate || 200) ? '#dc2626' : '#16a34a';
            }
        })
        .catch(function() {
            btn.classList.remove('spinning');
        });
    };

    // Refresh button click
    document.getElementById('headerRefreshBtn').addEventListener('click', function() {
        window.refreshHeaderCredit();
    });

    // Set branch name in header + initial credit load
    document.addEventListener('DOMContentLoaded', function() {
        var session = (typeof getBranchData === 'function') ? getBranchData() : null;
        if (session) {
            document.getElementById('headerBranchName').textContent = session.branchData.branchName || '';
        }
        // Small delay to ensure API_URL is defined from content.blade.php
        setTimeout(function() {
            if (typeof refreshHeaderCredit === 'function') refreshHeaderCredit();
        }, 100);
    });
</script>
