@php
    $socials = [
        ['icon' => 'assets/icons/youtube.svg', 'name' => 'youtube', 'onClick' => '#'],
        ['icon' => 'assets/icons/instagram.svg', 'name' => 'instagram', 'onClick' => '#'],
        ['icon' => 'assets/icons/facebook.svg', 'name' => 'facebook', 'onClick' => '#'],
        ['icon' => 'assets/icons/twitter.svg', 'name' => 'twitter', 'onClick' => '#'],
    ];
@endphp

<style>
    .nav-header {
        position: fixed; top: 0; left: 0; right: 0; z-index: 999;
        transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .nav-header.scrolled {
        box-shadow: 0 4px 30px rgba(0,0,0,0.08);
    }

    /* Top bar */
    .nav-topbar {
        background: #121212; color: #fff; font-size: 12px;
        padding: 6px 0; overflow: hidden;
    }
    .nav-topbar-inner {
        max-width: 1280px; margin: 0 auto; padding: 0 40px;
        display: flex; justify-content: space-between; align-items: center;
    }
    .nav-topbar a { color: #fff; text-decoration: none; opacity: 0.85; transition: opacity 0.2s; }
    .nav-topbar a:hover { opacity: 1; }
    .nav-topbar-socials { display: flex; gap: 14px; align-items: center; }
    .nav-topbar-socials img { width: 14px; height: 14px; filter: brightness(0) invert(1); }
    .nav-topbar-contact { display: flex; gap: 24px; align-items: center; }
    .nav-topbar-contact-item { display: flex; gap: 6px; align-items: center; white-space: nowrap; }
    .nav-topbar-contact-item img { width: 13px; height: 13px; filter: brightness(0) invert(1); }
    .nav-topbar-right { display: flex; gap: 14px; align-items: center; }
    .nav-topbar-portal {
        background: rgba(255,255,255,0.12); border: 1px solid rgba(255,255,255,0.2);
        color: #fff; padding: 4px 14px; border-radius: 20px; font-size: 11px;
        text-decoration: none; transition: all 0.2s; cursor: pointer;
    }
    .nav-topbar-portal:hover { background: rgba(255,255,255,0.25); }
    .nav-topbar-portal-student {
        background: #fff; color: #121212; padding: 4px 14px; border-radius: 20px;
        font-size: 11px; border: none; cursor: pointer; transition: all 0.2s;
    }
    .nav-topbar-portal-student:hover { background: #e5e7eb; }

    /* Main nav */
    .nav-main {
        background: rgba(255,255,255,0.92); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);
        border-bottom: 1px solid rgba(0,0,0,0.06);
    }
    .nav-main-inner {
        max-width: 1280px; margin: 0 auto; padding: 0 40px;
        display: flex; justify-content: space-between; align-items: center; height: 72px;
    }
    .nav-logo img { height: 48px; }
    .nav-links { display: flex; gap: 6px; align-items: center; }
    .nav-link {
        position: relative; padding: 8px 16px; font-size: 15px; color: #374151;
        text-decoration: none; border-radius: 8px; transition: all 0.2s;
    }
    .nav-link:hover { background: #f3f4f6; color: #111; }
    .nav-link.active { color: #111; font-family: 'Hellix-Bold'; }
    .nav-link.active::after {
        content: ''; position: absolute; bottom: 0; left: 16px; right: 16px;
        height: 2px; background: #121212; border-radius: 2px;
    }

    /* About dropdown */
    .nav-dropdown { position: relative; }
    .nav-dropdown-menu {
        position: absolute; top: calc(100% + 8px); left: 50%; transform: translateX(-50%);
        background: #fff; border-radius: 14px; min-width: 240px;
        box-shadow: 0 12px 40px rgba(0,0,0,0.12), 0 0 0 1px rgba(0,0,0,0.04);
        opacity: 0; visibility: hidden; transform: translateX(-50%) translateY(8px);
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1); padding: 8px; z-index: 100;
    }
    .nav-dropdown:hover .nav-dropdown-menu,
    .nav-dropdown.open .nav-dropdown-menu {
        opacity: 1; visibility: visible; transform: translateX(-50%) translateY(0);
    }
    .nav-dropdown-item {
        display: flex; align-items: center; gap: 10px; padding: 10px 14px;
        border-radius: 8px; font-size: 14px; color: #374151;
        text-decoration: none; transition: all 0.15s;
    }
    .nav-dropdown-item:hover { background: #f3f4f6; color: #111; }
    .nav-dropdown-item svg { width: 18px; height: 18px; color: #9ca3af; flex-shrink: 0; }
    .nav-dropdown-chevron {
        width: 14px; height: 14px; transition: transform 0.25s; margin-left: 2px;
    }
    .nav-dropdown:hover .nav-dropdown-chevron { transform: rotate(180deg); }

    /* Student Verification dropdown */
    .nav-dropdown-sv .nav-dropdown-menu { min-width: 220px; }

    /* Mobile burger */
    .nav-burger {
        display: none; background: none; border: none; cursor: pointer; padding: 8px;
        border-radius: 8px; transition: background 0.2s;
    }
    .nav-burger:hover { background: #f3f4f6; }
    .nav-burger svg { width: 24px; height: 24px; }

    /* Mobile menu */
    .mobile-overlay {
        position: fixed; inset: 0; background: rgba(0,0,0,0.4); z-index: 1000;
        opacity: 0; visibility: hidden; transition: all 0.3s;
    }
    .mobile-overlay.open { opacity: 1; visibility: visible; }
    .mobile-drawer {
        position: fixed; top: 0; right: 0; bottom: 0; width: 300px; max-width: 85vw;
        background: #fff; z-index: 1001; transform: translateX(100%);
        transition: transform 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex; flex-direction: column; overflow-y: auto;
    }
    .mobile-drawer.open { transform: translateX(0); }
    .mobile-drawer-header {
        display: flex; justify-content: space-between; align-items: center;
        padding: 20px 24px; border-bottom: 1px solid #f3f4f6;
    }
    .mobile-drawer-close {
        background: #f3f4f6; border: none; border-radius: 50%; width: 36px; height: 36px;
        display: flex; align-items: center; justify-content: center; cursor: pointer;
    }
    .mobile-drawer-links { padding: 16px; flex: 1; }
    .mobile-link {
        display: block; padding: 14px 12px; font-size: 16px; color: #374151;
        text-decoration: none; border-radius: 10px; transition: all 0.15s;
    }
    .mobile-link:hover, .mobile-link.active { background: #f3f4f6; color: #111; }
    .mobile-accordion-btn {
        display: flex; width: 100%; justify-content: space-between; align-items: center;
        padding: 14px 12px; font-size: 16px; color: #374151; background: none;
        border: none; border-radius: 10px; cursor: pointer; transition: all 0.15s;
    }
    .mobile-accordion-btn:hover { background: #f3f4f6; }
    .mobile-accordion-content {
        max-height: 0; overflow: hidden; transition: max-height 0.3s ease;
    }
    .mobile-accordion-content.open { max-height: 200px; }
    .mobile-accordion-sub {
        display: block; padding: 10px 12px 10px 28px; font-size: 14px;
        color: #6b7280; text-decoration: none; border-radius: 8px; transition: all 0.15s;
    }
    .mobile-accordion-sub:hover { background: #f9fafb; color: #111; }
    .mobile-drawer-footer {
        padding: 16px 24px; border-top: 1px solid #f3f4f6;
        display: flex; flex-direction: column; gap: 10px;
    }
    .mobile-portal-btn {
        display: block; text-align: center; padding: 12px; border-radius: 10px;
        font-size: 14px; text-decoration: none; transition: all 0.2s;
    }
    .mobile-portal-branch {
        background: #f3f4f6; color: #374151;
    }
    .mobile-portal-student {
        background: #121212; color: #fff;
    }

    @media (max-width: 999px) {
        .nav-topbar { display: none; }
        .nav-links { display: none; }
        .nav-burger { display: flex; }
        .nav-main-inner { padding: 0 20px; height: 64px; }
        .nav-logo img { height: 40px; }
    }
    @media (max-width: 600px) {
        .nav-main-inner { padding: 0 16px; }
    }
</style>

<nav class="nav-header" id="navHeader">
    {{-- Top Bar --}}
    <div class="nav-topbar" id="navTopbar">
        <div class="nav-topbar-inner">
            <div class="nav-topbar-socials">
                @foreach ($socials as $social)
                    <a href="{{ $social['onClick'] }}"><img src="{{ asset($social['icon']) }}" alt="{{ $social['name'] }}"></a>
                @endforeach
            </div>
            <div class="nav-topbar-contact">
                <div class="nav-topbar-contact-item font-HellixR">
                    <img src="{{ asset('assets/icons/phone-small.svg') }}" alt="">
                    <span>+91 9973380780</span>
                </div>
                <div class="nav-topbar-contact-item font-HellixR">
                    <img src="{{ asset('assets/icons/mail.svg') }}" alt="">
                    <span>abc.ask2@gmail.com</span>
                </div>
                <div class="nav-topbar-contact-item font-HellixR">
                    <img src="{{ asset('assets/icons/globe.svg') }}" alt="">
                    <span>Haspura, Bihar</span>
                </div>
            </div>
            <div class="nav-topbar-right">
                <a href="/branch/login" class="nav-topbar-portal font-HellixSB">Branch Portal</a>
                <button class="nav-topbar-portal-student font-HellixSB" onclick="window.location.href='/student_info'">Student Portal</button>
            </div>
        </div>
    </div>

    {{-- Main Nav --}}
    <div class="nav-main">
        <div class="nav-main-inner">
            <div class="nav-links">
                <a href="{{ route('home') }}" class="nav-link font-HellixR {{ Route::currentRouteName() == 'home' ? 'active' : '' }}">Home</a>

                {{-- About Us Dropdown --}}
                <div class="nav-dropdown">
                    <a href="{{ route('about') }}" class="nav-link font-HellixR {{ Route::currentRouteName() == 'about' ? 'active' : '' }}" style="display:flex;align-items:center;gap:4px;">
                        About Us
                        <svg class="nav-dropdown-chevron" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </a>
                    <div class="nav-dropdown-menu">
                        <a href="{{ route('about') }}" class="nav-dropdown-item font-HellixR">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            Director's Message
                        </a>
                        <a href="{{ route('about') }}?tab=iso" class="nav-dropdown-item font-HellixR">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                            ISO Certificate
                        </a>
                        <a href="{{ route('about') }}?tab=govt" class="nav-dropdown-item font-HellixR">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            Bihar Govt. Certificate
                        </a>
                    </div>
                </div>

                <a href="{{ route('course') }}" class="nav-link font-HellixR {{ Route::currentRouteName() == 'course' ? 'active' : '' }}">Courses</a>
                <a href="{{ route('gallery') }}" class="nav-link font-HellixR {{ Route::currentRouteName() == 'gallery' ? 'active' : '' }}">Gallery</a>
            </div>

            <a href="{{ route('home') }}" class="nav-logo">
                <img src="{{ asset('assets/images/logo/abc_logo.svg') }}" alt="Institute of ABC">
            </a>

            <div class="nav-links">
                <a href="{{ route('student_info') }}" class="nav-link font-HellixR {{ Route::currentRouteName() == 'student_info' ? 'active' : '' }}">Student Verification</a>
                <a href="{{ route('contact') }}" class="nav-link font-HellixR {{ Route::currentRouteName() == 'contact' ? 'active' : '' }}">Contact</a>
            </div>

            <button class="nav-burger" id="navBurger" aria-label="Open menu">
                <svg fill="none" stroke="#374151" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
        </div>
    </div>
</nav>

{{-- Mobile Drawer --}}
<div class="mobile-overlay" id="mobileOverlay"></div>
<div class="mobile-drawer" id="mobileDrawer">
    <div class="mobile-drawer-header">
        <img src="{{ asset('assets/images/logo/abc_logo.svg') }}" alt="Logo" style="height:36px;">
        <button class="mobile-drawer-close" id="mobileClose">
            <svg width="16" height="16" fill="none" stroke="#374151" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
    </div>
    <div class="mobile-drawer-links">
        <a href="{{ route('home') }}" class="mobile-link font-HellixR {{ Route::currentRouteName() == 'home' ? 'active' : '' }}">Home</a>

        {{-- About accordion --}}
        <button class="mobile-accordion-btn font-HellixR" data-accordion="about">
            About Us
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="transition:transform 0.3s;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
        </button>
        <div class="mobile-accordion-content" data-accordion-content="about">
            <a href="{{ route('about') }}" class="mobile-accordion-sub font-HellixR">Director's Message</a>
            <a href="{{ route('about') }}?tab=iso" class="mobile-accordion-sub font-HellixR">ISO Certificate</a>
            <a href="{{ route('about') }}?tab=govt" class="mobile-accordion-sub font-HellixR">Bihar Govt. Certificate</a>
        </div>

        <a href="{{ route('course') }}" class="mobile-link font-HellixR {{ Route::currentRouteName() == 'course' ? 'active' : '' }}">Courses</a>
        <a href="{{ route('gallery') }}" class="mobile-link font-HellixR {{ Route::currentRouteName() == 'gallery' ? 'active' : '' }}">Gallery</a>

        <a href="{{ route('student_info') }}" class="mobile-link font-HellixR {{ Route::currentRouteName() == 'student_info' ? 'active' : '' }}">Student Verification</a>
        <a href="{{ route('contact') }}" class="mobile-link font-HellixR {{ Route::currentRouteName() == 'contact' ? 'active' : '' }}">Contact Us</a>
    </div>
    <div class="mobile-drawer-footer">
        <a href="/branch/login" class="mobile-portal-btn mobile-portal-branch font-HellixSB">Branch Portal</a>
        <a href="/student_info" class="mobile-portal-btn mobile-portal-student font-HellixSB">Student Portal</a>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var header = document.getElementById('navHeader');
    var topbar = document.getElementById('navTopbar');
    var lastScroll = 0;

    window.addEventListener('scroll', function() {
        var scrollY = window.scrollY;
        if (scrollY > 40) {
            header.classList.add('scrolled');
            if (topbar) topbar.style.marginTop = '-' + topbar.offsetHeight + 'px';
        } else {
            header.classList.remove('scrolled');
            if (topbar) topbar.style.marginTop = '0';
        }
        lastScroll = scrollY;
    });

    // Mobile drawer
    var burger = document.getElementById('navBurger');
    var overlay = document.getElementById('mobileOverlay');
    var drawer = document.getElementById('mobileDrawer');
    var closeBtn = document.getElementById('mobileClose');

    function openDrawer() { overlay.classList.add('open'); drawer.classList.add('open'); document.body.style.overflow = 'hidden'; }
    function closeDrawer() { overlay.classList.remove('open'); drawer.classList.remove('open'); document.body.style.overflow = ''; }

    burger.addEventListener('click', openDrawer);
    overlay.addEventListener('click', closeDrawer);
    closeBtn.addEventListener('click', closeDrawer);

    // Mobile accordions
    document.querySelectorAll('.mobile-accordion-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var key = btn.getAttribute('data-accordion');
            var content = document.querySelector('[data-accordion-content="' + key + '"]');
            var icon = btn.querySelector('svg');
            content.classList.toggle('open');
            icon.style.transform = content.classList.contains('open') ? 'rotate(180deg)' : 'rotate(0)';
        });
    });
});
</script>
