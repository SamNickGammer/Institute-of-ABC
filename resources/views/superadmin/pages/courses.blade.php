<style>
    .sa-course-card {
        background: #fff; border-radius: 16px; border: 1px solid #e5e7eb; padding: 24px 28px;
    }
    .sa-course-table { width: 100%; border-collapse: collapse; }
    .sa-course-table th {
        font-size: 11px; text-transform: uppercase; letter-spacing: 0.05em;
        color: #9ca3af; padding: 10px 14px; border-bottom: 1px solid #f3f4f6; text-align: left;
    }
    .sa-course-table td {
        padding: 12px 14px; font-size: 13px; border-bottom: 1px solid #f9fafb;
    }
    .sa-course-table tr:hover td { background: #f9fafb; }
    .sa-course-modal-overlay {
        position: fixed; top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(0,0,0,0.5); z-index: 9999;
        display: flex; align-items: center; justify-content: center;
    }
    .sa-course-modal {
        background: #fff; border-radius: 16px; padding: 32px;
        width: 100%; max-width: 460px; box-shadow: 0 20px 60px rgba(0,0,0,0.2);
    }
    .sa-course-input {
        width: 100%; border: 1px solid #e5e7eb; border-radius: 10px;
        padding: 10px 14px; font-size: 13px; outline: none;
    }
    .sa-course-input:focus { border-color: #111; }
    .sa-course-row { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 14px; }
    .sa-del-btn {
        background: none; border: none; color: #dc2626; cursor: pointer;
        font-size: 12px; padding: 4px 8px; border-radius: 6px; transition: all 0.15s;
    }
    .sa-del-btn:hover { background: #fef2f2; }
</style>

<div class="sa-course-card">
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;">
        <div>
            <h1 class="font-HellixB" style="font-size:20px;margin:0 0 4px;">Courses</h1>
            <p class="font-HellixR" style="font-size:13px;color:#9ca3af;margin:0;">Manage all available courses</p>
        </div>
        <button onclick="openAddCourse()" class="font-HellixB" style="background:#111;color:#fff;border:none;border-radius:10px;padding:10px 20px;font-size:13px;cursor:pointer;">+ Add Course</button>
    </div>

    <div id="saCourseLoading" class="flex justify-center py-10">
        @include('admin.components.spinner', ['class' => ''])
    </div>

    <div id="saCourseEmpty" class="hidden" style="text-align:center;padding:40px;color:#9ca3af;">
        <p class="font-HellixB" style="font-size:16px;">No courses found</p>
        <p class="font-HellixR" style="font-size:13px;margin-top:4px;">Add your first course to get started.</p>
    </div>

    <div id="saCourseTableWrapper" class="hidden" style="overflow-x:auto;">
        <table class="sa-course-table">
            <thead>
                <tr>
                    <th class="font-HellixB">Course Name</th>
                    <th class="font-HellixB">Short Form</th>
                    <th class="font-HellixB">Duration</th>
                    <th class="font-HellixB">Fees</th>
                    <th class="font-HellixB">Subjects</th>
                    <th class="font-HellixB">Status</th>
                    <th class="font-HellixB" style="text-align:right;">Action</th>
                </tr>
            </thead>
            <tbody id="saCourseBody"></tbody>
        </table>
    </div>
</div>

{{-- Add Course Modal --}}
<div id="saAddCourseModal" class="sa-course-modal-overlay" style="display:none;">
    <div class="sa-course-modal">
        <h2 class="font-HellixB" style="font-size:18px;margin:0 0 20px;">Add New Course</h2>
        <div class="sa-course-row">
            <div>
                <label class="font-HellixB" style="display:block;font-size:11px;color:#6b7280;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:6px;">Course Name *</label>
                <input type="text" id="acCourseName" class="sa-course-input font-HellixR" placeholder="e.g. Computer Science">
            </div>
            <div>
                <label class="font-HellixB" style="display:block;font-size:11px;color:#6b7280;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:6px;">Short Form *</label>
                <input type="text" id="acShortForm" class="sa-course-input font-HellixR" placeholder="e.g. CS" maxlength="10">
            </div>
        </div>
        <div class="sa-course-row">
            <div>
                <label class="font-HellixB" style="display:block;font-size:11px;color:#6b7280;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:6px;">Duration (months) *</label>
                <input type="number" id="acDuration" class="sa-course-input font-HellixR" placeholder="12" min="1">
            </div>
            <div>
                <label class="font-HellixB" style="display:block;font-size:11px;color:#6b7280;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:6px;">Fees *</label>
                <input type="number" id="acFees" class="sa-course-input font-HellixR" placeholder="10000" min="0">
            </div>
        </div>
        <div style="margin-bottom:20px;">
            <label class="font-HellixB" style="display:block;font-size:11px;color:#6b7280;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:6px;">Subjects (comma separated)</label>
            <input type="text" id="acSubjects" class="sa-course-input font-HellixR" placeholder="e.g. Math, Physics, Chemistry">
        </div>
        <div style="display:flex;gap:12px;justify-content:flex-end;">
            <button onclick="closeAddCourse()" class="font-HellixB" style="background:#f3f4f6;color:#111;border:none;border-radius:8px;padding:10px 20px;font-size:13px;cursor:pointer;">Cancel</button>
            <button id="acSubmitBtn" onclick="submitAddCourse()" class="font-HellixB" style="background:#111;color:#fff;border:none;border-radius:8px;padding:10px 20px;font-size:13px;cursor:pointer;">Add Course</button>
        </div>
    </div>
</div>

<script>
var saAllCourses = [];

document.addEventListener('DOMContentLoaded', function() {
    verifyAdminAccess(function(session) {
        loadCourses();
    });
});

function loadCourses() {
    document.getElementById('saCourseLoading').style.display = 'flex';
    document.getElementById('saCourseTableWrapper').classList.add('hidden');
    document.getElementById('saCourseEmpty').classList.add('hidden');

    fetch(API_URL + '/admin/branch/get_all_courses')
    .then(function(r) { return r.json(); })
    .then(function(result) {
        document.getElementById('saCourseLoading').style.display = 'none';
        if (result.error || !result.data || result.data.length === 0) {
            document.getElementById('saCourseEmpty').classList.remove('hidden');
            return;
        }

        saAllCourses = result.data;
        renderCourses();
    })
    .catch(function() {
        document.getElementById('saCourseLoading').innerHTML = '<p style="color:#dc2626;">Failed to load courses.</p>';
    });
}

function renderCourses() {
    document.getElementById('saCourseTableWrapper').classList.remove('hidden');
    var tbody = document.getElementById('saCourseBody');

    tbody.innerHTML = saAllCourses.map(function(c) {
        var subjects = c.subjects || '-';
        var statusStyle = c.course_status === 'active'
            ? 'background:#dcfce7;color:#15803d;'
            : 'background:#fee2e2;color:#dc2626;';
        var statusText = c.course_status === 'active' ? 'Active' : 'Inactive';

        return '<tr>' +
            '<td class="font-HellixB">' + saEsc(c.course_name) + '</td>' +
            '<td class="font-HellixR">' + saEsc(c.short_form) + '</td>' +
            '<td class="font-HellixR">' + c.course_duration + ' months</td>' +
            '<td class="font-HellixR">' + (c.course_fees ? '₹' + parseFloat(c.course_fees).toLocaleString() : '-') + '</td>' +
            '<td class="font-HellixR" style="max-width:200px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;" title="' + saEsc(subjects) + '">' + saEsc(subjects) + '</td>' +
            '<td><span class="font-HellixB" style="padding:3px 10px;border-radius:20px;font-size:11px;' + statusStyle + '">' + statusText + '</span></td>' +
            '<td style="text-align:right;"><button class="sa-del-btn font-HellixB" onclick="deleteCourse(' + c.course_id + ', \'' + saEsc(c.course_name).replace(/'/g, "\\'") + '\')">Delete</button></td>' +
        '</tr>';
    }).join('');
}

function openAddCourse() { document.getElementById('saAddCourseModal').style.display = 'flex'; }
function closeAddCourse() { document.getElementById('saAddCourseModal').style.display = 'none'; }

function submitAddCourse() {
    var btn = document.getElementById('acSubmitBtn');
    var data = {
        course_name: document.getElementById('acCourseName').value.trim(),
        short_form: document.getElementById('acShortForm').value.trim(),
        course_duration: parseInt(document.getElementById('acDuration').value) || 0,
        course_fees: parseFloat(document.getElementById('acFees').value) || 0,
        subjects: document.getElementById('acSubjects').value.trim(),
    };

    if (!data.course_name || !data.short_form || !data.course_duration || !data.course_fees) {
        toastr.error('Please fill all required fields.');
        return;
    }

    btn.disabled = true;
    btn.textContent = 'Adding...';

    fetch(API_URL + '/admin/branch/add_course', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data)
    })
    .then(function(r) { return r.json(); })
    .then(function(result) {
        btn.disabled = false;
        btn.textContent = 'Add Course';
        if (result.error) {
            toastr.error(result.message || 'Failed to add course.');
            return;
        }
        toastr.success('Course added successfully!');
        closeAddCourse();
        // Clear form
        document.getElementById('acCourseName').value = '';
        document.getElementById('acShortForm').value = '';
        document.getElementById('acDuration').value = '';
        document.getElementById('acFees').value = '';
        document.getElementById('acSubjects').value = '';
        loadCourses();
    })
    .catch(function() {
        btn.disabled = false;
        btn.textContent = 'Add Course';
        toastr.error('Network error.');
    });
}

function deleteCourse(courseId, courseName) {
    if (!confirm('Are you sure you want to delete "' + courseName + '"? This cannot be undone.')) return;

    fetch(API_URL + '/admin/branch/delete_course', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ course_id: courseId })
    })
    .then(function(r) { return r.json(); })
    .then(function(result) {
        if (result.error) {
            toastr.error(result.message || 'Failed to delete course.');
            return;
        }
        toastr.success('Course deleted successfully!');
        loadCourses();
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
