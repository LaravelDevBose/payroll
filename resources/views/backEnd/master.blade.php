<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('public/favicon.ico')}}" type="image/x-icon" />
    <title> @yield('title')</title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/backEnd/css/icons/icomoon/styles.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/backEnd/css/bootstrap.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/backEnd/css/core.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/backEnd/css/components.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/backEnd/css/colors.css')}}" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script type="text/javascript" src="{{ asset('public/backEnd/js/plugins/loaders/pace.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('public/backEnd/js/core/libraries/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('public/backEnd/js/core/libraries/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('public/backEnd/js/plugins/loaders/blockui.min.js')}}"></script>
    
    <script type="text/javascript" src="{{ asset('public/backEnd/js/plugins/notifications/pnotify.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('public/backEnd/js/plugins/notifications/noty.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('public/backEnd/js/plugins/notifications/jgrowl.min.js')}}"></script>
    
    <!-- /core JS files -->

    <!-- Theme JS files -->
    @yield('assetlink')
    <!-- /theme JS files -->
    <script type="text/javascript" src="{{ asset('public/backEnd/js/pages/components_notifications_other.js')}}"></script>

</head>

<body class="navbar-top  has-detached-left sidebar-xs">

    <!-- Main navbar -->
    @include('backEnd.includes.navBarContent')
    <!-- /main navbar -->


    <!-- Page container -->
    <div class="page-container">

        <!-- Page content -->
        <div class="page-content">

            <!-- Main sidebar -->
            @include('backEnd.includes.sidebarContent')
            <!-- /main sidebar -->


            <!-- Main content -->
            <div class="content-wrapper">

                <!-- Page header -->
                @include('backEnd.includes.pageHeaderContent')
                <!-- /page header -->

                <!-- Body Area -->
                <div class="content">

                    <!-- Content area -->

                    @yield('content')

                    <!-- /content area -->

                    <!-- Footer -->
                    @include('backEnd.includes.footerContent')
                    <!-- /footer -->

                </div>
                <!-- Body Area -->

            </div>
            <!-- /main content -->

        </div>
        <!-- /page content -->

    </div>
    <!-- /page container -->

</body>
</html>
