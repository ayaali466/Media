@extends('superAdmin.layouts.master')
@section('title', 'Add Blood Bank')
@section('content')

<!-- Hospital Form -->
<div class="row mt-5">
    @if(Session::has('success'))
       <div class="alert alert-success mr-auto ml-auto col-md-5 text-center"> {{Session::get('success')}}</div>
        @php
            Session::forget('success');
        @endphp
    @endif

    <!-- @if($errors->any())
      <div class="alert alert-danger mx-auto">
        <ul>
          @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif -->

        <h3 class="text-center h1 mt-5 col-12">Add Hospital</h3>
        <div class="col-md-6 col-lg-4 col-sm-8 mx-auto mt-3">
          <form action="{{route('admin.add_hospital')}}" method="POST">
          @csrf
            <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 2.5rem;"> <i class="far fa-hospital"></i> </span>
                 </div>
                <input name="name" class="form-control" placeholder="Hospital Name" type="text">
              </div> <!-- form-group Name -->
              @if($errors->has('name'))
             <li class="alert alert-danger"> {{$errors->first('name')}}</li>
              @endif
              <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 2.5rem;"> <i class="fas fa-envelope"></i> </span>
                 </div>
                <input name="email" class="form-control" placeholder="Hospital Email" type="email">
              </div> <!-- form-group Name -->
              @if($errors->has('email'))
             <li class="alert alert-danger"> {{$errors->first('email')}}</li>
              @endif

              <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 2.5rem;"> <i class="fa fa-lock"></i> </span>
                </div>
                <input name="password" class="form-control" placeholder="Password" type="password">
              </div> <!-- form-group Password -->
              @if($errors->has('password'))
             <li class="alert alert-danger"> {{$errors->first('password')}}</li>
              @endif

              <div class="form-group offset-3 col-6">
                <button type="submit" class="btn btn-primary btn-block"> Add</button>
              </div>

            </form>
          </div>
      </div>

      <!-- End Hospital Form -->
      


@endsection