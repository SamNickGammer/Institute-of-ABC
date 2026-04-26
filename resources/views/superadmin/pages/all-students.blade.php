<style>
    .sa-students-card {
        background: #fff; border-radius: 16px; border: 1px solid #e5e7eb; padding: 24px 28px;
    }
    .sa-stu-input {
        border: 1px solid #e5e7eb; border-radius: 10px; padding: 10px 14px; font-size: 13px;
        outline: none; transition: border-color 0.15s;
    }
    .sa-stu-input:focus { border-color: #111; }
    .sa-stu-select {
        border: 1px solid #e5e7eb; border-radius: 10px; padding: 10px 14px; font-size: 13px;
        outline: none; background: #fff; cursor: pointer;
    }
    .sa-stu-table { width: 100%; border-collapse: collapse; }
    .sa-stu-table th {
        font-size: 11px; text-transform: uppercase; letter-spacing: 0.05em;
        color: #9ca3af; padding: 10px 14px; border-bottom: 1px solid #f3f4f6; text-align: left;
    }
    .sa-stu-table td {
        padding: 12px 14px; font-size: 13px; border-bottom: 1px solid #f9fafb;
    }
    .sa-stu-table tr:hover td { background: #f9fafb; }
    .sa-stu-badge {
        display: inline-block; padding: 3px 10px; border-radius: 20px; font-size: 11px;
    }
    .sa-stu-pagination {
        display: flex; align-items: center; justify-content: space-between;
        gap: 12px; padding-top: 18px; flex-wrap: wrap;
    }
    .sa-stu-page-btn {
        border: 1px solid #e5e7eb; background: #fff; color: #111;
        border-radius: 10px; padding: 9px 14px; font-size: 12px; cursor: pointer;
    }
    .sa-stu-page-btn:disabled { opacity: 0.45; cursor: not-allowed; }
</style>

<div class="sa-students-card">
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;">
        <h1 class="font-HellixB" style="font-size:20px;margin:0;">All Students</h1>
        <div class="font-HellixR" style="font-size:13px;color:#9ca3af;">
            <span id="saStudentCount" class="font-HellixB">0</span> students
        </div>
    </div>

    <div style="display:flex;gap:12px;margin-bottom:20px;flex-wrap:wrap;align-items:center;">
        <input type="text" id="saSearch" class="sa-stu-input font-HellixR" placeholder="Search by name, parents, reg no, phone..." style="width:300px;">
        <select id="saBranchFilter" class="sa-stu-select font-HellixR">
            <option value="all">All Branches</option>
        </select>
        <select id="saStatusFilter" class="sa-stu-select font-HellixR">
            <option value="all">All Status</option>
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
            <option value="pending">Marksheet Pending</option>
            <option value="verified">Verified</option>
            <option value="certified">Certified</option>
        </select>
    </div>

    <div id="saStudentsLoading" class="flex justify-center py-10">
        @include('admin.components.spinner', ['class' => ''])
    </div>

    <div id="saNoStudents" class="hidden" style="text-align:center;padding:40px;color:#9ca3af;">
        <p class="font-HellixB" style="font-size:16px;">No students found</p>
        <p class="font-HellixR" style="font-size:13px;margin-top:4px;">Try changing your filters.</p>
    </div>

    <div id="saTableWrapper" class="hidden" style="overflow-x:auto;">
        <table class="sa-stu-table">
            <thead>
                <tr>
                    <th class="font-HellixB">Reg No</th>
                    <th class="font-HellixB">Student Name</th>
                    <th class="font-HellixB">Father Name</th>
                    <th class="font-HellixB">Branch</th>
                    <th class="font-HellixB">Course</th>
                    <th class="font-HellixB">Phone</th>
                    <th class="font-HellixB">Admission</th>
                    <th class="font-HellixB">Status</th>
                </tr>
            </thead>
            <tbody id="saStudentsBody"></tbody>
        </table>
        <div id="saStudentsPagination" class="sa-stu-pagination hidden">
            <div id="saStudentsPageInfo" class="font-HellixR" style="font-size:12px;color:#6b7280;"></div>
            <div style="display:flex;gap:10px;">
                <button id="saPrevPageBtn" type="button" class="sa-stu-page-btn font-HellixB">Previous</button>
                <button id="saNextPageBtn" type="button" class="sa-stu-page-btn font-HellixB">Next</button>
            </div>
        </div>
    </div>
</div>

<script>
var saBranches = [];
var saStudentPagination = null;
var saStudentSearchTimer = null;

document.addEventListener('DOMContentLoaded', function() {
    verifyAdminAccess(function(session) {
        loadBranches();
        loadAllStudents(session, 1);
    });

    document.getElementById('saSearch').addEventListener('input', function() {
        clearTimeout(saStudentSearchTimer);
        saStudentSearchTimer = setTimeout(function() {
            saLoadStudentsForCurrentFilters(1);
        }, 300);
    });
    document.getElementById('saBranchFilter').addEventListener('change', function() { saLoadStudentsForCurrentFilters(1); });
    document.getElementById('saStatusFilter').addEventListener('change', function() { saLoadStudentsForCurrentFilters(1); });
    document.getElementById('saPrevPageBtn').addEventListener('click', function() {
        if (saStudentPagination && saStudentPagination.current_page > 1) {
            saLoadStudentsForCurrentFilters(saStudentPagination.current_page - 1);
        }
    });
    document.getElementById('saNextPageBtn').addEventListener('click', function() {
        if (saStudentPagination && saStudentPagination.current_page < saStudentPagination.last_page) {
            saLoadStudentsForCurrentFilters(saStudentPagination.current_page + 1);
        }
    });
});

function loadBranches() {
    var session = getAdminData();
    if (!session) return;
    fetch(API_URL + '/admin/branch/getAll', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ admin_branch_id: session.adminData.branch_id })
    })
    .then(function(r) { return r.json(); })
    .then(function(result) {
        if (!result.error && result.data) {
            saBranches = result.data.filter(function(b) { return b.role !== 'admin'; });
            var select = document.getElementById('saBranchFilter');
            saBranches.forEach(function(b) {
                var opt = document.createElement('option');
                opt.value = b.id;
                opt.textContent = b.branch_name + ' (' + b.branch_code + ')';
                select.appendChild(opt);
            });
        }
    });
}

