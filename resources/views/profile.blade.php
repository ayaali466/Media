@extends('layouts.userApp')
@section('title','Profile')
@section('styles')
<link rel="stylesheet" href="{{ url('/user/css/profile.css') }}">
@endsection

@section('content')
  <!-- Start Content -->
    <!--start profile-->
  <div class="container mx-auto">
    <div class="row">
      <div class="col-lg-12 col-md-12 ">
        <div class="pt-4 px-4">
          <h2 class="text-center">Patient Profile</h2>
        </div>
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-lg-4 col-md-12 ">
        <div class="card flex-row flex-wrap patient_card1">
          <div class="card-header">
            <img src="{{ url('user/img/users/1.jpg') }}" class="img-fluid rounded-circle" alt="patient photo">
          </div>
          <h4 class="text-center my-3 mx-auto">Yusuf Ali</h4>
        </div>
      </div>
      <div class="col-lg-4   col-md-12 ">
        <div class="card text-center">
          <div class="card-body">
            <h5 class="card-title card-header">Gender</h5>
            <p class="card-text">female</p>
            <h5 class="card-title card-header">Birth date</h5>
            <p class="card-text">november</p>
            <h5 class="card-title card-header">Email</h5>
            <p class="card-text">patient@gmail.com</p>
            <h5 class="card-title card-header">Phone</h5>
            <p class="card-text">0111111111</p>
            <a href="#" class="btn btn-primary w-50">Edit</a>
          </div>
        </div>
      </div>

      <div class="col-lg-4   col-md-12 ">
        <div class="card text-center">
          <div class="card-body">
            <h5 class=" card-title card-header">blood type</h5>
            <p class="card-text">O+</p>




            <div class="dropdown mb-3">
              <span class="btn btn-primary toggle w-100">Diseases</span>
              <ul class="dropdown-menu-part list-group">
                <li class="list-group-item">pressure</li>
                <li class="list-group-item">Diabetes</li>
                <li class="list-group-item">Paralysis</li>
              </ul>
            </div>

            <div class="dropdown mb-3">
              <span class="btn btn-primary toggle w-100">Treatments</span>
              <ul class="dropdown-menu-part list-group">
                <li class="list-group-item">corasor</li>
                <li class="list-group-item">panadol</li>
                <li class="list-group-item">congestal</li>
              </ul>
            </div>
            <div class="dropdown mb-3">
              <span class="btn btn-primary toggle w-100">Medical Reports</span>
              <ul class="dropdown-menu-part list-group">
                <li class="list-group-item"><a href="">Report1(xxx) 15-1-2020</a></li>
                <li class="list-group-item"><a href="">Report2(xxx) 25-1-2020</a></li>
                <li class="list-group-item"><a href="">Report3(xxx) 13-2-2020</a></li>
                <li class="list-group-item"><a href="">Report4(xxx) 25-3-2020</a></li>
                <li class="list-group-item"><a href="">Report5(xxx) 4-4-2020</a></li>
              </ul>
            </div>

            <form action="" method="post" enctype="multipart/form-data">
              <div class="custom-file text-left">
                <input type="file" class="image custom-file-input" id="customFile" name="profileImage">
                <label class="custom-file-label" for="customFile">Upload new report</label>
              </div>
              <!-- </div> -->
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--end profile-->
  <!-- End Content -->
  @endsection
  @section('scrollingIcon')
  <ul class="social-icons">
    <li><a class="scroll-to-top" scroll-to-top-time="1000"><i class="fa fa-arrow-circle-up"></i></a></li>
  </ul>
  @endsection
  @section('scripts')
    <script src="{{ url('/user/js/profile.js') }}"></script>
  @endsection

  