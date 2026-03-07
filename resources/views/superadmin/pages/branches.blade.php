<style>
    .sa-br-card {
        background: #fff; border-radius: 16px; border: 1px solid #e5e7eb; padding: 24px 28px;
    }
    .sa-br-grid {
        display: grid; grid-template-columns: repeat(auto-fill, minmax(340px, 1fr)); gap: 16px;
    }
    .sa-br-item {
        border: 1px solid #e5e7eb; border-radius: 14px; padding: 20px 22px;
        transition: box-shadow 0.2s;
    }
    .sa-br-item:hover { box-shadow: 0 4px 16px rgba(0,0,0,0.06); }
    .sa-br-btn {
        border: none; border-radius: 6px; padding: 6px 12px; font-size: 11px;
        cursor: pointer; transition: all 0.15s;
    }
    .sa-br-modal-overlay {
        position: fixed; top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(0,0,0,0.5); z-index: 9999;
        display: flex; align-items: center; justify-content: center;
    }
    .sa-br-modal {
        background: #fff; border-radius: 16px; padding: 32px;
        width: 100%; max-width: 500px; max-height: 90vh; overflow-y: auto;
        box-shadow: 0 20px 60px rgba(0,0,0,0.2);
    }
    .sa-br-input {
        width: 100%; border: 1px solid #e5e7eb; border-radius: 10px;
        padding: 10px 14px; font-size: 13px; outline: none;
    }
    .sa-br-input:focus { border-color: #111; }
    .sa-br-row { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 14px; }
</style>

<div class="sa-br-card">
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;">
        <div>
            <h1 class="font-HellixB" style="font-size:20px;margin:0 0 4px;">Branches</h1>
            <p class="font-HellixR" style="font-size:13px;color:#9ca3af;margin:0;">Manage all institute branches</p>
        </div>
        <button onclick="openAddBranch()" class="font-HellixB" style="background:#111;color:#fff;border:none;border-radius:10px;padding:10px 20px;font-size:13px;cursor:pointer;">+ Add Branch</button>
    </div>

    <div id="saBrLoading" class="flex justify-center py-10">
        @include('admin.components.spinner', ['class' => ''])
    </div>

    <div id="saBrGrid" class="sa-br-grid hidden"></div>
</div>

{{-- Add Branch Modal --}}
<div id="saAddBranchModal" class="sa-br-modal-overlay" style="display:none;">
    <div class="sa-br-modal">
        <h2 class="font-HellixB" style="font-size:18px;margin:0 0 20px;">Add New Branch</h2>
        <div class="sa-br-row">
            <div>
                <label class="font-HellixB" style="display:block;font-size:11px;color:#6b7280;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:6px;">Branch Code *</label>
                <input type="text" id="abBranchCode" class="sa-br-input font-HellixR" placeholder="e.g. BR001">
            </div>
            <div>
                <label class="font-HellixB" style="display:block;font-size:11px;color:#6b7280;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:6px;">Branch Name *</label>
                <input type="text" id="abBranchName" class="sa-br-input font-HellixR" placeholder="Branch name">
            </div>
        </div>
        <div class="sa-br-row">
            <div>
                <label class="font-HellixB" style="display:block;font-size:11px;color:#6b7280;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:6px;">First Name *</label>
                <input type="text" id="abFirstName" class="sa-br-input font-HellixR" placeholder="Manager first name">
            </div>
            <div>
                <label class="font-HellixB" style="display:block;font-size:11px;color:#6b7280;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:6px;">Last Name</label>
                <input type="text" id="abLastName" class="sa-br-input font-HellixR" placeholder="Manager last name">
            </div>
        </div>
        <div class="sa-br-row">
            <div>
                <label class="font-HellixB" style="display:block;font-size:11px;color:#6b7280;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:6px;">Phone *</label>
                <input type="text" id="abPhone" class="sa-br-input font-HellixR" placeholder="Phone number">
            </div>
            <div>
                <label class="font-HellixB" style="display:block;font-size:11px;color:#6b7280;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:6px;">Email *</label>
                <input type="email" id="abEmail" class="sa-br-input font-HellixR" placeholder="Email address">
            </div>
        </div>
        <div style="margin-bottom:14px;">
            <label class="font-HellixB" style="display:block;font-size:11px;color:#6b7280;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:6px;">Address *</label>
            <input type="text" id="abAddress" class="sa-br-input font-HellixR" placeholder="Address line 1">
        </div>
        <div class="sa-br-row">
            <div>
                <label class="font-HellixB" style="display:block;font-size:11px;color:#6b7280;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:6px;">City *</label>
                <input type="text" id="abCity" class="sa-br-input font-HellixR" placeholder="City">
            </div>
            <div>
                <label class="font-HellixB" style="display:block;font-size:11px;color:#6b7280;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:6px;">State *</label>
                <input type="text" id="abState" class="sa-br-input font-HellixR" placeholder="State">
            </div>
        </div>
        <div class="sa-br-row">
            <div>
                <label class="font-HellixB" style="display:block;font-size:11px;color:#6b7280;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:6px;">ZIP *</label>
                <input type="number" id="abZip" class="sa-br-input font-HellixR" placeholder="ZIP code">
            </div>
            <div>
                <label class="font-HellixB" style="display:block;font-size:11px;color:#6b7280;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:6px;">Initial Credit</label>
                <input type="number" id="abCredit" class="sa-br-input font-HellixR" placeholder="0" value="0">
            </div>
        </div>
        <div style="display:flex;gap:12px;justify-content:flex-end;margin-top:8px;">
            <button onclick="closeAddBranch()" class="font-HellixB" style="background:#f3f4f6;color:#111;border:none;border-radius:8px;padding:10px 20px;font-size:13px;cursor:pointer;">Cancel</button>
            <button id="abSubmitBtn" onclick="submitAddBranch()" class="font-HellixB" style="background:#111;color:#fff;border:none;border-radius:8px;padding:10px 20px;font-size:13px;cursor:pointer;">Create Branch</button>
        </div>
    </div>
</div>

{{-- Credit Modal --}}
<div id="saCreditModal" class="sa-br-modal-overlay" style="display:none;">
    <div class="sa-br-modal" style="max-width:380px;">
        <h2 class="font-HellixB" style="font-size:18px;margin:0 0 4px;">Add Credit</h2>
        <p id="saCreditBranchInfo" class="font-HellixR" style="font-size:13px;color:#6b7280;margin:0 0 20px;"></p>
        <div style="margin-bottom:14px;">
            <label class="font-HellixB" style="display:block;font-size:11px;color:#6b7280;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:6px;">Current Credit</label>
            <div id="saCreditCurrent" class="font-HellixB" style="font-size:20px;color:#16a34a;"></div>
        </div>
        <div style="margin-bottom:20px;">
            <label class="font-HellixB" style="display:block;font-size:11px;color:#6b7280;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:6px;">Amount to Add</label>
            <input type="number" id="saCreditAmount" class="sa-br-input font-HellixR" placeholder="Enter amount" min="1">
        </div>
        <div style="display:flex;gap:12px;justify-content:flex-end;">
            <button onclick="closeCreditModal()" class="font-HellixB" style="background:#f3f4f6;color:#111;border:none;border-radius:8px;padding:10px 20px;font-size:13px;cursor:pointer;">Cancel</button>
            <button id="saCreditSubmitBtn" onclick="submitCredit()" class="font-HellixB" style="background:#16a34a;color:#fff;border:none;border-radius:8px;padding:10px 20px;font-size:13px;cursor:pointer;">Add Credit</button>
        </div>
    </div>
</div>

{{-- Password Modal --}}
<div id="saPasswordModal" class="sa-br-modal-overlay" style="display:none;">
    <div class="sa-br-modal" style="max-width:380px;">
        <h2 class="font-HellixB" style="font-size:18px;margin:0 0 4px;">Reset Password</h2>
        <p id="saPasswordBranchInfo" class="font-HellixR" style="font-size:13px;color:#6b7280;margin:0 0 20px;"></p>
        <div style="margin-bottom:20px;">
            <label class="font-HellixB" style="display:block;font-size:11px;color:#6b7280;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:6px;">New Password</label>
            <input type="text" id="saNewPassword" class="sa-br-input font-HellixR" placeholder="Enter new password" minlength="6">
        </div>
        <div style="display:flex;gap:12px;justify-content:flex-end;">
            <button onclick="closePasswordModal()" class="font-HellixB" style="background:#f3f4f6;color:#111;border:none;border-radius:8px;padding:10px 20px;font-size:13px;cursor:pointer;">Cancel</button>
            <button id="saPasswordSubmitBtn" onclick="submitPassword()" class="font-HellixB" style="background:#dc2626;color:#fff;border:none;border-radius:8px;padding:10px 20px;font-size:13px;cursor:pointer;">Reset Password</button>
        </div>
    </div>
</div>

<script>
var saAllBranches = [];
var saCreditTarget = null;
var saPasswordTarget = null;

document.addEventListener('DOMContentLoaded', function() {
    verifyAdminAccess(function(session) {
        loadBranches();
    });
});

function loadBranches() {
    document.getElementById('saBrLoading').style.display = 'flex';
    document.getElementById('saBrGrid').classList.add('hidden');

    var session = getAdminData();
    if (!session) return;
    fetch(API_URL + '/admin/branch/getAll', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ admin_branch_id: session.adminData.branch_id })
    })
    .then(function(r) { return r.json(); })
    .then(function(result) {
        document.getElementById('saBrLoading').style.display = 'none';
        if (result.error || !result.data) return;

        saAllBranches = result.data.filter(function(b) { return b.role !== 'admin'; });
        renderBranches();
    })
    .catch(function() {
        document.getElementById('saBrLoading').innerHTML = '<p style="color:#dc2626;">Failed to load branches.</p>';
    });
}

