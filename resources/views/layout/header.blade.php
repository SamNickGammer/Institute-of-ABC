@php
    $socials = [
        [
            'icon' => 'assets/icons/youtube.svg',
            'name' => 'youtube',
            'onClick' => '#',
        ],
        [
            'icon' => 'assets/icons/instagram.svg',
            'name' => 'instagram',
            'onClick' => '#',
        ],
        [
            'icon' => 'assets/icons/facebook.svg',
            'name' => 'facebook',
            'onClick' => '#',
        ],
        [
            'icon' => 'assets/icons/twitter.svg',
            'name' => 'twitter',
            'onClick' => '#',
        ],
    ];
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

{{-- <div id="spinner" class="fixed inset-0 bg-white flex items-center justify-center z-50 transition-opacity duration-300 opacity-100">
    <div class="animate-spin rounded-full h-12 w-12 border-t-4 border-blue-500 border-solid"></div>
</div> --}}

<div
    class="header_container flex flex-col w-full md:h-[124px] border-b-1 border-line-mid h-[75px] fixed top-0 backdrop-filter backdrop-blur-2xl bg-opacity-10 z-[999]">
    <div class="h-[40px] border-b-1 border-line-thin justify-between items-center px-[75px] hidden md:flex">
        <div class="flex gap-[20px] justify-center">
            @foreach ($socials as $social)
                <a href="{{ $social['onClick'] }}">
                    <img src="{{ asset($social['icon']) }}" alt="{{ $social['name'] }}">
                </a>
            @endforeach
        </div>
        <div class="gap-[20px] justify-center 1000:flex hidden">
            @foreach ($contacts as $contact)
                <div class="flex gap-[10px] flex-shrink-0">
                    <img src='{{ asset($contact['icon']) }}' alt="">
                    <div class="font-HellixSB text-[12px] whitespace-nowrap">{{ $contact['text'] }}</div>
                </div>
            @endforeach
        </div>
        <div class="flex gap-[20px] justify-center">
            <a href="#" class=" flex justify-center items-center">
                <div class="font-HellixSB text-[12px]">ADMINISTRATOR PORTAL</div>
            </a>
            <button
                class="bg-ThemeBlack text-[#ffffff] rounded-full font-HellixSB text-[12px] flex justify-center items-center h-[26px] w-[116px] whitespace-nowrap">
                Student Portal
            </button>
        </div>
    </div>
    <div class="px-[25px] md:px-[75px] h-[84px] justify-between items-center flex">
        <div class="1000:flex gap-[25px] hidden">
            <a href="#" class="h-[84px] flex items-center text-[18px] {{ Route::currentRouteName() == 'home' ? 'font-HellixSB border-b-4 border-ThemeBlack' : 'font-HellixR text-[#1B1B1B]'}}">Home</a>
            <a href="#" class="h-[84px] flex items-center text-[18px] {{ Route::currentRouteName() == 'about' ? 'font-HellixSB border-b-4 border-ThemeBlack' : 'font-HellixR text-[#1B1B1B]'}}">About Us</a>
            <a href="#" class="h-[84px] flex items-center text-[18px] {{ Route::currentRouteName() == 'course' ? 'font-HellixSB border-b-4 border-ThemeBlack' : 'font-HellixR text-[#1B1B1B]'}}">Course</a>
            <a href="#" class="h-[84px] flex items-center text-[18px] {{ Route::currentRouteName() == 'gallery' ? 'font-HellixSB border-b-4 border-ThemeBlack' : 'font-HellixR text-[#1B1B1B]'}}">Gallery</a>
        </div>
        <div class="flex 1000:hidden">
            <img id="burger-icon" src="{{ asset('assets/icons/menu.svg') }}" alt="" class="h-[24px]">
        </div>
        <img src="{{ asset('assets/images/logo/abc_logo.svg') }}" alt="" class="h-[55px]">
        <div class="flex 1000:hidden"></div>
        <div class="1000:flex gap-[25px] hidden">
            <div class="relative inline-block group/dropdown">
                <div class="h-[84px] flex items-center text-[18px] font-HellixR text-[#1B1B1B] cursor-pointer">Student Verification</div>
                <div class="hidden absolute bg-gray-100 min-w-[200px] shadow-lg z-10 group-hover/dropdown:block top-[70px] rounded-[10px]">
                  <a href="#" class="block px-4 py-2 text-black hover:bg-gray-300 no-underline hover:rounded-t-[10px] font-HellixR transition-all hover:px-[1.25rem] text-[15px]">Student Information</a>
                  <a href="#" class="block px-4 py-2 text-black hover:bg-gray-300 no-underline font-HellixR transition-all hover:px-[1.25rem] text-[15px]">Certificate Verification</a>
                  <a href="#" class="block px-4 py-2 text-black hover:bg-gray-300 no-underline font-HellixR transition-all hover:px-[1.25rem] text-[15px]">Marksheet Verification</a>
                  <a href="#" class="block px-4 py-2 text-black hover:bg-gray-300 no-underline hover:rounded-b-[10px] font-HellixR transition-all hover:px-[1.25rem] text-[15px]">Registration Enquiry</a>
                </div>
            </div>
            <a href="#" class="h-[84px] flex items-center text-[18px] {{ Route::currentRouteName() == 'contactus' ? 'font-HellixSB border-b-4 border-ThemeBlack' : 'font-HellixR text-[#1B1B1B]'}}">Contact Us</a>
            
        </div>
    </div>
