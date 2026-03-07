<style>
    .add-card {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 1px 3px rgba(0,0,0,0.04);
    }
    .add-card-inner {
        padding: 28px 32px;
    }
    .add-card-title {
        font-size: 15px;
        margin-bottom: 20px;
        padding-bottom: 14px;
        border-bottom: 1px solid #f3f4f6;
    }
    .add-label {
        display: block;
        font-size: 11px;
        color: #9ca3af;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 6px;
    }
    .add-label-required::after {
        content: ' *';
        color: #ef4444;
    }
    .add-input {
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
    .add-input:focus {
        border-color: #111;
        box-shadow: 0 0 0 3px rgba(0,0,0,0.04);
    }
    .add-input-readonly {
        background: #f9fafb;
        color: #9ca3af;
        cursor: not-allowed;
    }
    .add-input-readonly:focus {
        border-color: #e5e7eb;
        box-shadow: none;
    }
    .add-input-error {
        border-color: #ef4444;
    }
    .add-input-file {
        width: 100%;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        padding: 8px 14px;
        font-size: 13px;
        background: #fff;
    }
    .add-input-file::file-selector-button {
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
    .add-select {
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
    .add-select:focus {
        border-color: #111;
        box-shadow: 0 0 0 3px rgba(0,0,0,0.04);
    }
    .add-btn-primary {
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
    .add-btn-primary:hover { background: #333; }
    .add-btn-primary:disabled { opacity: 0.5; cursor: not-allowed; }
    .add-btn-secondary {
        background: #f9fafb;
        color: #111;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        padding: 7px 14px;
        font-size: 12px;
        cursor: pointer;
        transition: background 0.15s, border-color 0.15s;
        font-family: inherit;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .add-btn-secondary:hover { background: #f3f4f6; border-color: #d1d5db; }
    .add-btn-secondary:disabled { opacity: 0.5; cursor: not-allowed; }
    .add-field-group {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }
    .add-field-group-3 {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: 16px;
    }
    .add-phone-wrap {
        display: flex;
    }
    .add-phone-prefix {
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
    .add-phone-prefix + .add-input {
        border-radius: 0 10px 10px 0;
    }
    .add-reg-wrap {
        display: flex;
    }
    .add-reg-prefix {
        display: flex;
        align-items: center;
        padding: 0 12px;
        font-size: 13px;
        color: #6b7280;
        background: #f9fafb;
        border: 1px solid #e5e7eb;
        border-right: none;
        border-radius: 10px 0 0 10px;
        white-space: nowrap;
    }
    .add-reg-prefix + .add-input {
        border-radius: 0 10px 10px 0;
    }
    .add-fee-prefix {
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
    .add-fee-prefix + .add-input {
        border-radius: 0 10px 10px 0;
    }
    .add-hint {
        font-size: 11px;
        color: #9ca3af;
        margin: 5px 0 0 0;
    }
    .add-error-msg {
        font-size: 11px;
        color: #ef4444;
        margin: 5px 0 0 0;
        display: none;
    }
</style>

<div style="padding-bottom: 40px;">
    <div id="addContent" style="padding: 0 20px;">

        {{-- ===== HERO CARD ===== --}}
        <div class="add-card" style="margin-bottom: 20px;">
            <div style="padding: 28px 32px;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
                    <a href="{{ route('branch.allStudents') }}" class="font-HellixR" style="font-size: 13px; color: #9ca3af; text-decoration: none; display: flex; align-items: center; gap: 6px; transition: color 0.15s;" onmouseover="this.style.color='#111'" onmouseout="this.style.color='#9ca3af'">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                        All Students
                    </a>
                    <div style="font-size: 13px; color: #9ca3af;" class="font-HellixR">New Student</div>
                </div>
                <div style="display: flex; align-items: center; gap: 16px;">
                    <div style="width: 48px; height: 48px; border-radius: 14px; background: #f3f4f6; border: 2px solid #e5e7eb; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <svg width="22" height="22" fill="none" stroke="#9ca3af" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </div>
                    <div>
                        <h1 class="font-HellixB" style="font-size: 20px; margin: 0;">Add New Student</h1>
                        <p class="font-HellixR" style="font-size: 13px; color: #9ca3af; margin: 2px 0 0 0;">Fill in the details below to register a new student</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- ===== FORM ===== --}}
        <form id="addStudentForm" enctype="multipart/form-data">

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">

                {{-- LEFT COLUMN --}}
                <div style="display: flex; flex-direction: column; gap: 20px;">

                    {{-- Basic Information --}}
                    <div class="add-card">
                        <div class="add-card-inner">
                            <h2 class="add-card-title font-HellixB">Basic Information</h2>
                            <div class="add-field-group">
                                <div>
                                    <label class="add-label add-label-required font-HellixB">Student Name</label>
                                    <input type="text" name="student_name" id="fStudentName" class="add-input font-HellixR" required>
                                    <p class="add-error-msg font-HellixR" id="errStudentName">Student name is required</p>
                                </div>
                                <div>
                                    <label class="add-label add-label-required font-HellixB">Registration No</label>
                                    <div class="add-reg-wrap">
                                        <span class="add-reg-prefix font-HellixB" id="regPrefix">C/0101</span>
                                        <input type="text" name="registration_number_suffix" id="regSuffix" class="add-input font-HellixR" required placeholder="1069">
                                    </div>
                                    <input type="hidden" name="registration_number" id="regFull">
                                    <div style="display: flex; align-items: center; gap: 8px; margin-top: 6px;">
                                        <button type="button" id="fetchRegBtn" class="add-btn-secondary font-HellixB">
                                            <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                                            Get Next Reg No
                                        </button>
                                        <span id="regHint" class="add-hint font-HellixR"></span>
                                    </div>
                                </div>
                                <div>
                                    <label class="add-label font-HellixB">Aadhaar Number</label>
                                    <input type="text" name="aadhaar_number" id="fAadhaar" maxlength="16" class="add-input font-HellixR" pattern="[0-9]{12,16}" title="Enter 12–16 digit Aadhaar number">
                                    <p class="add-hint font-HellixR">12–16 digits (optional)</p>
                                </div>
                                <div>
                                    <label class="add-label add-label-required font-HellixB">Phone</label>
                                    <div class="add-phone-wrap">
                                        <span class="add-phone-prefix font-HellixR">+91</span>
                                        <input type="text" name="student_phone" id="fPhone" maxlength="10" pattern="[0-9]{10}" class="add-input font-HellixR" required title="Enter 10 digit phone number">
                                    </div>
                                    <p class="add-error-msg font-HellixR" id="errPhone">Enter a valid 10-digit phone number</p>
                                </div>
                                <div>
                                    <label class="add-label font-HellixB">Email</label>
                                    <input type="email" name="student_email" class="add-input font-HellixR">
                                </div>
                                <div>
                                    <label class="add-label add-label-required font-HellixB">Date of Birth</label>
                                    <input type="date" name="dob" id="fDob" class="add-input font-HellixR" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Family Details --}}
                    <div class="add-card">
                        <div class="add-card-inner">
                            <h2 class="add-card-title font-HellixB">Family Details</h2>
                            <div class="add-field-group">
                                <div>
                                    <label class="add-label font-HellixB">Father's Name</label>
                                    <input type="text" name="student_father_name" class="add-input font-HellixR">
                                </div>
                                <div>
                                    <label class="add-label font-HellixB">Mother's Name</label>
                                    <input type="text" name="student_mother_name" class="add-input font-HellixR">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Address --}}
                    <div class="add-card">
                        <div class="add-card-inner">
                            <h2 class="add-card-title font-HellixB">Address</h2>
                            <div style="display: flex; flex-direction: column; gap: 14px;">
                                <div>
                                    <label class="add-label font-HellixB">Address</label>
                                    <input type="text" name="address" class="add-input font-HellixR">
                                </div>
                                <div class="add-field-group-3">
                                    <div>
                                        <label class="add-label font-HellixB">City</label>
                                        <input type="text" name="city" class="add-input font-HellixR">
                                    </div>
                                    <div>
                                        <label class="add-label font-HellixB">State</label>
                                        <input type="text" name="state" class="add-input font-HellixR">
                                    </div>
                                    <div>
                                        <label class="add-label font-HellixB">ZIP</label>
                                        <input type="text" name="zip" maxlength="10" class="add-input font-HellixR">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- RIGHT COLUMN --}}
                <div style="display: flex; flex-direction: column; gap: 20px;">

                    {{-- Course & Dates --}}
                    <div class="add-card">
                        <div class="add-card-inner">
                            <h2 class="add-card-title font-HellixB">Course & Dates</h2>
                            <div style="display: flex; flex-direction: column; gap: 14px;">
                                <div>
                                    <label class="add-label add-label-required font-HellixB">Course</label>
                                    <select name="student_course_id" id="courseSelect" class="add-select font-HellixR" required>
                                        <option value="">Loading...</option>
                                    </select>
                                </div>
                                <div class="add-field-group">
                                    <div>
                                        <label class="add-label add-label-required font-HellixB">Admission Date</label>
                                        <input type="date" name="admission_date" id="admissionDate" class="add-input font-HellixR" required>
                                    </div>
                                    <div>
                                        <label class="add-label font-HellixB">Relieving Date</label>
                                        <input type="date" name="relieving_date" id="relievingDate" readonly class="add-input add-input-readonly font-HellixR">
                                        <p class="add-hint font-HellixR">Auto-calculated from course duration</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Fee Details --}}
                    <div class="add-card">
                        <div class="add-card-inner">
                            <h2 class="add-card-title font-HellixB">Fee Details</h2>
                            <div class="add-field-group-3">
                                <div>
                                    <label class="add-label font-HellixB">Total Fees</label>
                                    <div style="display: flex;">
                                        <span class="add-fee-prefix font-HellixR">&#8377;</span>
                                        <input type="number" name="total_fees" id="totalFeesInput" step="0.01" min="0" class="add-input font-HellixR">
                                    </div>
                                    <p class="add-hint font-HellixR">Auto-filled from course</p>
                                </div>
                                <div>
                                    <label class="add-label font-HellixB">Paid Fees</label>
                                    <div style="display: flex;">
                                        <span class="add-fee-prefix font-HellixR">&#8377;</span>
                                        <input type="number" name="paid_fees" step="0.01" min="0" value="0" class="add-input font-HellixR">
                                    </div>
                                </div>
                                <div>
                                    <label class="add-label font-HellixB">Due Fees</label>
                                    <div style="display: flex;">
                                        <span class="add-fee-prefix font-HellixR">&#8377;</span>
                                        <input type="number" name="due_fees" step="0.01" min="0" class="add-input font-HellixR">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Photo --}}
                    <div class="add-card">
                        <div class="add-card-inner">
                            <h2 class="add-card-title font-HellixB">Student Photo</h2>
                            <div style="display: flex; align-items: center; gap: 20px;">
                                <div id="photoPreviewBox" style="width: 80px; height: 96px; border-radius: 12px; overflow: hidden; background: #f3f4f6; flex-shrink: 0; border: 2px solid #e5e7eb; display: flex; align-items: center; justify-content: center;">
                                    <svg id="photoPlaceholderIcon" width="28" height="28" fill="none" stroke="#d1d5db" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    <img id="photoPreview" src="" alt="" style="width: 100%; height: 100%; object-fit: cover; display: none;">
                                </div>
                                <div style="flex: 1;">
                                    <input type="file" name="student_photo" id="photoInput" accept="image/*" class="add-input-file font-HellixR">
                                    <p class="add-hint font-HellixR">JPG, PNG or WebP. Max 2MB.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Submit --}}
                    <div class="add-card">
                        <div class="add-card-inner">
                            <button type="submit" id="submitBtn" class="add-btn-primary font-HellixB">
                                Add Student
                            </button>
                            <p class="font-HellixR" style="font-size: 11px; color: #9ca3af; text-align: center; margin: 10px 0 0 0;">Student will be added to your branch</p>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
