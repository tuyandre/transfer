<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>

    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="description" content="Money Transfer">
    <meta name="author" content="Money Transfer">
    <meta name="keywords" content="Money Transfer">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('frontend/assets/img/favicons/favicon-32x32.png')}}">

    <!-- Title -->
    <title>@yield('title') | Transfer|DashBoard</title>

    <!-- Bootstrap css-->
    <link href="{{asset('dashboard/assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet"/>

    <!-- Icons css-->
    <link href="{{asset('dashboard/assets/plugins/web-fonts/icons.css')}}" rel="stylesheet"/>
    <link href="{{asset('dashboard/assets/plugins/web-fonts/font-awesome/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('dashboard/assets/plugins/web-fonts/plugin.css')}}" rel="stylesheet"/>

    <!-- Style css-->
    <link href="{{asset('dashboard/assets/css/style/style.css')}}" rel="stylesheet">
    <link href="{{asset('dashboard/assets/css/skins.css')}}" rel="stylesheet">
    <link href="{{asset('dashboard/assets/css/dark-style.css')}}" rel="stylesheet">
    <link href="{{asset('dashboard/assets/css/colors/default.css')}}" rel="stylesheet">

    <!-- Color css-->
    <link id="theme" rel="stylesheet" type="text/css" media="all" href="{{asset('dashboard/assets/css/colors/color.css')}}">

    <!-- Select2 css-->
    <link href="{{asset('dashboard/assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">

    <!-- Mutipleselect css-->
    <link rel="stylesheet" href="{{asset('dashboard/assets/plugins/multipleselect/multiple-select.css')}}">

    <!-- Sidemenu css-->
    <link href="{{asset('dashboard/assets/css/sidemenu/sidemenu.css')}}" rel="stylesheet">

    <!-- Switcher css-->
    <link href="{{asset('dashboard/assets/switcher/css/switcher.css')}}" rel="stylesheet">
    <link href="{{asset('dashboard/assets/switcher/demo.css')}}" rel="stylesheet">
    @yield('css')
</head>

<body class="main-body leftmenu">


<!-- Loader -->
<div id="global-loader">
    <img src="{{asset('dashboard/assets/img/loader.svg')}}" class="loader-img" alt="Loader">
</div>
<!-- End Loader -->

<!-- Page -->
<div class="page">

    @include('backend.includes.sidebar')
    @include('backend.includes.header')
    <!-- Main Content-->
        <div class="main-content side-content pt-0">
            <div class="container-fluid">
                <div class="inner-body">
                    <!-- Page Header -->
                    <div class="page-header">
                        <div>
                            <h2 class="main-content-title tx-24 mg-b-5">@yield('content_title')</h2>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">@yield('content_target')</li>
                            </ol>
                        </div>
                        <div class="d-flex">
                            <div class="justify-content-center">
                                @yield('action_buttons')
{{--                                <button type="button" class="btn btn-white btn-icon-text my-2 mr-2">--}}
{{--                                    <i class="fe fe-download mr-2"></i> Import--}}
{{--                                </button>--}}
{{--                                <button type="button" class="btn btn-white btn-icon-text my-2 mr-2">--}}
{{--                                    <i class="fe fe-filter mr-2"></i> Filter--}}
{{--                                </button>--}}
{{--                                <button type="button" class="btn btn-primary my-2 btn-icon-text">--}}
{{--                                    <i class="fe fe-download-cloud mr-2"></i> Download Report--}}
{{--                                </button>--}}
                            </div>
                        </div>
                    </div>
                    <!-- End Page Header -->

{{--                    <!--Row-->--}}
{{--                    <div class="row row-sm">--}}
{{--                        <div class="col-sm-12 col-lg-12 col-xl-8">--}}

                            @yield('contents')

{{--                        </div>--}}
{{--                    </div>--}}





                </div>
            </div>
        </div>


</div>








<!-- Back-to-top -->
<a href="#top" id="back-to-top"><i class="fe fe-arrow-up"></i></a>

<!-- Jquery js-->
<script src="{{asset('dashboard/assets/plugins/jquery/jquery.min.js')}}"></script>

<!-- Bootstrap js-->
<script src="{{asset('dashboard/assets/plugins/bootstrap/js/popper.min.js')}}"></script>
<script src="{{asset('dashboard/assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>

<!-- Select2 js-->
<script src="{{asset('dashboard/assets/plugins/select2/js/select2.min.js')}}"></script>

<!-- Perfect-scrollbar js -->
<script src="{{asset('dashboard/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>

<!-- Sidemenu js -->
<script src="{{asset('dashboard/assets/plugins/sidemenu/sidemenu.js')}}"></script>

<!-- Sidebar js -->
<script src="{{asset('dashboard/assets/plugins/sidebar/sidebar.js')}}"></script>

<!-- Internal Chart.Bundle js-->
<script src="{{asset('dashboard/assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>

<!-- Peity js-->
<script src="{{asset('dashboard/assets/plugins/peity/jquery.peity.min.js')}}"></script>

<!-- Internal Morris js -->
<script src="{{asset('dashboard/assets/plugins/raphael/raphael.min.js')}}"></script>
<script src="{{asset('dashboard/assets/plugins/morris.js/morris.min.js')}}"></script>

<!-- Circle Progress js-->
<script src="{{asset('dashboard/assets/js/circle-progress.min.js')}}"></script>
<script src="{{asset('dashboard/assets/js/chart-circle.js')}}"></script>

<!-- Internal Dashboard js-->
<script src="{{asset('dashboard/assets/js/index.js')}}"></script>

<!-- Sticky js -->
<script src="{{asset('dashboard/assets/js/sticky.js')}}"></script>

<!-- Custom js -->
<script src="{{asset('dashboard/assets/js/custom.js')}}"></script>

<!-- Switcher js -->
<script src="{{asset('dashboard/assets/switcher/js/switcher.js')}}"></script>
<script src="{{ asset('/parsleyjs/js/parsley.min.js') }}" ></script>
<script src="{{ asset('/js/bootbox.min.js') }}" ></script>
@yield('js')
</body>

<!-- Mirrored from laravel.spruko.com/spruha/ltr/index by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 15 Feb 2021 18:30:54 GMT -->
</html>
