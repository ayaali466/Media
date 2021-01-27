@extends('orgAdmin.layouts.o_app')
@section('title','Send Request')
@section('styles')
<link rel="stylesheet" href="{{ url('/css/form.css') }}">
<style>
    .ValidationForm ::placeholder {
      text-align: center;
      line-height: 120px;
    }
  </style>
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
          <h2 class="text-center">Request</h2>
          <hr>
          <!------------------------------- Edit Department ------------------------------->

          <!------------------------------- Start Of Form ------------------------------->
          <form method="POST" action="{{route('send_request')}}" class="ValidationForm" enctype="multipart/form-data" novalidate>
            @csrf
            <div class="row">
              
              <!------------------------------- descreption ------------------------------->
              <div class="offset-md-2 col-md-8 col-12">
                <div class="form-group input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 2.5rem;"> <i class="fas fa-align-left"></i> </span>
                  </div>
                  <textarea name="requestContent" class="textcontent form-control" rows="5" placeholder="Requset Content"></textarea>
                </div> <!-- form-group Name -->
                <div class="alert alert-danger custom-alert ">
                  
                </div>
              </div>

              <!------------------------------- Submit Button ------------------------------->
              <div class="form-group offset-md-4 col-md-4">
                <!-- offset-3 col-6 -->
                <!-- disabled -->
                <button type="submit" name="submit" class="btn btn-primary btn-block">Send</button>
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
  <script src="{{ url('/orgAdmin/js/request_Validationjs.js') }}"></script>
  @endsection
