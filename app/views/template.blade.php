<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="UTF-8">
    <title>
        @section('title')
            Roanoke College | StatsOnStats
        @show
    </title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- global styles-->
    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/components.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/custom.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/skins/black_skin.css')}}" />
<link type="text/css" rel="stylesheet" href="{{asset('assets/css/pages/new_dashboard.css')}}"/>
<link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/c3/css/c3.min.css')}}"/>
<link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/toastr/css/toastr.min.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/switchery/css/switchery.min.css')}}"/>

    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/pages/advanced_components.css')}}"/>

    <style>
      .row {
        margin-bottom: 20px;
      }
    </style>
    <!-- end of global styles-->
    @yield('header_styles')
</head>

<body>
<!--</div>-->
<div class="preloader" style=" position: fixed;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  z-index: 100000;
  backface-visibility: hidden;
  background: #ffffff;">
    <div class="preloader_img" style="width: 200px;
  height: 200px;
  position: absolute;
  left: 48%;
  top: 48%;
  background-position: center;
z-index: 999999">
        <img src="{{asset('assets/img/loader.gif')}}" style=" width: 40px;" alt="loading...">
    </div>
</div>
<div class="bg-dark" id="wrap">
    <div id="top">
        <!-- .navbar -->
        <nav class="navbar navbar-static-top">
            <div class="container-fluid" style="margin-left:0">

                <a  class="navbar-brand text-xs-center" href="{{ URL::to('dashboard') }} ">
                    <h4 class="text-white">StatsOnStats</h4>
                </a>
                <div class="menu" style="margin-left:0px;margin-right:16px">
                    <span class="toggle-left" id="menu-toggle">
                        <i class="fa fa-bars text-white"></i>
                    </span>
                </div>
                <!-- Toggle Button -->
                <div class="text-xs-right xs_menu">
                    <button class="navbar-toggler hidden-xs-up" type="button" data-toggle="collapse" data-target="#nav-content">
                        ☰
                    </button>
                </div>
                <!-- Nav Content -->
                <!-- Brand and toggle get grouped for better mobile display -->

                @yield('top-nav')

            </div>

            <!-- /.container-fluid --> </nav>
        <!-- /.navbar -->
        <!-- /.head --> </div>
    <!-- /#top -->
    <div class="wrapper">

    <div id="left">
      <div class="media user-media bg-dark dker">
          <div class="user-media-toggleHover">
              <span class="fa fa-user"></span>
          </div>

      </div>
      <!-- #menu -->
      <ul id="menu" class="bg-blue dker">
          <li id="createroom" class="">
              <a href="{{route('createroom')}}">
                  <span class="link-title">&nbsp;Create Room</span>
              </a>
          </li>
          <li id="open" class="">
              <a href="{{route('openrooms')}}">

                  <span class="link-title">&nbsp;View Currently Open Rooms</span>
              </a>
          </li>
          <li id="data" class="">
              <a href="{{route('viewclosed')}}">

                  <span class="link-title">&nbsp;View Previous Rooms' Data</span>
              </a>
          </li>
          <li id="showroom" class="">
              <a href="{{URL::to('showroom')}}">

                  <span class="link-title">&nbsp;View Previous Rooms' Statistics</span>
              </a>
          </li>
          <li id="admin" class="">
              <a href="{{URL::to('admin')}}">

                  <span class="link-title">&nbsp;Admin Control</span>
              </a>
          </li>
          @yield("menu_elements")
      </ul>
      <!-- /#menu -->
    </div>
    <!-- /#left -->



    <div id="content" class="bg-container">
        <!-- Content -->
        @yield('content')
        <!-- Content end -->
    </div>


</div>


<!-- global scripts-->
<script type="text/javascript" src="{{asset('assets/js/components.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/custom.js')}}"></script>
<!-- end of global scripts-->
<script type="text/javascript" src="{{asset('assets/vendors/raphael/js/raphael-min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/d3/js/d3.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/c3/js/c3.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/toastr/js/toastr.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/switchery/js/switchery.min.js')}}"></script>
<!-- <script type="text/javascript" src="{{asset('assets/vendors/flotchart/js/jquery.flot.js')}}" ></script>
<script type="text/javascript" src="{{asset('assets/vendors/flotchart/js/jquery.flot.resize.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/flotchart/js/jquery.flot.stack.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/flotchart/js/jquery.flot.time.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/flotspline/js/jquery.flot.spline.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/flotchart/js/jquery.flot.categories.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/flotchart/js/jquery.flot.pie.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/flot.tooltip/js/jquery.flot.tooltip.min.js')}}"></script> -->
<script type="text/javascript" src="{{asset('assets/vendors/jquery_newsTicker/js/newsTicker.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/countUp.js/js/countUp.min.js')}}"></script>

<script type="text/javascript" src="{{asset('assets/js/pages/modals.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/pages/new_dashboard.js')}}"></script>
<script type="text/javascript" src="{{asset('class-custom.js')}}"></script>
<!-- page level js -->
@yield('footer_scripts')
<!-- end page level js -->
</body>
</html>
