@extends('orgAdmin.layouts.o_app')
@section('title','Edit BB Profile Image')
@section('styles')
<link rel="stylesheet" href="{{ url('/css/profile_image_edit.css') }}">
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
          <h2 class="text-center">Edit Blood Bank Profile Image</h2>
          <hr>
          <!------------------------------- Edit Department ------------------------------->

          <!------------------------------- Start Of Form ------------------------------->
          <form method="POST" action="{{route('editBBProfileImage')}}" class="ValidationForm" enctype="multipart/form-data" novalidate>
            @csrf
            <div class="row justify-content-center">
              
              <!------------------------------- Profile Image ------------------------------->
              <div class="Image_edit col-12">
                <div class="avatar-upload">
                    <div class="avatar-edit">
                        <input name="profileImage" type='file' id="imageUpload">
                        <label for="imageUpload"></label>
                        <!-- That Contain Edit Icon usgin after-->
                    </div>
                    <div id="imagePreview">
                      @php
                        if(isset($profile_image))
                          $path = "orgAdmin/img/$profile_image";
                        else
                          $path = "img/photo1.png";
                      @endphp
                        <img src='{{ url("$path") }}'alt="">
                    </div>
                </div>
              </div>
              <!------------------------------- Submit Button ------------------------------->
              <div class="form-group col-4">
                <input type="hidden" value="{{ $BB_id }}" name="BB_id">
                <input type="hidden" value="{{ $profile_image }}" name="lab_profile">
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
  <script src="{{ url('/js/profile_image_edit.js') }}"></script>
  @endsection
