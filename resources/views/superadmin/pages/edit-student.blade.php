<style>
    .sa-edit-card { background: #fff; border-radius: 16px; border: 1px solid #e5e7eb; }
    .sa-edit-inner { padding: 28px 32px; }
    .sa-edit-title { font-size: 15px; margin-bottom: 20px; padding-bottom: 14px; border-bottom: 1px solid #f3f4f6; }
    .sa-edit-label { display: block; font-size: 11px; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 6px; }
    .sa-edit-input {
        width: 100%; border: 1px solid #e5e7eb; border-radius: 10px; padding: 10px 14px;
        font-size: 13.5px; outline: none; transition: border-color 0.15s; font-family: inherit;
        background: #fff; box-sizing: border-box;
    }
    .sa-edit-input:focus { border-color: #111; }
    .sa-edit-input-ro { background: #f9fafb; color: #9ca3af; cursor: not-allowed; }
    .sa-edit-select {
        width: 100%; border: 1px solid #e5e7eb; border-radius: 10px; padding: 10px 14px;
        font-size: 13.5px; outline: none; font-family: inherit; background: #fff;
        -webkit-appearance: none; appearance: none; box-sizing: border-box;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%239ca3af' viewBox='0 0 16 16'%3E%3Cpath d='M8 11L3 6h10z'/%3E%3C/svg%3E");
        background-repeat: no-repeat; background-position: right 14px center; padding-right: 36px;
    }
    .sa-edit-select:focus { border-color: #111; }
    .sa-edit-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
    .sa-edit-row-3 { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 16px; }
    .sa-edit-file { width: 100%; border: 1px solid #e5e7eb; border-radius: 10px; padding: 8px 14px; font-size: 13px; background: #fff; }
    .sa-edit-file::file-selector-button { background: #111; color: #fff; border: none; border-radius: 6px; padding: 5px 12px; font-size: 12px; margin-right: 12px; cursor: pointer; font-family: inherit; }
    .sa-edit-btn { width: 100%; background: #111; color: #fff; border: none; border-radius: 10px; padding: 12px 24px; font-size: 13.5px; cursor: pointer; font-family: inherit; }
    .sa-edit-btn:hover { background: #333; }
    .sa-edit-btn:disabled { opacity: 0.5; cursor: not-allowed; }
    .sa-edit-btn-danger { width: 100%; background: #fff; color: #dc2626; border: 1px solid #fecaca; border-radius: 10px; padding: 12px 24px; font-size: 13.5px; cursor: pointer; font-family: inherit; }
    .sa-edit-btn-danger:hover { background: #fef2f2; }
    .sa-edit-btn-danger:disabled { opacity: 0.4; cursor: not-allowed; }
    .sa-fee-prefix { display: flex; align-items: center; padding: 0 12px; font-size: 13px; color: #9ca3af; background: #f9fafb; border: 1px solid #e5e7eb; border-right: none; border-radius: 10px 0 0 10px; }
    .sa-fee-prefix + .sa-edit-input { border-radius: 0 10px 10px 0; }
    .sa-phone-prefix { display: flex; align-items: center; padding: 0 12px; font-size: 13px; color: #9ca3af; background: #f9fafb; border: 1px solid #e5e7eb; border-right: none; border-radius: 10px 0 0 10px; }
    .sa-phone-prefix + .sa-edit-input { border-radius: 0 10px 10px 0; }
</style>

<div style="padding-bottom:40px;">
    <div id="saEditLoading" class="flex justify-center py-20">
        @include('admin.components.spinner', ['class' => ''])
    </div>

    <div id="saEditNotFound" class="hidden" style="text-align:center;padding:80px 20px;color:#9ca3af;">
        <p class="font-HellixB" style="font-size:18px;color:#6b7280;">Student not found</p>
        <a href="{{ route('superadmin.allStudents') }}" class="font-HellixR" style="font-size:13px;color:#111;text-decoration:underline;">Back to All Students</a>
    </div>

    <div id="saEditContent" class="hidden" style="padding:0 20px;">

        {{-- Hero --}}
        <div class="sa-edit-card" style="margin-bottom:20px;">
            <div style="padding:28px 32px;">
                <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:24px;">
                    <a id="saEditBackLink" href="{{ route('superadmin.allStudents') }}" class="font-HellixR" style="font-size:13px;color:#9ca3af;text-decoration:none;display:flex;align-items:center;gap:6px;" onmouseover="this.style.color='#111'" onmouseout="this.style.color='#9ca3af'">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                        Back to Student
                    </a>
                    <div style="display:flex;align-items:center;gap:8px;">
                        <span style="font-size:13px;color:#9ca3af;" class="font-HellixR">Editing as</span>
                        <span class="font-HellixB" style="font-size:11px;padding:4px 12px;border-radius:20px;background:#1e1b4b;color:#c7d2fe;">Admin</span>
                    </div>
                </div>
                <div style="display:flex;gap:20px;align-items:center;">
                    <div style="width:56px;height:56px;border-radius:14px;overflow:hidden;background:#f3f4f6;flex-shrink:0;border:2px solid #e5e7eb;">
                        <img id="saEditCurrentPhoto" src="" alt="" style="width:100%;height:100%;object-fit:cover;">
                    </div>
                    <div style="flex:1;min-width:0;">
                        <div style="display:flex;align-items:center;gap:10px;margin-bottom:2px;">
                            <h1 id="saEditTitle" class="font-HellixB" style="font-size:20px;margin:0;"></h1>
                            <span id="saEditStatusBadge" class="font-HellixB" style="font-size:11px;padding:4px 12px;border-radius:20px;"></span>
                        </div>
                        <p id="saEditRegNoDisplay" class="font-HellixR" style="font-size:13px;color:#9ca3af;margin:0;"></p>
                    </div>
                </div>
            </div>
        </div>

        <form id="saEditForm" enctype="multipart/form-data">
            <input type="hidden" name="student_id" id="saEditStudentId">

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">
                {{-- Left --}}
                <div style="display:flex;flex-direction:column;gap:20px;">
                    <div class="sa-edit-card">
                        <div class="sa-edit-inner">
                            <h2 class="sa-edit-title font-HellixB">Basic Information</h2>
                            <div class="sa-edit-row">
                                <div><label class="sa-edit-label font-HellixB">Student Name</label><input type="text" name="student_name" class="sa-edit-input font-HellixR"></div>
                                <div><label class="sa-edit-label font-HellixB">Registration No</label><input type="text" name="registration_number" readonly class="sa-edit-input sa-edit-input-ro font-HellixR"></div>
                                <div><label class="sa-edit-label font-HellixB">Aadhaar</label><input type="text" name="aadhaar_number" maxlength="16" class="sa-edit-input font-HellixR"></div>
                                <div>
                                    <label class="sa-edit-label font-HellixB">Phone</label>
                                    <div style="display:flex;"><span class="sa-phone-prefix font-HellixR">+91</span><input type="text" name="student_phone" maxlength="10" class="sa-edit-input font-HellixR"></div>
                                </div>
                                <div><label class="sa-edit-label font-HellixB">Email</label><input type="email" name="student_email" class="sa-edit-input font-HellixR"></div>
                                <div><label class="sa-edit-label font-HellixB">Date of Birth</label><input type="date" name="dob" class="sa-edit-input font-HellixR"></div>
                            </div>
                        </div>
                    </div>
                    <div class="sa-edit-card">
                        <div class="sa-edit-inner">
                            <h2 class="sa-edit-title font-HellixB">Family Details</h2>
                            <div class="sa-edit-row">
                                <div><label class="sa-edit-label font-HellixB">Father's Name</label><input type="text" name="student_father_name" class="sa-edit-input font-HellixR"></div>
                                <div><label class="sa-edit-label font-HellixB">Mother's Name</label><input type="text" name="student_mother_name" class="sa-edit-input font-HellixR"></div>
                            </div>
                        </div>
                    </div>
                    <div class="sa-edit-card">
                        <div class="sa-edit-inner">
                            <h2 class="sa-edit-title font-HellixB">Address</h2>
                            <div style="display:flex;flex-direction:column;gap:14px;">
                                <div><label class="sa-edit-label font-HellixB">Address</label><input type="text" name="address" class="sa-edit-input font-HellixR"></div>
                                <div class="sa-edit-row-3">
                                    <div><label class="sa-edit-label font-HellixB">City</label><input type="text" name="city" class="sa-edit-input font-HellixR"></div>
                                    <div><label class="sa-edit-label font-HellixB">State</label><input type="text" name="state" class="sa-edit-input font-HellixR"></div>
                                    <div><label class="sa-edit-label font-HellixB">ZIP</label><input type="text" name="zip" maxlength="10" class="sa-edit-input font-HellixR"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right --}}
                <div style="display:flex;flex-direction:column;gap:20px;">
                    <div class="sa-edit-card">
                        <div class="sa-edit-inner">
                            <h2 class="sa-edit-title font-HellixB">Course & Dates</h2>
                            <div style="display:flex;flex-direction:column;gap:14px;">
                                <div><label class="sa-edit-label font-HellixB">Course</label><select name="student_course_id" id="saEditCourseSelect" class="sa-edit-select font-HellixR"><option value="">Loading...</option></select></div>
                                <div class="sa-edit-row">
                                    <div><label class="sa-edit-label font-HellixB">Admission Date</label><input type="date" name="admission_date" class="sa-edit-input font-HellixR"></div>
                                    <div><label class="sa-edit-label font-HellixB">Relieving Date</label><input type="date" name="relieving_date" class="sa-edit-input font-HellixR"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sa-edit-card">
                        <div class="sa-edit-inner">
                            <h2 class="sa-edit-title font-HellixB">Fee Details</h2>
                            <div class="sa-edit-row-3">
                                <div><label class="sa-edit-label font-HellixB">Total Fees</label><div style="display:flex;"><span class="sa-fee-prefix font-HellixR">&#8377;</span><input type="number" name="total_fees" step="0.01" min="0" class="sa-edit-input font-HellixR"></div></div>
                                <div><label class="sa-edit-label font-HellixB">Paid Fees</label><div style="display:flex;"><span class="sa-fee-prefix font-HellixR">&#8377;</span><input type="number" name="paid_fees" step="0.01" min="0" class="sa-edit-input font-HellixR"></div></div>
                                <div><label class="sa-edit-label font-HellixB">Due Fees</label><div style="display:flex;"><span class="sa-fee-prefix font-HellixR">&#8377;</span><input type="number" name="due_fees" step="0.01" min="0" class="sa-edit-input font-HellixR"></div></div>
                            </div>
                        </div>
                    </div>
                    <div class="sa-edit-card">
                        <div class="sa-edit-inner">
                            <h2 class="sa-edit-title font-HellixB">Student Photo</h2>
                            <div style="display:flex;align-items:center;gap:20px;">
                                <div style="width:80px;height:96px;border-radius:12px;overflow:hidden;background:#f3f4f6;flex-shrink:0;border:2px solid #e5e7eb;">
                                    <img id="saEditPhoto" src="" alt="" style="width:100%;height:100%;object-fit:cover;">
                                </div>
                                <div style="flex:1;">
                                    <input type="file" name="student_photo" accept="image/*" class="sa-edit-file font-HellixR">
                                    <p class="font-HellixR" style="font-size:11px;color:#9ca3af;margin:5px 0 0;">JPG, PNG or WebP. Max 2MB.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sa-edit-card">
                        <div class="sa-edit-inner">
                            <h2 class="sa-edit-title font-HellixB">Actions</h2>
                            <div style="display:flex;flex-direction:column;gap:12px;">
                                <button type="submit" id="saEditUpdateBtn" class="sa-edit-btn font-HellixB">Update Student</button>
                                <button type="button" id="saEditDeleteBtn" class="sa-edit-btn-danger font-HellixB">Delete Student</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
var saEditStudent = null;

document.addEventListener('DOMContentLoaded', function() {
    verifyAdminAccess(function(session) {
        var params = new URLSearchParams(window.location.search);
        var studentId = params.get('id');

        if (!studentId) {
            document.getElementById('saEditLoading').style.display = 'none';
            document.getElementById('saEditNotFound').classList.remove('hidden');
            return;
        }

        saEditLoadCourses(function() {
            saEditLoadStudent(session, studentId);
        });

        document.getElementById('saEditForm').addEventListener('submit', saHandleUpdate);
        document.getElementById('saEditDeleteBtn').addEventListener('click', saHandleDelete);
    });
});

function saEditLoadCourses(callback) {
    fetch(API_URL + '/admin/branch/get_all_courses?showActiveOnly=true')
    .then(function(r) { return r.json(); })
    .then(function(result) {
        var select = document.getElementById('saEditCourseSelect');
        if (!result.error && result.data) {
            select.innerHTML = '<option value="">Select a course</option>' +
                result.data.map(function(c) { return '<option value="' + c.course_id + '">' + c.short_form + ' - ' + c.course_name + '</option>'; }).join('');
        }
        if (callback) callback();
    })
    .catch(function() { if (callback) callback(); });
}

function saEditLoadStudent(session, studentId) {
    fetch(API_URL + '/admin/get_all_students_all_branches', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ admin_branch_id: session.adminData.branch_id })
    })
    .then(function(r) { return r.json(); })
    .then(function(result) {
        document.getElementById('saEditLoading').style.display = 'none';
        if (result.error || !result.data) {
            document.getElementById('saEditNotFound').classList.remove('hidden');
            return;
        }
        saEditStudent = result.data.find(function(st) { return st.student_id == studentId; });
        if (!saEditStudent) {
            document.getElementById('saEditNotFound').classList.remove('hidden');
            return;
        }
        saPopulateEditForm(saEditStudent);
        document.getElementById('saEditContent').classList.remove('hidden');
    })
    .catch(function() {
        document.getElementById('saEditLoading').style.display = 'none';
        document.getElementById('saEditNotFound').classList.remove('hidden');
    });
}

function saPopulateEditForm(s) {
    document.getElementById('saEditStudentId').value = s.student_id;
    document.getElementById('saEditCurrentPhoto').src = s.student_photo || '';
    document.getElementById('saEditPhoto').src = s.student_photo || '';
    document.getElementById('saEditTitle').textContent = s.student_name || 'Student';
    document.getElementById('saEditRegNoDisplay').textContent = s.registration_number;
    document.getElementById('saEditBackLink').href = '/admin-abc/student?id=' + s.student_id;

    var badge = document.getElementById('saEditStatusBadge');
    if (s.is_certificate_approve) { badge.style.background='#dbeafe'; badge.style.color='#1d4ed8'; badge.textContent='Certified'; }
    else if (s.marksheet_stage==='verified') { badge.style.background='#f3e8ff'; badge.style.color='#7c3aed'; badge.textContent='Verified'; }
    else if (s.marksheet_stage==='pending') { badge.style.background='#fef9c3'; badge.style.color='#a16207'; badge.textContent='Pending'; }
    else if (s.is_student_active) { badge.style.background='#dcfce7'; badge.style.color='#15803d'; badge.textContent='Active'; }
    else { badge.style.background='#fee2e2'; badge.style.color='#dc2626'; badge.textContent='Inactive'; }

    var form = document.getElementById('saEditForm');
    var fields = ['student_name', 'registration_number', 'aadhaar_number', 'student_email', 'dob',
        'student_father_name', 'student_mother_name', 'admission_date', 'relieving_date',
        'address', 'city', 'state', 'zip', 'total_fees', 'paid_fees', 'due_fees'];

    fields.forEach(function(name) {
        var el = form.querySelector('[name="' + name + '"]');
        if (el && s[name] !== null && s[name] !== undefined) el.value = s[name];
    });

    var phoneEl = form.querySelector('[name="student_phone"]');
    if (phoneEl) phoneEl.value = (s.student_phone || '').replace('+91', '');

    if (s.student_course_id) document.getElementById('saEditCourseSelect').value = s.student_course_id;
}

function saHandleUpdate(e) {
    e.preventDefault();
    var btn = document.getElementById('saEditUpdateBtn');
    btn.disabled = true;
    btn.textContent = 'Updating...';

    var formData = new FormData(document.getElementById('saEditForm'));
    formData.delete('registration_number');

    fetch(API_URL + '/admin/branch/update_student', {
        method: 'POST',
        body: formData
    })
    .then(function(r) { return r.json(); })
    .then(function(result) {
        if (result.error) {
            toastr.error(result.message || 'Failed to update');
            if (result.errors) Object.values(result.errors).forEach(function(msgs) { msgs.forEach(function(m) { toastr.error(m); }); });
        } else {
            toastr.success('Student updated successfully!');
        }
    })
    .catch(function() { toastr.error('Network error.'); })
    .finally(function() { btn.disabled = false; btn.textContent = 'Update Student'; });
}

function saHandleDelete() {
    if (!saEditStudent) return;
    if (!confirm('Are you sure you want to delete this student? This cannot be undone.')) return;

    var btn = document.getElementById('saEditDeleteBtn');
    btn.disabled = true;
    btn.textContent = 'Deleting...';

    fetch(API_URL + '/admin/branch/delete_student', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ student_id: saEditStudent.student_id })
    })
    .then(function(r) { return r.json(); })
    .then(function(result) {
        if (result.error) {
            toastr.error(result.message || 'Failed to delete');
            btn.disabled = false;
            btn.textContent = 'Delete Student';
        } else {
            toastr.success('Student deleted!');
            setTimeout(function() { window.location.href = '/admin-abc/all-students'; }, 1500);
        }
    })
    .catch(function() { toastr.error('Network error.'); btn.disabled = false; btn.textContent = 'Delete Student'; });
}
</script>
