@extends('orgAdmin.layouts.o_app')
@section('title','Edit Doctor')
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
      <!-- page-content" -->
      <div class="container">
          <h2 class="text-center">Edit Doctor</h2>
          <hr>
          <!------------------------------- Edit Doctor ------------------------------->

          <!------------------------------- Start Of Form ------------------------------->
          <form method="POST" action="{{route('editDoctor')}}" class="ValidationForm" enctype="multipart/form-data" novalidate>
            @csrf
            <div class="row">
              <input type="hidden" name="doctor_id" value="{{$doctor_id}}">
              <!------------------------------- User Name ------------------------------->
              <div class=" col-md-6 offset-md-0 col-sm-8 offset-sm-2">
                <div class="form-group input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 2.5rem;"> <i class="fas fa-user-md"></i> </span>
                  </div>
                  <input name="name" class="name form-control" placeholder="Doctor name" type="text" value="{{$doctor_data[0] -> name}}">
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
                      <option value="{{ $department -> id }}" <?= ($department -> id == $doctor_data[0]->department_id )? 'selected':'' ?>>{{ $department -> name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="alert alert-danger custom-alert ">
                  
                </div>
              </div>

              <!------------------------------- Job Title ------------------------------->
              <div class=" col-md-6 offset-md-0 col-sm-8 offset-sm-2">
                <div class="form-group input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 2.5rem;"> <i class="fas fa-briefcase"></i> </span>
                  </div>
                  <input name="job_title" class="job-title form-control" placeholder="Job title" type="text" value="{{$doctor_data[0] -> title}}">
                </div> <!-- form-group Name -->
                <div class="alert alert-danger custom-alert ">
                  
                </div>
              </div>
              <!------------------------------- Fees ------------------------------->
              <div class=" col-md-6 offset-md-0 col-sm-8 offset-sm-2">
                <div class="form-group input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 2.5rem;"> <i class="fas fa-money-bill-wave"></i>
                    </span>
                  </div>
                  <input name="fees" class="fees form-control" placeholder="Doctor Fees" type="number" min="50" value="{{$doctor_data[0] -> fees}}">
                </div> <!-- form-group Name -->
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
                    placeholder="Job Description">{{ $doctor_data[0] -> description }}</textarea>
                </div> <!-- form-group Name -->
                <div class="alert alert-danger custom-alert">
                  Error Message
                </div>
              </div>
              

              <!------------------------------- available hours ------------------------------->
              @php $counter = 1; @endphp
              @foreach($available_days as $day)

                <div class=" col-md-6 offset-md-0 col-sm-8 offset-sm-2 available_hours_container">
                  <!-- Avilable 1 -->
                  <div class="form-group input-group row mx-0">
                      <div class="input-group-prepend">
                          <span class="input-group-text"> <i class="far fa-calendar-alt"></i> </span>
                      </div>
                      <div class="col" style="margin: 0; padding: 0;">
                          <select class="custom-select available_hours" name="day-{{$counter}}">
                            <option value="Saturday" <?= ($day -> day_name ) == "Saturday"? 'selected':''?>>Saturday</option>
                            <option value="Sunday" <?= ($day -> day_name ) == "Sunday"? 'selected':''?>>Sunday</option>
                            <option value="Monday" <?= ($day -> day_name ) == "Monday"? 'selected':''?>>Monday</option>
                            <option value="Tuesday" <?= ($day -> day_name ) == "Tuesday"? 'selected':''?>>Tuesday</option>
                            <option value="Wednesday" <?= ($day -> day_name ) == "Wednesday"? 'selected':''?>>Wednesday</option>
                            <option value="Thursday" <?= ($day -> day_name ) == "Thursday"? 'selected':''?>>Thursday</option>
                            <option value="Friday" <?= ($day -> day_name ) == "Friday"? 'selected':''?>>Friday</option>
                        </select>
                      </div>
                      <div class="col" style="margin: 0; padding: 0;">
                          <div class="col-12 p-0">
                              <input class="form-control time-from" type="time" name="from-{{$counter}}" placeholder="From" value="{{ $day -> start_time }}">
                          </div>
                      </div>

                      <div class="col" style="margin: 0; padding: 0;">
                          <div class="col-12 p-0">
                              <input class="form-control time-to" type="time" name="to-{{$counter}}" placeholder="to" value="{{ $day -> end_time }}">
                          </div>
                      </div>
                      <i class="fas fa-plus text-success pl-3" style="line-height: 35px; font-size: 25px;"></i>
                      <i class="fas fa-times text-danger pl-3" style="line-height: 35px; font-size: 25px;"></i>
                  </div>

                  <div class="alert alert-danger custom-alert ">
                      
                  </div>
                </div>
                @php $counter++; @endphp
              @endforeach
               <!-- Max Availanle Times -->
               <div class="alert alert-danger custom-alert max-available-hours col-md-6 offset-md-0 col-sm-8 offset-sm-2">
                    
                    </div>
              
              <!------------------------------- Submit Button ------------------------------->
              <div class="form-group offset-md-4 col-md-4">
                <!-- offset-3 col-6 -->
                <!-- disabled -->
                <button type="submit" name="submit" class="btn btn-primary btn-block">Edit</button>
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
    var profileImageSkip = true;
  </script>
  <script src="{{ url('orgAdmin/js/doctorValidation.js') }}"></script>
  @endsection
