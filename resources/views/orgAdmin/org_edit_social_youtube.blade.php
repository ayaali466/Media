@extends('orgAdmin.layouts.o_app')
@section('title','Edit Youtube Channel')
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
          <h2 class="text-center">Edit Youtube</h2>
          <hr>
          <!------------------------------- Edit Youtube ------------------------------->

          <!------------------------------- Start Of Form ------------------------------->
          <form method="POST" action="{{route('editYoutube')}}" class="ValidationForm" enctype="multipart/form-data" novalidate>
            @csrf
            <div class="row">
              <!------------------------------- Youtube ------------------------------->
              <div class="offset-md-2 col-md-8 col-xs-12 mt-5">
                <div class="form-group input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 2.5rem;"> <i class="fab fa-youtube"></i> </span>
                  </div>
                  <input name="youtube" class="url-youtube form-control" placeholder="Youtube" type="url" <?= ((isset($youtube))&&!is_null($youtube))?"value=\"$youtube\"" :"" ?>>
                </div>
                <div class="alert alert-danger custom-alert ">
                  
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
