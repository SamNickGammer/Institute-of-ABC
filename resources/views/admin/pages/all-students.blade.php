<div>
    <div class="max-w-full mx-auto bg-white rounded-lg shadow-md p-6">
        {{-- Header --}}
        <div class="flex items-center justify-between mb-5">
            <h1 class="text-2xl font-HellixB">All Students</h1>
            <a href="{{ route('branch.addStudent') }}"
                class="bg-black text-white px-5 py-2 rounded-lg font-HellixB text-sm hover:bg-gray-800 whitespace-nowrap">
                + Add Student
            </a>
        </div>

        {{-- Search & Filters --}}
        <div class="flex flex-wrap gap-3 mb-4 items-center">
            <input type="text" id="searchInput" placeholder="Search by name, reg no, phone, father..."
                class="border border-gray-300 rounded-lg px-4 py-2 text-sm w-80 focus:outline-none focus:border-black">

            <select id="certFilter" class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-black">
                <option value="all">All Students</option>
                <option value="no_cert">No Certificate</option>
                <option value="pending">Marksheet Pending</option>
                <option value="verified">Verified</option>
                <option value="certified">Certified</option>
                <option value="active">Active Only</option>
                <option value="inactive">Inactive</option>
            </select>

            {{-- Column Toggle --}}
            <div class="relative">
                <button id="colToggleBtn" type="button"
                    class="border border-gray-300 rounded-lg px-3 py-2 text-sm hover:bg-gray-50 flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/></svg>
                    Columns
                </button>
                <div id="colToggleMenu" class="hidden absolute top-full left-0 mt-1 bg-white border border-gray-200 rounded-lg shadow-lg z-50 p-3 w-56 max-h-64 overflow-y-auto">
                    <div class="text-xs text-gray-500 font-HellixB mb-2 uppercase">Toggle Columns</div>
                    <div id="colCheckboxes"></div>
                </div>
            </div>

        <div class="ml-auto text-sm text-gray-500 font-HellixR">
                <span id="studentCount" class="font-HellixB">0</span> students
            </div>
        </div>

        {{-- Loading --}}
        <div id="studentsLoading" class="flex justify-center py-10">
            @include('admin.components.spinner', ['class' => ''])
        </div>

        {{-- Empty --}}
        <div id="noStudents" class="hidden text-center py-10 text-gray-500">
            <p class="text-lg font-HellixB">No students found</p>
            <p class="text-sm mt-1">Try changing your filters or add a new student.</p>
        </div>

        {{-- Table --}}
        <div id="studentsTableWrapper" class="hidden">
            <div class="border border-gray-200 rounded-lg overflow-hidden">
                <div class="overflow-x-auto" id="tableScroll">
                    <table class="w-full text-sm text-left whitespace-nowrap" id="studentsTable">
                        <thead class="bg-gray-50 border-b" id="tableHead"></thead>
                        <tbody id="studentsTableBody"></tbody>
                    </table>
                </div>
            </div>
            <div id="studentsPagination" class="flex items-center justify-between gap-3 mt-4 flex-wrap pt10">
                <div id="studentsPageInfo" class="text-sm text-gray-500 font-HellixR"></div>
                <div class="flex items-center gap-2">
                    <button id="prevPageBtn" type="button" class="border border-gray-300 bg-white text-black px-4 py-2 rounded-lg text-sm font-HellixB disabled:opacity-40 disabled:cursor-not-allowed">Previous</button>
                    <button id="nextPageBtn" type="button" class="border border-gray-300 bg-white text-black px-4 py-2 rounded-lg text-sm font-HellixB disabled:opacity-40 disabled:cursor-not-allowed">Next</button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    #tableScroll { scroll-behavior: smooth; }

    /* Sticky left columns */
    #studentsTable .sticky-left {
        position: sticky;
        z-index: 10;
        background-color: #ffffff;
    }
    /* Sticky right (action) column */
    #studentsTable .sticky-right {
        position: sticky;
        right: 0;
        z-index: 10;
        background-color: #ffffff;
    }
    /* Header sticky cells need higher z-index */
    #studentsTable thead .sticky-left,
    #studentsTable thead .sticky-right {
        z-index: 20;
        background-color: #f9fafb;
    }
    /* Shadow on the last sticky-left column to show scroll boundary */
    #studentsTable .sticky-left-last {
        box-shadow: 4px 0 6px -2px rgba(0,0,0,0.08);
    }
    #studentsTable .sticky-right {
        box-shadow: -4px 0 6px -2px rgba(0,0,0,0.08);
    }
    /* Hover: override bg on ALL cells in the row */
    #studentsTable tbody tr:hover .sticky-left,
    #studentsTable tbody tr:hover .sticky-right,
    #studentsTable tbody tr:hover td {
        background-color: #f3f4f6;
    }
