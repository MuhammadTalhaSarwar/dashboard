<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>DASHBOARD</title>

    <!-- Scripts -->
    <script src="{{ asset('resources/js/app.js') }}" defer></script>

    <!-- Fonts -->
    <script src="{{ asset('resources/js/jquery-3.6.0.min.js') }}"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('resources/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts-more.js"></script>
    <script src="https://code.highcharts.com/modules/solid-gauge.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>
    <script src="https://code.highcharts.com/modules/drilldown.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>




    <!-- Styles -->
    <link href="{{ asset('resources/css/app.css') }}" rel="stylesheet">
</head>

<style type="text/css">
.nav-pills .nav-link.active, .nav-pills .show > .nav-link{
  background-color: #17A2B8;
}
.dropdown-menu{
  top: 60px;
  right: 0px;
  left: unset;
  width: 460px;
  box-shadow: 0px 5px 7px -1px #c1c1c1;
  padding-bottom: 0px;
  padding: 0px;
}
.dropdown-menu:before{
  content: "";
  position: absolute;
  top: -20px;
  right: 12px;
  border:10px solid #343A40;
  border-color: transparent transparent #343A40 transparent;
}
.footer{
  padding:5px 15px;
  border-radius: 0px 0px 3px 3px; 
}
.notification-box{
  padding: 10px 0px; 
}
.bg-gray{
  background-color: #eee;
}
@media (max-width: 640px) {
    .dropdown-menu{
      top: 50px;
      left: -16px;  
      width: 290px;
    } 
    .nav{
      display: block;
    }
    .nav .nav-item,.nav .nav-item a{
      padding-left: 0px;
    }
    .message{
      font-size: 13px;
    }
}
.sidenav {
  height: 100%;
  width: 200px;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  /* background-color: #b02827; */
  overflow-x: hidden;
  padding-top: 20px;
  background-image: linear-gradient(to bottom right, red, gray);
}

.sidenav a {
  padding: 6px 8px 6px 16px;
  text-decoration: none;
  font-size: 18px;
  color: black;
  display: block;
}

.sidenav a:hover {
  color: #f1f1f1;
}

.main {
  margin-left: 160px; /* Same as the width of the sidenav */
  font-size: 28px; /* Increased text to enable scrolling */
  padding: 0px 10px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
</style>


<body>
    <div id="app">
                    @guest
                    @else
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    @guest
                    @else
                    <ul class="navbar-nav mr-auto">
                        <div class="sidenav ">
                            <label style="color: white;">&nbsp;&nbsp;&nbsp;&nbsp;AAQOO's DASHBOARD</label>
                                <a href="{{route('home')}}"><i class="fa fa-cog fa-spin fa-1x fa-fw"></i>Dashboard V1</a>
                                <a href="{{route('guage')}}"><i class="fa fa-cog fa-spin fa-1x fa-fw"></i>Dashboard V2</a>
                             </div>
                    </ul>
                    @endguest

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
 
              <ul class="nav nav-pills mr-auto justify-content-end">
                <li class="nav-item dropdown">
                  <a class="nav-link text-dark" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-bell"></i><span class="w3-badge w3-green"><i class="count"></i></span>
                  </a>
                    <ul class="dropdown-menu">
                      <li class="head text-light bg-dark">
                        <div class="row">
                          <div class="col-lg-12 col-sm-12 col-12">
                            <span>Notifications </span>
                            <a href="#" onclick="updatenotificationcount();" class="float-right text-light">Mark all as read</a>
                          </div>
                      </li>
                    <div class="noti">

                    </div>
                    </ul>
                </li>
              </ul>

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre><i class="fa fa-user" aria-hidden="true"></i>

                                &nbsp; {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>


                            
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        @endguest


        <main class="py-8">
           
            @yield('content')

        </main>
    </div>
</body>



<script src="{{ asset('resources/js/bootstrap.min.js') }}"></script>


</html>
