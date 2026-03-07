<style>
/* ========== HERO ========== */
.sv-hero {
    background: #0a0a0a; padding: 80px 24px 60px; text-align: center;
    position: relative; overflow: hidden;
}
.sv-hero-glow {
    position: absolute; width: 600px; height: 400px; border-radius: 50%;
    background: radial-gradient(circle, rgba(96,165,250,0.08) 0%, transparent 70%);
    top: 20%; left: 50%; transform: translateX(-50%); pointer-events: none;
}
.sv-hero-label { font-size: 12px; text-transform: uppercase; letter-spacing: 0.12em; color: rgba(255,255,255,0.4); margin-bottom: 16px; }
.sv-hero-title { font-size: clamp(32px, 5vw, 52px); color: #fff; margin: 0 0 16px; letter-spacing: -0.02em; position: relative; z-index: 1; }
.sv-hero-desc { font-size: clamp(15px, 1.8vw, 17px); color: rgba(255,255,255,0.55); max-width: 550px; margin: 0 auto; line-height: 1.7; position: relative; z-index: 1; }

/* ========== SEARCH CARD ========== */
.sv-search-wrap {
    max-width: 520px; margin: -40px auto 0; position: relative; z-index: 10; padding: 0 24px;
}
.sv-search-card {
    background: #fff; border-radius: 20px; padding: 32px;
    box-shadow: 0 12px 40px rgba(0,0,0,0.1); border: 1px solid #e5e7eb;
}
.sv-search-title { font-size: 18px; color: #111; margin: 0 0 4px; }
.sv-search-desc { font-size: 13px; color: #9ca3af; margin: 0 0 20px; }
.sv-input-group { margin-bottom: 14px; }
.sv-input-label { display: block; font-size: 12px; color: #6b7280; text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 6px; }
.sv-input {
    width: 100%; border: 1px solid #e5e7eb; border-radius: 10px;
    padding: 12px 16px; font-size: 14px; outline: none; box-sizing: border-box;
    transition: border-color 0.2s; font-family: 'Hellix-Regular';
}
.sv-input:focus { border-color: #121212; }
.sv-input-row { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
.sv-search-btn {
    width: 100%; background: #121212; color: #fff; border: none; border-radius: 10px;
    padding: 14px; font-size: 15px; cursor: pointer; transition: all 0.2s;
    display: flex; align-items: center; justify-content: center; gap: 8px; margin-top: 4px;
}
.sv-search-btn:hover { background: #2a2a2a; transform: translateY(-1px); }
.sv-search-btn:disabled { opacity: 0.5; cursor: not-allowed; transform: none; }
.sv-search-btn svg { width: 18px; height: 18px; }

/* ========== LOADING ========== */
.sv-loading {
    display: none; text-align: center; padding: 60px 24px;
}
.sv-spinner {
    width: 36px; height: 36px; border: 3px solid #e5e7eb; border-top-color: #111;
    border-radius: 50%; animation: svSpin 0.7s linear infinite; margin: 0 auto 16px;
}
@keyframes svSpin { to { transform: rotate(360deg); } }

/* ========== RESULT ========== */
.sv-result {
    display: none; max-width: 1000px; margin: 0 auto; padding: 40px 24px 80px;
}
.sv-back-btn {
    display: inline-flex; align-items: center; gap: 6px; font-size: 13px;
    color: #6b7280; text-decoration: none; margin-bottom: 24px; cursor: pointer;
    background: none; border: none; transition: color 0.2s;
}
.sv-back-btn:hover { color: #111; }
.sv-back-btn svg { width: 16px; height: 16px; }

/* Profile header */
.sv-profile {
    display: flex; gap: 24px; align-items: flex-start;
    background: #fff; border: 1px solid #e5e7eb; border-radius: 20px;
    padding: 28px; margin-bottom: 20px;
}
.sv-profile-photo-wrap { position: relative; flex-shrink: 0; }
.sv-profile-photo {
    width: 120px; height: 120px; border-radius: 16px; object-fit: cover;
    border: 3px solid #f3f4f6;
}
.sv-profile-marksheet {
    position: absolute; bottom: -6px; right: -6px; background: #121212;
    color: #fff; padding: 3px 10px; border-radius: 20px; font-size: 11px;
    border: 2px solid #fff;
}
.sv-profile-info { flex: 1; }
.sv-profile-name { font-size: 22px; color: #111; margin: 0 0 4px; }
.sv-profile-reg { font-size: 14px; color: #6b7280; margin: 0 0 12px; }
.sv-profile-badges { display: flex; gap: 8px; flex-wrap: wrap; }
.sv-badge {
    display: inline-flex; align-items: center; gap: 5px;
    padding: 4px 12px; border-radius: 20px; font-size: 12px;
}
.sv-badge-green { background: #dcfce7; color: #15803d; }
.sv-badge-red { background: #fee2e2; color: #dc2626; }
.sv-badge-blue { background: #dbeafe; color: #1d4ed8; }
.sv-badge-gray { background: #f3f4f6; color: #374151; }
.sv-badge svg { width: 14px; height: 14px; }

/* Tabs */
.sv-tabs-bar {
    display: flex; gap: 4px; background: #f3f4f6; border-radius: 12px;
    padding: 4px; margin-bottom: 20px;
}
.sv-tab {
    flex: 1; padding: 10px 16px; border-radius: 10px; font-size: 13px;
    border: none; background: transparent; color: #6b7280;
    cursor: pointer; transition: all 0.2s; text-align: center; white-space: nowrap;
}
.sv-tab.active { background: #fff; color: #111; box-shadow: 0 1px 3px rgba(0,0,0,0.06); }
.sv-tab-content { display: none; }
.sv-tab-content.active { display: block; }

/* Info cards */
.sv-info-grid {
    display: grid; grid-template-columns: 1fr 1fr; gap: 20px;
}
.sv-info-card {
    background: #fff; border: 1px solid #e5e7eb; border-radius: 16px; padding: 24px;
}
.sv-info-card-title { font-size: 14px; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.06em; margin: 0 0 16px; }
.sv-info-row { display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #f9fafb; }
.sv-info-row:last-child { border-bottom: none; }
.sv-info-label { font-size: 13px; color: #9ca3af; }
.sv-info-value { font-size: 13px; color: #111; text-align: right; }

/* Aadhaar */
.sv-aadhaar {
    background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
    border: 1px solid #fbbf24; border-radius: 12px; padding: 16px 20px;
    margin-top: 20px; display: flex; align-items: center; gap: 12px;
}
.sv-aadhaar-icon { width: 20px; height: 20px; color: #92400e; }
.sv-aadhaar-label { font-size: 12px; color: #92400e; margin: 0; }
.sv-aadhaar-num { font-size: 18px; color: #78350f; margin: 0; letter-spacing: 0.1em; }

/* Marks table */
.sv-marks-course { font-size: 16px; color: #111; margin: 0 0 16px; text-align: center; }
.sv-marks-table { width: 100%; border-collapse: collapse; }
.sv-marks-table th {
    font-size: 11px; text-transform: uppercase; letter-spacing: 0.05em;
    color: #9ca3af; padding: 10px 14px; border-bottom: 1px solid #e5e7eb; text-align: left;
}
.sv-marks-table td { padding: 12px 14px; font-size: 13px; border-bottom: 1px solid #f3f4f6; }
.sv-marks-table tr:last-child td { border-bottom: none; }
.sv-marks-status {
    display: inline-block; padding: 2px 10px; border-radius: 20px; font-size: 11px;
}
.sv-marks-pass { background: #dcfce7; color: #15803d; }
.sv-marks-fail { background: #fee2e2; color: #dc2626; }

.sv-marks-summary {
    display: flex; gap: 16px; margin-top: 20px; justify-content: center;
}
.sv-marks-summary-item {
    text-align: center; padding: 16px 28px; border-radius: 12px;
    border: 1px solid #e5e7eb; background: #fff;
}
.sv-marks-summary-val { font-size: 22px; color: #111; margin: 0; }
.sv-marks-summary-label { font-size: 11px; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.05em; }

.sv-marks-empty {
    text-align: center; padding: 40px; color: #9ca3af;
}
.sv-marks-empty svg { width: 40px; height: 40px; margin: 0 auto 12px; stroke: #d1d5db; }

/* Fee cards */
.sv-fee-grid { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 16px; }
.sv-fee-card {
    padding: 24px; border-radius: 14px; text-align: center;
}
.sv-fee-card-green { background: #dcfce7; border: 1px solid #bbf7d0; }
.sv-fee-card-blue { background: #dbeafe; border: 1px solid #bfdbfe; }
.sv-fee-card-orange { background: #fef3c7; border: 1px solid #fde68a; }
.sv-fee-label { font-size: 13px; margin: 0 0 4px; }
.sv-fee-card-green .sv-fee-label { color: #15803d; }
.sv-fee-card-blue .sv-fee-label { color: #1d4ed8; }
.sv-fee-card-orange .sv-fee-label { color: #92400e; }
.sv-fee-amount { font-size: 28px; margin: 0; }
.sv-fee-card-green .sv-fee-amount { color: #166534; }
.sv-fee-card-blue .sv-fee-amount { color: #1e40af; }
.sv-fee-card-orange .sv-fee-amount { color: #78350f; }

/* Branch info */
.sv-branch-grid { display: grid; grid-template-columns: 1fr; gap: 0; }
.sv-branch-row {
    display: flex; padding: 12px 0; border-bottom: 1px solid #f3f4f6;
}
.sv-branch-row:last-child { border-bottom: none; }
.sv-branch-label { width: 140px; font-size: 13px; color: #9ca3af; flex-shrink: 0; }
.sv-branch-value { font-size: 13px; color: #111; }

/* ========== RESPONSIVE ========== */
@media (max-width: 768px) {
    .sv-profile { flex-direction: column; align-items: center; text-align: center; }
    .sv-profile-badges { justify-content: center; }
    .sv-info-grid { grid-template-columns: 1fr; }
    .sv-fee-grid { grid-template-columns: 1fr; }
    .sv-input-row { grid-template-columns: 1fr; }
    .sv-tabs-bar { overflow-x: auto; -webkit-overflow-scrolling: touch; }
    .sv-marks-summary { flex-wrap: wrap; }
}
</style>

{{-- ===== HERO ===== --}}
<div class="sv-hero">
    <div class="sv-hero-glow"></div>
    <div class="sv-hero-label font-HellixSB">Verify Your Records</div>
    <h1 class="sv-hero-title font-HellixB">Student Verification</h1>
    <p class="sv-hero-desc font-HellixR">Search and verify student information using your registration number and date of birth.</p>
</div>

{{-- ===== SEARCH ===== --}}
<div class="sv-search-wrap" id="svSearchWrap">
    <div class="sv-search-card">
        <div class="sv-search-title font-HellixB">Find Your Record</div>
        <div class="sv-search-desc font-HellixR">Enter your registration number and date of birth to view details.</div>
        <div class="sv-input-row">
            <div class="sv-input-group">
                <label class="sv-input-label font-HellixSB">Registration No *</label>
                <input type="text" id="svRegNo" class="sv-input" placeholder="e.g. C/0101XXXX">
            </div>
            <div class="sv-input-group">
                <label class="sv-input-label font-HellixSB">Date of Birth *</label>
                <input type="date" id="svDob" class="sv-input">
            </div>
        </div>
        <button class="sv-search-btn font-HellixSB" id="svSearchBtn" onclick="svSearch()">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            Search Student
        </button>
    </div>
</div>

{{-- ===== LOADING ===== --}}
<div class="sv-loading" id="svLoading">
    <div class="sv-spinner"></div>
    <div class="font-HellixR" style="color:#9ca3af;font-size:14px;">Searching student records...</div>
</div>

{{-- ===== RESULT ===== --}}
<div class="sv-result" id="svResult">
    <button class="sv-back-btn font-HellixR" onclick="svReset()">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        Search Again
    </button>

    {{-- Profile Header --}}
    <div class="sv-profile">
        <div class="sv-profile-photo-wrap">
            <img id="svPhoto" class="sv-profile-photo" src="{{ asset('assets/images/default_avatar.jpg') }}" alt="Student">
            <div class="sv-profile-marksheet font-HellixB" id="svMarksheetId" style="display:none;"></div>
        </div>
        <div class="sv-profile-info">
            <div class="sv-profile-name font-HellixB" id="svName"></div>
            <div class="sv-profile-reg font-HellixR" id="svRegDisplay"></div>
            <div class="sv-profile-badges" id="svBadges"></div>
        </div>
    </div>

    {{-- Tabs --}}
    <div class="sv-tabs-bar">
        <button class="sv-tab font-HellixSB active" data-sv-tab="info">Student Info</button>
        <button class="sv-tab font-HellixSB" data-sv-tab="academic">Academic</button>
        <button class="sv-tab font-HellixSB" data-sv-tab="branch">Branch</button>
        <button class="sv-tab font-HellixSB" data-sv-tab="fees">Fees</button>
    </div>

    {{-- Student Info --}}
    <div class="sv-tab-content active" data-sv-content="info">
        <div class="sv-info-grid">
            <div class="sv-info-card">
                <div class="sv-info-card-title font-HellixSB">Personal Information</div>
                <div class="sv-info-row"><span class="sv-info-label font-HellixR">Name</span><span class="sv-info-value font-HellixSB" id="svInfoName"></span></div>
                <div class="sv-info-row"><span class="sv-info-label font-HellixR">Registration No</span><span class="sv-info-value font-HellixSB" id="svInfoReg"></span></div>
                <div class="sv-info-row"><span class="sv-info-label font-HellixR">Email</span><span class="sv-info-value font-HellixR" id="svInfoEmail"></span></div>
                <div class="sv-info-row"><span class="sv-info-label font-HellixR">Phone</span><span class="sv-info-value font-HellixR" id="svInfoPhone"></span></div>
                <div class="sv-info-row"><span class="sv-info-label font-HellixR">Date of Birth</span><span class="sv-info-value font-HellixR" id="svInfoDob"></span></div>
            </div>
            <div class="sv-info-card">
                <div class="sv-info-card-title font-HellixSB">Family & Address</div>
                <div class="sv-info-row"><span class="sv-info-label font-HellixR">Father's Name</span><span class="sv-info-value font-HellixSB" id="svInfoFather"></span></div>
                <div class="sv-info-row"><span class="sv-info-label font-HellixR">Mother's Name</span><span class="sv-info-value font-HellixSB" id="svInfoMother"></span></div>
                <div class="sv-info-row"><span class="sv-info-label font-HellixR">Address</span><span class="sv-info-value font-HellixR" id="svInfoAddress"></span></div>
                <div class="sv-info-row"><span class="sv-info-label font-HellixR">City</span><span class="sv-info-value font-HellixR" id="svInfoCity"></span></div>
                <div class="sv-info-row"><span class="sv-info-label font-HellixR">State</span><span class="sv-info-value font-HellixR" id="svInfoState"></span></div>
            </div>
        </div>
        <div class="sv-aadhaar" id="svAadhaar">
            <svg class="sv-aadhaar-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0"/></svg>
            <div>
                <div class="sv-aadhaar-label font-HellixSB">Aadhaar Number</div>
                <div class="sv-aadhaar-num font-HellixB" id="svAadhaarNum"></div>
            </div>
        </div>
    </div>

    {{-- Academic --}}
    <div class="sv-tab-content" data-sv-content="academic">
        <div id="svMarksContent">
            <div class="sv-marks-course font-HellixSB" id="svCourseName"></div>
            <div style="background:#fff;border:1px solid #e5e7eb;border-radius:16px;overflow:hidden;">
                <table class="sv-marks-table">
                    <thead><tr>
                        <th class="font-HellixB">Subject</th>
                        <th class="font-HellixB">Marks</th>
                        <th class="font-HellixB">Percentage</th>
                        <th class="font-HellixB">Status</th>
                    </tr></thead>
                    <tbody id="svMarksBody"></tbody>
                </table>
            </div>
            <div class="sv-marks-summary" id="svMarksSummary"></div>
        </div>
        <div class="sv-marks-empty" id="svMarksEmpty" style="display:none;">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            <div class="font-HellixB" style="font-size:16px;color:#6b7280;">Marksheet Not Available</div>
            <div class="font-HellixR" style="font-size:13px;">The marksheet has not been verified yet for this student.</div>
        </div>
    </div>

    {{-- Branch --}}
    <div class="sv-tab-content" data-sv-content="branch">
        <div class="sv-info-card">
            <div class="sv-info-card-title font-HellixSB">Branch Information</div>
            <div id="svBranchInfo"></div>
        </div>
    </div>

    {{-- Fees --}}
    <div class="sv-tab-content" data-sv-content="fees">
        <div class="sv-fee-grid">
            <div class="sv-fee-card sv-fee-card-green">
                <div class="sv-fee-label font-HellixSB">Total Fees</div>
                <div class="sv-fee-amount font-HellixB" id="svTotalFee"></div>
            </div>
            <div class="sv-fee-card sv-fee-card-blue">
                <div class="sv-fee-label font-HellixSB">Paid Fees</div>
                <div class="sv-fee-amount font-HellixB" id="svPaidFee"></div>
            </div>
            <div class="sv-fee-card sv-fee-card-orange">
                <div class="sv-fee-label font-HellixSB">Due Fees</div>
                <div class="sv-fee-amount font-HellixB" id="svDueFee"></div>
            </div>
        </div>
    </div>
</div>

{{-- Spacer when only search is shown --}}
<div id="svSpacer" style="height:60px;"></div>

<script>
var SV_API = '{{ url("/api") }}';

document.addEventListener('DOMContentLoaded', function() {
    // Tab switching
    document.querySelectorAll('.sv-tab').forEach(function(tab) {
        tab.addEventListener('click', function() {
            document.querySelectorAll('.sv-tab').forEach(function(t) { t.classList.remove('active'); });
            document.querySelectorAll('.sv-tab-content').forEach(function(c) { c.classList.remove('active'); });
            tab.classList.add('active');
            var target = tab.getAttribute('data-sv-tab');
            document.querySelector('[data-sv-content="' + target + '"]').classList.add('active');
        });
    });

    // Check URL params
    var params = new URLSearchParams(window.location.search);
    var rn = params.get('rn');
    var dob = params.get('dob');
    if (rn && dob) {
        document.getElementById('svRegNo').value = rn;
        document.getElementById('svDob').value = dob;
        svSearch();
    }
});

function svSearch() {
    var regNo = document.getElementById('svRegNo').value.trim();
    var dob = document.getElementById('svDob').value;

    if (!regNo || !dob) {
        toastr.error('Please enter both Registration Number and Date of Birth.');
        return;
    }

    // Update URL
    var newUrl = '/student_info?rn=' + encodeURIComponent(regNo) + '&dob=' + encodeURIComponent(dob);
    history.replaceState(null, '', newUrl);

    // Show loading
    document.getElementById('svSearchWrap').style.display = 'none';
    document.getElementById('svSpacer').style.display = 'none';
    document.getElementById('svResult').style.display = 'none';
    document.getElementById('svLoading').style.display = 'block';

    fetch(SV_API + '/get_student_details', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ registration_number: regNo, dob: dob })
    })
    .then(function(r) { return r.json(); })
    .then(function(result) {
        document.getElementById('svLoading').style.display = 'none';
        if (result.error) {
            toastr.error(result.message || 'Student not found.');
            svReset();
            return;
        }
        svDisplayResult(result.data);
    })
    .catch(function() {
        document.getElementById('svLoading').style.display = 'none';
        toastr.error('Network error. Please try again.');
        svReset();
    });
}

function svReset() {
    document.getElementById('svSearchWrap').style.display = 'block';
    document.getElementById('svSpacer').style.display = 'block';
    document.getElementById('svResult').style.display = 'none';
    document.getElementById('svLoading').style.display = 'none';
    history.replaceState(null, '', '/student_info');
}

function svDisplayResult(d) {
    // Profile
    document.getElementById('svPhoto').src = d.student_photo || '{{ asset("assets/images/default_avatar.jpg") }}';
    document.getElementById('svName').textContent = d.student_name || '-';
    document.getElementById('svRegDisplay').textContent = d.registration_number || '-';

    // Marksheet ID
    var msId = document.getElementById('svMarksheetId');
    if (d.marksheet_id) {
        msId.textContent = '# ' + d.marksheet_id;
        msId.style.display = 'block';
    } else {
        msId.style.display = 'none';
    }

    // Badges
    var badges = '';
    if (d.marksheet_stage === 'verified') {
        badges += '<span class="sv-badge sv-badge-green font-HellixSB"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"/></svg>Certificate Verified</span>';
        badges += '<span class="sv-badge sv-badge-blue font-HellixSB"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"/></svg>Marksheet Verified</span>';
    } else {
        badges += '<span class="sv-badge sv-badge-red font-HellixSB">Certificate Not Provided</span>';
    }
    if (d.short_form) {
        badges += '<span class="sv-badge sv-badge-gray font-HellixSB">' + svEsc(d.short_form) + '</span>';
    }
    document.getElementById('svBadges').innerHTML = badges;

    // Student Info tab
    document.getElementById('svInfoName').textContent = d.student_name || '-';
    document.getElementById('svInfoReg').textContent = d.registration_number || '-';
    document.getElementById('svInfoEmail').textContent = d.student_email || '-';
    document.getElementById('svInfoPhone').textContent = d.student_phone || '-';
    document.getElementById('svInfoDob').textContent = d.dob || '-';
    document.getElementById('svInfoFather').textContent = d.student_father_name || '-';
    document.getElementById('svInfoMother').textContent = d.student_mother_name || '-';
    document.getElementById('svInfoAddress').textContent = d.address || '-';
    document.getElementById('svInfoCity').textContent = d.city || '-';
    document.getElementById('svInfoState').textContent = (d.state || '-') + (d.zip ? ' - ' + d.zip : '');

    // Aadhaar
    var aadhaar = document.getElementById('svAadhaar');
    if (d.aadhaar_number) {
        document.getElementById('svAadhaarNum').textContent = d.aadhaar_number;
        aadhaar.style.display = 'flex';
    } else {
        aadhaar.style.display = 'none';
    }

    // Academic tab
    document.getElementById('svCourseName').textContent = (d.course_name || '') + ' (' + (d.short_form || '') + ') - ' + (d.course_duration || '') + ' Months';

    if (d.marksheet_stage === 'verified' && d.marks) {
        document.getElementById('svMarksContent').style.display = 'block';
        document.getElementById('svMarksEmpty').style.display = 'none';

        var marks = JSON.parse(d.marks);
        var tbody = document.getElementById('svMarksBody');
        tbody.innerHTML = Object.entries(marks).map(function(entry) {
            var subject = entry[0];
            var score = parseFloat(entry[1]);
            var status = score >= 40 ? 'Pass' : 'Fail';
            var statusClass = score >= 40 ? 'sv-marks-pass' : 'sv-marks-fail';
            return '<tr>' +
                '<td class="font-HellixR">' + svEsc(subject) + '</td>' +
                '<td class="font-HellixSB">' + score + '</td>' +
                '<td class="font-HellixR">' + score + '%</td>' +
                '<td><span class="sv-marks-status ' + statusClass + ' font-HellixSB">' + status + '</span></td>' +
            '</tr>';
        }).join('');

        document.getElementById('svMarksSummary').innerHTML =
            '<div class="sv-marks-summary-item">' +
                '<div class="sv-marks-summary-val font-HellixB">' + (d.overall_percent || '-') + '%</div>' +
                '<div class="sv-marks-summary-label font-HellixR">Overall</div>' +
            '</div>' +
            '<div class="sv-marks-summary-item">' +
                '<div class="sv-marks-summary-val font-HellixB">' + svEsc(d.performance || '-') + '</div>' +
                '<div class="sv-marks-summary-label font-HellixR">Performance</div>' +
            '</div>';
    } else {
        document.getElementById('svMarksContent').style.display = 'none';
        document.getElementById('svMarksEmpty').style.display = 'block';
    }

    // Branch tab
    var branchRows = [
        ['Branch Name', d.branch_name],
        ['Branch Code', d.branch_code],
        ['Address', d.branch_address_line1],
        ['City', d.branch_city],
        ['State', d.branch_state],
        ['ZIP', d.branch_zip],
        ['Phone', d.branch_phone]
    ];
    document.getElementById('svBranchInfo').innerHTML = branchRows.map(function(row) {
        return '<div class="sv-branch-row">' +
            '<span class="sv-branch-label font-HellixR">' + row[0] + '</span>' +
            '<span class="sv-branch-value font-HellixSB">' + svEsc(row[1] || '-') + '</span>' +
        '</div>';
    }).join('');

    // Fee tab
    document.getElementById('svTotalFee').textContent = '\u20B9' + (d.total_fees || '0');
    document.getElementById('svPaidFee').textContent = '\u20B9' + (d.paid_fees || '0');
    document.getElementById('svDueFee').textContent = '\u20B9' + (d.due_fees || d.total_fees || '0');

    // Show result
    document.getElementById('svResult').style.display = 'block';

    // Reset to first tab
    document.querySelectorAll('.sv-tab').forEach(function(t) { t.classList.remove('active'); });
    document.querySelectorAll('.sv-tab-content').forEach(function(c) { c.classList.remove('active'); });
    document.querySelector('[data-sv-tab="info"]').classList.add('active');
    document.querySelector('[data-sv-content="info"]').classList.add('active');
}

function svEsc(text) {
    if (!text) return '';
    var d = document.createElement('div');
    d.textContent = text;
    return d.innerHTML;
}
</script>
