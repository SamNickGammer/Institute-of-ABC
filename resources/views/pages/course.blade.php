<style>
/* ========== COURSE HERO ========== */
.course-hero {
    background: #0a0a0a; padding: 80px 24px 60px; text-align: center;
    position: relative; overflow: hidden;
}
.course-hero-glow {
    position: absolute; width: 600px; height: 400px; border-radius: 50%;
    background: radial-gradient(circle, rgba(96,165,250,0.08) 0%, transparent 70%);
    top: 20%; left: 50%; transform: translateX(-50%); pointer-events: none;
}
.course-hero-label {
    font-size: 12px; text-transform: uppercase; letter-spacing: 0.12em;
    color: rgba(255,255,255,0.4); margin-bottom: 16px;
}
.course-hero-title {
    font-size: clamp(32px, 5vw, 52px); color: #fff; margin: 0 0 16px;
    letter-spacing: -0.02em; position: relative; z-index: 1;
}
.course-hero-desc {
    font-size: clamp(15px, 1.8vw, 17px); color: rgba(255,255,255,0.55);
    max-width: 580px; margin: 0 auto; line-height: 1.7; position: relative; z-index: 1;
}
.course-hero-stats {
    display: flex; justify-content: center; gap: 40px; margin-top: 36px;
    position: relative; z-index: 1;
}
.course-hero-stat-num { font-size: 28px; color: #fff; margin: 0; }
.course-hero-stat-label { font-size: 12px; color: rgba(255,255,255,0.4); text-transform: uppercase; letter-spacing: 0.08em; }

/* ========== FILTER ========== */
.course-filter-bar {
    background: #fff; border-bottom: 1px solid #e5e7eb; position: sticky;
    top: 72px; z-index: 50; padding: 14px 24px;
}
.course-filter-inner {
    max-width: 1100px; margin: 0 auto; display: flex; gap: 8px;
    flex-wrap: wrap; align-items: center;
}
.course-filter-btn {
    padding: 8px 18px; border-radius: 20px; font-size: 13px;
    border: 1px solid #e5e7eb; background: #fff; color: #6b7280;
    cursor: pointer; transition: all 0.2s; white-space: nowrap;
}
.course-filter-btn:hover { border-color: #d1d5db; color: #111; }
.course-filter-btn.active { background: #121212; color: #fff; border-color: #121212; }

/* ========== COURSE GRID ========== */
.course-list-section {
    max-width: 1100px; margin: 0 auto; padding: 40px 24px 80px;
}
.course-count {
    font-size: 14px; color: #9ca3af; margin: 0 0 24px;
}
.course-count span { color: #111; }
.course-list-grid {
    display: grid; grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
    gap: 20px;
}

/* ========== COURSE CARD ========== */
.crs-card {
    background: #fff; border: 1px solid #e5e7eb; border-radius: 16px;
    overflow: hidden; transition: all 0.3s; cursor: pointer;
}
.crs-card:hover { border-color: transparent; box-shadow: 0 12px 36px rgba(0,0,0,0.08); transform: translateY(-4px); }
.crs-card-header {
    padding: 24px 24px 0; display: flex; justify-content: space-between; align-items: flex-start;
}
.crs-card-badge {
    display: inline-block; padding: 4px 12px; border-radius: 20px; font-size: 11px;
    text-transform: uppercase; letter-spacing: 0.06em;
}
.crs-card-badge-computer { background: #eff6ff; color: #2563eb; }
.crs-card-badge-vocational { background: #fef9c3; color: #a16207; }
.crs-card-duration {
    font-size: 12px; color: #9ca3af; display: flex; align-items: center; gap: 4px;
}
.crs-card-duration svg { width: 14px; height: 14px; }
.crs-card-body { padding: 16px 24px 0; }
.crs-card-short { font-size: 32px; color: #111; margin: 0 0 2px; letter-spacing: -0.02em; }
.crs-card-name { font-size: 14px; color: #6b7280; margin: 0 0 12px; }
.crs-card-desc { font-size: 13px; color: #9ca3af; margin: 0 0 16px; line-height: 1.6; }
.crs-card-topics { display: flex; flex-wrap: wrap; gap: 6px; margin-bottom: 16px; }
.crs-card-topic {
    padding: 4px 10px; border-radius: 6px; background: #f3f4f6;
    font-size: 11px; color: #4b5563;
}
.crs-card-footer {
    padding: 16px 24px; border-top: 1px solid #f3f4f6;
    display: flex; justify-content: space-between; align-items: center;
}
.crs-card-fee { font-size: 20px; color: #111; margin: 0; }
.crs-card-fee-label { font-size: 11px; color: #9ca3af; }
.crs-card-enroll {
    display: inline-flex; align-items: center; gap: 6px; font-size: 13px;
    color: #2563eb; text-decoration: none; transition: gap 0.2s;
}
.crs-card-enroll:hover { gap: 10px; }
.crs-card-enroll svg { width: 14px; height: 14px; }

/* ========== DETAIL MODAL ========== */
.crs-modal-overlay {
    position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 9999;
    display: none; align-items: center; justify-content: center;
    backdrop-filter: blur(4px); padding: 24px;
}
.crs-modal-overlay.open { display: flex; }
.crs-modal {
    background: #fff; border-radius: 20px; width: 100%; max-width: 640px;
    max-height: 90vh; overflow-y: auto; box-shadow: 0 20px 60px rgba(0,0,0,0.2);
}
.crs-modal-header {
    padding: 32px 32px 0; position: relative;
}
.crs-modal-close {
    position: absolute; top: 20px; right: 20px; background: #f3f4f6;
    border: none; border-radius: 50%; width: 36px; height: 36px;
    display: flex; align-items: center; justify-content: center; cursor: pointer;
    transition: background 0.2s;
}
.crs-modal-close:hover { background: #e5e7eb; }
.crs-modal-close svg { width: 16px; height: 16px; }
.crs-modal-badge { margin-bottom: 12px; }
.crs-modal-short { font-size: 36px; color: #111; margin: 0 0 4px; letter-spacing: -0.02em; }
.crs-modal-name { font-size: 16px; color: #6b7280; margin: 0 0 20px; }
.crs-modal-meta {
    display: flex; gap: 24px; padding: 16px 0; border-top: 1px solid #f3f4f6;
    border-bottom: 1px solid #f3f4f6;
}
.crs-modal-meta-item { text-align: center; flex: 1; }
.crs-modal-meta-val { font-size: 18px; color: #111; margin: 0; }
.crs-modal-meta-label { font-size: 11px; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.06em; }

.crs-modal-body { padding: 24px 32px 32px; }
.crs-modal-section-title { font-size: 15px; color: #111; margin: 0 0 12px; }
.crs-modal-desc { font-size: 14px; color: #4b5563; line-height: 1.8; margin: 0 0 24px; }
.crs-modal-topics {
    display: grid; grid-template-columns: 1fr 1fr; gap: 8px; margin-bottom: 24px;
}
.crs-modal-topic {
    display: flex; align-items: center; gap: 8px; padding: 10px 14px;
    border-radius: 10px; background: #f9fafb; font-size: 13px; color: #374151;
}
.crs-modal-topic svg { width: 16px; height: 16px; color: #16a34a; flex-shrink: 0; }
.crs-modal-eval-title { font-size: 15px; color: #111; margin: 0 0 10px; }
.crs-modal-eval { display: flex; gap: 10px; flex-wrap: wrap; }
.crs-modal-eval-item {
    padding: 8px 14px; border-radius: 8px; border: 1px solid #e5e7eb;
    font-size: 12px; color: #6b7280;
}

/* ========== CTA BOTTOM ========== */
.course-cta {
    background: #121212; padding: 64px 24px; text-align: center;
}
.course-cta-title { font-size: clamp(24px, 3.5vw, 36px); color: #fff; margin: 0 0 12px; }
.course-cta-desc { font-size: 15px; color: rgba(255,255,255,0.5); margin: 0 0 28px; max-width: 460px; margin-left: auto; margin-right: auto; }
.course-cta-btn {
    display: inline-flex; align-items: center; gap: 8px;
    background: #fff; color: #111; padding: 14px 32px; border-radius: 12px;
    font-size: 15px; text-decoration: none; border: none; cursor: pointer; transition: all 0.25s;
}
.course-cta-btn:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(255,255,255,0.15); }

@media (max-width: 768px) {
    .course-list-grid { grid-template-columns: 1fr; }
    .course-hero-stats { gap: 24px; }
    .course-hero-stat-num { font-size: 22px; }
    .crs-modal-topics { grid-template-columns: 1fr; }
    .crs-modal-header { padding: 24px 24px 0; }
    .crs-modal-body { padding: 20px 24px 24px; }
    .course-filter-bar { top: 64px; }
}
@media (max-width: 480px) {
    .course-hero-stats { gap: 16px; flex-wrap: wrap; }
}
</style>

{{-- ===== HERO ===== --}}
<div class="course-hero">
    <div class="course-hero-glow"></div>
    <div class="course-hero-label font-HellixSB">Professional Training Programs</div>
    <h1 class="course-hero-title font-HellixB">Our Courses</h1>
    <p class="course-hero-desc font-HellixR">From basic computer skills to advanced programming and vocational training &mdash; choose the right course to launch your career.</p>
    <div class="course-hero-stats">
        <div>
            <div class="course-hero-stat-num font-HellixB" id="crsStatTotal">0</div>
            <div class="course-hero-stat-label font-HellixR">Courses</div>
        </div>
        <div>
            <div class="course-hero-stat-num font-HellixB">3-12</div>
            <div class="course-hero-stat-label font-HellixR">Months</div>
        </div>
        <div>
            <div class="course-hero-stat-num font-HellixB">100%</div>
            <div class="course-hero-stat-label font-HellixR">Certified</div>
        </div>
    </div>
</div>

{{-- ===== FILTER BAR ===== --}}
<div class="course-filter-bar">
    <div class="course-filter-inner">
        <button class="course-filter-btn font-HellixSB active" data-filter="all">All Courses</button>
        <button class="course-filter-btn font-HellixSB" data-filter="computer">Computer</button>
        <button class="course-filter-btn font-HellixSB" data-filter="vocational">Vocational</button>
        <button class="course-filter-btn font-HellixSB" data-filter="3">3 Months</button>
        <button class="course-filter-btn font-HellixSB" data-filter="6">6 Months</button>
        <button class="course-filter-btn font-HellixSB" data-filter="12">12 Months</button>
    </div>
</div>

{{-- ===== COURSE LIST ===== --}}
<div class="course-list-section">
    <div class="course-count font-HellixR">Showing <span class="font-HellixSB" id="crsShowing">0</span> courses</div>
    <div class="course-list-grid" id="crsGrid"></div>
</div>

{{-- ===== DETAIL MODAL ===== --}}
<div class="crs-modal-overlay" id="crsModal">
    <div class="crs-modal">
        <div class="crs-modal-header">
            <button class="crs-modal-close" onclick="closeCrsModal()">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
            <div class="crs-modal-badge" id="crsModalBadge"></div>
            <div class="crs-modal-short font-HellixEB" id="crsModalShort"></div>
            <div class="crs-modal-name font-HellixR" id="crsModalName"></div>
            <div class="crs-modal-meta">
                <div class="crs-modal-meta-item">
                    <div class="crs-modal-meta-val font-HellixB" id="crsModalDuration"></div>
                    <div class="crs-modal-meta-label font-HellixR">Duration</div>
                </div>
                <div class="crs-modal-meta-item">
                    <div class="crs-modal-meta-val font-HellixB" id="crsModalFee"></div>
                    <div class="crs-modal-meta-label font-HellixR">Course Fee</div>
                </div>
                <div class="crs-modal-meta-item">
                    <div class="crs-modal-meta-val font-HellixB">Certified</div>
                    <div class="crs-modal-meta-label font-HellixR">Status</div>
                </div>
            </div>
        </div>
        <div class="crs-modal-body">
            <div class="crs-modal-section-title font-HellixB">About This Course</div>
            <div class="crs-modal-desc font-HellixR" id="crsModalDesc"></div>

            <div class="crs-modal-section-title font-HellixB">What You'll Learn</div>
            <div class="crs-modal-topics" id="crsModalTopics"></div>

            <div class="crs-modal-eval-title font-HellixB">Evaluation Method</div>
            <div class="crs-modal-eval" id="crsModalEval"></div>
        </div>
    </div>
</div>

{{-- ===== CTA ===== --}}
<div class="course-cta">
    <h2 class="course-cta-title font-HellixB">Can't Decide?</h2>
    <p class="course-cta-desc font-HellixR">Visit our nearest branch or call us to get personalized guidance on the best course for your career goals.</p>
    <a href="{{ route('contact') }}" class="course-cta-btn font-HellixSB">
        Contact Us
        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
    </a>
</div>

<script>
var COURSE_DETAILS = {
    'DCA': {
        category: 'computer',
        description: 'Diploma in Computer Applications (DCA) is a comprehensive 6-month program designed to provide essential computer skills. From operating systems to office applications and internet fundamentals, this course prepares students for entry-level IT roles and everyday computing tasks.',
        topics: ['Computer Fundamentals & OS', 'MS Word & Document Processing', 'MS Excel & Data Management', 'MS PowerPoint Presentations', 'Internet & Email Basics', 'Hindi & English Typing', 'Basic Database Concepts', 'Computer Hardware Basics']
    },
    'ADCA': {
        category: 'computer',
        description: 'Advanced Diploma in Computer Applications (ADCA) is our flagship 12-month program that covers everything from basic computing to advanced applications. Students gain in-depth knowledge of programming, web design, accounting software, and advanced office tools making them industry-ready professionals.',
        topics: ['All DCA Subjects', 'Advanced Excel & Formulas', 'Tally ERP & Accounting', 'Web Design (HTML/CSS)', 'Programming Fundamentals', 'Database Management', 'PhotoShop & Graphic Design', 'Project Work & Viva']
    },
    'CFA': {
        category: 'computer',
        description: 'Certificate in Financial Accounting (CFA) is a focused 3-month course that teaches professional accounting using Tally and other financial software. Perfect for students aiming for careers in accounting, banking, or finance departments.',
        topics: ['Accounting Fundamentals', 'Tally ERP 9 / Prime', 'GST & Tax Computation', 'Inventory Management', 'Payroll Management', 'Balance Sheet & P&L', 'Banking Transactions', 'Financial Reporting']
    },
    'CCA': {
        category: 'computer',
        description: 'Certificate in Computer Applications (CCA) is a quick 3-month introductory course ideal for beginners. It covers the essential computer skills needed for office work, data entry, and basic digital literacy.',
        topics: ['Computer Basics & OS', 'MS Word Essentials', 'MS Excel Basics', 'MS PowerPoint', 'Internet & Browsing', 'Email Communication', 'Hindi & English Typing', 'Basic Troubleshooting']
    },
    'DCP': {
        category: 'computer',
        description: 'Diploma in Computer Programming (DCP) is a 6-month course focused on building strong programming fundamentals. Students learn coding logic, popular programming languages, and develop real-world projects preparing them for software development careers.',
        topics: ['Programming Logic & Flowcharts', 'C Programming Language', 'C++ & Object-Oriented Programming', 'HTML, CSS & JavaScript', 'Database with SQL', 'Python Basics', 'Project Development', 'Problem Solving & Algorithms']
    },
    'DCTT': {
        category: 'computer',
        description: 'Diploma in Computer Teacher Training (DCTT) is a 12-month specialized program for aspiring computer educators. It combines advanced computer knowledge with teaching methodology, communication skills, and classroom management techniques.',
        topics: ['Advanced Computer Applications', 'Teaching Methodology', 'Communication Skills', 'Classroom Management', 'Curriculum Design', 'Presentation & Public Speaking', 'Practical Lab Management', 'Educational Technology']
    },
    'Ms Office': {
        category: 'computer',
        description: 'Microsoft Office course is a focused 3-month program that provides mastery over the complete MS Office suite. Essential for anyone seeking office jobs, data management roles, or wanting to boost their productivity skills.',
        topics: ['MS Word Advanced', 'MS Excel with Formulas & Charts', 'MS PowerPoint Design', 'MS Access Database', 'MS Outlook & Email', 'Document Formatting', 'Data Analysis Basics', 'Office Productivity Tips']
    },
    'DBC': {
        category: 'vocational',
        description: 'Diploma in Beauty Culture (DBC) is a 6-month vocational program covering professional beauty treatments, skincare, hair styling, and salon management. Designed for students who want to build a career in the thriving beauty and wellness industry.',
        topics: ['Skin Care & Facial Treatments', 'Hair Cutting & Styling', 'Makeup Artistry', 'Mehandi Design', 'Nail Art & Manicure', 'Bridal Makeup', 'Salon Management', 'Hygiene & Safety Standards']
    },
    'DST': {
        category: 'vocational',
        description: 'Diploma in Stitching and Tailoring (DST) is a 6-month vocational course that teaches professional garment construction, pattern making, and fashion design basics. Students learn to create various garments and can start their own tailoring business.',
        topics: ['Sewing Machine Operation', 'Pattern Making & Cutting', 'Blouse & Kurti Stitching', 'Salwar & Palazzo Making', 'Dress Designing Basics', 'Embroidery & Handwork', 'Alterations & Repairs', 'Business & Self-Employment']
    }
};

var allCourses = [];
var filteredCourses = [];

document.addEventListener('DOMContentLoaded', function() {
    // Load from API
    fetch('{{ url("/api") }}/admin/branch/get_all_courses?showActiveOnly=true')
    .then(function(r) { return r.json(); })
    .then(function(result) {
        if (!result.error && result.data) {
            allCourses = result.data.map(function(c) {
                var details = COURSE_DETAILS[c.short_form] || {};
                return {
                    id: c.course_id,
                    name: c.course_name,
                    short: c.short_form,
                    duration: c.course_duration,
                    fee: parseFloat(c.course_fees),
                    subjects: c.subjects,
                    category: details.category || 'computer',
                    description: details.description || 'A professional course offered by Institute of ABC to help students build practical skills and gain recognized certification.',
                    topics: details.topics || ['Theory Classes', 'Practical Sessions', 'Project Work', 'Viva Examination']
                };
            });
            document.getElementById('crsStatTotal').textContent = allCourses.length;
            filterCourses('all');
        }
    })
    .catch(function() {
        document.getElementById('crsGrid').innerHTML = '<p style="color:#dc2626;grid-column:1/-1;text-align:center;padding:40px;">Failed to load courses.</p>';
    });

    // Filter buttons
    document.querySelectorAll('.course-filter-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.course-filter-btn').forEach(function(b) { b.classList.remove('active'); });
            btn.classList.add('active');
            filterCourses(btn.getAttribute('data-filter'));
        });
    });
});

function filterCourses(filter) {
    if (filter === 'all') {
        filteredCourses = allCourses;
    } else if (filter === 'computer' || filter === 'vocational') {
        filteredCourses = allCourses.filter(function(c) { return c.category === filter; });
    } else {
        var months = parseInt(filter);
        filteredCourses = allCourses.filter(function(c) { return c.duration === months; });
    }
    document.getElementById('crsShowing').textContent = filteredCourses.length;
    renderCourses();
}

function renderCourses() {
    var grid = document.getElementById('crsGrid');
    grid.innerHTML = filteredCourses.map(function(c, i) {
        var badgeClass = c.category === 'vocational' ? 'crs-card-badge-vocational' : 'crs-card-badge-computer';
        var badgeText = c.category === 'vocational' ? 'Vocational' : 'Computer';
        var topicsPreview = c.topics.slice(0, 4).map(function(t) {
            return '<span class="crs-card-topic font-HellixR">' + escH(t) + '</span>';
        }).join('');

        return '<div class="crs-card" onclick="openCrsModal(' + i + ')" style="animation:fadeUp 0.4s ' + (i * 0.06) + 's ease both;">' +
            '<div class="crs-card-header">' +
                '<span class="crs-card-badge ' + badgeClass + ' font-HellixSB">' + badgeText + '</span>' +
                '<span class="crs-card-duration font-HellixR">' +
                    '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>' +
                    c.duration + ' Months' +
                '</span>' +
            '</div>' +
            '<div class="crs-card-body">' +
                '<div class="crs-card-short font-HellixEB">' + escH(c.short) + '</div>' +
                '<div class="crs-card-name font-HellixR">' + escH(c.name) + '</div>' +
                '<div class="crs-card-desc font-HellixR">' + escH(c.description.substring(0, 120)) + '...</div>' +
                '<div class="crs-card-topics">' + topicsPreview + '</div>' +
            '</div>' +
            '<div class="crs-card-footer">' +
                '<div>' +
                    '<div class="crs-card-fee font-HellixB">&#8377;' + c.fee.toLocaleString('en-IN') + '</div>' +
                    '<div class="crs-card-fee-label font-HellixR">Course Fee</div>' +
                '</div>' +
                '<span class="crs-card-enroll font-HellixSB">' +
                    'View Details <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>' +
                '</span>' +
            '</div>' +
        '</div>';
    }).join('');
}

function openCrsModal(index) {
    var c = filteredCourses[index];
    if (!c) return;

    var badgeClass = c.category === 'vocational' ? 'crs-card-badge-vocational' : 'crs-card-badge-computer';
    var badgeText = c.category === 'vocational' ? 'Vocational' : 'Computer';

    document.getElementById('crsModalBadge').innerHTML = '<span class="crs-card-badge ' + badgeClass + ' font-HellixSB">' + badgeText + '</span>';
    document.getElementById('crsModalShort').textContent = c.short;
    document.getElementById('crsModalName').textContent = c.name;
    document.getElementById('crsModalDuration').textContent = c.duration + ' Months';
    document.getElementById('crsModalFee').textContent = '\u20B9' + c.fee.toLocaleString('en-IN');
    document.getElementById('crsModalDesc').textContent = c.description;

    document.getElementById('crsModalTopics').innerHTML = c.topics.map(function(t) {
        return '<div class="crs-modal-topic font-HellixR">' +
            '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>' +
            escH(t) +
        '</div>';
    }).join('');

    var evalItems = (c.subjects || '').split(',').map(function(s) {
        return '<div class="crs-modal-eval-item font-HellixR">' + escH(s.trim()) + '</div>';
    }).join('');
    document.getElementById('crsModalEval').innerHTML = evalItems;

    document.getElementById('crsModal').classList.add('open');
    document.body.style.overflow = 'hidden';
}

function closeCrsModal() {
    document.getElementById('crsModal').classList.remove('open');
    document.body.style.overflow = '';
}

document.getElementById('crsModal').addEventListener('click', function(e) {
    if (e.target === this) closeCrsModal();
});
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeCrsModal();
});

function escH(text) {
    if (!text) return '';
    var d = document.createElement('div');
    d.textContent = text;
    return d.innerHTML;
}
</script>
<style>
@keyframes fadeUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>
