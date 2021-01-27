<!DOCTYPE html>
<html>
  <head>
      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">

      <link rel="icon" href="{{ url('/img/tabIcon.png') }}">
      
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="{{ url('/css/bootstrap.css') }}">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="{{ url('/css/all.min.css') }}">


    <!-- Fontastic Custom icon font-->
    <!-- <link rel="stylesheet" href="public/css/fontastic.css"> -->
    <link rel="stylesheet" href="{{ url('/superAdmin/css/fontastic.css') }}">

    <!-- Google fonts - Roboto -->
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700"> -->
    <!-- jQuery Circle-->
    <!-- <link rel="stylesheet" href="public/css/grasp_mobile_progress_circle-1.0.0.min.css"> -->
    <link rel="stylesheet" href="{{ url('/superAdmin/css/grasp_mobile_progress_circle-1.0.0.min.css') }}">

    <!-- Custom Scrollbar-->
    <!-- <link rel="stylesheet" href="public/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css"> -->
    <link rel="stylesheet" href="{{ url('/superAdmin/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css') }}">

    <!-- theme stylesheet-->
    <!-- <link rel="stylesheet" href="public/css/style.default.css" id="theme-stylesheet"> -->
    <link rel="stylesheet" href="{{ url('/superAdmin/css/style.default.css') }}" id="theme-stylesheet">

    <!-- Color Palette stylesheet-->
    <!-- <link rel="stylesheet" href="public/css/colorPalette.css"> -->
    <link rel="stylesheet" href="{{ url('/superAdmin/css/colorPalette.css') }}">

    <!-- Custom stylesheet - for your changes-->
    <!-- <link rel="stylesheet" href="public/css/custom.css"> -->
    <link rel="stylesheet" href="{{ url('/superAdmin/css/custom.css') }}">

    @yield('css')
    <!-- Favicon-->
    <!-- <link rel="shortcut icon" href="public/img/favicon.ico"> -->
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body>
  	
  <nav class="side-navbar">
    <div class="side-navbar-wrapper">
      <!-- Sidebar Header    -->
      <div class="sidenav-header d-flex align-items-center justify-content-center">
        <!-- User Info-->
        <div class="sidenav-header-inner text-center"><img src="{{url('superAdmin/img/SuperAdmin.png')}}" alt="person"
            class="img-fluid rounded-circle">
          <h2 class="h5">Super Admin</h2><span>Medical Care</span>
        </div>
        <!-- Small Brand information, appears on minimized sidebar-->
        <div class="sidenav-header-logo"><a href="index.html" class="brand-small text-center"> <strong
              class="color5">M</strong><strong class="color3">C</strong></a></div>
      </div>
      <!-- Sidebar Navigation Menus-->
      <div class="main-menu">
        <h5 class="sidenav-heading text-center">Main</h5>
        <hr class="my-0">
        <ul id="side-main-menu" class="side-menu list-unstyled">
          <!-- Home-->
          <li><a href="{{route('Admin_home')}}"> <i class="fas fa-home"></i>Home</a></li>
          <!-- Add Partener -->
          <!-- <li><a href="#addpartener" aria-expanded="false" data-toggle="collapse"> <i class="fas fa-plus text-success"></i>Add Partener </a>
            <ul id="addpartener" class="collapse list-unstyled ">
              <li><a href="{{route('admin.show_add_hospital')}}">Hospital</a></li>
              <li><a href="addLab.html">Lab</a></li>
              <li><a href="addBloodBank.html">Blood Bank</a></li>
            </ul>
          </li> -->

          <!-- Add Medical Data -->
          <li><a href="#addpartener" aria-expanded="false" data-toggle="collapse"> <i class="fas fa-edit text-warning"></i>Medical Data</a>
            <ul id="addpartener" class="collapse list-unstyled ">
              <li><a href="{{route('admin.show_add_analysis')}}"><i class="fas fa-plus text-success"></i>Add Analysis</a></li>
              <li><a href="{{route('admin.show_delete_analysis')}}"><i class="far fa-trash-alt text-danger"></i>Delete Analysis</a></li>
              <li><a href="{{route('admin.show_add_radition')}}"><i class="fas fa-plus text-success"></i>Add Radition</a></li>
              <li><a href="{{route('admin.show_delete_radition')}}"><i class="far fa-trash-alt text-danger"></i>Delete Radition</a></li>
              <li><a href="{{route('admin.show_add_department')}}"><i class="fas fa-plus text-success"></i>Add Department</a></li>
              <li><a href="{{route('admin.show_delete_department')}}"><i class="far fa-trash-alt text-danger"></i>Delete Department</a></li>
              <li><a href="{{route('admin.show_add_articleType')}}"><i class="fas fa-plus text-success"></i>Add Article Type</a></li>
              <li><a href="{{route('admin.show_delete_articleType')}}"><i class="far fa-trash-alt text-danger"></i>Delete Article Type</a></li>
              
            </ul>
          </li>
          <!-- Add Partener -->
          <li><a href="{{route('admin.show_add_hospital')}}"><i class="fas fa-plus text-success"></i>Add Partner</a></li>
          <!-- Delete Partener -->
          <li><a href="{{route('live_search')}}"> <i class="far fa-trash-alt text-danger"></i>Delete Partener</a></li>
          <li><a href="{{route('show_admin_article')}}"> <i class="fas fa-newspaper text-success"></i>Post Article</a></li>
          <!-- Edit website Social Icons -->
          <li><a href="#editsocial" aria-expanded="false" data-toggle="collapse"> <i class="fas fa-edit text-warning"></i>Edit
              Social Icons</a>
            <!-- <i class="fas fa-caret-down"></i> -->
            <ul id="editsocial" class="collapse list-unstyled ">
            <!-- <li><a href="#"><i class="fab fa-connectdevelop"></i> Social Contacts</a></li> -->
              <li><a href="{{ route('admin.showeditgoogleplus') }}"><i class="fab fa-google-plus-g"></i>Google Plus</a></li>
              <li><a href="{{ route('admin.showeditfacebook') }}"><i class="fab fa-facebook-f"></i>Facebook</a></li>
              <li><a href="{{ route('admin.showedittwitter') }}"><i class="fab fa-twitter"></i>Twitter</a></li>
              <li><a href="{{ route('admin.showedityoutube') }}"><i class="fab fa-youtube"></i>Youtube</a></li>
            </ul>
          </li>

        </ul>
      </div>
      <div class="admin-menu">
          <hr class="my-0">
          <h5 class="sidenav-heading sidenav-header-inner text-center py-1" style="font-size: 0.8rem">Parteners Contact</h5>
          <hr class="my-0">
          <div style="background-color:black" class="sidenav-header-logo"><a href="index.html" class="brand-small text-center"> <strong
              class="color5">P</strong><strong class="color3">C</strong></a></div>
          <ul id="side-admin-menu" class="side-menu list-unstyled">
            <li> <a href="{{route('admin.notifications')}}"> <i class="fas fa-bell"></i>Partner Actions <div class="badge badge-info">{{$countnotifi->count}} New</div></a></li>
            <li> <a href="{{route('admin.activities')}}"> <i class="far fa-comment"></i>Recent Activities <div class="badge badge-secondary">{{$countrecent_activitie->count}} New</div></a></li>
            <li> <a href="{{route('admin.messages')}}"> <i class="fas fa-envelope"></i>Messages <div class="badge badge-warning">{{$countmessage->count}} New</div></a></li>
            <li> <a href="{{route('admin.request')}}"> <i class="fas fa-sms"></i>Requests <div class="badge badge-warning">{{$countrequest->count}} New</div></a></li>
          </ul>
      </div>
    </div>
    
  </nav>
  <div class="page">
    <!-- navbar-->
    <header class="header">
      <nav class="navbar">
        <div class="container-fluid">
          <div class="navbar-holder d-flex align-items-center justify-content-between">
            <div class="navbar-header"><a id="toggle-btn" href="#" class="menu-btn"><i class="fas fa-bars"></i></a><a
                href="{{route('Admin_home')}}" class="navbar-brand">
                <div class="brand-text d-none d-md-inline-block"><strong class="color4">Medical Care</strong></div>
              </a></div>
            <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
              <!-- Notifications dropdown-->
              <li class="nav-item dropdown"> <a id="notifications" rel="nofollow" data-target="#" href="#"
                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link"><i
                    class="fas fa-bell"></i><span class="badge badge-warning">{{$countrecent_activitie->count + $countrequest->count + $countnotifi->count }}</span></a>
                <ul aria-labelledby="notifications" class="dropdown-menu">
                  <li><a rel="nofollow" href="{{route('admin.activities')}}" class="dropdown-item">
                      <div class="notification d-flex justify-content-between">
                        <div class="notification-content"><i class="far fa-comment"></i>You have {{$countrecent_activitie->count}} new Recent Activitie </div>
                      </div>
                    </a></li>
                  <li><a rel="nofollow" href="{{route('admin.request')}}" class="dropdown-item">
                      <div class="notification d-flex justify-content-between">
                        <div class="notification-content"><i class="fas fa-sms"></i>You have {{$countrequest->count}} new Requests
                        </div>

                      </div>
                    </a></li>
                  <li><a rel="nofollow" href="{{route('admin.notifications')}}" class="dropdown-item">
                      <div class="notification d-flex justify-content-between">
                        <div class="notification-content"><i class="fas fa-bell"></i>You have {{$countnotifi->count}} new Partners Actions</div>
                      </div>
                    </a></li>
                  <!-- <li><a rel="nofollow" href="{{route('admin.notifications')}}" class="dropdown-item all-notifications text-center">
                      <strong> <i class="fas fa-bell"></i>view all notifications </strong></a></li> -->
                </ul>
              </li>
              <!-- Messages dropdown-->
              <li class="nav-item dropdown"> <a id="messages" rel="nofollow" data-target="#" href="#"
                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link"><i
                    class="fa fa-envelope"></i><span class="badge badge-info">{{$countmessage->count}}</span></a>
                <ul aria-labelledby="notifications" class="dropdown-menu">
                @if(($countmessage->count) > 0)
                    <?php $i=0; ?>
                @foreach($messages as $msg)  
                <?php $i+=1; ?>
                    @if($i < 4)
                <li><a rel="nofollow" href="{{route('admin.messages')}}" class="dropdown-item d-flex">
                      <!-- <div class="msg-profile"> <img src="{{url('superAdmin/img/avatar-1.png')}}" alt="..." class="img-fluid rounded-circle">
                      </div> -->
                      <div class="msg-body">
                        <h3 class="h5">{{$msg->	email}}</h3><span>sent you a direct message</span><small>{{$msg->messages_Date}}</small>
                      </div>
                    </a></li>
                    @endif
                    @endforeach
                  @else
                  <li><a rel="nofollow" href="#" class="dropdown-item d-flex">
                      <div class="msg-body">
                        <h3 class="h5">No Messages</h3><span>you have no new messages.</span>
                      </div>
                    </a></li>
                  @endif
                  <li><a rel="nofollow" href="{{route('admin.messages')}}" class="dropdown-item all-notifications text-center">
                      <strong> <i class="fa fa-envelope"></i>Read all messages </strong></a></li>
                </ul>
              </li>
              <!-- <a class="dropdown-item" href="{{ route('sa_logout') }}"
                  onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
              </a> -->

              
              <!-- Log out-->
              <li class="nav-item"><a href="{{ route('sa_logout') }}" class="nav-link logout"
                  onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();"
              > <span
                    class="d-none d-sm-inline-block">Logout</span><i class="fas fa-sign-out-alt"></i></a>
              </li>

              <form id="logout-form" action="{{ route('sa_logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
              
            </ul>
          </div>
        </div>
      </nav>
    </header>
    
    @yield('content')

    <footer class="main-footer">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-6">
              <p>Medical Care &copy; 2020</p>
            </div>
            <div class="col-sm-6 text-right">
              <p>Design by <a href="{{ route('homePage') }}" class="external">Medical Care Team</a></p>
              <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions and it helps me to run Bootstrapious. Thank you for understanding :)-->
            </div>
          </div>
        </div>
      </footer>
    </div>
    <!-- JavaScript files-->
    <script src="{{ url('/superAdmin/vendor/jquery/jquery-3.4.1.min.js') }}"></script>
    <!-- <script src="public/vendor/jquery/jquery-3.4.1.min.js"></script> -->

    <script src="{{ url('/superAdmin/vendor/popper.js/popper.min.js') }}"></script>
    <!-- <script src="public/vendor/popper.js/popper.min.js"> </script> -->
    
    <script src="{{ url('/superAdmin/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- <script src="public/vendor/bootstrap/js/bootstrap.min.js"></script> -->
    
    <script src="{{ url('/superAdmin/js/grasp_mobile_progress_circle-1.0.0.min.js') }}"></script>
    <!-- <script src="public/js/grasp_mobile_progress_circle-1.0.0.min.js"></script> -->

    <script src="{{ url('/superAdmin/vendor/jquery.cookie/jquery.cookie.js') }}"></script>
    <!-- <script src="public/vendor/jquery.cookie/jquery.cookie.js"> </script> -->

    <script src="{{ url('/superAdmin/vendor/chart.js/Chart.min.js') }}"></script>
    <!-- <script src="public/vendor/chart.js/Chart.min.js"></script> -->

    <script src="{{ url('/superAdmin/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <!-- <script src="public/vendor/jquery-validation/jquery.validate.min.js"></script> -->

    <script src="{{ url('/superAdmin/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <!-- <script src="public/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script> -->

    <!-- <script src="{{ url('/superAdmin/js/charts-home.js') }}"></script> -->
    <!-- <script src="public/js/charts-home.js"></script> -->
    <!-- Main File-->
    <script src="{{ url('/superAdmin/js/front.js') }}"></script>
    <!-- <script src="public/js/front.js"></script> -->
    @yield('js')
  </body>
</html>