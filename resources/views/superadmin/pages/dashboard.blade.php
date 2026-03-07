<style>
    .sa-dash-stat {
        background: #fff;
        border-radius: 14px;
        border: 1px solid #e5e7eb;
        padding: 22px 24px;
        display: flex;
        align-items: flex-start;
        gap: 16px;
        transition: box-shadow 0.2s, transform 0.2s;
    }
    .sa-dash-stat:hover {
        box-shadow: 0 4px 16px rgba(0,0,0,0.08);
        transform: translateY(-2px);
    }
    .sa-dash-icon {
        width: 44px; height: 44px;
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }
    .sa-dash-value { font-size: 28px; line-height: 1; margin-bottom: 4px; }
    .sa-dash-label { font-size: 12px; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.04em; }
    .sa-dash-card {
        background: #fff;
        border-radius: 16px;
        border: 1px solid #e5e7eb;
        overflow: hidden;
    }
    .sa-dash-card-inner { padding: 24px 28px; }
    .sa-dash-table th {
        font-size: 11px; text-transform: uppercase; letter-spacing: 0.05em;
        color: #9ca3af; padding: 10px 16px; border-bottom: 1px solid #f3f4f6;
    }
    .sa-dash-table td {
        padding: 12px 16px; font-size: 13.5px; border-bottom: 1px solid #f9fafb;
    }
    .sa-dash-table tr:hover td { background: #f9fafb; }
    .sa-dash-badge {
        display: inline-block; padding: 3px 10px; border-radius: 20px; font-size: 11px;
    }
</style>

<div id="saLoading" class="flex justify-center py-20">
    @include('admin.components.spinner', ['class' => ''])
</div>

<div id="saContent" class="hidden" style="padding: 0 12px 40px;">

    {{-- Hero --}}
    <div class="sa-dash-card" style="margin-bottom: 20px;">
        <div style="background: linear-gradient(135deg, #111 0%, #1e1b4b 50%, #312e81 100%); padding: 32px 36px; color: #fff; position: relative;">
            <div style="position: absolute; top: 0; right: 0; width: 300px; height: 100%; opacity: 0.06;">
                <svg viewBox="0 0 300 200" fill="white"><circle cx="200" cy="40" r="140"/><circle cx="250" cy="170" r="100"/></svg>
            </div>
            <div style="position: relative; z-index: 1;">
                <div style="font-size: 11px; color: rgba(255,255,255,0.4); text-transform: uppercase; letter-spacing: 0.08em; margin-bottom: 6px;" class="font-HellixR">Admin Dashboard</div>
                <h1 id="saWelcome" class="font-HellixB" style="font-size: 24px; margin: 0 0 6px;">Welcome, Admin</h1>
                <p style="color: rgba(255,255,255,0.45); font-size: 13px; margin: 0;">Manage all branches, students, and certifications from here.</p>
            </div>
        </div>
    </div>

    {{-- Stats --}}
    <div style="display: grid; grid-template-columns: repeat(5, 1fr); gap: 16px; margin-bottom: 20px;">
        <div class="sa-dash-stat">
            <div class="sa-dash-icon" style="background: #eff6ff; color: #2563eb;">
                <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <div>
                <div id="saTotalStudents" class="sa-dash-value font-HellixB">-</div>
                <div class="sa-dash-label font-HellixR">Total Students</div>
            </div>
        </div>
        <div class="sa-dash-stat">
            <div class="sa-dash-icon" style="background: #f0fdf4; color: #16a34a;">
                <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
            </div>
            <div>
                <div id="saTotalBranches" class="sa-dash-value font-HellixB" style="color: #16a34a;">-</div>
                <div class="sa-dash-label font-HellixR">Branches</div>
            </div>
        </div>
        <div class="sa-dash-stat">
            <div class="sa-dash-icon" style="background: #fef9c3; color: #ca8a04;">
                <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div>
                <div id="saPending" class="sa-dash-value font-HellixB" style="color: #ca8a04;">-</div>
                <div class="sa-dash-label font-HellixR">Pending Approval</div>
            </div>
        </div>
        <div class="sa-dash-stat">
            <div class="sa-dash-icon" style="background: #eff6ff; color: #2563eb;">
                <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
            </div>
            <div>
                <div id="saCertified" class="sa-dash-value font-HellixB" style="color: #2563eb;">-</div>
                <div class="sa-dash-label font-HellixR">Certified</div>
            </div>
        </div>
        <div class="sa-dash-stat">
            <div class="sa-dash-icon" style="background: #fef2f2; color: #dc2626;">
                <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
            </div>
            <div>
                <div id="saTotalCourses" class="sa-dash-value font-HellixB" style="color: #dc2626;">-</div>
                <div class="sa-dash-label font-HellixR">Courses</div>
            </div>
        </div>
    </div>

    {{-- Quick Actions --}}
    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 20px;">
        <a href="{{ route('superadmin.certificateApprovals') }}" style="display:flex;align-items:center;gap:12px;padding:16px 22px;background:#fff;border:1px solid #e5e7eb;border-radius:12px;text-decoration:none;color:#111;transition:all 0.15s;" onmouseover="this.style.background='#111';this.style.color='#fff';this.style.borderColor='#111'" onmouseout="this.style.background='#fff';this.style.color='#111';this.style.borderColor='#e5e7eb'">
            <div style="width:38px;height:38px;border-radius:10px;background:#fef9c3;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                <svg width="18" height="18" fill="none" stroke="#ca8a04" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div>
                <div class="font-HellixB" style="font-size:14px;">Approvals</div>
                <div class="font-HellixR" style="font-size:11px;color:#9ca3af;">Pending certificates</div>
            </div>
        </a>
        <a href="{{ route('superadmin.allStudents') }}" style="display:flex;align-items:center;gap:12px;padding:16px 22px;background:#fff;border:1px solid #e5e7eb;border-radius:12px;text-decoration:none;color:#111;transition:all 0.15s;" onmouseover="this.style.background='#111';this.style.color='#fff';this.style.borderColor='#111'" onmouseout="this.style.background='#fff';this.style.color='#111';this.style.borderColor='#e5e7eb'">
            <div style="width:38px;height:38px;border-radius:10px;background:#eff6ff;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                <svg width="18" height="18" fill="none" stroke="#2563eb" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <div>
                <div class="font-HellixB" style="font-size:14px;">All Students</div>
                <div class="font-HellixR" style="font-size:11px;color:#9ca3af;">Across all branches</div>
            </div>
        </a>
        <a href="{{ route('superadmin.branches') }}" style="display:flex;align-items:center;gap:12px;padding:16px 22px;background:#fff;border:1px solid #e5e7eb;border-radius:12px;text-decoration:none;color:#111;transition:all 0.15s;" onmouseover="this.style.background='#111';this.style.color='#fff';this.style.borderColor='#111'" onmouseout="this.style.background='#fff';this.style.color='#111';this.style.borderColor='#e5e7eb'">
            <div style="width:38px;height:38px;border-radius:10px;background:#f0fdf4;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                <svg width="18" height="18" fill="none" stroke="#16a34a" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
            </div>
            <div>
                <div class="font-HellixB" style="font-size:14px;">Branches</div>
                <div class="font-HellixR" style="font-size:11px;color:#9ca3af;">Manage branches</div>
            </div>
        </a>
        <a href="{{ route('superadmin.courses') }}" style="display:flex;align-items:center;gap:12px;padding:16px 22px;background:#fff;border:1px solid #e5e7eb;border-radius:12px;text-decoration:none;color:#111;transition:all 0.15s;" onmouseover="this.style.background='#111';this.style.color='#fff';this.style.borderColor='#111'" onmouseout="this.style.background='#fff';this.style.color='#111';this.style.borderColor='#e5e7eb'">
            <div style="width:38px;height:38px;border-radius:10px;background:#fef2f2;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                <svg width="18" height="18" fill="none" stroke="#dc2626" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
            </div>
            <div>
                <div class="font-HellixB" style="font-size:14px;">Courses</div>
                <div class="font-HellixR" style="font-size:11px;color:#9ca3af;">Manage courses</div>
            </div>
        </a>
    </div>

    {{-- Recent Students + Branch Overview --}}
    <div style="display: grid; grid-template-columns: 1.6fr 1fr; gap: 20px;">
        <div class="sa-dash-card">
            <div class="sa-dash-card-inner">
                <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:18px;">
                    <h2 class="font-HellixB" style="font-size:15px;margin:0;">Recent Students (All Branches)</h2>
                    <a href="{{ route('superadmin.allStudents') }}" class="font-HellixR" style="font-size:12px;color:#9ca3af;text-decoration:none;">View all &rarr;</a>
                </div>
                <div id="saRecentLoading" class="flex justify-center py-6">
                    @include('admin.components.spinner', ['class' => ''])
                </div>
                <div id="saRecentEmpty" class="hidden" style="text-align:center;padding:24px;color:#9ca3af;">
                    <p class="font-HellixR" style="font-size:13px;">No students yet.</p>
                </div>
                <table id="saRecentTable" class="sa-dash-table hidden" style="width:100%;">
                    <thead>
                        <tr>
                            <th class="font-HellixB" style="text-align:left;">Student</th>
                            <th class="font-HellixB" style="text-align:left;">Branch</th>
                            <th class="font-HellixB" style="text-align:left;">Course</th>
                            <th class="font-HellixB" style="text-align:left;">Status</th>
                        </tr>
                    </thead>
                    <tbody id="saRecentBody"></tbody>
                </table>
            </div>
        </div>

        <div class="sa-dash-card">
            <div class="sa-dash-card-inner">
                <h2 class="font-HellixB" style="font-size:15px;margin:0 0 18px;">Branch Overview</h2>
                <div id="saBranchLoading" class="flex justify-center py-6">
                    @include('admin.components.spinner', ['class' => ''])
                </div>
                <div id="saBranchList" class="hidden"></div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    verifyAdminAccess(function(session) {
        document.getElementById('saWelcome').textContent = 'Welcome, ' + (session.adminData.branchName || 'Admin');
        loadDashboardData(session);
    });
});

