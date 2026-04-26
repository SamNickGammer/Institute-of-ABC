<style>
    .edit-card {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 1px 3px rgba(0,0,0,0.04);
    }
    .edit-card-inner {
        padding: 28px 32px;
    }
    .edit-card-title {
        font-size: 15px;
        margin-bottom: 20px;
        padding-bottom: 14px;
        border-bottom: 1px solid #f3f4f6;
    }
    .edit-label {
        display: block;
        font-size: 11px;
        color: #9ca3af;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 6px;
    }
    .edit-input {
        width: 100%;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        padding: 10px 14px;
        font-size: 13.5px;
        outline: none;
        transition: border-color 0.15s, box-shadow 0.15s;
        font-family: inherit;
        background: #fff;
        box-sizing: border-box;
    }
    .edit-input:focus {
        border-color: #111;
        box-shadow: 0 0 0 3px rgba(0,0,0,0.04);
    }
    .edit-input-readonly {
        background: #f9fafb;
        color: #9ca3af;
        cursor: not-allowed;
    }
    .edit-input-readonly:focus {
        border-color: #e5e7eb;
        box-shadow: none;
    }
    .edit-input-file {
        width: 100%;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        padding: 8px 14px;
        font-size: 13px;
        background: #fff;
    }
    .edit-input-file::file-selector-button {
        background: #111;
        color: #fff;
        border: none;
        border-radius: 6px;
        padding: 5px 12px;
        font-size: 12px;
        margin-right: 12px;
        cursor: pointer;
        font-family: inherit;
    }
    .edit-select {
        width: 100%;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        padding: 10px 14px;
        font-size: 13.5px;
        outline: none;
        transition: border-color 0.15s, box-shadow 0.15s;
        font-family: inherit;
        background: #fff;
        -webkit-appearance: none;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%239ca3af' viewBox='0 0 16 16'%3E%3Cpath d='M8 11L3 6h10z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 14px center;
        padding-right: 36px;
        box-sizing: border-box;
    }
    .edit-select:focus {
        border-color: #111;
        box-shadow: 0 0 0 3px rgba(0,0,0,0.04);
    }
    .edit-btn-primary {
        width: 100%;
        background: #111;
        color: #fff;
        border: none;
        border-radius: 10px;
        padding: 12px 24px;
        font-size: 13.5px;
        cursor: pointer;
        transition: background 0.15s;
        font-family: inherit;
    }
    .edit-btn-primary:hover { background: #333; }
    .edit-btn-primary:disabled { opacity: 0.5; cursor: not-allowed; }
    .edit-btn-danger {
        width: 100%;
        background: #fff;
        color: #dc2626;
        border: 1px solid #fecaca;
        border-radius: 10px;
        padding: 12px 24px;
        font-size: 13.5px;
        cursor: pointer;
        transition: background 0.15s;
        font-family: inherit;
    }
    .edit-btn-danger:hover { background: #fef2f2; }
    .edit-btn-danger:disabled { opacity: 0.4; cursor: not-allowed; }
    .edit-field-group {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }
    .edit-field-group-3 {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: 16px;
    }
    .edit-phone-wrap {
        display: flex;
    }
    .edit-phone-prefix {
        display: flex;
        align-items: center;
        padding: 0 12px;
        font-size: 13px;
        color: #9ca3af;
        background: #f9fafb;
        border: 1px solid #e5e7eb;
        border-right: none;
        border-radius: 10px 0 0 10px;
    }
    .edit-phone-prefix + .edit-input {
        border-radius: 0 10px 10px 0;
    }
    .edit-fee-prefix {
        display: flex;
        align-items: center;
        padding: 0 12px;
        font-size: 13px;
        color: #9ca3af;
        background: #f9fafb;
        border: 1px solid #e5e7eb;
        border-right: none;
        border-radius: 10px 0 0 10px;
    }
    .edit-fee-prefix + .edit-input {
        border-radius: 0 10px 10px 0;
    }
    .edit-hint {
        font-size: 11px;
        color: #9ca3af;
        margin: 5px 0 0 0;
    }
</style>

<div style="padding-bottom: 40px;">
    <div id="editLoading" class="flex justify-center py-20">
        @include('admin.components.spinner', ['class' => ''])
    </div>

    <div id="editNotFound" class="hidden text-center py-20 text-gray-500">
        <p class="text-xl font-HellixB">Student not found</p>
        <a href="{{ route('branch.allStudents') }}" class="text-sm text-black hover:underline mt-3 inline-block">Back to All Students</a>
    </div>

    <div id="editContent" class="hidden" style="padding: 0 20px;">

        {{-- ===== HERO CARD ===== --}}
        <div class="edit-card" style="margin-bottom: 20px;">
            <div style="padding: 28px 32px;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
                    <a id="backLink" href="{{ route('branch.allStudents') }}" class="font-HellixR" style="font-size: 13px; color: #9ca3af; text-decoration: none; display: flex; align-items: center; gap: 6px; transition: color 0.15s;" onmouseover="this.style.color='#111'" onmouseout="this.style.color='#9ca3af'">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                        Back to Student
                    </a>
                    <div style="font-size: 13px; color: #9ca3af;" class="font-HellixR">Editing Student</div>
                </div>
                <div style="display: flex; gap: 20px; align-items: center;">
                    <div style="width: 56px; height: 56px; border-radius: 14px; overflow: hidden; background: #f3f4f6; flex-shrink: 0; border: 2px solid #e5e7eb;">
                        <img id="currentPhoto" src="" alt="" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div style="flex: 1; min-width: 0;">
                        <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 2px;">
                            <h1 id="editTitle" class="font-HellixB" style="font-size: 20px; margin: 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"></h1>
                            <span id="currentStatusBadge" class="font-HellixB" style="font-size: 11px; padding: 4px 12px; border-radius: 20px; flex-shrink: 0;"></span>
                        </div>
                        <p id="currentRegNo" class="font-HellixR" style="font-size: 13px; color: #9ca3af; margin: 0;"></p>
                    </div>
                </div>
            </div>
        </div>

        {{-- ===== FORM ===== --}}
        <form id="editStudentForm" enctype="multipart/form-data">
            <input type="hidden" name="student_id" id="studentId">

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">

                {{-- LEFT COLUMN --}}
                <div style="display: flex; flex-direction: column; gap: 20px;">

                    {{-- Basic Information --}}
                    <div class="edit-card">
                        <div class="edit-card-inner">
                            <h2 class="edit-card-title font-HellixB">Basic Information</h2>
                            <div class="edit-field-group">
                                <div>
                                    <label class="edit-label font-HellixB">Student Name</label>
                                    <input type="text" name="student_name" class="edit-input font-HellixR">
                                </div>
                                <div>
                                    <label class="edit-label font-HellixB">Registration No</label>
                                    <input type="text" name="registration_number" readonly class="edit-input edit-input-readonly font-HellixR">
                                </div>
                                <div>
                                    <label class="edit-label font-HellixB">Aadhaar</label>
                                    <input type="text" name="aadhaar_number" id="aadhaarInput" maxlength="16" class="edit-input font-HellixR">
                                    <p id="aadhaarHint" class="edit-hint font-HellixR" style="display: none;"></p>
                                </div>
                                <div>
                                    <label class="edit-label font-HellixB">Phone</label>
                                    <div class="edit-phone-wrap">
                                        <span class="edit-phone-prefix font-HellixR">+91</span>
                                        <input type="text" name="student_phone" maxlength="10" pattern="[0-9]{10}" class="edit-input font-HellixR">
                                    </div>
                                </div>
                                <div>
                                    <label class="edit-label font-HellixB">Email</label>
                                    <input type="email" name="student_email" class="edit-input font-HellixR">
                                </div>
                                <div>
                                    <label class="edit-label font-HellixB">Date of Birth</label>
                                    <input type="date" name="dob" class="edit-input font-HellixR">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Family Details --}}
                    <div class="edit-card">
                        <div class="edit-card-inner">
                            <h2 class="edit-card-title font-HellixB">Family Details</h2>
                            <div class="edit-field-group">
                                <div>
                                    <label class="edit-label font-HellixB">Father's Name</label>
                                    <input type="text" name="student_father_name" class="edit-input font-HellixR">
                                </div>
                                <div>
                                    <label class="edit-label font-HellixB">Mother's Name</label>
                                    <input type="text" name="student_mother_name" class="edit-input font-HellixR">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Address --}}
                    <div class="edit-card">
                        <div class="edit-card-inner">
                            <h2 class="edit-card-title font-HellixB">Address</h2>
                            <div style="display: flex; flex-direction: column; gap: 14px;">
                                <div>
                                    <label class="edit-label font-HellixB">Address</label>
                                    <input type="text" name="address" class="edit-input font-HellixR">
                                </div>
                                <div class="edit-field-group-3">
                                    <div>
                                        <label class="edit-label font-HellixB">City</label>
                                        <input type="text" name="city" class="edit-input font-HellixR">
                                    </div>
                                    <div>
                                        <label class="edit-label font-HellixB">State</label>
                                        <input type="text" name="state" class="edit-input font-HellixR">
                                    </div>
                                    <div>
                                        <label class="edit-label font-HellixB">ZIP</label>
                                        <input type="text" name="zip" maxlength="10" class="edit-input font-HellixR">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- RIGHT COLUMN --}}
                <div style="display: flex; flex-direction: column; gap: 20px;">

                    {{-- Course & Dates --}}
                    <div class="edit-card">
                        <div class="edit-card-inner">
                            <h2 class="edit-card-title font-HellixB">Course & Dates</h2>
                            <div style="display: flex; flex-direction: column; gap: 14px;">
                                <div>
                                    <label class="edit-label font-HellixB">Course</label>
                                    <select name="student_course_id" id="editCourseSelect" class="edit-select font-HellixR">
                                        <option value="">Loading...</option>
                                    </select>
                                </div>
                                <div class="edit-field-group">
                                    <div>
                                        <label class="edit-label font-HellixB">Admission Date</label>
                                        <input type="date" name="admission_date" class="edit-input font-HellixR">
                                    </div>
                                    <div>
                                        <label class="edit-label font-HellixB">Relieving Date</label>
                                        <input type="date" name="relieving_date" class="edit-input font-HellixR">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Fee Details --}}
                    <div class="edit-card">
                        <div class="edit-card-inner">
                            <h2 class="edit-card-title font-HellixB">Fee Details</h2>
                            <div class="edit-field-group-3">
                                <div>
                                    <label class="edit-label font-HellixB">Total Fees</label>
                                    <div style="display: flex;">
                                        <span class="edit-fee-prefix font-HellixR">&#8377;</span>
                                        <input type="number" name="total_fees" step="0.01" min="0" class="edit-input font-HellixR">
                                    </div>
                                </div>
                                <div>
                                    <label class="edit-label font-HellixB">Paid Fees</label>
                                    <div style="display: flex;">
                                        <span class="edit-fee-prefix font-HellixR">&#8377;</span>
                                        <input type="number" name="paid_fees" step="0.01" min="0" class="edit-input font-HellixR">
                                    </div>
                                </div>
                                <div>
                                    <label class="edit-label font-HellixB">Due Fees</label>
                                    <div style="display: flex;">
                                        <span class="edit-fee-prefix font-HellixR">&#8377;</span>
                                        <input type="number" name="due_fees" step="0.01" min="0" class="edit-input font-HellixR">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Photo --}}
                    <div class="edit-card">
                        <div class="edit-card-inner">
                            <h2 class="edit-card-title font-HellixB">Student Photo</h2>
                            <div style="display: flex; align-items: center; gap: 20px;">
                                <div style="width: 80px; height: 96px; border-radius: 12px; overflow: hidden; background: #f3f4f6; flex-shrink: 0; border: 2px solid #e5e7eb;">
                                    <img id="editPhoto" src="" alt="" style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                                <div style="flex: 1;">
                                    <input type="file" name="student_photo" accept="image/*" class="edit-input-file font-HellixR">
                                    <p class="edit-hint font-HellixR">JPG, PNG or WebP. Max 2MB.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Locked Banner (hidden by default) --}}
                    <div id="lockedBanner" class="edit-card" style="display: none;">
                        <div class="edit-card-inner" style="text-align: center;">
                            <div style="width: 48px; height: 48px; border-radius: 50%; background: #fef9c3; display: flex; align-items: center; justify-content: center; margin: 0 auto 14px;">
                                <svg width="24" height="24" fill="none" stroke="#a16207" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            </div>
                            <h3 class="font-HellixB" style="font-size: 15px; margin: 0 0 6px;">Editing Locked</h3>
                            <p class="font-HellixR" id="lockedMessage" style="font-size: 13px; color: #9ca3af; margin: 0;">This student has been verified. Only an admin can edit.</p>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="edit-card" id="actionsCard">
                        <div class="edit-card-inner">
                            <h2 class="edit-card-title font-HellixB">Actions</h2>
                            <div style="display: flex; flex-direction: column; gap: 12px;">
                                <button type="submit" id="updateBtn" class="edit-btn-primary font-HellixB">
                                    Update Student
                                </button>
                                <button type="button" id="deleteBtn" class="edit-btn-danger font-HellixB" style="display: none;">
                                    Delete Student
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
var currentStudent = null;
var aadhaarAlreadySet = false;
var userRole = 'branch'; // default

