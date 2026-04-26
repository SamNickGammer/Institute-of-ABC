<style>
    .ms-card {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 1px 3px rgba(0,0,0,0.04);
    }
    .ms-card-inner {
        padding: 28px 32px;
    }
    .ms-card-title {
        font-size: 15px;
        margin-bottom: 20px;
        padding-bottom: 14px;
        border-bottom: 1px solid #f3f4f6;
    }
    .mark-input-card {
        background: #f9fafb;
        border: 1px solid #f3f4f6;
        border-radius: 12px;
        padding: 20px;
        text-align: center;
    }
    .mark-input-card label {
        display: block;
        font-size: 12px;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        margin-bottom: 10px;
    }
    .mark-input-card input {
        width: 100%;
        padding: 10px;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        font-size: 18px;
        text-align: center;
        outline: none;
        font-family: inherit;
        box-sizing: border-box;
    }
    .mark-input-card input:focus {
        border-color: #111;
    }
    .mark-input-card .out-of {
        font-size: 11px;
        color: #9ca3af;
        margin-top: 6px;
    }

    /* Modal overlay */
    .ms-overlay {
        position: fixed;
        top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(0,0,0,0.5);
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
        backdrop-filter: blur(4px);
    }
    .ms-overlay.hidden { display: none; }
    .ms-modal {
        background: #fff;
        border-radius: 20px;
        padding: 36px 32px;
        max-width: 440px;
        width: 90%;
        box-shadow: 0 20px 60px rgba(0,0,0,0.15);
        text-align: center;
    }
    .ms-modal-icon {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
    }
    .ms-modal h3 {
        font-size: 18px;
        margin: 0 0 8px;
    }
    .ms-modal p {
        font-size: 14px;
        color: #6b7280;
        margin: 0 0 6px;
        line-height: 1.5;
    }
    .ms-modal-actions {
        display: flex;
        gap: 10px;
        justify-content: center;
        margin-top: 24px;
    }
    .ms-modal-btn {
        padding: 11px 28px;
        border-radius: 10px;
        font-size: 14px;
        border: none;
        cursor: pointer;
        font-family: inherit;
        transition: background 0.15s;
    }
    .ms-modal-btn-primary {
        background: #111;
        color: #fff;
    }
    .ms-modal-btn-primary:hover { background: #333; }
    .ms-modal-btn-secondary {
        background: #f3f4f6;
        color: #374151;
    }
    .ms-modal-btn-secondary:hover { background: #e5e7eb; }
    .ms-credit-badge {
        display: inline-block;
        background: #f0fdf4;
        border: 1px solid #bbf7d0;
        color: #15803d;
        padding: 8px 20px;
        border-radius: 10px;
        font-size: 22px;
        margin: 12px 0;
    }
    .ms-credit-badge.low {
        background: #fef2f2;
        border-color: #fecaca;
        color: #dc2626;
    }
    .ms-qr-container {
        background: #f9fafb;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        padding: 20px;
        margin: 16px 0;
    }
    .ms-qr-container img {
        width: 180px;
        height: 180px;
        border-radius: 8px;
    }
</style>

<div class="pb-10">
    <div id="msLoading" class="flex justify-center py-20">
        @include('admin.components.spinner', ['class' => ''])
    </div>

    <div id="msNotFound" class="hidden text-center py-20 text-gray-500">
        <p class="text-xl font-HellixB">Student not found</p>
        <a href="{{ route('branch.marksheetManagement') }}" class="text-sm text-black hover:underline mt-3 inline-block">Back to Marksheet Management</a>
    </div>

    <div id="msContent" class="hidden" style="padding: 0 20px;">

        {{-- Hero Card --}}
        <div class="ms-card" style="margin-bottom: 20px;">
            <div class="ms-card-inner">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
                    <a href="{{ route('branch.marksheetManagement') }}" class="font-HellixR" style="font-size: 13px; color: #9ca3af; text-decoration: none; display: flex; align-items: center; gap: 6px; transition: color 0.15s;" onmouseover="this.style.color='#111'" onmouseout="this.style.color='#9ca3af'">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                        Marksheet Management
                    </a>
                    <div style="display: flex; align-items: center; gap: 16px;">
                        <div id="creditDisplay" class="font-HellixB" style="font-size: 13px; color: #6b7280; display: none;">
                            Credit: <span id="creditAmount" style="color: #111;"></span>
                        </div>
                        <a id="viewStudentLink" href="#" class="font-HellixR" style="font-size: 13px; color: #9ca3af; text-decoration: none; display: flex; align-items: center; gap: 6px; transition: color 0.15s;" onmouseover="this.style.color='#111'" onmouseout="this.style.color='#9ca3af'">
                            View Student
                            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </div>

                <div style="display: flex; gap: 20px; align-items: center;">
                    <div style="width: 60px; height: 60px; border-radius: 12px; overflow: hidden; background: #f3f4f6; flex-shrink: 0; border: 1px solid #e5e7eb;">
                        <img id="msPhoto" src="" alt="" style="width: 100%; height: 100%; object-fit: cover; display: none;">
                        <div id="msPhotoPlaceholder" style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; font-size: 22px; color: #d1d5db; background: #f9fafb;" class="font-HellixB"></div>
                    </div>
                    <div style="flex: 1; min-width: 0;">
                        <div style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
                            <h2 id="msName" class="font-HellixB" style="font-size: 18px; margin: 0;"></h2>
                            <span id="msStatus" class="font-HellixB" style="font-size: 10px; padding: 4px 12px; border-radius: 20px;"></span>
                        </div>
                        <p class="font-HellixR" style="font-size: 13px; color: #9ca3af; margin: 2px 0 0 0;">
                            <span id="msRegNo"></span> &middot; <span id="msCourse"></span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Marks Form --}}
        <div class="ms-card" style="margin-bottom: 20px;">
            <div class="ms-card-inner">
                <h2 class="ms-card-title font-HellixB">Enter Marks</h2>

                <div id="marksFields" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px;"></div>

                <div id="noSubjectsMsg" class="hidden" style="text-align: center; padding: 20px; color: #9ca3af;">
                    <p class="font-HellixB">No subjects found for this course</p>
                    <p class="font-HellixR" style="font-size: 13px; margin-top: 4px;">Please add subjects to this course first.</p>
                </div>

                {{-- Summary --}}
                <div id="marksSummary" style="margin-top: 24px; padding-top: 20px; border-top: 1px solid #f3f4f6; display: none;">
                    <div style="display: flex; gap: 20px; align-items: center;">
                        <div style="flex: 1;">
                            <div class="font-HellixR" style="font-size: 12px; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.04em; margin-bottom: 4px;">Total Marks</div>
                            <div id="totalMarksDisplay" class="font-HellixB" style="font-size: 22px;"></div>
                        </div>
                        <div style="flex: 1;">
                            <div class="font-HellixR" style="font-size: 12px; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.04em; margin-bottom: 4px;">Percentage</div>
                            <div id="percentDisplay" class="font-HellixB" style="font-size: 22px;"></div>
                        </div>
                        <div style="flex: 1;">
                            <div class="font-HellixR" style="font-size: 12px; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.04em; margin-bottom: 4px;">Performance</div>
                            <div id="perfDisplay" class="font-HellixB" style="font-size: 22px;"></div>
                        </div>
                    </div>
                </div>

                {{-- Submit --}}
                <div style="margin-top: 24px; display: flex; gap: 12px;">
                    <button id="submitMarksBtn" type="button" class="font-HellixB" style="background: #111; color: #fff; padding: 12px 32px; border-radius: 10px; font-size: 14px; border: none; cursor: pointer; transition: background 0.15s;" onmouseover="this.style.background='#333'" onmouseout="this.style.background='#111'">
                        Save Marks
                    </button>
                    <button id="resetMarksBtn" type="button" class="font-HellixB" style="background: #f3f4f6; color: #374151; padding: 12px 24px; border-radius: 10px; font-size: 14px; border: none; cursor: pointer; transition: background 0.15s;" onmouseover="this.style.background='#e5e7eb'" onmouseout="this.style.background='#f3f4f6'">
                        Reset
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Confirm Charge Modal --}}
<div id="confirmChargeModal" class="ms-overlay hidden">
    <div class="ms-modal">
        <div class="ms-modal-icon" style="background: #fef3c7;">
            <svg width="28" height="28" fill="none" stroke="#d97706" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <h3 class="font-HellixB">Credit Charge</h3>
        <p class="font-HellixR">Saving this marksheet will deduct credits from your account.</p>
        <div class="ms-credit-badge font-HellixB" id="chargeAmountDisplay"></div>
        <p class="font-HellixR" style="font-size: 12px; color: #9ca3af;">
            Your balance: <span id="confirmCurrentCredit" class="font-HellixB" style="color: #111;"></span> credits
            &rarr; After: <span id="confirmRemainingCredit" class="font-HellixB" style="color: #111;"></span> credits
        </p>
        <div class="ms-modal-actions">
            <button class="ms-modal-btn ms-modal-btn-secondary font-HellixB" onclick="closeModal('confirmChargeModal')">Cancel</button>
            <button class="ms-modal-btn ms-modal-btn-primary font-HellixB" id="confirmChargeBtn">Confirm & Save</button>
        </div>
    </div>
