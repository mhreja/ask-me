<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="description" content="Ask me Responsive Questions and Answers Template">
    <meta name="author" content="2code.info">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Main Style -->
    <link rel="stylesheet" href="{{asset('mhreja/assets/css/style.css')}}">

    <!-- Custom Style -->
    <link rel="stylesheet" href="{{asset('mhreja/assets/css/custom.css')}}">

    <!-- Skins -->
    <link rel="stylesheet" href="{{asset('mhreja/assets/css/skins/skins.css')}}">

    <!-- Responsive Style -->
    <link rel="stylesheet" href="{{asset('mhreja/assets/css/responsive.css')}}">

    <!-- Toasr -->
    <link rel="stylesheet" href="{{asset('mhreja/assets/css/toastr.css')}}">

    <!-- Favicons -->
    <link rel="shortcut icon" href="{{asset('mhreja/assets/images/favicon.png')}}">

    @livewireStyles
    @yield('head')


</head>

<body>
    {{-- <div class="loader">
        <div class="loader_html"></div>
    </div> --}}

    <div id="wrap" class="grid_1200">

        @include('frontend.inc.headertop')
        @include('frontend.inc.header')

        @yield('content')

        @include('frontend.inc.footer')

    </div>

    <div class="go-up" style="right: 10px !important;"><i class="icon-chevron-up"></i></div>

    <div class="panel-pop" id="myModal" style="margin-top: -156px; top: 50%; display: none;">
        <h2>Announcement<i class="icon-remove"></i></h2>
        <div class="form-style form-style-3">
            <p id="noticeContent"></p>
            <div class="clearfix"></div>
        </div>
    </div>

    <script src="{{asset('mhreja/assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('mhreja/assets/js/jquery-ui-1.10.3.custom.min.js')}}"></script>
    <script src="{{asset('mhreja/assets/js/jquery.easing.1.3.min.js')}}"></script>
    <script src="{{asset('mhreja/assets/js/html5.js')}}"></script>
    <script src="{{asset('mhreja/assets/js/jflickrfeed.min.js')}}"></script>
    <script src="{{asset('mhreja/assets/js/jquery.inview.min.js')}}"></script>
    <script src="{{asset('mhreja/assets/js/jquery.tipsy.js')}}"></script>
    <script src="{{asset('mhreja/assets/js/tabs.js')}}"></script>
    <script src="{{asset('mhreja/assets/js/jquery.flexslider.js')}}"></script>
    <script src="{{asset('mhreja/assets/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('mhreja/assets/js/jquery.carouFredSel-6.2.1-packed.js')}}"></script>
    <script src="{{asset('mhreja/assets/js/jquery.scrollTo.js')}}"></script>
    <script src="{{asset('mhreja/assets/js/jquery.nav.js')}}"></script>
    <script src="{{asset('mhreja/assets/js/tags.js')}}"></script>
    <script src="{{asset('mhreja/assets/js/jquery.bxslider.min.js')}}"></script>
    <script src="{{asset('mhreja/assets/js/custom.js')}}"></script>
    <script src="{{asset('mhreja/assets/js/sweetalert.js')}}"></script>
    <script src="{{asset('mhreja/assets/js/toastr.js')}}"></script>
    <script src="{{asset('mhreja/assets/js/jquery.autoscroll.js')}}"></script>


    <script src="{{asset('mhreja/assets/js/myjavascript.js')}}"></script>

    @livewireScripts
    @include('frontend.layouts.alerts')

    @yield('scripts')


</body>

</html>