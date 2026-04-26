<style>
    .sa-detail-card { background: #fff; border-radius: 16px; border: 1px solid #e5e7eb; }
    .sa-detail-inner { padding: 28px 32px; }
    .sa-detail-title { font-size: 15px; margin-bottom: 20px; padding-bottom: 14px; border-bottom: 1px solid #f3f4f6; }
    .sa-detail-row { display: flex; justify-content: space-between; align-items: center; padding: 12px 0; border-bottom: 1px solid #f9fafb; font-size: 13.5px; }
    .sa-detail-row:last-child { border-bottom: none; }
    .sa-detail-row-label { color: #9ca3af; }
    .sa-detail-row-value { text-align: right; }
    .sa-info-pill { background: #f9fafb; border: 1px solid #f3f4f6; border-radius: 10px; padding: 14px 20px; }
    .sa-info-pill-label { font-size: 11px; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 4px; }
    .sa-info-pill-value { font-size: 14px; }
    .sa-mark-card { background: #f9fafb; border: 1px solid #f3f4f6; border-radius: 12px; padding: 20px 16px; text-align: center; }
    .sa-mark-card-label { font-size: 11px; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.04em; margin-bottom: 8px; }
    .sa-mark-card-score { font-size: 26px; }

    .sa-cert-btn-group { display: flex; gap: 10px; margin-top: 20px; }
    .sa-cert-btn {
        display: inline-flex; align-items: center; gap: 8px;
        padding: 10px 22px; border-radius: 10px; font-size: 13px;
        text-decoration: none; cursor: pointer; border: none;
        transition: all 0.15s; font-family: inherit;
    }
    .sa-cert-btn-primary { background: #1d4ed8; color: #fff; }
    .sa-cert-btn-primary:hover { background: #1e40af; }
    .sa-cert-btn-secondary { background: #7c3aed; color: #fff; }
    .sa-cert-btn-secondary:hover { background: #6d28d9; }

    .sa-cert-modal-overlay {
        display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.85);
        z-index: 9999; overflow-y: auto; padding: 20px;
    }
    .sa-cert-modal-overlay.active { display: flex; flex-direction: column; align-items: center; }
    .sa-cert-modal-close {
        position: fixed; top: 16px; right: 20px; z-index: 10000;
        background: rgba(255,255,255,0.15); border: 1px solid rgba(255,255,255,0.2);
        color: #fff; width: 40px; height: 40px; border-radius: 10px;
        cursor: pointer; font-size: 20px; display: flex; align-items: center;
        justify-content: center; transition: background 0.15s;
    }
    .sa-cert-modal-close:hover { background: rgba(255,255,255,0.25); }
    .sa-cert-modal-content { margin: auto; max-width: 95vw; }
    .sa-cert-preview-wrapper {
        position: relative; width: 1100px; max-width: 95vw; transform-origin: top center;
    }
    .sa-cert-preview-wrapper img { width: 100%; height: auto; display: block; border-radius: 4px; }
    .sa-cert-field {
        position: absolute; font-family: sans-serif; color: #000;
        font-weight: bold; letter-spacing: 0.5px; white-space: nowrap;
    }
    .sa-cert-modal-actions {
        display: flex; gap: 12px; justify-content: center; padding: 20px 0;
    }
    .sa-cert-download-btn {
        display: inline-flex; align-items: center; gap: 8px;
        padding: 12px 28px; border-radius: 10px; font-size: 14px;
        background: #fff; color: #111; border: none; cursor: pointer;
        font-weight: 600; transition: all 0.15s; font-family: inherit;
    }
    .sa-cert-download-btn:hover { background: #f3f4f6; transform: translateY(-1px); }
</style>

<div class="pb-10">
    <div id="saDetLoading" class="flex justify-center py-20">
        @include('admin.components.spinner', ['class' => ''])
    </div>

    <div id="saDetNotFound" class="hidden" style="text-align:center;padding:80px 20px;color:#9ca3af;">
        <p class="font-HellixB" style="font-size:18px;color:#6b7280;">Student not found</p>
        <a href="{{ route('superadmin.allStudents') }}" class="font-HellixR" style="font-size:13px;color:#111;text-decoration:underline;margin-top:8px;display:inline-block;">Back to All Students</a>
    </div>

    <div id="saDetContent" class="hidden" style="padding:0 20px;">

        {{-- Hero --}}
        <div class="sa-detail-card" style="margin-bottom:20px;">
            <div style="padding:28px 32px;">
                <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:28px;">
                    <a href="{{ route('superadmin.allStudents') }}" class="font-HellixR" style="font-size:13px;color:#9ca3af;text-decoration:none;display:flex;align-items:center;gap:6px;" onmouseover="this.style.color='#111'" onmouseout="this.style.color='#9ca3af'">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                        All Students
                    </a>
                    <div style="display:flex;gap:10px;">
                        <a id="saEditLink" href="#" class="font-HellixB" style="background:#111;color:#fff;padding:10px 24px;border-radius:10px;font-size:13px;text-decoration:none;display:inline-flex;align-items:center;gap:8px;" onmouseover="this.style.background='#333'" onmouseout="this.style.background='#111'">
                            <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            Edit Student
                        </a>
                    </div>
                </div>

                <div style="display:flex;gap:28px;align-items:flex-start;">
                    <div style="width:130px;height:160px;border-radius:14px;overflow:hidden;background:#f3f4f6;flex-shrink:0;border:2px solid #e5e7eb;">
                        <img id="saDetPhoto" src="" alt="" style="width:100%;height:100%;object-fit:cover;display:none;">
                        <div id="saDetPhotoPlaceholder" style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;font-size:48px;color:#d1d5db;background:#f9fafb;" class="font-HellixB"></div>
                    </div>
                    <div style="flex:1;min-width:0;padding-top:4px;">
                        <div style="display:flex;align-items:center;gap:12px;margin-bottom:4px;flex-wrap:wrap;">
                            <h1 id="saDetName" class="font-HellixB" style="font-size:24px;margin:0;"></h1>
                            <span id="saDetBadge" class="font-HellixB" style="font-size:11px;padding:5px 14px;border-radius:20px;"></span>
                        </div>
                        <p id="saDetRegNo" class="font-HellixR" style="font-size:13px;color:#9ca3af;margin:0 0 6px;"></p>
                        <p id="saDetBranch" class="font-HellixR" style="font-size:12px;color:#6b7280;margin:0 0 20px;">
                            <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display:inline;vertical-align:-2px;margin-right:4px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5"/></svg>
                            <span id="saDetBranchName"></span>
                        </p>
                        <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:10px;">
                            <div class="sa-info-pill">
                                <div class="sa-info-pill-label font-HellixR">Admission</div>
                                <div id="saDetAdmission" class="sa-info-pill-value font-HellixB"></div>
                            </div>
                            <div class="sa-info-pill">
                                <div class="sa-info-pill-label font-HellixR">Relieving</div>
                                <div id="saDetRelieving" class="sa-info-pill-value font-HellixB"></div>
                            </div>
                            <div class="sa-info-pill">
                                <div class="sa-info-pill-label font-HellixR">Course</div>
                                <div id="saDetCourse" class="sa-info-pill-value font-HellixB"></div>
                            </div>
                            <div class="sa-info-pill">
                                <div class="sa-info-pill-label font-HellixR">Marksheet ID</div>
                                <div id="saDetMarksheetId" class="sa-info-pill-value font-HellixB"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">
            {{-- Personal --}}
            <div class="sa-detail-card">
                <div class="sa-detail-inner">
                    <h2 class="sa-detail-title font-HellixB">Personal Information</h2>
                    <div class="sa-detail-row"><span class="sa-detail-row-label font-HellixR">Father's Name</span><span id="saDetFather" class="sa-detail-row-value font-HellixB"></span></div>
                    <div class="sa-detail-row"><span class="sa-detail-row-label font-HellixR">Mother's Name</span><span id="saDetMother" class="sa-detail-row-value font-HellixB"></span></div>
                    <div class="sa-detail-row"><span class="sa-detail-row-label font-HellixR">Date of Birth</span><span id="saDetDob" class="sa-detail-row-value font-HellixB"></span></div>
                    <div class="sa-detail-row"><span class="sa-detail-row-label font-HellixR">Phone</span><span id="saDetPhone" class="sa-detail-row-value font-HellixB"></span></div>
                    <div class="sa-detail-row"><span class="sa-detail-row-label font-HellixR">Email</span><span id="saDetEmail" class="sa-detail-row-value font-HellixB"></span></div>
                    <div class="sa-detail-row"><span class="sa-detail-row-label font-HellixR">Aadhaar</span><span id="saDetAadhaar" class="sa-detail-row-value font-HellixB"></span></div>
                    <div style="padding-top:16px;margin-top:4px;border-top:1px solid #f3f4f6;">
                        <div class="font-HellixR" style="font-size:11px;color:#9ca3af;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:6px;">Address</div>
                        <div id="saDetAddress" class="font-HellixB" style="font-size:13.5px;line-height:1.6;"></div>
                    </div>
                </div>
            </div>

            <div style="display:flex;flex-direction:column;gap:20px;">
                {{-- Fees --}}
                <div class="sa-detail-card">
                    <div class="sa-detail-inner">
                        <h2 class="sa-detail-title font-HellixB">Fee Details</h2>
                        <div class="sa-detail-row"><span class="sa-detail-row-label font-HellixR">Total Fees</span><span id="saDetTotalFees" class="sa-detail-row-value font-HellixB" style="font-size:15px;"></span></div>
                        <div class="sa-detail-row"><span class="sa-detail-row-label font-HellixR">Paid Fees</span><span id="saDetPaidFees" class="sa-detail-row-value font-HellixB" style="color:#16a34a;"></span></div>
                        <div class="sa-detail-row" style="border-bottom:none;"><span class="sa-detail-row-label font-HellixR">Due Fees</span><span id="saDetDueFees" class="sa-detail-row-value font-HellixB" style="color:#ef4444;"></span></div>
                        <div style="width:100%;background:#f3f4f6;border-radius:6px;height:8px;margin-top:16px;overflow:hidden;"><div id="saDetFeeBar" style="background:#22c55e;height:100%;border-radius:6px;width:0%;transition:width 0.6s ease;"></div></div>
                    </div>
                </div>
                {{-- Academic --}}
                <div class="sa-detail-card" style="flex:1;">
                    <div class="sa-detail-inner">
                        <h2 class="sa-detail-title font-HellixB">Academic Details</h2>
                        <div class="sa-detail-row"><span class="sa-detail-row-label font-HellixR">Marksheet Stage</span><span id="saDetStage" class="sa-detail-row-value font-HellixB"></span></div>
                        <div class="sa-detail-row"><span class="sa-detail-row-label font-HellixR">Overall Percentage</span><span id="saDetPercent" class="sa-detail-row-value font-HellixB"></span></div>
                        <div class="sa-detail-row"><span class="sa-detail-row-label font-HellixR">Performance</span><span id="saDetPerformance" class="sa-detail-row-value font-HellixB"></span></div>
                        <div class="sa-detail-row"><span class="sa-detail-row-label font-HellixR">Certificate Approved</span><span id="saDetCertApproved" class="sa-detail-row-value font-HellixB"></span></div>
                        <div class="sa-detail-row"><span class="sa-detail-row-label font-HellixR">Certified Date</span><span id="saDetCertDate" class="sa-detail-row-value font-HellixB"></span></div>
                    </div>
                </div>
            </div>

            {{-- Marks --}}
            <div id="saDetMarksSection" class="sa-detail-card" style="grid-column:1/-1;display:none;">
                <div class="sa-detail-inner">
                    <h2 class="sa-detail-title font-HellixB">Marks Breakdown</h2>
                    <div id="saDetMarksGrid" style="display:grid;grid-template-columns:repeat(4,1fr);gap:12px;"></div>
                </div>
            </div>

            {{-- Certificate & Marksheet Buttons --}}
            <div id="saDetCertSection" class="sa-detail-card" style="grid-column:1/-1;display:none;">
                <div class="sa-detail-inner">
                    <h2 class="sa-detail-title font-HellixB">Documents</h2>
                    <div class="sa-cert-btn-group">
                        <button id="saViewCertBtn" class="sa-cert-btn sa-cert-btn-primary font-HellixB" onclick="saShowCertPreview('certificate')" style="display:none;">
                            <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            View Certificate
                        </button>
                        <button id="saViewMarksheetBtn" class="sa-cert-btn sa-cert-btn-secondary font-HellixB" onclick="saShowCertPreview('marksheet')" style="display:none;">
                            <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                            View Marksheet
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Certificate Preview Modal --}}
<div id="saCertModal" class="sa-cert-modal-overlay" onclick="if(event.target===this)saCloseCertModal()">
    <button class="sa-cert-modal-close" onclick="saCloseCertModal()">&times;</button>
    <div class="sa-cert-modal-content">
        <div id="saCertPreviewWrapper" class="sa-cert-preview-wrapper"></div>
        <div class="sa-cert-modal-actions">
            <button id="saCertDownloadBtn" class="sa-cert-download-btn font-HellixB" onclick="saDownloadCertPdf()">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                Download PDF
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    verifyAdminAccess(function(session) {
        var params = new URLSearchParams(window.location.search);
        var studentId = params.get('id');

        if (!studentId) {
            document.getElementById('saDetLoading').style.display = 'none';
            document.getElementById('saDetNotFound').classList.remove('hidden');
            return;
        }

        fetch(API_URL + '/admin/student/get_by_id', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                admin_branch_id: session.adminData.branch_id,
                student_id: studentId
            })
        })
        .then(function(r) { return r.json(); })
        .then(function(result) {
            document.getElementById('saDetLoading').style.display = 'none';
            if (result.error || !result.data) {
                document.getElementById('saDetNotFound').classList.remove('hidden');
                return;
            }
            populateSaDetail(result.data);
            document.getElementById('saDetContent').classList.remove('hidden');
        })
        .catch(function() {
            document.getElementById('saDetLoading').innerHTML = '<p style="color:#dc2626;">Failed to load student</p>';
        });
    });
});

function populateSaDetail(s) {
    document.getElementById('saEditLink').href = '/admin-abc/edit-student?id=' + s.student_id;

    if (s.student_photo) {
        document.getElementById('saDetPhoto').src = s.student_photo;
        document.getElementById('saDetPhoto').style.display = 'block';
        document.getElementById('saDetPhotoPlaceholder').style.display = 'none';
    } else {
        document.getElementById('saDetPhotoPlaceholder').textContent = (s.student_name || '?').charAt(0).toUpperCase();
    }

    document.getElementById('saDetName').textContent = s.student_name || '';
    document.getElementById('saDetRegNo').textContent = s.registration_number;
    document.getElementById('saDetBranchName').textContent = (s.branch_name || '-') + ' (' + (s.branch_code || '') + ')';

    var badge = document.getElementById('saDetBadge');
    if (s.is_certificate_approve) { badge.style.background='#dbeafe'; badge.style.color='#1d4ed8'; badge.textContent='Certified'; }
    else if (s.marksheet_stage==='verified') { badge.style.background='#f3e8ff'; badge.style.color='#7c3aed'; badge.textContent='Verified'; }
    else if (s.marksheet_stage==='pending') { badge.style.background='#fef9c3'; badge.style.color='#a16207'; badge.textContent='Pending'; }
    else if (s.is_student_active) { badge.style.background='#dcfce7'; badge.style.color='#15803d'; badge.textContent='Active'; }
    else { badge.style.background='#fee2e2'; badge.style.color='#dc2626'; badge.textContent='Inactive'; }

    document.getElementById('saDetCourse').textContent = s.short_form || s.course_name || '-';
    document.getElementById('saDetAdmission').textContent = s.admission_date || '-';
    document.getElementById('saDetRelieving').textContent = s.relieving_date || '-';
    document.getElementById('saDetMarksheetId').textContent = s.marksheet_id || '-';

    document.getElementById('saDetFather').textContent = s.student_father_name || '-';
    document.getElementById('saDetMother').textContent = s.student_mother_name || '-';
    document.getElementById('saDetDob').textContent = s.dob || '-';
    document.getElementById('saDetPhone').textContent = s.student_phone || '-';
    document.getElementById('saDetEmail').textContent = s.student_email || '-';
    document.getElementById('saDetAadhaar').textContent = s.aadhaar_number || '-';

    var addr = [s.address, s.city, s.state, s.zip].filter(Boolean).join(', ');
    document.getElementById('saDetAddress').textContent = addr || '-';

    var totalFees = parseFloat(s.total_fees) || 0;
    var paidFees = parseFloat(s.paid_fees) || 0;
    var dueFees = parseFloat(s.due_fees) || (totalFees - paidFees);
    document.getElementById('saDetTotalFees').textContent = '\u20B9' + totalFees.toLocaleString();
    document.getElementById('saDetPaidFees').textContent = '\u20B9' + paidFees.toLocaleString();
    document.getElementById('saDetDueFees').textContent = '\u20B9' + dueFees.toLocaleString();
    var pct = totalFees > 0 ? (paidFees / totalFees * 100) : 0;
    document.getElementById('saDetFeeBar').style.width = Math.min(pct, 100) + '%';

    document.getElementById('saDetStage').textContent = (s.marksheet_stage || 'started').charAt(0).toUpperCase() + (s.marksheet_stage || 'started').slice(1);
    document.getElementById('saDetPercent').textContent = s.overall_percent ? s.overall_percent + '%' : '-';
    document.getElementById('saDetPerformance').textContent = s.performance || '-';
    document.getElementById('saDetCertApproved').textContent = s.is_certificate_approve ? 'Yes' : 'No';
    document.getElementById('saDetCertDate').textContent = s.certified_date || '-';

    if (s.marks) {
        try {
            var marks = JSON.parse(s.marks);
            var grid = document.getElementById('saDetMarksGrid');
            var entries = Object.entries(marks);
            if (entries.length <= 2) grid.style.gridTemplateColumns = 'repeat(2,1fr)';
            else if (entries.length === 3) grid.style.gridTemplateColumns = 'repeat(3,1fr)';

            grid.innerHTML = entries.map(function(entry) {
                var color = entry[1] >= 60 ? '#16a34a' : entry[1] >= 30 ? '#ca8a04' : '#dc2626';
                return '<div class="sa-mark-card"><div class="sa-mark-card-label font-HellixR">' + entry[0] + '</div>' +
                    '<div class="sa-mark-card-score font-HellixB" style="color:' + color + '">' + entry[1] + '<span style="font-size:11px;color:#d1d5db;margin-left:2px;">/100</span></div></div>';
            }).join('');
            document.getElementById('saDetMarksSection').style.display = 'block';
        } catch(e) {}
    }

    // Show document buttons
    var showDocs = false;
    if (s.is_certificate_approve) {
        document.getElementById('saViewCertBtn').style.display = 'inline-flex';
        showDocs = true;
    }
    if (s.marksheet_stage === 'verified') {
        document.getElementById('saViewMarksheetBtn').style.display = 'inline-flex';
        showDocs = true;
    }
    if (showDocs) {
        document.getElementById('saDetCertSection').style.display = 'block';
    }

    window._saCertStudentData = s;
}

var _saCurrentDocType = '';

function saShowCertPreview(type) {
    _saCurrentDocType = type;
    var s = window._saCertStudentData;
    if (!s) return;

    var wrapper = document.getElementById('saCertPreviewWrapper');
    var branchDirector = ((s.branch_director_first || s.first_name || '') + ' ' + (s.branch_director_last || s.last_name || '')).trim().toUpperCase();

    var durationText = (s.course_duration || '') + ' MONTH' + ((s.course_duration || 0) > 1 ? 'S' : '');

    function saFmtDate(dt) {
        if (!dt) return '';
        var d = new Date(dt);
        return ('0' + d.getDate()).slice(-2) + '/' + ('0' + (d.getMonth() + 1)).slice(-2) + '/' + d.getFullYear();
    }
    var certDate = saFmtDate(s.certified_date);
    var dateCertified = saFmtDate(s.admission_date) + ' TO ' + saFmtDate(s.relieving_date);
    var studyCentre = (s.branch_name || '').toUpperCase() + ', ' + (s.branch_address || '').toUpperCase();
    var courseFull = (s.course_name || '').toUpperCase() + (s.short_form ? ' (' + s.short_form + ')' : '');

    if (type === 'certificate') {
        wrapper.innerHTML = '<img src="{{ asset("assets/certificates/certi_sample.jpg") }}">' +
            '<div class="cert-field" style="top:28.5%;left:32%;width:63%;text-align:center;font-size:14px;">' + (s.student_name || '').toUpperCase() + '</div>' +
            '<div class="cert-field" style="top:33.5%;left:33%;width:62%;text-align:center;font-size:14px;">' + (s.student_father_name || '').toUpperCase() + '</div>' +
            '<div class="cert-field" style="top:38.75%;left:37%;width:49%;text-align:center;font-size:14px;">' + (s.registration_number || '').toUpperCase() + '</div>' +
            '<div class="cert-field" style="top:44%;left:32%;width:59%;text-align:center;font-size:14px;">' + courseFull + '</div>' +
            '<div class="cert-field" style="top:49%;left:30%;width:24%;text-align:center;font-size:14px;">' + durationText + '</div>' +
            '<div class="cert-field" style="top:49%;left:58%;width:29%;text-align:center;font-size:14px;">' + (s.performance || '').toUpperCase() + '</div>' +
            '<div class="cert-field" style="top:54.25%;left:33%;width:55%;text-align:center;font-size:14px;">' + (s.overall_percent ? s.overall_percent + ' %' : '') + '</div>' +
            '<div class="cert-field" style="top:59.5%;left:33%;width:58%;text-align:center;font-size:14px;">' + studyCentre + '</div>' +
            '<div class="cert-field" style="top:64.5%;left:31%;width:62%;text-align:center;font-size:14px;">' + (s.branch_code || '').toUpperCase() + '</div>' +
            '<div class="cert-field" style="top:57.5%;left:11%;width:9%;text-align:center;font-size:14px;">' + (s.marksheet_id || '') + '</div>' +
            '<div class="cert-field" style="top:66%;left:9%;font-size:14px;">' + certDate + '</div>' +
            '<div class="cert-field" style="top:76%;left:6%;width:26%;text-align:center;font-size:14px;">' + branchDirector + '</div>' +
            '<div class="cert-field" style="top:76%;left:65%;width:34%;text-align:center;font-size:14px;">' + dateCertified + '</div>';
    } else {
        var marks = {};
        try { marks = JSON.parse(s.marks); } catch(e) {}
        var written = marks['Written Marks'] || '-';
        var practical = marks['Practical Marks'] || '-';
        var project = marks['Project Marks'] || '-';
        var viva = marks['Viva Marks'] || '-';

        wrapper.innerHTML = '<img src="{{ asset("assets/certificates/marks_sample.jpg") }}">' +
            '<div class="sa-cert-field" style="top:20%;left:30%;font-size:14px;">' + (s.registration_number || '').toUpperCase() + '</div>' +
            '<div class="sa-cert-field" style="top:32%;left:30%;font-size:14px;">' + (s.student_name || '').toUpperCase() + '</div>' +
            '<div class="sa-cert-field" style="top:37%;left:30%;font-size:14px;">' + (s.student_mother_name || '').toUpperCase() + '</div>' +
            '<div class="sa-cert-field" style="top:42%;left:30%;font-size:14px;">' + (s.student_father_name || '').toUpperCase() + '</div>' +
            '<div class="sa-cert-field" style="top:47%;left:30%;font-size:14px;">' + (s.course_name || '').toUpperCase() + '</div>' +
            '<div class="sa-cert-field" style="top:52%;left:30%;font-size:14px;">' + durationText + '</div>' +
            '<div class="sa-cert-field" style="top:57%;left:30%;font-size:14px;">' + (s.branch_name || '').toUpperCase() + '</div>' +
            '<div class="sa-cert-field" style="top:62%;left:30%;font-size:14px;">' + (s.branch_code || '').toUpperCase() + '</div>' +
            '<div class="sa-cert-field" style="top:52%;left:11%;font-size:12px;">' + (s.marksheet_id || '') + '</div>' +
            '<div class="sa-cert-field" style="top:60%;left:6%;font-size:11px;">' + certDate + '</div>' +
            '<div class="sa-cert-field" style="top:20%;left:60%;font-size:12px;text-align:center;width:8%;">100</div>' +
            '<div class="sa-cert-field" style="top:25%;left:60%;font-size:12px;text-align:center;width:8%;">100</div>' +
            '<div class="sa-cert-field" style="top:30%;left:60%;font-size:12px;text-align:center;width:8%;">100</div>' +
            '<div class="sa-cert-field" style="top:35%;left:60%;font-size:12px;text-align:center;width:8%;">100</div>' +
            '<div class="sa-cert-field" style="top:20%;left:68%;font-size:12px;text-align:center;width:8%;">40</div>' +
            '<div class="sa-cert-field" style="top:25%;left:68%;font-size:12px;text-align:center;width:8%;">40</div>' +
            '<div class="sa-cert-field" style="top:30%;left:68%;font-size:12px;text-align:center;width:8%;">40</div>' +
            '<div class="sa-cert-field" style="top:35%;left:68%;font-size:12px;text-align:center;width:8%;">40</div>' +
            '<div class="sa-cert-field" style="top:20%;left:77%;font-size:12px;text-align:center;width:10%;">' + written + '</div>' +
            '<div class="sa-cert-field" style="top:25%;left:77%;font-size:12px;text-align:center;width:10%;">' + practical + '</div>' +
            '<div class="sa-cert-field" style="top:30%;left:77%;font-size:12px;text-align:center;width:10%;">' + project + '</div>' +
            '<div class="sa-cert-field" style="top:35%;left:77%;font-size:12px;text-align:center;width:10%;">' + viva + '</div>' +
            '<div class="sa-cert-field" style="top:40.5%;left:68%;font-size:12px;text-align:center;width:19%;">' + (s.overall_percent ? s.overall_percent + '%' : '') + '</div>' +
            '<div class="sa-cert-field" style="top:45.5%;left:68%;font-size:12px;text-align:center;width:19%;">' + (s.performance || '').toUpperCase() + '</div>' +
            '<div class="sa-cert-field" style="top:83%;left:73%;font-size:11px;text-align:center;width:16%;">' + certDate + '</div>';
    }

    document.getElementById('saCertModal').classList.add('active');
    document.body.style.overflow = 'hidden';
}

function saCloseCertModal() {
    document.getElementById('saCertModal').classList.remove('active');
    document.body.style.overflow = '';
}

function saDownloadCertPdf() {
    var s = window._saCertStudentData;
    if (!s) return;

    var endpoint = _saCurrentDocType === 'certificate' ? '/certificate/download' : '/marksheet/download';
    var url = API_URL + '/admin' + endpoint + '?student_id=' + s.student_id;
    window.open(url, '_blank');
}

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') saCloseCertModal();
});
</script>