function loadDashboardData(session) {
    var adminId = session.adminData.branch_id;

    // Fetch all students
    fetch(API_URL + '/admin/get_all_students_all_branches', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ admin_branch_id: adminId })
    })
    .then(function(r) { return r.json(); })
    .then(function(result) {
        document.getElementById('saLoading').style.display = 'none';
        document.getElementById('saContent').classList.remove('hidden');

        var students = (result.error || !result.data) ? [] : result.data;

        var pending = 0, certified = 0;
        students.forEach(function(s) {
            if (s.marksheet_stage === 'pending') pending++;
            if (s.is_certificate_approve) certified++;
        });

        saAnimateNum('saTotalStudents', students.length);
        saAnimateNum('saPending', pending);
        saAnimateNum('saCertified', certified);

        renderSaRecent(students);
    })
    .catch(function() {
        document.getElementById('saLoading').style.display = 'none';
        document.getElementById('saContent').classList.remove('hidden');
    });

    // Fetch branches
    fetch(API_URL + '/admin/branch/getAll', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ admin_branch_id: adminId })
    })
    .then(function(r) { return r.json(); })
    .then(function(result) {
        var branches = (result.error || !result.data) ? [] : result.data;
        var branchOnly = branches.filter(function(b) { return b.role !== 'admin'; });
        saAnimateNum('saTotalBranches', branchOnly.length);
        renderBranchOverview(branchOnly);
    });

    // Fetch courses
    fetch(API_URL + '/admin/branch/get_all_courses')
    .then(function(r) { return r.json(); })
    .then(function(result) {
        var courses = (result.error || !result.data) ? [] : result.data;
        saAnimateNum('saTotalCourses', courses.length);
    });
}

