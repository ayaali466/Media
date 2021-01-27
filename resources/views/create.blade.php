@extends('layouts.app')
@section('title','Medical Care Home')
@section('styles')

@endsection

  @section('content')
<main class="page-content">
    <div class="container-fluid">
      <!-- page-content" -->
      <div class="container">
        <h2 class="text-center">add patient profile</h2>
        <hr>
        <!------------------------------- Add Department ------------------------------->

        <!------------------------------- Start Of Form ------------------------------->

        <form  action=" {{route('profile.store')}}" method="post" class="ValidationForm" enctype="multipart/form-data">
          @csrf 
          <div class="row">
            <!------------------------------- User Name ------------------------------->
            <div class=" col-md-6 offset-md-0 col-sm-8 offset-sm-2">
              <div class="form-group input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" style="width: 2.5rem;"> <i class="fa fa-user"></i> </span>
                </div>

                <input name="name" class="username form-control @error('name') is-invalid @enderror" placeholder="patient name" type="text" >
                   @error('name')
                <div class="alert alert-danger">
                {{$message}}
                </div>
                @enderror
              </div> <!-- form-group Name -->
              <div class="alert alert-danger custom-alert d-none">
                Error Message
              </div>
            </div>
               <!------------------------------- password ------------------------------->

            <div class=" col-md-6 offset-md-0 col-sm-8 offset-sm-2">
              <div class="form-group input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" style="width: 2.5rem;"> <i class="fa fa-user"></i> </span>
                </div>

                <input name="password" class="username form-control @error('password') is-invalid @enderror" placeholder="password" type="password" >
                @error('password')
                <div class="alert alert-danger">
                {{$message}}
                </div>
                @enderror
              </div> <!-- form-group Name -->
              <div class="alert alert-danger custom-alert d-none">
                Error Message
              </div>
            </div>
            <!-------------------------------national id ------------------------------->

            <div class=" col-md-6 offset-md-0 col-sm-8 offset-sm-2">
              <div class="form-group input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" style="width: 2.5rem;"> <i class="fa fa-user"></i> </span>
                </div>

                <input name="national_id" class="username form-control @error('national_id') is-invalid @enderror" placeholder="national ID" type="number" >
                @error('national_id')
                <div class="alert alert-danger">
                {{$message}}
                </div>
                @enderror
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
                <input name="email" class="email form-control @error('email') is-invalid @enderror" placeholder="Email" type="email" >
                @error('email')
                <div class="alert alert-danger">
                {{$message}}
                </div>
                @enderror
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
                <input name="birth_date" class="username form-control" placeholder="Birth Date" type="date" >
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
                  <option selected disabled  >gender</option>
                  <option value="1">Male</option>
                  <option value="2">Female</option>
                  
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
                <input name="address" class=" email form-control" placeholder="address" type="text">
             
             </div> <!-- form-group Name -->
              <div class="alert alert-danger custom-alert d-none">
                Error Message
              </div>
            </div>
            <!------------------------------- Blood type ------------------------------->
            <div class=" col-md-6 offset-md-0 col-sm-8 offset-sm-2">
              <div class="form-group">
                <select class="custom-select selected-governorate" name="blood_type_id">

                  <option selected disabled >blood type</option>
                  <option value="1">A+</option>
                  <option value="2">A-</option>
                  <option value="3">B+</option>
                  <option value="4">B-</option>
                  <option value="5">AB+</option>
                  <option value="6">AB-</option>
                  <option value="7">O+</option>
                  <option value="8">O-</option>
                </select>
              </div>
              <div class="alert alert-danger custom-alert d-none">
                Error Message
              </div>
            </div>
            <!------------------------------- Profile Image ------------------------------->
            <div class=" col-md-6 offset-md-0 col-sm-8 offset-sm-2">
              <div class="custom-file mb-3">
                <input type="file" class="image custom-file-input @error('photo') is-invalid @enderror" id="customFile" name="photo" >
                <label class="custom-file-label" for="customFile">Profile Image</label>
                @error('photo')
                <div class="alert alert-danger">
                {{$message}}
                </div>
                @enderror
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
                <input name="mobile_number" class="email form-control @error('mobile_number') is-invalid @enderror" placeholder="phone number" type="number" >
                @error('mobile_number')
                <div class="alert alert-danger">
                {{$message}}
                </div>
                @enderror
              </div> <!-- form-group Name -->
              <div class="alert alert-danger custom-alert d-none">
                Error Message
              </div>
            </div>
            <!------------------------------- national id image ------------------------------->


            <div class=" col-md-6 offset-md-0 col-sm-8 offset-sm-2">
              <div class="custom-file mb-3">
                <input type="file" class="image custom-file-input @error('national_id_image') is-invalid @enderror"
                 id="customFile" name="national_id_image">
                <label class="custom-file-label" for="customFile">national id  Image</label>
                @error('national_id_image')
                <div class="alert alert-danger">
                {{$message}}
                </div>
                @enderror
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
                <input name="emenrgency_number" class="email form-control @error('emenrgency_number') is-invalid @enderror" placeholder=" emergency phone number" type="number" >
                @error('emenrgency_number')
                <div class="alert alert-danger">
                {{$message}}
                </div>
                @enderror
              </div> <!-- form-group Name -->
              <div class="alert alert-danger custom-alert d-none">
                Error Message
              </div>
            </div>
            <!------------------------------- Submit Button ------------------------------->
            <div class="form-group offset-md-4 col-md-4">
              <!-- offset-3 col-6 -->
              <!-- disabled -->
              <button type="submit"  class="btn btn-signInUp btn-block">add</button>
            </div> <!-- form-group// -->
          </div>

        </form>
      


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