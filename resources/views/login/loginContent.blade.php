<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin-Login</title>

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
    <!-- /core JS files -->

    <!-- Footer Asset link -->
    <script type="text/javascript" src="{{ asset('public/backEnd/js/plugins/forms/validation/validate.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('public/backEnd/js/pages/login_validation.js')}}"></script>
    <!-- Footer Asset link -->


</head>

<body class="login-container login-cover">

    <!-- Page container -->
    <div class="page-container">

        <!-- Page content -->
        <div class="page-content">

            <!-- Main content -->
            <div class="content-wrapper">

                <!-- Content area -->
                <div class="content pb-20">

                    <!-- Form with validation -->
                    
                    <form class="form-validate" role="form" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <div class="panel panel-body login-form">
                            <div class="text-center">
                                <div class="icon-object border-slate-300 text-slate-300"><i class="icon-reading"></i></div>
                                <h5 class="content-group">Login to your account <small class="display-block">Your credentials</small></h5>
                            </div>
                            

                            <div class="form-group has-feedback has-feedback-left">
                                <input type="text" class="form-control" placeholder="User Name Or Email" name="identity" required="required">
                                <div class="form-control-feedback">
                                    <i class="icon-mention text-muted"></i>
                                </div>
                                @if ($errors->has('identity'))
                                    <span class="help-block">
                                        <strong class="text-danger text-bold">{{ $errors->first('identity') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group has-feedback has-feedback-left ">
                                <input type="password" class="form-control" placeholder="Password" name="password" required="required">
                                <div class="form-control-feedback">
                                    <i class="icon-lock2 text-muted"></i>
                                </div>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong class="text-danger text-bold">{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            

                            <div class="form-group login-options">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" class="styled" checked="checked" value="remember">
                                            Remember
                                        </label>
                                    </div>

                                    <div class="col-sm-6 text-right">
                                        <a href="{{ route('password.request') }}">Forgot password?</a>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn bg-blue btn-block">Login <i class="icon-arrow-right14 position-right"></i></button>
                            </div>
                        </div>
                    </form>
                    <!-- /form with validation -->

                </div>
                <!-- /content area -->
                <p>Email:-admin@gmail.com </p>
                <p>Pass:- 123456 </p>
            </div>
            <!-- /main content -->

        </div>
        <!-- /page content -->

    </div>
    <!-- /page container -->

</body>
</html>