</div>

{{-- Insufficient Credit Modal --}}
<div id="noCreditModal" class="ms-overlay hidden">
    <div class="ms-modal">
        <div class="ms-modal-icon" style="background: #fee2e2;">
            <svg width="28" height="28" fill="none" stroke="#dc2626" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4.5c-.77-.833-2.694-.833-3.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
        </div>
        <h3 class="font-HellixB">Insufficient Credits</h3>
        <p class="font-HellixR">You don't have enough credits to create this marksheet.</p>
        <div style="display: flex; justify-content: center; gap: 16px; margin: 12px 0;">
            <div>
                <div class="font-HellixR" style="font-size: 11px; color: #9ca3af; text-transform: uppercase; margin-bottom: 2px;">Required</div>
                <div class="ms-credit-badge low font-HellixB" id="requiredCreditDisplay" style="font-size: 18px; padding: 6px 16px; margin: 0;"></div>
            </div>
            <div>
                <div class="font-HellixR" style="font-size: 11px; color: #9ca3af; text-transform: uppercase; margin-bottom: 2px;">Available</div>
                <div class="ms-credit-badge low font-HellixB" id="availableCreditDisplay" style="font-size: 18px; padding: 6px 16px; margin: 0;"></div>
            </div>
        </div>
        <p class="font-HellixR" style="font-size: 13px; margin-top: 16px;">Please contact <strong>Admin</strong> for recharge.</p>
        <p class="font-HellixR" style="font-size: 12px; color: #9ca3af;">1 Credit = 1 Rupee. Scan the QR below to pay via UPI and send the screenshot on Admin WhatsApp.</p>
        <div class="ms-qr-container">
            <img src="https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=upi://pay?pa=admin@upi&pn=InstituteOfABC&cu=INR" alt="UPI QR Code" style="margin: 0 auto; display: block;">
            <p class="font-HellixR" style="font-size: 11px; color: #9ca3af; margin: 10px 0 0;">Scan to pay via any UPI app</p>
        </div>
        <div class="ms-modal-actions">
            <button class="ms-modal-btn ms-modal-btn-secondary font-HellixB" onclick="closeModal('noCreditModal')">Close</button>
        </div>
    </div>
