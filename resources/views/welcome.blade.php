<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ isset($pageTitle) ? $pageTitle : 'Institute of ABC' }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    @vite('resources/css/app.css')

    <!-- Fonts -->
    <style>
        @layer base {
            @font-face {
                font-family: 'Hellix-Black';
                src: url("{{ asset('assets/fonts/Hellix-Black.woff2') }}") format('woff2'),
                    url("{{ asset('assets/fonts/Hellix-Black.woff') }}") format('woff');
            }

            @font-face {
                font-family: 'Hellix-Bold';
                src: url("{{ asset('assets/fonts/Hellix-Bold.woff2') }}") format('woff2'),
                    url("{{ asset('assets/fonts/Hellix-Bold.woff') }}") format('woff');
            }

            @font-face {
                font-family: 'Hellix-ExtraBold';
                ;
                src: url("{{ asset('assets/fonts/Hellix-ExtraBold.woff2') }}") format('woff2'),
                    url("{{ asset('assets/fonts/Hellix-ExtraBold.woff') }}") format('woff');
            }

            @font-face {
                font-family: 'Hellix-Light';
                src: url("{{ asset('assets/fonts/Hellix-Light.woff2') }}") format('woff2'),
                    url("{{ asset('assets/fonts/Hellix-Light.woff') }}") format('woff');
            }

            @font-face {
                font-family: 'Hellix-Medium';
                src: url("{{ asset('assets/fonts/Hellix-Medium.woff2') }}") format('woff2'),
                    url("{{ asset('assets/fonts/Hellix-Medium.woff') }}") format('woff');
            }

            @font-face {
                font-family: 'Hellix-Regular';
                src: url("{{ asset('assets/fonts/Hellix-Regular.woff2') }}") format('woff2'),
                    url("{{ asset('assets/fonts/Hellix-Regular.woff') }}") format('woff');
            }

            @font-face {
                font-family: 'Hellix-SemiBold';
                src: url("{{ asset('assets/fonts/Hellix-SemiBold.woff2') }}") format('woff2'),
                    url("{{ asset('assets/fonts/Hellix-SemiBold.woff') }}") format('woff');
            }

            @font-face {
                font-family: 'Hellix-Thin';
                src: url("{{ asset('assets/fonts/Hellix-Thin.woff2') }}") format('woff2'),
                    url("{{ asset('assets/fonts/Hellix-Thin.woff') }}") format('woff');
            }

        }
    </style>
    <link rel="stylesheet" href="{{asset('assets/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/owl.theme.default.min.css')}}">

    <!-- Template Stylesheet -->
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
</head>

<body class="">

    @include('layout.header')

    <div class="!mt-[124px]">
        @if (@isset($component))
            @include($component)
        @endif
    </div>

    @include('layout.footer')

    <!-- Template Javascript -->
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{ asset('assets/js/owl.carousel.min.js')}}"></script>


    <script>
        $('.owl-galary').owlCarousel({
            items:4,
            loop:true,
            margin:10,
            autoplay:true,
            autoplayTimeout:1000,
            autoplayHoverPause:true,
        })
    </script>
</body>

</html>
