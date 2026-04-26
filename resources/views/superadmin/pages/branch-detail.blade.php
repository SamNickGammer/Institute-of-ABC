<style>
    .bd-card { background: #fff; border-radius: 16px; border: 1px solid #e5e7eb; }
    .bd-inner { padding: 28px 32px; }
    .bd-title { font-size: 15px; margin-bottom: 20px; padding-bottom: 14px; border-bottom: 1px solid #f3f4f6; }
    .bd-row { display: flex; justify-content: space-between; align-items: center; padding: 12px 0; border-bottom: 1px solid #f9fafb; font-size: 13.5px; }
    .bd-row:last-child { border-bottom: none; }
    .bd-row-label { color: #9ca3af; }
    .bd-row-value { text-align: right; }
    .bd-stat { background: #fff; border-radius: 14px; border: 1px solid #e5e7eb; padding: 20px 22px; display: flex; align-items: flex-start; gap: 14px; }
    .bd-stat-icon { width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
    .bd-stat-val { font-size: 24px; line-height: 1; margin-bottom: 3px; }
    .bd-stat-label { font-size: 11px; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.04em; }
    .bd-action-btn {
        display: inline-flex; align-items: center; gap: 8px; padding: 10px 18px;
        border-radius: 10px; font-size: 13px; cursor: pointer; border: none; transition: all 0.15s;
    }
    .bd-table { width: 100%; border-collapse: collapse; }
    .bd-table th { font-size: 11px; text-transform: uppercase; letter-spacing: 0.05em; color: #9ca3af; padding: 10px 14px; border-bottom: 1px solid #f3f4f6; text-align: left; }
    .bd-table td { padding: 12px 14px; font-size: 13px; border-bottom: 1px solid #f9fafb; }
    .bd-table tr:hover td { background: #f9fafb; }
    .bd-badge { display: inline-block; padding: 3px 10px; border-radius: 20px; font-size: 11px; }
    .bd-modal-overlay { position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5); z-index: 9999; display: flex; align-items: center; justify-content: center; }
    .bd-modal { background: #fff; border-radius: 16px; padding: 32px; width: 100%; max-width: 400px; box-shadow: 0 20px 60px rgba(0,0,0,0.2); }
    .bd-modal-input { width: 100%; border: 1px solid #e5e7eb; border-radius: 10px; padding: 10px 14px; font-size: 13px; outline: none; box-sizing: border-box; }
    .bd-modal-input:focus { border-color: #111; }
</style>

<div>
    <div id="bdLoading" class="flex justify-center py-20">
        @include('admin.components.spinner', ['class' => ''])
    </div>

    <div id="bdNotFound" class="hidden" style="text-align:center;padding:80px 20px;color:#9ca3af;">
        <p class="font-HellixB" style="font-size:18px;color:#6b7280;">Branch not found</p>
        <a href="{{ route('superadmin.branches') }}" class="font-HellixR" style="font-size:13px;color:#111;text-decoration:underline;">Back to Branches</a>
    </div>

    <div id="bdContent" class="hidden" style="padding:0 12px 40px;">

        {{-- Hero Card --}}
        <div class="bd-card" style="margin-bottom:20px;">
            <div style="background:linear-gradient(135deg,#111 0%,#1f2937 100%);padding:32px 36px;color:#fff;position:relative;border-radius:16px 16px 0 0;">
                <div style="position:absolute;top:0;right:0;width:200px;height:100%;opacity:0.05;">
                    <svg viewBox="0 0 200 200" fill="white"><circle cx="150" cy="50" r="120"/></svg>
                </div>
                <div style="display:flex;justify-content:space-between;align-items:flex-start;position:relative;z-index:1;">
                    <div style="display:flex;gap:20px;align-items:center;">
                        <div style="width:72px;height:72px;border-radius:16px;overflow:hidden;border:2px solid rgba(255,255,255,0.2);flex-shrink:0;background:rgba(255,255,255,0.1);">
                            <img id="bdImage" src="" alt="" style="width:100%;height:100%;object-fit:cover;display:none;">
                            <div id="bdImagePlaceholder" style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;font-size:28px;color:rgba(255,255,255,0.5);" class="font-HellixB"></div>
                        </div>
                        <div>
                            <div style="display:flex;align-items:center;gap:10px;margin-bottom:4px;">
                                <h1 id="bdName" class="font-HellixB" style="font-size:22px;margin:0;"></h1>
                                <span id="bdStatusBadge" class="font-HellixB" style="font-size:10px;padding:4px 12px;border-radius:20px;"></span>
                            </div>
                            <div id="bdCode" class="font-HellixR" style="font-size:13px;color:rgba(255,255,255,0.5);margin-bottom:2px;"></div>
                            <div id="bdManager" class="font-HellixR" style="font-size:12px;color:rgba(255,255,255,0.4);"></div>
                        </div>
                    </div>
                    <a href="{{ route('superadmin.branches') }}" class="font-HellixR" style="font-size:12px;color:rgba(255,255,255,0.4);text-decoration:none;display:flex;align-items:center;gap:4px;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='rgba(255,255,255,0.4)'">
                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                        All Branches
                    </a>
                </div>
            </div>
            <div style="padding:20px 36px;display:flex;gap:28px;flex-wrap:wrap;">
                <div class="font-HellixR" style="font-size:12px;color:#6b7280;">
                    <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display:inline;vertical-align:-2px;margin-right:4px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    <span id="bdEmail"></span>
                </div>
                <div class="font-HellixR" style="font-size:12px;color:#6b7280;">
                    <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display:inline;vertical-align:-2px;margin-right:4px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    <span id="bdPhone"></span>
                </div>
                <div class="font-HellixR" style="font-size:12px;color:#6b7280;">
                    <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display:inline;vertical-align:-2px;margin-right:4px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    <span id="bdAddress"></span>
                </div>
            </div>
        </div>

        {{-- Stats --}}
        <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-bottom:20px;">
            <div class="bd-stat">
                <div class="bd-stat-icon" style="background:#eff6ff;color:#2563eb;">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
                <div><div id="bdStatStudents" class="bd-stat-val font-HellixB">-</div><div class="bd-stat-label font-HellixR">Students</div></div>
            </div>
            <div class="bd-stat">
                <div class="bd-stat-icon" style="background:#f0fdf4;color:#16a34a;">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div><div id="bdStatCertified" class="bd-stat-val font-HellixB" style="color:#16a34a;">-</div><div class="bd-stat-label font-HellixR">Certified</div></div>
            </div>
            <div class="bd-stat">
                <div class="bd-stat-icon" style="background:#fef9c3;color:#ca8a04;">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div><div id="bdStatPending" class="bd-stat-val font-HellixB" style="color:#ca8a04;">-</div><div class="bd-stat-label font-HellixR">Pending</div></div>
            </div>
            <div class="bd-stat">
                <div class="bd-stat-icon" style="background:#f0fdf4;color:#16a34a;">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                </div>
                <div><div id="bdStatCredit" class="bd-stat-val font-HellixB" style="color:#16a34a;">-</div><div class="bd-stat-label font-HellixR">Credits</div></div>
            </div>
        </div>

        {{-- Actions --}}
        <div class="bd-card" style="margin-bottom:20px;">
            <div class="bd-inner">
                <h2 class="bd-title font-HellixB">Quick Actions</h2>
                <div style="display:flex;gap:10px;flex-wrap:wrap;">
                    <button onclick="bdOpenCredit()" class="bd-action-btn font-HellixB" style="background:#eff6ff;color:#2563eb;">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                        Add Credit
                    </button>
                    <button onclick="bdOpenPassword()" class="bd-action-btn font-HellixB" style="background:#fef9c3;color:#a16207;">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
                        Reset Password
                    </button>
                    <button id="bdToggleBtn" onclick="bdToggleStatus()" class="bd-action-btn font-HellixB" style="background:#fee2e2;color:#dc2626;">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/></svg>
                        <span id="bdToggleText">Deactivate</span>
                    </button>
                </div>
            </div>
        </div>

        {{-- Two columns: Details + Per Certificate --}}
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-bottom:20px;">
            <div class="bd-card">
                <div class="bd-inner">
                    <h2 class="bd-title font-HellixB">Branch Details</h2>
                    <div class="bd-row"><span class="bd-row-label font-HellixR">Branch Code</span><span id="bdDetCode" class="bd-row-value font-HellixB"></span></div>
                    <div class="bd-row"><span class="bd-row-label font-HellixR">Branch Name</span><span id="bdDetName" class="bd-row-value font-HellixB"></span></div>
                    <div class="bd-row"><span class="bd-row-label font-HellixR">Manager</span><span id="bdDetManager" class="bd-row-value font-HellixB"></span></div>
                    <div class="bd-row"><span class="bd-row-label font-HellixR">Phone</span><span id="bdDetPhone" class="bd-row-value font-HellixB"></span></div>
                    <div class="bd-row"><span class="bd-row-label font-HellixR">Email</span><span id="bdDetEmail" class="bd-row-value font-HellixB"></span></div>
                    <div class="bd-row"><span class="bd-row-label font-HellixR">Address</span><span id="bdDetAddress" class="bd-row-value font-HellixB" style="max-width:200px;text-align:right;"></span></div>
                    <div class="bd-row"><span class="bd-row-label font-HellixR">City / State / ZIP</span><span id="bdDetCityState" class="bd-row-value font-HellixB"></span></div>
                </div>
            </div>
            <div class="bd-card">
                <div class="bd-inner">
                    <h2 class="bd-title font-HellixB">Credit & Billing</h2>
                    <div class="bd-row"><span class="bd-row-label font-HellixR">Current Credit</span><span id="bdDetCredit" class="bd-row-value font-HellixB" style="font-size:18px;color:#16a34a;"></span></div>
                    <div class="bd-row"><span class="bd-row-label font-HellixR">Per Certificate Cost</span><span id="bdDetPerCert" class="bd-row-value font-HellixB"></span></div>
                    <div class="bd-row"><span class="bd-row-label font-HellixR">Status</span><span id="bdDetStatus" class="bd-row-value font-HellixB"></span></div>
                    <div class="bd-row"><span class="bd-row-label font-HellixR">Created</span><span id="bdDetCreated" class="bd-row-value font-HellixB"></span></div>
                </div>
            </div>
        </div>

        {{-- Students Table --}}
        <div class="bd-card">
            <div class="bd-inner">
                <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:18px;">
                    <h2 class="font-HellixB" style="font-size:15px;margin:0;">Students (<span id="bdStudentCount">0</span>)</h2>
                    <input type="text" id="bdStudentSearch" class="bd-modal-input font-HellixR" placeholder="Search students..." style="width:240px;">
                </div>
                <div id="bdStudentsLoading" class="flex justify-center py-6">
                    @include('admin.components.spinner', ['class' => ''])
                </div>
                <div id="bdStudentsEmpty" class="hidden" style="text-align:center;padding:24px;color:#9ca3af;">
                    <p class="font-HellixR" style="font-size:13px;">No students in this branch.</p>
                </div>
                <div id="bdStudentsTableWrapper" class="hidden" style="overflow-x:auto;">
                    <table class="bd-table">
                        <thead>
                            <tr>
                                <th class="font-HellixB">Reg No</th>
                                <th class="font-HellixB">Name</th>
                                <th class="font-HellixB">Course</th>
                                <th class="font-HellixB">Phone</th>
                                <th class="font-HellixB">Admission</th>
                                <th class="font-HellixB">Status</th>
                            </tr>
                        </thead>
                        <tbody id="bdStudentsBody"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Credit Modal --}}
<div id="bdCreditModal" class="bd-modal-overlay" style="display:none;">
    <div class="bd-modal">
        <h2 class="font-HellixB" style="font-size:18px;margin:0 0 4px;">Add Credit</h2>
        <p id="bdCreditInfo" class="font-HellixR" style="font-size:13px;color:#6b7280;margin:0 0 8px;"></p>
        <div style="margin-bottom:14px;">
            <div class="font-HellixR" style="font-size:11px;color:#9ca3af;text-transform:uppercase;margin-bottom:4px;">Current Credit</div>
            <div id="bdCreditCurrent" class="font-HellixB" style="font-size:20px;color:#16a34a;"></div>
        </div>
        <div style="margin-bottom:20px;">
            <label class="font-HellixB" style="display:block;font-size:11px;color:#6b7280;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:6px;">Amount to Add</label>
            <input type="number" id="bdCreditAmount" class="bd-modal-input font-HellixR" placeholder="Enter amount" min="1">
        </div>
        <div style="display:flex;gap:12px;justify-content:flex-end;">
            <button onclick="bdCloseCredit()" class="font-HellixB" style="background:#f3f4f6;color:#111;border:none;border-radius:8px;padding:10px 20px;font-size:13px;cursor:pointer;">Cancel</button>
            <button id="bdCreditSubmitBtn" onclick="bdSubmitCredit()" class="font-HellixB" style="background:#16a34a;color:#fff;border:none;border-radius:8px;padding:10px 20px;font-size:13px;cursor:pointer;">Add Credit</button>
        </div>
    </div>
</div>

{{-- Password Modal --}}
<div id="bdPasswordModal" class="bd-modal-overlay" style="display:none;">
    <div class="bd-modal">
        <h2 class="font-HellixB" style="font-size:18px;margin:0 0 4px;">Reset Password</h2>
        <p id="bdPasswordInfo" class="font-HellixR" style="font-size:13px;color:#6b7280;margin:0 0 20px;"></p>
        <div style="margin-bottom:20px;">
            <label class="font-HellixB" style="display:block;font-size:11px;color:#6b7280;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:6px;">New Password</label>
            <input type="text" id="bdNewPassword" class="bd-modal-input font-HellixR" placeholder="Min 6 characters" minlength="6">
        </div>
        <div style="display:flex;gap:12px;justify-content:flex-end;">
            <button onclick="bdClosePassword()" class="font-HellixB" style="background:#f3f4f6;color:#111;border:none;border-radius:8px;padding:10px 20px;font-size:13px;cursor:pointer;">Cancel</button>
            <button id="bdPasswordSubmitBtn" onclick="bdSubmitPassword()" class="font-HellixB" style="background:#dc2626;color:#fff;border:none;border-radius:8px;padding:10px 20px;font-size:13px;cursor:pointer;">Reset Password</button>
        </div>
    </div>
</div>

<script>
var bdBranch = null;
var bdAllStudents = [];

document.addEventListener('DOMContentLoaded', function() {
    verifyAdminAccess(function(session) {
        var params = new URLSearchParams(window.location.search);
        var branchId = params.get('id');
        if (!branchId) {
            document.getElementById('bdLoading').style.display = 'none';
            document.getElementById('bdNotFound').classList.remove('hidden');
            return;
        }
        loadBranchDetail(session, branchId);
    });

    document.getElementById('bdStudentSearch').addEventListener('input', bdFilterStudents);
});

function loadBranchDetail(session, branchId) {
    // Fetch branch data
    fetch(API_URL + '/admin/branch/getAll', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ admin_branch_id: session.adminData.branch_id })
    })
    .then(function(r) { return r.json(); })
    .then(function(result) {
        if (result.error || !result.data) {
            document.getElementById('bdLoading').style.display = 'none';
            document.getElementById('bdNotFound').classList.remove('hidden');
            return;
        }
        bdBranch = result.data.find(function(b) { return b.id == branchId; });
        if (!bdBranch) {
            document.getElementById('bdLoading').style.display = 'none';
            document.getElementById('bdNotFound').classList.remove('hidden');
            return;
        }
        populateBranchDetail();
        loadBranchStudents(session, branchId);
    })
    .catch(function() {
        document.getElementById('bdLoading').innerHTML = '<p style="color:#dc2626;">Failed to load branch.</p>';
    });
}

function populateBranchDetail() {
    var b = bdBranch;

    // Hero
    if (b.image) {
        document.getElementById('bdImage').src = b.image;
        document.getElementById('bdImage').style.display = 'block';
        document.getElementById('bdImagePlaceholder').style.display = 'none';
    } else {
        document.getElementById('bdImagePlaceholder').textContent = (b.branch_name || '?').charAt(0).toUpperCase();
    }

    document.getElementById('bdName').textContent = b.branch_name || '-';
    document.getElementById('bdCode').textContent = b.branch_code || '';
    document.getElementById('bdManager').textContent = 'Manager: ' + ((b.first_name || '') + ' ' + (b.last_name || '')).trim();

    var badge = document.getElementById('bdStatusBadge');
    if (b.active) { badge.style.background = 'rgba(34,197,94,0.2)'; badge.style.color = '#22c55e'; badge.textContent = 'Active'; }
    else { badge.style.background = 'rgba(239,68,68,0.2)'; badge.style.color = '#ef4444'; badge.textContent = 'Inactive'; }

    document.getElementById('bdEmail').textContent = b.email_id || '-';
    document.getElementById('bdPhone').textContent = b.phone || '-';
    var addr = [b.address_line1, b.city, b.state].filter(Boolean).join(', ');
    document.getElementById('bdAddress').textContent = addr || '-';

    // Stats
    document.getElementById('bdStatCredit').textContent = (b.credit || 0).toLocaleString();

    // Toggle button
    var toggleBtn = document.getElementById('bdToggleBtn');
    var toggleText = document.getElementById('bdToggleText');
    if (b.active) {
        toggleText.textContent = 'Deactivate';
        toggleBtn.style.background = '#fee2e2';
        toggleBtn.style.color = '#dc2626';
    } else {
        toggleText.textContent = 'Activate';
        toggleBtn.style.background = '#dcfce7';
        toggleBtn.style.color = '#15803d';
    }

    // Details
    document.getElementById('bdDetCode').textContent = b.branch_code || '-';
    document.getElementById('bdDetName').textContent = b.branch_name || '-';
    document.getElementById('bdDetManager').textContent = ((b.first_name || '') + ' ' + (b.last_name || '')).trim() || '-';
    document.getElementById('bdDetPhone').textContent = b.phone || '-';
    document.getElementById('bdDetEmail').textContent = b.email_id || '-';
    document.getElementById('bdDetAddress').textContent = b.address_line1 || '-';
    document.getElementById('bdDetCityState').textContent = [b.city, b.state, b.zip].filter(Boolean).join(', ') || '-';
    document.getElementById('bdDetCredit').textContent = (b.credit || 0).toLocaleString();
    document.getElementById('bdDetPerCert').textContent = (b.credit_per_certificate || 200) + ' credits';
    document.getElementById('bdDetStatus').textContent = b.active ? 'Active' : 'Inactive';
    document.getElementById('bdDetCreated').textContent = b.created_at ? b.created_at.split('T')[0] : '-';
}

function loadBranchStudents(session, branchId) {
    fetch(API_URL + '/admin/get_all_students_all_branches', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            admin_branch_id: session.adminData.branch_id,
            filter_branch_id: parseInt(branchId, 10),
            per_page: 5000
        })
    })
    .then(function(r) { return r.json(); })
    .then(function(result) {
        document.getElementById('bdLoading').style.display = 'none';
        document.getElementById('bdContent').classList.remove('hidden');
        document.getElementById('bdStudentsLoading').style.display = 'none';

        if (result.error || !result.data || result.data.length === 0) {
            document.getElementById('bdStudentsEmpty').classList.remove('hidden');
            document.getElementById('bdStatStudents').textContent = '0';
            document.getElementById('bdStatCertified').textContent = '0';
            document.getElementById('bdStatPending').textContent = '0';
            return;
        }

        bdAllStudents = result.data;
        var certified = 0, pending = 0;
        bdAllStudents.forEach(function(s) {
            if (s.is_certificate_approve) certified++;
            if (s.marksheet_stage === 'pending') pending++;
        });
        document.getElementById('bdStatStudents').textContent = bdAllStudents.length;
        document.getElementById('bdStatCertified').textContent = certified;
        document.getElementById('bdStatPending').textContent = pending;
        document.getElementById('bdStudentCount').textContent = bdAllStudents.length;

        bdRenderStudents(bdAllStudents);
    })
    .catch(function() {
        document.getElementById('bdStudentsLoading').innerHTML = '<p style="color:#dc2626;">Failed to load students.</p>';
        document.getElementById('bdLoading').style.display = 'none';
        document.getElementById('bdContent').classList.remove('hidden');
    });
}

function bdFilterStudents() {
    var q = document.getElementById('bdStudentSearch').value.toLowerCase();
    var filtered = bdAllStudents.filter(function(s) {
        if (!q) return true;
        return (s.student_name || '').toLowerCase().indexOf(q) !== -1 ||
            (s.registration_number || '').toLowerCase().indexOf(q) !== -1 ||
            (s.student_phone || '').toLowerCase().indexOf(q) !== -1;
    });
    document.getElementById('bdStudentCount').textContent = filtered.length;
    bdRenderStudents(filtered);
}

function bdRenderStudents(students) {
    if (students.length === 0) {
        document.getElementById('bdStudentsTableWrapper').classList.add('hidden');
        document.getElementById('bdStudentsEmpty').classList.remove('hidden');
        return;
    }
    document.getElementById('bdStudentsEmpty').classList.add('hidden');
    document.getElementById('bdStudentsTableWrapper').classList.remove('hidden');

    var tbody = document.getElementById('bdStudentsBody');
    tbody.innerHTML = students.map(function(s) {
        var st, stStyle;
        if (s.is_certificate_approve) { st='Certified'; stStyle='background:#dbeafe;color:#1d4ed8;'; }
        else if (s.marksheet_stage==='verified') { st='Verified'; stStyle='background:#f3e8ff;color:#7c3aed;'; }
        else if (s.marksheet_stage==='pending') { st='Pending'; stStyle='background:#fef9c3;color:#a16207;'; }
        else if (s.is_student_active) { st='Active'; stStyle='background:#dcfce7;color:#15803d;'; }
        else { st='Inactive'; stStyle='background:#fee2e2;color:#dc2626;'; }

        return '<tr>' +
            '<td class="font-HellixB"><a href="/admin-abc/student?id=' + s.student_id + '" style="color:#111;text-decoration:none;" onmouseover="this.style.textDecoration=\'underline\'" onmouseout="this.style.textDecoration=\'none\'">' + bdEsc(s.registration_number) + '</a></td>' +
            '<td class="font-HellixR"><a href="/admin-abc/student?id=' + s.student_id + '" style="color:#111;text-decoration:none;" onmouseover="this.style.textDecoration=\'underline\'" onmouseout="this.style.textDecoration=\'none\'">' + bdEsc(s.student_name || '-') + '</a></td>' +
            '<td class="font-HellixR">' + bdEsc(s.short_form || s.course_name || '-') + '</td>' +
            '<td class="font-HellixR">' + bdEsc(s.student_phone || '-') + '</td>' +
            '<td class="font-HellixR" style="font-size:12px;color:#6b7280;">' + bdEsc(s.admission_date || '-') + '</td>' +
            '<td><span class="bd-badge font-HellixB" style="' + stStyle + '">' + st + '</span></td>' +
        '</tr>';
    }).join('');
}

// ===== Credit =====
function bdOpenCredit() {
    if (!bdBranch) return;
    document.getElementById('bdCreditInfo').textContent = bdBranch.branch_name + ' (' + bdBranch.branch_code + ')';
    document.getElementById('bdCreditCurrent').textContent = (bdBranch.credit || 0).toLocaleString();
    document.getElementById('bdCreditAmount').value = '';
    document.getElementById('bdCreditModal').style.display = 'flex';
}
function bdCloseCredit() { document.getElementById('bdCreditModal').style.display = 'none'; }

function bdSubmitCredit() {
    var amount = parseInt(document.getElementById('bdCreditAmount').value);
    if (!amount || amount <= 0) { toastr.error('Enter a valid amount.'); return; }
    var btn = document.getElementById('bdCreditSubmitBtn');
    btn.disabled = true; btn.textContent = 'Adding...';

    fetch(API_URL + '/admin/branch/add_credit', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ branch_id: bdBranch.id, credit_to_add: amount })
    })
    .then(function(r) { return r.json(); })
    .then(function(result) {
        btn.disabled = false; btn.textContent = 'Add Credit';
        if (result.error) { toastr.error(result.message || 'Failed.'); return; }
        toastr.success('Credit added!');
        bdBranch.credit = (bdBranch.credit || 0) + amount;
        document.getElementById('bdStatCredit').textContent = bdBranch.credit.toLocaleString();
        document.getElementById('bdDetCredit').textContent = bdBranch.credit.toLocaleString();
        bdCloseCredit();
    })
    .catch(function() { btn.disabled = false; btn.textContent = 'Add Credit'; toastr.error('Network error.'); });
}