</div>

<script>
var currentStudent = null;
var courseSubjects = [];
var branchCredit = 0;
var creditPerCertificate = 200;
var isFirstMarksheet = false;
var pendingMarks = null;

document.addEventListener('DOMContentLoaded', function() {
    var session = getBranchData();
    if (!session) return;

    var params = new URLSearchParams(window.location.search);
    var studentId = params.get('id');

    if (!studentId) {
        document.getElementById('msLoading').style.display = 'none';
        document.getElementById('msNotFound').classList.remove('hidden');
        return;
    }

    // Fetch the student, courses, and credit info in parallel
    var studentPromise = fetch(API_URL + '/admin/branch/student/get_by_id', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            branch_id: session.branchData.branch_id,
            student_id: studentId
        })
    }).then(function(r) { return r.json(); });

    var coursesPromise = fetch(API_URL + '/admin/branch/get_all_courses?showActiveOnly=false', {
        method: 'GET',
        headers: { 'Content-Type': 'application/json' }
    }).then(function(r) { return r.json(); });

    var creditPromise = fetch(API_URL + '/admin/branch/get_credit', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ branch_id: session.branchData.branch_id })
    }).then(function(r) { return r.json(); });

    Promise.all([studentPromise, coursesPromise, creditPromise])
    .then(function(results) {
        document.getElementById('msLoading').style.display = 'none';

        var studentResult = results[0];
        var coursesResult = results[1];
        var creditResult = results[2];

        if (studentResult.error || !studentResult.data) {
            document.getElementById('msNotFound').classList.remove('hidden');
            return;
        }

        var s = studentResult.data;

        if (s.marksheet_stage === 'verified' || s.is_certificate_approve) {
            document.getElementById('msNotFound').innerHTML =
                '<p class="text-xl font-HellixB">Cannot edit marksheet</p>' +
                '<p class="text-sm mt-2">This student\'s marksheet is already verified or certified.</p>' +
                '<a href="/branch/student?id=' + s.student_id + '" class="text-sm text-black hover:underline mt-3 inline-block">View Student</a>';
            document.getElementById('msNotFound').classList.remove('hidden');
            return;
        }

        currentStudent = s;
        isFirstMarksheet = !s.marks;

        // Credit info
        if (!creditResult.error && creditResult.data) {
            branchCredit = creditResult.data.credit || 0;
            creditPerCertificate = creditResult.data.credit_per_certificate || 200;
        }

        // Show credit display
        document.getElementById('creditAmount').textContent = branchCredit + ' credits';
        document.getElementById('creditDisplay').style.display = 'inline-block';

        // Find course subjects
        if (!coursesResult.error && coursesResult.data) {
            var course = coursesResult.data.find(function(c) { return c.course_id == s.student_course_id; });
            if (course && course.subjects) {
                courseSubjects = course.subjects.split(',').map(function(sub) { return sub.trim(); }).filter(Boolean);
            }
        }

        populateForm(s);
        document.getElementById('msContent').classList.remove('hidden');
    })
    .catch(function() {
        document.getElementById('msLoading').innerHTML = '<p class="text-red-500">Failed to load data</p>';
    });

    document.getElementById('submitMarksBtn').addEventListener('click', handleSaveClick);
    document.getElementById('resetMarksBtn').addEventListener('click', resetMarks);
    document.getElementById('confirmChargeBtn').addEventListener('click', confirmAndSave);
});

