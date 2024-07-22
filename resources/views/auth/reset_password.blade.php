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
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/ayushman-logo.jpeg') }}" />

    <!-- TITLE -->
    <title>Ayushman Ayurveda -Admin Login</title>

    <!-- BOOTSTRAP CSS -->
    <link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />

    <!-- STYLE CSS -->

    <link href="{{ asset('assets/css/skin-modes.css') }}" rel="stylesheet" />

    <!-- SIDE-MENU CSS -->
    <link href="{{ asset('assets/plugins/sidemenu/closed-sidemenu.css') }}" rel="stylesheet">

    <!-- SINGLE-PAGE CSS -->
    <link href="{{ asset('assets/plugins/single-page/css/main.css') }}" rel="stylesheet" type="text/css">

    <!-- NOTIFICATION CSS -->
    <link href="{{ asset('assets/plugins/notify/css/jquery.growl.css') }}" rel="stylesheet" />

    <!--C3 CHARTS CSS -->
    <link href="{{ asset('assets/plugins/charts-c3/c3-chart.css') }}" rel="stylesheet" />

    <!-- CUSTOM SCROLL BAR CSS-->
    <link href="{{ asset('assets/plugins/scroll-bar/jquery.mCustomScrollbar.css') }}" rel="stylesheet" />

    <!--- FONT-ICONS CSS -->
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet" />

    <!--SWEET ALERT CSS-->
    <link href="{{ asset('assets/plugins/sweet-alert/sweetalert.css') }}" rel="stylesheet" />

    <!-- COLOR SKIN CSS -->
    <link id="theme" rel="stylesheet" type="text/css" media="all" href="{{ asset('assets/colors/color1.css') }}" />
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />

</head>

