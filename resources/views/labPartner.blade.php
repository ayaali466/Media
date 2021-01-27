@extends('layouts.app')
@section('title','Laboratory')
@section('styles')
<link rel="stylesheet" href="{{ url('/user/css/mainPartner.css') }}">
@endsection

@section('content')
 <!-- Start Content -->
 <div class="container-fluid pt-3 pb-4 mb-3">


      <!-- <div class="Separt container-fluid"> -->
      <div class="row justify-content-between mt-3">
         <aside class="col-lg-3 col-md-4 mb-3 mb-md-0">
            <div class="p-3 h-100">
            <div class="row col-12 mb-3 justify-content-center">
            <img style="height:150px; width:250px" src='{{URL::asset("/orgAdmin/img/$lab->logo")}}' alt="">
            </div>
               <h4 class="text-center mb-2"><i class="fas fa-search-location"></i> FIND US</h4>
               <div class="infodiv">
                  <h6><i class="mr-2 mb-2 fas fa-map-marker-alt"></i>OUR Adress</h6>
                  <p class="ml-3"><a href="https://goo.gl/maps/25dQ7oEKMeFS7KdM8">{{$lab->address}}</a></p>
               </div>
               <div class="infodiv">
                  <h6><i class="mr-2 mb-2 fas fa-phone"></i> Call Us</h6>
                  <p class="ml-3">{{$lab->phone}}</p>
               </div> 
               <div class="infodiv">
                  <h6><i class="mr-2 mb-2 fas fa-envelope-open-text"></i> Email</h6>
                  <p class="ml-3">{{$lab->email}}</p>
               </div>
               <!-- <div class="infodiv">
                  <h6><i class="mr-2 mb-2 fas fa-star-half-alt"></i> Rate</h6>
                  <div class="Stars  ml-3 mb-3" style="--ratingStars: 2.5;"
                     aria-label="Rating of this product is 2.5 out of 5.">
                  </div>
               </div> -->
               <div class="infodiv">
                  <h6><i class="mr-2 mb-2 fas fa-folder"></i>online Result</h6>
                  <p class="text-center text-justify">You can getyour results online you will receive an e-mail with
                     your results</p>
               </div>
               <div class="infodiv">
                  <h6><i class="mr-2 mb-2 far fa-question-circle"></i>Why {{$lab->name}}</h6>
                  <P class="text-justify">{{substr($lab->about_us, 0,250)}}....</P>
               </div>
            </div>
         </aside>
         <section class="col-md-8">
            <article class="secdivbgcolor1 p-3">
               <div class="secdiv mb-3 text-center">
                  <img style="height:360px; width:950px" src='{{URL::asset("/orgAdmin/img/$lab->profile_image")}}' alt="..." class="img-thumbnail">
                  <!--<div class="secdivp"><p class="text-center ">online appointment scheduling is available</p></div>-->
               </div>
               <h3>{{$lab->name}}</h3>
               <p class="text-justify p-0 p-md-3">{{$lab->about_us}}</p>
            </article>
            <article class="secdivbgcolor2 p-3">
               <h6 class="text-center mb-3">Our Services</h6>
               <div class="table-responsive-xs  text-justify">
                  <table class="table text-center">
                     <tr>
                        <th>Patien Services</th>
                        <th>Physician Services</th>
                        <th>Corporate Services</th>
                     </tr>
                     </thead>
                     <tbody>
                        <tr>
                           <td>Pre-testing precautions</td>
                           <td>Home visit</td>
                           <td>Diagnostic profile</td>
                        </tr>
                        <tr>
                           <td>Critical value</td>
                           <td>Test menu</td>
                           <td>Medical newsletter</td>
                        </tr>
                        <tr>
                           <td>Pre-Employment test</td>
                           <td>Drivers packages</td>
                           <td>Drivers packages</td>
                        </tr>
                  </table>
               </div>
            </article>
         </section>
      </div> <!-- di aflet div row eli gwa div Separt-->
      <!-- </div> -->
      <!-- di aflet div Separt-->
   </div>
   <!--di l all div container -->
   <!--end content -->
   <!-- ------------------------------------- -->
   @endsection

@section('scrollingIcon')
  <li><a class="scroll-to-top" scroll-to-top-time="2000"><i class="fa fa-arrow-circle-up"></i></a></li>
@endsection
@section('scripts')
  <script src="{{ url('/user/js/main.js') }}"></script>
@endsection