function saAnimateNum(id, target) {
    var el = document.getElementById(id);
    if (target === 0) { el.textContent = '0'; return; }
    var start = 0, duration = 600, startTime = null;
    function step(ts) {
        if (!startTime) startTime = ts;
        var p = Math.min((ts - startTime) / duration, 1);
        el.textContent = Math.floor((1 - Math.pow(1 - p, 3)) * target);
        if (p < 1) requestAnimationFrame(step);
        else el.textContent = target;
    }
    requestAnimationFrame(step);
}

function renderSaRecent(students) {
    document.getElementById('saRecentLoading').style.display = 'none';
    if (students.length === 0) {
        document.getElementById('saRecentEmpty').classList.remove('hidden');
        return;
    }

    var recent = students.slice(0, 8);
    var tbody = document.getElementById('saRecentBody');
    tbody.innerHTML = recent.map(function(s) {
        var statusText, statusBg;
        if (s.is_certificate_approve) { statusText = 'Certified'; statusBg = 'background:#dbeafe;color:#1d4ed8;'; }
        else if (s.marksheet_stage === 'verified') { statusText = 'Verified'; statusBg = 'background:#f3e8ff;color:#7c3aed;'; }
        else if (s.marksheet_stage === 'pending') { statusText = 'Pending'; statusBg = 'background:#fef9c3;color:#a16207;'; }
        else if (s.is_student_active) { statusText = 'Active'; statusBg = 'background:#dcfce7;color:#15803d;'; }
        else { statusText = 'Inactive'; statusBg = 'background:#fee2e2;color:#dc2626;'; }

        var initial = (s.student_name || '?').charAt(0).toUpperCase();

        return '<tr>' +
            '<td><div style="display:flex;align-items:center;gap:10px;">' +
                '<div style="width:32px;height:32px;border-radius:8px;background:#f3f4f6;display:flex;align-items:center;justify-content:center;font-size:13px;color:#9ca3af;" class="font-HellixB">' + initial + '</div>' +
                '<div><div class="font-HellixB" style="font-size:13px;">' + saEsc(s.student_name || '-') + '</div>' +
                '<div class="font-HellixR" style="font-size:11px;color:#9ca3af;">' + saEsc(s.registration_number) + '</div></div>' +
            '</div></td>' +
            '<td class="font-HellixR" style="font-size:12px;">' + saEsc(s.branch_name || '-') + '</td>' +
            '<td class="font-HellixR" style="font-size:13px;">' + saEsc(s.short_form || s.course_name || '-') + '</td>' +
            '<td><span class="sa-dash-badge font-HellixB" style="' + statusBg + '">' + statusText + '</span></td>' +
        '</tr>';
    }).join('');
    document.getElementById('saRecentTable').classList.remove('hidden');
}

