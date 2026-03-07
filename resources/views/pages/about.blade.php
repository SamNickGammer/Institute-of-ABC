<style>
/* ========== ABOUT HERO ========== */
.about-hero {
    background: #0a0a0a; padding: 80px 24px 60px; text-align: center;
    position: relative; overflow: hidden;
}
.about-hero-glow {
    position: absolute; width: 600px; height: 400px; border-radius: 50%;
    background: radial-gradient(circle, rgba(96,165,250,0.08) 0%, transparent 70%);
    top: 20%; left: 50%; transform: translateX(-50%); pointer-events: none;
}
.about-hero-label {
    display: inline-flex; align-items: center; gap: 8px; font-size: 12px;
    text-transform: uppercase; letter-spacing: 0.12em; color: rgba(255,255,255,0.4);
    margin-bottom: 16px;
}
.about-hero-title {
    font-size: clamp(32px, 5vw, 52px); color: #fff; margin: 0 0 16px;
    letter-spacing: -0.02em; position: relative; z-index: 1;
}
.about-hero-desc {
    font-size: clamp(15px, 1.8vw, 17px); color: rgba(255,255,255,0.55);
    max-width: 600px; margin: 0 auto; line-height: 1.7; position: relative; z-index: 1;
}

/* ========== TAB NAVIGATION ========== */
.about-tabs-wrap {
    background: #fff; border-bottom: 1px solid #e5e7eb; position: sticky;
    top: 72px; z-index: 50;
}
.about-tabs {
    max-width: 900px; margin: 0 auto; display: flex; gap: 0;
    overflow-x: auto; -webkit-overflow-scrolling: touch;
    scrollbar-width: none;
}
.about-tabs::-webkit-scrollbar { display: none; }
.about-tab {
    flex-shrink: 0; padding: 16px 24px; font-size: 14px; color: #6b7280;
    background: none; border: none; border-bottom: 2px solid transparent;
    cursor: pointer; transition: all 0.2s; white-space: nowrap;
}
.about-tab:hover { color: #111; background: #f9fafb; }
.about-tab.active { color: #111; border-bottom-color: #121212; }

/* ========== SECTIONS ========== */
.about-section {
    max-width: 900px; margin: 0 auto; padding: 60px 24px;
}
.about-section + .about-section { border-top: 1px solid #f3f4f6; }
.about-section-hidden { display: none; }

/* ========== ABOUT INSTITUTE ========== */
.about-intro-grid {
    display: grid; grid-template-columns: 1fr 1fr; gap: 48px; align-items: center;
}
.about-intro-img {
    width: 100%; border-radius: 16px; box-shadow: 0 8px 32px rgba(0,0,0,0.08);
}
.about-intro-title {
    font-size: 28px; color: #111; margin: 0 0 16px; letter-spacing: -0.01em;
}
.about-intro-text {
    font-size: 15px; color: #4b5563; line-height: 1.8; margin: 0 0 24px;
}
.about-intro-founded {
    display: inline-flex; align-items: center; gap: 10px; background: #f3f4f6;
    border-radius: 10px; padding: 10px 18px; font-size: 13px; color: #374151;
}
.about-intro-founded svg { width: 18px; height: 18px; color: #6b7280; }

/* ========== FEATURES & FACILITIES ========== */
.about-features-title {
    font-size: 22px; color: #111; margin: 0 0 24px;
}
.about-features-grid {
    display: grid; grid-template-columns: 1fr 1fr; gap: 14px;
}
.about-feature-item {
    display: flex; align-items: flex-start; gap: 12px; padding: 16px;
    border-radius: 12px; border: 1px solid #f3f4f6; transition: all 0.2s;
}
.about-feature-item:hover { border-color: #e5e7eb; background: #fafafa; }
.about-feature-icon {
    width: 36px; height: 36px; border-radius: 8px; background: #f3f4f6;
    display: flex; align-items: center; justify-content: center; flex-shrink: 0;
}
.about-feature-icon svg { width: 18px; height: 18px; color: #374151; }
.about-feature-text { font-size: 14px; color: #374151; margin: 0; line-height: 1.5; }
.about-feature-label { font-size: 11px; color: #9ca3af; margin: 4px 0 0; }

.about-facilities-grid {
    display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-top: 24px;
}
.about-facility-card {
    text-align: center; padding: 24px 16px; border-radius: 14px;
    border: 1px solid #f3f4f6; transition: all 0.3s;
}
.about-facility-card:hover { border-color: #121212; transform: translateY(-3px); box-shadow: 0 6px 20px rgba(0,0,0,0.05); }
.about-facility-icon {
    width: 48px; height: 48px; border-radius: 12px; background: #f3f4f6;
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 12px; transition: all 0.3s;
}
.about-facility-card:hover .about-facility-icon { background: #121212; }
.about-facility-card:hover .about-facility-icon svg { stroke: #fff; }
.about-facility-icon svg { width: 22px; height: 22px; stroke: #374151; transition: stroke 0.3s; }
.about-facility-num { font-size: 20px; color: #111; margin: 0; }
.about-facility-label { font-size: 12px; color: #9ca3af; margin: 4px 0 0; }

/* ========== DIRECTOR MESSAGE ========== */
.director-card {
    background: linear-gradient(135deg, #f9fafb 0%, #fff 100%);
    border: 1px solid #e5e7eb; border-radius: 20px; padding: 40px;
    position: relative; overflow: hidden;
}
.director-quote-icon {
    position: absolute; top: 24px; right: 32px; font-size: 120px;
    color: rgba(0,0,0,0.03); line-height: 1; pointer-events: none;
}
.director-label {
    font-size: 12px; text-transform: uppercase; letter-spacing: 0.1em;
    color: #9ca3af; margin: 0 0 8px;
}
.director-title {
    font-size: 24px; color: #111; margin: 0 0 24px;
}
.director-text {
    font-size: 15px; color: #4b5563; line-height: 1.9; margin: 0 0 16px;
}
.director-text:last-of-type { margin-bottom: 28px; }
.director-sign {
    display: flex; align-items: center; gap: 16px; padding-top: 20px;
    border-top: 1px solid #e5e7eb;
}
.director-sign-avatar {
    width: 48px; height: 48px; border-radius: 50%; background: #121212;
    display: flex; align-items: center; justify-content: center;
    color: #fff; font-size: 18px;
}
.director-sign-name { font-size: 15px; color: #111; margin: 0; }
.director-sign-role { font-size: 12px; color: #9ca3af; margin: 2px 0 0; }

/* ========== CERTIFICATES ========== */
.cert-display-grid {
    display: grid; grid-template-columns: 1fr 1fr; gap: 24px;
}
.cert-display-card {
    border: 1px solid #e5e7eb; border-radius: 16px; overflow: hidden;
    transition: all 0.3s; cursor: pointer;
}
.cert-display-card:hover { box-shadow: 0 8px 32px rgba(0,0,0,0.08); transform: translateY(-3px); }
.cert-display-img-wrap {
    background: #f9fafb; padding: 20px; display: flex; align-items: center; justify-content: center;
    min-height: 280px;
}
.cert-display-img {
    max-width: 100%; max-height: 320px; object-fit: contain; border-radius: 4px;
    transition: transform 0.3s;
}
.cert-display-card:hover .cert-display-img { transform: scale(1.02); }
.cert-display-body { padding: 18px 20px; }
.cert-display-title { font-size: 16px; color: #111; margin: 0 0 4px; }
.cert-display-desc { font-size: 13px; color: #6b7280; margin: 0; }

/* ========== IMAGE LIGHTBOX ========== */
.cert-lightbox {
    position: fixed; inset: 0; background: rgba(0,0,0,0.85); z-index: 9999;
    display: none; align-items: center; justify-content: center;
    backdrop-filter: blur(8px); cursor: zoom-out;
}
.cert-lightbox.open { display: flex; }
.cert-lightbox img {
    max-width: 90vw; max-height: 90vh; object-fit: contain; border-radius: 8px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.3);
}
.cert-lightbox-close {
    position: absolute; top: 20px; right: 24px; background: rgba(255,255,255,0.1);
    border: 1px solid rgba(255,255,255,0.2); border-radius: 50%; width: 40px; height: 40px;
    display: flex; align-items: center; justify-content: center; cursor: pointer;
    transition: all 0.2s;
}
.cert-lightbox-close:hover { background: rgba(255,255,255,0.2); }
.cert-lightbox-close svg { width: 18px; height: 18px; stroke: #fff; }

/* ========== RESPONSIVE ========== */
@media (max-width: 768px) {
    .about-intro-grid { grid-template-columns: 1fr; gap: 28px; }
    .about-features-grid { grid-template-columns: 1fr; }
    .about-facilities-grid { grid-template-columns: 1fr 1fr; }
    .cert-display-grid { grid-template-columns: 1fr; }
    .director-card { padding: 28px; }
    .about-tabs-wrap { top: 64px; }
}
@media (max-width: 480px) {
    .about-facilities-grid { grid-template-columns: 1fr 1fr; }
    .about-tab { padding: 14px 16px; font-size: 13px; }
}
</style>

{{-- ===== HERO ===== --}}
<div class="about-hero">
    <div class="about-hero-glow"></div>
    <div class="about-hero-label font-HellixSB">Since 2007</div>
    <h1 class="about-hero-title font-HellixB">About Institute of ABC</h1>
    <p class="about-hero-desc font-HellixR">Empowering students with quality computer education, government-certified courses, and practical skills for a brighter future.</p>
</div>

{{-- ===== TABS ===== --}}
<div class="about-tabs-wrap">
    <div class="about-tabs">
        <button class="about-tab font-HellixSB active" data-tab="overview">Overview</button>
        <button class="about-tab font-HellixSB" data-tab="director">Director's Message</button>
        <button class="about-tab font-HellixSB" data-tab="features">Features & Facilities</button>
        <button class="about-tab font-HellixSB" data-tab="iso">ISO Certificate</button>
        <button class="about-tab font-HellixSB" data-tab="govt">Bihar Govt. Certificate</button>
    </div>
</div>

{{-- ===== OVERVIEW ===== --}}
<div class="about-section" data-tab-content="overview">
    <h2 class="about-intro-title font-HellixB">Shaping Careers Through Technology</h2>
    <p class="about-intro-text font-HellixR">
        Institute of ABC (Association of Being Civilization) was founded in 2007 with a clear mission &mdash; to provide best-in-class computer education to students from all backgrounds at an affordable fee structure.
    </p>
    <p class="about-intro-text font-HellixR">
        Over the years, thousands of students have been professionally trained and successfully built their careers in the IT industry and beyond. As computer literacy has become essential in every field, we continue to deliver high-quality courses in computer applications, programming, and vocational skills.
    </p>
    <p class="about-intro-text font-HellixR">
        Our institute is ISO 9001:2015 certified and registered under the Bihar Government (Societies Registration Act 21, 1860), ensuring that every certificate we issue holds real value in the professional world.
    </p>
    <div class="about-intro-founded font-HellixSB" style="margin-top:8px;">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        Est. 2007 &bull; Haspura, Aurangabad, Bihar
    </div>
</div>

{{-- ===== DIRECTOR'S MESSAGE ===== --}}
<div class="about-section about-section-hidden" data-tab-content="director">
    <div class="director-card">
        <div class="director-quote-icon font-HellixEB">&ldquo;</div>
        <div class="director-label font-HellixSB">Director's Message</div>
        <h2 class="director-title font-HellixB">A Vision for Digital Empowerment</h2>

        <p class="director-text font-HellixR">
            When I founded Institute of ABC in 2007, I had one simple belief &mdash; that quality computer education should not be a privilege, but a right accessible to every young person regardless of their economic background.
        </p>
        <p class="director-text font-HellixR">
            Over the past 17 years, I have seen our students transform from beginners into confident professionals. Many of our alumni are now working in reputed IT companies, running their own businesses, or serving in government departments &mdash; all because they took that first step of learning at our institute.
        </p>
        <p class="director-text font-HellixR">
            We take pride in our well-experienced faculty, our modern smart labs, and our commitment to practical, hands-on training. We don't just teach theory &mdash; we build professionals who are industry-ready from day one.
        </p>
        <p class="director-text font-HellixR">
            Our reasonable fee structure ensures that no deserving student is turned away. With monthly assessments, flexible schedules, and a supportive learning environment, we guarantee 100% results for every student who walks through our doors.
        </p>
        <p class="director-text font-HellixR">
            I invite you to visit our campus, meet our faculty, and experience the ABC difference for yourself. Together, let us build a digitally empowered Bihar.
        </p>

        <div class="director-sign">
            <div class="director-sign-avatar font-HellixB">D</div>
            <div>
                <div class="director-sign-name font-HellixSB">Director</div>
                <div class="director-sign-role font-HellixR">Founder & Director, Institute of ABC</div>
            </div>
        </div>
    </div>
</div>

{{-- ===== FEATURES & FACILITIES ===== --}}
<div class="about-section about-section-hidden" data-tab-content="features">
    <h2 class="about-features-title font-HellixB">Why Students Choose Us</h2>
    <div class="about-features-grid">
        <div class="about-feature-item">
            <div class="about-feature-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/></svg>
            </div>
            <div>
                <div class="about-feature-text font-HellixSB">Well Experienced & Qualified Faculty</div>
                <div class="about-feature-label font-HellixR">Industry professionals with years of teaching experience</div>
            </div>
        </div>
        <div class="about-feature-item">
            <div class="about-feature-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
            </div>
            <div>
                <div class="about-feature-text font-HellixSB">Individual Attention for Every Student</div>
                <div class="about-feature-label font-HellixR">Special concentration on each student's progress</div>
            </div>
        </div>
        <div class="about-feature-item">
            <div class="about-feature-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div>
                <div class="about-feature-text font-HellixSB">Flexible Time Schedule</div>
                <div class="about-feature-label font-HellixR">Morning, afternoon & evening batches available</div>
            </div>
        </div>
        <div class="about-feature-item">
            <div class="about-feature-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            </div>
            <div>
                <div class="about-feature-text font-HellixSB">100% Job Opportunity</div>
                <div class="about-feature-label font-HellixR">Placement assistance and career guidance for all students</div>
            </div>
        </div>
        <div class="about-feature-item">
            <div class="about-feature-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
            </div>
            <div>
                <div class="about-feature-text font-HellixSB">Monthly Tests & Assessment</div>
                <div class="about-feature-label font-HellixR">Regular evaluations with effective correction & feedback</div>
            </div>
        </div>
        <div class="about-feature-item">
            <div class="about-feature-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div>
                <div class="about-feature-text font-HellixSB">Reasonable Fee Structure</div>
                <div class="about-feature-label font-HellixR">Affordable for all classes and economic backgrounds</div>
            </div>
        </div>
        <div class="about-feature-item">
            <div class="about-feature-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
            </div>
            <div>
                <div class="about-feature-text font-HellixSB">Homely Learning Environment</div>
                <div class="about-feature-label font-HellixR">Comfortable, friendly atmosphere for focused learning</div>
            </div>
        </div>
        <div class="about-feature-item">
            <div class="about-feature-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
            </div>
            <div>
                <div class="about-feature-text font-HellixSB">100% Guaranteed Results</div>
                <div class="about-feature-label font-HellixR">Certified by Institute of ABC upon course completion</div>
            </div>
        </div>
    </div>

    {{-- Facilities --}}
    <h2 class="about-features-title font-HellixB" style="margin-top:48px;">Our Facilities</h2>
    <div class="about-facilities-grid">
        <div class="about-facility-card">
            <div class="about-facility-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
            </div>
            <div class="about-facility-num font-HellixB">1,360 sq ft</div>
            <div class="about-facility-label font-HellixR">Campus Area</div>
        </div>
        <div class="about-facility-card">
            <div class="about-facility-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            </div>
            <div class="about-facility-num font-HellixB">50+</div>
            <div class="about-facility-label font-HellixR">Computers</div>
        </div>
        <div class="about-facility-card">
            <div class="about-facility-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
            </div>
            <div class="about-facility-num font-HellixB">3</div>
            <div class="about-facility-label font-HellixR">Smart Labs</div>
        </div>
        <div class="about-facility-card">
            <div class="about-facility-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
            </div>
            <div class="about-facility-num font-HellixB">CCTV</div>
            <div class="about-facility-label font-HellixR">Secured Campus</div>
        </div>
    </div>

    <div class="about-facilities-grid" style="margin-top:16px;">
        <div class="about-facility-card">
            <div class="about-facility-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.858 15.355-5.858 21.213 0"/></svg>
            </div>
            <div class="about-facility-num font-HellixB">Full</div>
            <div class="about-facility-label font-HellixR">Wi-Fi Campus</div>
        </div>
        <div class="about-facility-card">
            <div class="about-facility-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
            </div>
            <div class="about-facility-num font-HellixB">Smart</div>
            <div class="about-facility-label font-HellixR">E-Learning Tech</div>
        </div>
        <div class="about-facility-card">
            <div class="about-facility-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
            </div>
            <div class="about-facility-num font-HellixB">AC</div>
            <div class="about-facility-label font-HellixR">Theory Rooms</div>
        </div>
        <div class="about-facility-card">
            <div class="about-facility-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
            </div>
            <div class="about-facility-num font-HellixB">Large</div>
            <div class="about-facility-label font-HellixR">Theory Hall</div>
        </div>
    </div>
</div>

{{-- ===== ISO CERTIFICATE ===== --}}
<div class="about-section about-section-hidden" data-tab-content="iso">
    <div class="cert-display-grid" style="grid-template-columns:1fr;">
        <div class="cert-display-card" onclick="openLightbox('{{ asset('assets/certificates/iso_certificate.jpg') }}')">
            <div class="cert-display-img-wrap">
                <img class="cert-display-img" src="{{ asset('assets/certificates/iso_certificate.jpg') }}" alt="ISO 9001:2015 Certificate" loading="lazy">
            </div>
            <div class="cert-display-body">
                <div class="cert-display-title font-HellixB">ISO 9001:2015 &mdash; Quality Management System</div>
                <div class="cert-display-desc font-HellixR">
                    Institute of ABC is ISO 9001:2015 certified for providing training and certification in basic computer and vocational courses. Certificate No: QMS/03040/1215. Originally issued on 19th December, 2015 by Quality Control Certification.
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ===== BIHAR GOVT CERTIFICATE ===== --}}
<div class="about-section about-section-hidden" data-tab-content="govt">
    <div class="cert-display-grid" style="grid-template-columns:1fr;">
        <div class="cert-display-card" onclick="openLightbox('{{ asset('assets/certificates/bihar_certificate.jpg') }}')">
            <div class="cert-display-img-wrap">
                <img class="cert-display-img" src="{{ asset('assets/certificates/bihar_certificate.jpg') }}" alt="Bihar Government Registration Certificate" loading="lazy">
            </div>
            <div class="cert-display-body">
                <div class="cert-display-title font-HellixB">Bihar Government Registration Certificate</div>
                <div class="cert-display-desc font-HellixR">
                    Registered under the Societies Registration Act 21, 1860 as "Association of Being Civilization" (ABC). Registration No: 028834. Located at Village Haspura (Kanap Road), P.O. & P.S. Haspura, District Aurangabad, PIN - 824120, Bihar.
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ===== LIGHTBOX ===== --}}
<div class="cert-lightbox" id="certLightbox" onclick="closeLightbox()">
    <button class="cert-lightbox-close" onclick="closeLightbox()">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
    </button>
    <img id="certLightboxImg" src="" alt="Certificate">
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var tabs = document.querySelectorAll('.about-tab');
    var contents = document.querySelectorAll('[data-tab-content]');

    function switchTab(tabName) {
        tabs.forEach(function(t) {
            t.classList.toggle('active', t.getAttribute('data-tab') === tabName);
        });
        contents.forEach(function(c) {
            if (c.getAttribute('data-tab-content') === tabName) {
                c.classList.remove('about-section-hidden');
            } else {
                c.classList.add('about-section-hidden');
            }
        });
    }

    tabs.forEach(function(tab) {
        tab.addEventListener('click', function() {
            switchTab(tab.getAttribute('data-tab'));
            // Update URL without reload
            var url = new URL(window.location);
            url.searchParams.set('tab', tab.getAttribute('data-tab'));
            history.replaceState(null, '', url);
        });
    });

    // Check URL for tab param
    var urlParams = new URLSearchParams(window.location.search);
    var activeTab = urlParams.get('tab');
    if (activeTab) {
        switchTab(activeTab);
    }
});

function openLightbox(src) {
    document.getElementById('certLightboxImg').src = src;
    document.getElementById('certLightbox').classList.add('open');
    document.body.style.overflow = 'hidden';
}
function closeLightbox() {
    document.getElementById('certLightbox').classList.remove('open');
    document.body.style.overflow = '';
}
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeLightbox();
});
</script>
