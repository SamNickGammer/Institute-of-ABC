<div>
    <div class="max-w-full mx-auto bg-white rounded-lg shadow-md p-6">
        {{-- Header --}}
        <div class="flex items-center justify-between mb-5">
            <div>
                <h1 class="text-2xl font-HellixB">Marksheet Management</h1>
                <p class="text-sm text-gray-400 font-HellixR mt-1">Students who need marksheet work (not verified / not certified)</p>
            </div>
            <div class="text-sm text-gray-500 font-HellixR">
                <span id="studentCount" class="font-HellixB">0</span> students
            </div>
        </div>

        {{-- Search --}}
        <div class="flex flex-wrap gap-3 mb-4 items-center">
            <input type="text" id="searchInput" placeholder="Search by name, reg no, course..."
                class="border border-gray-300 rounded-lg px-4 py-2 text-sm w-80 focus:outline-none focus:border-black">

            <select id="stageFilter" class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-black">
                <option value="all">All Stages</option>
                <option value="no_marks">No Marks Added</option>
                <option value="pending">Pending Review</option>
            </select>
        </div>

        {{-- Loading --}}
        <div id="mgmtLoading" class="flex justify-center py-10">
            @include('admin.components.spinner', ['class' => ''])
        </div>

        {{-- Empty --}}
        <div id="noStudents" class="hidden text-center py-10 text-gray-500">
            <p class="text-lg font-HellixB">No students need marksheet work</p>
            <p class="text-sm mt-1">All students are either verified or certified.</p>
        </div>

        {{-- Table --}}
        <div id="tableWrapper" class="hidden">
            <div class="border border-gray-200 rounded-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left whitespace-nowrap">
                        <thead class="bg-gray-50 border-b">
                            <tr>
                                <th class="px-4 py-3 font-HellixB">Reg No</th>
                                <th class="px-4 py-3 font-HellixB">Name</th>
                                <th class="px-4 py-3 font-HellixB">Father Name</th>
                                <th class="px-4 py-3 font-HellixB">Course</th>
                                <th class="px-4 py-3 font-HellixB">Admission</th>
                                <th class="px-4 py-3 font-HellixB">Stage</th>
                                <th class="px-4 py-3 font-HellixB">Action</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
var allNeedWork = [];
var filteredList = [];

document.addEventListener('DOMContentLoaded', function() {
    var session = getBranchData();
    if (!session) return;

    fetch(API_URL + '/admin/branch/get_all_students', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ branch_id: session.branchData.branch_id })
    })
    .then(function(r) { return r.json(); })
    .then(function(result) {
        document.getElementById('mgmtLoading').style.display = 'none';

        if (result.error || !result.data || result.data.length === 0) {
            document.getElementById('noStudents').classList.remove('hidden');
            return;
        }

        // Filter: students whose marksheet_stage is NOT 'verified' AND is_certificate_approve is NOT true
        allNeedWork = result.data.filter(function(s) {
            return s.marksheet_stage !== 'verified' && !s.is_certificate_approve;
        });

        if (allNeedWork.length === 0) {
            document.getElementById('noStudents').classList.remove('hidden');
            return;
        }

        filteredList = allNeedWork;
        renderTable(filteredList);
    })
    .catch(function() {
        document.getElementById('mgmtLoading').innerHTML = '<p class="text-red-500">Failed to load students</p>';
    });

    document.getElementById('searchInput').addEventListener('input', applyFilters);
    document.getElementById('stageFilter').addEventListener('change', applyFilters);
});

function applyFilters() {
    var query = document.getElementById('searchInput').value.toLowerCase();
    var stage = document.getElementById('stageFilter').value;

    filteredList = allNeedWork.filter(function(s) {
        if (query) {
            var match = (s.student_name || '').toLowerCase().indexOf(query) !== -1 ||
                (s.registration_number || '').toLowerCase().indexOf(query) !== -1 ||
                (s.course_name || '').toLowerCase().indexOf(query) !== -1 ||
                (s.short_form || '').toLowerCase().indexOf(query) !== -1;
            if (!match) return false;
        }

        if (stage === 'no_marks') return !s.marks;
        if (stage === 'pending') return s.marksheet_stage === 'pending';
        return true;
    });

    renderTable(filteredList);
}

function renderTable(students) {
    var wrapper = document.getElementById('tableWrapper');
    var noEl = document.getElementById('noStudents');

    if (students.length === 0) {
        wrapper.classList.add('hidden');
        noEl.classList.remove('hidden');
        document.getElementById('studentCount').textContent = '0';
        return;
    }

    noEl.classList.add('hidden');
    wrapper.classList.remove('hidden');
    document.getElementById('studentCount').textContent = students.length;

    var tbody = document.getElementById('tableBody');
    tbody.innerHTML = students.map(function(s) {
        var stageLabel = 'No Marks';
        var stageCls = 'bg-red-100 text-red-700';
        if (s.marksheet_stage === 'pending') {
            stageLabel = 'Pending';
            stageCls = 'bg-yellow-100 text-yellow-700';
        } else if (s.marks) {
            stageLabel = 'Has Marks';
            stageCls = 'bg-blue-100 text-blue-700';
        }

        return '<tr class="border-b hover:bg-gray-50">' +
            '<td class="px-4 py-3"><a href="/branch/student?id=' + s.student_id + '" class="text-black font-HellixB hover:underline">' + escapeHtml(s.registration_number) + '</a></td>' +
            '<td class="px-4 py-3 font-HellixR">' + escapeHtml(s.student_name || '-') + '</td>' +
            '<td class="px-4 py-3 font-HellixR">' + escapeHtml(s.student_father_name || '-') + '</td>' +
            '<td class="px-4 py-3 font-HellixR">' + escapeHtml(s.short_form || s.course_name || '-') + '</td>' +
            '<td class="px-4 py-3 font-HellixR">' + escapeHtml(s.admission_date || '-') + '</td>' +
            '<td class="px-4 py-3"><span class="px-2 py-0.5 rounded-full text-xs font-HellixB ' + stageCls + '">' + stageLabel + '</span></td>' +
            '<td class="px-4 py-3"><a href="/branch/update-marksheet?id=' + s.student_id + '" class="bg-black text-white px-3 py-1.5 rounded-lg font-HellixB text-xs hover:bg-gray-800 inline-block">Edit Marks</a></td>' +
        '</tr>';
    }).join('');
}

function escapeHtml(text) {
    if (!text) return '';
    var div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}
</script>
