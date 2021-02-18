<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="rtl">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('backend.layout.head')
</head>

<body class="vertical-layout vertical-menu-modern 2-columns  navbar-floating footer-static  @if(Auth::user()->dark_mode == 1) dark-layout @endif"
      data-open="click" data-menu="vertical-menu-modern" data-col="2-columns" data-layout="dark-layout">

<input type="hidden" value="{{URL::to('/')}}" id="base_url">
<!--Preloader-->
<div class="preloader-it">
    <div class="la-anim-1"></div>
</div>
<div class="wrapper theme-1-active pimary-color-red">
    <!-- Top Menu Items -->
@include('backend.layout.header')

<!-- Left Sidebar Menu -->
@include('backend.layout.navbar')
<!-- /Left Sidebar Menu -->

    <!-- Main Content -->
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                @section('backend-main')
                @show
            </div>
        </div>
    </div>
    <!-- /Main Content -->
    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>
    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light">
        <p class="clearfix blue-grey lighten-2 mb-0"><span class="float-md-left d-block d-md-inline-block mt-25">COPYRIGHT &copy; 2020<a
                        class="text-bold-800 grey darken-2" href="#"
                        target="_blank"></a>All rights Reserved</span><span
                    class="float-md-right d-none d-md-block">Hand-crafted & Made with<i
                        class="feather icon-heart pink"></i></span>
            <button class="btn btn-primary btn-icon scroll-top" type="button"><i class="feather icon-arrow-up"></i>
            </button>
        </p>
    </footer>
    <!-- END: Footer-->
</div>
<!-- /#wrapper -->
@if(Auth::user()->dark_mode == 0)
    <script>
        document.getElementById("light_btn").style.display = "none";
    </script>
@else
    <script>
        document.getElementById("dark_btn").style.display = "none";
    </script>
@endif
@include('backend.layout.footer')
</body>
</html>