// ===== Password =====
function bdOpenPassword() {
    if (!bdBranch) return;
    document.getElementById('bdPasswordInfo').textContent = bdBranch.branch_name + ' (' + bdBranch.branch_code + ')';
    document.getElementById('bdNewPassword').value = '';
    document.getElementById('bdPasswordModal').style.display = 'flex';
}
function bdClosePassword() { document.getElementById('bdPasswordModal').style.display = 'none'; }

function bdSubmitPassword() {
    var session = getAdminData();
    if (!session || !bdBranch) return;
    var pw = document.getElementById('bdNewPassword').value;
    if (!pw || pw.length < 6) { toastr.error('Password must be at least 6 characters.'); return; }
    var btn = document.getElementById('bdPasswordSubmitBtn');
    btn.disabled = true; btn.textContent = 'Resetting...';

    fetch(API_URL + '/admin/admin/set_password', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ admin_branch_id: session.adminData.branch_id, target_branch_id: bdBranch.id, new_password: pw })
    })
    .then(function(r) { return r.json(); })
    .then(function(result) {
        btn.disabled = false; btn.textContent = 'Reset Password';
        if (result.error) { toastr.error(result.message || 'Failed.'); return; }
        toastr.success('Password reset!');
        bdClosePassword();
    })
    .catch(function() { btn.disabled = false; btn.textContent = 'Reset Password'; toastr.error('Network error.'); });
}

// ===== Toggle =====
function bdToggleStatus() {
    if (!bdBranch) return;
    var newStatus = !bdBranch.active;
    var action = newStatus ? 'activate' : 'deactivate';
    if (!confirm('Are you sure you want to ' + action + ' this branch?')) return;

    fetch(API_URL + '/admin/branch/update/status', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ branch_code: bdBranch.branch_code, active: newStatus })
    })
    .then(function(r) { return r.json(); })
    .then(function(result) {
        if (result.error) { toastr.error(result.message || 'Failed.'); return; }
        toastr.success('Branch ' + action + 'd!');
        bdBranch.active = newStatus;
        populateBranchDetail();
    })
    .catch(function() { toastr.error('Network error.'); });
}

function bdEsc(text) {
    if (!text) return '';
    var d = document.createElement('div');
    d.textContent = text;
    return d.innerHTML;
}
</script>
