<!doctype html>
<html lang="en">
<!-- JQuery -->
<!-- JQuery -->
<!-- JQuery -->

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Booking tours - @yield('title')</title>
    <link href="{{ mix('css/client.css' )}}" rel="stylesheet">
    <link href="{{ mix('fonts/font-awe.css' )}}" rel="stylesheet">
    <base href="{{ asset('') }}">
</head>

<body>
    <!--header-->
    @include('client.layouts.header')
    <!-- //header -->
    {{-- @include('client.layouts.slide')
    <!-- /main-slider -->
    @include('client.layouts.tour')
    <!--//grids-->
    @include('client.layouts.hot_tour')
    <!-- //stats -->
    @include('client.layouts.review') --}}
    @yield('content')
    <!-- //testimonials -->
    @include('client.layouts.footer')
    <script type="text/javascript" src="{{ mix('js/client.js') }}"></script>
    <script type="text/javascript" src="{{ mix('js/myJS.js') }}"></script>
    <script type="text/javascript" src="{{ mix('js/jquery-3.5.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ mix('js/pusher.min.js')}}"></script>
    <script type="text/javascript" src="{{ mix('js/notification.js')}}"></script>
</body>


</html>
