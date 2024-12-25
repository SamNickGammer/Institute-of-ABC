@php
    $courses = [
        [
            'image' => 'assets/dice-1502706_640 (4).jpg',
            'title' => 'ADCA',
            'description' => 'Advance Diploma in Computer Application',
        ],
        [
            'image' => 'assets/dice-1502706_640 (4).jpg',
            'title' => 'ADCA',
            'description' => 'Advance Diploma in Computer Application',
        ],
        [
            'image' => 'assets/dice-1502706_640 (4).jpg',
            'title' => 'ADCA',
            'description' => 'Advance Diploma in Computer Application',
        ],
        [
            'image' => 'assets/dice-1502706_640 (4).jpg',
            'title' => 'ADCA',
            'description' => 'Advance Diploma in Computer Application',
        ],
        [
            'image' => 'assets/dice-1502706_640 (4).jpg',
            'title' => 'ADCA',
            'description' => 'Advance Diploma in Computer Application',
        ],
    ];

    $testimonials = [
        [
            'name' => 'Om Prakash Bharati',
            'position' => 'SDE @ BITCS',
            'rating' => 2,
            'description' => 'Lorem ipsum dolor sit amet consectetur adiping elit. Maxime mollitia, molestiae quas vel.',
            'image' => 'assets/dice-1502706_640 (4).jpg'
        ],
        [
            'name' => 'John Doe',
            'position' => 'Developer @ XYZ Corp',
            'rating' => 4,
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam tempor metus vel orci suscipit.',
            'image' => 'assets/dice-1502706_640 (4).jpg'
        ],
        [
            'name' => 'John Doe',
            'position' => 'Developer @ XYZ Corp',
            'rating' => 4,
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam tempor metus vel orci suscipit.',
            'image' => 'assets/dice-1502706_640 (4).jpg'
        ],
        [
            'name' => 'John Doe',
            'position' => 'Developer @ XYZ Corp',
            'rating' => 4,
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam tempor metus vel orci suscipit.',
            'image' => 'assets/dice-1502706_640 (4).jpg'
        ],
        [
            'name' => 'John Doe',
            'position' => 'Developer @ XYZ Corp',
            'rating' => 4,
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam tempor metus vel orci suscipit.',
            'image' => 'assets/dice-1502706_640 (4).jpg'
        ],
        [
            'name' => 'John Doe',
            'position' => 'Developer @ XYZ Corp',
            'rating' => 4,
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam tempor metus vel orci suscipit.',
            'image' => 'assets/dice-1502706_640 (4).jpg'
        ],
        [
            'name' => 'John Doe',
            'position' => 'Developer @ XYZ Corp',
            'rating' => 4,
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam tempor metus vel orci suscipit.',
            'image' => 'assets/dice-1502706_640 (4).jpg'
        ],
        [
            'name' => 'John Doe',
            'position' => 'Developer @ XYZ Corp',
            'rating' => 4,
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam tempor metus vel orci suscipit.',
            'image' => 'assets/dice-1502706_640 (4).jpg'
        ],
        // Add more testimonials as needed
    ];

    $galleries = [
        [
            'image' => 'assets/dice-1502706_640 (4).jpg',
            'title' => "Teacher's Day, 2016",
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam tempor metus vel orci suscipit.',
        ],
        [
            'image' => 'assets/65-500x300.jpg',
            'title' => "Children's Day, 2016",
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam tempor metus vel orci suscipit.',
        ],
        [
            'image' => 'assets/184-500x300.jpg',
            'title' => "Teacher's Day, 2016",
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam tempor metus vel orci suscipit.',
        ],
        [
            'image' => 'assets/591-500x300.jpg',
            'title' => "Opening Day, 2016",
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam tempor metus vel orci suscipit.',
        ],
        [
            'image' => 'assets/dice-1502706_640 (4).jpg',
            'title' => "Teacher's Day, 2016",
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam tempor metus vel orci suscipit.',
        ],
        [
            'image' => 'assets/65-500x300.jpg',
            'title' => "Children's Day, 2016",
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam tempor metus vel orci suscipit.',
        ],
        [
            'image' => 'assets/184-500x300.jpg',
            'title' => "Teacher's Day, 2016",
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam tempor metus vel orci suscipit.',
        ],
        [
            'image' => 'assets/591-500x300.jpg',
            'title' => "Opening Day, 2016",
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam tempor metus vel orci suscipit.',
        ],
    ]
