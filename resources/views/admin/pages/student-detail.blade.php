<style>
    .detail-card {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 1px 3px rgba(0,0,0,0.04);
    }
    .detail-card-inner {
        padding: 28px 32px;
    }
    .detail-card-title {
        font-size: 15px;
        margin-bottom: 20px;
        padding-bottom: 14px;
        border-bottom: 1px solid #f3f4f6;
    }
    .detail-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 0;
        border-bottom: 1px solid #f9fafb;
        font-size: 13.5px;
    }
    .detail-row:last-child {
        border-bottom: none;
    }
    .detail-row-label {
        color: #9ca3af;
    }
    .detail-row-value {
        text-align: right;
    }
    .info-pill {
        background: #f9fafb;
        border: 1px solid #f3f4f6;
        border-radius: 10px;
        padding: 14px 20px;
        min-width: 0;
    }
    .info-pill-label {
        font-size: 11px;
        color: #9ca3af;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 4px;
    }
    .info-pill-value {
        font-size: 14px;
    }
    .mark-card {
        background: #f9fafb;
        border: 1px solid #f3f4f6;
        border-radius: 12px;
        padding: 20px 16px;
        text-align: center;
    }
    .mark-card-label {
        font-size: 11px;
        color: #9ca3af;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        margin-bottom: 8px;
    }
    .mark-card-score {
        font-size: 26px;
    }
    .mark-card-total {
        font-size: 11px;
        color: #d1d5db;
        margin-left: 2px;
    }
</style>