</div>


<div id="mobile-menu" class="fixed inset-0 bg-white backdrop-blur-lg bg-opacity-80 z-50 transform -translate-x-full transition-transform duration-500 ease-in-out">
    <div class="flex flex-col justify-center items-center h-screen relative">
        <div id="close-menu" class="absolute top-8 right-8 cursor-pointer">
            <img src="{{ asset('assets/icons/close.svg') }}" alt="" class="h-[24px]">
        </div>
        <a href="#" class="text-[18px] mb-6 font-HellixSB">Home</a>
        <a href="#" class="text-[18px] mb-6 font-HellixSB">About Us</a>
        <a href="#" class="text-[18px] mb-6 font-HellixSB">Course</a>
        <a href="#" class="text-[18px] mb-6 font-HellixSB">Gallery</a>
        <a href="#" class="text-[18px] mb-6 font-HellixSB">Contact Us</a>
        <div class="">
            <button id="accordion-button" class="flex items-center gap-[10px] text-[18px] mb-6 w-full text-center justify-between px-4 font-HellixSB">
                Student Verification
                <span id="accordion-icon" class="transition-transform duration-300">
                    <img src="{{ asset('assets/icons/chevron-down.svg') }}" alt="" class="h-[24px]">
                </span>
            </button>
            <div id="accordion-content" class="flex flex-col items-center overflow-hidden transition-all duration-500 max-h-0">
                <a href="#" class="text-[16px] mb-4 font-HellixR">Student Information</a>
                <a href="#" class="text-[16px] mb-4 font-HellixR">Certificate Verification</a>
                <a href="#" class="text-[16px] mb-4 font-HellixR">Marksheet Verification</a>
                <a href="#" class="text-[16px] mb-4 font-HellixR">Registration Enquiry</a>
            </div>
        </div>
        <button
            class="bg-ThemeBlack text-[#ffffff] rounded-full font-HellixSB text-[12px] flex justify-center items-center h-[26px] w-[116px] whitespace-nowrap absolute bottom-[45px]">
            Student Portal
        </button>
    </div>
</div>





<script>
    const burgerIcon = document.getElementById('burger-icon');
    const mobileMenu = document.getElementById('mobile-menu');
    const closeMenu = document.getElementById('close-menu');

    burgerIcon.addEventListener('click', () => {
        mobileMenu.classList.remove('-translate-x-full');
    });

    closeMenu.addEventListener('click', () => {
        mobileMenu.classList.add('-translate-x-full');
    });

    const accordionButton = document.getElementById('accordion-button');
    const accordionContent = document.getElementById('accordion-content');
    const accordionIcon = document.getElementById('accordion-icon');

    accordionButton.addEventListener('click', () => {
        if (accordionContent.style.maxHeight) {
            accordionContent.style.maxHeight = null;
            accordionIcon.style.transform = "rotate(0deg)";
        } else {
            accordionContent.style.maxHeight = accordionContent.scrollHeight + "px";
            accordionIcon.style.transform = "rotate(180deg)";
        }
    });
</script>

{{-- <script>
    var spinner = function () {
        setTimeout(function () {
            var spinnerElement = document.getElementById('spinner');
            if (spinnerElement) {
                spinnerElement.classList.add('opacity-0');
                setTimeout(function () {
                    spinnerElement.style.display = 'none'; 
                }, 300);
            }
        }, 1000);
    };

    spinner();
</script> --}}
