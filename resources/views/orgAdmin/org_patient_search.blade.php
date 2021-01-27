@extends('orgAdmin.layouts.o_app')
@section('title','Patient Search')
@section('styles')
<link rel="stylesheet" href="{{ url('/orgAdmin/css/patient_search.css') }}">
<link rel="stylesheet" href="{{ url('/css/request_loading.css') }}">
@endsection

@section('content')


        <!-- Loading Untill Request Done -->
        <div id="loading_untill_request_done">
            <div class="cv-spinner">
                <span class="spinner"></span>
            </div>
        </div>
        <!-- End Loading Untill Request Done -->

        <!-- page-content" -->
        <div class="container">
          <h2 class="text-center">Patient Search</h2>
          <hr>
          <!------------------------------- Patient Search ------------------------------->
          <div class="patient_search_box mb-3">
            <span><i class="fas fa-user-injured fa-3x"></i>
            <input type="text" placeholder="Search..." id="patient_search_input">
          </div>
          <div class="patient_search_result_container">
              <p class="text-muted text-center message">Please Enter Patient National ID or Name</p>
              <!-- <div class="patient_search_result">
                  <a href='{{ "Patient Id" }}'> </a>
                  <a href="{{route('searchPatient',['id' => 1 ])}}">{{ "Patient Name" }}</a>
                  
                  <span>29601150100898</span>
              </div> -->
          </div>
          
          <!------------------------------- End Of Form ------------------------------->
        </div>

      <!-- End page-content -->
      <!-- ------------------------------------- -->
  @endsection

  @section('scripts')
  <script src="{{ url('user/js/patientsearch.js') }}"></script>
  @endsection
