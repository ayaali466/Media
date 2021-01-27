@extends('layouts.app')
@section('title','Medical Care Home')
@section('styles')
<link rel="stylesheet" href="{{ url('/user/css/main.css') }}">
<link rel="stylesheet" href="{{ url('/css/request_loading.css') }}">
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

      <!-- Loading Untill Request Done -->
      <div id="loading_untill_request_done">
            <div class="cv-spinner">
                <span class="spinner"></span>
            </div>
        </div>
        <!-- End Loading Untill Request Done -->
        @if($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif

  <!-- ------------------------------------- -->
  <!-- Start Search -->
  <section class="container-fluid p-5 hideme" id="search-section">
  <form action="{{route('Home_seach')}}" method="POST">
    @csrf
      <div id="search-container" class="row p-3">
        <div class="form-group col-lg col-md-6 col-sm-12 mb-2 mb-lg-0">
        <select class="custom-select selected-category" name="category" id="category_id">
            <option selected disabled value="category">* Categorgy</option>
            <option value="1">Blood Bank</option>
            <option value="2">Medical Analysis</option>
            <option value="3">Medical Radiation Centers</option>
            <option value="4">Medical Examination</option>
            <option value="5">Intensive Care</option>
            <option value="6">Incubators</option>
          </select>
        </div>


        <div class="form-group col-lg col-md-6 col-sm-12  mb-2 mb-lg-0" id="type_id_cntainer">
        <select class="custom-select selected-type" name="type" id="type_id">
            <option selected disabled value="">* Type</option>
          </select>
        </div>

        <!------------------------------- Governorate ------------------------------->
        <div class="form-group col-lg col-md-6 col-sm-12  mb-2 mb-lg-0">
          <div class="form-group">
            <select class="custom-select selected-governorate" name="governorate" id="governorate_id">
              <option selected disabled value="">* Governorate</option>
              @foreach($governorates as $governorate)
                <option value="{{ $governorate -> id }}">{{ $governorate -> gov_name }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <!------------------------------- City ------------------------------->
        <div class="form-group col-lg col-md-6 col-sm-12 mb-2 mb-lg-0">
          <div class="form-group">
            <select class="custom-select selected-city" name="city" id="city_id">
              <option selected disabled value="">* City</option>
            </select>
          </div>
        </div>


        <button id="submitSearch" name="search_button" type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Search</button>


      </div>
    </form>



  </section>
  <!-- End Search -->

  <!-- ------------------------------------- -->
  <!-- Start Articles -->
  <section class="pb-5 hideme" id="Articles">
    <div class="py-3 px-2 container">
      <div class="col-md-12">
        <h2 class=" bounceIn text-center text-muted py-5  display-4 font-weight-bold"><span>Articles</span></h2>
      </div>
      <div class="row">
            <!-- Item1 -->
            @php
                $path = "";
            @endphp
            @foreach($articles as $article)
            <div class="col-lg-4 col-md-6 mb-3">
            @php
                if(isset($article->profile_image))
                    $path = "user/img/articles/$article->profile_image";
            @endphp
                <div class="articleHover articleHover-4 text-white rounded"><img src='{{ url("$path") }}' alt="">
                    <div class="articleHover-overlay"></div>
                    <div class="articleHover-4-content ">
                        <h3 class="articleHover-4-title font-weight-bold mb-0"><span class="font-weight-light"></span>{{$article->title}}
                        </h3>
                        <p class=" articleHover-4-description mb-0 small">{{substr($article->content,0,70)}}
                        <a data-scroll href='{{url("/oneArticle/".$article->id)}}'
                        class="btn btn-default  fadeInUp" data-wow-offset="50" data-wow-delay="0.6s"style="height:76px;">
                        Learn More</a></p>
                    </div>
                </div>
          </div>
            @endforeach

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
              <li class="active" id="request"><strong>Search</strong></li>
              <li class="active" id="accepct"><strong>Debartment</strong></li>
              <li class="active" id="appointment"><strong>Location</strong></li>
              <li class="active" id="rate"><strong>Find</strong></li>
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
          <h2 class="  text-center text-muted py-5  display-4 font-weight-bold"><span>Parteners</span></h2>
        </div>
        
        <!-- Item1 -->
        @if(isset($rhos))
        
        <div class="card pt-3  mb-xs-5 mb-4 text-center boxshaow" style="width: 18rem;">
          <img class=" card-img-top rounded-circle imageshaow mx-auto " src='{{ url("orgAdmin/img/$rhos->logo") }}' alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title">{{$rhos->name}}</h5>
            <p class="card-text text-center">{{substr($rhos->about_us, 0,100)}}....</p>
            <a href='{{URL::asset("/hospitalPartner/$rhos->id")}}' class="btn btn-signInUp">Read More</a>
          </div>
        </div>
        @endif
        <!-- Item2 -->
        @if(isset($rlab))
                
        <div class="card pt-3  mb-xs-5 mb-4 text-center boxshaow" style="width: 18rem;">
          <img class=" card-img-top rounded-circle imageshaow mx-auto " src='{{ url("orgAdmin/img/$rlab->logo") }}' alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title">{{$rlab->name}}</h5>
            <p class="card-text text-center">{{substr($rlab->about_us, 0,100)}}....</p>
            <a href='{{URL::asset("/centerPartner/$rlab->id")}}' class="btn btn-signInUp">Read More</a>
          </div>
        </div>
        @endif
          <!-- Item3 -->
          @if(isset($rcen))
            
        <div class="card pt-3  mb-xs-5 mb-4 text-center boxshaow" style="width: 18rem;">
          <img class=" card-img-top rounded-circle imageshaow mx-auto " src='{{ url("orgAdmin/img/$rcen->logo") }}' alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title">{{$rcen->name}}</h5>
            <p class="card-text text-center">{{substr($rcen->about_us, 0,100)}}....</p>
            <a href='{{URL::asset("/labPartner/$rcen->id")}}' class="btn btn-signInUp">Read More</a>
          </div>
        </div>
        @endif
      </div>
    </div>

  </section>
  <!-- End Content -->
@endsection

@section('scrollingIcon')
  <li><a class="scroll-to-top" scroll-to-top-time="2000"><i class="fa fa-arrow-circle-up"></i></a></li>
@endsection
@section('scripts')
  <script src="{{ url('/user/js/main.js') }}"></script>
  <script src="{{ url('/js/correspongingCities.js') }}"></script>
  <script src="{{ url('/js/correspongingCategory.js') }}"></script>
@endsection