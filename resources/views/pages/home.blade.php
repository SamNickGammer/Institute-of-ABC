<style>
/* ========== HERO ========== */
.hero-section {
    position: relative; min-height: 100vh; display: flex; align-items: center;
    justify-content: center; overflow: hidden; background: #0a0a0a;
}
.hero-bg {
    position: absolute; inset: 0; z-index: 0;
}
.hero-bg img {
    width: 100%; height: 100%; object-fit: cover; opacity: 0.55;
}
.hero-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(180deg, rgba(0,0,0,0.3) 0%, rgba(0,0,0,0.6) 60%, rgba(0,0,0,0.9) 100%);
    z-index: 1;
}
.hero-content {
    position: relative; z-index: 2; text-align: center; color: #fff;
    max-width: 820px; padding: 0 24px;
}
.hero-badge {
    display: inline-flex; align-items: center; gap: 8px;
    background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2);
    border-radius: 30px; padding: 6px 18px; font-size: 13px; margin-bottom: 28px;
    backdrop-filter: blur(8px);
    animation: fadeInUp 0.8s ease both;
}
.hero-badge-dot {
    width: 7px; height: 7px; background: #22c55e; border-radius: 50%;
    animation: pulse-dot 2s ease infinite;
}
@keyframes pulse-dot {
    0%, 100% { opacity: 1; transform: scale(1); }
    50% { opacity: 0.5; transform: scale(1.4); }
}
.hero-title {
    font-size: clamp(36px, 6vw, 68px); line-height: 1.08; margin: 0 0 20px;
    letter-spacing: -0.02em;
    animation: fadeInUp 0.8s 0.15s ease both;
}
.hero-title-gradient {
    background: linear-gradient(135deg, #fff 30%, #60a5fa 70%);
    -webkit-background-clip: text; -webkit-text-fill-color: transparent;
    background-clip: text;
}
.hero-subtitle {
    font-size: clamp(15px, 2vw, 18px); color: rgba(255,255,255,0.7);
    line-height: 1.6; margin: 0 0 36px; max-width: 600px; margin-left: auto; margin-right: auto;
    animation: fadeInUp 0.8s 0.3s ease both;
}
.hero-actions {
    display: flex; gap: 14px; justify-content: center; flex-wrap: wrap;
    animation: fadeInUp 0.8s 0.45s ease both;
}
.hero-btn {
    display: inline-flex; align-items: center; gap: 8px; padding: 14px 32px;
    border-radius: 12px; font-size: 15px; text-decoration: none; transition: all 0.25s;
    border: none; cursor: pointer;
}
.hero-btn-primary {
    background: #fff; color: #111;
}
.hero-btn-primary:hover { background: #f3f4f6; transform: translateY(-2px); box-shadow: 0 8px 24px rgba(255,255,255,0.15); }
.hero-btn-ghost {
    background: rgba(255,255,255,0.08); color: #fff; border: 1px solid rgba(255,255,255,0.2);
}
.hero-btn-ghost:hover { background: rgba(255,255,255,0.15); transform: translateY(-2px); }
.hero-btn svg { width: 18px; height: 18px; }

/* Scroll indicator */
.hero-scroll {
    position: absolute; bottom: 32px; left: 50%; transform: translateX(-50%); z-index: 2;
    animation: floatY 2.5s ease infinite;
}
@keyframes floatY {
    0%, 100% { transform: translateX(-50%) translateY(0); }
    50% { transform: translateX(-50%) translateY(8px); }
}
.hero-scroll-inner {
    width: 28px; height: 44px; border: 2px solid rgba(255,255,255,0.3);
    border-radius: 14px; display: flex; justify-content: center; padding-top: 8px;
}
.hero-scroll-dot {
    width: 4px; height: 10px; background: rgba(255,255,255,0.6);
    border-radius: 2px; animation: scrollDot 1.8s ease infinite;
}
@keyframes scrollDot {
    0% { opacity: 1; transform: translateY(0); }
    100% { opacity: 0; transform: translateY(12px); }
}

/* Stats bar floating at bottom of hero */
.hero-stats {
    position: absolute; bottom: 0; left: 0; right: 0; z-index: 3;
    display: flex; justify-content: center;
}
.hero-stats-inner {
    display: flex; background: rgba(255,255,255,0.06); backdrop-filter: blur(16px);
    border: 1px solid rgba(255,255,255,0.1); border-bottom: none;
    border-radius: 20px 20px 0 0; padding: 20px 48px; gap: 48px;
    animation: fadeInUp 0.8s 0.6s ease both;
}
.hero-stat { text-align: center; }
.hero-stat-num { font-size: 28px; color: #fff; margin: 0; }
.hero-stat-label { font-size: 12px; color: rgba(255,255,255,0.5); text-transform: uppercase; letter-spacing: 0.08em; margin-top: 2px; }

/* ========== CERTIFIED BY ========== */
.certified-section {
    padding: 72px 24px; background: #fff; overflow: hidden;
}
.section-header {
    text-align: center; margin-bottom: 40px;
}
.section-label {
    display: inline-block; font-size: 12px; text-transform: uppercase;
    letter-spacing: 0.12em; color: #9ca3af; margin-bottom: 8px;
}
.section-title {
    font-size: clamp(24px, 3.5vw, 36px); color: #111; margin: 0;
    letter-spacing: -0.01em;
}
.section-line {
    width: 48px; height: 3px; background: #121212; border-radius: 2px;
    margin: 16px auto 0;
}

.cert-track {
    display: flex; align-items: center; justify-content: center; gap: 40px;
    flex-wrap: wrap; max-width: 1000px; margin: 0 auto;
}
.cert-logo {
    height: 70px; object-fit: contain; filter: grayscale(100%); opacity: 0.6;
    transition: all 0.3s;
}
.cert-logo:hover { filter: grayscale(0); opacity: 1; transform: scale(1.08); }

/* ========== COURSES ========== */
.courses-section {
    padding: 80px 24px; background: #f9fafb;
}
.courses-grid {
    display: grid; grid-template-columns: repeat(4, 1fr);
    gap: 20px; max-width: 1100px; margin: 0 auto;
}
.course-card {
    background: #fff; border-radius: 16px; overflow: hidden;
    border: 1px solid #e5e7eb; transition: all 0.3s;
    opacity: 0; transform: translateY(24px);
}
.course-card.visible { opacity: 1; transform: translateY(0); }
.course-card:hover { transform: translateY(-6px); box-shadow: 0 12px 32px rgba(0,0,0,0.08); border-color: transparent; }
.course-card-img {
    width: 100%; height: 170px; object-fit: cover;
}
.course-card-body { padding: 18px 20px; }
.course-card-title { font-size: 18px; color: #111; margin: 0 0 4px; }
.course-card-desc { font-size: 13px; color: #6b7280; margin: 0 0 14px; line-height: 1.5; }
.course-card-link {
    display: inline-flex; align-items: center; gap: 6px; font-size: 13px;
    color: #2563eb; text-decoration: none; transition: gap 0.2s;
}
.course-card-link:hover { gap: 10px; }
.course-card-link svg { width: 14px; height: 14px; }

/* ========== WHY CHOOSE US ========== */
.why-section {
    padding: 80px 24px; background: #fff;
}
.why-grid {
    display: grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
    gap: 20px; max-width: 1100px; margin: 0 auto;
}
.why-card {
    padding: 28px; border-radius: 16px; border: 1px solid #e5e7eb;
    transition: all 0.3s; position: relative; overflow: hidden;
}
.why-card:hover { border-color: #121212; transform: translateY(-4px); box-shadow: 0 8px 24px rgba(0,0,0,0.06); }
.why-card-icon {
    width: 48px; height: 48px; border-radius: 12px; background: #f3f4f6;
    display: flex; align-items: center; justify-content: center; margin-bottom: 16px;
    transition: all 0.3s;
}
.why-card:hover .why-card-icon { background: #121212; }
.why-card:hover .why-card-icon svg { stroke: #fff; }
.why-card-icon svg { width: 24px; height: 24px; stroke: #374151; transition: stroke 0.3s; }
.why-card-title { font-size: 16px; color: #111; margin: 0 0 8px; }
.why-card-desc { font-size: 13px; color: #6b7280; margin: 0; line-height: 1.6; }

/* ========== TESTIMONIALS ========== */
.testimonials-section {
    padding: 80px 24px; background: #f9fafb; overflow: hidden;
}
.testimonial-track-wrapper {
    position: relative; max-width: 100vw; overflow: hidden;
    mask-image: linear-gradient(90deg, transparent, #000 10%, #000 90%, transparent);
    -webkit-mask-image: linear-gradient(90deg, transparent, #000 10%, #000 90%, transparent);
}
.testimonial-track {
    display: flex; gap: 20px; width: max-content;
    animation: scrollTrack 30s linear infinite;
}
.testimonial-track:hover { animation-play-state: paused; }
@keyframes scrollTrack {
    0% { transform: translateX(0); }
    100% { transform: translateX(-50%); }
}
.testimonial-card {
    width: 360px; flex-shrink: 0; background: #fff; border-radius: 16px;
    padding: 24px; border: 1px solid #e5e7eb; transition: all 0.3s;
}
.testimonial-card:hover { border-color: #d1d5db; box-shadow: 0 4px 16px rgba(0,0,0,0.04); }
.testimonial-stars { display: flex; gap: 3px; margin-bottom: 14px; }
.testimonial-stars svg { width: 16px; height: 16px; }
.testimonial-text { font-size: 14px; color: #374151; line-height: 1.7; margin: 0 0 16px; }
.testimonial-author { display: flex; align-items: center; gap: 12px; }
.testimonial-avatar {
    width: 40px; height: 40px; border-radius: 50%; object-fit: cover;
    background: #e5e7eb;
}
.testimonial-name { font-size: 14px; color: #111; margin: 0; }
.testimonial-role { font-size: 12px; color: #9ca3af; margin: 0; }

/* ========== GALLERY ========== */
.gallery-section {
    padding: 80px 24px; background: #fff;
}
.gallery-grid {
    display: grid; grid-template-columns: repeat(4, 1fr);
    gap: 12px; max-width: 1100px; margin: 0 auto;
}
.gallery-item {
    position: relative; border-radius: 14px; overflow: hidden;
    aspect-ratio: 4/3; cursor: pointer;
}
.gallery-item:nth-child(1) { grid-column: span 2; grid-row: span 2; aspect-ratio: auto; }
.gallery-item img {
    width: 100%; height: 100%; object-fit: cover;
    transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
}
.gallery-item:hover img { transform: scale(1.06); }
.gallery-item-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(180deg, transparent 40%, rgba(0,0,0,0.7) 100%);
    opacity: 0; transition: opacity 0.3s; display: flex; flex-direction: column;
    justify-content: flex-end; padding: 20px;
}
.gallery-item:hover .gallery-item-overlay { opacity: 1; }
.gallery-item-title { font-size: 15px; color: #fff; margin: 0 0 2px; }
.gallery-item-desc { font-size: 12px; color: rgba(255,255,255,0.7); margin: 0; }

/* ========== CTA ========== */
.cta-section {
    padding: 100px 24px; background: #121212; text-align: center; position: relative; overflow: hidden;
}
.cta-glow {
    position: absolute; width: 500px; height: 500px; border-radius: 50%;
    background: radial-gradient(circle, rgba(96,165,250,0.15) 0%, transparent 70%);
    top: 50%; left: 50%; transform: translate(-50%, -50%); pointer-events: none;
}
.cta-title {
    font-size: clamp(28px, 4vw, 48px); color: #fff; margin: 0 0 16px;
    position: relative; z-index: 1; letter-spacing: -0.02em;
}
.cta-desc {
    font-size: 16px; color: rgba(255,255,255,0.6); max-width: 500px;
    margin: 0 auto 32px; line-height: 1.6; position: relative; z-index: 1;
}
.cta-btn {
    display: inline-flex; align-items: center; gap: 8px;
    background: #fff; color: #111; padding: 14px 36px; border-radius: 12px;
    font-size: 15px; text-decoration: none; transition: all 0.25s;
    position: relative; z-index: 1; border: none; cursor: pointer;
}
.cta-btn:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(255,255,255,0.15); }

/* ========== ANIMATION UTILITY ========== */
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(24px); }
    to { opacity: 1; transform: translateY(0); }
}
.fade-in {
    opacity: 0; transform: translateY(24px);
    transition: opacity 0.6s ease, transform 0.6s ease;
}
.fade-in.visible { opacity: 1; transform: translateY(0); }

/* ========== RESPONSIVE ========== */
@media (max-width: 768px) {
    .hero-stats-inner { gap: 24px; padding: 16px 28px; }
    .hero-stat-num { font-size: 22px; }
    .cert-track { gap: 24px; }
    .cert-logo { height: 50px; }
    .gallery-grid { grid-template-columns: repeat(2, 1fr); }
    .gallery-item:nth-child(1) { grid-column: span 2; grid-row: span 1; aspect-ratio: 16/9; }
    .why-grid { grid-template-columns: 1fr 1fr; }
}
@media (max-width: 480px) {
    .hero-stats-inner { gap: 16px; padding: 14px 20px; flex-wrap: wrap; }
    .hero-stat-num { font-size: 20px; }
    .hero-stat-label { font-size: 10px; }
    .courses-grid { grid-template-columns: 1fr 1fr; }
    .gallery-grid { grid-template-columns: 1fr 1fr; gap: 8px; }
    .gallery-item:nth-child(1) { grid-column: span 1; }
    .why-grid { grid-template-columns: 1fr; }
}
</style>

{{-- ===== HERO ===== --}}
<div class="hero-section" style="margin-top:-110px;">
    <div class="hero-bg">
        <img src="{{ asset('assets/images/home/background1.png') }}" alt="Institute of ABC" fetchpriority="high">
    </div>
    <div class="hero-overlay"></div>

    <div class="hero-content">
        <div class="hero-badge font-HellixR">
            <span class="hero-badge-dot"></span>
            Admissions Open 2026
        </div>
        <h1 class="hero-title font-HellixB">
            Build Your Future in<br>
            <span class="hero-title-gradient font-HellixEB">Computer Technology</span>
        </h1>
        <p class="hero-subtitle font-HellixR">
            Bihar's trusted institute for professional computer education. Government certified courses, expert faculty, and placement assistance.
        </p>
        <div class="hero-actions">
            <a href="{{ route('course') }}" class="hero-btn hero-btn-primary font-HellixSB">
                Explore Courses
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
            <a href="{{ route('student_info') }}" class="hero-btn hero-btn-ghost font-HellixR">
                Verify Student
            </a>
        </div>
    </div>

    <div class="hero-scroll">
        <div class="hero-scroll-inner">
            <div class="hero-scroll-dot"></div>
        </div>
    </div>

    <div class="hero-stats">
        <div class="hero-stats-inner">
            <div class="hero-stat">
                <div class="hero-stat-num font-HellixB" data-count="500">0+</div>
                <div class="hero-stat-label font-HellixR">Students</div>
            </div>
            <div class="hero-stat">
                <div class="hero-stat-num font-HellixB" data-count="10">0+</div>
                <div class="hero-stat-label font-HellixR">Courses</div>
            </div>
            <div class="hero-stat">
                <div class="hero-stat-num font-HellixB" data-count="5">0+</div>
                <div class="hero-stat-label font-HellixR">Branches</div>
            </div>
            <div class="hero-stat">
                <div class="hero-stat-num font-HellixB" data-count="8">0+</div>
                <div class="hero-stat-label font-HellixR">Years</div>
            </div>
        </div>
    </div>
</div>

{{-- ===== CERTIFIED BY ===== --}}
<section class="certified-section fade-in">
    <div class="section-header">
        <div class="section-label font-HellixSB">Trusted & Recognized</div>
        <h2 class="section-title font-HellixB">Certified By</h2>
        <div class="section-line"></div>
    </div>
    <div class="cert-track">
        <img class="cert-logo" src="{{ asset('assets/images/certified/iso-certified.png') }}" alt="ISO Certified" loading="lazy">
        <img class="cert-logo" src="{{ asset('assets/images/certified/BiharGovernment.png') }}" alt="Bihar Government" loading="lazy">
        <img class="cert-logo" src="{{ asset('assets/images/certified/png-clipart.png') }}" alt="Certification" loading="lazy">
        <img class="cert-logo" src="{{ asset('assets/images/certified/png-clipart-skill.png') }}" alt="Skill India" loading="lazy">
        <img class="cert-logo" src="{{ asset('assets/images/certified/hep.png') }}" alt="HEP" loading="lazy">
        <img class="cert-logo" src="{{ asset('assets/images/certified/microsoft.png') }}" alt="Microsoft" loading="lazy">
    </div>
</section>

{{-- ===== COURSES ===== --}}
<section class="courses-section" id="courses">
    <div class="section-header fade-in">
        <div class="section-label font-HellixSB">What We Offer</div>
        <h2 class="section-title font-HellixB">Our Courses</h2>
        <div class="section-line"></div>
    </div>
    <div class="courses-grid" id="coursesGrid">
        {{-- Populated by JS from API --}}
    </div>
    <div id="coursesLoading" style="text-align:center;padding:40px;">
        <div style="display:inline-block;width:32px;height:32px;border:3px solid #e5e7eb;border-top-color:#111;border-radius:50%;animation:spin 0.7s linear infinite;"></div>
    </div>
</section>
<style>@keyframes spin { to { transform: rotate(360deg); } }</style>

{{-- ===== WHY CHOOSE US ===== --}}
<section class="why-section">
    <div class="section-header fade-in">
        <div class="section-label font-HellixSB">Our Advantage</div>
        <h2 class="section-title font-HellixB">Why Choose Us</h2>
        <div class="section-line"></div>
    </div>
    <div class="why-grid">
        <div class="why-card fade-in">
            <div class="why-card-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
            </div>
            <div class="why-card-title font-HellixB">Government Certified</div>
            <div class="why-card-desc font-HellixR">Recognized by Bihar Government & ISO certified. Your certificate is valid nationwide.</div>
        </div>
        <div class="why-card fade-in">
            <div class="why-card-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
            </div>
            <div class="why-card-title font-HellixB">Expert Faculty</div>
            <div class="why-card-desc font-HellixR">Learn from industry professionals with years of practical experience in computer science.</div>
        </div>
        <div class="why-card fade-in">
            <div class="why-card-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            </div>
            <div class="why-card-title font-HellixB">Hands-on Training</div>
            <div class="why-card-desc font-HellixR">Practical lab sessions with modern computers. Real projects, real skills from day one.</div>
        </div>
        <div class="why-card fade-in">
            <div class="why-card-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            </div>
            <div class="why-card-title font-HellixB">Placement Support</div>
            <div class="why-card-desc font-HellixR">Career guidance, resume building, and placement assistance to help you land your first job.</div>
        </div>
    </div>
</section>

{{-- ===== TESTIMONIALS ===== --}}
@php
    $testimonials = [
        ['name' => 'Om Prakash Bharati', 'position' => 'SDE @ BITCS', 'rating' => 5, 'description' => 'Institute of ABC gave me the foundation I needed to start my career in technology. The practical training was exceptional.', 'image' => 'assets/images/default_avatar.jpg'],
        ['name' => 'Rahul Kumar', 'position' => 'Web Developer', 'rating' => 5, 'description' => 'The faculty here truly cares about student success. I learned more in 6 months than I expected. Highly recommended!', 'image' => 'assets/images/default_avatar.jpg'],
        ['name' => 'Priya Singh', 'position' => 'Data Entry Operator', 'rating' => 4, 'description' => 'Great institute with modern facilities. The ADCA course helped me get placed within a month of completion.', 'image' => 'assets/images/default_avatar.jpg'],
        ['name' => 'Amit Verma', 'position' => 'Tally Operator', 'rating' => 5, 'description' => 'Best computer institute in Bihar. The Tally and accounting course was very well structured and practical.', 'image' => 'assets/images/default_avatar.jpg'],
        ['name' => 'Sneha Kumari', 'position' => 'Office Assistant', 'rating' => 4, 'description' => 'Learned MS Office, typing, and basic programming. The teachers are very supportive and patient with students.', 'image' => 'assets/images/default_avatar.jpg'],
        ['name' => 'Vikash Yadav', 'position' => 'Freelancer', 'rating' => 5, 'description' => 'After completing my DCA, I started freelancing in web design. ABC institute made this possible with their practical approach.', 'image' => 'assets/images/default_avatar.jpg'],
    ];
@endphp

<section class="testimonials-section">
    <div class="section-header fade-in">
        <div class="section-label font-HellixSB">Student Stories</div>
        <h2 class="section-title font-HellixB">What Our Students Say</h2>
        <div class="section-line"></div>
    </div>
    <div class="testimonial-track-wrapper">
        <div class="testimonial-track">
            @foreach ($testimonials as $t)
            <div class="testimonial-card">
                <div class="testimonial-stars">
                    @for ($i = 0; $i < 5; $i++)
                        @if ($i < $t['rating'])
                            <svg fill="#facc15" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        @else
                            <svg fill="#e5e7eb" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        @endif
                    @endfor
                </div>
                <p class="testimonial-text font-HellixR">"{{ $t['description'] }}"</p>
                <div class="testimonial-author">
                    <img class="testimonial-avatar" src="{{ asset($t['image']) }}" alt="{{ $t['name'] }}" loading="lazy">
                    <div>
                        <div class="testimonial-name font-HellixSB">{{ $t['name'] }}</div>
                        <div class="testimonial-role font-HellixR">{{ $t['position'] }}</div>
                    </div>
                </div>
            </div>
            @endforeach
            {{-- Duplicate for seamless loop --}}
            @foreach ($testimonials as $t)
            <div class="testimonial-card">
                <div class="testimonial-stars">
                    @for ($i = 0; $i < 5; $i++)
                        @if ($i < $t['rating'])
                            <svg fill="#facc15" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        @else
                            <svg fill="#e5e7eb" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        @endif
                    @endfor
                </div>
                <p class="testimonial-text font-HellixR">"{{ $t['description'] }}"</p>
                <div class="testimonial-author">
                    <img class="testimonial-avatar" src="{{ asset($t['image']) }}" alt="{{ $t['name'] }}" loading="lazy">
                    <div>
                        <div class="testimonial-name font-HellixSB">{{ $t['name'] }}</div>
                        <div class="testimonial-role font-HellixR">{{ $t['position'] }}</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ===== GALLERY ===== --}}
@php
    $galleries = [
        ['image' => 'assets/dice-1502706_640 (4).jpg', 'title' => "Teacher's Day, 2016"],
        ['image' => 'assets/65-500x300.jpg', 'title' => "Children's Day, 2016"],
        ['image' => 'assets/184-500x300.jpg', 'title' => "Annual Function, 2017"],
        ['image' => 'assets/591-500x300.jpg', 'title' => "Opening Day, 2016"],
        ['image' => 'assets/65-500x300.jpg', 'title' => "Workshop, 2018"],
    ];
@endphp

<section class="gallery-section" id="gallery">
    <div class="section-header fade-in">
        <div class="section-label font-HellixSB">Life at ABC</div>
        <h2 class="section-title font-HellixB">Gallery</h2>
        <div class="section-line"></div>
    </div>
    <div class="gallery-grid">
        @foreach ($galleries as $g)
        <div class="gallery-item fade-in">
            <img src="{{ asset($g['image']) }}" alt="{{ $g['title'] }}" loading="lazy">
            <div class="gallery-item-overlay">
                <div class="gallery-item-title font-HellixSB">{{ $g['title'] }}</div>
            </div>
        </div>
        @endforeach
    </div>
    <div style="text-align:center;margin-top:32px;" class="fade-in">
        <a href="{{ route('gallery') }}" class="hero-btn hero-btn-ghost font-HellixR" style="color:#111;border-color:#e5e7eb;display:inline-flex;">
            View Full Gallery
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
        </a>
    </div>
</section>

{{-- ===== CTA ===== --}}
<section class="cta-section">
    <div class="cta-glow"></div>
    <h2 class="cta-title font-HellixB fade-in">Ready to Start Your<br>Computer Journey?</h2>
    <p class="cta-desc font-HellixR fade-in">Join thousands of students who have transformed their careers through quality computer education at Institute of ABC.</p>
    <a href="{{ route('course') }}" class="cta-btn font-HellixSB fade-in">
        Get Started Today
        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
    </a>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Intersection Observer for fade-in animations
    var observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.15 });

    document.querySelectorAll('.fade-in, .course-card').forEach(function(el) {
        observer.observe(el);
    });

    // Counter animation for hero stats
    var statsObserver = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                document.querySelectorAll('[data-count]').forEach(function(el) {
                    var target = parseInt(el.getAttribute('data-count'));
                    var duration = 1500;
                    var start = 0;
                    var startTime = null;

                    function animate(timestamp) {
                        if (!startTime) startTime = timestamp;
                        var progress = Math.min((timestamp - startTime) / duration, 1);
                        var eased = 1 - Math.pow(1 - progress, 3);
                        var current = Math.floor(eased * target);
                        el.textContent = current + '+';
                        if (progress < 1) requestAnimationFrame(animate);
                    }
                    requestAnimationFrame(animate);
                });
                statsObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });

    var statsEl = document.querySelector('.hero-stats');
    if (statsEl) statsObserver.observe(statsEl);

    // Load courses from API
    var API_URL = '{{ url("/api") }}';
    fetch(API_URL + '/admin/branch/get_all_courses?showActiveOnly=true')
    .then(function(r) { return r.json(); })
    .then(function(result) {
        document.getElementById('coursesLoading').style.display = 'none';
        if (result.error || !result.data || result.data.length === 0) {
            document.getElementById('coursesGrid').innerHTML = '<p style="text-align:center;color:#9ca3af;grid-column:1/-1;padding:40px;">No courses available.</p>';
            return;
        }

        // Pick 4 courses: prioritize ADCA, DCA, then fill rest
        var priority = ['ADCA', 'DCA'];
        var picked = [];
        var rest = [];
        result.data.forEach(function(c) {
            var sf = (c.short_form || '').toUpperCase();
            if (priority.indexOf(sf) !== -1 && picked.length < 2) {
                picked.push(c);
                priority = priority.filter(function(p) { return p !== sf; });
            } else {
                rest.push(c);
            }
        });
        while (picked.length < 4 && rest.length > 0) { picked.push(rest.shift()); }

        var images = [
            'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=500&h=340&fit=crop',
            'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=500&h=340&fit=crop',
            'https://images.unsplash.com/photo-1555949963-aa79dcee981c?w=500&h=340&fit=crop',
            'https://images.unsplash.com/photo-1461749280684-dccba630e2f6?w=500&h=340&fit=crop'
        ];

        document.getElementById('coursesGrid').innerHTML = picked.map(function(c, i) {
            return '<div class="course-card" style="transition-delay:' + (i * 0.08) + 's;">' +
                '<img class="course-card-img" src="' + images[i] + '" alt="' + escHtml(c.short_form || c.course_name || '') + '" loading="lazy">' +
                '<div class="course-card-body">' +
                    '<div class="course-card-title font-HellixB">' + escHtml(c.short_form || c.course_name || '-') + '</div>' +
                    '<div class="course-card-desc font-HellixR">' + escHtml(c.course_name || '') +
                        (c.duration ? ' &middot; ' + escHtml(c.duration) : '') +
                    '</div>' +
                    '<a href="' + "{{ route('course') }}" + '" class="course-card-link font-HellixSB">' +
                        'Learn more <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>' +
                    '</a>' +
                '</div>' +
            '</div>';
        }).join('');

        // Re-observe new course cards
        document.querySelectorAll('.course-card').forEach(function(el) { observer.observe(el); });
    })
    .catch(function() {
        document.getElementById('coursesLoading').innerHTML = '<p style="color:#dc2626;">Failed to load courses.</p>';
    });

    function escHtml(text) {
        if (!text) return '';
        var d = document.createElement('div');
        d.textContent = text;
        return d.innerHTML;
    }
});
</script>
