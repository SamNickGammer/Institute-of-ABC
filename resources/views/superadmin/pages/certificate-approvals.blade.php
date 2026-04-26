<style>
    .sa-cert-card {
        background: #fff; border-radius: 16px; border: 1px solid #e5e7eb; padding: 24px 28px;
    }
    .sa-cert-table { width: 100%; border-collapse: collapse; }
    .sa-cert-table th {
        font-size: 11px; text-transform: uppercase; letter-spacing: 0.05em;
        color: #9ca3af; padding: 10px 14px; border-bottom: 1px solid #f3f4f6; text-align: left;
    }
    .sa-cert-table td {
        padding: 12px 14px; font-size: 13px; border-bottom: 1px solid #f9fafb;
    }
    .sa-cert-table tr:hover td { background: #f9fafb; }
    .sa-approve-btn {
        background: #111; color: #fff; border: none; border-radius: 8px;
        padding: 7px 16px; font-size: 12px; cursor: pointer; transition: all 0.15s;
    }
    .sa-approve-btn:hover { background: #16a34a; }
    .sa-approve-btn:disabled { opacity: 0.4; cursor: not-allowed; }
    .sa-cert-modal-overlay {
        position: fixed; top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(0,0,0,0.5); z-index: 9999;
        display: flex; align-items: center; justify-content: center;
    }
    .sa-cert-modal {
        background: #fff; border-radius: 16px; padding: 32px;
        width: 100%; max-width: 420px; box-shadow: 0 20px 60px rgba(0,0,0,0.2);
    }
    .sa-cert-modal-input {
        width: 100%; border: 1px solid #e5e7eb; border-radius: 10px;
        padding: 10px 14px; font-size: 13px; outline: none; box-sizing: border-box;
    }
    .sa-cert-modal-input:focus { border-color: #111; }
    .sa-cert-select {
        border: 1px solid #e5e7eb; border-radius: 10px; padding: 10px 14px; font-size: 13px;
        outline: none; background: #fff; cursor: pointer;
    }
    .sa-cert-pagination {
        display: flex; align-items: center; justify-content: space-between;
        gap: 12px; flex-wrap: wrap; padding-top: 18px;
    }
    .sa-cert-page-btn {
        border: 1px solid #e5e7eb; background: #fff; color: #111;
        border-radius: 10px; padding: 9px 14px; font-size: 12px; cursor: pointer;
    }
    .sa-cert-page-btn:disabled { opacity: 0.45; cursor: not-allowed; }
</style>

<div class="sa-cert-card">
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;">
        <div>
            <h1 class="font-HellixB" style="font-size:20px;margin:0 0 4px;">Certificate Approvals</h1>
            <p class="font-HellixR" style="font-size:13px;color:#9ca3af;margin:0;">Approve pending marksheets and issue certificates</p>
        </div>
        <div class="font-HellixR" style="font-size:13px;color:#9ca3af;">
            <span id="saPendingCount" class="font-HellixB" style="color:#ca8a04;">0</span> pending
        </div>
    </div>

    {{-- Filters --}}
    <div style="display:flex;gap:12px;margin-bottom:20px;align-items:center;">
        <select id="saCertBranchFilter" class="sa-cert-select font-HellixR">
            <option value="all">All Branches</option>
        </select>
        <input type="text" id="saCertSearch" class="sa-cert-modal-input font-HellixR" placeholder="Search by name or reg no..." style="width:280px;">
    </div>

    <div id="saCertLoading" class="flex justify-center py-10">
        @include('admin.components.spinner', ['class' => ''])
    </div>

    <div id="saCertEmpty" class="hidden" style="text-align:center;padding:40px;color:#9ca3af;">
        <svg width="48" height="48" fill="none" stroke="#d1d5db" viewBox="0 0 24 24" style="margin:0 auto 12px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <p class="font-HellixB" style="font-size:16px;color:#6b7280;">All caught up!</p>
        <p class="font-HellixR" style="font-size:13px;">No pending approvals at the moment.</p>
    </div>

    <div id="saCertTableWrapper" class="hidden" style="overflow-x:auto;">
        <table class="sa-cert-table">
            <thead>
                <tr>
                    <th class="font-HellixB">Reg No</th>
                    <th class="font-HellixB">Student</th>
                    <th class="font-HellixB">Branch</th>
                    <th class="font-HellixB">Course</th>
                    <th class="font-HellixB">Admission</th>
                    <th class="font-HellixB">Overall %</th>
                    <th class="font-HellixB" style="text-align:right;">Action</th>
                </tr>
            </thead>
            <tbody id="saCertBody"></tbody>
        </table>
        <div id="saCertPagination" class="sa-cert-pagination hidden">
            <div id="saCertPageInfo" class="font-HellixR" style="font-size:12px;color:#6b7280;"></div>
            <div style="display:flex;gap:10px;">
                <button id="saCertPrevBtn" type="button" class="sa-cert-page-btn font-HellixB">Previous</button>
                <button id="saCertNextBtn" type="button" class="sa-cert-page-btn font-HellixB">Next</button>
            </div>
        </div>
    </div>
</div>

{{-- Approval Modal --}}
<div id="saApproveModal" class="sa-cert-modal-overlay" style="display:none;">
    <div class="sa-cert-modal">
        <h2 class="font-HellixB" style="font-size:18px;margin:0 0 4px;">Approve Certificate</h2>
        <p id="saApproveStudentInfo" class="font-HellixR" style="font-size:13px;color:#6b7280;margin:0 0 20px;"></p>

        <div style="margin-bottom:16px;">
            <label class="font-HellixB" style="display:block;font-size:11px;color:#6b7280;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:6px;">Certified Date</label>
            <input type="date" id="saCertDate" class="sa-cert-modal-input font-HellixR">
        </div>
        <div style="margin-bottom:24px;">
            <label class="font-HellixB" style="display:block;font-size:11px;color:#6b7280;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:6px;">Marksheet ID</label>
            <input type="text" id="saCertMarksheetId" class="sa-cert-modal-input font-HellixR" placeholder="Enter marksheet ID">
            <p class="font-HellixR" style="font-size:11px;color:#9ca3af;margin:4px 0 0;">Auto-filled with next available ID. You can change it.</p>
        </div>

        <div style="display:flex;gap:12px;justify-content:flex-end;">
            <button onclick="closeApproveModal()" class="font-HellixB" style="background:#f3f4f6;color:#111;border:none;border-radius:8px;padding:10px 20px;font-size:13px;cursor:pointer;">Cancel</button>
            <button id="saConfirmApproveBtn" onclick="showConfirmModal()" class="font-HellixB" style="background:#16a34a;color:#fff;border:none;border-radius:8px;padding:10px 20px;font-size:13px;cursor:pointer;">Approve & Issue</button>
        </div>
    </div>
</div>

{{-- Confirmation Modal --}}
<div id="saConfirmModal" class="sa-cert-modal-overlay" style="display:none;">
    <div class="sa-cert-modal" style="text-align:center;">
        <div style="width:56px;height:56px;border-radius:50%;background:#fef9c3;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
            <svg width="28" height="28" fill="none" stroke="#a16207" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
        </div>
        <h2 class="font-HellixB" style="font-size:18px;margin:0 0 8px;">Confirm Marksheet ID</h2>
        <p class="font-HellixR" style="font-size:13px;color:#6b7280;margin:0 0 16px;">Please confirm the marksheet ID before proceeding. This cannot be changed later.</p>
        <div style="background:#f9fafb;border:1px solid #e5e7eb;border-radius:12px;padding:16px;margin-bottom:20px;">
            <div class="font-HellixR" style="font-size:11px;color:#9ca3af;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:4px;">Marksheet ID</div>
            <div id="saConfirmMarksheetDisplay" class="font-HellixB" style="font-size:24px;color:#111;letter-spacing:0.1em;"></div>
            <div id="saConfirmStudentDisplay" class="font-HellixR" style="font-size:12px;color:#6b7280;margin-top:6px;"></div>
        </div>
        <div style="display:flex;gap:12px;justify-content:center;">
            <button onclick="closeConfirmModal()" class="font-HellixB" style="background:#f3f4f6;color:#111;border:none;border-radius:8px;padding:10px 24px;font-size:13px;cursor:pointer;">Go Back</button>
            <button id="saFinalApproveBtn" onclick="finalApprove()" class="font-HellixB" style="background:#16a34a;color:#fff;border:none;border-radius:8px;padding:10px 24px;font-size:13px;cursor:pointer;">Yes, Approve</button>
        </div>
    </div>
</div>

<script>
var saCurrentPendingStudents = [];
var saApproveTarget = null;
var saCertBranches = [];
var saCertPagination = null;
var saCertSearchTimer = null;

document.addEventListener('DOMContentLoaded', function() {
    verifyAdminAccess(function(session) {
        loadCertBranches(session);
        loadPendingStudents(session, 1);
    });

    document.getElementById('saCertBranchFilter').addEventListener('change', function() { saLoadPendingForCurrentFilters(1); });
    document.getElementById('saCertSearch').addEventListener('input', function() {
        clearTimeout(saCertSearchTimer);
        saCertSearchTimer = setTimeout(function() {
            saLoadPendingForCurrentFilters(1);
        }, 300);
    });
    document.getElementById('saCertPrevBtn').addEventListener('click', function() {
        if (saCertPagination && saCertPagination.current_page > 1) {
            saLoadPendingForCurrentFilters(saCertPagination.current_page - 1);
        }
    });
    document.getElementById('saCertNextBtn').addEventListener('click', function() {
        if (saCertPagination && saCertPagination.current_page < saCertPagination.last_page) {
            saLoadPendingForCurrentFilters(saCertPagination.current_page + 1);
        }
    });
});

function loadCertBranches(session) {
    fetch(API_URL + '/admin/branch/getAll', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ admin_branch_id: session.adminData.branch_id })
    })
    .then(function(r) { return r.json(); })
    .then(function(result) {
        if (!result.error && result.data) {
            saCertBranches = result.data.filter(function(b) { return b.role !== 'admin'; });
            var select = document.getElementById('saCertBranchFilter');
            saCertBranches.forEach(function(b) {
                var opt = document.createElement('option');
                opt.value = b.id;
                opt.textContent = b.branch_name + ' (' + b.branch_code + ')';
                select.appendChild(opt);
            });
        }
    });
}