</style>

<script>
var currentStudents = [];
var studentPagination = null;
var studentSearchTimer = null;

var ALL_COLUMNS = [
    { key: 'registration_number', label: 'Reg No', default: true, sticky: true },
    { key: 'student_name', label: 'Name', default: true, sticky: true },
    { key: 'student_father_name', label: 'Father Name', default: true },
    { key: 'short_form', label: 'Course', default: true },
    { key: 'student_phone', label: 'Phone', default: true },
    { key: 'admission_date', label: 'Admission', default: true },
    { key: 'status', label: 'Status', default: true },
    { key: 'student_email', label: 'Email', default: false },
    { key: 'student_mother_name', label: 'Mother Name', default: false },
    { key: 'dob', label: 'DOB', default: false },
    { key: 'relieving_date', label: 'Relieving', default: false },
    { key: 'city', label: 'City', default: false },
    { key: 'state', label: 'State', default: false },
    { key: 'total_fees', label: 'Total Fees', default: false },
    { key: 'overall_percent', label: 'Percentage', default: false },
    { key: 'performance', label: 'Performance', default: false },
    { key: 'aadhaar_number', label: 'Aadhaar', default: false },
    { key: 'marksheet_stage', label: 'Marksheet', default: false },
];

var activeColumns = [];

function loadColumnPrefs() {
    var saved = localStorage.getItem('studentColumns');
    if (saved) {
        activeColumns = JSON.parse(saved);
    } else {
        activeColumns = ALL_COLUMNS.filter(function(c) { return c.default; }).map(function(c) { return c.key; });
    }
}

function saveColumnPrefs() {
    localStorage.setItem('studentColumns', JSON.stringify(activeColumns));
}

function buildColumnCheckboxes() {
    var container = document.getElementById('colCheckboxes');
    container.innerHTML = ALL_COLUMNS.map(function(col) {
        var checked = activeColumns.indexOf(col.key) !== -1 ? 'checked' : '';
        var disabled = col.sticky ? 'disabled' : '';
        return '<label class="flex items-center gap-2 py-1 text-sm cursor-pointer hover:bg-gray-50 px-1 rounded">' +
            '<input type="checkbox" ' + checked + ' ' + disabled + ' data-col="' + col.key + '" class="col-checkbox rounded">' +
            '<span class="' + (col.sticky ? 'text-gray-400' : '') + '">' + col.label + (col.sticky ? ' (fixed)' : '') + '</span>' +
        '</label>';
    }).join('');

    container.querySelectorAll('.col-checkbox').forEach(function(cb) {
        cb.addEventListener('change', function() {
            var key = this.dataset.col;
            if (this.checked) {
                if (activeColumns.indexOf(key) === -1) activeColumns.push(key);
            } else {
                activeColumns = activeColumns.filter(function(k) { return k !== key; });
            }
            saveColumnPrefs();
            renderStudents(currentStudents);
        });
    });
}

