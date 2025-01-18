<body class="bg-gray-100 font-HellixR">
    <div class="pt-[60px] min-h-[calc(100vh-60px)]">
        <div class="container px-4">
            <div class="flex gap-6">
                <aside class="w-64 flex-shrink-0 bg-gray-100 rounded-2xl shadow-sm">
                    <nav class="p-4">
                        <ul class="space-y-2">
                            @php
                                $menuItems = [
                                    ['route' => 'admin.dashboard', 'label' => 'Dashboard'],
                                    ['route' => 'admin.allStudents', 'label' => 'All Students'],
                                    ['route' => 'admin.addNewStudent', 'label' => 'Add Student'],
                                    ['route' => 'admin.addNewStudent', 'label' => 'New Students'],
                                    ['route' => 'admin.addNewStudent', 'label' => 'Verified Students'],
                                ];
                            @endphp
                
                            @foreach($menuItems as $item)
                                <li>
                                    <a 
                                        href="{{ route($item['route']) }}"
                                        @class([
                                            'block px-4 py-2 rounded-lg transition-colors font- font-HellixB',
                                            'bg-black text-white font-HellixB' =>  request()->routeIs($item['route']),
                                            'text-gray-700 hover:bg-gray-100' => !request()->routeIs($item['route'])
                                        ])
                                    >
                                        {{ $item['label'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </nav>
                </aside>
                <main class="flex-1">
                    <div class="bg-gray-100 rounded-2xl shadow-sm h-[calc(100vh-84px)] overflow-hidden w-[calc(100vw-20rem)]">
                        <div class="h-full overflow-y-auto px-3 py-3">
                            @if (@isset($component))
                                @include($component)
                            @endif
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
</body>