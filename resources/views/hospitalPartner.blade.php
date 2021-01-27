@extends('layouts.app')
@section('title','Hospital')
@section('styles')
<link rel="stylesheet" href="{{ url('/user/css/mainPartner.css') }}">
@endsection

@section('content')
   <!-- Start Content -->
   

      <!-- <div class="Separt container-fluid"> -->
      <div class="row justify-content-between my-5 mx-0">
         <aside class="col-lg-3 col-md-4 mb-3 mb-md-0">
            <div class="p-3 h-100">
               <div class="row col-12 mb-3 justify-content-center">
                  <img style="height:150px; width:250px" src='{{URL::asset("/orgAdmin/img/$hospital->logo")}}' alt="">
               </div>
               <h4 class="text-center"><i class="fas fa-search-location"></i>FIND US</h4>
               <div class="infodiv">
                  <h6><i class="mr-2 fas fa-map-marker-alt"></i>OUR Adress</h6>
                  <p class="ml-3">{{$hospital->address}}</p>
               </div>
               <div class="infodiv">
                  <h6><i class="mr-2 fas fa-phone"></i>Call Us</h6>
                  <p class="ml-3">{{$hospital->phone}}</p>
               </div>
               <div class="infodiv">
                  <h6><i class="mr-2 fas fa-envelope-open-text"></i>Email</h6>
                  <p class="ml-3">{{$hospital->email}}</p>
               </div>
               <!-- <div class="infodiv">
                  <h6><i class="mr-2 fas fa-star-half-alt"></i>Rate</h6>
                  <div class="Stars ml-3 mb-3" style="--ratingStars: 2.5;"
                     aria-label="Rating of this product is 2.5 out of 5.">
                  </div>
               </div> -->
               
               <?php if(!empty($departments[0])) {?>
                  <div class="infodiv">
                  <h6><i class="mr-2 fas fa-building"></i>Our Departments</h6>
                     <ul>
                     @foreach($departments as $department)
                        <li>{{$department->name}}</li>
                     @endforeach
                     </ul>
                  </div>
               <?php } ?>
               @isset($incubator)
               <div class="infodiv">
                  <h6><i class="mr-2 fas fa-baby"></i>Incubators</h6>
                  <ul>
                     <li>Number of Units: {{$incubator->num_of_units}}</li>
                     <li>Available Number: {{$incubator->Available_units}}</li>
                     
                  </ul>
               </div>
               @endisset
               @isset($intensive)
               <div class="infodiv">
                  <h6><i class="fas fa-procedures"></i> Intensive Care</h6>
                  <ul>
                  <li>Number of Units: {{$intensive->num_of_rooms}}</li>
                     <li>Available Number: {{$intensive->Available_rooms}}</li>
                  </ul>
               </div>
               @endisset
            </div>
         </aside>
         <section class="col-md-8">
            <article class="secdivbgcolor1  p-3">
               <div class="secdiv mt-3 mb-3 text-center">
                  <img style="height:360px; width:950px" src='{{URL::asset("/orgAdmin/img/$hospital->profile_image")}}' alt="..." class="img-thumbnail">
                  <!--<div class="secdivp"><p class="text-center ">online appointment scheduling is available</p></div>-->
               </div>
               <h3>{{$hospital->name}}</h3>
               <p class="text-justify p-0 p-md-3">{{$hospital->about_us}}
               </p>
            </article>
            @if($blood || $lab || $center)
            <article class="secdivbgcolor2">
               <h6 class="text-center mb-3">We also cooperate with</h6>
               <div class="secinfo d-flex row justify-content-center align-items-center">
                  @if($blood)
                     <div class="dep col-md-4 text-center mb-2 mb-md-0">
                        <!--Add text-center-->
                        <a href='{{URL::asset("/bloodPartner/$blood->id")}}'><img src='{{URL::asset("/orgAdmin/img/$blood->logo")}}' alt="Blood Bank Logo" class="img-thumbnail"
                           style="width: 150px; height: 150px;"></a>
                     </div>
                  @endif
                  @if($lab)
                     <div class="dep col-md-4 text-center mb-2 mb-md-0">
                        <!--Add text-center-->
                        <a href='{{URL::asset("/labPartner/$lab->id")}}'><img src='{{URL::asset("/orgAdmin/img/$lab->logo")}}' alt="Laboratory Logo" class="img-thumbnail"
                           style="width: 150px; height: 150px;"></a>
                     </div>
                  @endif
                  @if($center)
                     <div class="dep col-md-4 text-center mb-2 mb-md-0">
                        <!--Add text-center-->
                        <a href='{{URL::asset("/centerPartner/$center->id")}}'><img src='{{URL::asset("/orgAdmin/img/$center->logo")}}' alt="Center Logo" class="img-thumbnail"
                           style="width: 150px; height: 150px;"></a>
                     </div>
                  @endif
               </div>
            </article>
            @endif
         </section>
      </div> <!-- di aflet div row eli gwa div Separt-->
      <!-- </div> -->
      <!-- di aflet div Separt-->
   <!--di l all div container -->
   <!-- End Content -->
   <!-- ------------------------------------- -->
   @endsection

   @section('scrollingIcon')
  <li><a class="scroll-to-top" scroll-to-top-time="2000"><i class="fa fa-arrow-circle-up"></i></a></li>
@endsection
@section('scripts')

@endsection