document.addEventListener('DOMContentLoaded', function() {
    var session = getBranchData();
    if (!session) return;

    userRole = (session.branchData.role || 'branch').toLowerCase();

    var params = new URLSearchParams(window.location.search);
    var studentId = params.get('id');

    if (!studentId) {
        document.getElementById('editLoading').style.display = 'none';
        document.getElementById('editNotFound').classList.remove('hidden');
        return;
    }

    // Show delete button only for admin
    if (userRole === 'admin') {
        document.getElementById('deleteBtn').style.display = 'block';
    }

    loadEditCourses(function() {
        loadStudentData(session.branchData.branch_id, studentId);
    });

    document.getElementById('editStudentForm').addEventListener('submit', handleUpdate);
    document.getElementById('deleteBtn').addEventListener('click', handleDelete);
});

function loadEditCourses(callback) {
    fetch(API_URL + '/admin/branch/get_all_courses?showActiveOnly=true')
    .then(function(r) { return r.json(); })
    .then(function(result) {
        var select = document.getElementById('editCourseSelect');
        if (!result.error && result.data) {
            select.innerHTML = '<option value="">Select a course</option>' +
                result.data.map(function(c) {
                    return '<option value="' + c.course_id + '">' + c.short_form + ' - ' + c.course_name + '</option>';
                }).join('');
        } else {
            toastr.warning('Could not load courses');
            select.innerHTML = '<option value="">Failed to load</option>';
        }
        if (callback) callback();
    })
    .catch(function() {
        toastr.error('Failed to load courses');
        if (callback) callback();
    });
}