function populateForm(s) {
    document.getElementById('viewStudentLink').href = '/branch/student?id=' + s.student_id;

    if (s.student_photo) {
        document.getElementById('msPhoto').src = s.student_photo;
        document.getElementById('msPhoto').style.display = 'block';
        document.getElementById('msPhotoPlaceholder').style.display = 'none';
    } else {
        document.getElementById('msPhotoPlaceholder').textContent = (s.student_name ? s.student_name.charAt(0).toUpperCase() : '?');
    }

    document.getElementById('msName').textContent = s.student_name || '';
    document.getElementById('msRegNo').textContent = s.registration_number || '';
    document.getElementById('msCourse').textContent = s.short_form || s.course_name || '';

    var statusEl = document.getElementById('msStatus');
    if (s.marksheet_stage === 'pending') {
        statusEl.style.background = '#fef9c3'; statusEl.style.color = '#a16207'; statusEl.textContent = 'Pending';
    } else if (s.is_student_active) {
        statusEl.style.background = '#dcfce7'; statusEl.style.color = '#15803d'; statusEl.textContent = 'Active';
    } else {
        statusEl.style.background = '#fee2e2'; statusEl.style.color = '#dc2626'; statusEl.textContent = 'Inactive';
    }

    var fieldsContainer = document.getElementById('marksFields');

    if (courseSubjects.length === 0) {
        fieldsContainer.style.display = 'none';
        document.getElementById('noSubjectsMsg').classList.remove('hidden');
        document.getElementById('submitMarksBtn').disabled = true;
        document.getElementById('submitMarksBtn').style.opacity = '0.5';
        document.getElementById('submitMarksBtn').style.cursor = 'not-allowed';
        return;
    }

    var existingMarks = {};
    if (s.marks) {
        try { existingMarks = JSON.parse(s.marks); } catch(e) {}
    }

    if (courseSubjects.length <= 2) fieldsContainer.style.gridTemplateColumns = 'repeat(2, 1fr)';
    else if (courseSubjects.length <= 3) fieldsContainer.style.gridTemplateColumns = 'repeat(3, 1fr)';
    else fieldsContainer.style.gridTemplateColumns = 'repeat(4, 1fr)';

    fieldsContainer.innerHTML = courseSubjects.map(function(subject) {
        var existingVal = existingMarks[subject] !== undefined ? existingMarks[subject] : '';
        return '<div class="mark-input-card">' +
            '<label class="font-HellixB">' + escapeHtml(subject) + '</label>' +
            '<input type="number" min="0" max="100" class="mark-input font-HellixB" data-subject="' + escapeHtml(subject) + '" value="' + existingVal + '" placeholder="0">' +
            '<div class="out-of font-HellixR">out of 100</div>' +
        '</div>';
    }).join('');

    document.getElementById('marksSummary').style.display = 'block';

    fieldsContainer.querySelectorAll('.mark-input').forEach(function(input) {
        input.addEventListener('input', updateSummary);
    });

    updateSummary();
}

