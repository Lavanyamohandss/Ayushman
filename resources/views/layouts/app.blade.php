<!doctype html>
<html lang="en" dir="ltr">

<head>
    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Admin">
    <meta name="author" content="Ayushman Ayurveda">
    <meta name="keywords" content="Ayushman Ayurveda">

    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/images/ayushman-logo.jpeg')}}" />

    <!-- TITLE -->
    <title>Ayushman Ayurveda - </title>
     <!-- DATA TABLE CSS --> 
		<link href="{{('assets/plugins/datatable/dataTables.bootstrap4.min.css" rel="stylesheet')}}"/>
    <!-- BOOTSTRAP CSS -->
    <link href="{{asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" />

    <!-- STYLE CSS -->
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/css/skin-modes.css')}}" rel="stylesheet" />

    <!-- SIDE-MENU CSS -->
    <link href="{{asset('assets/plugins/sidemenu/closed-sidemenu.css')}}" rel="stylesheet">

    <!--C3 CHARTS CSS -->
    <link href="{{asset('assets/plugins/charts-c3/c3-chart.css')}}" rel="stylesheet" />

    <!-- CUSTOM SCROLL BAR CSS-->
    <link href="{{asset('assets/plugins/scroll-bar/jquery.mCustomScrollbar.css')}}" rel="stylesheet" />

    <!-- NOTIFICATION CSS -->
    <link href="{{asset('assets/plugins/notify/css/jquery.growl.css')}}" rel="stylesheet" />

    <link href="{{asset('assets/plugins/single-page/css/main.css')}}" rel="stylesheet" type="text/css">

    <!--SWEET ALERT CSS-->
    <link href="{{asset('assets/plugins/sweet-alert/sweetalert.css')}}" rel="stylesheet" />

    <!--- FONT-ICONS CSS -->
    <link href="{{asset('assets/css/icons.css')}}" rel="stylesheet" />

    <!-- SIDEBAR CSS -->
    <link href="{{asset('assets/plugins/sidebar/sidebar.css')}}" rel="stylesheet">

    <!-- COLOR SKIN CSS -->
    <link id="theme" rel="stylesheet" type="text/css" media="all" href="{{asset('assets/colors/color1.css')}}" />

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
       <!-- ckeditor  -->
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script src="https://cdn.ckeditor.com/4.16.2/standard/adapters/jquery.js"></script>

    <!-- multiple select dropdown -->
    <link href="{{asset('assets/plugins/multipleselect/multiple-select.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/plugins/select2/select2.min.css')}}" rel="stylesheet"/>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>


   
    {{-- <link href="{{asset('assets/plugins/select2/select2.full.min.js')}}" rel="stylesheet" />
    <link href="{{asset('assets/plugins/select2/select2.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/plugins/multipleselect/multi-select.js')}}" rel="stylesheet" />
    <link href="{{asset('assets/plugins/multipleselect/multiple-select.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/plugins/multipleselect/multiple-select.js')}}" rel="stylesheet" /> --}}
    @yield('css')
   
</head>