function getStatusInfo(s) {
    if (s.is_certificate_approve) return { bg: 'bg-blue-100 text-blue-700', text: 'Certified' };
    if (s.marksheet_stage === 'verified') return { bg: 'bg-purple-100 text-purple-700', text: 'Verified' };
    if (s.marksheet_stage === 'pending') return { bg: 'bg-yellow-100 text-yellow-700', text: 'Pending' };
    if (s.is_student_active) return { bg: 'bg-green-100 text-green-700', text: 'Active' };
    return { bg: 'bg-red-100 text-red-700', text: 'Inactive' };
}

function getCellValue(s, key) {
    if (key === 'status') {
        var st = getStatusInfo(s);
        return '<span class="px-2 py-0.5 rounded-full text-xs font-HellixB ' + st.bg + '">' + st.text + '</span>';
    }
    if (key === 'short_form') return escapeHtml(s.short_form || s.course_name || '');
    if (key === 'total_fees') return s.total_fees ? '₹' + parseFloat(s.total_fees).toLocaleString() : '-';
    if (key === 'overall_percent') return s.overall_percent ? s.overall_percent + '%' : '-';
    return escapeHtml(s[key] || '-');
}

function renderStudents(students) {
    var thead = document.getElementById('tableHead');
    var tbody = document.getElementById('studentsTableBody');
    var wrapper = document.getElementById('studentsTableWrapper');
    var noEl = document.getElementById('noStudents');
    var totalStudents = studentPagination ? studentPagination.total : students.length;

    if (students.length === 0) {
        wrapper.classList.add('hidden');
        noEl.classList.remove('hidden');
        document.getElementById('studentCount').textContent = totalStudents;
        document.getElementById('studentsPagination').classList.add('hidden');
        return;
    }

    noEl.classList.add('hidden');
    wrapper.classList.remove('hidden');
    document.getElementById('studentCount').textContent = totalStudents;

    var visibleCols = ALL_COLUMNS.filter(function(c) { return activeColumns.indexOf(c.key) !== -1; });

    // Find sticky columns and compute left positions
    var stickyCols = visibleCols.filter(function(c) { return c.sticky; });
    var stickyLeftPositions = {};
    var leftOffset = 0;
    var COL_WIDTHS = { registration_number: 140, student_name: 170 };
    stickyCols.forEach(function(col, i) {
        stickyLeftPositions[col.key] = leftOffset;
        leftOffset += (COL_WIDTHS[col.key] || 150);
    });
    var lastStickyKey = stickyCols.length > 0 ? stickyCols[stickyCols.length - 1].key : null;

    // Head
    thead.innerHTML = '<tr>' + visibleCols.map(function(col) {
        var cls = '';
        var style = '';
        if (col.sticky) {
            cls = 'sticky-left' + (col.key === lastStickyKey ? ' sticky-left-last' : '');
            style = 'left:' + stickyLeftPositions[col.key] + 'px;min-width:' + (COL_WIDTHS[col.key] || 150) + 'px;';
        }
        return '<th class="px-4 py-3 font-HellixB ' + cls + '" style="' + style + '">' + col.label + '</th>';
    }).join('') +
    '<th class="px-4 py-3 font-HellixB sticky-right" style="min-width:70px">Action</th></tr>';

    // Body
    tbody.innerHTML = students.map(function(s) {
        return '<tr class="border-b">' +
            visibleCols.map(function(col) {
                var cls = '';
                var style = '';
                if (col.sticky) {
                    cls = 'sticky-left' + (col.key === lastStickyKey ? ' sticky-left-last' : '');
                    style = 'left:' + stickyLeftPositions[col.key] + 'px;min-width:' + (COL_WIDTHS[col.key] || 150) + 'px;';
                }
                var content = getCellValue(s, col.key);
                // Make reg number a clickable link
                if (col.key === 'registration_number') {
                    content = '<a href="/branch/student?id=' + s.student_id + '" class="text-black font-HellixB hover:underline">' + escapeHtml(s.registration_number) + '</a>';
                }
                return '<td class="px-4 py-3 ' + cls + '" style="' + style + '">' + content + '</td>';
            }).join('') +
            '<td class="px-4 py-3 sticky-right" style="min-width:70px">' +
                '<a href="/branch/edit-student?id=' + s.student_id + '" class="text-gray-600 hover:text-black font-HellixB text-xs underline">Edit</a>' +
            '</td>' +
        '</tr>';
    }).join('');

    renderPagination();
}