function saLoadPendingForCurrentFilters(page) {
    var session = getAdminData();
    if (!session) return;
    loadPendingStudents(session, page || 1);
}

function loadPendingStudents(session, page) {
    document.getElementById('saCertLoading').style.display = 'flex';
    document.getElementById('saCertEmpty').classList.add('hidden');
    document.getElementById('saCertTableWrapper').classList.add('hidden');

    var branchFilter = document.getElementById('saCertBranchFilter').value;
    var query = document.getElementById('saCertSearch').value.trim();

    fetch(API_URL + '/admin/get_all_students_all_branches', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            admin_branch_id: session.adminData.branch_id,
            list_type: 'certificate_pending',
            page: page || 1,
            per_page: 20,
            search: query || null,
            filter_branch_id: branchFilter !== 'all' ? parseInt(branchFilter, 10) : null
        })
    })
    .then(function(r) { return r.json(); })
    .then(function(result) {
        document.getElementById('saCertLoading').style.display = 'none';
        if (result.error || !result.data) {
            saCertPagination = null;
            saCurrentPendingStudents = [];
            document.getElementById('saPendingCount').textContent = '0';
            document.getElementById('saCertPagination').classList.add('hidden');
            document.getElementById('saCertEmpty').classList.remove('hidden');
            return;
        }

        saCurrentPendingStudents = result.data || [];
        saCertPagination = result.pagination || null;
        document.getElementById('saPendingCount').textContent = saCertPagination ? saCertPagination.total : saCurrentPendingStudents.length;

        if (saCurrentPendingStudents.length === 0) {
            document.getElementById('saCertPagination').classList.add('hidden');
            document.getElementById('saCertEmpty').classList.remove('hidden');
            return;
        }

        renderPendingTable();
    })
    .catch(function() {
        document.getElementById('saCertLoading').innerHTML = '<p style="color:#dc2626;">Failed to load data.</p>';
    });
}

