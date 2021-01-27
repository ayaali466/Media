@extends('orgAdmin.layouts.o_app')
@section('title','Edit Profile')
@section('styles')
<link rel="stylesheet" href="{{ url('/css/form.css') }}">
@endsection

@section('content')

        @if($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @else
          @isset($status)
            <div class="alert alert-success">
                {{ $status }}
            </div>
          @endisset
        @endif


      <!-- page-content" -->
      <div class="container">
          <h2 class="text-center">Edit Profile</h2>
          <hr>
          <!------------------------------- Edit Department ------------------------------->

          <!------------------------------- Start Of Form ------------------------------->
          <form method="POST" action="{{route('editProfile')}}" class="ValidationForm" enctype="multipart/form-data" novalidate>
            @csrf
            <div class="row">
              <!------------------------------- User Name ------------------------------->
              <div class=" col-md-6 offset-md-0 col-sm-8 offset-sm-2">
                <div class="form-group input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 2.5rem;"> <i class="far fa-hospital"></i> </span>
                  </div>
                  <input name="name" class="username form-control" placeholder="Hospital name" type="text" value="{{$hospital -> name}}">
                </div> <!-- form-group Name -->
                <div class="alert alert-danger custom-alert ">
                  
                </div>
              </div>

              <!------------------------------- Phone Number ------------------------------->
              <div class=" col-md-6 offset-md-0 col-sm-8 offset-sm-2">
                <div class="form-group input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-phone"></i> </span>
                  </div>
                  <select class="custom-select selected-phone-code" style="max-width: 80px;" name="pre_phone_code">
                    <option disabled selected value="">Code</option>
                    <option value="hotline" <?= (strlen($hospital->phone == 5 ))? 'selected':'' ?> >Hotline</option>
                    <option value="02" <?= (strlen(substr($hospital->phone,0,2) == "02" ))? 'selected':'' ?>>02</option>
                    
                    <option value="010" <?= (strlen(substr($hospital->phone,0,3) == "010" ))? 'selected':'' ?>>010</option>
                    <option value="011" <?= (strlen(substr($hospital->phone,0,3) == "011" ))? 'selected':'' ?>>011</option>
                    <option value="012" <?= (strlen(substr($hospital->phone,0,3) == "012" ))? 'selected':'' ?>>012</option>
                    <option value="015" <?= (strlen(substr($hospital->phone,0,3) == "015" ))? 'selected':'' ?>>015</option>
                  </select>
                  <input name="phone" class="phone-number form-control" placeholder="Phone number" type="text" 
                  value="<?= (strlen($hospital->phone == 5 ))? $hospital->phone : substr($hospital->phone,-8) ?>">
                </div>
                <div class="alert alert-danger custom-alert">
                  
                </div>
              </div>

              <!------------------------------- About Us ------------------------------->
              <div class="col-sm-12">
                <div class="form-group input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 2.5rem;"> <i class="fas fa-align-left"></i> </span>
                  </div>
                  <textarea name="about_us" class="about_us form-control" rows="4" placeholder="Description" spellcheck="false">{{$hospital-> about_us}}</textarea>
                </div> <!-- form-group Name -->
                <div class="alert alert-danger custom-alert">
                  
                </div>
              </div>

              <!------------------------------- Submit Button ------------------------------->
              <div class="form-group offset-md-4 col-md-4">
                <!-- offset-3 col-6 -->
                <!-- disabled -->
                <button type="submit" name="submit" class="btn btn-primary btn-block">Edit</button>
              </div> <!-- form-group// -->
            </div>

          </form>

          <!------------------------------- End Of Form ------------------------------->
        </div>

      <!-- End page-content -->
      <!-- ------------------------------------- -->
  @endsection

  @section('scripts')
  @endsection