function updateSummary() {
    var inputs = document.querySelectorAll('.mark-input');
    var total = 0;
    var count = inputs.length;

    inputs.forEach(function(input) {
        var val = parseInt(input.value);
        if (!isNaN(val)) {
            if (val < 0) { input.value = 0; val = 0; }
            if (val > 100) { input.value = 100; val = 100; }
            total += val;
        }
    });

    var possible = count * 100;
    var pct = possible > 0 ? ((total / possible) * 100).toFixed(2) : 0;

    var performance = 'Failure';
    var perfColor = '#dc2626';
    if (pct >= 85) { performance = 'Excellent'; perfColor = '#16a34a'; }
    else if (pct >= 60) { performance = 'Very Good'; perfColor = '#2563eb'; }
    else if (pct >= 30) { performance = 'Good'; perfColor = '#ca8a04'; }

    document.getElementById('totalMarksDisplay').textContent = total + ' / ' + possible;
    document.getElementById('percentDisplay').textContent = pct + '%';
    document.getElementById('perfDisplay').textContent = performance;
    document.getElementById('perfDisplay').style.color = perfColor;
}

function handleSaveClick() {
    if (!currentStudent) return;

    var inputs = document.querySelectorAll('.mark-input');
    var marks = {};
    var valid = true;

    inputs.forEach(function(input) {
        var subject = input.dataset.subject;
        var val = parseInt(input.value);
        if (isNaN(val) || val < 0 || val > 100) {
            valid = false;
            input.style.borderColor = '#ef4444';
        } else {
            input.style.borderColor = '#e5e7eb';
            marks[subject] = val;
        }
    });

    if (!valid) {
        if (typeof toastr !== 'undefined') {
            toastr.error('Please enter valid marks (0-100) for all subjects.');
        }
        return;
    }

    pendingMarks = marks;

    // If first marksheet, show credit confirmation
    if (isFirstMarksheet) {
        if (branchCredit < creditPerCertificate) {
            // Insufficient credit
            document.getElementById('requiredCreditDisplay').textContent = creditPerCertificate;
            document.getElementById('availableCreditDisplay').textContent = branchCredit;
            document.getElementById('noCreditModal').classList.remove('hidden');
            return;
        }

        // Show charge confirmation
        document.getElementById('chargeAmountDisplay').textContent = creditPerCertificate + ' Credits';
        document.getElementById('confirmCurrentCredit').textContent = branchCredit;
        document.getElementById('confirmRemainingCredit').textContent = (branchCredit - creditPerCertificate);
        document.getElementById('confirmChargeModal').classList.remove('hidden');
        return;
    }

    // Not first marksheet — save directly (no charge)
    doSaveMarks();
}

