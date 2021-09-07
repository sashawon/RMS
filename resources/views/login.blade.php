<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Login</title>

    <!-- Fontfaces CSS-->
    <link href="{{asset('assets/css/font-face.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('assets/vendor/font-awesome-4.7/css/font-awesome.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('assets/vendor/font-awesome-5/css/fontawesome-all.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('assets/vendor/mdi-font/css/material-design-iconic-font.min.css')}}" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="{{asset('assets/vendor/bootstrap-4.1/bootstrap.min.css')}}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{asset('assets/css/theme.css')}}" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                                <img src="{{asset('assets/images/icon/logo.png')}}" alt="RedSoft" />
                            </a>
                            <h2>Please Login</h2>
                            <!--<h2>{{Config::get('constants.site_name')}}</h2>-->
                        </div>
                        <div class="login-form">
                            <form action="{{route('auth')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label>Table User Details</label>
                                    <input class="au-input au-input--full" type="text" name="username" placeholder="Email/UserName" required="">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="au-input au-input--full" type="password" name="password" placeholder="Password" required="">
                                </div>
                                @if(session()->has('msg'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    {{session('msg')}}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                @endif
                                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">sign in</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Jquery -->
    <script src="{{asset('assets/vendor/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('assets/vendor/bootstrap-4.1/popper.min.js')}}"></script>
    <script src="{{asset('assets/vendor/bootstrap-4.1/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/vendor/wow/wow.min.js')}}"></script>
    <script src="{{asset('assets/js/main.js')}}"></script>

</body>

</html>
<!-- end document-->