var branchSession = null;
var regPrefix = 'C/0101';
var coursesData = [];

document.addEventListener('DOMContentLoaded', function() {
    branchSession = getBranchData();
    if (!branchSession) return;

    loadCourses();
    loadNextRegNumber();

    document.getElementById('courseSelect').addEventListener('change', onCourseChange);
    document.getElementById('admissionDate').addEventListener('change', calculateRelievingDate);
    document.getElementById('addStudentForm').addEventListener('submit', handleSubmit);
    document.getElementById('fetchRegBtn').addEventListener('click', loadNextRegNumber);
    document.getElementById('photoInput').addEventListener('change', previewPhoto);

    // Aadhaar: only digits
    document.getElementById('fAadhaar').addEventListener('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    // Phone: only digits
    document.getElementById('fPhone').addEventListener('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    // Reg suffix: only digits
    document.getElementById('regSuffix').addEventListener('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
});

function loadCourses() {
    fetch(API_URL + '/admin/branch/get_all_courses?showActiveOnly=true')
    .then(function(r) { return r.json(); })
    .then(function(result) {
        var select = document.getElementById('courseSelect');
        if (!result.error && result.data) {
            coursesData = result.data;
            select.innerHTML = '<option value="">Select a course</option>' +
                result.data.map(function(c) {
                    return '<option value="' + c.course_id + '" data-fees="' + (c.course_fees || 0) + '">' + c.short_form + ' - ' + c.course_name + ' (' + c.course_duration + ' months)</option>';
                }).join('');
        } else {
            toastr.warning('Could not load courses');
            select.innerHTML = '<option value="">Failed to load</option>';
        }
    })
    .catch(function() {
        toastr.error('Failed to load courses — check your connection');
        document.getElementById('courseSelect').innerHTML = '<option value="">Failed to load</option>';
    });
}

function loadNextRegNumber() {
    var btn = document.getElementById('fetchRegBtn');
    var hint = document.getElementById('regHint');
    btn.disabled = true;
    hint.textContent = 'Fetching...';
    hint.style.color = '#9ca3af';

    fetch(API_URL + '/admin/branch/student/get_next_reg_no', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ branch_id: branchSession.branchData.branch_id })
    })
    .then(function(r) { return r.text(); })
    .then(function(text) {
        var val = text.replace(/<[^>]*>/g, '').replace(/Deprecated[^"]+/gi, '').trim().replace(/^"|"$/g, '');

        // Split into prefix + suffix (e.g. "C/01011069" => prefix "C/0101", suffix "1069")
        // Find where the number part starts after the known prefix pattern
        var match = val.match(/^([A-Z]\/\d{4})([\d]+)$/i);
        if (match) {
            regPrefix = match[1];
            document.getElementById('regPrefix').textContent = regPrefix;
            document.getElementById('regSuffix').value = match[2];
        } else {
            // Fallback: put the whole thing as suffix
            document.getElementById('regSuffix').value = val;
        }

        hint.textContent = 'Next available: ' + val;
        hint.style.color = '#16a34a';
    })
    .catch(function() {
        hint.textContent = 'Failed to fetch';
        hint.style.color = '#ef4444';
    })
    .finally(function() {
        btn.disabled = false;
    });
}

function onCourseChange() {
    calculateRelievingDate();
    // Auto-fill total fees from course
    var select = document.getElementById('courseSelect');
    var selected = select.options[select.selectedIndex];
    if (selected && selected.dataset.fees) {
        var fees = parseFloat(selected.dataset.fees) || 0;
        document.getElementById('totalFeesInput').value = fees > 0 ? fees : '';
    }
}

function calculateRelievingDate() {
    var courseId = document.getElementById('courseSelect').value;
    var admDate = document.getElementById('admissionDate').value;
    if (!courseId || !admDate) return;

    fetch(API_URL + '/admin/branch/student/get_relieving_date', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ course_id: parseInt(courseId), admission_date: admDate })
    })
    .then(function(r) { return r.text(); })
    .then(function(text) {
        var val = text.replace(/<[^>]*>/g, '').replace(/Deprecated[^"]+/gi, '').trim().replace(/^"|"$/g, '');
        document.getElementById('relievingDate').value = val;
    })
    .catch(function() {
        toastr.warning('Could not calculate relieving date');
    });
}

function previewPhoto() {
    var file = document.getElementById('photoInput').files[0];
    var preview = document.getElementById('photoPreview');
    var icon = document.getElementById('photoPlaceholderIcon');
    if (file) {
        var reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
            icon.style.display = 'none';
        };
        reader.readAsDataURL(file);
    } else {
        preview.style.display = 'none';
        icon.style.display = 'block';
    }
}

