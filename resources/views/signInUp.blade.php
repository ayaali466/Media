@extends('layouts.userApp')
@section('title','Login/SignUp')
@section('styles')
<link rel="stylesheet" href="{{ url('/user/css/signInUP.css') }}">
@endsection

@section('content')
  <!-- Start Content -->
    <!-- Select Sign In OR Sign Up -->
  <div class="buttons-container mx-auto mt-3" style="width:220px;">
    <ul>
      <li class="active"><a href="javascript:;" class="active-text"><i class="fas fa-sign-in-alt"></i></a></li>
      <!--  <li><a href="#"><i class="fa fa-coffee" aria-hidden="true"></i></a></li>
              <li><a href="#"><i class="fa fa-user-circle" aria-hidden="true"></i></a></li> -->
      <li><a href="javascript:;"><i class="fas fa-user-plus"></i></a></li>

    </ul>
  </div>

  <!-- Sign in -->
  <div class="container signinClass">
    <div class="row">
      <div class="col-sm-9 col-md-6 col-lg-4 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center">Welcome back!</h5>
            <form class="form-signin" action="" method="POST">
              <div class="form-label-group">
                <input type="email" class="form-control" placeholder="Email address" required>
              </div>

              <div class="form-label-group">
                <input type="password" class="form-control" placeholder="Password" required>
              </div>
              <div class="custom-control custom-checkbox text-center mt-2 mb-2">
                <input type="checkbox" class="custom-control-input" id="customCheck1">
                <label class="custom-control-label" for="customCheck1">Remember Me</label>
              </div>
              <div class="text-center mb-4 forgetpassword">
                <a href="#">Forget password</a>
              </div>
              <!-- <div class="custom-control custom-checkbox mb-3">
                                <input type="checkbox" class="custom-control-input">
                            </div> -->
              <button class="btn btn-lg btn-block text-uppercase submit-button" type="submit">Sign in</button>
              <hr class="my-4">
              <!-- <button class="btn btn-lg btn-google btn-block text-uppercase" type="submit"><i class="fab fa-google mr-2"></i> Sign in with Google</button> -->
              <!-- <button class="btn btn-lg btn-facebook btn-block text-uppercase" type="submit"><i class="fab fa-facebook-f mr-2"></i> Sign in with Facebook</button> -->
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Sign Up -->
  <div class="container d-none signupClass">
    <div class="row">
      <div class="col-sm-9 col-md-6 col-lg-4 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center">Register</h5>
            <form class="form-signin">
              <div class="form-label-group">
                <input type="text" class="form-control" placeholder="Username" required>
              </div>

              <div class="form-label-group">
                <input type="email" class="form-control" placeholder="Email address" required>
              </div>


              <div class="form-label-group">
                <input type="password" class="form-control" placeholder="Password" required>
              </div>

              <div class="form-label-group">
                <input type="password" id="inputConfirmPassword" class="form-control" placeholder="Confirm password"
                  required>
              </div>

              <div class="custom-control custom-checkbox text-center mt-2 mb-4">
                <input type="checkbox" class="custom-control-input" id="customCheck2">
                <label class="custom-control-label" for="customCheck2">Agree to terms and conditions</label>
              </div>

              <button class="btn btn-lg btn-block text-uppercase submit-button" type="submit">Register</button>
              <hr class="my-4">
              <button class="btn btn-lg btn-google btn-block text-uppercase" type="submit"><i
                  class="fab fa-google mr-2"></i> Sign up with Google</button>
              <button class="btn btn-lg btn-facebook btn-block text-uppercase" type="submit"><i
                  class="fab fa-facebook-f mr-2"></i> Sign up with Facebook</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Content -->
  @endsection
  @section('scrollingIcon')
  <ul class="social-icons">
    <li><a class="scroll-to-top" scroll-to-top-time="2000"><i class="fa fa-arrow-circle-up"></i></a></li>
  </ul>
  @endsection
  @section('scripts')
  <script src="{{ url('/user/js/signInUp.js') }}"></script>
  @endsection

  