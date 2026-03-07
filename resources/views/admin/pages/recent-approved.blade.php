<div>
    <div class="max-w-full mx-auto bg-white rounded-lg shadow-md p-6">
        {{-- Header --}}
        <div class="flex items-center justify-between mb-5">
            <div>
                <h1 class="text-2xl font-HellixB">Recently Approved Students</h1>
                <p class="text-sm text-gray-400 font-HellixR mt-1">Students certified in the past 7 days</p>
            </div>
            <div class="text-sm text-gray-500 font-HellixR">
                <span id="studentCount" class="font-HellixB">0</span> students
            </div>
        </div>

        {{-- Loading --}}
        <div id="approvedLoading" class="flex justify-center py-10">
            @include('admin.components.spinner', ['class' => ''])
        </div>

        {{-- Empty --}}
        <div id="noStudents" class="hidden text-center py-10 text-gray-500">
            <p class="text-lg font-HellixB">No recently approved students</p>
            <p class="text-sm mt-1">No students have been certified in the past 7 days.</p>
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
                                <th class="px-4 py-3 font-HellixB">Course</th>
                                <th class="px-4 py-3 font-HellixB">Certified Date</th>
                                <th class="px-4 py-3 font-HellixB">Percentage</th>
                                <th class="px-4 py-3 font-HellixB">Performance</th>
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
        document.getElementById('approvedLoading').style.display = 'none';

        if (result.error || !result.data || result.data.length === 0) {
            document.getElementById('noStudents').classList.remove('hidden');
            return;
        }

        var now = new Date();
        var sevenDaysAgo = new Date(now.getTime() - 7 * 24 * 60 * 60 * 1000);

        var approved = result.data.filter(function(s) {
            if (!s.is_certificate_approve || !s.certified_date) return false;
            var certDate = new Date(s.certified_date);
            return certDate >= sevenDaysAgo;
        });

        if (approved.length === 0) {
            document.getElementById('noStudents').classList.remove('hidden');
            return;
        }

        // Sort by certified_date descending
        approved.sort(function(a, b) {
            return new Date(b.certified_date) - new Date(a.certified_date);
        });

        document.getElementById('studentCount').textContent = approved.length;
        document.getElementById('tableWrapper').classList.remove('hidden');

        var tbody = document.getElementById('tableBody');
        tbody.innerHTML = approved.map(function(s) {
            var perfColor = '';
            if (s.performance === 'Excellent') perfColor = 'text-green-600';
            else if (s.performance === 'Very Good') perfColor = 'text-blue-600';
            else if (s.performance === 'Good') perfColor = 'text-yellow-600';
            else perfColor = 'text-red-600';

            return '<tr class="border-b hover:bg-gray-50">' +
                '<td class="px-4 py-3"><a href="/branch/student?id=' + s.student_id + '" class="text-black font-HellixB hover:underline">' + escapeHtml(s.registration_number) + '</a></td>' +
                '<td class="px-4 py-3 font-HellixR">' + escapeHtml(s.student_name || '-') + '</td>' +
                '<td class="px-4 py-3 font-HellixR">' + escapeHtml(s.short_form || s.course_name || '-') + '</td>' +
                '<td class="px-4 py-3 font-HellixR">' + escapeHtml(s.certified_date || '-') + '</td>' +
                '<td class="px-4 py-3 font-HellixB">' + (s.overall_percent ? s.overall_percent + '%' : '-') + '</td>' +
                '<td class="px-4 py-3 font-HellixB ' + perfColor + '">' + escapeHtml(s.performance || '-') + '</td>' +
                '<td class="px-4 py-3"><a href="/branch/student?id=' + s.student_id + '" class="text-gray-600 hover:text-black font-HellixB text-xs underline">View</a></td>' +
            '</tr>';
        }).join('');
    })
    .catch(function() {
        document.getElementById('approvedLoading').innerHTML = '<p class="text-red-500">Failed to load students</p>';
    });
});

function escapeHtml(text) {
    if (!text) return '';
    var div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}
</script>