function validateForm() {
    var valid = true;
    var errors = [];

    // Name
    var name = document.getElementById('fStudentName').value.trim();
    if (!name) {
        document.getElementById('errStudentName').style.display = 'block';
        document.getElementById('fStudentName').classList.add('add-input-error');
        errors.push('Student name is required');
        valid = false;
    } else {
        document.getElementById('errStudentName').style.display = 'none';
        document.getElementById('fStudentName').classList.remove('add-input-error');
    }

    // Phone
    var phone = document.getElementById('fPhone').value.trim();
    if (!phone || !/^[0-9]{10}$/.test(phone)) {
        document.getElementById('errPhone').style.display = 'block';
        document.getElementById('fPhone').classList.add('add-input-error');
        errors.push('Enter a valid 10-digit phone number');
        valid = false;
    } else {
        document.getElementById('errPhone').style.display = 'none';
        document.getElementById('fPhone').classList.remove('add-input-error');
    }

    // Aadhaar (optional but if entered, must be 12-16 digits)
    var aadhaar = document.getElementById('fAadhaar').value.trim();
    if (aadhaar && !/^[0-9]{12,16}$/.test(aadhaar)) {
        document.getElementById('fAadhaar').classList.add('add-input-error');
        errors.push('Aadhaar must be 12\u201316 digits');
        valid = false;
    } else {
        document.getElementById('fAadhaar').classList.remove('add-input-error');
    }

    // Reg suffix
    var suffix = document.getElementById('regSuffix').value.trim();
    if (!suffix) {
        document.getElementById('regSuffix').classList.add('add-input-error');
        errors.push('Registration number is required');
        valid = false;
    } else {
        document.getElementById('regSuffix').classList.remove('add-input-error');
    }

    // DOB
    var dob = document.getElementById('fDob').value;
    if (!dob) {
        document.getElementById('fDob').classList.add('add-input-error');
        errors.push('Date of birth is required');
        valid = false;
    } else {
        document.getElementById('fDob').classList.remove('add-input-error');
    }

    // Course
    var course = document.getElementById('courseSelect').value;
    if (!course) {
        errors.push('Please select a course');
        valid = false;
    }

    // Admission date
    var admDate = document.getElementById('admissionDate').value;
    if (!admDate) {
        document.getElementById('admissionDate').classList.add('add-input-error');
        errors.push('Admission date is required');
        valid = false;
    } else {
        document.getElementById('admissionDate').classList.remove('add-input-error');
    }

    // Show all errors as toasts
    if (!valid) {
        errors.forEach(function(msg) { toastr.error(msg); });
    }

    return valid;
}

