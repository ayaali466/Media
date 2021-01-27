@extends('orgAdmin.layouts.o_app')
@section('title','Edit Blood Bank')
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
        @endif
      <div class="container">
          <h2 class="text-center">Edit Blood Bank</h2>
          <hr>
          @isset($last_BB_name)
            <div class="alert alert-success">
              Blood Bank: <b>{{ $last_BB_name}}</b> is Updated.
          </div>
          @endisset
          <!------------------------------- Delete Blood Bank ------------------------------->

          <!------------------------------- Start Of Form ------------------------------->
          <form method="POST" action="{{route('showeditBloodBank')}}" class="ValidationForm" enctype="multipart/form-data" novalidate>
            @csrf
            <div class="row">

              <!------------------------------- Departments ------------------------------->
              <div class="offset-md-3 col-md-6 col-xs-12 mt-5">
                <div class="form-group">
                  <select class="custom-select selected-governorate" name="blood_bank_id">
                  <option selected="" disabled="" value="">Blood Bank</option>
                    @foreach($blood_banks as $blood_bank)
                      <option value="{{ $blood_bank -> id }}">{{ $blood_bank -> name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="alert alert-danger custom-alert ">
                  
                </div>
              </div>
              <!------------------------------- Submit Button ------------------------------->
              <div class="form-group offset-md-4 col-md-4">
                <!-- offset-3 col-6 -->
                <!-- disabled -->
                <button type="submit" name="submit" class="btn btn-warning btn-block">Edit</button>
              </div> <!-- form-group// -->
            </div>

          </form>

          <!------------------------------- End Of Form ------------------------------->
        </div>
      <!-- ------------------------------------- -->
  @endsection

  @section('scripts')
  @endsection
