<style>
    .dash-card {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 1px 3px rgba(0,0,0,0.04);
    }
    .dash-card-inner {
        padding: 28px 32px;
    }
    .dash-stat {
        background: #ffffff;
        border-radius: 14px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 1px 3px rgba(0,0,0,0.04);
        padding: 22px 24px;
        display: flex;
        align-items: flex-start;
        gap: 16px;
        transition: box-shadow 0.2s, transform 0.2s;
        cursor: default;
    }
    .dash-stat:hover {
        box-shadow: 0 4px 16px rgba(0,0,0,0.08);
        transform: translateY(-2px);
    }
    .dash-stat-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .dash-stat-value {
        font-size: 28px;
        line-height: 1;
        margin-bottom: 4px;
    }
    .dash-stat-label {
        font-size: 12px;
        color: #9ca3af;
        text-transform: uppercase;
        letter-spacing: 0.04em;
    }
    .dash-quick-btn {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 16px 22px;
        background: #f9fafb;
        border: 1px solid #f3f4f6;
        border-radius: 12px;
        text-decoration: none;
        color: #111;
        transition: all 0.15s;
    }
    .dash-quick-btn:hover {
        background: #111;
        color: #fff;
        border-color: #111;
    }
    .dash-quick-btn:hover .qb-icon {
        background: rgba(255,255,255,0.15);
        color: #fff;
    }
    .qb-icon {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        background: #e5e7eb;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        transition: all 0.15s;
    }
    .dash-progress-bar {
        width: 100%;
        height: 8px;
        background: #f3f4f6;
        border-radius: 4px;
        overflow: hidden;
    }
    .dash-progress-fill {
        height: 100%;
        border-radius: 4px;
        transition: width 0.8s ease;
    }
    .dash-table th {
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #9ca3af;
        padding: 10px 16px;
        border-bottom: 1px solid #f3f4f6;
    }
    .dash-table td {
        padding: 12px 16px;
        font-size: 13.5px;
        border-bottom: 1px solid #f9fafb;
    }
    .dash-table tr:last-child td { border-bottom: none; }
    .dash-table tr:hover td { background: #f9fafb; }
    .dash-badge {
        display: inline-block;
        padding: 3px 10px;
        border-radius: 20px;
        font-size: 11px;
    }
    .dash-course-row {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px 0;
        border-bottom: 1px solid #f9fafb;
    }
    .dash-course-row:last-child { border-bottom: none; }
    .dash-timer {
        font-variant-numeric: tabular-nums;
    }
</style>

<div id="dashLoading" class="flex justify-center py-20">
    @include('admin.components.spinner', ['class' => ''])
</div>

<div id="dashContent" class="hidden" style="padding: 0 12px 40px;">

    {{-- ===== WELCOME HERO ===== --}}
    <div class="dash-card" style="margin-bottom: 20px; overflow: hidden;">
        <div style="background: linear-gradient(135deg, #111 0%, #1f2937 100%); padding: 32px 36px; color: #fff; position: relative;">
            <div style="position: absolute; top: 0; right: 0; width: 200px; height: 100%; opacity: 0.05;">
                <svg viewBox="0 0 200 200" fill="white"><circle cx="150" cy="50" r="120"/><circle cx="180" cy="150" r="80"/></svg>
            </div>
            <div style="display: flex; justify-content: space-between; align-items: flex-start; position: relative; z-index: 1;">
                <div style="display: flex; gap: 20px; align-items: center;">
                    <div style="width: 64px; height: 64px; border-radius: 16px; overflow: hidden; border: 2px solid rgba(255,255,255,0.2); flex-shrink: 0; background: rgba(255,255,255,0.1);">
                        <img id="branchImage" src="" alt="" style="width: 100%; height: 100%; object-fit: cover; display: none;">
                        <div id="branchImagePlaceholder" style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; font-size: 24px; color: rgba(255,255,255,0.5);" class="font-HellixB"></div>
                    </div>
                    <div>
                        <div style="font-size: 11px; color: rgba(255,255,255,0.5); text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 4px;" class="font-HellixR">Welcome back</div>
                        <h1 id="branchName" class="font-HellixB" style="font-size: 22px; margin: 0 0 4px;"></h1>
                        <div style="display: flex; gap: 8px; align-items: center; flex-wrap: wrap;">
                            <span id="branchRoleBadge" class="font-HellixB" style="font-size: 10px; padding: 3px 12px; border-radius: 20px; background: rgba(255,255,255,0.15);"></span>
                            <span id="branchCode" class="font-HellixR" style="font-size: 12px; color: rgba(255,255,255,0.5);"></span>
                        </div>
                    </div>
                </div>
                <div style="text-align: right;">
                    <div style="display: flex; gap: 16px; align-items: flex-start;">
                        {{-- Session Timer --}}
                        <div style="background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.1); border-radius: 12px; padding: 12px 18px; min-width: 130px;">
                            <div style="font-size: 10px; color: rgba(255,255,255,0.4); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 4px;" class="font-HellixR">Session</div>
                            <div id="countdown" class="font-HellixB dash-timer" style="font-size: 18px; color: #fbbf24;"></div>
                        </div>
                        {{-- Credit --}}
                        <div style="background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.1); border-radius: 12px; padding: 12px 18px; min-width: 130px;">
                            <div style="font-size: 10px; color: rgba(255,255,255,0.4); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 4px;" class="font-HellixR">Credits</div>
                            <div id="creditDisplay" class="font-HellixB" style="font-size: 18px; color: #34d399;">
                                <span id="creditSpinner" style="display: inline-block;">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" style="animation: spin 1s linear infinite;"><circle cx="12" cy="12" r="10" stroke="rgba(255,255,255,0.2)" stroke-width="3"/><path d="M12 2a10 10 0 019.95 9" stroke="#34d399" stroke-width="3" stroke-linecap="round"/></svg>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Branch info pills --}}
            <div style="display: flex; gap: 24px; margin-top: 24px; flex-wrap: wrap; position: relative; z-index: 1;">
                <div style="font-size: 12px; color: rgba(255,255,255,0.4);" class="font-HellixR">
                    <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: inline; vertical-align: -2px; margin-right: 4px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    <span id="branchEmail" style="color: rgba(255,255,255,0.7);"></span>
                </div>
                <div style="font-size: 12px; color: rgba(255,255,255,0.4);" class="font-HellixR">
                    <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: inline; vertical-align: -2px; margin-right: 4px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    <span id="branchLocation" style="color: rgba(255,255,255,0.7);"></span>
                </div>
                <div style="font-size: 12px; color: rgba(255,255,255,0.4);" class="font-HellixR">
                    <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: inline; vertical-align: -2px; margin-right: 4px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span id="perCertCost" style="color: rgba(255,255,255,0.7);"></span>
                </div>
            </div>
        </div>
    </div>

    {{-- ===== STAT CARDS ===== --}}
    <div style="display: grid; grid-template-columns: repeat(5, 1fr); gap: 16px; margin-bottom: 20px;">
        <div class="dash-stat">
            <div class="dash-stat-icon" style="background: #eff6ff; color: #2563eb;">
                <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <div>
                <div id="statTotal" class="dash-stat-value font-HellixB">-</div>
                <div class="dash-stat-label font-HellixR">Total Students</div>
            </div>
        </div>
        <div class="dash-stat">
            <div class="dash-stat-icon" style="background: #f0fdf4; color: #16a34a;">
                <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div>
                <div id="statActive" class="dash-stat-value font-HellixB" style="color: #16a34a;">-</div>
                <div class="dash-stat-label font-HellixR">Active</div>
            </div>
        </div>
        <div class="dash-stat">
            <div class="dash-stat-icon" style="background: #eff6ff; color: #2563eb;">
                <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
            </div>
            <div>
                <div id="statCertified" class="dash-stat-value font-HellixB" style="color: #2563eb;">-</div>
                <div class="dash-stat-label font-HellixR">Certified</div>
            </div>
        </div>
        <div class="dash-stat">
            <div class="dash-stat-icon" style="background: #fef9c3; color: #ca8a04;">
                <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div>
                <div id="statPending" class="dash-stat-value font-HellixB" style="color: #ca8a04;">-</div>
                <div class="dash-stat-label font-HellixR">Pending</div>
            </div>
        </div>
        <div class="dash-stat">
            <div class="dash-stat-icon" style="background: #fef2f2; color: #dc2626;">
                <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            </div>
            <div>
                <div id="statNoMarks" class="dash-stat-value font-HellixB" style="color: #dc2626;">-</div>
                <div class="dash-stat-label font-HellixR">Need Marks</div>
            </div>
        </div>
    </div>

    {{-- ===== QUICK ACTIONS ===== --}}
    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 20px;">
        <a href="{{ route('branch.allStudents') }}" class="dash-quick-btn">
            <div class="qb-icon">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
            </div>
            <div>
                <div class="font-HellixB" style="font-size: 14px;">All Students</div>
                <div class="font-HellixR" style="font-size: 11px; color: #9ca3af;">View & manage</div>
            </div>
        </a>
        <a href="{{ route('branch.addStudent') }}" class="dash-quick-btn">
            <div class="qb-icon">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
            </div>
            <div>
                <div class="font-HellixB" style="font-size: 14px;">Add Student</div>
                <div class="font-HellixR" style="font-size: 11px; color: #9ca3af;">New enrollment</div>
            </div>
        </a>
        <a href="{{ route('branch.marksheetManagement') }}" class="dash-quick-btn">
            <div class="qb-icon">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            </div>
            <div>
                <div class="font-HellixB" style="font-size: 14px;">Marksheet Mgmt</div>
                <div class="font-HellixR" style="font-size: 11px; color: #9ca3af;">Add / edit marks</div>
            </div>
        </a>
        <a href="{{ route('branch.recentApproved') }}" class="dash-quick-btn">
            <div class="qb-icon">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
            </div>
            <div>
                <div class="font-HellixB" style="font-size: 14px;">Recent Approved</div>
                <div class="font-HellixR" style="font-size: 11px; color: #9ca3af;">Last 7 days</div>
            </div>
        </a>
    </div>

    {{-- ===== TWO COLUMN: RECENT STUDENTS + COURSE BREAKDOWN ===== --}}
    <div style="display: grid; grid-template-columns: 1.6fr 1fr; gap: 20px;">

        {{-- Recent Students --}}
        <div class="dash-card">
            <div class="dash-card-inner">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 18px;">
                    <h2 class="font-HellixB" style="font-size: 15px; margin: 0;">Recently Added Students</h2>
                    <a href="{{ route('branch.allStudents') }}" class="font-HellixR" style="font-size: 12px; color: #9ca3af; text-decoration: none;" onmouseover="this.style.color='#111'" onmouseout="this.style.color='#9ca3af'">View all &rarr;</a>
                </div>
                <div id="recentStudentsLoading" class="flex justify-center py-6">
                    @include('admin.components.spinner', ['class' => ''])
                </div>
                <div id="recentEmpty" class="hidden" style="text-align: center; padding: 24px; color: #9ca3af;">
                    <p class="font-HellixR" style="font-size: 13px;">No students yet.</p>
                </div>
                <table id="recentTable" class="dash-table hidden" style="width: 100%;">
                    <thead>
                        <tr>
                            <th class="font-HellixB" style="text-align: left;">Student</th>
                            <th class="font-HellixB" style="text-align: left;">Course</th>
                            <th class="font-HellixB" style="text-align: left;">Status</th>
                            <th class="font-HellixB" style="text-align: right;">Admission</th>
                        </tr>
                    </thead>
                    <tbody id="recentTableBody"></tbody>
                </table>
            </div>
        </div>

        {{-- Course Breakdown --}}
        <div class="dash-card">
            <div class="dash-card-inner">
                <h2 class="font-HellixB" style="font-size: 15px; margin: 0 0 18px;">Course Distribution</h2>
                <div id="courseBreakdownLoading" class="flex justify-center py-6">
                    @include('admin.components.spinner', ['class' => ''])
                </div>
                <div id="courseBreakdownEmpty" class="hidden" style="text-align: center; padding: 24px; color: #9ca3af;">
                    <p class="font-HellixR" style="font-size: 13px;">No data available.</p>
                </div>
                <div id="courseBreakdown" class="hidden"></div>
            </div>
        </div>

    </div>
</div>

<style>
@keyframes spin { to { transform: rotate(360deg); } }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var session = getBranchData();
    if (!session) return;

    var data = session.branchData;
    var expiryTime = session.expiryTime;

    // Populate hero
    if (data.image) {
        document.getElementById('branchImage').src = data.image;
        document.getElementById('branchImage').style.display = 'block';
        document.getElementById('branchImagePlaceholder').style.display = 'none';
    } else {
        var initial = (data.branchName || '?').charAt(0).toUpperCase();
        document.getElementById('branchImagePlaceholder').textContent = initial;
    }

    document.getElementById('branchName').textContent = data.branchName || '';
    document.getElementById('branchRoleBadge').textContent = (data.role || 'branch').charAt(0).toUpperCase() + (data.role || 'branch').slice(1);
    document.getElementById('branchCode').textContent = data.branchCode || '';
    document.getElementById('branchEmail').textContent = data.email || '';

    var location = [data.city, data.state].filter(Boolean).join(', ');
    document.getElementById('branchLocation').textContent = location || '-';

    // Countdown timer
    var countdownEl = document.getElementById('countdown');
    function updateTimer() {
        var distance = expiryTime - Date.now();
        if (distance <= 0) {
            sessionStorage.clear();
            window.location.href = '/branch/login';
        } else {
            var h = Math.floor(distance / 3600000);
            var m = Math.floor((distance % 3600000) / 60000);
            var s = Math.floor((distance % 60000) / 1000);
            if (h > 0) countdownEl.textContent = h + 'h ' + m + 'm ' + s + 's';
            else countdownEl.textContent = m + 'm ' + s + 's';
        }
    }
    updateTimer();
    setInterval(updateTimer, 1000);

    // Fetch credit
    fetch(API_URL + '/admin/branch/get_credit', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ branch_id: data.branch_id })
    })
    .then(function(r) { return r.json(); })
    .then(function(result) {
        document.getElementById('creditSpinner').style.display = 'none';
        if (!result.error && result.data) {
            var credit = result.data.credit || 0;
            var perCert = result.data.credit_per_certificate || 200;
            document.getElementById('creditDisplay').textContent = credit.toLocaleString();
            document.getElementById('creditDisplay').style.color = credit < perCert ? '#ef4444' : '#34d399';
            document.getElementById('perCertCost').textContent = perCert + ' credits per certificate';
        } else {
            document.getElementById('creditDisplay').textContent = '-';
        }
    })
    .catch(function() {
        document.getElementById('creditSpinner').style.display = 'none';
        document.getElementById('creditDisplay').textContent = '-';
    });

    // Fetch students for stats
    fetch(API_URL + '/admin/branch/get_all_students', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ branch_id: data.branch_id })
    })
    .then(function(r) { return r.json(); })
    .then(function(result) {
        document.getElementById('dashLoading').style.display = 'none';
        document.getElementById('dashContent').classList.remove('hidden');

        if (result.error || !result.data) {
            document.getElementById('statTotal').textContent = '0';
            document.getElementById('statActive').textContent = '0';
            document.getElementById('statCertified').textContent = '0';
            document.getElementById('statPending').textContent = '0';
            document.getElementById('statNoMarks').textContent = '0';
            document.getElementById('recentStudentsLoading').style.display = 'none';
            document.getElementById('recentEmpty').classList.remove('hidden');
            document.getElementById('courseBreakdownLoading').style.display = 'none';
            document.getElementById('courseBreakdownEmpty').classList.remove('hidden');
            return;
        }

        var students = result.data;
        computeStats(students);
        renderRecentStudents(students);
        renderCourseBreakdown(students);
    })
    .catch(function() {
        document.getElementById('dashLoading').style.display = 'none';
        document.getElementById('dashContent').classList.remove('hidden');
    });
});