function handleSubmit(e) {
    e.preventDefault();

    if (!validateForm()) return;

    var btn = document.getElementById('submitBtn');
    btn.disabled = true;
    btn.textContent = 'Adding...';

    // Build full registration number
    var fullReg = regPrefix + document.getElementById('regSuffix').value.trim();
    document.getElementById('regFull').value = fullReg;

    var formData = new FormData(document.getElementById('addStudentForm'));
    formData.append('branch_id', branchSession.branchData.branch_id);
    // Remove the suffix field (not needed by API)
    formData.delete('registration_number_suffix');

    fetch(API_URL + '/admin/branch/add_student', {
        method: 'POST',
        body: formData
    })
    .then(function(r) { return r.json(); })
    .then(function(result) {
        if (result.error) {
            toastr.error(result.message || 'Failed to add student');
            if (result.errors) {
                Object.values(result.errors).forEach(function(msgs) {
                    msgs.forEach(function(m) { toastr.error(m); });
                });
            }
        } else {
            toastr.success('Student added successfully!');
            if (typeof refreshHeaderCredit === 'function') refreshHeaderCredit();
            setTimeout(function() { window.location.href = '/branch/all-students'; }, 1500);
        }
    })
    .catch(function() { toastr.error('Network error — could not add student. Please try again.'); })
    .finally(function() { btn.disabled = false; btn.textContent = 'Add Student'; });
}
</script>
