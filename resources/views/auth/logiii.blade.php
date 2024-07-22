<!doctype html>
<html lang="en" dir="ltr">

<head>

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Ayushman">
    <meta name="author" content="Ayushman">
    <meta name="keywords" content="Ayushman">

    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/images/brand/favicon.png')}}" />

    <!-- TITLE -->
    <title>Ayushman Ayurveda -Admin Login</title>

    <!-- BOOTSTRAP CSS -->
    <link href="{{asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" />

    <!-- STYLE CSS -->

    <link href="{{asset('assets/css/skin-modes.css')}}" rel="stylesheet" />

    <!-- SIDE-MENU CSS -->
    <link href="{{asset('assets/plugins/sidemenu/closed-sidemenu.css')}}" rel="stylesheet">

    <!-- SINGLE-PAGE CSS -->
    <link href="{{asset('assets/plugins/single-page/css/main.css')}}" rel="stylesheet" type="text/css">

    <!-- NOTIFICATION CSS -->
    <link href="{{asset('assets/plugins/notify/css/jquery.growl.css')}}" rel="stylesheet" />

    <!--C3 CHARTS CSS -->
    <link href="{{asset('assets/plugins/charts-c3/c3-chart.css')}}" rel="stylesheet" />

    <!-- CUSTOM SCROLL BAR CSS-->
    <link href="{{asset('assets/plugins/scroll-bar/jquery.mCustomScrollbar.css')}}" rel="stylesheet" />

    <!--- FONT-ICONS CSS -->
    <link href="{{asset('assets/css/icons.css')}}" rel="stylesheet" />

    <!--SWEET ALERT CSS-->
    <link href="{{asset('assets/plugins/sweet-alert/sweetalert.css')}}" rel="stylesheet" />

    <!-- COLOR SKIN CSS -->
    <link id="theme" rel="stylesheet" type="text/css" media="all" href="{{asset('assets/colors/color1.css')}}" />
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" />

</head>

<body>

    <!-- BACKGROUND-IMAGE -->
    <div class="login-img">

        <!-- GLOABAL LOADER -->
        <div id="global-loader">
            <img src="{{asset('assets/images/loader.svg')}}" class="loader-img" alt="Loader">
        </div>
        <!-- /GLOABAL LOADER -->

        <!-- PAGE -->
        <div class="page">
            <div class="">
                <!-- CONTAINER OPEN -->
                <div class="col col-login mx-auto">
                    <div class="text-center">
                        <img src="{{asset('assets/images/zimpleq-logo.png')}}" class="header-brand-img" alt="">
                    </div>
                </div>
                <div class="container-login100">
                    <div class="wrap-login100 p-6">
                        <div class="status">
                            @if(Session::has('status'))
                            <div class="alert alert-success">
                                {{ Session::get('status')}}
                            </div>
                            @endif
                        </div>
                        <form class="login100-form validate-form" method="post" action="{{route('post_login')}}">
                            {{ csrf_field() }}
                            <span class="login100-form-title">
                                Login
                            </span>
                            <div class="wrap-input100 validate-input">
                                <input class="input100" type="text" name="username" placeholder="Username" required value="{{old('username')}}">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="zmdi zmdi-email" aria-hidden="true"></i>
                                </span>
                                <div class="email">
                                    @if ($errors->has('username'))
                                    <span class="text-danger errbk">{{ $errors->first('username') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="wrap-input100 validate-input" data-validate="Password is required">
                                <input class="input100" type="password" name="password" id="password" placeholder="Password" required>
                                <i class="fa fa-eye password-eye" id="eye" onclick="togglePassword()" style="position: absolute; top: 18px; right:15px; color:#ff6778"></i>
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="zmdi zmdi-lock" aria-hidden="true"></i>
                                </span>
                                <div class="password">
                                    @if ($errors->has('password'))
                                    <span class="text-danger errbk">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group mt-4 mb-4">
                                <div class="captcha">
                                    <span id="captcha-image">{!! captcha_img() !!}</span>
                                    <button type="button" class="btn btn-danger" class="reload" id="reload">
                                        &#x21bb;
                                    </button>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <input id="captcha" type="text" class="form-control" placeholder="Enter Captcha" name="captcha" required>
                                <div class="captcha">
                                    @if ($errors->has('captcha'))
                                    <span class="text-danger errbk">{{ $errors->first('captcha') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="text-right pt-1">
                                <p class="mb-0"><a href="{{route('password.request')}}" class="text-primary ml-1">Forgot password?</a></p>
                            </div>
                            <div class="container-login100-form-btn">
                                <button type="submit" class="login100-form-btn btn-primary">Login</button>
                            </div>
                            <!-- <div class="text-center pt-3">
                                <p class="text-dark mb-0">Not a member?<a href="register.html" class="text-primary ml-1">Sign UP now</a></p>
                            </div> -->
                        </form>
                    </div>
                </div>
                <!-- CONTAINER CLOSED -->
            </div>
        </div>
        <!-- End PAGE -->

    </div>
    <!-- BACKGROUND-IMAGE CLOSED -->

    <!-- JQUERY JS -->
    <script src="{{asset('assets/js/jquery-3.4.1.min.js')}}"></script>

    <!-- BOOTSTRAP JS -->
    <script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap/js/popper.min.js')}}"></script>

    <!-- SPARKLINE JS -->
    <script src="{{asset('assets/js/jquery.sparkline.min.js')}}"></script>

    <!-- CHART-CIRCLE JS -->
    <script src="{{asset('assets/js/circle-progress.min.js')}}"></script>

    <!-- NOTIFICATIONS JS -->
    <script src="{{asset('assets/plugins/notify/js/rainbow.js')}}"></script>
    <script src="{{asset('assets/plugins/notify/js/sample.js')}}"></script>
    <script src="{{asset('assets/plugins/notify/js/jquery.growl.js')}}"></script>

    <!-- RATING STAR JS -->
    <script src="{{asset('assets/plugins/rating/jquery.rating-stars.js')}}"></script>

    <!-- INPUT MASK JS -->
    <script src="{{asset('assets/plugins/input-mask/jquery.mask.min.js')}}"></script>

    <!-- SWEET-ALERT JS -->
    <script src="{{asset('assets/plugins/sweet-alert/sweetalert.min.js')}}"></script>
    <script src="{{asset('assets/js/sweet-alert.js')}}"></script>

    <!-- CUSTOM SCROLL BAR JS-->
    <script src="{{asset('assets/plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js')}}"></script>

    <!-- CUSTOM JS-->
    <script src="{{asset('assets/js/custom.js')}}"></script>

    @include('admin.common.message')
    @include('admin.common.sweat-alert')
    <script>
        $("document").ready(function() {
            setTimeout(function() {
                $(".status").remove();
            }, 5000); // 5 secs

        });

        function togglePassword() {
            const passwordInput = document.querySelector("#password");
            $("#eye").toggleClass("fa-eye-slash");
            const type = passwordInput.getAttribute("type") === "password" ? "text" : "password"
            passwordInput.setAttribute("type", type)
        }

        $('#reload').click(function() {
            $.ajax({
                type: 'GET',
                url: 'reload-captcha',
                success: function(data) {
                    $("#captcha-image").html(data.captcha);
                }
            });
        });
    </script>

</body>

</html>