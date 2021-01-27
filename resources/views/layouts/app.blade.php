<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <link rel="icon" href="{{ url('/img/tabIcon.png') }}">
      <!-- bootstrap -->
    <link rel="stylesheet" href="{{ url('/css/bootstrap.css') }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ url('/css/all.min.css') }}">

    <!-- Our style -->
    <link rel="stylesheet" href="{{ url('/css/navFooter.css') }}">
    <link rel="stylesheet" href="{{ url('/css/loading_page.css') }}">
    <style>
    .image-cover {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        /* margin: 20px; */
        object-fit: cover;
        /* object-position: center right; */
    }
    .nav-item .dropdown-menu-right a {
      border-left: 4px solid transparent;
    }
    .nav-item .dropdown-menu-right a:hover{
      color: #0055d9;
      border-left: 4px solid #0055d9;
      background: #03be4421;
    /* box-shadow: rgba(50, 50, 93, 0.08) 0px 14px 13px -12px, rgba(0, 0, 0, 0.16) 0px 26px 32px -22px; */
    }
    </style>
    @yield('styles')
</head>
<body>
      @include('loading_page')
<!-- Start Nav Bar -->
  <nav class="navbar navbar-expand-lg navbar-dark backcolor1 text-center">
    <a class="navbar-brand" href="{{route('homePage')}}"><img style="max-width:40px; margin-top: -7px;" src="{{ url('img/logo.png') }}" alt="Website Logo"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="{{route('homePage')}}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('all_articles')}}">Articles</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('all_partners')}}">Our Parteners</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Services
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href='{{route("BB_Page")}}'>Blood Bank</a>
            <a class="dropdown-item" href='{{route("lab_Page")}}'>Laboratory</a>
            <a class="dropdown-item" href='{{route("center_Page")}}'>Medical Radiation Centers</a>
            <a class="dropdown-item" href='{{route("hos_Page")}}'>Hospital</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="#footer_id">Contact Us</a>
        </li>
      </ul>
      <!-- Right Side Of Navbar -->
      <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
                @guest
                <li class="nav-item">
                    <!-- <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a> -->
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <!-- <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a> -->
                        <a class="btn btn-signInUp" href="{{ route('login') }}">SignIn / Up</a>
                    </li>
                @endif
                @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        
                        @php
                            $logo = auth()->user()->photo;
                            if(isset($logo))
                                $path =  auth()->user()->photo;
                            else
                                $path = "photo1.png";
                        @endphp
                            
                        <img src='{{ url("/user/img/$path") }}' alt="Profile photo" class="image-cover mr-2">
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{route('userProfile.index' )}}">
                        <i class="fas fa-user"></i>
                            {{ __('Profile') }}
                        </a>
                        <!-- <a class="dropdown-item" href="{{route('userProfile.edit_profile', auth()->user()->national_id )}}">
                            <i class="fas fa-edit"></i>
                            {{ __('Edit Prfile') }}
                        </a> -->
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i>
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
    </div>
  </nav>
  <!-- End Nav Babr -->

  <!-- Start Content -->
  @yield('content')
  <!-- End Content -->

  <!-- Start Footer -->
  <footer class="site-footer backcolor1 hideme" id="footer_id">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-md-3">
          <div class="text-center mb-4 mt-5"><img class="footerLogo" src="{{ url('img/logo.png') }}" alt="Website Logo"></div>
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
          <form method="POST" action="{{ route('store.message') }}" class="ValidationForm" enctype="multipart/form-data">
          {{csrf_field()}}
            <div class="form-group">
              <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter your Email" name="email">
            </div>
            <div class="form-group">
              <textarea class="form-control" id="exampleFormControlTextarea1" name="message"  rows="3"
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
            <a href="#">Medical Care Website</a>.
          </p>
        </div>
        <div class="col-md-2 col-sm-2 col-xs-11">
        <ul class="social-icons">
            @yield('scrollingIcon')
        </ul>
        </div>
        <div class="col-md-5 col-sm-4 col-xs-11">
          <ul class="social-icons">
            <li><a class="googlePlus" href="{{$websocial->google_plus }}"><i class="fab fa-google-plus-g"></i></a></li>
            <li><a class="facebook" href="{{$websocial->facebook }}"><i class="fab fa-facebook-f"></i></a></li>
            <li><a class="twitter" href="{{$websocial->twitter }}"><i class="fab fa-twitter"></i></a></li>
            <li><a class="youtube" href="{{$websocial->youtube }}"><i class="fab fa-youtube"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
  </footer>
  <!-- end Footer -->

  <!-- Scripts -->
  <script src="{{ url('/js/jquery-3.4.1.js') }}"></script>
  <script src="{{ url('/js/popper.min.js') }}"></script>
  <script src="{{ url('/js/bootstrap.js') }}"></script>
  <script src="{{ url('/js/navfooter.js') }}"></script>
  <script src="{{ url('/js/loading_page.js') }}"></script>
  @yield('scripts')
</body>

</html>