<div class="pb-10">
    <div id="detailLoading" class="flex justify-center py-20">
        @include('admin.components.spinner', ['class' => ''])
    </div>

    <div id="detailNotFound" class="hidden text-center py-20 text-gray-500">
        <p class="text-xl font-HellixB">Student not found</p>
        <a href="{{ route('branch.allStudents') }}" class="text-sm text-black hover:underline mt-3 inline-block">Back to All Students</a>
    </div>

    <div id="detailContent" class="hidden" style="padding: 0 20px;">

        {{-- ===== HERO CARD ===== --}}
        <div class="detail-card" style="margin-bottom: 20px;">
            <div style="padding: 28px 32px;">

                {{-- Top bar: back + edit --}}
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 28px;">
                    <a href="{{ route('branch.allStudents') }}" class="font-HellixR" style="font-size: 13px; color: #9ca3af; text-decoration: none; display: flex; align-items: center; gap: 6px; transition: color 0.15s;" onmouseover="this.style.color='#111'" onmouseout="this.style.color='#9ca3af'">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                        All Students
                    </a>
                    <div style="display: flex; gap: 10px; align-items: center;">
                        <a id="editMarksheetLink" href="#" class="font-HellixB" style="background: #7c3aed; color: #fff; padding: 10px 24px; border-radius: 10px; font-size: 13px; text-decoration: none; display: none; align-items: center; gap: 8px; transition: background 0.15s;" onmouseover="this.style.background='#6d28d9'" onmouseout="this.style.background='#7c3aed'">
                            <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            Edit Marksheet
                        </a>
                        <a id="editLink" href="#" class="font-HellixB" style="background: #111; color: #fff; padding: 10px 24px; border-radius: 10px; font-size: 13px; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; transition: background 0.15s;" onmouseover="this.style.background='#333'" onmouseout="this.style.background='#111'">
                            <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            Edit Student
                        </a>
                    </div>
                </div>

                {{-- Profile section --}}
                <div style="display: flex; gap: 28px; align-items: flex-start;">
                    {{-- Photo --}}
                    <div style="width: 130px; height: 160px; border-radius: 14px; overflow: hidden; background: #f3f4f6; flex-shrink: 0; border: 2px solid #e5e7eb;">
                        <img id="dPhoto" src="" alt="" style="width: 100%; height: 100%; object-fit: cover; display: none;">
                        <div id="dPhotoPlaceholder" style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; font-size: 48px; color: #d1d5db; background: #f9fafb;" class="font-HellixB"></div>
                    </div>

                    {{-- Name + meta --}}
                    <div style="flex: 1; min-width: 0; padding-top: 4px;">
                        <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 4px; flex-wrap: wrap;">
                            <h1 id="dName" class="font-HellixB" style="font-size: 24px; margin: 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"></h1>
                            <span id="dStatusBadge" class="font-HellixB" style="font-size: 11px; padding: 5px 14px; border-radius: 20px; flex-shrink: 0;"></span>
                        </div>
                        <p id="dRegNo" class="font-HellixR" style="font-size: 13px; color: #9ca3af; margin: 0 0 20px 0;"></p>

                        {{-- Info pills --}}
                        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 10px;">
                            <div class="info-pill">
                                <div class="info-pill-label font-HellixR">Admission</div>
                                <div id="dAdmission" class="info-pill-value font-HellixB"></div>
                            </div>
                            <div class="info-pill">
                                <div class="info-pill-label font-HellixR">Relieving</div>
                                <div id="dRelieving" class="info-pill-value font-HellixB"></div>
                            </div>
                            <div class="info-pill">
                                <div class="info-pill-label font-HellixR">Course</div>
                                <div id="dCourse" class="info-pill-value font-HellixB"></div>
                            </div>
                            <div class="info-pill">
                                <div class="info-pill-label font-HellixR">Marksheet ID</div>
                                <div id="dMarksheetId" class="info-pill-value font-HellixB"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ===== TWO COLUMN GRID ===== --}}
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">

            {{-- Personal Information --}}
            <div class="detail-card">
                <div class="detail-card-inner">
                    <h2 class="detail-card-title font-HellixB">Personal Information</h2>
                    <div>
                        <div class="detail-row">
                            <span class="detail-row-label font-HellixR">Father's Name</span>
                            <span id="dFather" class="detail-row-value font-HellixB"></span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-row-label font-HellixR">Mother's Name</span>
                            <span id="dMother" class="detail-row-value font-HellixB"></span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-row-label font-HellixR">Date of Birth</span>
                            <span id="dDob" class="detail-row-value font-HellixB"></span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-row-label font-HellixR">Phone</span>
                            <span id="dPhone" class="detail-row-value font-HellixB"></span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-row-label font-HellixR">Email</span>
                            <span id="dEmail" class="detail-row-value font-HellixB"></span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-row-label font-HellixR">Aadhaar</span>
                            <span id="dAadhaar" class="detail-row-value font-HellixB"></span>
                        </div>
                        <div style="padding-top: 16px; margin-top: 4px; border-top: 1px solid #f3f4f6;">
                            <div class="font-HellixR" style="font-size: 11px; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 6px;">Address</div>
                            <div id="dAddress" class="font-HellixB" style="font-size: 13.5px; line-height: 1.6;"></div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Right column: Fee + Academic stacked --}}
            <div style="display: flex; flex-direction: column; gap: 20px;">

                {{-- Fee Details --}}
                <div class="detail-card">
                    <div class="detail-card-inner">
                        <h2 class="detail-card-title font-HellixB">Fee Details</h2>
                        <div>
                            <div class="detail-row">
                                <span class="detail-row-label font-HellixR">Total Fees</span>
                                <span id="dTotalFees" class="detail-row-value font-HellixB" style="font-size: 15px;"></span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-row-label font-HellixR">Paid Fees</span>
                                <span id="dPaidFees" class="detail-row-value font-HellixB" style="color: #16a34a;"></span>
                            </div>
                            <div class="detail-row" style="border-bottom: none;">
                                <span class="detail-row-label font-HellixR">Due Fees</span>
                                <span id="dDueFees" class="detail-row-value font-HellixB" style="color: #ef4444;"></span>
                            </div>
                        </div>
                        <div style="width: 100%; background: #f3f4f6; border-radius: 6px; height: 8px; margin-top: 16px; overflow: hidden;">
                            <div id="dFeeBar" style="background: #22c55e; height: 100%; border-radius: 6px; width: 0%; transition: width 0.6s ease;"></div>
                        </div>
                    </div>
                </div>

                {{-- Academic Details --}}
                <div class="detail-card" style="flex: 1;">
                    <div class="detail-card-inner">
                        <h2 class="detail-card-title font-HellixB">Academic Details</h2>
                        <div>
                            <div class="detail-row">
                                <span class="detail-row-label font-HellixR">Marksheet Stage</span>
                                <span id="dMarksheetStage" class="detail-row-value font-HellixB"></span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-row-label font-HellixR">Overall Percentage</span>
                                <span id="dPercent" class="detail-row-value font-HellixB"></span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-row-label font-HellixR">Performance</span>
                                <span id="dPerformance" class="detail-row-value font-HellixB"></span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-row-label font-HellixR">Certificate Approved</span>
                                <span id="dCertApproved" class="detail-row-value font-HellixB"></span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-row-label font-HellixR">Certified Date</span>
                                <span id="dCertDate" class="detail-row-value font-HellixB"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Marks Breakdown — spans full width --}}
            <div id="marksSection" class="detail-card" style="grid-column: 1 / -1; display: none;">
                <div class="detail-card-inner">
                    <h2 class="detail-card-title font-HellixB">Marks Breakdown</h2>
                    <div id="marksGrid" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 12px;"></div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var session = getBranchData();
    if (!session) return;

    var params = new URLSearchParams(window.location.search);
    var studentId = params.get('id');

    if (!studentId) {
        document.getElementById('detailLoading').style.display = 'none';
        document.getElementById('detailNotFound').classList.remove('hidden');
        return;
    }

    fetch(API_URL + '/admin/branch/get_all_students', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ branch_id: session.branchData.branch_id })
    })
    .then(function(r) { return r.json(); })
    .then(function(result) {
        document.getElementById('detailLoading').style.display = 'none';

        if (result.error || !result.data) {
            document.getElementById('detailNotFound').classList.remove('hidden');
            return;
        }

        var s = result.data.find(function(st) { return st.student_id == studentId; });

        if (!s) {
            document.getElementById('detailNotFound').classList.remove('hidden');
            return;
        }

        populateDetail(s);
        document.getElementById('detailContent').classList.remove('hidden');
    })
    .catch(function() {
        document.getElementById('detailLoading').innerHTML = '<p class="text-red-500">Failed to load student</p>';
    });
});

