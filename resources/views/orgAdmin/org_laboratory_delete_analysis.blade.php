@extends('orgAdmin.layouts.o_app')
@section('title','Delete Laboratory Analysis')
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
          <h2 class="text-center">Delete Laboratory Analysis</h2>
          <hr>
          <!------------------------------- Add Laboratory ------------------------------->

          <!------------------------------- Start Of Form ------------------------------->
          <form method="POST" action="{{route('deleteAnalysis')}}" class="ValidationForm" enctype="multipart/form-data" novalidate>
            @csrf
            <div class="row">
              <!-------------------------------  Analysis  ------------------------------->
              <div class="offset-md-3 col-md-6 col-xs-12 mt-5">
                <div class="form-group">
                  <select class="custom-select selected-governorate" name="analysis_id">
                    <option selected disabled value="">Analysis</option>
                    @foreach($medical_analysis as $one_analysis)
                      <option value="{{ $one_analysis -> id }}">{{ $one_analysis -> analysis_name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>

             <!------------------------------- Submit Button ------------------------------->

             <div class="form-group offset-md-4 col-md-4">
                <!-- offset-3 col-6 -->
                <!-- disabled -->
                <button type="submit" name="submit" class="btn btn-danger btn-block">Delete Analysis</button>
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
