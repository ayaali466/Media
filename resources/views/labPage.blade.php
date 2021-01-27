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
            style="background-image: url('././orgAdmin/img/lab-slider-1.jpg');height: 500px;background-size: cover;">
            <div class="carousel-caption d-none d-md-block">
            </div>
          </div>
          <!-- Slide Two - Set the background image for this slide in the line below -->
          <div class="carousel-item"
            style="background-image: url('././orgAdmin/img/lab-slider-2.jpg');height: 500px;background-size: cover;">
            <div class="carousel-caption d-none d-md-block">
            </div>
          </div>
          <!-- Slide Three - Set the background image for this slide in the line below -->
          <div class="carousel-item"
            style="background-image: url('././orgAdmin/img/lab-slider-3.jpg');height: 500px;background-size: cover;">
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
      <h1 class="col-12  text-center text-muted py-5  display-4 font-weight-bold">Laboratories</h1>
      <p class="offset-1 col-10  text-justify">
        A laboratory is a facility that provides controlled conditions in which scientific or technological research,
        experiments, and measurement may be performed. Laboratory services are provided in a variety of settings:
        physicians offices, clinics, hospitals, and regional and national referral centers.
      </p>
    </div>

    <!-- start partners -->
    <section class="pb-5" id="partners">
      <div class="container">
        <div class="row justify-content-between">
          <div class="col-md-12">
            <h2 class=" bounceIn text-center text-muted py-5  display-4 font-weight-bold"><span>Parteners</span></h2>
          </div>
          <?php $count=0;?>
          @foreach($rlab as $one)
          <?php $count+=1;?>
          @if($count < 4 )
          <!-- Item1 -->
          <div class="card pt-3  mb-xs-5 mx-auto mb-4 text-center boxshow moreBox"
            style="width: 18rem;">
            <img class="card-img-top rounded-circle imageshaow mx-auto" src='{{URL::asset("/orgAdmin/img/$one->logo")}}' alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">{{$one->name}}</h5>
              <p  class="card-text" >{{substr($one->about_us, 0,50)}}....</p>
              <a href='{{URL::asset("/labPartner/$one->id")}}' class="btn btn-primary">Read More</a>
            </div>
          </div>
          @else
          <div class="card pt-3  mb-xs-5 mb-4 mx-auto text-center boxshaow moreBox"
            style="width: 18rem; display: none;">
            <img class="card-img-top rounded-circle imageshaow mx-auto" src='{{URL::asset("/orgAdmin/img/$one->logo")}}' alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">{{$one->name}}</h5>
              <p  class="card-text" >{{substr($one->about_us, 0,50)}}....</p>
              <a href='{{URL::asset("/labPartner/$one->id")}}' class="btn btn-primary">Read More</a>
            </div>
          </div>
        
          @endif
          @endforeach


        </div>
      </div>
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
  <script src="{{ url('/user/js/seemore.js') }}"></script>
@endsection