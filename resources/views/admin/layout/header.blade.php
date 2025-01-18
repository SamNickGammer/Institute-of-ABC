@php
    $contacts = [
        [
            'icon' => 'assets/icons/phone-small.svg',
            'text' => '+91 9973380780',
        ],
        [
            'icon' => 'assets/icons/mail.svg',
            'text' => 'abc.ask2@gmail.com  | info@abcedupro.com',
        ],
        [
            'icon' => 'assets/icons/globe.svg',
            'text' => 'Haspura, Bihar',
        ],
    ];
@endphp


<div
    class="header_container flex flex-col w-full h-[40px] border-b-1 border-line-mid fixed top-0 backdrop-filter backdrop-blur-2xl bg-opacity-10 z-[999]">
    <div class="h-[40px] border-b-1 border-line-thin justify-between items-center px-[75px] hidden md:flex">
        <div class="gap-[20px] justify-center 1000:flex hidden">
            @foreach ($contacts as $contact)
                <div class="flex gap-[10px] flex-shrink-0">
                    <img src='{{ asset($contact['icon']) }}' alt="">
                    <div class="font-HellixSB text-[12px] whitespace-nowrap">{{ $contact['text'] }}</div>
                </div>
            @endforeach
        </div>
        <div class="flex gap-[20px] justify-center">
            <button
                id='logoutButtonAdmin'
                class="bg-clifford text-[#ffffff] rounded-full font-HellixSB text-[12px] flex justify-center items-center h-[26px] w-[116px] whitespace-nowrap">
                Logout
            </button>
        </div>
    </div>
</div>


<script>
    const logoutButtonAdmin = document.getElementById('logoutButtonAdmin');
    logoutButtonAdmin.addEventListener('click', () => {
        sessionStorage.removeItem('branchData');
        window.location.href = '/admin/login';
    });
</script>