<body class="app sidebar-mini">

    <!-- GLOBAL-LOADER -->
    <div id="global-loader">
        <img src="{{asset('assets/images/loader.svg')}}" class="loader-img" alt="Loader">
    </div>
    <!-- /GLOBAL-LOADER -->

    <!-- PAGE -->
    <div id="app" class="page">
        <div class="page-main">

            <!-- side menu starts -->
            @include('layouts.side-menu')
            <!-- side menu ends -->

            <!-- Mobile Header -->
            @include('layouts.mobile-header')
            <!-- /Mobile Header -->

            <!--app-content open-->
            <div class="app-content">
                <img src="{{asset('assets/images/login-bg.jpg')}}" class="zero-op">
                <div class="side-app">

                    <!-- PAGE-HEADER -->
                    @include('layouts.header')
                    <!-- PAGE-HEADER END -->

                   

                    <!-- content starts -->
                    @yield('content')
                    <!-- content ends -->
                </div>
            </div>
            <!-- CONTAINER END -->
        </div>

        <!-- FOOTER -->
        @include('layouts.footer')
        <!-- FOOTER END -->
    </div>

    
    <!-- BACK-TO-TOP -->
    <a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>

    <!-- JQUERY JS -->
    <script src="{{asset('assets/js/jquery-3.4.1.min.js')}}"></script>

    <!-- BOOTSTRAP JS -->
    <script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap/js/popper.min.js')}}"></script>

    <!-- SPARKLINE JS-->
    <script src="{{asset('assets/js/jquery.sparkline.min.js')}}"></script>

    <!-- CHART-CIRCLE JS-->
    <script src="{{asset('assets/js/circle-progress.min.js')}}"></script>

    <!-- RATING STARJS -->
    <script src="{{asset('assets/plugins/rating/jquery.rating-stars.js')}}"></script>

    <!-- CHARTJS CHART JS-->
    <script src="{{asset('assets/plugins/chart/Chart.bundle.js')}}"></script>
    <script src="{{asset('assets/plugins/chart/utils.js')}}"></script>

    <!-- PIETY CHART JS-->
    <script src="{{asset('assets/plugins/peitychart/jquery.peity.min.js')}}"></script>
    <script src="{{asset('assets/plugins/peitychart/peitychart.init.js')}}"></script>

    <!-- ECHART JS-->
    <script src="{{asset('assets/plugins/echarts/echarts.js')}}"></script>

    <!-- SIDE-MENU JS-->
    <script src="{{asset('assets/plugins/sidemenu/sidemenu.js')}}"></script>

    <!-- CUSTOM SCROLLBAR JS-->
    <script src="{{asset('assets/plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js')}}"></script>

    <!-- NOTIFICATIONS JS -->
    <script src="{{asset('assets/plugins/notify/js/rainbow.js')}}"></script>
    <script src="{{asset('assets/plugins/notify/js/sample.js')}}"></script>
    <script src="{{asset('assets/plugins/notify/js/jquery.growl.js')}}"></script>

    <!-- SIDEBAR JS -->
    <script src="{{asset('assets/plugins/sidebar/sidebar.js')}}"></script>

    <!-- APEXCHART JS -->
    <script src="{{asset('assets/js/apexcharts.js')}}"></script>

    <!-- INDEX JS -->
    <script src="{{asset('assets/js/index1.js')}}"></script>

    <script src="{{asset('assets/js/index5.js')}}"></script>

    <!-- SWEET-ALERT JS -->
    <script src="{{asset('assets/plugins/sweet-alert/sweetalert.min.js')}}"></script>
    <script src="{{asset('assets/js/sweet-alert.js')}}"></script>

        <script src="{{asset('assets/plugins/datatable/jquery.dataTables.min.js')}}"></script>
		<script src="{{asset('assets/plugins/datatable/dataTables.bootstrap4.min.js')}}"></script>
		<script src="{{asset('assets/plugins/datatable/datatable.js')}}"></script>
		<script src="{{asset('assets/plugins/datatable/datatable-2.js')}}"></script>
		<script src="{{asset('assets/plugins/datatable/dataTables.responsive.min.js')}}"></script>
    <!-- CUSTOM JS -->
    <script src="{{asset('assets/js/custom.js')}}"></script>

    <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
    {{--@include('admin.common.message')--}}
    <script src="{{asset('assets/plugins/multipleselect/multiple-select.js')}}"></script>
    <script src="{{asset('assets/plugins/multipleselect/multi-select.js')}}"></script>


    <script>
        $(document).on("click", 'a.frmsubmit', function(e) {
            var message = '';
            if (e.currentTarget.attributes.message != undefined) {
                message = e.currentTarget.attributes.message.value;
            } else {
                message = 'Are you sure you want to delete?';
            }
            if (message != 'false') {
                swal({
                        title: "Alert",
                        text: message,
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonText: 'Ok',
                        cancelButtonText: 'Cancel',
                    },
                    function() {
                        e.preventDefault();
                        var myForm = '<form id="hidfrm" action="' + e.currentTarget.attributes.href.value + '" method="post">{{@csrf_field()}}<input type="hidden" name="_method" value="' + e.currentTarget.attributes.method.value + '"></form>';
                        $('body').append(myForm);
                        myForm = $('#hidfrm');
                        myForm.submit();
                    });

            } else {
                e.preventDefault();
                var myForm = '<form id="hidfrm" action="' + e.currentTarget.attributes.href.value + '" method="post">{{@csrf_field()}}<input type="hidden" name="_method" value="' + e.currentTarget.attributes.method.value + '"></form>';
                $('body').append(myForm);
                myForm = $('#hidfrm');
                myForm.submit();
            }
            return false;
        });
    </script>
    @yield('js')
</body>

</html>