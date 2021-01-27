@extends('superAdmin.layouts.master')
@section('title', 'Add Blood Bank')
@section('content')

<!-- Edit Facebook Form -->
<div class="row mt-5">
    @if(Session::has('success'))
       <div class="alert alert-success mx-auto text-center"> {{Session::get('success')}}</div>
        @php
            Session::forget('success');
        @endphp
    @endif

        <h3 class="text-center h1 mt-5 col-12">Edit Facebook Link</h3>
        <div class="col-md-6 col-lg-4 col-sm-8 mx-auto mt-3">
        @foreach($facebook as $social)
           <form action="{{route('editfacebook')}}" method="post">
           {{csrf_field()}}
              <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 2.5rem;"> <i class="fab fa-facebook-f"></i> </span>
                 </div>
                <input name="facebook" class="form-control" placeholder="Facebook Link" type="link" value="{{$social->facebook}}">
              </div> 
              <!-- form-group Name -->
             <div class="form-group offset-3 col-6">
              <button type="submit" class="btn btn-primary btn-block"> Edit</button>
              </div>
            </form>
            @endforeach
          </div>
      </div>

      <!-- End Edit Facebook Form -->

@endsection