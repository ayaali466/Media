<!Doctype html>
<html>

<head>

  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>@yield('title')</title>
  <link rel="icon" href="{{ url('/img/tabIcon.png') }}">
  <!-- bootstrap -->
  <link rel="stylesheet" href="{{ url('/css/bootstrap.css') }}">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url('/css/all.min.css') }}">

  <!-- Our style -->
  <link rel="stylesheet" href="{{ url('/css/navFooter.css') }}">
  <link rel="stylesheet" href="{{ url('/orgAdmin/css/main.css') }}">
  @yield('styles')
</head>

<body>

  <!-- Start Content -->
  <div class="page-wrapper chiller-theme toggled">
    <a>
      <i id="show-sidebar" class="fas fa-bars btn btn-sm btn-dark"></i>
    </a>
    <nav id="sidebar" class="sidebar-wrapper">
      <div class="sidebar-content">
        <div class="sidebar-brand">
          <a href="{{route('orgIndex')}}">
            <img src="{{ url('/img/tabIcon.png') }}" style="width: 32px;" alt="" class=" ml-2 mr-2">
            Medical Care
          </a>
          <div id="close-sidebar">
            <i class="fas fa-times"></i>
          </div>
        </div>

        <div class="sidebar-header">
          <div class="user-pic">
            <img class="img-responsive img-rounded" src="{{ url('/orgAdmin/img/1.jpg') }}" alt="Organization Logo">
          </div>
          <div class="user-info">
            <span class="user-name">SGHC
              <strong>Hospital</strong>
            </span>
            <span class="user-role">Administrator</span>
            <span class="user-status">
              <i class="fa fa-circle"></i>
              <span>Online</span>
            </span>
          </div>
        </div>
        <!-- sidebar-header  -->
        <div class="sidebar-search">
          <div>
            <div class="input-group">
              <input type="text" class="form-control search-menu" placeholder="Search...">
              <div class="input-group-append">
                <span class="input-group-text">
                  <i class="fa fa-search" aria-hidden="true"></i>
                </span>
              </div>
            </div>
          </div>
        </div>
        <!-- sidebar-search  -->
        <div class="sidebar-menu">
          <ul>
            <li class="header-menu">
              <span>General</span>
            </li>
            <li class="sidebar-dropdown">
              <a href="javascript:;">
                <i class="fas fa-plus text-success"></i>
                <span>Add</span>
              </a>
              <div class="sidebar-submenu">
                <ul>
                  <li>
                    <a href="{{route('addDepartment')}}">Department</a>
                  </li>
                  <li>
                    <a href="{{route('addLaboratory')}}">Laboratory</a>
                  </li>
                  <li>
                    <a href="{{route('addBloodBank')}}">Blood Bank</a>
                  </li>
                  <li>
                    <a href="{{route('addDoctor')}}">Doctor</a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="sidebar-dropdown">
              <a href="javascript:;">
                <i class="fas fa-edit text-warning"></i>
                <span>Update</span>
              </a>
              <div class="sidebar-submenu">
                <ul>
                  <li>
                    <a href="{{route('editProfile')}}">Profile</a>
                  </li>
                  <li>
                    <a href="{{route('editLaboratory')}}">Laboratory</a>
                  </li>
                  <li>
                    <a href="{{route('editBloodBank')}}">Blood Bank</a>
                  </li>
                  <li>
                    <a href="{{route('editDoctor')}}">Doctor</a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="sidebar-dropdown">
              <a href="javascript:;">
                <i class="far fa-trash-alt text-danger"></i>
                <span>Delete</span>
              </a>
              <div class="sidebar-submenu">
                <ul>
                  <li>
                    <a href="{{route('deleteDepartment')}}">Department</a>
                  </li>
                  <li>
                    <a href="{{route('deleteLaboratory')}}">Laboratory</a>
                  </li>
                  <li>
                    <a href="{{route('deleteBloodBank')}}">Blood Bank</a>
                  </li>
                  <li>
                    <a href="{{route('deleteDoctor')}}">Doctor</a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="sidebar-dropdown">
              <a href="javascript:;">
                <i class="fas fa-edit"></i>
                <span>Social icons</span>
              </a>
              <div class="sidebar-submenu">
                <ul>
                  <li><a href="{{route('editInstagram')}}"><i class="fab fa-instagram"></i>Instagram</a></li>
                  <li><a href="{{route('editFacebook')}}"><i class="fab fa-facebook-f"></i>Facebook</a></li>
                  <li><a href="{{route('editTwitter')}}"><i class="fab fa-twitter"></i>Twitter</a></li>
                  <li><a href="{{route('editYoutube')}}"><i class="fab fa-youtube"></i>Youtube</a></li>
                </ul>
              </div>
            </li>

            <li class="sidebar-dropdown">
              <a href="javascript:;">
                <i class="fa fa-globe"></i>
                <span>Maps and address</span>
              </a>
              <div class="sidebar-submenu">
                <ul>
                  <li><a href="{{route('editMap')}}"><i class="fas fa-map-marker-alt"></i>Google maps</a></li>
                  <li><a href="{{route('editAddress')}}"><i class="far fa-address-card"></i>Main Address</a></li>
                </ul>
              </div>
            </li>
            <li class="header-menu">
              <span>Website contact</span>
            </li>
            <li>
              <a href="{{route('request')}}">
                <i class="fas fa-envelope"></i>
                <span>Request</span>
              </a>
            </li>
          </ul>
        </div>
        <!-- sidebar-menu  -->
      </div>
      <!-- sidebar-content  -->
      <div class="sidebar-footer">
        <a href="#">
          <i class="fa fa-bell"></i>
          <span class="badge badge-pill badge-warning notification">3</span>
        </a>
        <a href="#">
          <i class="fa fa-envelope"></i>
          <span class="badge badge-pill badge-success notification">7</span>
        </a>
        <a href="#">
          <i class="fa fa-cog"></i>
          <span class="badge-sonar"></span>
        </a>
        <a href="#">
          <i class="fa fa-power-off"></i>
        </a>
      </div>
    </nav>
    <!-- ----------------------------------------------- -->
    <!-- sidebar-wrapper  -->

    <main class="page-content">
      <div class="container-fluid">
        <!-- page-content" -->
        @yield('content')
    </div>
        <!-- Start Footer -->
      <footer class="site-footer backcolor1">
        <div class="container">
          <div class="row">
            <div class="col-xs-12 col-md-3">
              <div class="text-center mb-4 mt-5"><img class="footerLogo" src="{{ url('/img/logo.png') }}" alt="logo"></div>
              <h6 class="text-center">Medical Care</h6>
              <!-- <p class="text-justify">our target is to safe your time effort and our target is to safe your time effort and </p> -->
            </div>
            <div class="col-xs-12 col-md-3">
              <h6>FAQS</h6>
              <ul class="footer-faqs text-capitalize">
                <li>how can i register ?</li>
                <li>how long it take to get answer ?</li>
                <li>what is the range that the website cover ?</li>
                <li>Terms & Conditions</li>
                <li>Licenses</li>
                <li>Premium Support</li>
              </ul>
            </div>
            <div class="col-xs-12 col-md-3">
              <h6>About Us </h6>
              <ul class="footer-faqs text-capitalize">
                <li>story</li>
                <li>Vision</li>
                <li>Mission</li>
                <li>Team</li>
                <li>Partenerships</li>
              </ul>
            </div>
            <div class="col-xs-12 col-md-3">
              <h6>contact us</h6>
              <p> <i class="fas fa-phone mr-3"></i> + 01 234 567 88</p>
              <!-- <a class="" href="#"><i class="fa fa-phone"></i></a><br><br> -->
              <form>
                <div class="form-group">
                  <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter your Email">
                </div>
                <div class="form-group">
                  <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                    placeholder="your Message"></textarea>
                </div>
                <button type="submit" class="btn btn-signInUp text-white d-block mx-auto w-50">
                  <i class="fas fa-paper-plane mr-3"></i>send</button>
              </form>
            </div>
          </div>
          <hr>
        </div>
        <div class="container">
          <div class="row">
            <div class="col-md-5 col-sm-6 col-xs-11">
              <p class="copyright-text">Copyright &copy; 2020 All Rights Reserved by
                <a href="javascript:;">Medical Care Website</a>.
              </p>
            </div>
            <div class="col-md-2 col-sm-2 col-xs-11">
              <ul class="social-icons">
                <li><a class="scroll-to-top" scroll-to-top-time="1000"><i class="fa fa-arrow-circle-up"></i></a></li>
              </ul>
            </div>
            <div class="col-md-5 col-sm-4 col-xs-11">
              <ul class="social-icons">
                <li><a class="googlePlus" href="javascript:;"><i class="fab fa-google-plus-g"></i></a></li>
                <li><a class="facebook" href="javascript:;"><i class="fab fa-facebook-f"></i></a></li>
                <li><a class="twitter" href="javascript:;"><i class="fab fa-twitter"></i></a></li>
                <li><a class="youtube" href="javascript:;"><i class="fab fa-youtube"></i></a></li>
              </ul>
            </div>
          </div>
        </div>
      </footer>
      <!-- end Footer -->
    </main>
  <!-- page-wrapper -->
    <!-- End Content -->

    </div>
    <script src="{{ url('/js/jquery-3.4.1.js') }}"></script>
    <script src="{{ url('/js/popper.min.js') }}"></script>
    <script src="{{ url('/js/bootstrap.js') }}"></script>
    <script src="{{ url('/orgAdmin/js/main.js') }}"></script>
    <script src="{{ url('/js/navfooter.js') }}"></script>
    @yield('scripts')
</body>

</html>