function renderBranchOverview(branches) {
    document.getElementById('saBranchLoading').style.display = 'none';
    var container = document.getElementById('saBranchList');

    if (branches.length === 0) {
        container.innerHTML = '<p class="font-HellixR" style="text-align:center;color:#9ca3af;font-size:13px;">No branches found.</p>';
        container.classList.remove('hidden');
        return;
    }

    container.innerHTML = branches.map(function(b) {
        var statusDot = b.active ? 'background:#16a34a;' : 'background:#dc2626;';
        return '<div style="display:flex;align-items:center;gap:12px;padding:12px 0;border-bottom:1px solid #f3f4f6;">' +
            '<div style="width:8px;height:8px;border-radius:50%;' + statusDot + 'flex-shrink:0;"></div>' +
            '<div style="flex:1;min-width:0;">' +
                '<div class="font-HellixB" style="font-size:13px;">' + saEsc(b.branch_name || '-') + '</div>' +
                '<div class="font-HellixR" style="font-size:11px;color:#9ca3af;">' + saEsc(b.branch_code || '') + ' &middot; ' + saEsc(b.city || '') + '</div>' +
            '</div>' +
            '<div class="font-HellixB" style="font-size:12px;color:#16a34a;">' + (b.credit || 0).toLocaleString() + ' cr</div>' +
        '</div>';
    }).join('');
    container.classList.remove('hidden');
}

function saEsc(text) {
    if (!text) return '';
    var d = document.createElement('div');
    d.textContent = text;
    return d.innerHTML;
}
</script>
