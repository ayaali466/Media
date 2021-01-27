@extends('orgAdmin.layouts.o_app')
@section('title','Edit Center Delete Radition')
@section('styles')
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
        @isset($status)
            <div class="alert alert-success">
              {{ $status}}
          </div>
        @endisset
      <div class="container">
          <h2 class="text-center">Edit Center Delete Radition</h2>
          <hr>
          <!------------------------------- Delete Blood Bank ------------------------------->

          <!------------------------------- Start Of Form ------------------------------->
          <form method="POST" action="{{route('showDeleteRadition')}}" class="ValidationForm" enctype="multipart/form-data" novalidate>
            @csrf
            <div class="row">

              <!------------------------------- All Labs ------------------------------->
              <div class="offset-md-3 col-md-6 col-xs-12 mt-5">
                <div class="form-group">
                  <select class="custom-select selected-governorate" name="laboratory_id">
                    <option selected disabled value="">Center</option>
                    @foreach($labs as $lab)
                      <option value="{{ $lab -> id }}">{{ $lab -> name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <!------------------------------- Submit Button ------------------------------->
              <div class="form-group offset-md-4 col-md-4">
                <!-- offset-3 col-6 -->
                <!-- disabled -->
                <button type="submit" name="submit" class="btn btn-warning btn-block">Go To Delete Radition</button>
              </div> <!-- form-group// -->
            </div>

          </form>

          <!------------------------------- End Of Form ------------------------------->
        </div>
      <!-- ------------------------------------- -->
  @endsection

  @section('scripts')
  @endsection
