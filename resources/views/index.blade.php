@extends('layouts.userApp')
@section('title','Home')
@section('styles')
<link rel="stylesheet" href="{{ url('/user/css/main.css') }}">
@endsection

@section('content')
  <!-- Start Content -->

  <!-- Start Header -->
  <header>
    <div class="overlay"></div>
    <video playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop">
      <source src="{{ url('/user/videos/headervideo.mp4') }}" type="video/mp4">
    </video>
    <div class="container h-100">
      <div class="d-flex h-100 text-center align-items-center">
        <div class="w-100 text-white">
          <h1 class="display-3">Medical Care</h1>
          <p class="lead mb-0">Health is a crown on the head of healthy people</p>
        </div>
      </div>
    </div>
  </header>
  <!-- End Header -->


  <!-- ------------------------------------- -->
  <!-- Start Search -->
  <section class="container-fluid p-5 hideme" id="search-section">
    <form action="" method="">
      <div id="search-container" class="row p-3">
        <div class="form-group col-lg col-md-6 col-sm-12 mb-2 mb-lg-0">
          <select class="custom-select">
            <option name="department" selected disabled value="">Categorgy
            </option>
            <option>Blood Bank</option>
            <option>Laboratory</option>
            <option>Medical Radiation Centers</option>
            <option>Intensive Care</option>
            <option>Incubators</option>
            <option>Medical Examination </option>
          </select>
        </div>


        <div class="form-group col-lg col-md-6 col-sm-12  mb-2 mb-lg-0">
          <select class="custom-select selected-city">
            <option name="city" selected disabled value="">Type</option>
            <option value="1">O−</option>
            <option value="2">O+</option>
            <option value="3">A−</option>
            <option value="4">A+</option>
            <option value="5">B−</option>
            <option value="6">B+</option>
            <option value="7">AB−</option>
            <option value="8">AB+</option>

          </select>
        </div>

        <div class="form-group col-lg col-md-6 col-sm-12  mb-2 mb-lg-0">
          <select class="custom-select selected-governorate">
            <option name="governorate" selected disabled value="">Governorate</option>
            <option value="1">Cairo</option>
            <option value="2">Giza</option>
            <option value="3">Al qalyubia</option>
          </select>
        </div>

        <div class="form-group col-lg col-md-6 col-sm-12 mb-2 mb-lg-0">
          <select class="custom-select selected-city">
            <option name="city" selected disabled value="">City</option>
            <option value="1">Naser City</option>
            <option value="2">Maadi</option>
            <option value="3">Al-Azhar</option>
            <option value="4">Al salam</option>
            <option value="5">Ain Shams</option>
            <option value="6">Al marj</option>
            <option value="7">Al Matarya</option>
            <option value="8">Ezzbat Al nakhl</option>
          </select>
        </div>
        <button id="submitSearch" name="search_button" type="button" class="btn btn-primary"><i class="fas fa-search"></i> Search</button>


      </div>
    </form>



  </section>
  <!-- End Search -->

  <!-- ------------------------------------- -->
  <!-- Start Articles -->
  <section class="pb-5 hideme" id="Articles">
    <div class="py-3 px-2 container">
      <div class="col-md-12">
        <h2 class=" bounceIn text-center text-muted py-5  display-4 font-weight-bold"><span>Atricles</span></h2>
      </div>
      <div class="row">
        <!-- Item1 -->
        <div class="col-lg-4 mb-3 mb-lg-0">
          <div class="articleHover articleHover-4 text-white rounded"><img src="{{ url('/user/img/articles/1.jpg') }}" alt="">
            <div class="articleHover-overlay"></div>
            <div class="articleHover-4-content">
              <h3 class="articleHover-4-title font-weight-bold mb-0"><span class="font-weight-light"></span>COVID-19
              </h3>
              <p class="articleHover-4-description mb-0 small">is a species of coronavirus that infects humans, bats
                and certain other mammals.<a data-scroll href="oneArticle-COVID-19.html"
                  class="btn btn-default  fadeInUp" data-wow-offset="50" data-wow-delay="0.6s">Learn More</a></p>

            </div>
          </div>
        </div>
        <!-- Item2 -->
        <div class="col-lg-4 mb-3 mb-lg-0">
          <div class="articleHover articleHover-4 text-white rounded"><img src="{{ url('/user/img/articles/2.jpg') }}" alt="">
            <div class="articleHover-overlay"></div>
            <div class="articleHover-4-content">
              <h3 class="articleHover-4-title font-weight-bold mb-0"><span class="font-weight-light"></span>SARSr-CoV
              </h3>
              <p class="articleHover-4-description mb-0 small">is a species of coronavirus that infects humans, bats
                and certain other mammals.<a data-scroll href="oneArticle-SARS.html" class="btn btn-default  fadeInUp"
                  data-wow-offset="50" data-wow-delay="0.6s">Learn More</a></p>
            </div>
          </div>
        </div>

        <!-- Item3 -->
        <div class="col-lg-4 mb-3 mb-lg-0">
          <div class="articleHover articleHover-4 text-white rounded"><img src="{{ url('/user/img/articles/3.jpg') }}" alt="">
            <div class="articleHover-overlay"></div>
            <div class="articleHover-4-content">
              <h3 class="articleHover-4-title font-weight-bold mb-0"><span class="font-weight-light"></span>MERS-CoV
              </h3>
              <p class="articleHover-4-description mb-0 small">is a viral respiratory infection caused by the
                MERS-coronavirus (MERS-CoV).<a data-scroll href="oneArticle-MERS-CoV.html"
                  class="btn btn-default wow fadeInUp" data-wow-offset="50" data-wow-delay="0.6s">Learn More</a>
              </p>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- End Articles -->
  <!-- ------------------------------------- -->

  <!-- start Mission -->
  <section class="pb-5 backcolor1 hideme" id="Mission">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h2 class="text-center text-muted py-5  display-4 font-weight-bold"><span class="color5">Mission</span></h2>
        </div>
        <!-- Item1 -->
        <div class="col-md-4 text-center">
          <i class="fas fa-hourglass-start"></i>
          <h4>Save Time</h4>
          <p class="text-justify color5">It is our mission to help you save time and money, and avoid the common
            pitfalls that many first-time medical services experience when they don’t get expert advice in advance.
            Our website cooperates with many hospitals and laboratories and blood banks.
            Compare tens of hospitals, laboratory and blood banks and hire the best for you. Pay after getting the
            service as proposed.</p>
        </div>
        <!-- Item2 -->
        <div class="col-md-4 text-center">
          <i class="fas fa-shield-alt"></i>
          <h4>Trust</h4>
          <p class="text-justify color5">Our hospitals, laboratories, and blood banks have any certifications locally
            and internationally.
            The latest medical devices, the latest treatment methods, and the best doctors staff.
            The best quality in their services</p>
        </div>
        <!-- Item3 -->
        <div class="col-md-4 text-center">
          <i class="fas fa-heartbeat"></i>
          <h4>Save Life </h4>
          <p class="text-justify color5">We have information on over 6000 hospitals. Find the nearest hospitals in your
            area by using the search box above. Type in your full address, or city and state, or just your zip code in
            the search box and then click Search. We will find hospitals that are closest to you and show them on a map.
            You can then click on a hospital to get its details (e.g. address, phone and services) and directions. You
            can also browse through our list of hospitals by our A-Z or State index below below.</p>
        </div>
      </div>
    </div>
  </section>
  <!-- end Mission -->
  <!-- ------------------------------------- -->


  <!-- Start Statistics -->
  <section class="pb-5 hideme" id="statistics">
    <div class="container">
      <div class="row justify-content-between">
        <div class="col-md-12">
          <h2 class=" bounceIn text-center text-muted py-5  display-4 font-weight-bold"><span>Statistics</span></h2>
        </div>

        <!-- Item1 -->
        <div class="col-md-3 col-sm-12 text-center border-dotted">
          <p class="count-text mx-auto"><i class=" fas fa-user-injured statistics-icons display-4 mt-3"></i></p>
          <h2 class="timer count-title count-number text-muted" data-to="126485" data-speed="3000">0</h2>
        </div>
        <!-- Item2 -->
        <div class="col-md-3 col-sm-12 text-center border-dotted">
          <p class="count-text mx-auto"><i class="far fa-hospital statistics-icons display-4 mt-3"></i></p>
          <h2 class="timer count-title count-number text-muted" data-to="1365" data-speed="3000">0</h2>
        </div>
        <!-- Item3 -->
        <div class="col-md-3 col-sm-12 text-center border-dotted">
          <p class="count-text mx-auto"><i class="fas fa-flask statistics-icons display-4 mt-3"></i></p>
          <h2 class="timer count-title count-number text-muted" data-to="2642" data-speed="3000">0</h2>
        </div>
        <!-- Item4 -->
        <div class="col-md-3 col-sm-12 text-center">
          <p class="count-text mx-auto"><i class="fas fa-user-md statistics-icons display-4 mt-3"></i></p>
          <h2 class="timer count-title count-number text-muted" data-to="15315" data-speed="3000">0</h2>
        </div>
      </div>
    </div>

  </section>
  <!-- End Statistics -->


  <!-- Start Patient Journey -->
  <section class="pb-5 hideme" id="patientJourney">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-9 text-center p-0 ">
          <div class="card1 px-0 pt-4 pb-0">
            <div class="col-md-12">
              <h2 class=" bounceIn text-center text-muted py-5  display-4 font-weight-bold"><span class="color5">Patient
                  Journey</span></h2>
            </div>
            <!-- progressbar -->
            <ul id="progressbar" class="px-0 mt-5">
              <li class="active" id="request"><strong>Request</strong></li>
              <li class="active" id="accepct"><strong>Confirm</strong></li>
              <li class="active" id="appointment"><strong>Appointment</strong></li>
              <li class="active" id="rate"><strong>Rate</strong></li>
            </ul>
            <div class="progress mb-5">
              <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width:0px"
                aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Patient Journey -->




  <!-- ------------------------------------- -->
  <!-- start partners -->
  <section class="pb-5 hideme" id="partners">
    <div class="container">
      <div class="row justify-content-between">
        <div class="col-md-12">
          <h2 class=" bounceIn text-center text-muted py-5  display-4 font-weight-bold"><span>Parteners</span></h2>
        </div>
        <!-- Item1 -->
        <div class="card col-lg-3 col-md-5 col-11 pt-3 mx-auto mb-xs-5 mb-4 text-center boxshaow" style="width: 18rem;">
          <img class="card-img-top rounded-circle imageshaow mx-auto"
            src="https://res.cloudinary.com/mhmd/image/upload/v1570786266/hoverSet-7_uae7jt.jpg" alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text text-justify">Some quick example text to build on the card title and make up the bulk of
              the card's content.</p>
            <a href="#" class="btn btn-primary">Read More</a>
          </div>
        </div>
        <!-- Item2 -->
        <div class="card col-lg-3 col-md-5 col-11 pt-3 mx-auto mb-xs-5 mb-4 text-center boxshaow" style="width: 18rem;">
          <img class="card-img-top rounded-circle imageshaow mx-auto"
            src="https://res.cloudinary.com/mhmd/image/upload/v1570786266/hoverSet-7_uae7jt.jpg" alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text text-justify">Some quick example text to build on the card title and make up the bulk of
              the card's content.</p>
            <a href="#" class="btn btn-primary">Read More</a>
          </div>
        </div>
        <!-- Item3 -->
        <div class="card col-lg-3 col-md-5 col-11 pt-3 mx-auto mb-xs-5 mb-4 text-center boxshaow" style="width: 18rem;">
          <img class="card-img-top rounded-circle imageshaow mx-auto"
            src="https://res.cloudinary.com/mhmd/image/upload/v1570786266/hoverSet-7_uae7jt.jpg" alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text text-justify">Some quick example text to build on the card title and make up the bulk of
              the card's content.</p>
            <a href="#" class="btn btn-primary">Read More</a>
          </div>
        </div>
      </div>
    </div>

  </section>
  <!-- End Content -->
  @endsection
  @section('scrollingIcon')
  <ul class="social-icons">
    <li><a class="scroll-to-top" scroll-to-top-time="2000"><i class="fa fa-arrow-circle-up"></i></a></li>
  </ul>
  @endsection
  @section('scripts')
  <script src="{{ url('/user/js/main.js') }}"></script>
  @endsection

  