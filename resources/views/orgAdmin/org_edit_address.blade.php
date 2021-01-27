@extends('orgAdmin.layouts.o_app')
@section('title','Edit Address')
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
        @else
          @isset($status)
            <div class="alert alert-success">
                {{ $status }}
            </div>
          @endisset
        @endif
      <!-- page-content" -->
      <div class="container">
          <h2 class="text-center">Edit Address</h2>
          <hr>
          <!------------------------------- Edit Address ------------------------------->

          <!------------------------------- Start Of Form ------------------------------->
          <form method="POST" action="{{route('editAddress')}}" class="ValidationForm" enctype="multipart/form-data" novalidate>
            @csrf
            <div class="row">
              <!------------------------------- Governorate ------------------------------->
              <div class=" col-md-6 offset-md-0 col-sm-8 offset-sm-2">
                <div class="form-group">
                  <select class="custom-select selected-governorate" name="governorate" id="governorate_id">
                  <option selected disabled value="">* Governorate</option>
                    @foreach($governorates as $governorate)
                      <option value="{{ $governorate -> id }}" <?= ($governorate -> id == $hospital_data->gov_id )? 'selected':'' ?>>{{ $governorate -> gov_name }}</option>
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
                      <option value="{{ $city -> id }}" <?= ($city -> id  == $hospital_data->city_id )? 'selected':'' ?>>{{ $city -> city_name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="alert alert-danger custom-alert">
                  
                </div>
              </div>
              
              <!------------------------------- Address ------------------------------->
              <div class="offset-md-2 col-md-8 col-xs-12 mt-5">
                <div class="form-group input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 2.5rem;"> <i class="fas fa-map-marker-alt"></i> </span>
                  </div>
                  <input name="address" class="url-GoogleMap form-control"
                    placeholder="Address as 32, horia Street,: Cairo, Egypt." type="text" <?= ((isset($hospital_data->address))&&!is_null($hospital_data->address))?"value=\"$hospital_data->address\"" :"" ?>>
                </div>
                <div class="alert alert-danger custom-alert ">
                  Error Message
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
  <script src="{{ url('/js/correspongingCities.js') }}"></script>
  @endsection
