@extends('orgAdmin.layouts.o_app')
@section('title','Add Department')
@section('styles')
@endsection

@section('content')
      <!-- page-content" -->
      <div class="container">
          <h2 class="text-center">Add Department</h2>
          <hr>
          @if(strpos ($all_other_dep[count($all_other_dep)-1] -> name,"New Department ") !== false)
            <div class="alert <?php echo substr($all_other_dep[count($all_other_dep)-1] -> name,strlen($all_other_dep[count($all_other_dep)-1]->name)-1,1) !== '!'?  "alert-success" : "alert-danger" ?>" role="alert">
              {{ $all_other_dep[count($all_other_dep)-1] -> name }}
            </div>
            @php
            array_pop($all_other_dep);
            @endphp
          @endif
          <!------------------------------- Add Department ------------------------------->

          <!------------------------------- Start Of Form ------------------------------->
          <form method="POST" action="{{route('addDepartment')}}" class="ValidationForm" enctype="multipart/form-data">
            @csrf
            <div class="row">

              <!------------------------------- Departments ------------------------------->
              <div class="offset-md-3 col-md-6 col-xs-12 mt-5">
                <div class="form-group">
                  <select class="custom-select selected-governorate" name="selected_department">
                    <option selected disabled value="">Departments</option>
                    
                    @foreach($all_other_dep as $dep)
                      <option value="{{ $dep -> id }}">{{$dep -> name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>


              <!------------------------------- Submit Button ------------------------------->
              <div class="form-group offset-md-4 col-md-4">
                <!-- offset-3 col-6 -->
                <!-- disabled -->
                <button type="submit" name="submit" class="btn btn-success btn-block">Add</button>
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
