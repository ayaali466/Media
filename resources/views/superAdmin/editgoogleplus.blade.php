@extends('superAdmin.layouts.master')
@section('title', 'Add Blood Bank')
@section('content')

<!-- Edit Google Plus Form -->
<div class="row mt-5">
    @if(Session::has('success'))
       <div class="alert alert-success mx-auto text-center"> {{Session::get('success')}}</div>
        @php
            Session::forget('success');
        @endphp
    @endif
        <h3 class="text-center h1 mt-5 col-12">Edit Google Plus Link</h3>
        <div class="col-md-6 col-lg-4 col-sm-8 mx-auto mt-3">
        @foreach($googleplus as $social)
            <form action="{{route('editgoogleplus')}}" method="post">
            {{csrf_field()}}
              <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 2.5rem;"> <i class="fab fa-google-plus-g"></i> </span>
                 </div>
                <input name="googleplus" class="form-control" placeholder="Google Plus Link" type="link" value="{{$social->google_plus}}">
              </div> <!-- form-group Name -->
              <div class="form-group offset-3 col-6">
                <button type="submit" class="btn btn-primary btn-block"> Edit</button>
              </div>
            </form>
            @endforeach
          </div>
      </div>

      <!-- End Edit Google Plus Form -->

@endsection