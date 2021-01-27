@extends('orgAdmin.layouts.o_app')
@section('title','Delete Department')
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
          <h2 class="text-center">Delete Department</h2>
          <hr>
          @isset($msg)
            <div class="alert <?php echo substr($msg,strlen($msg)-1,1) !== '!'?  "alert-success" : "alert-danger" ?>" role="alert">
              {{ $msg }}
            </div>
          @endisset
          <!------------------------------- Delete Department ------------------------------->

          <!------------------------------- Start Of Form ------------------------------->
          <form method="POST" action="{{route('deleteDepartment')}}" class="ValidationForm" enctype="multipart/form-data">
            @csrf
            <div class="row">

              <!------------------------------- Departments ------------------------------->
              <div class="offset-md-3 col-md-6 col-xs-12 mt-5">
                <div class="form-group">
                  <select class="custom-select selected-governorate" name="selected_department">
                    <option selected disabled value="">Departments</option>
                    
                    @foreach($all_deps as $dep)
                      <option value="{{ $dep -> id }}">{{$dep -> name}}</option>
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
