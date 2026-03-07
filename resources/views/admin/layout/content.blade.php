<style>
    .admin-sidebar {
        width: 240px;
        flex-shrink: 0;
        padding: 16px 12px;
        position: sticky;
        top: 60px;
        height: calc(100vh - 60px);
        overflow-y: auto;
    }
    .sidebar-section-label {
        font-size: 10px;
        color: #b0b0b0;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        padding: 0 14px;
        margin-bottom: 8px;
        margin-top: 20px;
    }
    .sidebar-section-label:first-child {
        margin-top: 0;
    }
    .sidebar-link {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 9px 14px;
        border-radius: 10px;
        text-decoration: none;
        font-size: 13.5px;
        color: #6b7280;
        transition: all 0.15s;
        margin-bottom: 2px;
    }
    .sidebar-link:hover {
        background: #f3f4f6;
        color: #111;
    }
    .sidebar-link.active {
        background: #111;
        color: #fff;
    }
    .sidebar-link.active .sidebar-icon {
        color: #fff;
    }
    .sidebar-icon {
        width: 18px;
        height: 18px;
        flex-shrink: 0;
        color: #9ca3af;
        transition: color 0.15s;
    }
    .sidebar-link:hover .sidebar-icon {
        color: #6b7280;
    }

    /* Main content area */
    .admin-main-wrapper {
        flex: 1;
        min-width: 0;
        height: calc(100vh - 60px);
        overflow: hidden;
    }
    .admin-main-scroll {
        height: 100%;
        overflow-y: auto;
        padding: 20px 24px 40px;
        scroll-behavior: smooth;
    }
    /* Custom scrollbar */
    .admin-main-scroll::-webkit-scrollbar {
        width: 6px;
    }
    .admin-main-scroll::-webkit-scrollbar-track {
        background: transparent;
    }
    .admin-main-scroll::-webkit-scrollbar-thumb {
        background: #d1d5db;
        border-radius: 3px;
    }
    .admin-main-scroll::-webkit-scrollbar-thumb:hover {
        background: #9ca3af;
    }
    /* Firefox */
    .admin-main-scroll {
        scrollbar-width: thin;
        scrollbar-color: #d1d5db transparent;
    }
    /* Sidebar scrollbar */
    .admin-sidebar::-webkit-scrollbar {
        width: 0;
    }
</style>

<body class="font-HellixR" style="background: #f5f6f8; margin: 0;">
    <div style="padding-top: 60px;">
        <div style="display: flex;">
            <aside class="admin-sidebar" style="background: #fff; border-right: 1px solid #eff0f2;">
                <nav>
                    <div class="sidebar-section-label font-HellixB">Main</div>

                    @php
                        $menuItems = [
                            [
                                'route' => 'branch.dashboard',
                                'label' => 'Dashboard',
                                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 5a1 1 0 011-1h4a1 1 0 011 1v5a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM14 5a1 1 0 011-1h4a1 1 0 011 1v2a1 1 0 01-1 1h-4a1 1 0 01-1-1V5zM4 16a1 1 0 011-1h4a1 1 0 011 1v3a1 1 0 01-1 1H5a1 1 0 01-1-1v-3zM14 13a1 1 0 011-1h4a1 1 0 011 1v6a1 1 0 01-1 1h-4a1 1 0 01-1-1v-6z"/>',
                            ],
                            [
                                'route' => 'branch.allStudents',
                                'label' => 'All Students',
                                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>',
                            ],
                            [
                                'route' => 'branch.addStudent',
                                'label' => 'Add Student',
                                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>',
                            ],
                        ];

                        $managementItems = [
                            [
                                'route' => 'branch.marksheetManagement',
                                'label' => 'Marksheet Mgmt',
                                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>',
                            ],
                            [
                                'route' => 'branch.recentApproved',
                                'label' => 'Recent Approved',
                                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>',
                            ],
                        ];
                    @endphp

                    @foreach($menuItems as $item)
                        <a href="{{ route($item['route']) }}"
                            class="sidebar-link font-HellixB {{ request()->routeIs($item['route']) ? 'active' : '' }}">
                            <svg class="sidebar-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">{!! $item['icon'] !!}</svg>
                            {{ $item['label'] }}
                        </a>
                    @endforeach

                    <div class="sidebar-section-label font-HellixB">Management</div>

                    @foreach($managementItems as $item)
                        <a href="{{ route($item['route']) }}"
                            class="sidebar-link font-HellixB {{ request()->routeIs($item['route']) ? 'active' : '' }}">
                            <svg class="sidebar-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">{!! $item['icon'] !!}</svg>
                            {{ $item['label'] }}
                        </a>
                    @endforeach
                </nav>
            </aside>
            <main class="admin-main-wrapper">
                <div class="admin-main-scroll">
                    @if (@isset($component))
                        @include($component)
                    @endif
                </div>
            </main>
        </div>
    </div>

    <script>
        const API_URL = `{{ rtrim(config('app.url'), '/') }}/api`;

        function getBranchData() {
            const raw = sessionStorage.getItem('branchData');
            if (!raw) return null;
            const parsed = JSON.parse(raw);
            if (Date.now() > parsed.expiryTime) {
                sessionStorage.removeItem('branchData');
                return null;
            }
            return parsed;
        }
    </script>
</body>
