@extends('superAdmin.layouts.master')
@section('title', 'Add Blood Bank')
@section('content')

<!-- Blood Bank Form -->
<div class="row mt-5">
        <h3 class="text-center h1 mt-5 col-12">Add Blood Bank</h3>
        <div class="col-md-6 col-lg-4 col-sm-8 mx-auto mt-3">
            <form action="" method="">
              <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 2.5rem;"> <i class="fas fa-tint"></i> </span>
                 </div>
                <input name="email" class="form-control" placeholder="Blood Bank Email" type="email">
              </div> <!-- form-group Name -->

              <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 2.5rem;"> <i class="fa fa-lock"></i> </span>
                </div>
                <input name="password" class="form-control" placeholder="Password" type="password">
              </div> <!-- form-group Password -->

              <div class="form-group offset-3 col-6">
                <button type="submit" class="btn btn-primary btn-block"> Add</button>
              </div>

            </form>
          </div>
      </div>

      <!-- End Blood Bank Form -->

@endsection
