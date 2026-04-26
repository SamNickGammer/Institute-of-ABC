<style>
    .sa-settings-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 18px;
        padding: 28px 32px;
        max-width: 720px;
    }
    .sa-settings-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
        margin-top: 22px;
    }
    .sa-settings-field label {
        display: block;
        margin-bottom: 6px;
        font-size: 11px;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        color: #6b7280;
    }
    .sa-settings-input {
        width: 100%;
        border: 1px solid #d1d5db;
        border-radius: 10px;
        padding: 12px 14px;
        font-size: 13px;
        outline: none;
        transition: border-color 0.15s, box-shadow 0.15s;
        background: #fff;
    }
    .sa-settings-input:focus {
        border-color: #111;
        box-shadow: 0 0 0 3px rgba(17,17,17,0.06);
    }
    .sa-settings-hint {
        margin-top: 14px;
        padding: 14px 16px;
        border-radius: 12px;
        background: #fff7ed;
        border: 1px solid #fdba74;
        color: #9a3412;
        font-size: 12px;
        line-height: 1.6;
    }
    .sa-settings-actions {
        margin-top: 24px;
        display: flex;
        justify-content: flex-end;
    }
    .sa-settings-btn {
        border: none;
        border-radius: 10px;
        padding: 12px 22px;
        background: #111;
        color: #fff;
        font-size: 13px;
        cursor: pointer;
        transition: opacity 0.15s;
    }
    .sa-settings-btn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }
    @media (max-width: 900px) {
        .sa-settings-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="sa-settings-card">
    <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:24px;">
        <div>
            <h1 class="font-HellixB" style="font-size:22px;margin:0 0 8px;color:#111;">Settings</h1>
            <p class="font-HellixR" style="font-size:13px;color:#6b7280;margin:0;">Change the superadmin login username and password from here.</p>
        </div>
    </div>

    <div class="sa-settings-hint font-HellixB">
        Sensitive section: use this only when you really need to update the superadmin login credentials. After save, you will be logged out and must login again with the new details.
    </div>

    <div class="sa-settings-grid">
        <div class="sa-settings-field">
            <label class="font-HellixB">Username</label>
            <input type="text" id="saAdminUsername" class="sa-settings-input font-HellixR" placeholder="Enter username">
        </div>
        <div class="sa-settings-field">
            <label class="font-HellixB">Current Password</label>
            <input type="password" id="saCurrentPassword" class="sa-settings-input font-HellixR" placeholder="Enter current password">
        </div>
        <div class="sa-settings-field">
            <label class="font-HellixB">New Password</label>
            <input type="password" id="saNewPassword" class="sa-settings-input font-HellixR" placeholder="Leave blank to keep current password">
        </div>
        <div class="sa-settings-field">
            <label class="font-HellixB">Repeat Password</label>
            <input type="password" id="saRepeatPassword" class="sa-settings-input font-HellixR" placeholder="Repeat new password">
        </div>
    </div>

    <div style="margin-top:12px;color:#6b7280;font-size:12px;" class="font-HellixR">
        Username is the same value used in the superadmin login screen.
    </div>

    <div class="sa-settings-actions">
        <button id="saSettingsSaveBtn" class="sa-settings-btn font-HellixB" onclick="saveAdminCredentials()">Save Changes</button>
    </div>
</div>

<script>
let saSettingsSession = null;

document.addEventListener('DOMContentLoaded', function() {
    verifyAdminAccess(function(session) {
        saSettingsSession = session;
        document.getElementById('saAdminUsername').value = session.adminData.branchCode || '';
    });
});

async function saveAdminCredentials() {
    if (!saSettingsSession || !saSettingsSession.adminData) {
        window.location.href = '/admin-abc/login';
        return;
    }

    var username = document.getElementById('saAdminUsername').value.trim();
    var currentPassword = document.getElementById('saCurrentPassword').value;
    var newPassword = document.getElementById('saNewPassword').value;
    var repeatPassword = document.getElementById('saRepeatPassword').value;
    var btn = document.getElementById('saSettingsSaveBtn');

    if (!username) {
        toastr.error('Username is required.');
        return;
    }

    if (!currentPassword) {
        toastr.error('Current password is required.');
        return;
    }

    if (newPassword || repeatPassword) {
        if (newPassword.length < 6) {
            toastr.error('New password must be at least 6 characters.');
            return;
        }

        if (newPassword !== repeatPassword) {
            toastr.error('New password and repeat password must match.');
            return;
        }
    }

    btn.disabled = true;
    btn.textContent = 'Saving...';

    try {
        var response = await fetch(API_URL + '/admin/update_credentials', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                admin_branch_id: saSettingsSession.adminData.branch_id,
                username: username,
                current_password: currentPassword,
                new_password: newPassword || null,
                new_password_confirmation: repeatPassword || null
            })
        });

        var result = await response.json();

        if (!response.ok || result.error) {
            toastr.error(result.message || 'Failed to update credentials.');
            btn.disabled = false;
            btn.textContent = 'Save Changes';
            return;
        }

        toastr.success(result.message || 'Credentials updated successfully.');

        setTimeout(function() {
            sessionStorage.removeItem('adminData');
            window.location.href = '/admin-abc/login';
        }, 900);
    } catch (error) {
        toastr.error('Network error. Please try again.');
        btn.disabled = false;
        btn.textContent = 'Save Changes';
    }
}
</script>