function populateDetail(s) {
    document.getElementById('editLink').href = '/branch/edit-student?id=' + s.student_id;

    // Show Edit Marksheet button if marksheet_stage is not verified and certificate is not approved
    if (s.marksheet_stage !== 'verified' && !s.is_certificate_approve) {
        var marksheetBtn = document.getElementById('editMarksheetLink');
        marksheetBtn.href = '/branch/update-marksheet?id=' + s.student_id;
        marksheetBtn.style.display = 'inline-flex';
    }

    // Photo
    var photoImg = document.getElementById('dPhoto');
    var photoPlaceholder = document.getElementById('dPhotoPlaceholder');
    if (s.student_photo) {
        photoImg.src = s.student_photo;
        photoImg.style.display = 'block';
        photoPlaceholder.style.display = 'none';
    } else {
        photoImg.style.display = 'none';
        photoPlaceholder.style.display = 'flex';
        photoPlaceholder.textContent = (s.student_name ? s.student_name.charAt(0).toUpperCase() : '?');
    }

    document.getElementById('dName').textContent = s.student_name || '';
    document.getElementById('dRegNo').textContent = s.registration_number;

    // Status chip
    var badge = document.getElementById('dStatusBadge');
    if (s.is_certificate_approve) { badge.style.background = '#dbeafe'; badge.style.color = '#1d4ed8'; badge.textContent = 'Certified'; }
    else if (s.marksheet_stage === 'verified') { badge.style.background = '#f3e8ff'; badge.style.color = '#7c3aed'; badge.textContent = 'Verified'; }
    else if (s.marksheet_stage === 'pending') { badge.style.background = '#fef9c3'; badge.style.color = '#a16207'; badge.textContent = 'Pending'; }
    else if (s.is_student_active) { badge.style.background = '#dcfce7'; badge.style.color = '#15803d'; badge.textContent = 'Active'; }
    else { badge.style.background = '#fee2e2'; badge.style.color = '#dc2626'; badge.textContent = 'Inactive'; }

    document.getElementById('dCourse').textContent = s.short_form || s.course_name || '-';
    document.getElementById('dAdmission').textContent = s.admission_date || '-';
    document.getElementById('dRelieving').textContent = s.relieving_date || '-';
    document.getElementById('dMarksheetId').textContent = s.marksheet_id || '-';

    document.getElementById('dFather').textContent = s.student_father_name || '-';
    document.getElementById('dMother').textContent = s.student_mother_name || '-';
    document.getElementById('dDob').textContent = s.dob || '-';
    document.getElementById('dPhone').textContent = s.student_phone || '-';
    document.getElementById('dEmail').textContent = s.student_email || '-';
    document.getElementById('dAadhaar').textContent = s.aadhaar_number || '-';

    var addr = [s.address, s.city, s.state, s.zip].filter(Boolean).join(', ');
    document.getElementById('dAddress').textContent = addr || '-';

    var totalFees = parseFloat(s.total_fees) || 0;
    var paidFees = parseFloat(s.paid_fees) || 0;
    var dueFees = parseFloat(s.due_fees) || (totalFees - paidFees);
    document.getElementById('dTotalFees').textContent = '\u20B9' + totalFees.toLocaleString();
    document.getElementById('dPaidFees').textContent = '\u20B9' + paidFees.toLocaleString();
    document.getElementById('dDueFees').textContent = '\u20B9' + dueFees.toLocaleString();
    var pct = totalFees > 0 ? (paidFees / totalFees * 100) : 0;
    document.getElementById('dFeeBar').style.width = Math.min(pct, 100) + '%';

    document.getElementById('dMarksheetStage').textContent = (s.marksheet_stage || 'started').charAt(0).toUpperCase() + (s.marksheet_stage || 'started').slice(1);
    document.getElementById('dPercent').textContent = s.overall_percent ? s.overall_percent + '%' : '-';
    document.getElementById('dPerformance').textContent = s.performance || '-';
    document.getElementById('dCertApproved').textContent = s.is_certificate_approve ? 'Yes' : 'No';
    document.getElementById('dCertDate').textContent = s.certified_date || '-';

    if (s.marks) {
        try {
            var marks = JSON.parse(s.marks);
            var grid = document.getElementById('marksGrid');
            var entries = Object.entries(marks);

            // Adjust grid columns based on number of subjects
            if (entries.length <= 2) grid.style.gridTemplateColumns = 'repeat(2, 1fr)';
            else if (entries.length === 3) grid.style.gridTemplateColumns = 'repeat(3, 1fr)';
            else grid.style.gridTemplateColumns = 'repeat(4, 1fr)';

            grid.innerHTML = entries.map(function(entry) {
                var color = entry[1] >= 60 ? '#16a34a' : entry[1] >= 30 ? '#ca8a04' : '#dc2626';
                return '<div class="mark-card">' +
                    '<div class="mark-card-label font-HellixR">' + entry[0] + '</div>' +
                    '<div class="mark-card-score font-HellixB" style="color:' + color + '">' + entry[1] +
                    '<span class="mark-card-total">/100</span></div>' +
                '</div>';
            }).join('');
            document.getElementById('marksSection').style.display = 'block';
        } catch(e) {}
    }
}
</script>