function loadStudentData(branchId, studentId) {
    fetch(API_URL + '/admin/branch/student/get_by_id', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            branch_id: branchId,
            student_id: studentId
        })
    })
    .then(function(r) { return r.json(); })
    .then(function(result) {
        document.getElementById('editLoading').style.display = 'none';

        if (result.error || !result.data) {
            document.getElementById('editNotFound').classList.remove('hidden');
            toastr.error('Failed to load student data');
            return;
        }

        currentStudent = result.data;
        populateForm(currentStudent);
        document.getElementById('editContent').classList.remove('hidden');
    })
    .catch(function() {
        document.getElementById('editLoading').style.display = 'none';
        document.getElementById('editNotFound').classList.remove('hidden');
        toastr.error('Network error — could not load student');
    });
}

function populateForm(s) {
    document.getElementById('studentId').value = s.student_id;
    document.getElementById('currentPhoto').src = s.student_photo || '';
    document.getElementById('editPhoto').src = s.student_photo || '';
    document.getElementById('editTitle').textContent = s.student_name || 'Student';
    document.getElementById('currentRegNo').textContent = s.registration_number;
    document.getElementById('backLink').href = '/branch/student?id=' + s.student_id;

    // Status badge
    var badge = document.getElementById('currentStatusBadge');
    if (s.is_certificate_approve) { badge.style.background = '#dbeafe'; badge.style.color = '#1d4ed8'; badge.textContent = 'Certified'; }
    else if (s.marksheet_stage === 'verified') { badge.style.background = '#f3e8ff'; badge.style.color = '#7c3aed'; badge.textContent = 'Verified'; }
    else if (s.marksheet_stage === 'pending') { badge.style.background = '#fef9c3'; badge.style.color = '#a16207'; badge.textContent = 'Pending'; }
    else if (s.is_student_active) { badge.style.background = '#dcfce7'; badge.style.color = '#15803d'; badge.textContent = 'Active'; }
    else { badge.style.background = '#fee2e2'; badge.style.color = '#dc2626'; badge.textContent = 'Inactive'; }

    var form = document.getElementById('editStudentForm');

    // Populate all text fields
    var fields = ['student_name', 'registration_number', 'aadhaar_number', 'student_email', 'dob',
        'student_father_name', 'student_mother_name', 'admission_date', 'relieving_date',
        'address', 'city', 'state', 'zip', 'total_fees', 'paid_fees', 'due_fees'];

    fields.forEach(function(name) {
        var el = form.querySelector('[name="' + name + '"]');
        var val = s[name];
        if (name === 'student_phone') return;
        if (el && val !== null && val !== undefined) el.value = val;
    });

    var phoneEl = form.querySelector('[name="student_phone"]');
    if (phoneEl) phoneEl.value = (s.student_phone || '').replace('+91', '');

    if (s.student_course_id) {
        document.getElementById('editCourseSelect').value = s.student_course_id;
    }

    // Aadhaar: editable only if currently empty
    var aadhaarEl = document.getElementById('aadhaarInput');
    var aadhaarHint = document.getElementById('aadhaarHint');
    if (s.aadhaar_number && s.aadhaar_number.trim() !== '') {
        aadhaarAlreadySet = true;
        aadhaarEl.readOnly = true;
        aadhaarEl.classList.add('edit-input-readonly');
        aadhaarHint.textContent = 'Aadhaar already set — cannot be changed';
        aadhaarHint.style.display = 'block';
    } else {
        aadhaarAlreadySet = false;
        aadhaarEl.readOnly = false;
        aadhaarEl.classList.remove('edit-input-readonly');
        aadhaarHint.textContent = 'Aadhaar not set — you can add it now';
        aadhaarHint.style.display = 'block';
        aadhaarHint.style.color = '#16a34a';
    }

    // Certified students: admin can still delete but not branch
    if (s.certified_date || s.is_certificate_approve) {
        if (userRole === 'admin') {
            var delBtn = document.getElementById('deleteBtn');
            delBtn.disabled = true;
            delBtn.textContent = 'Cannot delete (certified)';
        }
    }

    // Branch role: if student has marksheet_id and is verified/certified, lock everything
    var isVerifiedOrCertified = (s.marksheet_id && (s.marksheet_stage === 'verified' || s.is_certificate_approve));

    if (userRole !== 'admin' && isVerifiedOrCertified) {
        lockForm(s);
        toastr.info('This student is locked. Only an admin can edit.');
    }
}

