@extends('orgAdmin.layouts.o_app')
@section('title','Patient Search')
@section('styles')
<link rel="stylesheet" href="{{ url('/orgAdmin/css/patient_profile.css') }}">
<style>
    textarea::placeholder {
      text-align: center;
      line-height: 100px;
    }
  </style>
@endsection

@section('content')
        <!-- page-content" -->
        <div class="container">
          <h2 class="text-center">Patient Profile</h2>
          <hr>
          <!------------------------------- Add  Blood Bank ------------------------------->

          <!------------------------------- Start Of Form ------------------------------->
          <section class="about-dev">
              <header class="profile-card_header">
                <div class="profile-card_header-container">
                  <div class="profile-card_header-imgbox">
                       @php
                        if(isset($photo))
                          $path = "user/img/$photo";
                        else
                          $path = "img/photo1.png";
                      @endphp
                        <img src='{{ url("$path") }}' alt="User Image">
                    <!-- <img src="http://placekitten.com/600/900" alt="Mewy Pawpins" /> -->
                  </div>
                  <h1>{{ $user -> name }}<span>{{ $user -> national_id }}</span></h1>
                </div>
              </header>
              <div class="profile-card_about">
                <h2 class="mb-3">About @if($user -> gender) {{ "him" }} @else {{ "her" }} @endif</h2>
                <!-- <hr> -->
                <table class="table">
                  <tbody>
                    <tr>
                      <th scope="row">Gender</th>
                      <td>@if($user -> gender) {{ "Male" }} @else {{ "Female" }} @endif</td>
                    </tr>
                    <tr>
                      <th scope="row">Date Of Birth</th>
                      <td>{{ $user -> birth_date }}</td>
                    </tr>
                    <tr>
                      <th scope="row">address</th>
                      <td>{{ $user -> address }}</td>
                    </tr>
                    <tr>
                      <th scope="row">Emergency Numeber</th>
                      <td>{{ $user -> emenrgency_number }}</td>
                    </tr>

                    
                  </tbody>
                </table>
                <hr>
                <h2>medical information</h2>
                <hr>
                <p><span>Blood Type: </span> {{ $user_BT }}</p>
                <div class="row">
                  <div class="col-12">
                    <h4>Treatments</h4>
                    
                      @if(!empty($treatments))
                        <ul>
                        @foreach($treatments as $one)
                          <li>{{ $one->name }}</li>
                        @endforeach
                      </ul>
                      @else
                        {{ "This Patient doesn't take any drugs" }}
                      @endif
                    
                  </div>
                  <div class="col-12">
                    <h4>Diseases</h4>
                    
                    @if(!empty($diseases))
                      <ul>
                        @foreach($diseases as $one)
                          <li>{{ $one->name }}</li>
                        @endforeach
                        </ul>
                      @else
                        {{ "This Patient doesn't have any disease" }}
                      @endif
                    
                  </div>
                  <div class="col-12 mt-3">
                    <h4>Medical Reports</h4>
                    <ul>
                        @foreach($reports as $one)
                            <li>
                                <a href='{{ url("/user/files/$one->report_file") }}'>{{ $one->report_name }}</a>
                            </li>
                        @endforeach
<!--                       <li><a href="javascript:">Report 1</a></li>
                      <li><a href="javascript:">Report 2</a></li>
                      <li><a href="javascript:">Report 3</a></li> -->
                    </ul>
                  </div>
                </div>
              </div>
            </section>

          <!------------------------------- End Of Form ------------------------------->
        </div>

      <!-- End page-content -->
      <!-- ------------------------------------- -->
  @endsection

  @section('scripts')
  @endsection
