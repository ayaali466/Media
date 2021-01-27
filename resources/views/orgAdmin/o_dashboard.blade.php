@extends('orgAdmin.layouts.o_app')
@section('title','Organization Admin Dashboard')
@section('styles')
<style>
  .information .fas, .information .far, .information .fab {
    color: #6c757d;
  }
</style>
@endsection
@section('content')
<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Organization Admin Dashboard</div>

                <div class="card-body">
                    

                    You are logged in as an organization Admin
                </div>
            </div>
        </div>
    </div>
</div> -->
                    @if (isset($status))
                        <div class="alert alert-success" role="alert">
                            {{ $status }}
                        </div>
                    @endif
<!-- page-content" -->
        <div class="container text-center">
          <h2 class="text-center">{{ $hospital -> name }}</h2>
          <hr>
          <p class="text-justify container mb-5">
            @if(!empty($hospital -> about_us))
              {{ $hospital -> about_us}}
            @else
              {{ "About Us Section Not Added Please Fill it" }}
            @endif
            </p>
            @if(empty($hospital -> profile_image))
            <img class="img-fluid img-thumbnail" src='{{ url("/orgAdmin/img/blood_bank-2.png") }}' alt="Profile Image">
            @else
              <img class="img-fluid img-thumbnail" src='{{ url("/orgAdmin/img/$hospital->profile_image") }}' alt="Profile Image">
             @endif           
        </div>
        <div class="container mt-5">
          <div class="row">
            <div id="departments" class="col-sm-12 col-md-6">
                <h2>departments</h2>
                <ul>
                @if(!empty($departments))
                  @foreach($departments as $department)
                  <li>{{ $department -> name }}</li>
                  @endforeach
                @else
                  {{"No Departments Added"}}
                @endif
                </ul>
            
              </div>

              <div id="departments" class="col-sm-12 col-md-6">
                <h2>Laboratories</h2>
                <ul>
                @if(!empty($laboratories))
                  @foreach($laboratories as $laboratory)
                  <li>{{ $laboratory -> name }}</li>
                  @endforeach
                  @else
                  {{"No Laboratories Added"}}
                @endif
                </ul>
            
              </div>

              <div id="departments" class="col-sm-12 col-md-6">
                <h2>Centers</h2>
                <ul>
                @if(!empty($centers))
                  @foreach($centers as $laboratory)
                  <li>{{ $laboratory -> name }}</li>
                  @endforeach
                @else
                  {{"No Centers Added"}}
                @endif
                </ul>
            
              </div>

              <div id="departments" class="col-sm-12 col-md-6">
                <h2>Blood Banks</h2>
                <ul>
                @if(!empty($BloodBanks))
                  @foreach($BloodBanks as $BloodBank)
                  <li>{{ $BloodBank -> name }}</li>
                  @endforeach
                @else
                  {{"No Blood Banks Added"}}
                @endif
                </ul>
            
              </div>

          </div>
          <hr>
          <div class="row justify-content-center">
            <div id="departments" class="col-sm-12 col-md-6">
              <h2>Incubater Department</h2>
                <?php 
                  if(isset($incubater) && !empty($incubater)) {
                ?>
                    <p>All Incubater Units: {{ $incubater->num_of_units }}</p>
                    <p>Available Incubater Units: {{ $incubater->Available_units }}</p>
                <?php
                  }
                  else {
                    echo "Incubater Department Not Edited Please edit it";
                  }
                ?>
            </div>

            <div id="departments" class="col-sm-12 col-md-6">
              <h2>Intensive Care Department</h2>
                <?php 
                  if(isset($intensiveCare) && !empty($intensiveCare)) {
                ?>
                  
                    <p>All Intensive Care Rooms: {{ $intensiveCare->num_of_rooms }}</p>
                    <p>Available Intensive Care Rooms: {{ $intensiveCare->Available_rooms }}</p>
                  

                <?php
                  }
                  else {
                    echo "Intensive Care Department Not Edited Please edit it";
                  }
                ?>
              </div>
          </div>
          <hr>
          <div class="information text-justify container">
              <div class="row">
                <p class="col-md-6"><i class="fas fa-envelope"></i> : {{ $hospital -> email }} </p>
                <p class="col-md-6"><i class="far fa-address-card"></i> : @if(!empty($hospital -> address)){{ $hospital -> address }} @else {{ "Addess Not specified please edit it"}} @endif</p>
                <p class="col-md-6"><i class="fas fa-street-view"></i> : Gonernorate :  @if(!empty($governorate)){{ $governorate }} @else {{ " Not Selected Yet" }} @endif, Ciy:  @if(!empty($city )){{ $city }} @else {{ "Not Selected Yet" }}@endif</p>
                <p class="col-md-6"><i class="fas fa-phone"></i> : {{ $hospital -> phone }} </p>
                
                <p class="col-md-6"><i class="fas fa-globe"></i> : 
                @if(!empty($social_links -> website)) {{ $social_links -> website }}@else {{ "Your Website URL not specified yet" }} @endif </p>
                <p class="col-md-6"><i class="fas fa-map-marker-alt"></i> : 
                @if(!empty($social_links -> google_map)){{ $social_links -> google_map }}@else {{ "Your Google Map URL not specified yet" }} @endif </p>
                <p class="col-md-6"><i class="fab fa-instagram"></i> : 
                @if(!empty($social_links -> instagram)){{ $social_links -> instagram }}@else {{ "Your Instagram URL not specified yet" }} @endif </p>
                <p class="col-md-6"><i class="fab fa-facebook-f"></i> : 
                @if(!empty($social_links -> facebook)){{ $social_links -> facebook }}@else {{ "Your Facebook URL not specified yet" }} @endif </p>
                <p class="col-md-6"><i class="fab fa-twitter"></i> : 
                @if(!empty($social_links -> twitter)){{ $social_links -> twitter }}@else {{ "Your Twitter URL not specified yet" }} @endif </p>
                <p class="col-md-6"><i class="fab fa-youtube"></i> : 
                @if(!empty($social_links -> youtube)){{ $social_links -> youtube }}@else {{ "Your Youtube URL not specified yet" }} @endif </p>
              </div>
          </div>
      </div>

      <!-- End page-content -->
@endsection