function computeStats(students) {
    var total = students.length;
    var active = 0, certified = 0, pending = 0, noMarks = 0;

    students.forEach(function(s) {
        if (s.is_student_active) active++;
        if (s.is_certificate_approve) certified++;
        if (s.marksheet_stage === 'pending') pending++;
        if (!s.marks && s.marksheet_stage !== 'verified' && !s.is_certificate_approve) noMarks++;
    });

    animateNumber('statTotal', total);
    animateNumber('statActive', active);
    animateNumber('statCertified', certified);
    animateNumber('statPending', pending);
    animateNumber('statNoMarks', noMarks);
}

function animateNumber(id, target) {
    var el = document.getElementById(id);
    if (target === 0) { el.textContent = '0'; return; }
    var start = 0;
    var duration = 600;
    var startTime = null;
    function step(timestamp) {
        if (!startTime) startTime = timestamp;
        var progress = Math.min((timestamp - startTime) / duration, 1);
        var eased = 1 - Math.pow(1 - progress, 3);
        el.textContent = Math.floor(eased * target);
        if (progress < 1) requestAnimationFrame(step);
        else el.textContent = target;
    }
    requestAnimationFrame(step);
}

function renderRecentStudents(students) {
    document.getElementById('recentStudentsLoading').style.display = 'none';

    if (students.length === 0) {
        document.getElementById('recentEmpty').classList.remove('hidden');
        return;
    }

    // Already sorted by reg no desc from API, take first 6
    var recent = students.slice(0, 6);

    var tbody = document.getElementById('recentTableBody');
    tbody.innerHTML = recent.map(function(s) {
        var statusText, statusBg;
        if (s.is_certificate_approve) { statusText = 'Certified'; statusBg = 'background:#dbeafe;color:#1d4ed8;'; }
        else if (s.marksheet_stage === 'verified') { statusText = 'Verified'; statusBg = 'background:#f3e8ff;color:#7c3aed;'; }
        else if (s.marksheet_stage === 'pending') { statusText = 'Pending'; statusBg = 'background:#fef9c3;color:#a16207;'; }
        else if (s.is_student_active) { statusText = 'Active'; statusBg = 'background:#dcfce7;color:#15803d;'; }
        else { statusText = 'Inactive'; statusBg = 'background:#fee2e2;color:#dc2626;'; }

        var initial = (s.student_name || '?').charAt(0).toUpperCase();

        return '<tr>' +
            '<td>' +
                '<a href="/branch/student?id=' + s.student_id + '" style="display:flex;align-items:center;gap:10px;text-decoration:none;color:inherit;">' +
                    '<div style="width:32px;height:32px;border-radius:8px;background:#f3f4f6;display:flex;align-items:center;justify-content:center;flex-shrink:0;font-size:13px;color:#9ca3af;" class="font-HellixB">' + initial + '</div>' +
                    '<div>' +
                        '<div class="font-HellixB" style="font-size:13px;">' + escapeHtml(s.student_name || '-') + '</div>' +
                        '<div class="font-HellixR" style="font-size:11px;color:#9ca3af;">' + escapeHtml(s.registration_number) + '</div>' +
                    '</div>' +
                '</a>' +
            '</td>' +
            '<td class="font-HellixR" style="font-size:13px;">' + escapeHtml(s.short_form || s.course_name || '-') + '</td>' +
            '<td><span class="dash-badge font-HellixB" style="' + statusBg + '">' + statusText + '</span></td>' +
            '<td class="font-HellixR" style="text-align:right;font-size:12px;color:#6b7280;">' + escapeHtml(s.admission_date || '-') + '</td>' +
        '</tr>';
    }).join('');

    document.getElementById('recentTable').classList.remove('hidden');
}

