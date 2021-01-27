@extends('layouts.app')
@section('title','Medical Care Home')
@section('styles')
<link rel="stylesheet" href="{{ url('/user/css/mainPartner.css') }}">
<link rel="stylesheet" href="{{ url('/user/css/doc_card.css') }}">
@endsection

@section('content')

<!-- Start Content -->
<div class="container-fluid mb-5">
    <h2 class=" bounceIn text-center text-muted py-5  display-4 font-weight-bold"><span>Doctors</span></h2>
    <div class="row px-5">
    <?php $count=0;?>
        @foreach($doc as $doc)
        <?php $count+=1;?>
        @if($count < 4 )
        <div class="col-12 col-lg-4  boxshaow moreBox">
        @else
        <div class="col-12 col-lg-4  boxshaow moreBox" style="display: none;">
        @endif
            <div class="card">
                <label for="card{{$count}}" aria-hidden="true" class="d-block w-100 h-100">
                    <input type="checkbox" id="card{{$count}}" class="more" aria-hidden="true">
                    <div class="content">
                        <div class="front" style='background-image: url({{URL::asset("/orgAdmin/img/$doc->photo")}})'>
                            <div class="inner position-relative text-center">
                            </div>
                            <div class="caption text-center text-muted">
                                <h3>{{$doc->name}}</h3>
                            </div>
                        </div>
                        <div class="back">
                            <ul class="nav navcard justify-content-center nav-justified" role="tablist">
                                <li class="nav-item ">
                                    <a class="nav-link show" href="#bio" role="tab" data-toggle="tab">Bio</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#info" role="tab" data-toggle="tab">Info</a>
                                </li>
                                
                            </ul>
                            <div class="tab-content ">
                                <div role="tabpanel" class="tab-pane fade show active" id="bio">
                                    <div class="bio">
                                        <h3 id="bio_title">{{$doc->name}}</h3>
                                        <h5 class="card-title ">specialist:</h5>
                                        <span id="bio_description">
                                           {{$doc->title}}
                                        </span>
                                        <h5 class="card-title mt-2">Description:</h5>
                                        <span id="bio_description">
                                           {{substr($doc->description, 0,100)}}...
                                        </span>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="info">
                                    <div class="bio inline">
                                        <div class="row text-center">
                                            <div class="col pt-4">
                                                <!-- <div>
                                                    <span class="" id="albums_title"><i class="mr-2 mb-2 fas fa-star-half-alt"></i> Rate</span>
                                                </div> -->
                                                <!-- <div class="infodiv">
                                                    <div class="Stars  ml-3 mb-3" style="--ratingStars: {{$doc->reviews_sum/$doc->counter_reviews}};"
                                                        aria-label="Rating of this product is {{$doc->reviews_sum/$doc->counter_reviews}} out of 5.">
                                                    </div>
                                                </div> -->
                                            </div>
                                         
                                        </div>
                                        <div class="row text-center">
                                            <div class="col pt-4">
                                                <div>
                                                    <span class="" id="albums_title">fees</span>
                                                </div>
                                                <div>
                                                    <p class="card-text">{{$doc->fees}} LE <i class="fas fa-money-bill-wave"></i> </p>
                                                </div>
                                            </div>
                                         
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div >
                            <a href='{{URL::asset("/dprofile/$doc->id")}}' class="btn btn-signInUp text-white d-block mx-auto w-50 fixed-bottom mb-2">Show Profile</a>
                            </div>
                        </div>
                    </div>
                </label>
            </div>
        </div>
        @endforeach
        <!-- <div id="loadMore"  class="text-center col-12 text-muted py-5  display-4 font-weight-bold"><button class="btn btn-primary"><h5>See More</h5></button></div>  -->

    </div>
</div>
   <!-- End Content -->
   <!-- ------------------------------------- -->

   @endsection
   @section('scrollingIcon')
  <li><a class="scroll-to-top" scroll-to-top-time="2000"><i class="fa fa-arrow-circle-up"></i></a></li>
@endsection
@section('scripts')
  <script src="{{ url('/user/js/seemore.js') }}"></script>
  <script>
    $('li > a').on('click', function () {
        $('li').removeClass();
        $('li').addClass('nav-item');
        $(this).parent().addClass('nav-item active');
    });
</script>

<script>
      $('back .navcard li > a').on('click', function () {
        $('.back .navcard li').removeClass();
        $('.back .navcard li').addClass('nav-item');
        // $('.back .navcard li:first-child').addClass('active');
        // $(this).parent().siblings('li').removeClass('active');
        $(this).parent().addClass('nav-item active');
     }); 
</script>
@endsection