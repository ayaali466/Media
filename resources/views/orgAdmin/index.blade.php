@extends('orgAdmin.layouts.o_app')
@section('title','Home')
@section('styles')
@endsection

@section('content')
        <!-- page-content" -->
        <div class="container">
          <h2 class="text-center">Saudi German Hospital Cairo</h2>
          <hr>
          <p class="text-justify container">
            {{ hospital -> about_us}}
          </p>
        </div>
        <div class="container">
          <div id="departments">
            <ul>
              @isset($departments)
              @foreach($departments as $department)
              <li>{{ $department -> name }}</li>
              @endforeach
              @endisset
            </ul>
          <h2 class="text-center">departments</h2>
          </div>
          <hr>
          <p class="text-justify container">
            <ul style="">
              <li><i class="fas fa-envelope"></i> : {{ $hosoital -> email }} </li>
            </ul>
          </p>
        </div>

      <!-- End page-content -->
      <!-- ------------------------------------- -->
  @endsection

  @section('scripts')
  @endsection