function renderPendingTable() {
    document.getElementById('saCertTableWrapper').classList.remove('hidden');
    var tbody = document.getElementById('saCertBody');

    tbody.innerHTML = saCurrentPendingStudents.map(function(s, i) {
        var overallPct = s.overall_percent ? s.overall_percent + '%' : '-';

        return '<tr>' +
            '<td class="font-HellixB"><a href="/admin-abc/student?id=' + s.student_id + '" style="color:#111;text-decoration:none;" onmouseover="this.style.textDecoration=\'underline\'" onmouseout="this.style.textDecoration=\'none\'">' + saEsc(s.registration_number) + '</a></td>' +
            '<td class="font-HellixR"><a href="/admin-abc/student?id=' + s.student_id + '" style="color:#111;text-decoration:none;" onmouseover="this.style.textDecoration=\'underline\'" onmouseout="this.style.textDecoration=\'none\'">' + saEsc(s.student_name || '-') + '</a></td>' +
            '<td class="font-HellixR" style="font-size:12px;">' + saEsc(s.branch_name || '-') + '<div style="font-size:10px;color:#9ca3af;">' + saEsc(s.branch_code || '') + '</div></td>' +
            '<td class="font-HellixR">' + saEsc(s.short_form || s.course_name || '-') + '</td>' +
            '<td class="font-HellixR" style="font-size:12px;color:#6b7280;">' + saEsc(s.admission_date || '-') + '</td>' +
            '<td class="font-HellixR" style="font-size:12px;">' + overallPct + '</td>' +
            '<td style="text-align:right;display:flex;gap:6px;justify-content:flex-end;">' +
                '<a href="/admin-abc/student?id=' + s.student_id + '" class="font-HellixB" style="background:#f3f4f6;color:#111;border:none;border-radius:8px;padding:7px 12px;font-size:12px;text-decoration:none;display:inline-block;">View</a>' +
                '<button class="sa-approve-btn font-HellixB" onclick="openApproveModal(' + i + ')">Approve</button>' +
            '</td>' +
        '</tr>';
    }).join('');

    saRenderCertPagination();
}

