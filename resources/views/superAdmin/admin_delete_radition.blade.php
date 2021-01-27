@extends('superAdmin.layouts.master')
@section('title', 'Delete Radiation')
@section('css')
<link rel="stylesheet" href="{{ url('/css/form.css') }}">
<style>
    textarea::placeholder {
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
        @endif

        @if(Session::has('success'))
          <div class="alert alert-success mx-auto text-center"> {{Session::get('success')}}</div>
          @php
              Session::forget('success');
          @endphp
        @endif
        
          
      <!-- page-content" -->
      <div class="container">
          <h2 class="text-center mt-5">Delete Radiation</h2>
          <hr>
          <!------------------------------- Delete Radition ------------------------------->

          <!------------------------------- Start Of Form ------------------------------->
          <form method="POST" action="{{route('admin.delete_radition')}}" class="ValidationForm" enctype="multipart/form-data" novalidate>
            @csrf
            <div class="row">
            <!-- article_type_id -->

              <!------------------------------- Article Title ------------------------------->
              <div class=" col-md-6 offset-md-3 col-sm-8 offset-sm-2">
                <div class="form-group input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 2.5rem;"> <i class="fas fa-vial"></i> </span>
                  </div>
                  <select class="custom-select selected-governorate" name="radition_id">
                    <option selected disabled value="">* Radition Name</option>
                      @foreach($all_raditions as $one)
                        <option value="{{$one->id}}">{{$one->radiation_name}}</option>
                      @endforeach
                  </select>
                </div> <!-- form-group Name -->
                <div class="alert alert-danger custom-alert">
                  
                </div>
              </div>
              <!------------------------------- Submit Button ------------------------------->
              <div class="form-group offset-md-4 col-md-4">
                <!-- offset-3 col-6 -->
                <!-- disabled -->
                <button type="submit" name="submit" class="btn btn-danger btn-block">Delete</button>
              </div> <!-- form-group// -->
            </div>
          </form>

          <!------------------------------- End Of Form ------------------------------->
        </div>

      <!-- End page-content -->
      <!-- ------------------------------------- -->



@endsection