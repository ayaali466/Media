@extends('layouts.app')
@section('title','Patient Profile')
@section('styles')
@endsection

  @section('content')
 <main class="page-content">
    <div class="container-fluid">
      <!-- page-content" -->
      <div class="container">
        <h2 class="text-center">edit patient profile</h2>
        <hr>
        <!------------------------------- Add Department ------------------------------->
 
        <!------------------------------- Start Of Form ------------------------------->
        @foreach($userinfo as $userinfo)

        <form  action="{{route('pprofile.update',$userinfo->national_id)}}" 
        method="POST" class="ValidationForm" enctype="multipart/form-data">
          @csrf 
          @method("PUT")
          <div class="row">
            <!------------------------------- User Name ------------------------------->
            <div class=" col-md-6 offset-md-0 col-sm-8 offset-sm-2">
              <div class="form-group input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" style="width: 2.5rem;"> <i class="fa fa-user"></i> </span>
                </div>

                <input name="name" class="username form-control" placeholder="patient name" type="text" 
                value="{{isset($userinfo)?$userinfo->name: ''}}">

              </div> <!-- form-group Name -->
              <div class="alert alert-danger custom-alert d-none">
                Error Message
              </div>
            </div>
            <!------------------------------- Email ------------------------------->
            <div class=" col-md-6 offset-md-0 col-sm-8 offset-sm-2">
              <div class="form-group input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" style="width: 2.5rem;"> <i class="fa fa-envelope"></i> </span>
                </div>
                <input name="email" class="email form-control" placeholder="Email" type="email" 
                value="{{isset($userinfo)?$userinfo->email: ''}}">
              </div> <!-- form-group Name -->
              <div class="alert alert-danger custom-alert d-none">
                Error Message
              </div>
            </div>
            <!------------------------------- User Birth date ------------------------------->
            <div class=" col-md-6 offset-md-0 col-sm-8 offset-sm-2">
              <div class="form-group input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" style="width: 2.5rem;"> <i class="fa fa-user"></i> </span>
                </div>
                <input name="BD" class="username form-control" placeholder="Birth Date" type="date" 
                 value="{{isset($userinfo)?$userinfo->birth_date: ''}}">
              </div> <!-- form-group Name -->
              <div class="alert alert-danger custom-alert d-none">
                Error Message
              </div>
            </div>
            <!------------------------------- Gender ------------------------------->
            <div class=" col-md-6 offset-md-0 col-sm-8 offset-sm-2">
              <div class="form-group  input-group" >
                <div class="input-group-prepend">
                  <span class="input-group-text" style="width: 2.5rem;"> <i class="fa fa-user"></i>  </span>
                </div>
                <select class="custom-select selected-governorate" name="gender">
                  <option selected disabled  >
                      <?php
                      if(isset($userinfo->gender) == 1){echo ("Male") ;}
                      elseif(isset($userinfo->gender) == 2) {echo ("Female") ;}
                      else{echo ("gender") ;}
                      ?>
                  </option>
                  <option <?php if(isset($userinfo->gender) == 1){echo ("selected") ;} ?> value="1">Male</option>
                  <option <?php if(isset($userinfo->gender) == 0){echo ("selected") ;} ?> value="2">Female</option>
                
                </select>
              </div>
              <div class="alert alert-danger custom-alert d-none">
                Error Message
              </div>
            </div>
            <!-------------------------------address ------------------------------->
            <div class=" col-md-6 offset-md-0 col-sm-8 offset-sm-2">
              <div class="form-group input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" style="width: 2.5rem;"> <i class="fa fa-envelope"></i> </span>
                </div>
                <input name="address" class="email form-control" placeholder="address" type="text"
                value="{{isset($userinfo)?$userinfo->address: ''}}">
              </div> <!-- form-group Name -->
              <div class="alert alert-danger custom-alert d-none">
                Error Message
              </div>
            </div>
            <!------------------------------- Blood type ------------------------------->
            <div class=" col-md-6 offset-md-0 col-sm-8 offset-sm-2">
              <div class="form-group">
              <select class="custom-select selected-governorate" name="blood_type_id">
                @foreach($All_bloods as $one)
                @if($userinfo->blood_type_id == $one->id)
                <option value="{{$one->id}}" selected>{{$one->blood_type}}</option>
                  @else
                  <option value="{{$one->id}}">{{$one->blood_type}}</option>
                  @endif
                @endforeach
                </select>
              </div>
              <div class="alert alert-danger custom-alert d-none">
                Error Message
              </div>
            </div>
            <!------------------------------- Profile Image ------------------------------->
            <div class=" col-md-6 offset-md-0 col-sm-8 offset-sm-2">
              <div class="custom-file mb-3">
                <input type="file" class="image custom-file-input" id="customFile" name="photo">
                <label class="custom-file-label" for="customFile">Profile Image</label>
              </div>
              <div class="alert alert-danger custom-alert d-none">
                Error Message
              </div>
            </div>
             <!------------------------------- Phone Number ------------------------------->
             <div class=" col-md-6 offset-md-0 col-sm-8 offset-sm-2">
              <div class="form-group input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" style="width: 2.5rem;"> <i class="fa fa-envelope"></i> </span>
                </div>
                <input name="phone" class="email form-control" placeholder="phone number" type="number" 
                value="{{isset($userinfo)?$userinfo->mobile_number : ''}}">
              </div> <!-- form-group Name -->
              <div class="alert alert-danger custom-alert d-none">
                Error Message
              </div>
            </div>
            <!------------------------------- national id image ------------------------------->


            <div class=" col-md-6 offset-md-0 col-sm-8 offset-sm-2">
              <div class="custom-file mb-3">
                <input type="file" class="image custom-file-input" id="customFile" name="national_id_image">
                <label class="custom-file-label" for="customFile">national id  Image</label>
              </div>
              <div class="alert alert-danger custom-alert d-none">
                Error Message
              </div>
            </div>
            <!-------------------------------emergency phone number ------------------------------->


            <div class=" col-md-6 offset-md-0 col-sm-8 offset-sm-2">
              <div class="form-group input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" style="width: 2.5rem;"> <i class="fa fa-envelope"></i> </span>
                </div>
                <input name="Ephone" class="email form-control" placeholder="phone number" type="number" 
                value="{{isset($userinfo)?$userinfo->emenrgency_number : ''}}">
              </div> <!-- form-group Name -->
              <div class="alert alert-danger custom-alert d-none">
                Error Message
              </div>
            </div>
            <!------------------------------- Submit Button ------------------------------->
            <div class="form-group offset-md-4 col-md-4">
              <!-- offset-3 col-6 -->
              <!-- disabled -->
              <button type="submit" name="submit" class="btn btn-signInUp btn-block">edit</button>
            </div> <!-- form-group// -->
          </div>

        </form>
        @endforeach


        <!------------------------------- End Of Form ------------------------------->
      </div>
    </div>

  <!--end profile-->
  @endsection

@section('scrollingIcon')
  <li><a class="scroll-to-top" scroll-to-top-time="2000"><i class="fa fa-arrow-circle-up"></i></a></li>
@endsection
@section('scripts')

@endsection