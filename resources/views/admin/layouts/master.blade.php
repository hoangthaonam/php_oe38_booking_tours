<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>@yield('title')</title>
    <link href="{{ mix('css/admin.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ mix('css/chart.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ mix('fonts/font-awe.css')}}" rel="stylesheet">
    <base href="{{ asset('') }}">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('admin.layouts.menu')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('admin.layouts.header')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- /.container-fluid -->
            </div>

    @include('admin.layouts.footer')
    <script type="text/javascript" src="{{ mix('js/admin.js')}}"></script>
    <script type="text/javascript" src="{{ mix('js/jquery-3.5.1.min.js')}}"></script>
    <script type="text/javascript" src="{{ mix('js/pusher.min.js')}}"></script>
    <script type="text/javascript" src="{{ mix('js/notification.js')}}"></script>
    <script type="text/javascript" src="{{ mix('js/accessibility.js')}}"></script>
    <script type="text/javascript" src="{{ mix('js/export-data.js')}}"></script>
    <script type="text/javascript" src="{{ mix('js/exporting.js')}}"></script>
    <script type="text/javascript" src="{{ mix('js/highcharts.js')}}"></script>
    <script type="text/javascript" src="{{ mix('js/chart-by-month.js')}}"></script>
    <script type="text/javascript" src="{{ mix('js/chart-by-year.js')}}"></script>

</body>

</html>
