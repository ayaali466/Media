@extends('layouts.app')
@section('title','Medical Care Home')
@section('styles')
<link rel="stylesheet" href="{{ url('/user/css/patient_profile.css') }}">
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


    <!--start patient profile-->

    <div class="container mx-auto py-5">
    <div class="row">
      <div class="col-lg-12 col-md-12 ">
        <div class="pt-4 px-4">
          <h2 class="text-center">Patient Profile</h2>
        </div>
      </div>
    </div> 
    <br>
    <div class="row">
      <div class="col-lg-4 col-md-12 ">
        <div class="card flex-row flex-wrap patient_card1">
          <div class="card-header">
 
          @foreach($users as $users)

            <img src='{{ URL::asset("/user/img/$users->photo") }}' class="image-cover2" alt="patient photo">
          </div>
          <h4 class="text-center my-3 mx-auto">{{$users->name}}</h4>
        </div>
      </div>
      <div class="col-lg-4   col-md-12 ">
        <div class="card text-center">
          <div class="card-body">
            <h5 class="card-title card-header">Gender</h5>
            <p class="card-text">   
               @if ($users->gender == 0)
                Male
               @elseif ($users->gender == 1)
                Female
                @endif</p>
            <h5 class="card-title card-header">Birth date</h5>
            <p class="card-text">{{$users->birth_date}}</p>
            <h5 class="card-title card-header">Email</h5>
            <p class="card-text">{{$users->email }}</p>
            <h5 class="card-title card-header">mobile number</h5>
            <p class="card-text">{{$users->mobile_number }}</p>
            <h5 class="card-title card-header">emenrgency number</h5>
            <p class="card-text">{{$users->emenrgency_number }}</p>
            <a href="{{route('profile.edit',$users->national_id)}}" class="btn btn-primary w-50">Edit</a>
          </div>
        </div>
      </div>
      @endforeach

      <div class="col-lg-4   col-md-12 ">
        <div class="card text-center">
          <div class="card-body">
            <h5 class=" card-title card-header">blood type</h5>
            <p class="card-text"> 

               @foreach($usersBT as $usersBT)
            {{$usersBT->blood_type }}
            @endforeach</p>

            <div class="dropdown mb-3">
              <span class="btn btn-primary toggle w-100">Diseases</span>
              <ul class="dropdown-menu-part list-group">

              @foreach($usersDI as $usersDI )

                <li class="list-group-item">  {{$usersDI->name }}</li>
             @endforeach

              </ul>
            </div>

            <div class="dropdown mb-3">
              <span class="btn btn-primary toggle w-100">Treatments</span>
              <ul class="dropdown-menu-part list-group">

              @foreach($usersTR as $usersTR )

             <li class="list-group-item">  {{$usersTR->name }}</li>
             @endforeach
              </ul>
            </div>
            <div class="dropdown mb-3">
              <span class="btn btn-primary toggle w-100">Medical Reports</span>
              <ul class="dropdown-menu-part list-group">

                @foreach($usersMR as $usersMR )

             <li class="list-group-item">  {{$usersMR->report_name}}</li>
              @endforeach
              </ul>
            </div>

            <form action="" method="post" enctype="multipart/form-data">
            @csrf 
              <div class="custom-file text-left">
                <input type="file" class="image custom-file-input" id="customFile" name="profileImage">
                <label class="custom-file-label" for="customFile">Upload new report</label>
              </div>
              <!-- </div> -->
          </div>
        </div>
      </div>
    </div>
  </div>
 
  <!--end profile-->
  @endsection

@section('scrollingIcon')
  <li><a class="scroll-to-top" scroll-to-top-time="2000"><i class="fa fa-arrow-circle-up"></i></a></li>
@endsection
@section('scripts')
  <script src="{{ url('/user/js/patient_profile.js') }}"></script>
@endsection