<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="UTF-8">
    <title>
        @section('title')
            Roanoke College | Stats
        @show
    </title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{asset('assets/img/logo1.ico')}}"/>
    <!-- global styles-->
    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/components.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/custom.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/skins/black_skin.css')}}"
    <link type="text/css" rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link type="text/css" rel="stylesheet" href="#" id="skin_change"/>
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
            <div class="container-fluid">
                <a class="navbar-brand text-xs-center" href="{{ URL::to('index') }} ">
                    <h4 class="text-white"><img src="{{asset('assets/img/logow.png')}}" class="admin_img" alt="logo"> RCStats</h4>
                </a>
                <div class="menu">
                    <span class="toggle-left" id="menu-toggle">
                        <i class="fa fa-bars text-white"></i>
                    </span>
                </div>
                <div class="topnav dropdown-menu-right float-right">
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
          <div class="user-wrapper bg-dark">
              <a class="user-link" href="">
                  <p class="text-white user-info">Welcome!</p>
              </a>
              <div class="search_bar col-lg-12">
                  <div class="input-group">
                      <input type="search" class="form-control" placeholder="search">
                      <span class="input-group-btn">
<button class="btn without_border" type="button"><span class="fa fa-search">
</span></button>
</span>
                  </div>
              </div>
          </div>
      </div>
      <!-- #menu -->
      <ul id="menu" class="bg-blue dker">
          <li class="">
              <a href="#CreateRooms">
                  <span class="link-title">&nbsp;Create Room</span>
              </a>
          </li>
          <li class="">
              <a href="#PreviousRooms">

                  <span class="link-title">&nbsp;View Previous Rooms</span>
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
<script type="text/javascript" src="{{asset('js/pages/new_dashboard.js')}}"></script>
<!-- page level js -->
@yield('footer_scripts')
<!-- end page level js -->
</body>
</html>