function renderBranches() {
    var grid = document.getElementById('saBrGrid');
    grid.innerHTML = saAllBranches.map(function(b, i) {
        var statusColor = b.active ? '#16a34a' : '#dc2626';
        var statusText = b.active ? 'Active' : 'Inactive';
        var statusBg = b.active ? 'background:#dcfce7;color:#15803d;' : 'background:#fee2e2;color:#dc2626;';
        var toggleText = b.active ? 'Deactivate' : 'Activate';
        var toggleBg = b.active ? 'background:#fee2e2;color:#dc2626;' : 'background:#dcfce7;color:#15803d;';

        return '<div class="sa-br-item">' +
            '<div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:14px;">' +
                '<a href="/admin-abc/branch-detail?id=' + b.id + '" style="text-decoration:none;color:inherit;">' +
                    '<div class="font-HellixB" style="font-size:15px;" onmouseover="this.style.textDecoration=\'underline\'" onmouseout="this.style.textDecoration=\'none\'">' + saEsc(b.branch_name || '-') + '</div>' +
                    '<div class="font-HellixR" style="font-size:12px;color:#9ca3af;">' + saEsc(b.branch_code || '') + '</div>' +
                '</a>' +
                '<span class="font-HellixB" style="padding:3px 10px;border-radius:20px;font-size:11px;' + statusBg + '">' + statusText + '</span>' +
            '</div>' +
            '<div style="display:grid;grid-template-columns:1fr 1fr;gap:8px;font-size:12px;margin-bottom:14px;">' +
                '<div class="font-HellixR" style="color:#6b7280;"><span style="color:#9ca3af;">Manager:</span> ' + saEsc((b.first_name || '') + ' ' + (b.last_name || '')) + '</div>' +
                '<div class="font-HellixR" style="color:#6b7280;"><span style="color:#9ca3af;">City:</span> ' + saEsc(b.city || '-') + '</div>' +
                '<div class="font-HellixR" style="color:#6b7280;"><span style="color:#9ca3af;">Phone:</span> ' + saEsc(b.phone || '-') + '</div>' +
                '<div class="font-HellixR" style="color:#6b7280;"><span style="color:#9ca3af;">Credit:</span> <span class="font-HellixB" style="color:#16a34a;">' + (b.credit || 0).toLocaleString() + '</span></div>' +
            '</div>' +
            '<div style="display:flex;gap:8px;flex-wrap:wrap;">' +
                '<button class="sa-br-btn font-HellixB" style="background:#eff6ff;color:#2563eb;" onclick="openCreditModal(' + i + ')">Add Credit</button>' +
                '<button class="sa-br-btn font-HellixB" style="background:#fef9c3;color:#a16207;" onclick="openPasswordModal(' + i + ')">Reset Password</button>' +
                '<button class="sa-br-btn font-HellixB" style="' + toggleBg + '" onclick="toggleBranchStatus(' + i + ')">' + toggleText + '</button>' +
            '</div>' +
        '</div>';
    }).join('');
    grid.classList.remove('hidden');
}

