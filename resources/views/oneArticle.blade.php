@extends('layouts.app')
@section('title','Articles')
@section('styles')
<link rel="stylesheet" href="{{ url('/user/css/article.css') }}">
@endsection

@section('content')
   <!-- Start Content -->

@foreach($arts as $art)
         <div class="fdiv text-center container">
      <h3>{{$art->title}}</h3>
      <h6 class=" text-muted">{{$art->type_name}}</h6>
      <img src='{{ url("/user/img/articles/$art->profile_image")}}' class="img-fluid img-thumbnail" alt="...">
   </div>

   </div>
   </div>
   <!-- <div class=" secart">
            <div class="secartop"> -->

   <div class="psec">
      <div class="container text-justify">
            <h4 class="h5 text-center">{{$art->title}}</h4>
            <p>
             {{$art->content}} 
             <br>
            @if(is_null($art->hospital_id))
            <span style="color:#28a7e9"> Written by: MedicalCare Website</span>
            @else
            <span style="color:#28a7e9"> Written by: {{$art -> name}} </span>
            @endif
            </p>
      </div>
   </div>
   @endforeach
   <!-- </div>
            </div> -->



   <!-- <div class=" secart">
                  <div class="secartop"> -->

   <!-- Start Articles -->
   <div class="container py-3 px-2 artdiv ">
      <h4 class="text-center font-weight-bold mb-5 mt-5">Related articles</h4>

      <div class="row">
         <!-- Item1 -->
            <?php $count=0;?>
            @foreach($RelatedArts as $RelatedArt)
               
         <div class="col-lg-4 mb-3 mb-lg-0 boxshow moreBox">
            <div class="articleHover articleHover-4 text-white rounded"><img src='{{ url("/user/img/articles/$RelatedArt->profile_image")}}' alt="">
               <div class="articleHover-overlay"></div>
               <div class="articleHover-4-content">
                  <h3 class="articleHover-4-title font-weight-bold mb-0"><span
                        class="font-weight-light"></span>{{$RelatedArt->title}}</h3>
                  <p class="articleHover-4-description mb-0 small">{{substr($RelatedArt->content,0,70)}}
                  <a data-scroll href="{{url('/oneArticle/'.$RelatedArt->id)}}"
                        class="btn btn-default  fadeInUp" data-wow-offset="50" data-wow-delay="0.6s">Learn More</a></p>
               </div>
            </div>
         </div>
         
         
         @endforeach
      </div> <!-- di aflet div row gwa container el articles-->
      
   <!-- End Articles -->
   </div>
   </div>
   <!-- </div>  di aflet  el container shayl kolo-->
   <!-- End Content -->
   <!-- ------------------------------------- -->
   @endsection

@section('scrollingIcon')
  <li><a class="scroll-to-top" scroll-to-top-time="2000"><i class="fa fa-arrow-circle-up"></i></a></li>
@endsection
@section('scripts')

@endsection