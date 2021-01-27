@extends('layouts.app')
@section('title','Medical Care Home')
@section('styles')
<link rel="stylesheet" href="{{ url('/user/css/stars.css') }}">
<style>
  .image-cover2 {
        width: 300px;
        height: 300px;
        border-radius: 50%;
        object-fit: cover;
    }
</style>
@endsection

  @section('content')


 <!-- Start Content -->
   <!--start profile -->
   <div class="container mx-auto">
      <div class="row">
         <div class="col-lg-12 col-md-12 ">
            <div class="pt-4 px-4">
               <h2 class="text-center">Doctor Profile</h2>
            </div>
         </div>
      </div>
      <br>
      <div class="row">
         <div class="col-lg-4   col-md-12 ">
            <div class="card flex-row flex-wrap patient_card1">
               <div class="card-header">
              @foreach($doctors as $doctors)
                  <img src=' {{ URL::asset("/orgAdmin/img/$doctors->photo") }}' class="image-cover2" alt="doctor photo">
               </div>
               <h4 class="text-center my-3 mx-auto">{{$doctors->name}}</h4>
            </div>
         </div>

         <div class="col-lg-4 col-md-12 ">

            <div class="card text-center">
               <!-- <div class="card-header border-0">
                  <h4>information about doctor</h4>
               </div> -->
               <div class="card-body">
                  <h5 class="card-title card-header">Title</h5>
                  <p class="card-text">{{$doctors->title}}</p>
                  <h5 class="card-title card-header">specialist</h5>
                  <p class="card-text">{{$doctors->description}}</p>
                  <h5 class="card-title card-header">Rate</h5>
                  <p class="card-text pt-2">
                     <div class="Stars  ml-3 mb-3" style="--ratingStars: {{$doctors->reviews_sum/$doctors->counter_reviews}};"
                        aria-label="Rating of this product is 2.5 out of 5."></div>
                        <!--  -->
                  </p>
               </div>
            </div>
         </div>

         <div class="col-lg-4   col-md-12 ">

            <div class="card text-center">
               <div class="card-header border-0">
                  <h4>booking information</h4>
               </div>
               <div class="card-body">
                  <h5 class="card-title card-header">fees</h5>
                  <p class="card-text">{{$doctors->	fees}} <i class="fas fa-money-bill-wave"></i> </p>
        @endforeach
                  <h5 class="card-title card-header">available days</h5>
                  <table class="table">
                     <thead>
                        <tr>
                           <th scope="col">Day</th>
                           <th scope="col">From</th>
                           <th scope="col">To</th>
                        </tr>
                     </thead>
                     <tbody>
       @foreach($doctorsDE as $doctorsDE)

                        <tr>
                           <td>{{$doctorsDE -> day_name}}</td>
                           <td>{{$doctorsDE -> start_time}}</td>
                           <td>{{$doctorsDE -> end_time}}</td>
                        </tr>
         @endforeach

                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!--end profile -->

   <!-- End Content -->
   <!-- ------------------------------------- -->
   <br>
   <br>

   <!-- ------------------------------------- -->

  @endsection

  @section('scrollingIcon')
  <li><a class="scroll-to-top" scroll-to-top-time="2000"><i class="fa fa-arrow-circle-up"></i></a></li>
@endsection
@section('scripts')

@endsection