function escapeHtml(text) {
    if (!text) return '';
    var div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

function renderPagination() {
    var paginationEl = document.getElementById('studentsPagination');
    var infoEl = document.getElementById('studentsPageInfo');

    if (!studentPagination || studentPagination.last_page <= 1) {
        paginationEl.classList.add('hidden');
        return;
    }

    paginationEl.classList.remove('hidden');
    infoEl.textContent = 'Showing ' + (studentPagination.from || 0) + '-' + (studentPagination.to || 0) + ' of ' + studentPagination.total + ' students';
    document.getElementById('prevPageBtn').disabled = studentPagination.current_page <= 1;
    document.getElementById('nextPageBtn').disabled = studentPagination.current_page >= studentPagination.last_page;
}

function loadStudentsPage(page) {
    var session = getBranchData();
    if (!session) return;

    document.getElementById('studentsLoading').style.display = 'flex';
    document.getElementById('noStudents').classList.add('hidden');
    document.getElementById('studentsTableWrapper').classList.add('hidden');

    fetch(API_URL + '/admin/branch/get_all_students', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            branch_id: session.branchData.branch_id,
            page: page || 1,
            per_page: 20,
            search: document.getElementById('searchInput').value.trim() || null,
            status: document.getElementById('certFilter').value || 'all'
        })
    })
    .then(function(r) { return r.json(); })
    .then(function(result) {
        document.getElementById('studentsLoading').style.display = 'none';

        if (result.error || !result.data) {
            studentPagination = null;
            currentStudents = [];
            document.getElementById('studentCount').textContent = '0';
            document.getElementById('studentsPagination').classList.add('hidden');
            document.getElementById('noStudents').classList.remove('hidden');
            return;
        }

        studentPagination = result.pagination || null;
        currentStudents = result.data || [];

        if (currentStudents.length === 0) {
            document.getElementById('studentCount').textContent = studentPagination ? studentPagination.total : 0;
            document.getElementById('studentsPagination').classList.add('hidden');
            document.getElementById('noStudents').classList.remove('hidden');
            return;
        }

        renderStudents(currentStudents);
    })
    .catch(function() {
        document.getElementById('studentsLoading').innerHTML = '<p class="text-red-500">Failed to load students</p>';
    });
}

document.addEventListener('DOMContentLoaded', function() {
    var session = getBranchData();
    if (!session) return;

    loadColumnPrefs();
    buildColumnCheckboxes();

    // Column toggle dropdown
    var toggleBtn = document.getElementById('colToggleBtn');
    var toggleMenu = document.getElementById('colToggleMenu');
    toggleBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        toggleMenu.classList.toggle('hidden');
    });
    document.addEventListener('click', function() { toggleMenu.classList.add('hidden'); });
    toggleMenu.addEventListener('click', function(e) { e.stopPropagation(); });

    // Search & filter
    document.getElementById('searchInput').addEventListener('input', function() {
        clearTimeout(studentSearchTimer);
        studentSearchTimer = setTimeout(function() {
            loadStudentsPage(1);
        }, 300);
    });
    document.getElementById('certFilter').addEventListener('change', function() { loadStudentsPage(1); });
    document.getElementById('prevPageBtn').addEventListener('click', function() {
        if (studentPagination && studentPagination.current_page > 1) {
            loadStudentsPage(studentPagination.current_page - 1);
        }
    });
    document.getElementById('nextPageBtn').addEventListener('click', function() {
        if (studentPagination && studentPagination.current_page < studentPagination.last_page) {
            loadStudentsPage(studentPagination.current_page + 1);
        }
    });

    loadStudentsPage(1);
});
</script>