// ===== Add Branch =====
function openAddBranch() { document.getElementById('saAddBranchModal').style.display = 'flex'; }
function closeAddBranch() { document.getElementById('saAddBranchModal').style.display = 'none'; }

function submitAddBranch() {
    var btn = document.getElementById('abSubmitBtn');
    var data = {
        branch_code: document.getElementById('abBranchCode').value.trim(),
        branch_name: document.getElementById('abBranchName').value.trim(),
        first_name: document.getElementById('abFirstName').value.trim(),
        last_name: document.getElementById('abLastName').value.trim(),
        phone: document.getElementById('abPhone').value.trim(),
        email_id: document.getElementById('abEmail').value.trim(),
        address_line1: document.getElementById('abAddress').value.trim(),
        city: document.getElementById('abCity').value.trim(),
        state: document.getElementById('abState').value.trim(),
        zip: parseInt(document.getElementById('abZip').value) || 0,
        credit: parseInt(document.getElementById('abCredit').value) || 0,
    };

    if (!data.branch_code || !data.branch_name || !data.first_name || !data.phone || !data.email_id || !data.address_line1 || !data.city || !data.state || !data.zip) {
        toastr.error('Please fill all required fields.');
        return;
    }

    btn.disabled = true;
    btn.textContent = 'Creating...';

    fetch(API_URL + '/admin/branch/register', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data)
    })
    .then(function(r) { return r.json(); })
    .then(function(result) {
        btn.disabled = false;
        btn.textContent = 'Create Branch';
        if (result.error) {
            toastr.error(result.message || 'Failed to create branch.');
            return;
        }
        toastr.success('Branch created successfully!');
        closeAddBranch();
        loadBranches();
    })
    .catch(function() {
        btn.disabled = false;
        btn.textContent = 'Create Branch';
        toastr.error('Network error.');
    });
}

