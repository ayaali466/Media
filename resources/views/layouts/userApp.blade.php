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
  @yield('styles')
</head>
<body>
  <!-- ------------------------------------- -->
  <!-- Start Nav Bar -->
  <nav class="navbar navbar-expand-lg navbar-dark backcolor1 text-center">
    <a class="navbar-brand" href="{{route('homePage')}}"><img style="max-width:40px; margin-top: -7px;" src="{{ url('img/logo.png') }}"></a>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="allArticles.html">Articles <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="allPartners.html">Our Parteners</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Services
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="blood_bank_page.html">Blood Bank</a>
            <a class="dropdown-item" href="lab_page.html">Laboratory</a>
            <a class="dropdown-item" href="center_page.html">Medical Radiation Centers</a>
            <a class="dropdown-item" href="hospital_page.html">Hospital</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="#">Contact Us</a>
        </li>
      </ul>
      <a class="btn btn-signInUp" href="{{ route('userLoginTest') }}">SignIn / Up</a>
    </div>
  </nav>
  <!-- End Nav Babr -->
  
  <!-- Start Content -->
    @yield('content')
  <!-- End Content -->


    <!-- Start Footer -->
  <footer class="site-footer backcolor1 hideme">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-md-3">
          <div class="text-center mb-4 mt-5"><img class="footerLogo" src="img/logo.png"></div>
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
          <form method="post" action="">
          {{csrf_field()}}
            <div class="form-group">
              <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter your Email">
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
            <li><a class="googlePlus" href="#"><i class="fab fa-google-plus-g"></i></a></li>
            <li><a class="facebook" href="#"><i class="fab fa-facebook-f"></i></a></li>
            <li><a class="twitter" href="#"><i class="fab fa-twitter"></i></a></li>
            <li><a class="youtube" href="#"><i class="fab fa-youtube"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
  </footer>
  <!-- end Footer -->
  <script src="{{ url('/js/jquery-3.4.1.js') }}"></script>
  <script src="{{ url('/js/popper.min.js') }}"></script>
  <script src="{{ url('/js/bootstrap.js') }}"></script>
  <script src="{{ url('/js/navfooter.js') }}"></script>
  @yield('scripts')
</body>

</html>