function renderCourseBreakdown(students) {
    document.getElementById('courseBreakdownLoading').style.display = 'none';

    if (students.length === 0) {
        document.getElementById('courseBreakdownEmpty').classList.remove('hidden');
        return;
    }

    var courseMap = {};
    students.forEach(function(s) {
        var key = s.short_form || s.course_name || 'Unknown';
        if (!courseMap[key]) courseMap[key] = 0;
        courseMap[key]++;
    });

    var entries = Object.entries(courseMap).sort(function(a, b) { return b[1] - a[1]; });
    var total = students.length;

    var colors = ['#2563eb', '#7c3aed', '#16a34a', '#ca8a04', '#dc2626', '#0891b2', '#db2777', '#65a30d'];

    var container = document.getElementById('courseBreakdown');
    container.innerHTML = entries.map(function(entry, i) {
        var name = entry[0];
        var count = entry[1];
        var pct = ((count / total) * 100).toFixed(1);
        var color = colors[i % colors.length];

        return '<div class="dash-course-row">' +
            '<div style="width:8px;height:8px;border-radius:50%;background:' + color + ';flex-shrink:0;"></div>' +
            '<div style="flex:1;min-width:0;">' +
                '<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:6px;">' +
                    '<span class="font-HellixB" style="font-size:13px;">' + escapeHtml(name) + '</span>' +
                    '<span class="font-HellixR" style="font-size:12px;color:#9ca3af;">' + count + ' <span style="font-size:10px;">(' + pct + '%)</span></span>' +
                '</div>' +
                '<div class="dash-progress-bar">' +
                    '<div class="dash-progress-fill" style="width:' + pct + '%;background:' + color + ';"></div>' +
                '</div>' +
            '</div>' +
        '</div>';
    }).join('');

    container.classList.remove('hidden');
}

function escapeHtml(text) {
    if (!text) return '';
    var div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}
</script>