function confirmAndSave() {
    closeModal('confirmChargeModal');
    doSaveMarks();
}

function doSaveMarks() {
    if (!currentStudent || !pendingMarks) return;

    var session = getBranchData();
    if (!session) return;

    var btn = document.getElementById('submitMarksBtn');
    btn.disabled = true;
    btn.textContent = 'Saving...';
    btn.style.opacity = '0.7';

    fetch(API_URL + '/admin/branch/student/add_marksheet', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            student_id: currentStudent.student_id,
            marks: JSON.stringify(pendingMarks),
            branch_id: session.branchData.branch_id
        })
    })
    .then(function(r) { return r.json(); })
    .then(function(result) {
        btn.disabled = false;
        btn.textContent = 'Save Marks';
        btn.style.opacity = '1';

        if (result.insufficient_credit) {
            // Server-side credit check failed
            branchCredit = result.credit || 0;
            document.getElementById('creditAmount').textContent = branchCredit + ' credits';
            document.getElementById('requiredCreditDisplay').textContent = result.charge || creditPerCertificate;
            document.getElementById('availableCreditDisplay').textContent = branchCredit;
            document.getElementById('noCreditModal').classList.remove('hidden');
            return;
        }

        if (result.error) {
            if (typeof toastr !== 'undefined') {
                toastr.error(result.message || 'Failed to save marks.');
            }
            return;
        }

        // Update credit display
        if (result.remaining_credit !== undefined) {
            branchCredit = result.remaining_credit;
            document.getElementById('creditAmount').textContent = branchCredit + ' credits';
        }

        // After first save, future saves are free (just updates)
        if (isFirstMarksheet) {
            isFirstMarksheet = false;
            if (result.credit_deducted > 0) {
                if (typeof toastr !== 'undefined') {
                    toastr.success('Marks saved! ' + result.credit_deducted + ' credits deducted. Remaining: ' + branchCredit + ' credits.');
                }
            }
            if (typeof refreshHeaderCredit === 'function') refreshHeaderCredit();
        } else {
            if (typeof toastr !== 'undefined') {
                toastr.success('Marks updated successfully!');
            }
        }

        if (result.data) {
            currentStudent = Object.assign(currentStudent, result.data);
        }

        pendingMarks = null;
    })
    .catch(function() {
        btn.disabled = false;
        btn.textContent = 'Save Marks';
        btn.style.opacity = '1';
        if (typeof toastr !== 'undefined') {
            toastr.error('Network error. Please try again.');
        }
    });
}

function closeModal(id) {
    document.getElementById(id).classList.add('hidden');
}

function resetMarks() {
    document.querySelectorAll('.mark-input').forEach(function(input) {
        input.value = '';
        input.style.borderColor = '#e5e7eb';
    });
    updateSummary();
}

function escapeHtml(text) {
    if (!text) return '';
    var div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}
</script>
