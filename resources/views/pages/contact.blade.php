<style>
/* ========== HERO ========== */
.ct-hero {
    background: #0a0a0a; padding: 80px 24px 60px; text-align: center;
    position: relative; overflow: hidden;
}
.ct-hero-glow {
    position: absolute; width: 600px; height: 400px; border-radius: 50%;
    background: radial-gradient(circle, rgba(96,165,250,0.08) 0%, transparent 70%);
    top: 20%; left: 50%; transform: translateX(-50%); pointer-events: none;
}
.ct-hero-label {
    font-size: 12px; text-transform: uppercase; letter-spacing: 0.12em;
    color: rgba(255,255,255,0.4); margin-bottom: 16px;
}
.ct-hero-title {
    font-size: clamp(32px, 5vw, 52px); color: #fff; margin: 0 0 16px;
    letter-spacing: -0.02em; position: relative; z-index: 1;
}
.ct-hero-desc {
    font-size: clamp(15px, 1.8vw, 17px); color: rgba(255,255,255,0.55);
    max-width: 550px; margin: 0 auto; line-height: 1.7; position: relative; z-index: 1;
}

/* ========== CONTACT INFO CARDS ========== */
.ct-info-section {
    max-width: 1100px; margin: 0 auto; padding: 48px 24px;
}
.ct-info-grid {
    display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px;
}
.ct-info-card {
    text-align: center; padding: 28px 20px; border-radius: 16px;
    border: 1px solid #e5e7eb; transition: all 0.3s;
}
.ct-info-card:hover { border-color: #121212; transform: translateY(-3px); box-shadow: 0 8px 24px rgba(0,0,0,0.05); }
.ct-info-icon {
    width: 52px; height: 52px; border-radius: 14px; background: #f3f4f6;
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 14px; transition: all 0.3s;
}
.ct-info-card:hover .ct-info-icon { background: #121212; }
.ct-info-card:hover .ct-info-icon svg { stroke: #fff; }
.ct-info-icon svg { width: 24px; height: 24px; stroke: #374151; transition: stroke 0.3s; }
.ct-info-label { font-size: 12px; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.08em; margin: 0 0 6px; }
.ct-info-value { font-size: 14px; color: #111; margin: 0; line-height: 1.5; }
.ct-info-value a { color: #111; text-decoration: none; }
.ct-info-value a:hover { text-decoration: underline; }

/* ========== MAIN CONTENT ========== */
.ct-main {
    max-width: 1100px; margin: 0 auto; padding: 0 24px 64px;
    display: grid; grid-template-columns: 1fr 1fr; gap: 24px;
}

/* ========== MESSAGE FORM ========== */
.ct-form-card {
    background: #fff; border: 1px solid #e5e7eb; border-radius: 20px;
    padding: 32px; height: fit-content;
}
.ct-form-title { font-size: 22px; color: #111; margin: 0 0 6px; }
.ct-form-desc { font-size: 14px; color: #9ca3af; margin: 0 0 24px; }
.ct-form-group { margin-bottom: 16px; }
.ct-form-label {
    display: block; font-size: 12px; color: #6b7280; text-transform: uppercase;
    letter-spacing: 0.06em; margin-bottom: 6px;
}
.ct-form-input {
    width: 100%; border: 1px solid #e5e7eb; border-radius: 10px;
    padding: 12px 16px; font-size: 14px; outline: none; box-sizing: border-box;
    transition: border-color 0.2s; font-family: 'Hellix-Regular';
}
.ct-form-input:focus { border-color: #121212; }
.ct-form-textarea {
    width: 100%; border: 1px solid #e5e7eb; border-radius: 10px;
    padding: 12px 16px; font-size: 14px; outline: none; box-sizing: border-box;
    transition: border-color 0.2s; font-family: 'Hellix-Regular';
    resize: vertical; min-height: 120px;
}
.ct-form-textarea:focus { border-color: #121212; }
.ct-form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
.ct-form-select {
    width: 100%; border: 1px solid #e5e7eb; border-radius: 10px;
    padding: 12px 16px; font-size: 14px; outline: none; box-sizing: border-box;
    background: #fff; cursor: pointer; font-family: 'Hellix-Regular';
    transition: border-color 0.2s; appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='none' stroke='%239ca3af' viewBox='0 0 24 24'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");
    background-repeat: no-repeat; background-position: right 14px center;
}
.ct-form-select:focus { border-color: #121212; }
.ct-form-submit {
    width: 100%; background: #121212; color: #fff; border: none; border-radius: 10px;
    padding: 14px; font-size: 15px; cursor: pointer; transition: all 0.2s;
    display: flex; align-items: center; justify-content: center; gap: 8px;
}
.ct-form-submit:hover { background: #2a2a2a; transform: translateY(-1px); }
.ct-form-submit:disabled { opacity: 0.5; cursor: not-allowed; transform: none; }
.ct-form-submit svg { width: 18px; height: 18px; }

/* ========== TABS ========== */
.ct-tab-bar {
    display: flex; gap: 4px; margin-bottom: 24px; background: #f3f4f6;
    border-radius: 10px; padding: 4px;
}
.ct-tab {
    flex: 1; padding: 10px 16px; border-radius: 8px; font-size: 13px;
    border: none; background: transparent; color: #6b7280;
    cursor: pointer; transition: all 0.2s; text-align: center;
}
.ct-tab.active { background: #fff; color: #111; box-shadow: 0 1px 3px rgba(0,0,0,0.06); }
.ct-tab-content { display: none; }
.ct-tab-content.active { display: block; }

/* ========== MAP ========== */
.ct-map-card {
    border: 1px solid #e5e7eb; border-radius: 20px; overflow: hidden;
    display: flex; flex-direction: column;
}
.ct-map-frame {
    width: 100%; height: 340px; border: none;
}
.ct-map-info {
    padding: 24px; background: #fff;
}
.ct-map-title { font-size: 18px; color: #111; margin: 0 0 8px; }
.ct-map-address { font-size: 14px; color: #6b7280; margin: 0 0 16px; line-height: 1.6; }
.ct-map-directions {
    display: inline-flex; align-items: center; gap: 8px; background: #121212;
    color: #fff; padding: 10px 20px; border-radius: 10px; font-size: 13px;
    text-decoration: none; transition: all 0.2s;
}
.ct-map-directions:hover { background: #2a2a2a; transform: translateY(-1px); }
.ct-map-directions svg { width: 16px; height: 16px; }

/* ========== ENQUIRY SUCCESS ========== */
.ct-success {
    text-align: center; padding: 40px 20px; display: none;
}
.ct-success-icon {
    width: 64px; height: 64px; border-radius: 50%; background: #dcfce7;
    display: flex; align-items: center; justify-content: center; margin: 0 auto 16px;
}
.ct-success-icon svg { width: 28px; height: 28px; stroke: #16a34a; }
.ct-success-title { font-size: 20px; color: #111; margin: 0 0 8px; }
.ct-success-desc { font-size: 14px; color: #6b7280; margin: 0 0 20px; }
.ct-success-btn {
    background: #f3f4f6; color: #111; border: none; border-radius: 10px;
    padding: 10px 24px; font-size: 14px; cursor: pointer; transition: all 0.2s;
}
.ct-success-btn:hover { background: #e5e7eb; }

/* ========== RESPONSIVE ========== */
@media (max-width: 768px) {
    .ct-info-grid { grid-template-columns: 1fr 1fr; }
    .ct-main { grid-template-columns: 1fr; }
    .ct-form-row { grid-template-columns: 1fr; }
}
@media (max-width: 480px) {
    .ct-info-grid { grid-template-columns: 1fr; }
}
</style>

{{-- ===== HERO ===== --}}
<div class="ct-hero">
    <div class="ct-hero-glow"></div>
    <div class="ct-hero-label font-HellixSB">Get In Touch</div>
    <h1 class="ct-hero-title font-HellixB">Contact Us</h1>
    <p class="ct-hero-desc font-HellixR">Have questions about our courses or want to visit? We'd love to hear from you.</p>
</div>

{{-- ===== CONTACT INFO ========== --}}
<div class="ct-info-section">
    <div class="ct-info-grid">
        <div class="ct-info-card">
            <div class="ct-info-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
            </div>
            <div class="ct-info-label font-HellixSB">Phone</div>
            <div class="ct-info-value font-HellixR"><a href="tel:+919973380780">+91 9973380780</a></div>
        </div>
        <div class="ct-info-card">
            <div class="ct-info-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            </div>
            <div class="ct-info-label font-HellixSB">Email</div>
            <div class="ct-info-value font-HellixR"><a href="mailto:abc.ask2@gmail.com">abc.ask2@gmail.com</a></div>
        </div>
        <div class="ct-info-card">
            <div class="ct-info-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <div class="ct-info-label font-HellixSB">Address</div>
            <div class="ct-info-value font-HellixR">Haspura, Kanap Road<br>Aurangabad, Bihar 824120</div>
        </div>
        <div class="ct-info-card">
            <div class="ct-info-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div class="ct-info-label font-HellixSB">Working Hours</div>
            <div class="ct-info-value font-HellixR">Mon - Sat<br>9:00 AM - 6:00 PM</div>
        </div>
    </div>
</div>

{{-- ===== MAIN CONTENT ========== --}}
<div class="ct-main">
    {{-- Left: Form --}}
    <div class="ct-form-card">
        {{-- Tab bar --}}
        <div class="ct-tab-bar">
            <button class="ct-tab font-HellixSB active" data-ct-tab="message">Send Message</button>
            <button class="ct-tab font-HellixSB" data-ct-tab="enquiry">Registration Enquiry</button>
        </div>

        {{-- Send Message Tab --}}
        <div class="ct-tab-content active" data-ct-content="message">
            <div id="ctMsgForm">
                <div class="ct-form-title font-HellixB">Drop Us a Message</div>
                <div class="ct-form-desc font-HellixR">We'll get back to you as soon as possible.</div>
                <div class="ct-form-row">
                    <div class="ct-form-group">
                        <label class="ct-form-label font-HellixSB">Full Name *</label>
                        <input type="text" id="ctMsgName" class="ct-form-input" placeholder="Your name">
                    </div>
                    <div class="ct-form-group">
                        <label class="ct-form-label font-HellixSB">Phone *</label>
                        <input type="tel" id="ctMsgPhone" class="ct-form-input" placeholder="Your phone number">
                    </div>
                </div>
                <div class="ct-form-group">
                    <label class="ct-form-label font-HellixSB">Email</label>
                    <input type="email" id="ctMsgEmail" class="ct-form-input" placeholder="Your email (optional)">
                </div>
                <div class="ct-form-group">
                    <label class="ct-form-label font-HellixSB">Subject</label>
                    <input type="text" id="ctMsgSubject" class="ct-form-input" placeholder="What is this about?">
                </div>
                <div class="ct-form-group">
                    <label class="ct-form-label font-HellixSB">Message *</label>
                    <textarea id="ctMsgBody" class="ct-form-textarea" placeholder="Write your message here..."></textarea>
                </div>
                <button class="ct-form-submit font-HellixSB" id="ctMsgSubmit" onclick="submitMessage()">
                    Send Message
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                </button>
            </div>
            <div class="ct-success" id="ctMsgSuccess">
                <div class="ct-success-icon">
                    <svg fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                </div>
                <div class="ct-success-title font-HellixB">Message Sent!</div>
                <div class="ct-success-desc font-HellixR">Thank you for reaching out. We'll respond within 24 hours.</div>
                <button class="ct-success-btn font-HellixSB" onclick="resetMsgForm()">Send Another</button>
            </div>
        </div>

        {{-- Registration Enquiry Tab --}}
        <div class="ct-tab-content" data-ct-content="enquiry">
            <div id="ctEnqForm">
                <div class="ct-form-title font-HellixB">Registration Enquiry</div>
                <div class="ct-form-desc font-HellixR">Interested in joining? Fill out your details and we'll guide you through the admission process.</div>
                <div class="ct-form-row">
                    <div class="ct-form-group">
                        <label class="ct-form-label font-HellixSB">Full Name *</label>
                        <input type="text" id="ctEnqName" class="ct-form-input" placeholder="Your full name">
                    </div>
                    <div class="ct-form-group">
                        <label class="ct-form-label font-HellixSB">Phone *</label>
                        <input type="tel" id="ctEnqPhone" class="ct-form-input" placeholder="Your phone number">
                    </div>
                </div>
                <div class="ct-form-row">
                    <div class="ct-form-group">
                        <label class="ct-form-label font-HellixSB">Email</label>
                        <input type="email" id="ctEnqEmail" class="ct-form-input" placeholder="Your email (optional)">
                    </div>
                    <div class="ct-form-group">
                        <label class="ct-form-label font-HellixSB">Qualification</label>
                        <select id="ctEnqQualification" class="ct-form-select">
                            <option value="">Select qualification</option>
                            <option value="10th">10th Pass</option>
                            <option value="12th">12th Pass</option>
                            <option value="graduate">Graduate</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                </div>
                <div class="ct-form-group">
                    <label class="ct-form-label font-HellixSB">Course Interested In *</label>
                    <select id="ctEnqCourse" class="ct-form-select">
                        <option value="">Select a course</option>
                    </select>
                </div>
                <div class="ct-form-group">
                    <label class="ct-form-label font-HellixSB">Address / Village</label>
                    <input type="text" id="ctEnqAddress" class="ct-form-input" placeholder="Your address or village name">
                </div>
                <div class="ct-form-group">
                    <label class="ct-form-label font-HellixSB">Any Questions?</label>
                    <textarea id="ctEnqMessage" class="ct-form-textarea" placeholder="Anything you'd like to ask about the course or admission..." style="min-height:80px;"></textarea>
                </div>
                <button class="ct-form-submit font-HellixSB" id="ctEnqSubmit" onclick="submitEnquiry()">
                    Submit Enquiry
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>
            <div class="ct-success" id="ctEnqSuccess">
                <div class="ct-success-icon">
                    <svg fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                </div>
                <div class="ct-success-title font-HellixB">Enquiry Submitted!</div>
                <div class="ct-success-desc font-HellixR">Our team will contact you shortly to assist with the registration process.</div>
                <button class="ct-success-btn font-HellixSB" onclick="resetEnqForm()">Submit Another</button>
            </div>
        </div>
    </div>

    {{-- Right: Map --}}
    <div class="ct-map-card">
        <iframe
            class="ct-map-frame"
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3623.2!2d84.364!3d24.834!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x398d2d5e4b5e4e4b%3A0x0!2sHaspura%2C+Bihar+824120!5e0!3m2!1sen!2sin!4v1"
            allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
        </iframe>
        <div class="ct-map-info">
            <div class="ct-map-title font-HellixB">Institute of ABC</div>
            <div class="ct-map-address font-HellixR">
                Kanap Road, Haspura<br>
                P.O. & P.S. Haspura<br>
                District Aurangabad, Bihar - 824120
            </div>
            <a href="https://maps.app.goo.gl/QmWRLDLFdLYSKgHj9" target="_blank" rel="noopener" class="ct-map-directions font-HellixSB">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                Get Directions
            </a>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tab switching
    document.querySelectorAll('.ct-tab').forEach(function(tab) {
        tab.addEventListener('click', function() {
            document.querySelectorAll('.ct-tab').forEach(function(t) { t.classList.remove('active'); });
            document.querySelectorAll('.ct-tab-content').forEach(function(c) { c.classList.remove('active'); });
            tab.classList.add('active');
            var target = tab.getAttribute('data-ct-tab');
            document.querySelector('[data-ct-content="' + target + '"]').classList.add('active');
        });
    });

    // Load courses for enquiry dropdown
    fetch('{{ url("/api") }}/admin/branch/get_all_courses?showActiveOnly=true')
    .then(function(r) { return r.json(); })
    .then(function(result) {
        if (!result.error && result.data) {
            var select = document.getElementById('ctEnqCourse');
            result.data.forEach(function(c) {
                var opt = document.createElement('option');
                opt.value = c.short_form;
                opt.textContent = c.short_form + ' - ' + c.course_name + ' (' + c.course_duration + ' months)';
                select.appendChild(opt);
            });
        }
    });

    // Check URL param for tab
    var params = new URLSearchParams(window.location.search);
    if (params.get('tab') === 'enquiry') {
        document.querySelector('[data-ct-tab="enquiry"]').click();
    }
});

function submitMessage() {
    var name = document.getElementById('ctMsgName').value.trim();
    var phone = document.getElementById('ctMsgPhone').value.trim();
    var message = document.getElementById('ctMsgBody').value.trim();

    if (!name) { alert('Please enter your name.'); return; }
    if (!phone) { alert('Please enter your phone number.'); return; }
    if (!message) { alert('Please enter your message.'); return; }

    var btn = document.getElementById('ctMsgSubmit');
    btn.disabled = true;
    btn.innerHTML = 'Sending...';

    // Simulate send (API to be added later)
    setTimeout(function() {
        btn.disabled = false;
        btn.innerHTML = 'Send Message <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="18" height="18"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>';
        document.getElementById('ctMsgForm').style.display = 'none';
        document.getElementById('ctMsgSuccess').style.display = 'block';
    }, 1200);
}

function resetMsgForm() {
    document.getElementById('ctMsgName').value = '';
    document.getElementById('ctMsgPhone').value = '';
    document.getElementById('ctMsgEmail').value = '';
    document.getElementById('ctMsgSubject').value = '';
    document.getElementById('ctMsgBody').value = '';
    document.getElementById('ctMsgForm').style.display = 'block';
    document.getElementById('ctMsgSuccess').style.display = 'none';
}

function submitEnquiry() {
    var name = document.getElementById('ctEnqName').value.trim();
    var phone = document.getElementById('ctEnqPhone').value.trim();
    var course = document.getElementById('ctEnqCourse').value;

    if (!name) { alert('Please enter your name.'); return; }
    if (!phone) { alert('Please enter your phone number.'); return; }
    if (!course) { alert('Please select a course.'); return; }

    var btn = document.getElementById('ctEnqSubmit');
    btn.disabled = true;
    btn.innerHTML = 'Submitting...';

    // Simulate send (API to be added later)
    setTimeout(function() {
        btn.disabled = false;
        btn.innerHTML = 'Submit Enquiry <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="18" height="18"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>';
        document.getElementById('ctEnqForm').style.display = 'none';
        document.getElementById('ctEnqSuccess').style.display = 'block';
    }, 1200);
}

function resetEnqForm() {
    document.getElementById('ctEnqName').value = '';
    document.getElementById('ctEnqPhone').value = '';
    document.getElementById('ctEnqEmail').value = '';
    document.getElementById('ctEnqQualification').value = '';
    document.getElementById('ctEnqCourse').value = '';
    document.getElementById('ctEnqAddress').value = '';
    document.getElementById('ctEnqMessage').value = '';
    document.getElementById('ctEnqForm').style.display = 'block';
    document.getElementById('ctEnqSuccess').style.display = 'none';
}
</script>
