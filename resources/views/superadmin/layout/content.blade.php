<style>
    .sa-sidebar {
        width: 240px;
        flex-shrink: 0;
        padding: 16px 12px;
        position: sticky;
        top: 60px;
        height: calc(100vh - 60px);
        overflow-y: auto;
        background: #111;
        border-right: 1px solid rgba(255,255,255,0.06);
    }
    .sa-sidebar::-webkit-scrollbar { width: 0; }
    .sa-section-label {
        font-size: 10px;
        color: rgba(255,255,255,0.25);
        text-transform: uppercase;
        letter-spacing: 0.08em;
        padding: 0 14px;
        margin-bottom: 8px;
        margin-top: 22px;
    }
    .sa-section-label:first-child { margin-top: 0; }
    .sa-link {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 9px 14px;
        border-radius: 10px;
        text-decoration: none;
        font-size: 13.5px;
        color: rgba(255,255,255,0.45);
        transition: all 0.15s;
        margin-bottom: 2px;
    }
    .sa-link:hover {
        background: rgba(255,255,255,0.06);
        color: rgba(255,255,255,0.85);
    }
    .sa-link.active {
        background: #fff;
        color: #111;
    }
    .sa-link.active .sa-icon { color: #111; }
    .sa-icon {
        width: 18px; height: 18px;
        flex-shrink: 0;
        color: rgba(255,255,255,0.3);
        transition: color 0.15s;
    }
    .sa-link:hover .sa-icon { color: rgba(255,255,255,0.65); }
    .sa-main-wrapper {
        flex: 1;
        min-width: 0;
        height: calc(100vh - 60px);
        overflow: hidden;
    }
    .sa-main-scroll {
        height: 100%;
        overflow-y: auto;
        padding: 20px 24px 40px;
        scroll-behavior: smooth;
    }
    .sa-main-scroll::-webkit-scrollbar { width: 6px; }
    .sa-main-scroll::-webkit-scrollbar-track { background: transparent; }
    .sa-main-scroll::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 3px; }
    .sa-main-scroll { scrollbar-width: thin; scrollbar-color: #d1d5db transparent; }
</style>

<body class="font-HellixR" style="background: #f5f6f8; margin: 0;">
    <div style="padding-top: 60px;">
        <div style="display: flex;">
            <aside class="sa-sidebar">
                <nav>
                    <div class="sa-section-label font-HellixB">Overview</div>

                    @php
                        $saMenu = [
                            ['route' => 'superadmin.dashboard', 'label' => 'Dashboard', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 5a1 1 0 011-1h4a1 1 0 011 1v5a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM14 5a1 1 0 011-1h4a1 1 0 011 1v2a1 1 0 01-1 1h-4a1 1 0 01-1-1V5zM4 16a1 1 0 011-1h4a1 1 0 011 1v3a1 1 0 01-1 1H5a1 1 0 01-1-1v-3zM14 13a1 1 0 011-1h4a1 1 0 011 1v6a1 1 0 01-1 1h-4a1 1 0 01-1-1v-6z"/>'],
                            ['route' => 'superadmin.allStudents', 'label' => 'All Students', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>'],
                            ['route' => 'superadmin.library', 'label' => 'Library', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 19.5A2.5 2.5 0 016.5 17H20M6.5 17A2.5 2.5 0 004 19.5v0A2.5 2.5 0 006.5 22H20V4H6.5A2.5 2.5 0 004 6.5v13z"/>'],
                        ];
                        $saActions = [
                            ['route' => 'superadmin.certificateApprovals', 'label' => 'Certificate Approvals', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>'],
                            ['route' => 'superadmin.branches', 'label' => 'Branches', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>'],
                            ['route' => 'superadmin.courses', 'label' => 'Courses', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>'],
                            ['route' => 'superadmin.settings', 'label' => 'Settings', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M11.983 5.25c.687-1.35 2.347-1.35 3.034 0l.23.453a1.7 1.7 0 001.938.89l.5-.11c1.49-.328 2.664.846 2.336 2.336l-.11.5a1.7 1.7 0 00.89 1.938l.453.23c1.35.687 1.35 2.347 0 3.034l-.453.23a1.7 1.7 0 00-.89 1.938l.11.5c.328 1.49-.846 2.664-2.336 2.336l-.5-.11a1.7 1.7 0 00-1.938.89l-.23.453c-.687 1.35-2.347 1.35-3.034 0l-.23-.453a1.7 1.7 0 00-1.938-.89l-.5.11c-1.49.328-2.664-.846-2.336-2.336l.11-.5a1.7 1.7 0 00-.89-1.938l-.453-.23c-1.35-.687-1.35-2.347 0-3.034l.453-.23a1.7 1.7 0 00.89-1.938l-.11-.5c-.328-1.49.846-2.664 2.336-2.336l.5.11a1.7 1.7 0 001.938-.89l.23-.453z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>'],
                        ];
                    @endphp

                    @foreach($saMenu as $item)
                        <a href="{{ route($item['route']) }}" class="sa-link font-HellixB {{ request()->routeIs($item['route']) ? 'active' : '' }}">
                            <svg class="sa-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">{!! $item['icon'] !!}</svg>
                            {{ $item['label'] }}
                        </a>
                    @endforeach

                    <div class="sa-section-label font-HellixB">Manage</div>

                    @foreach($saActions as $item)
                        <a href="{{ route($item['route']) }}" class="sa-link font-HellixB {{ request()->routeIs($item['route']) ? 'active' : '' }}">
                            <svg class="sa-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">{!! $item['icon'] !!}</svg>
                            {{ $item['label'] }}
                        </a>
                    @endforeach
                </nav>
            </aside>
            <main class="sa-main-wrapper">
                <div class="sa-main-scroll">
                    @if (@isset($component))
                        @include($component)
                    @endif
                </div>
            </main>
        </div>
    </div>

    <script>
        const API_URL = `{{ rtrim(config('app.url'), '/') }}/api`;

        function getAdminData() {
            const raw = sessionStorage.getItem('adminData');
            if (!raw) return null;
            const parsed = JSON.parse(raw);
            if (Date.now() > parsed.expiryTime) {
                sessionStorage.removeItem('adminData');
                return null;
            }
            return parsed;
        }

        function verifyAdminAccess(callback) {
            var session = getAdminData();
            if (!session) { window.location.href = '/admin-abc/login'; return; }
            fetch(API_URL + '/admin/verify-admin', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ branch_id: session.adminData.branch_id })
            })
            .then(function(r) { return r.json(); })
            .then(function(result) {
                if (result.error) { sessionStorage.removeItem('adminData'); window.location.href = '/admin-abc/login'; return; }
                if (callback) callback(session);
            })
            .catch(function() { window.location.href = '/admin-abc/login'; });
        }
    </script>
</body>
