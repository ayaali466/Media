@extends('orgAdmin.layouts.o_app')
@section('title','Edit Center')
@section('styles')
<link rel="stylesheet" href="{{ url('/css/form.css') }}">
<link rel="stylesheet" href="{{ url('/css/request_loading.css') }}">
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
        @endif

      <!-- page-content" -->
      <div class="container">
          <h2 class="text-center">Edit Center</h2>
          <hr>
          <!------------------------------- Edit Laboratory ------------------------------->

          <!------------------------------- Start Of Form ------------------------------->
          <form method="post" action="{{route('editCenter')}}" class="ValidationForm" enctype="multipart/form-data" novalidate>
            @csrf
            <div class="row">
              <!------------------------------- User Name ------------------------------->
              <div class=" col-md-6 offset-md-0 col-sm-8 offset-sm-2">
                <div class="form-group input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 2.5rem;"> <i class="fas fa-flask"></i> </span>
                  </div>
                  <input name="laboratory_name" class="name form-control" placeholder="Center name" type="text" value="{{$all_laboratory_data[0] -> name}}">
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
                  <input name="laboratory_email" class="email form-control" placeholder="Email" type="email" value="{{$all_laboratory_data[0] -> email}}">
                </div> <!-- form-group Name -->
                <div class="alert alert-danger custom-alert">
                  
                </div>
              </div>
              <!------------------------------- Governorate ------------------------------->

              <div class=" col-md-6 offset-md-0 col-sm-8 offset-sm-2">
                <div class="form-group">
                  <select class="custom-select selected-governorate" name="governorate" id="governorate_id">
                    @foreach($governorates as $governorate)
                      <option value="{{ $governorate -> id }}" <?= ($governorate -> id == $all_laboratory_data[0]->gov_id )? 'selected':'' ?>>{{ $governorate -> gov_name }}</option>
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
                    <option disabled value="">* City</option>
                    @foreach($cities as $city)
                      <option value="{{ $city -> id }}" <?= ($city -> id  == $all_laboratory_data[0]->city_id )? 'selected':'' ?>>{{ $city -> city_name }}</option>
                    @endforeach
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
                  <input name="address" class="address form-control" placeholder="Address as 32, My Street,: Kingston, New York 12401: United States." type="text" value="{{ $all_laboratory_data[0]->address}}">
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
                    <option disabled value="">Code</option>
                    <option value="hotline" <?= (strlen($all_laboratory_data[0]->phone == 5 ))? 'selected':'' ?> >Hotline</option>
                    <option value="02" <?= (strlen(substr($all_laboratory_data[0]->phone,0,2) == "02" ))? 'selected':'' ?>>02</option>
                    
                    <option value="010" <?= (strlen(substr($all_laboratory_data[0]->phone,0,3) == "010" ))? 'selected':'' ?>>010</option>
                    <option value="011" <?= (strlen(substr($all_laboratory_data[0]->phone,0,3) == "011" ))? 'selected':'' ?>>011</option>
                    <option value="012" <?= (strlen(substr($all_laboratory_data[0]->phone,0,3) == "012" ))? 'selected':'' ?>>012</option>
                    <option value="015" <?= (strlen(substr($all_laboratory_data[0]->phone,0,3) == "015" ))? 'selected':'' ?>>015</option>
                  </select>
                  <input name="laboratory_phone" class="phone-number form-control" placeholder="Phone number" type="text" 
                  value="<?= (strlen($all_laboratory_data[0]->phone == 5 ))? $all_laboratory_data[0]->phone : substr($all_laboratory_data[0]->phone,-8) ?>">
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
                  <input name="laboratory_website" class="url form-control" placeholder="Website" type="url" value="{{$socila_links[0]-> website}}">
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
                  <input name="laboratory_facebook" class="url-facebook form-control" placeholder="Facebook" type="url" value="{{$socila_links[0]-> facebook}}">
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
                  <input name="laboratory_twitter" class="url-twitter form-control" placeholder="Twitter" type="url" value="{{$socila_links[0]-> twitter}}">
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
                  <input name="laboratory_instagram" class="url-instagram form-control" placeholder="Instagram" type="url" value="{{$socila_links[0]-> instagram}}">
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
                  <input name="laboratory_youtube" class="url-youtube form-control" placeholder="Youtube" type="url" value="{{$socila_links[0]-> youtube}}">
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
                  <input name="laboratory_map" class="url-GoogleMap form-control" placeholder="Google Map" type="url"  value="{{$socila_links[0]-> google_map}}">
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
                  <textarea name="about_us" class="about_us form-control" rows="4" placeholder="Description" spellcheck="false">{{$all_laboratory_data[0]-> about_us}}</textarea>
                </div> <!-- form-group Name -->
                <div class="alert alert-danger custom-alert">
                  
                </div>
              </div>
              <!------------------------------- Submit Button ------------------------------->
              @isset($laboratory_id)<input type="hidden" name="laboratory_id" value="{{$laboratory_id}}">@endisset
              @isset($laboratory_name)<input type="hidden" name="lab_name" value="{{$laboratory_name}}">@endisset
              @isset($all_laboratory_data)<input type="hidden" name="social_id" value="{{$all_laboratory_data[0]->social_link_id}}">@endisset
                <div class="row justify-content-between col-12">
                  <div class="form-group col-md-4 d-flex">
                    <i class="fas fa-image text-primary"  style="font-size: 35px"></i>
                    <a href="{{route('showeditCenterLogoImage',['id' => $laboratory_id ])}}"  style="line-height: 35px">&nbsp;&nbsp;Edit Logo Image</a>
                  </div>
                  <div class="form-group col-md-4">
                    <!-- offset-3 col-6 -->
                    <!-- disabled -->
                    <button type="submit" name="submit" class="btn btn-primary btn-block">Edit</button>
                  </div> <!-- form-group// -->
                  <div class="form-group col-md-4 d-flex justify-content-end">
                    <i class="fas fa-image text-primary"  style="font-size: 35px"></i>
                    <a href="{{route('showeditCenterProfileImage',['id' => $laboratory_id ])}}" style="line-height: 35px">&nbsp;&nbsp;Edit Profile Image</a>
                  </div>
                </div>
            </div>
            <p id="all-field-well" class="text-center"><i class="fas fa-times"></i> Enter all fields to Continue</p>
          </form>

          <!------------------------------- End Of Form ------------------------------->
        </div>

      <!-- End page-content -->
      <!-- ------------------------------------- -->
  @endsection

  @section('scripts')
  <script src="{{ url('/orgAdmin/js/bloodbankValidation_update.js') }}"></script>
  <script src="{{ url('/js/correspongingCities.js') }}"></script>
  @endsection