function saLoadStudentsForCurrentFilters(page) {
    var session = getAdminData();
    if (!session) return;
    loadAllStudents(session, page || 1);
}

function loadAllStudents(session, page) {
    document.getElementById('saStudentsLoading').style.display = 'flex';
    document.getElementById('saNoStudents').classList.add('hidden');
    document.getElementById('saTableWrapper').classList.add('hidden');

    var branchFilter = document.getElementById('saBranchFilter').value;
    var statusFilter = document.getElementById('saStatusFilter').value;
    var query = document.getElementById('saSearch').value.trim();

    fetch(API_URL + '/admin/get_all_students_all_branches', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            admin_branch_id: session.adminData.branch_id,
            page: page || 1,
            per_page: 20,
            search: query || null,
            filter_branch_id: branchFilter !== 'all' ? parseInt(branchFilter, 10) : null,
            status: statusFilter || 'all'
        })
    })
    .then(function(r) { return r.json(); })
    .then(function(result) {
        document.getElementById('saStudentsLoading').style.display = 'none';
        if (result.error || !result.data || result.data.length === 0) {
            saStudentPagination = result.pagination || null;
            document.getElementById('saStudentCount').textContent = saStudentPagination ? saStudentPagination.total : 0;
            document.getElementById('saStudentsPagination').classList.add('hidden');
            document.getElementById('saNoStudents').classList.remove('hidden');
            return;
        }
        saStudentPagination = result.pagination || null;
        renderSaStudents(result.data);
    })
    .catch(function() {
        document.getElementById('saStudentsLoading').innerHTML = '<p style="color:#dc2626;">Failed to load students.</p>';
    });
}

