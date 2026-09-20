<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ $getDir }}">

<head>
    <meta charset="utf-8">

    {{-- Responsive --}}
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Browser Compatibility --}}
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    {{-- CSRF --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- SEO --}}
    <title>@setting('site:name', config('app.name')), {{ $title }}</title>

    <meta name="description" content="{{ $description }}">

    <meta name="keywords" content="{{ $keywords }}">

    {{-- Robots --}}
    <meta name="robots" content="index, follow">

    {{-- Canonical --}}
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- Open Graph --}}
    <meta property="og:type" content="{{ $ogType }}">

    <meta property="og:title" content="{{ $title }}">

    <meta property="og:description" content="{{ $description }}">

    <meta property="og:image" content="{{ $image }}">

    <meta property="og:url" content="{{ url()->current() }}">

    <meta property="og:site_name" content="@setting('site:name', config('app.name'))">

    {{-- Twitter --}}
    <meta name="twitter:card" content="summary_large_image">

    <meta name="twitter:title" content="{{ $title }}">

    <meta name="twitter:description" content="{{ $description }}">

    <meta name="twitter:image" content="{{ $image }}">

    <meta name="author" content="Ali Mohamed">
    <meta name="copyright" content="2026 &copy; All rights reserved. Designed & Developed by Ali Mohamed">

    {{-- Favicon --}}
    <link rel="shortcut icon" href="@settingAsset('logo:favicon', 'default.png')" type="image/png">



    <!-- Stylesheets -->
    <link href="@asset('assets/css/bootstrap.css')" rel="stylesheet">
    <link href="@asset('assets/css/style.css')" rel="stylesheet">
    <link href="@asset('assets/css/meanmenu.min.css')" rel="stylesheet">
    <link href="@asset('assets/css/responsive.css')" rel="stylesheet">

    @if ($getDir === 'ar')
        <link href="assets/css/rtl.css" rel="stylesheet">
    @endif

    <link href="https://fonts.googleapis.com/css2?family=Russo+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Color Switcher Mockup -->
    <link href="@asset('assets/css/color-switcher-design.css')" rel="stylesheet">

    <!-- Color Themes -->
    <link id="theme-color-file" href="@asset('assets/css/color-themes/default-color.css')" rel="stylesheet">

</head>

<body>

    <div class="page-wrapper dark-layout">

        {{-- @include('layouts.loader') --}}

        <x-layouts.header />

        {{ $slot }}

        @include('layouts.footer')

    </div>



    {{-- JS --}}

    <script src="@asset('assets/js/jquery.js')"></script>
    <script src="@asset('assets/js/popper.min.js')"></script>
    <script src="@asset('assets/js/bootstrap.min.js')"></script>
    <script src="@asset('assets/js/appear.js')"></script>
    <script src="@asset('assets/js/parallax.min.js')"></script>
    <script src="@asset('assets/js/tilt.jquery.min.js')"></script>
    <script src="@asset('assets/js/jquery.paroller.min.js')"></script>
    <script src="@asset('assets/js/wow.js')"></script>
    <script src="@asset('assets/js/pagenav.js')"></script>
    <script src="@asset('assets/js/swiper.min.js')"></script>
    <script src="@asset('assets/js/backtotop.js')"></script>
    <script src="@asset('assets/js/odometer.js')"></script>
    <script src="@asset('assets/js/parallax-scroll.js')"></script>

    <script src="@asset('assets/js/gsap.min.js')"></script>
    <script src="@asset('assets/js/SplitText.min.js')"></script>
    <script src="@asset('assets/js/ScrollTrigger.min.js')"></script>
    <script src="@asset('assets/js/ScrollToPlugin.min.js')"></script>
    <script src="@asset('assets/js/ScrollSmoother.min.js')"></script>

    <script src="@asset('assets/js/jquery.marquee.min.js')"></script>
    <script src="@asset('assets/js/magnific-popup.min.js')"></script>
    <script src="@asset('assets/js/nav-tool.js')"></script>
    <script src="@asset('assets/js/jquery-ui.js')"></script>
    <script src="@asset('assets/js/element-in-view.js')"></script>
    <script src="@asset('assets/js/color-settings.js')"></script>
    <script src="@asset('assets/js/script.js')"></script>
</body>

</html>
