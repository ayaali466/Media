@extends('orgAdmin.layouts.o_app')
@section('title','Add Blood Bank')
@section('styles')
<link rel="stylesheet" href="{{ url('/css/form.css') }}">
<link rel="stylesheet" href="{{ url('/css/request_loading.css') }}">
<style>
    textarea::placeholder {
      text-align: center;
      line-height: 100px;
    }
  </style>
@endsection

@section('content')
        <!-- Loading Untill Request Done -->
        <div id="loading_untill_request_done">
            <div class="cv-spinner">
                <span class="spinner"></span>
            </div>
        </div>
        <!-- End Loading Untill Request Done -->

        @if($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @else
          @isset($result)
            @if($result != 'false')
              <div class="alert alert-success">
                New Blood Bank <b> ( {{ $result }} ) </b> Is added
              </div>
            @endif
          @endisset
        @endif
        <!-- page-content" -->
        <div class="container">
          <h2 class="text-center">Add Blood Bank</h2>
          <hr>
          <!------------------------------- Add  Blood Bank ------------------------------->

          <!------------------------------- Start Of Form ------------------------------->
          <form method="POST" action="{{route('addBloodBank')}}" class="ValidationForm" enctype="multipart/form-data" novalidate>
            @csrf
            <div class="row">
              <!------------------------------- Blood Bank Name ------------------------------->
              <div class=" col-md-6 offset-md-0 col-sm-8 offset-sm-2">
                <div class="form-group input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 2.5rem;"> <i class="fas fa-tint"></i> </span>
                  </div>
                  <input name="blood_bank_name" class="name form-control" placeholder="* Blood bank name" type="text">
                </div> <!-- form-group Name -->
                <div class="alert alert-danger custom-alert">
                  
                </div>
              </div>

              <!------------------------------- Email ------------------------------->
              <div class=" col-md-6 offset-md-0 col-sm-8 offset-sm-2">
                <div class="form-group input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 2.5rem;"> <i class="fa fa-envelope"></i> </span>
                  </div>
                  <input name="blood_bank_email" class="email form-control" placeholder="* Email" type="email">
                </div> <!-- form-group Name -->
                <div class="alert alert-danger custom-alert">
                  
                </div>
              </div>
              <!------------------------------- Governorate ------------------------------->
              <div class=" col-md-6 offset-md-0 col-sm-8 offset-sm-2">
                <div class="form-group">
                  <select class="custom-select selected-governorate" name="governorate" id="governorate_id">
                    <option selected disabled value="">* Governorate</option>
                    @foreach($governorates as $governorate)
                      <option value="{{ $governorate -> id }}">{{ $governorate -> gov_name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="alert alert-danger custom-alert">
                  
                </div>
              </div>

              <!------------------------------- City ------------------------------->
              <div class=" col-md-6 offset-md-0 col-sm-8 offset-sm-2">
                <div class="form-group">
                  <select class="custom-select selected-city" name="city" id="city_id">
                    <option selected disabled value="">* City</option>
                  </select>
                </div>
                <div class="alert alert-danger custom-alert">
                  
                </div>
              </div>
              <!------------------------------- Address ------------------------------->
              <div class=" col-md-6 offset-md-0 col-sm-8 offset-sm-2">
                <div class="form-group input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 2.5rem;"> <i class="fas fa-map-marker-alt"></i> </span>
                  </div>
                  <input name="address" class="address form-control" placeholder="Address as 32, My Street,: Kingston, New York 12401: United States." type="text">
                </div>
                <div class="alert alert-danger custom-alert">
                  
                </div>
              </div>
              <!------------------------------- Profile Image ------------------------------->
              <div class=" col-md-6 offset-md-0 col-sm-8 offset-sm-2">
                <div class="custom-file mb-3">
                  <input type="file" class="imageprofile custom-file-input" id="BB_profileImage" name="blood_bank_profileImage">
                  <label class="custom-file-label" for="BB_profileImage">* Profile Image</label>
                </div>
                <div class="alert alert-danger custom-alert">
                  
                </div>
              </div>
              <!------------------------------- Logo Image ------------------------------->
              <div class=" col-md-6 offset-md-0 col-sm-8 offset-sm-2">
                <div class="custom-file mb-3">
                  <input type="file" class="imagelogo custom-file-input" id="BB_lgogImage" name="blood_bank_logogImage">
                  <label class="custom-file-label" for="BB_lgogImage">* Logo Image</label>
                </div>
                <div class="alert alert-danger custom-alert">
                  
                </div>
              </div>
              <!------------------------------- URL ------------------------------->
              <div class=" col-md-6 offset-md-0 col-sm-8 offset-sm-2">
                <div class="form-group input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 2.5rem;"> <i class="fas fa-globe"></i> </span>
                  </div>
                  <input name="blood_bank_website" class="url form-control" placeholder="Website" type="url">
                </div>
                <div class="alert alert-danger custom-alert">
                  
                </div>
              </div>

              <!------------------------------- Facebook ------------------------------->
              <div class=" col-md-6 offset-md-0 col-sm-8 offset-sm-2">
                <div class="form-group input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 2.5rem;"> <i class="fab fa-facebook-f"></i> </span>
                  </div>
                  <input name="blood_bank_facebook" class="url-facebook form-control" placeholder="Facebook" type="url">
                </div>
                <div class="alert alert-danger custom-alert">
                  
                </div>
              </div>

              <!------------------------------- Twitter ------------------------------->
              <div class=" col-md-6 offset-md-0 col-sm-8 offset-sm-2">
                <div class="form-group input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 2.5rem;"> <i class="fab fa-twitter"></i> </span>
                  </div>
                  <input name="blood_bank_twitter" class="url-twitter form-control" placeholder="Twitter" type="url">
                </div>
                <div class="alert alert-danger custom-alert">
                  
                </div>
              </div>

              <!------------------------------- Instagram ------------------------------->
              <div class=" col-md-6 offset-md-0 col-sm-8 offset-sm-2">
                <div class="form-group input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 2.5rem;"> <i class="fab fa-instagram"></i> </span>
                  </div>
                  <input name="blood_bank_instagram" class="url-instagram form-control" placeholder="Instagram" type="url">
                </div>
                <div class="alert alert-danger custom-alert">
                  
                </div>
              </div>

              <!------------------------------- Youtube ------------------------------->
              <div class=" col-md-6 offset-md-0 col-sm-8 offset-sm-2">
                <div class="form-group input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 2.5rem;"> <i class="fab fa-youtube"></i> </span>
                  </div>
                  <input name="blood_bank_youtube" class="url-youtube form-control" placeholder="Youtube" type="url">
                </div>
                <div class="alert alert-danger custom-alert">
                  
                </div>
              </div>

              <!------------------------------- Google Map ------------------------------->
              <div class=" col-md-6 offset-md-0 col-sm-8 offset-sm-2">
                <div class="form-group input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 2.5rem;"> <i class="fas fa-map-marker-alt"></i> </span>
                  </div>
                  <input name="blood_bank_map" class="url-GoogleMap form-control" placeholder="Google Map" type="url">
                </div>
                <div class="alert alert-danger custom-alert">
                  
                </div>
              </div>
              
              <!------------------------------- Phone Number ------------------------------->
              <div class=" col-md-6 offset-md-0 col-sm-8 offset-sm-2">
                <div class="form-group input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-phone"></i> </span>
                  </div>
                  <select class="custom-select selected-phone-code" style="max-width: 80px;" name="pre_phone_code">
                    <option selected disabled value="">Code</option>
                    <option value="hotline">Hotline</option>
                    <option value="02">02</option>
                    <option value="010">010</option>
                    <option value="011">011</option>
                    <option value="012">012</option>
                    <option value="015">015</option>
                  </select>
                  <input name="blood_bank_phone" class="phone-number form-control" placeholder="Phone number" type="text">
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
                  <textarea name="about_us" class="about_us form-control" rows="4" placeholder="Description" spellcheck="false"></textarea>
                </div> <!-- form-group Name -->
                <div class="alert alert-danger custom-alert">
                  
                </div>
              </div>

              <!------------------------------- Submit Button ------------------------------->
              <div class="form-group offset-md-4 col-md-4">
                <!-- offset-3 col-6 -->
                <!-- disabled -->
                <button type="submit" name="submit" class="btn btn-primary btn-block">Add</button>
              </div> <!-- form-group// -->
            </div>
            <p id="all-field-well" class="text-center"><i class="fas fa-times"></i> Enter all fields to Continue</p>
          </form>

          <!------------------------------- End Of Form ------------------------------->
        </div>

      <!-- End page-content -->
      <!-- ------------------------------------- -->
  @endsection

  @section('scripts')
  <script src="{{ url('/orgAdmin/js/bloodbankValidation.js') }}"></script>
  <script src="{{ url('/js/correspongingCities.js') }}"></script>
  @endsection
