@extends('orgAdmin.layouts.o_app')
@section('title','Edit Doctor Logo')
@section('styles')
<link rel="stylesheet" href="{{ url('/css/logo_image_edit.css') }}">
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
          <h2 class="text-center">Edit Doctor Logo</h2>
          <hr>
          <!------------------------------- Edit Department ------------------------------->

          <!------------------------------- Start Of Form ------------------------------->
          <form method="POST" action="{{route('editDoctorLogoImage')}}" class="ValidationForm" enctype="multipart/form-data" novalidate>
            @csrf
            <div class="row justify-content-center">
              
              <!------------------------------- Logo Image ------------------------------->
              <div class="Image_edit col-12">
                <div class="avatar-upload">
                    <div class="avatar-edit">
                        <input name="logo_image" type='file' id="imageUpload" accept=".png, .jpg, .jpeg" />
                        <label for="imageUpload"></label>
                        <!-- That Contain Edit Icon usgin after-->
                    </div>
                    <div class="avatar-preview">
                        @php
                          if(isset($logo_image))
                            $path = "orgAdmin/img/$logo_image";
                          else
                            $path = "img/photo1.png";
                        @endphp
                        <div id="imagePreview" style = <?= "\"background-image: url("?> {{ url("$path") }}<?=");\""?>>
                        </div>
                    </div>
                </div>
            </div>

              <!------------------------------- Submit Button ------------------------------->
              <div class="form-group col-4">
                <!-- offset-3 col-6 -->
                <!-- disabled -->
                <input type="hidden" name="doc_photo_name" value="{{ $logo_image }}">
                <input type="hidden" name="doc_id" value="{{ $doc_id }}">
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
  <script src="{{ url('/js/logo_image_edit.js') }}"></script>
  @endsection
