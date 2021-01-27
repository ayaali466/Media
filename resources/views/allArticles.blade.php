@extends('layouts.app')
@section('title','Articles')
@section('styles')
<link rel="stylesheet" href="{{ url('/user/css/article.css') }}">
@endsection
@section('content')
<!-- Start Content -->

<div id="allArticles">
    <div class="secartop">
      <div class="container">
        <h2 class="tit bounceIn text-center display-4 font-weight-bold mb-5 pt-3"><span>Articles</span></h2>
        <form action="{{url('/allArts')}}" method="post">
        @csrf
        <div class="row justify-content-center">
          <div class="form-group col-md-5 col-xs-12" >
            <select class="custom-select" required name="articleTypes">
              <option selected disabled value="">Select article type</option>
              <option value="1">Medical Advices</option>
              <option value="2">Viruses</option>
              <option value="3">Bacterias</option>
            </select>
          </div>
          <div class="form-group col-md-5 col-xs-12">
            <button type="submit" class="btn btns btn-block">search</button>
          </div>
        </div>
        </form>

        <!--div aflet el form-->
                      <div class="row justify-content-center">
                        <!-- Item1 --> 
                    @if($articles)
                    <?php $count=0;?>
                    @foreach($articles as $article)
                    <?php $count+=1;?>
                        @if($count < 7 )
                        <div class="col-lg-4 col-md-6 mb-3 boxshow moreBox">
                          <div class="articleHover articleHover-4 text-white rounded"><img src='{{ URL::asset("/orgAdmin/img/$article->profile_image") }}' alt="">
                            <div class="articleHover-overlay"></div>
                            <div class="articleHover-4-content ">
                              <h3 class="articleHover-4-title font-weight-bold mb-0"><span class="font-weight-light"></span>{{$article->title}}
                              </h3>
                              <p class=" articleHover-4-description mb-0 small">{{substr($article->content,0,70)}}
                              <a data-scroll href='{{url("/oneArticle/".$article->id)}}'
                              class="btn btn-default  fadeInUp" data-wow-offset="50" data-wow-delay="0.6s"style="height:76px;">
                              Learn More</a></p>
                            
                            </div>
                          </div>
                        </div>
                        @else
                        <div class="col-lg-4 col-md-6 mb-3 boxshow moreBox" style=" display: none;">
                          <div class="articleHover articleHover-4 text-white rounded"><img src='{{ URL::asset("/orgAdmin/img/$article->profile_image") }}' alt="">
                            <div class="articleHover-overlay"></div>
                            <div class="articleHover-4-content ">
                              <h3 class="articleHover-4-title font-weight-bold mb-0"><span class="font-weight-light"></span>{{$article->title}}
                              </h3>
                              <p class=" articleHover-4-description mb-0 small">{{substr($article->content,0,70)}}
                              <a data-scroll href='{{url("/oneArticle/".$article->id)}}'
                              class="btn btn-default  fadeInUp" data-wow-offset="50" data-wow-delay="0.6s"style="height:76px;">
                              Learn More</a></p>
                            
                            </div>
                          </div>
                        </div>
                        @endif
                    @endforeach
                  </div> 
                  <form>
              <div class="col-12 row justify-content-center">
                @if($countart > 6)
                <div class="form-group col-lg-5 col-md-8 col-xs-12 mb-4 mt-1">
                  <button id="loadMore" type="submit" class="btn btns btn-block">see more</button>
                </div>
                @endif
            @else
                <div class="card-body text-center nores"> <h3 style="color:rgba(13, 95, 95, 1);"> No Resulet</h3>
                <p class="b"> there are other choices</p></div>
            @endif
          </div>
        </div>
</form>
        <!--div  wakhda class row w shayla el items (articles bs)-->

      </div>
      <!--container class div-->
    </div>
    <!--secartop div-->
  </div>
  <!--secart div-->


  <!-- End Articles -->


  <!-- End Content -->
  <!-- ------------------------------------- -->


  @endsection
  @section('scrollingIcon')
  
  <li><a class="scroll-to-top" scroll-to-top-time="2000"><i class="fa fa-arrow-circle-up"></i></a></li>

  @endsection
  @section('scripts')
  <script src="{{ url('/user/js/seemore.js') }}"></script>
  @endsection