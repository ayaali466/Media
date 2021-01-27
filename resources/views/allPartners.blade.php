@extends('layouts.app')
@section('title','Medical Care Home')
@section('styles')
<link rel="stylesheet" href="{{ url('/user/css/allpartner.css') }}">
<link rel="stylesheet" href="{{ url('/user/css/lab_page.css') }}">
@endsection

@section('content')
<!-- Start Content -->

 <!-- start All partners -->
 <section id="allPartners">
    <div class="container">
      <h2 class="tit bounceIn text-center display-4 font-weight-bold mb-5 pt-3"><span>Partners</span></h2>
      <div class="row justify-content-center">
        <div class="col-12 row justify-content-center mb-3">
        <div class="form-group col-md-5 col-xs-12">
        <form>
            <select class="custom-select" required name="type">
              <option selected disabled value="0">Select Partner type</option>
              <option value="1">Hospitals</option>
              <option value="2">Laboratories</option>
              <option value="3">Centers</option>
              <option value="4">Blood Banks</option>
            </select>
          </div>
          <div class="form-group col-md-5 col-xs-12">
            <input type="submit"  class="btn btns btn-block" value="search">
          </div>
        </div>
        </form>
        <!-- ---------------Hospital show---------------- -->
        <?php if(@$_REQUEST['type']==1){
           $count=0;?>
          @foreach($rhosbital as $one)
          <?php $count+=1;?>
          @if($count < 4 )
          <!-- Item1 -->
            <div id class="card pt-3  mb-xs-5 mb-4 text-center boxshaow moreBox" style="width: 18rem;">
              <img class=" card-img-top rounded-circle imageshaow mx-auto " src='{{URL::asset("/orgAdmin/img/$one->logo")}}' alt="Card image cap">
              <div class="card-body">
                <h5 class="card-title">{{$one->name}}</h5>
                <p class="card-text text-center">{{substr($one->about_us, 0,50)}}....</p>
                <a href='{{URL::asset("/hospitalPartner/$one->id")}}' class="btn btn-primary">Read More</a>
              </div>
            </div>
            @else
            <div id class="card pt-3  mb-xs-5 mb-4 text-center boxshaow moreBox" style="width: 18rem; display: none;">
              <img class=" card-img-top rounded-circle imageshaow mx-auto " src='{{URL::asset("/orgAdmin/img/$one->logo")}}' alt="Card image cap">
              <div class="card-body">
                <h5 class="card-title">{{$one->name}}</h5>
                <p class="card-text text-center">{{substr($one->about_us, 0,50)}}....</p>
                <a href='{{URL::asset("/hospitalPartner/$one->id")}}' class="btn btn-primary">Read More</a>
              </div>
            </div>
        @endif
          @endforeach
          <!-- -------------lap show------------- -->
        <?php } elseif(@$_REQUEST['type']==2){
          $count=0;?>
          @foreach($rlab as $one)
          <?php $count+=1;?>
          @if($count < 4 )
          <!-- Item1 -->
            <div class="card pt-3  mb-xs-5 mb-4 text-center boxshaow moreBox" style="width: 18rem;">
              <img class=" card-img-top rounded-circle imageshaow mx-auto " src='{{URL::asset("/orgAdmin/img/$one->logo")}}' alt="Card image cap">
              <div class="card-body">
                <h5 class="card-title">{{$one->name}}</h5>
                <p class="card-text text-center">{{substr($one->about_us, 0,50)}}....</p>
                <a href='{{URL::asset("/labPartner/$one->id")}}' class="btn btn-primary">Read More</a>
              </div>
            </div>
            @else
            <!-- Item1 -->
            <div class="card pt-3  mb-xs-5 mb-4 text-center boxshaow moreBox" style="width: 18rem; display: none;">
              <img class=" card-img-top rounded-circle imageshaow mx-auto " src='{{URL::asset("/orgAdmin/img/$one->logo")}}' alt="Card image cap">
              <div class="card-body">
                <h5 class="card-title">{{$one->name}}</h5>
                <p class="card-text text-center">{{substr($one->about_us, 0,50)}}....</p>
                <a href='{{URL::asset("/labPartner/$one->id")}}' class="btn btn-primary">Read More</a>
              </div>
            </div>
        @endif
          @endforeach
          <!-- ------------------center show------------- -->
          <?php } elseif(@$_REQUEST['type']==3){ 
            $count=0;?>
             @foreach($rcenter as $one)
            <?php $count+=1;?>
              @if($count < 4 )
            <!-- Item1 -->
              <div class="card pt-3  mb-xs-5 mb-4 text-center boxshaow moreBox" style="width: 18rem;">
                <img class=" card-img-top rounded-circle imageshaow mx-auto " src='{{URL::asset("/orgAdmin/img/$one->logo")}}' alt="Card image cap">
                <div class="card-body">
                  <h5 class="card-title">{{$one->name}}</h5>
                  <p class="card-text text-center">{{substr($one->about_us, 0,50)}}....</p>
                  <a href='{{URL::asset("/centerPartner/$one->id")}}' class="btn btn-primary">Read More</a>
                </div>
              </div>
              @else
              <div class="card pt-3  mb-xs-5 mb-4 text-center boxshaow moreBox" style="width: 18rem; display: none;">
                <img class=" card-img-top rounded-circle imageshaow mx-auto " src='{{URL::asset("/orgAdmin/img/$one->logo")}}' alt="Card image cap">
                <div class="card-body">
                  <h5 class="card-title">{{$one->name}}</h5>
                  <p class="card-text text-center">{{substr($one->about_us, 0,50)}}....</p>
                  <a href='{{URL::asset("/centerPartner/$one->id")}}' class="btn btn-primary">Read More</a>
                </div>
              </div>
          @endif
          @endforeach
        <!-- ------------------blood bank show------------- -->
          <?php } elseif(@$_REQUEST['type']==4){ 
            $count=0;?>
             @foreach($rbloodbank as $one)
            <?php $count+=1;?>
            @if($count < 4 )
              <!-- Item1 -->
            <div class="card pt-3  mb-xs-5 mb-4 text-center boxshaow moreBox" style="width: 18rem;">
              <img class=" card-img-top rounded-circle imageshaow mx-auto " src='{{URL::asset("/orgAdmin/img/$one->logo")}}' alt="Card image cap">
              <div class="card-body">
                <h5 class="card-title">{{$one->name}}</h5>
                <p class="card-text text-center">{{substr($one->about_us, 0,50)}}....</p>
                <a href='{{URL::asset("/bloodPartner/$one->id")}}' class="btn btn-primary">Read More</a>
              </div>
            </div>
            @else
            <div class="card pt-3  mb-xs-5 mb-4 text-center boxshaow moreBox" style="width: 18rem; display: none;">
              <img class=" card-img-top rounded-circle imageshaow mx-auto " src='{{URL::asset("/orgAdmin/img/$one->logo")}}' alt="Card image cap">
              <div class="card-body">
                <h5 class="card-title">{{$one->name}}</h5>
                <p class="card-text text-center">{{substr($one->about_us, 0,50)}}....</p>
                <a href='{{URL::asset("/bloodPartner/$one->id")}}' class="btn btn-primary">Read More</a>
              </div>
            </div>
        @endif
          @endforeach
            <?php } else{ ?>
            <!-- ----------------hospitalshow-------------- -->
            <?php $count=0;?>
            @foreach($rhosbital as $one)
            <?php $count+=1;?>
            @if($count < 4 )
            <!-- Item1 -->
          <div class="card pt-3  mb-xs-5 mb-4 text-center boxshaow moreBox" style="width: 18rem;">
            <img class=" card-img-top rounded-circle imageshaow mx-auto " src='{{URL::asset("/orgAdmin/img/$one->logo")}}' alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">{{$one->name}}</h5>
              <p class="card-text text-center">{{substr($one->about_us, 0,50)}}....</p>
              <a href='{{URL::asset("/hospitalPartner/$one->id")}}' class="btn btn-primary">Read More</a>
            </div>
          </div>
        @endif
          @endforeach
        <!-- -------------------------lap show--------------- -->
            <?php $count=0;?>
              @foreach($rlab as $one)
                <?php $count+=1;?>
                @if($count < 4 )
                <!-- Item1 -->
              <div class="card pt-3  mb-xs-5 mb-4 text-center boxshaow moreBox" style="width: 18rem;">
                <img class=" card-img-top rounded-circle imageshaow mx-auto " src='{{URL::asset("/orgAdmin/img/$one->logo")}}' alt="Card image cap">
                <div class="card-body">
                  <h5 class="card-title">{{$one->name}}</h5>
                  <p class="card-text text-center">{{substr($one->about_us, 0,50)}}....</p>
                  <a href='{{URL::asset("/labPartner/$one->id")}}' class="btn btn-primary">Read More</a>
                </div>
              </div>
              @endif
          @endforeach
          <!-- -------------------center show ------------------- -->
          <?php $count=0;?>
            @foreach($rcenter as $one)
              <?php $count+=1;?>
              @if($count < 4 )
              <!-- Item1 -->
            <div class="card pt-3  mb-xs-5 mb-4 text-center boxshaow moreBox" style="width: 18rem;">
              <img class=" card-img-top rounded-circle imageshaow mx-auto " src='{{URL::asset("/orgAdmin/img/$one->logo")}}' alt="Card image cap">
              <div class="card-body">
                <h5 class="card-title">{{$one->name}}</h5>
                <p class="card-text text-center">{{substr($one->about_us, 0,50)}}....</p>
                <a href='{{URL::asset("/centerPartner/$one->id")}}' class="btn btn-primary">Read More</a>
              </div>
            </div>
        @endif
          @endforeach
          <!-- ---------------blood bank show--------------- -->
          <?php $count=0;?>
             @foreach($rbloodbank as $one)
            <?php $count+=1;?>
            @if($count < 4 )
          <!-- Item1 -->
            <div class="card pt-3  mb-xs-5 mb-4 text-center boxshaow moreBox" style="width: 18rem;">
              <img class=" card-img-top rounded-circle imageshaow mx-auto " src='{{URL::asset("/orgAdmin/img/$one->logo")}}' alt="Card image cap">
              <div class="card-body">
                <h5 class="card-title">{{$one->name}}</h5>
                <p class="card-text text-center">{{substr($one->about_us, 0,50)}}....</p>
                <a href='{{URL::asset("/bloodPartner/$one->id")}}' class="btn btn-primary">Read More</a>
              </div>
            </div>
        @endif
          @endforeach
          <?php } if (@$_REQUEST['type']==1 || @$_REQUEST['type']==2 || @$_REQUEST['type']==3 || @$_REQUEST['type']==4){ ?>
            <div class="col-12 row justify-content-center">
              <div class="form-group col-lg-5 col-md-8 col-xs-12 mb-4 mt-1">
                <button id="loadMore"  type="submit" class="btn btns btn-block">see more</button>
              </div>
            </div>
          <?php } ?>
      </div>
    </div>

  </section>
  <!-- end All partner -->

  <!-- End Content -->
  <!-- ------------------------------------- -->
@endsection
@section('scrollingIcon')
  
  <li><a class="scroll-to-top" scroll-to-top-time="2000"><i class="fa fa-arrow-circle-up"></i></a></li>

@endsection
@section('scripts')
  <script src="{{ url('/user/js/main.js') }}"></script>
  <script src="{{ url('/user/js/seemore.js') }}"></script>
@endsection