function lockForm(s) {
    // Show locked banner
    document.getElementById('lockedBanner').style.display = 'block';
    var msg = document.getElementById('lockedMessage');
    if (s.is_certificate_approve) {
        msg.textContent = 'This student is certified. Only an admin can make changes.';
    } else {
        msg.textContent = 'This student has a verified marksheet. Only an admin can edit.';
    }

    // Hide actions card (update/delete)
    document.getElementById('actionsCard').style.display = 'none';

    // Make all inputs, selects, textareas readonly/disabled
    var form = document.getElementById('editStudentForm');
    var inputs = form.querySelectorAll('input:not([type="hidden"])');
    inputs.forEach(function(el) {
        el.readOnly = true;
        el.classList.add('edit-input-readonly');
    });

    var selects = form.querySelectorAll('select');
    selects.forEach(function(el) {
        el.disabled = true;
        el.style.background = '#f9fafb';
        el.style.color = '#9ca3af';
        el.style.cursor = 'not-allowed';
    });

    // Disable file input
    var fileInputs = form.querySelectorAll('input[type="file"]');
    fileInputs.forEach(function(el) {
        el.disabled = true;
        el.style.opacity = '0.5';
        el.style.cursor = 'not-allowed';
    });

    // Hide aadhaar hint since nothing is editable
    var aadhaarHint = document.getElementById('aadhaarHint');
    if (aadhaarHint) aadhaarHint.style.display = 'none';
}

