@extends('orgAdmin.layouts.o_app')
@section('title','Post Article')
@section('styles')
<link rel="stylesheet" href="{{ url('/css/form.css') }}">
<style>
    textarea::placeholder {
      text-align: center;
      line-height: 120px;
    }
  </style>
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
          <h2 class="text-center">Post an article</h2>
          <hr>
          <!------------------------------- Post Artcile ------------------------------->

          <!------------------------------- Start Of Form ------------------------------->
          <form method="POST" action="{{route('post_article')}}" class="ValidationForm" enctype="multipart/form-data" novalidate>
            @csrf
            <div class="row">
            <!-- article_type_id -->


            <!------------------------------- Article Type ------------------------------->
              <div class=" col-md-6 offset-md-3 col-sm-8 offset-sm-2">
                <div class="form-group">
                  <select class="custom-select selected-governorate" name="article_type_id">
                  <option selected disabled value="">* Article Type</option>
                    @foreach($article_types as $article_type)
                      <option value="{{ $article_type -> id }}">{{ $article_type -> type_name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="alert alert-danger custom-alert">
                  
                </div>
              </div>
              <!------------------------------- Article Title ------------------------------->
              <div class=" col-md-6 offset-md-3 col-sm-8 offset-sm-2">
                <div class="form-group input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 2.5rem;"> <i class="fas fa-newspaper"></i> </span>
                  </div>
                  <input name="article_title" class="name form-control" placeholder="* Article Title" type="text">
                </div> <!-- form-group Name -->
                <div class="alert alert-danger custom-alert">
                  
                </div>
              </div>
              <!------------------------------- Article Image ------------------------------->
              <div class=" col-md-6 offset-md-3 col-sm-8 offset-sm-2">
                <div class="custom-file mb-3">
                  <input type="file" class="imageprofile custom-file-input" id="article_Image" name="article_Image">
                  <label class="custom-file-label" for="article_Image">* Article Image</label>
                </div>
                <div class="alert alert-danger custom-alert">
                  
                </div>
              </div>

              <!------------------------------- descreption ------------------------------->
              <div class="offset-md-2 col-md-8 col-12">
                <div class="form-group input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 2.5rem;"> <i class="fas fa-align-left"></i> </span>
                  </div>
                  <textarea name="articleContent" class="textcontent form-control" rows="5" placeholder="Article Content"></textarea>
                </div> <!-- form-group Name -->
                <div class="alert alert-danger custom-alert">
                  
                </div>
              </div>
              

              <!------------------------------- Submit Button ------------------------------->
              <div class="form-group offset-md-4 col-md-4">
                <!-- offset-3 col-6 -->
                <!-- disabled -->
                <button type="submit" name="submit" class="btn btn-primary btn-block">Send</button>
              </div> <!-- form-group// -->
            </div>
            <p id="all-field-well" class="text-center"><i class="fas fa-times"></i> Enter all fields to Continue</p>
          </form>

          <!------------------------------- End Of Form ------------------------------->
        </div>

      <!-- End page-content -->
      <!-- ------------------------------------- -->
  @endsection

  @section('scripts')
  <script src="{{ url('/orgAdmin/js/article_Validation.js') }}"></script>
  @endsection