function openApproveModal(index) {
    saApproveTarget = saCurrentPendingStudents[index];
    document.getElementById('saApproveStudentInfo').textContent =
        saApproveTarget.student_name + ' (' + saApproveTarget.registration_number + ') - ' + (saApproveTarget.branch_name || '');

    var today = new Date().toISOString().split('T')[0];
    document.getElementById('saCertDate').value = today;

    // Fetch next marksheet ID (editable)
    fetch(API_URL + '/admin/branch/student/get_next_marksheet_no')
    .then(function(r) { return r.text(); })
    .then(function(id) {
        document.getElementById('saCertMarksheetId').value = id.replace(/"/g, '');
    });

    document.getElementById('saApproveModal').style.display = 'flex';
}

function closeApproveModal() {
    document.getElementById('saApproveModal').style.display = 'none';
    saApproveTarget = null;
}

function showConfirmModal() {
    if (!saApproveTarget) return;
    var certDate = document.getElementById('saCertDate').value;
    var marksheetId = document.getElementById('saCertMarksheetId').value.trim();

    if (!certDate) { toastr.error('Please select a certification date.'); return; }
    if (!marksheetId) { toastr.error('Please enter a marksheet ID.'); return; }

    // Show confirmation modal
    document.getElementById('saConfirmMarksheetDisplay').textContent = marksheetId;
    document.getElementById('saConfirmStudentDisplay').textContent =
        saApproveTarget.student_name + ' - ' + saApproveTarget.registration_number;
    document.getElementById('saApproveModal').style.display = 'none';
    document.getElementById('saConfirmModal').style.display = 'flex';
}

function closeConfirmModal() {
    document.getElementById('saConfirmModal').style.display = 'none';
    document.getElementById('saApproveModal').style.display = 'flex';
}

function finalApprove() {
    if (!saApproveTarget) return;
    var session = getAdminData();
    if (!session) return;

    var certDate = document.getElementById('saCertDate').value;
    var marksheetId = document.getElementById('saCertMarksheetId').value.trim();
    var btn = document.getElementById('saFinalApproveBtn');

    btn.disabled = true;
    btn.textContent = 'Approving...';

    fetch(API_URL + '/admin/branch/student/add_certification', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            student_id: saApproveTarget.student_id,
            branch_id: session.adminData.branch_id,
            certified_date: certDate,
            marksheet_id: marksheetId || null
        })
    })
    .then(function(r) { return r.json(); })
    .then(function(result) {
        btn.disabled = false;
        btn.textContent = 'Yes, Approve';

        if (result.error) {
            toastr.error(result.message || 'Failed to approve.');
            return;
        }

        toastr.success('Certificate approved for ' + saApproveTarget.student_name + ' (ID: ' + marksheetId + ')');
        document.getElementById('saConfirmModal').style.display = 'none';

        var reloadPage = saCertPagination ? saCertPagination.current_page : 1;
        if (saCertPagination && saCurrentPendingStudents.length === 1 && saCertPagination.current_page > 1) {
            reloadPage = saCertPagination.current_page - 1;
        }

        saApproveTarget = null;
        saLoadPendingForCurrentFilters(reloadPage);
    })
    .catch(function() {
        toastr.error('Network error. Please try again.');
        btn.disabled = false;
        btn.textContent = 'Yes, Approve';
    });
}

function saEsc(text) {
    if (!text) return '';
    var d = document.createElement('div');
    d.textContent = text;
    return d.innerHTML;
}

function saRenderCertPagination() {
    var paginationEl = document.getElementById('saCertPagination');
    var infoEl = document.getElementById('saCertPageInfo');

    if (!saCertPagination || saCertPagination.last_page <= 1) {
        paginationEl.classList.add('hidden');
        return;
    }

    paginationEl.classList.remove('hidden');
    infoEl.textContent = 'Showing ' + (saCertPagination.from || 0) + '-' + (saCertPagination.to || 0) + ' of ' + saCertPagination.total + ' pending approvals';
    document.getElementById('saCertPrevBtn').disabled = saCertPagination.current_page <= 1;
    document.getElementById('saCertNextBtn').disabled = saCertPagination.current_page >= saCertPagination.last_page;
}
</script>
