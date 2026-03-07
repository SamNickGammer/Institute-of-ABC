<style>
.site-footer {
    background: #0a0a0a; color: #fff; padding: 64px 24px 0; position: relative; overflow: hidden;
}
.footer-glow {
    position: absolute; width: 600px; height: 300px; border-radius: 50%;
    background: radial-gradient(circle, rgba(96,165,250,0.06) 0%, transparent 70%);
    bottom: 0; left: 50%; transform: translateX(-50%); pointer-events: none;
}
.footer-inner {
    max-width: 1100px; margin: 0 auto; display: grid;
    grid-template-columns: 1.5fr 1fr 1fr 1fr; gap: 40px;
    position: relative; z-index: 1;
}
.footer-brand p {
    font-size: 14px; color: rgba(255,255,255,0.5); line-height: 1.7;
    margin: 12px 0 20px; max-width: 300px;
}
.footer-brand img { height: 44px; filter: brightness(0) invert(1); }
.footer-socials { display: flex; gap: 10px; }
.footer-social-link {
    width: 36px; height: 36px; border-radius: 10px; background: rgba(255,255,255,0.06);
    border: 1px solid rgba(255,255,255,0.08); display: flex; align-items: center;
    justify-content: center; transition: all 0.2s;
}
.footer-social-link:hover { background: rgba(255,255,255,0.12); transform: translateY(-2px); }
.footer-social-link img { width: 16px; height: 16px; filter: brightness(0) invert(1); opacity: 0.7; }

.footer-col-title {
    font-size: 13px; text-transform: uppercase; letter-spacing: 0.1em;
    color: rgba(255,255,255,0.4); margin: 0 0 18px;
}
.footer-link {
    display: block; font-size: 14px; color: rgba(255,255,255,0.65);
    text-decoration: none; padding: 5px 0; transition: all 0.2s;
}
.footer-link:hover { color: #fff; padding-left: 4px; }
.footer-contact-item {
    display: flex; gap: 10px; align-items: flex-start; margin-bottom: 14px;
    font-size: 14px; color: rgba(255,255,255,0.65);
}
.footer-contact-item svg { width: 18px; height: 18px; flex-shrink: 0; margin-top: 2px; color: rgba(255,255,255,0.35); }

.footer-bottom {
    max-width: 1100px; margin: 48px auto 0; padding: 20px 0;
    border-top: 1px solid rgba(255,255,255,0.06);
    display: flex; justify-content: space-between; align-items: center;
    position: relative; z-index: 1;
}
.footer-bottom-text {
    font-size: 13px; color: rgba(255,255,255,0.35); margin: 0;
}
.footer-bottom-links { display: flex; gap: 20px; }
.footer-bottom-links a {
    font-size: 13px; color: rgba(255,255,255,0.35); text-decoration: none;
    transition: color 0.2s;
}
.footer-bottom-links a:hover { color: rgba(255,255,255,0.7); }

@media (max-width: 768px) {
    .footer-inner { grid-template-columns: 1fr 1fr; gap: 32px; }
    .footer-brand { grid-column: span 2; }
    .footer-bottom { flex-direction: column; gap: 10px; text-align: center; }
}
@media (max-width: 480px) {
    .footer-inner { grid-template-columns: 1fr; }
    .footer-brand { grid-column: span 1; }
}
</style>

<footer class="site-footer">
    <div class="footer-glow"></div>
    <div class="footer-inner">
        <div class="footer-brand">
            <img src="{{ asset('assets/images/logo/abc_logo.svg') }}" alt="Institute of ABC">
            <p class="font-HellixR">Bihar's trusted institute for professional computer education. Building careers since 2016.</p>
            <div class="footer-socials">
                <a href="#" class="footer-social-link"><img src="{{ asset('assets/icons/youtube.svg') }}" alt="YouTube"></a>
                <a href="#" class="footer-social-link"><img src="{{ asset('assets/icons/instagram.svg') }}" alt="Instagram"></a>
                <a href="#" class="footer-social-link"><img src="{{ asset('assets/icons/facebook.svg') }}" alt="Facebook"></a>
                <a href="#" class="footer-social-link"><img src="{{ asset('assets/icons/twitter.svg') }}" alt="Twitter"></a>
            </div>
        </div>

        <div>
            <div class="footer-col-title font-HellixSB">Quick Links</div>
            <a href="{{ route('home') }}" class="footer-link font-HellixR">Home</a>
            <a href="{{ route('about') }}" class="footer-link font-HellixR">About Us</a>
            <a href="{{ route('course') }}" class="footer-link font-HellixR">Courses</a>
            <a href="{{ route('gallery') }}" class="footer-link font-HellixR">Gallery</a>
            <a href="{{ route('student_info') }}" class="footer-link font-HellixR">Student Verification</a>
        </div>

        <div>
            <div class="footer-col-title font-HellixSB">Portals</div>
            <a href="/branch/login" class="footer-link font-HellixR">Branch Login</a>
            <a href="/student_info" class="footer-link font-HellixR">Student Portal</a>
        </div>

        <div>
            <div class="footer-col-title font-HellixSB">Contact</div>
            <div class="footer-contact-item font-HellixR">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                <span>+91 9973380780</span>
            </div>
            <div class="footer-contact-item font-HellixR">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                <span>abc.ask2@gmail.com<br>info@abcedupro.com</span>
            </div>
            <div class="footer-contact-item font-HellixR">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                <span>Haspura, Bihar, India</span>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <p class="footer-bottom-text font-HellixR">&copy; {{ date('Y') }} Institute of ABC. All rights reserved.</p>
        <div class="footer-bottom-links">
            <a href="#" class="font-HellixR">Privacy Policy</a>
            <a href="#" class="font-HellixR">Terms of Service</a>
        </div>
    </div>
</footer>
