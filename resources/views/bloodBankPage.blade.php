@extends('layouts.app')
@section('title','Medical Care Home')
@section('styles')
<link rel="stylesheet" href="{{ url('/user/css/lab_page.css') }}">
@endsection

@section('content')
 <!-- Start Content -->
 <div class="container text-center">
    <header>
      <div id="carouselExampleIndicators" class="carousel slide mt-5" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
          <!-- Slide One - Set the background image for this slide in the line below -->
          <div class="carousel-item active"
            style="background-image: url('././orgAdmin/img/blood_bank-slider-1.jpg');height: 500px;background-size: cover;">
            <div class="carousel-caption d-none d-md-block">
            </div>
          </div>
          <!-- Slide Two - Set the background image for this slide in the line below -->
          <div class="carousel-item"
            style="background-image: url('././orgAdmin/img/blood_bank-slider-2.jpg');height: 500px;background-size: cover;">
            <div class="carousel-caption d-none d-md-block">
            </div>
          </div>
          <!-- Slide Three - Set the background image for this slide in the line below -->
          <div class="carousel-item"
            style="background-image: url('././orgAdmin/img/blood_bank-slider-3.jpg');height: 500px;background-size: cover;">
            <div class="carousel-caption d-none d-md-block">
            </div>
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </header>
    <div class="row">
      <h1 class="col-12  text-center text-muted py-5  display-4 font-weight-bold">Blood Bank</h1>
      <p class="offset-1 col-10  text-justify">
        Blood bank at Narayana Health is of one of the largest hospital-based blood banks and frequently conducts
        irradiation of blood components and plateletpheresis. Our blood bank has an unparalleled track record. We make
        sure that the correct type of blood is provided by following strict quality control measures. Before issuing to
        the patients, the Blood Bank conducts all the important tests pertaining to blood transfusion. Narayana Health
        group frequently conducts various donation camps for people to voluntarily donate blood and encourage patients
        and their family members to donate blood at the blood bank.
      </p>
    </div>

    <!-- start partners -->
    <section class="pb-5" id="partners">
      <div class="container">
        <div class="row justify-content-between">
          <div class="col-md-12">
            <h2 class=" bounceIn text-center text-muted py-5  display-4 font-weight-bold"><span>Parteners</span></h2>
          </div>
         
      
          <!-- Item1 -->
          <?php $count=0;?>
          @foreach($rbloodbank as $bloodbank)
          <?php $count+=1;?>
          @if($count < 4 )
          <div class="card pt-3  mb-xs-5 mx-auto mb-4 text-center boxshaow moreBox"
            style="width: 18rem;">
            <img class="card-img-top rounded-circle imageshaow mx-auto" src="././orgAdmin/img/{{$bloodbank->logo}}"
              alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">{{$bloodbank->name}}</h5>
              <p class="card-text" style="height:118px; overflow:hidden; text-overflow:ellipsis;">{{$bloodbank->about_us}}</p>
              <a href='{{URL::asset("/bloodPartner/$bloodbank->id")}}' class="btn btn-primary">Read More</a>
            </div>
          </div>
          @else
          <div class="card pt-3  mb-xs-5 mx-auto mb-4 text-center boxshaow moreBox"
            style="width: 18rem;  display: none;">
            <img class="card-img-top rounded-circle imageshaow mx-auto" src="././orgAdmin/img/{{$bloodbank->logo}}"
              alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">{{$bloodbank->name}}</h5>
              <p class="card-text" style="height:118px; overflow:hidden; text-overflow:ellipsis;">{{$bloodbank->about_us}}</p>
              <a href='{{URL::asset("/bloodPartner/$bloodbank->id")}}' class="btn btn-primary">Read More</a>
            </div>
          </div>
          @endif
          @endforeach

  
         

    </section>
    <!-- end partner -->
  </div>




  <!-- End Content -->
  <!-- ------------------------------------- -->


  @endsection

@section('scrollingIcon')
  <li><a class="scroll-to-top" scroll-to-top-time="2000"><i class="fa fa-arrow-circle-up"></i></a></li>
@endsection
@section('scripts')
<script src="{{ url('/user/js/main.js') }}"></script>
<script src="{{ url('/user/js/main.js') }}"></script>
<script>
            
  $( document ).ready(function () {
      $(".moreBox").slice(0, 3).show();
      if ($(".boxshaow:hidden").length != 0) {
              $("#loadMore").show();
      }               
      $("#loadMore").on('click', function (e) {
          e.preventDefault();
          $(".moreBox:hidden").slice(0, 6).slideDown();
          if ($(".moreBox:hidden").length == 0) {
                  $("#loadMore").fadeOut('slow');
          }
      });
  });
</script>
@endsection