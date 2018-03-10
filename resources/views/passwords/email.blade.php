<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forget Password</title>

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

    <!-- Theme JS files -->
    <script type="text/javascript" src="{{ asset('public/backEnd/js/core/app.js')}}"></script>
    <!-- /theme JS files -->

</head>

<body class="login-container">

    <!-- Main navbar -->
    <div class="navbar navbar-inverse">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ url('/') }}"><img src="{{asset('public/backEnd/images/logo_light.png')}}" alt=""></a>

            <ul class="nav navbar-nav pull-right visible-xs-block">
                <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
            </ul>
        </div>

        <div class="navbar-collapse collapse" id="navbar-mobile">
            <ul class="nav navbar-nav navbar-right">
            
                <li>
                    <a href="{{ route('login') }}">
                        <i class="icon-user-lock"></i> <span class="visible-xs-inline-block position-right">Login</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <!-- /main navbar -->


    <!-- Page container -->
    <div class="page-container">

        <!-- Page content -->
        <div class="page-content">

            <!-- Main content -->
            <div class="content-wrapper">

                <!-- Content area -->
                <div class="content">

                    <!-- Password recovery -->
                    <form  role="form" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}
                        <div class="panel panel-body login-form">
                            <div class="text-center">
                                <div class="icon-object border-warning text-warning"><i class="icon-spinner11"></i></div>
                                <h5 class="content-group">Password recovery <small class="display-block">We'll send you instructions in email</small></h5>
                                @if (Session::get('status'))
                                    <span class="help-block text-center text-success-600 text-bold">
                                        <strong>{{ Session::get('status') }}</strong>
                                    </span>
                                @endif

                                @if ($errors->has('email'))
                                    <span class="help-block text-center text-danger text-bold">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group has-feedback">
                                <input type="email" class="form-control" name="email" placeholder="Your email Address">
                                <div class="form-control-feedback">
                                    <i class="icon-mail5 text-muted"></i>
                                </div>
                            </div>

                            <button type="submit" class="btn bg-blue btn-block">Reset password <i class="icon-arrow-right14 position-right"></i></button>
                        </div>
                    </form>
                    <!-- /password recovery -->


                    <!-- Footer -->
                    @include('backEnd.includes.footerContent')
                    <!-- /footer -->

                </div>
                <!-- /content area -->

            </div>
            <!-- /main content -->

        </div>
        <!-- /page content -->

    </div>
    <!-- /page container -->

</body>
</html>