function renderSaStudents(students) {
    var wrapper = document.getElementById('saTableWrapper');
    var noEl = document.getElementById('saNoStudents');
    var total = saStudentPagination ? saStudentPagination.total : students.length;
    document.getElementById('saStudentCount').textContent = total;

    if (students.length === 0) {
        wrapper.classList.add('hidden');
        noEl.classList.remove('hidden');
        document.getElementById('saStudentsPagination').classList.add('hidden');
        return;
    }

    noEl.classList.add('hidden');
    wrapper.classList.remove('hidden');

    var tbody = document.getElementById('saStudentsBody');
    tbody.innerHTML = students.map(function(s) {
        var statusText, statusStyle;
        if (s.is_certificate_approve) { statusText = 'Certified'; statusStyle = 'background:#dbeafe;color:#1d4ed8;'; }
        else if (s.marksheet_stage === 'verified') { statusText = 'Verified'; statusStyle = 'background:#f3e8ff;color:#7c3aed;'; }
        else if (s.marksheet_stage === 'pending') { statusText = 'Pending'; statusStyle = 'background:#fef9c3;color:#a16207;'; }
        else if (s.is_student_active) { statusText = 'Active'; statusStyle = 'background:#dcfce7;color:#15803d;'; }
        else { statusText = 'Inactive'; statusStyle = 'background:#fee2e2;color:#dc2626;'; }

        return '<tr>' +
            '<td class="font-HellixB"><a href="/admin-abc/student?id=' + s.student_id + '" style="color:#111;text-decoration:none;" onmouseover="this.style.textDecoration=\'underline\'" onmouseout="this.style.textDecoration=\'none\'">' + saEsc(s.registration_number) + '</a></td>' +
            '<td class="font-HellixR"><a href="/admin-abc/student?id=' + s.student_id + '" style="color:#111;text-decoration:none;" onmouseover="this.style.textDecoration=\'underline\'" onmouseout="this.style.textDecoration=\'none\'">' + saEsc(s.student_name || '-') + '</a></td>' +
            '<td class="font-HellixR">' + saEsc(s.student_father_name || '-') + '</td>' +
            '<td class="font-HellixR" style="font-size:12px;">' + saEsc(s.branch_name || '-') + '<div style="font-size:10px;color:#9ca3af;">' + saEsc(s.branch_code || '') + '</div></td>' +
            '<td class="font-HellixR">' + saEsc(s.short_form || s.course_name || '-') + '</td>' +
            '<td class="font-HellixR">' + saEsc(s.student_phone || '-') + '</td>' +
            '<td class="font-HellixR" style="font-size:12px;color:#6b7280;">' + saEsc(s.admission_date || '-') + '</td>' +
            '<td><span class="sa-stu-badge font-HellixB" style="' + statusStyle + '">' + statusText + '</span></td>' +
        '</tr>';
    }).join('');

    saRenderPagination();
}

function saRenderPagination() {
    var paginationEl = document.getElementById('saStudentsPagination');
    var infoEl = document.getElementById('saStudentsPageInfo');

    if (!saStudentPagination || saStudentPagination.last_page <= 1) {
        paginationEl.classList.add('hidden');
        return;
    }

    paginationEl.classList.remove('hidden');
    infoEl.textContent = 'Showing ' + (saStudentPagination.from || 0) + '-' + (saStudentPagination.to || 0) + ' of ' + saStudentPagination.total + ' students';
    document.getElementById('saPrevPageBtn').disabled = saStudentPagination.current_page <= 1;
    document.getElementById('saNextPageBtn').disabled = saStudentPagination.current_page >= saStudentPagination.last_page;
}

function saEsc(text) {
    if (!text) return '';
    var d = document.createElement('div');
    d.textContent = text;
    return d.innerHTML;
}
</script>
