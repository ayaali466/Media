@extends('orgAdmin.layouts.o_app')
@section('title','Add Doctor')
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
          <h2 class="text-center">Add Doctor</h2>
          <hr>
          <!------------------------------- Add Department ------------------------------->

          <!------------------------------- Start Of Form ------------------------------->
          <form method="POST" action="{{route('addDoctor')}}" class="ValidationForm" enctype="multipart/form-data" novalidate>
            @csrf
            <div class="row">
              <!------------------------------- User Name ------------------------------->
              <div class=" col-md-6 offset-md-0 col-sm-8 offset-sm-2">
                <div class="form-group input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 2.5rem;"> <i class="fas fa-user-md"></i> </span>
                  </div>
                  <input name="name" class="name form-control" placeholder="Doctor name" type="text">
                </div> <!-- form-group Name -->
                <div class="alert alert-danger custom-alert ">
                  Error Message
                </div>
              </div>

              <!------------------------------- Departments ------------------------------->
              <div class=" col-md-6 offset-md-0 col-sm-8 offset-sm-2">
                <div class="form-group">
                  <select class="custom-select selected-department" name="department">
                    <option selected disabled value="">Departments</option>
                    @foreach($departments as $department)
                      <option value="{{ $department -> id }}">{{ $department -> name }}</option>
                    @endforeach

                  </select>
                </div>
                <div class="alert alert-danger custom-alert ">
                  
                </div>
              </div>

              <!------------------------------- Job Title ------------------------------->
              <!-- <div class=" col-md-6 offset-md-0 col-sm-8 offset-sm-2">
                <div class="form-group">
                  <select class="custom-select selected-governorate">
                    <option selected disabled value="">Job Title</option>
                    <option value="1">Surgery</option>
                    <option value="2">Dentist</option>
                    <option value="3">Cardiothoracic surgery</option>
                    <option value="4">Chest and Pulmonology</option>
                    <option value="5">Dental</option>
                    <option value="6">Dermatology</option>
                    <option value="7">Diabetes &amp; Endocrinology</option>
                    <option value="8">Dietetics</option>
                    <option value="9">Pain Managment</option>
                    <option value="10">Ear, Nose and Throat</option>
                    <option value="11">Gastroenterology</option>
                    <option value="12">Internal Medicine</option>
                    <option value="13">Laboratory</option>
                    <option value="14">Nephrology</option>
                    <option value="15">Neurology</option>
                    <option value="16">Neurosurgery</option>
                    <option value="17">Obstetrics &amp; Gynecology</option>
                    <option value="18">Ophthalmology</option>
                    <option value="19">Orthopedic</option>
                    <option value="20">Pediatric &amp; Neonatology</option>
                    <option value="21">Physiotherapy</option>
                    <option value="22">Psychiatry</option>
                    <option value="23">Radiology</option>
                    <option value="24">Rheumatology</option>
                    <option value="25">Surgery</option>
                    <option value="26">Urology</option>
                    <option value="27">Vascular Surgery</option>

                  </select>
                </div>
                <div class="alert alert-danger custom-alert ">
                  Error Message
                </div>
              </div> -->
              <div class=" col-md-6 offset-md-0 col-sm-8 offset-sm-2">
                <div class="form-group input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 2.5rem;"> <i class="fas fa-briefcase"></i> </span>
                  </div>
                  <input name="job_title" class="job-title form-control" placeholder="Job title" type="text">
                </div> <!-- form-group Name -->
                <div class="alert alert-danger custom-alert ">
                  
                </div>
              </div>
              <!------------------------------- Profile Image ------------------------------->
              <div class=" col-md-6 offset-md-0 col-sm-8 offset-sm-2">
                <div class="custom-file mb-3">
                  <input type="file" class="imageprofile custom-file-input" id="customFile" name="profileImage">
                  <label class="custom-file-label" for="customFile">Doctor Image</label>
                </div>
                <div class="alert alert-danger custom-alert ">
                  Error Message
                </div>
              </div>
              <!------------------------------- Job Description ------------------------------->
              <div class=" col-md-6 offset-md-0 col-sm-8 offset-sm-2">
                <div class="form-group input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 2.5rem;"> <i class="fas fa-info"></i> </span>
                  </div>
                  <textarea name="job_description" class="description form-control" rows="3"
                    placeholder="Job Description"></textarea>
                </div> <!-- form-group Name -->
                <div class="alert alert-danger custom-alert">
                  Error Message
                </div>
              </div>
              <!------------------------------- Fees ------------------------------->
              <div class=" col-md-6 offset-md-0 col-sm-8 offset-sm-2">
                <div class="form-group input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 2.5rem;"> <i class="fas fa-money-bill-wave"></i>
                    </span>
                  </div>
                  <input name="fees" class="fees form-control" placeholder="Doctor Fees" type="number" min="50">
                </div> <!-- form-group Name -->
                <div class="alert alert-danger custom-alert ">
                  Error Message
                </div>
              </div>

              <!------------------------------- available hours ------------------------------->
              <div class=" col-md-6 offset-md-0 col-sm-8 offset-sm-2 available_hours_container">
                <!-- Avilable 1 -->
                <div class="form-group input-group row mx-0">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="far fa-calendar-alt"></i> </span>
                    </div>
                    <div class="col" style="margin: 0; padding: 0;">

                        <select class="custom-select available_hours" name="day-1">
                          <option selected disabled value="">Day</option>
                          <option value="Saturday">Saturday</option>
                          <option value="Sunday">Sunday</option>
                          <option value="Monday">Monday</option>
                          <option value="Tuesday">Tuesday</option>
                          <option value="Wednesday">Wednesday</option>
                          <option value="Thursday">Thursday</option>
                          <option value="Friday">Friday</option>
                      </select>
                    </div>
                    <div class="col" style="margin: 0; padding: 0;">
                        <div class="col-12 p-0">
                            <input class="form-control time-from" type="time" name="from-1" placeholder="From">
                        </div>
                    </div>

                    <div class="col" style="margin: 0; padding: 0;">
                        <div class="col-12 p-0">
                            <input class="form-control time-to" type="time" name="to-1" placeholder="to">
                        </div>
                    </div>
                    <i class="fas fa-plus text-success pl-3" style="line-height: 35px; font-size: 25px;"></i>
                    <i class="fas fa-times text-danger pl-3" style="line-height: 35px; font-size: 25px;"></i>
                </div>

                <div class="alert alert-danger custom-alert ">
                    
                </div>
              </div>
              
               <!-- Max Availanle Times -->
               <div class="alert alert-danger custom-alert max-available-hours col-md-6 offset-md-0 col-sm-8 offset-sm-2">
                    
                    </div>
              
              <!------------------------------- Submit Button ------------------------------->
              <div class="form-group offset-md-4 col-md-4">
                <!-- offset-3 col-6 -->
                <!-- disabled -->
                <button type="submit" name="submit" class="btn btn-primary btn-block">Add</button>
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
  <script src="{{ url('orgAdmin/js/add_avilable_hours.js') }}"></script>
  <script>
    var profileImageSkip = false;
  </script>
  <script src="{{ url('orgAdmin/js/doctorValidation.js') }}"></script>
  @endsection
