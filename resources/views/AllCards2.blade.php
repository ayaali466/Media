@extends('layouts.app')
@section('title','Medical Care Home')
@section('styles')
<link rel="stylesheet" href="{{ url('/user/css/hospCard2.css') }}">
<link rel="stylesheet" href="{{ url('/css/request_loading.css') }}">
@endsection

@section('content')



      <!-- Loading Untill Request Done -->
      <div id="loading_untill_request_done">
            <div class="cv-spinner">
                <span class="spinner"></span>
            </div>
        </div>
        <!-- End Loading Untill Request Done -->

        <!-- START CONTENT -->
 <!-- Start Search -->
 <div class="Hospital-Card py-5">
  <div class="container cardcont">
  <section class="container-fluid p-5 hideme" id="search-section">
  <form action="{{url('/Cards')}}" method="POST">
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
        <!-- hospital card -->
    <div class="row cardrow mt-5">
      <!-- CARD 1-->
@if($cards)
      @foreach($cards as $card)
      <div class="col-lg-4 col-md-6 mb-5 mr-auto ml-auto">
        <div class="card shadow-sm pb-3">
          <div class="card-header bg-transparent text-center">
            <img class="profile_img" src='{{ url("/orgAdmin/img/$card->logo")}}' alt="">
            <h3>{{$card->name}}</h3>
          </div>
          <div class="card-body">
          @if(($allSelect['category']!=1))
           <p class="mb-0 d-inline-block"><strong class="pr-1">Rate:</strong> <div class="Stars  ml-3 mb-3" style="--ratingStars: {{$card->reviews_sum/$card->counter_reviews}};"
                     aria-label="Rating of this product is .5 out of 5.">
                  </div></p>
      @endif
            <p class="mb-0"><strong class="pr-1">Location:</strong>{{substr($card->address,0,60)}}...</p>
            <p class="mb-0"><strong class="pr-1">Phone:</strong>{{$card->phone}}</p>
            <div class="row mt-2">
            @if(($allSelect['category']==4))
            <button id="submitSearch" name="search_button" type="button" class="btn btn-primary col-md-5 mb-1"><a href='{{URL::asset("/doc/$card->id")}}'> Show DRs </a></button>
            @endif
            <button id="submitSearch" name="search_button" type="button" class="btn btn-primary col-md-5 mb-1"><a href='{{URL::asset("/$page/$card->id")}}'> Show Profile </a></button>
          </div>
          </div>
        </div>
      </div>
      @endforeach
      @else
      <div class="card-body text-center nores"> <h3 style="color:rgba(13, 95, 95, 1);"> no resulet</h3>
      <p class="b"> there are other choices</p></div>
      @endif
      <!--END CARD 1-->
    </div>
  </div>
</div>
<!-- /hospital card -->
      <!--END CONTENT-->
@endsection
@section('scrollingIcon')
  
  <li><a class="scroll-to-top" scroll-to-top-time="2000"><i class="fa fa-arrow-circle-up"></i></a></li>

@endsection
@section('scripts')
  <script src="{{ url('/user/js/main.js') }}"></script>
  <script src="{{ url('/js/correspongingCities.js') }}"></script>
  <script src="{{ url('/js/correspongingCategory.js') }}"></script>
@endsection