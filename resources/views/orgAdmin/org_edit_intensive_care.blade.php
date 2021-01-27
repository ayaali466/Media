@extends('orgAdmin.layouts.o_app')
@section('title','Edit Intensive Care')
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
          <h2 class="text-center">Edit Intensive Care</h2>
          <hr>
          <!------------------------------- Edit Intensive Care  ------------------------------->

          <!------------------------------- Start Of Form ------------------------------->
          <form method="POST" action="{{route('editintensiveCare')}}" class="ValidationForm" enctype="multipart/form-data" novalidate>
            @csrf
            <div class="row">
              <!------------------------------- All Units ------------------------------->
              <div class=" col-md-6 offset-md-0 col-sm-8 offset-sm-2">
                <div class="form-group input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text text-center" style="width: 6rem; display:inline-block"> All </span>
                  </div>
                  <input name="all_intensiveCare" class="form-control" placeholder="Number Intensive Care rooms in hospital" type="number" min="1" <?= ((isset($all_intensiveCare))&&!is_null($all_intensiveCare))?"value=\"$all_intensiveCare\"" :"" ?>>
                </div> <!-- form-group Name -->
                <div class="alert alert-danger custom-alert ">
                  You Must choose value, greater than or equal 1.
                </div>
              </div>
              <!------------------------------- Available Units ------------------------------->
              <div class=" col-md-6 offset-md-0 col-sm-8 offset-sm-2">
                <div class="form-group input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text text-center" style="width: 6rem; display:inline-block"> Available </span>
                  </div>
                  <input name="available_intensiveCare" class="form-control" placeholder="Available Intensive Care rooms in hospital" type="number" min="0" <?= ((isset($available_intensiveCare))&&!is_null($available_intensiveCare))?"value=\"$available_intensiveCare\"" :"" ?>>
                </div> <!-- form-group Name -->
                <div class="alert alert-danger custom-alert ">
                  You Must choose value, greater than or equal 1.
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

      <!-- End page-content -->
      <!-- ------------------------------------- -->
  @endsection

  @section('scripts')
  @endsection
