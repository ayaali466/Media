@extends('orgAdmin.layouts.o_app')
@section('title','Delete Blood Bank')
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
      <!-- page-content" -->
      <div class="container">
          <h2 class="text-center">Delete Blood Bank</h2>
          <hr>
          @isset($deleted_blood_bank_name)
            <div class="alert alert-success">
              Blood Bank: <b>{{ $deleted_blood_bank_name}}</b> is deleted.
          </div>
          @endisset
          <!------------------------------- Delete Blood Bank ------------------------------->

          <!------------------------------- Start Of Form ------------------------------->
          <form method="POST" action="{{route('deleteBloodBank')}}" class="ValidationForm" enctype="multipart/form-data" novalidate>
            @csrf
            <div class="row">

              <!------------------------------- blood_bank ------------------------------->
              <div class="offset-md-3 col-md-6 col-xs-12 mt-5">
                <div class="form-group">
                  <select class="custom-select selected-governorate" name="blood_bank_id">
                    <option selected disabled value="">Blood Banks</option>
                    @foreach($blood_banks as $blood_bank)
                      <option value="{{ $blood_bank -> id }}">{{ $blood_bank -> name }}</option>
                    @endforeach
                  </select>
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

  @section('scripts')
  @endsection
