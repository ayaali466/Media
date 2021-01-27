@extends('orgAdmin.layouts.o_app')
@section('title','Edit Laboratory')
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
          <h2 class="text-center">Edit Laboratory</h2>
          <hr>
          @isset($last_laboratory_name)
            <div class="alert alert-success">
              Labporatory: <b>{{ $last_laboratory_name}}</b> is Updated.
          </div>
          @endisset
          <!------------------------------- Delete Blood Bank ------------------------------->

          <!------------------------------- Start Of Form ------------------------------->
          <form method="POST" action="{{route('showeditLaboratory')}}" class="ValidationForm" enctype="multipart/form-data" novalidate>
            @csrf
            <div class="row">

              <!------------------------------- Departments ------------------------------->
              <div class="offset-md-3 col-md-6 col-xs-12 mt-5">
                <div class="form-group">
                  <select class="custom-select selected-governorate" name="laboratory_id">
                  <option selected="" disabled="" value="">Laboratory</option>
                    @foreach($labs as $lab)
                      <option value="{{ $lab -> id }}">{{ $lab -> name }}</option>
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