function handleUpdate(e) {
    e.preventDefault();
    var btn = document.getElementById('updateBtn');
    btn.disabled = true;
    btn.textContent = 'Updating...';

    var formData = new FormData(document.getElementById('editStudentForm'));

    // Always strip registration_number
    formData.delete('registration_number');

    // Strip aadhaar if it was already set (backend will reject anyway)
    if (aadhaarAlreadySet) {
        formData.delete('aadhaar_number');
    }

    fetch(API_URL + '/admin/branch/update_student', {
        method: 'POST',
        body: formData
    })
    .then(function(r) { return r.json(); })
    .then(function(result) {
        if (result.error) {
            toastr.error(result.message || 'Failed to update');
            if (result.errors) {
                Object.values(result.errors).forEach(function(msgs) {
                    msgs.forEach(function(m) { toastr.error(m); });
                });
            }
        } else {
            toastr.success('Student updated successfully!');
            if (typeof refreshHeaderCredit === 'function') refreshHeaderCredit();
            // If aadhaar was just set, lock it now
            if (!aadhaarAlreadySet) {
                var aadhaarVal = document.getElementById('aadhaarInput').value;
                if (aadhaarVal && aadhaarVal.trim() !== '') {
                    aadhaarAlreadySet = true;
                    var aadhaarEl = document.getElementById('aadhaarInput');
                    aadhaarEl.readOnly = true;
                    aadhaarEl.classList.add('edit-input-readonly');
                    var hint = document.getElementById('aadhaarHint');
                    hint.textContent = 'Aadhaar already set — cannot be changed';
                    hint.style.color = '#9ca3af';
                }
            }
        }
    })
    .catch(function() { toastr.error('Network error — could not update student. Please try again.'); })
    .finally(function() { btn.disabled = false; btn.textContent = 'Update Student'; });
}

function handleDelete() {
    if (!confirm('Are you sure you want to delete this student? This cannot be undone.')) return;

    var btn = document.getElementById('deleteBtn');
    btn.disabled = true;
    btn.textContent = 'Deleting...';

    fetch(API_URL + '/admin/branch/delete_student', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ student_id: currentStudent.student_id })
    })
    .then(function(r) { return r.json(); })
    .then(function(result) {
        if (result.error) {
            toastr.error(result.message || 'Failed to delete');
            btn.disabled = false;
            btn.textContent = 'Delete Student';
        } else {
            toastr.success('Student deleted!');
            setTimeout(function() { window.location.href = '/branch/all-students'; }, 1500);
        }
    })
    .catch(function() { toastr.error('Network error — could not delete student.'); btn.disabled = false; btn.textContent = 'Delete Student'; });
}
</script>
