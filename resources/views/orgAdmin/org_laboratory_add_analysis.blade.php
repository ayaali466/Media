@extends('orgAdmin.layouts.o_app')
@section('title','Add Laboratory Analysis')
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
              <b>{{ $status}}
          </div>
        @endisset
      <!-- page-content" -->
      <div class="container">
          <h2 class="text-center">Add Laboratory Analysis</h2>
          <hr>
          <!------------------------------- Add Laboratory ------------------------------->

          <!------------------------------- Start Of Form ------------------------------->
          <form method="POST" action="{{route('addAnalysis')}}" class="ValidationForm" enctype="multipart/form-data" novalidate>
            @csrf
            <div class="row">
              <!-------------------------------  Analysis  ------------------------------->
              <div class="col-md-6 offset-md-0 col-sm-8 offset-sm-2">
                <div class="form-group">
                  <select class="custom-select selected-governorate" name="analysis_id">
                    <option selected disabled value="">Analysis</option>
                    @foreach($medical_analysis as $one_analysis)
                      <option value="{{ $one_analysis -> id }}">{{ $one_analysis -> analysis_name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <!------------------------------- Fees ------------------------------->
              <div class=" col-md-6 offset-md-0 col-sm-8 offset-sm-2">
                <div class="form-group input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 2.5rem;"> <i class="fas fa-money-bill-wave"></i>
                    </span>
                  </div>
                  <input name="price" class="fees form-control" placeholder="Price" type="number" min="50">
                </div> <!-- form-group Name -->
              </div>
             <!------------------------------- Submit Button ------------------------------->

             <div class="form-group offset-md-4 col-md-4">
                <!-- offset-3 col-6 -->
                <!-- disabled -->
                <input type="hidden" name="lab_id" value="{{ $lab_id }}">
                <button type="submit" name="submit" class="btn btn-success btn-block">Add Analysis</button>
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