@endphp

<style>
.track:hover {
    animation-play-state: paused;
 }
</style>

<div>
    <img src="{{asset('assets/images/home/background1.png')}}" alt="" class="h-screen w-screen object-cover">
    <div class="mt-[75px] flex flex-col gap-[35px]">
        @include('components.topicTitle', ['heading' => 'Certified By'])
        <div class="h-[85px] flex gap-[30px] justify-center items-center">
                <img class="object-contain h-[85px]" src="{{asset('assets/images/certified/iso-certified.png')}}" alt="">
                <img class="object-contain h-[85px]" src="{{asset('assets/images/certified/BiharGovernment.png')}}" alt="">
                <img class="object-contain h-[85px]" src="{{asset('assets/images/certified/png-clipart.png')}}" alt="">
                <img class="object-contain h-[85px]" src="{{asset('assets/images/certified/png-clipart-skill.png')}}" alt="">
                <img class="object-contain h-[85px]" src="{{asset('assets/images/certified/hep.png')}}" alt="">
                <img class="object-contain h-[85px]" src="{{asset('assets/images/certified/microsoft.png')}}" alt="">
        </div>
    </div>
    <div class="mt-[75px] flex flex-col gap-[35px]">
        @include('components.topicTitle', ['heading' => 'Courses We Offer'])
        <div class="h-[230px] flex gap-[30px] justify-center items-center">
            @foreach ($courses as $course)
                <div class="w-[210px] bg-white rounded-[10px] shadow-md h-[230px]">
                    <img src="{{asset($course['image'])}}" alt="Random Image" class="w-full h-[170px] object-cover rounded-t-[10px] ">
                    <div class="p-2 bg-grayD9 rounded-b-[10px] h-[60px]">
                        <div class="text-[14px] font-HellixB">{{$course['title']}}</div>
                        <div class="text-[10px] font-HellixR text-gray-600">{{$course['description']}}</div>
                    </div>
                </div>
            @endforeach    
        </div>
    </div>
    <div class="mt-[75px] flex flex-col gap-[35px]">
        @include('components.topicTitle', ['heading' => 'Testimonials / Feedback'])

        <div class="relative overflow-hidden h-[115px]">
            <div class="flex gap-[30px] items-center absolute will-change-transform animate-marquee track">
                @foreach ($testimonials as $testimonial)
                    <div class="w-[425px] h-[115px] bg-gray-300 rounded-[10px] shadow-md flex items-center gap-4 mb-4">
                        <img src="{{ asset($testimonial['image']) }}" alt="User Image" class="w-[100px] h-[115px] object-cover rounded-[10px]">
            
                        <div class="flex flex-col justify-center">
                            <div class="flex gap-2 items-center mb-1">
                                <div class="text-[14px] font-HellixB">{{ $testimonial['name'] }}</div>
                                <div class="text-[10px] font-HellixR">{{ $testimonial['position'] }}</div>
                            </div>
            
                            <div class="flex items-center mb-2">
                                @for ($i = 0; $i < 5; $i++)
                                    @if ($i < $testimonial['rating'])
                                        <img src="{{ asset('assets/icons/star-filled.svg') }}" class="w-4 h-4" alt="">
                                    @else
                                        <img src="{{ asset('assets/icons/star-outline.svg') }}" class="w-4 h-4" alt="">
                                    @endif
                                @endfor
                            </div>
            
                            <p class="text-[12px] font-HellixR">
                                {{ Str::limit($testimonial['description'], 90, '...') }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="mt-[75px] flex flex-col gap-[35px]">
        @include('components.topicTitle', ['heading' => 'Gallery'])
        <div class="h-[285px] flex justify-center items-center">
            <div class="owl-carousel owl-galary owl-theme">
                @foreach ($galleries as $gallery)
                    <div class="min-w-[300px] h-[250px] snap-center flex items-center justify-center relative group/item">
                        <img src="{{ asset($gallery['image']) }}" alt="Image 1" class="object-cover rounded-[10px] h-[250px]">
                        <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col gap-[10px] px-[10px] justify-center rounded-[10px] items-center opacity-0 group-hover/item:opacity-100 transition-all">
                            <h2 class="text-white text-2xl font-bold font-HellixSB">{{$gallery['title']}}</h2>
                            <p class="text-white font-HellixR text-center">{{ Str::limit($gallery['description'], 90, '...') }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