// ===== Credit =====
function openCreditModal(i) {
    saCreditTarget = saAllBranches[i];
    document.getElementById('saCreditBranchInfo').textContent = saCreditTarget.branch_name + ' (' + saCreditTarget.branch_code + ')';
    document.getElementById('saCreditCurrent').textContent = (saCreditTarget.credit || 0).toLocaleString();
    document.getElementById('saCreditAmount').value = '';
    document.getElementById('saCreditModal').style.display = 'flex';
}
function closeCreditModal() { document.getElementById('saCreditModal').style.display = 'none'; saCreditTarget = null; }

function submitCredit() {
    if (!saCreditTarget) return;
    var amount = parseInt(document.getElementById('saCreditAmount').value);
    if (!amount || amount <= 0) { toastr.error('Enter a valid amount.'); return; }

    var btn = document.getElementById('saCreditSubmitBtn');
    btn.disabled = true;
    btn.textContent = 'Adding...';

    fetch(API_URL + '/admin/branch/add_credit', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ branch_id: saCreditTarget.id, credit_to_add: amount })
    })
    .then(function(r) { return r.json(); })
    .then(function(result) {
        btn.disabled = false;
        btn.textContent = 'Add Credit';
        if (result.error) {
            toastr.error(result.message || 'Failed to add credit.');
            return;
        }
        toastr.success('Credit added successfully!');
        closeCreditModal();
        loadBranches();
    })
    .catch(function() {
        btn.disabled = false;
        btn.textContent = 'Add Credit';
        toastr.error('Network error.');
    });
}

// ===== Password =====
function openPasswordModal(i) {
    saPasswordTarget = saAllBranches[i];
    document.getElementById('saPasswordBranchInfo').textContent = saPasswordTarget.branch_name + ' (' + saPasswordTarget.branch_code + ')';
    document.getElementById('saNewPassword').value = '';
    document.getElementById('saPasswordModal').style.display = 'flex';
}
function closePasswordModal() { document.getElementById('saPasswordModal').style.display = 'none'; saPasswordTarget = null; }

function submitPassword() {
    if (!saPasswordTarget) return;
    var session = getAdminData();
    if (!session) return;

    var password = document.getElementById('saNewPassword').value;
    if (!password || password.length < 6) { toastr.error('Password must be at least 6 characters.'); return; }

    var btn = document.getElementById('saPasswordSubmitBtn');
    btn.disabled = true;
    btn.textContent = 'Resetting...';

    fetch(API_URL + '/admin/admin/set_password', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            admin_branch_id: session.adminData.branch_id,
            target_branch_id: saPasswordTarget.id,
            new_password: password
        })
    })
    .then(function(r) { return r.json(); })
    .then(function(result) {
        btn.disabled = false;
        btn.textContent = 'Reset Password';
        if (result.error) {
            toastr.error(result.message || 'Failed to reset password.');
            return;
        }
        toastr.success('Password reset successfully!');
        closePasswordModal();
    })
    .catch(function() {
        btn.disabled = false;
        btn.textContent = 'Reset Password';
        toastr.error('Network error.');
    });
}

// ===== Toggle Status =====
function toggleBranchStatus(i) {
    var branch = saAllBranches[i];
    var newStatus = !branch.active;
    var action = newStatus ? 'activate' : 'deactivate';

    if (!confirm('Are you sure you want to ' + action + ' "' + branch.branch_name + '"?')) return;

    fetch(API_URL + '/admin/branch/update/status', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ branch_code: branch.branch_code, active: newStatus })
    })
    .then(function(r) { return r.json(); })
    .then(function(result) {
        if (result.error) {
            toastr.error(result.message || 'Failed to update status.');
            return;
        }
        toastr.success('Branch ' + action + 'd successfully!');
        loadBranches();
    })
    .catch(function() { toastr.error('Network error.'); });
}

function saEsc(text) {
    if (!text) return '';
    var d = document.createElement('div');
    d.textContent = text;
    return d.innerHTML;
}
</script>
