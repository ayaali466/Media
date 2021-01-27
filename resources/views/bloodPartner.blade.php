@extends('layouts.app')
@section('title','Medical Care Home')
@section('styles')
<link rel="stylesheet" href="{{ url('/user/css/mainPartner.css') }}">
@endsection

@section('content')




<!-- Start Content -->
<div class="all container-fluid pt-3 pb-4 mb-3">
      <!-- <div class="Separt container-fluid"> -->
      <div class="row justify-content-between mt-3">
         <aside class="col-lg-3 col-md-4 mb-3 mb-md-0">
            <div class="p-3 h-100">
            <div class="row col-12 col-md-12 col-xs-12 justify-content-center">
               <img style="height:150px; width:200px" src='{{URL::asset("/orgAdmin/img/$bloodbank->logo")}}' alt="">
            </div>
               <h4 class="text-center"><i class="fas fa-search-location"></i>FIND US</h4>
               <div class="infodiv">
                  <h6><i class="mr-2 fas fa-map-marker-alt"></i>OUR Adress (Headquarters)</h6>
                  <p class="ml-3">{{$bloodbank->address}}</p>
               </div>
               <div class="infodiv">
                  <h6><i class="mr-2 fas fa-phone"></i>Call Us</h6>
                  <p class="ml-3">{{$bloodbank->phone}}</p>
               </div>
               <div class="infodiv">
                  <h6><i class="mr-2 fas fa-envelope-open-text"></i>Email</h6>
                  <p class="ml-3">{{$bloodbank->email}}</p>
               </div>
               <!-- <div class="infodiv">
                  <h6><i class="mr-2 fas fa-star-half-alt"></i>Rate</h6>
                  <div class="Stars  ml-3 mb-3" style="--ratingStars: 2.5;"
                     aria-label="Rating of this product is 2.5 out of 5.">
                  </div>
               </div> -->
               
               <div class="infodiv">
                  <h6><i class="mr-2 fab fa-discourse"></i>COURSES</h6>
                  <ul>
                     <li>First Aid</li>
                     <li>Schoolchildren</li>
                     <li>International Humanitarian Law</li>
                     <li>IC3</li>
                  </ul>
               </div>
            </div>
         </aside>
         <section class="col-md-8">
            <article class="secdivbgcolor1  p-3">
               <div class="secdiv mt-3 mb-3 text-center">
                  <img style="height:360px; width:950px" src='{{URL::asset("/orgAdmin/img/$bloodbank->profile_image")}}' alt="..." class="img-thumbnail">
                  <!--<div class="secdivp"><p class="text-center ">online appointment scheduling is available</p></div>-->
               </div>
               <h3>{{$bloodbank->name}}</h3>
               <p class="text-justify p-0 p-md-3">{{$bloodbank->about_us}}</p>
            </article>
            <article>
            <div class="secdivbgcolor2 text-center">
                  <h6><i class="mr-2 fas fa-code-branch"></i>Availability of Blood Bags</h6>
                  
                  <div class="row mx-auto ">
                  <div class="col-md-3">
                  <table class="table w-100 ">
                        <thead>
                        <?php $count=0;?>
                        @foreach($bloodbag as $bloodbag)
                        <?php $count+=1;?>
                        <tr>
                           <th>{{$bloodbag->blood_type}}</th>
                           <th><?= ($bloodbag->number_of_cases > 0)? '<i class="fas fa-check text-success"></i>':'<i class="fas fa-times text-danger"></i>' ?></th>
                        </tr>
                        @if(!($count % 2))
                        </thead>
                        </table>
                        </div>
                        <div class="col-md-3">
                        <table class="table w-100">
                        <thead>
                        @endif
                        @endforeach   
                        
                     </table>

               </div>
            </article>
         </section>
      </div> <!-- di aflet div row eli gwa div Separt-->
      <!-- </div> -->
      <!-- di aflet div Separt-->
   </div>
   <!--di l all div container -->
   <!-- End Content -->
   <!-- ------------------------------------- -->

   @endsection
   @section('scrollingIcon')
  <li><a class="scroll-to-top" scroll-to-top-time="2000"><i class="fa fa-arrow-circle-up"></i></a></li>
@endsection
@section('scripts')
  <script src="{{ url('/user/js/main.js') }}"></script>
@endsection