<body>
    <!-- BACKGROUND-IMAGE -->
    <div class="login-img">

        <!-- GLOABAL LOADER -->
        <div id="global-loader">
            <img src="{{ asset('assets/images/loader.svg') }}" class="loader-img" alt="Loader">
        </div>
        <!-- /GLOABAL LOADER -->

        <!-- PAGE -->
        <div class="page">
            <div class="">
                <!-- CONTAINER OPEN -->
                <div class="col col-login mx-auto">
                    <div class="text-center">
                        <img src="{{ asset('assets/images/logo.png') }}" class="header-brand-img" alt="" width="100%">
                    </div>
                </div>
                <div class="container-login100">
                    <div class="wrap-login100 p-6 reset-p-6">
                        <div class="status">
                            @if (Session::has('status'))
                            <div class="alert alert-success">
                                {{ Session::get('status') }}
                            </div>
                            @endif
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header-home">Reset Password</div>

                                    <div class="card-home">
                                        @if (isset($verification))
                                        <div class="alert alert-danger">
                                            <ul>
                                                <li>{{ $verification }}</li>
                                            </ul>
                                        </div>
                                        @endif

                                        @if (isset($oldPsw))
                                        <div class="alert alert-danger">
                                            <ul>
                                                <li>{{ $oldPsw }}</li>
                                            </ul>
                                        </div>
                                        @endif

                                        @if (isset($error))
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($error->all() as $errorMessage)
                                                <li>{{ $errorMessage }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endif


                                        <form class="login100-form" method="POST" action="{{ route('password.update') }}">
                                            @csrf
                                            <div class="wrap-input100 validate-input">
                                                <input class="input100" type="text" name="user_email_address" placeholder="Email Address" required value="{{ old('user_email_address') }}">
                                                <span class="focus-input100"></span>
                                                <span class="symbol-input100">
                                                    <i class="zmdi zmdi-email" aria-hidden="true"></i>
                                                </span>
                                            </div>
                                            <div class="wrap-input100 validate-input" data-validate="Password is required">
                                                <input class="input100" type="password" name="password" id="password" placeholder="Password" required>
                                                <i class="fa fa-eye password-eye-slash" id="eye" onclick="togglePassword()" style="position: absolute; top: 18px; right:15px; color:#000"></i>
                                                <span class="focus-input100"></span>
                                                <span class="symbol-input100">
                                                    <i class="zmdi zmdi-lock" aria-hidden="true"></i>
                                                </span>
                                            </div>
                                            <div class="wrap-input100 validate-input" data-validate="Confirm Password is required">
                                                <input class="input100" type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required>
                                                <i class="fa fa-eye password-eye-slash" id="eyeConfirm" onclick="toggleConfirmPassword()" style="position: absolute; top: 18px; right:15px; color:#000"></i>
                                                <span class="focus-input100"></span>
                                                <span class="symbol-input100">
                                                    <i class="zmdi zmdi-lock" aria-hidden="true"></i>
                                                </span>
                                            </div>

                                            <div class="form-group row mb-0">
                                                <div class="container-login100-form-btn">
                                                    <button type="submit" class="login100-form-btn btn-primary">Reset Password</button>
                                                </div>
                                            </div>
                                            <div class="form-group row mt-2 mb-0">
                                                <div class="container-login100-form-btn">
                                                    <a href="{{ route('verification.request') }}" class="btn-link">Back to email verification</a>
                                                </div>
                                            </div>

                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- CONTAINER CLOSED -->
        </div>
    </div>
    <!-- End PAGE -->

    </div>
    <!-- BACKGROUND-IMAGE CLOSED -->

    <!-- JQUERY JS -->
    <script src="{{ asset('assets/js/jquery-3.4.1.min.js') }}"></script>

    <!-- BOOTSTRAP JS -->
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/popper.min.js') }}"></script>

    <!-- SPARKLINE JS -->
    <script src="{{ asset('assets/js/jquery.sparkline.min.js') }}"></script>

    <!-- CHART-CIRCLE JS -->
    <script src="{{ asset('assets/js/circle-progress.min.js') }}"></script>

    <!-- NOTIFICATIONS JS -->
    <script src="{{ asset('assets/plugins/notify/js/rainbow.js') }}"></script>
    <script src="{{ asset('assets/plugins/notify/js/sample.js') }}"></script>
    <script src="{{ asset('assets/plugins/notify/js/jquery.growl.js') }}"></script>

    <!-- RATING STAR JS -->
    <script src="{{ asset('assets/plugins/rating/jquery.rating-stars.js') }}"></script>

    <!-- INPUT MASK JS -->
    <script src="{{ asset('assets/plugins/input-mask/jquery.mask.min.js') }}"></script>

    <!-- SWEET-ALERT JS -->
    <script src="{{ asset('assets/plugins/sweet-alert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/js/sweet-alert.js') }}"></script>

    <!-- CUSTOM SCROLL BAR JS-->
    <script src="{{ asset('assets/plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js') }}"></script>

    <!-- CUSTOM JS-->
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    {{-- @include('admin.common.message')
    @include('admin.common.sweat-alert') --}}
    <script>
        $("document").ready(function() {
            setTimeout(function() {
                $(".status").remove();
            }, 5000); // 5 secs

        });

        function togglePassword() {
            const passwordInput = document.querySelector("#password");

            if (passwordInput.getAttribute("type") == "text") {
                $("#eye").removeClass("fa-eye");
                $("#eye").addClass("fa-eye-slash");

            } else {
                $("#eye").removeClass("fa-eye-slash");
                $("#eye").addClass("fa-eye");

            }

            const type = passwordInput.getAttribute("type") === "text" ? "password" : "text"
            passwordInput.setAttribute("type", type)
        }
        
        function toggleConfirmPassword() {
            const confirmPasswordInput = document.querySelector("#confirm_password");

            if (confirmPasswordInput.getAttribute("type") == "text") {
                $("#eyeConfirm").removeClass("fa-eye");
                $("#eyeConfirm").addClass("fa-eye-slash");

            } else {
                $("#eyeConfirm").removeClass("fa-eye-slash");
                $("#eyeConfirm").addClass("fa-eye");

            }

            const type = confirmPasswordInput.getAttribute("type") === "text" ? "password" : "text"
            confirmPasswordInput.setAttribute("type", type)
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