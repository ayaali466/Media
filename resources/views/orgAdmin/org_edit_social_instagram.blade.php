@extends('orgAdmin.layouts.o_app')
@section('title','Edit Instagram Page')
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
        @else
          @isset($status)
            <div class="alert alert-success">
                {{ $status }}
            </div>
          @endisset
        @endif
      <!-- page-content" -->
      <div class="container">
          <h2 class="text-center">Edit Instagram</h2>
          <hr>
          <!------------------------------- Edit Instagram ------------------------------->

          <!------------------------------- Start Of Form ------------------------------->
          <form method="POST" action="{{route('editInstagram')}}" class="ValidationForm" enctype="multipart/form-data" novalidate>
            @csrf
            <div class="row">
              <!------------------------------- Instagram ------------------------------->
              <div class="offset-md-2 col-md-8 col-xs-12 mt-5">
                <div class="form-group input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 2.5rem;"> <i class="fab fa-instagram"></i> </span>
                  </div>
                  <input name="instagram" class="url-instagram form-control" placeholder="Instagram" type="url" <?= ((isset($instagram))&&!is_null($instagram))?"value=\"$instagram\"" :"" ?>>
                </div>
                <div class="alert alert-danger custom-alert ">
                  
                </div>
              </div>

              <!------------------------------- Submit Button ------------------------------->
              <div class="form-group offset-md-4 col-md-4">
                <!-- offset-3 col-6 -->
                <!-- disabled -->
                <button type="submit" name="submit" class="btn btn-primary btn-block">Edit</button>
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
