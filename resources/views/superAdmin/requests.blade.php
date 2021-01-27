@extends('superAdmin.layouts.master')
@section('title', 'Requests')
@section('content')
<section class="container">
        <div class="row justify-content-center">
        <h3 class="text-center col-12 h1 my-5 text-muted">All Requests</h3>
          <div class="col-lg-8 col-sm-10">
            <!-- Partner Requests-->
            <div id="daily-feeds" class="card updates daily-feeds">
              <div id="feeds-header" class="card-header d-flex justify-content-between align-items-center">
                <h2 class="h5 display"><a data-toggle="collapse" data-parent="#daily-feeds" href="#feeds-box" aria-expanded="true" aria-controls="feeds-box">Partners Requests </a></h2>
                <div class="right-column">
                  <div class="badge badge-primary">{{$countrequest->count}} Requests Not readed</div>
                </div>
              </div>
              <div id="feeds-box" role="tabpanel" class="collapse show">
                <div class="feed-box">
                   <ul class="feed-elements list-unstyled"> 
                   @if(($countrequest->count) > 0)
                   @foreach($requests as $request)
                    <!-- List-->
                    <li class="clearfix">
                      <div class="feed d-flex justify-content-between">
                        <div class="feed-body d-flex justify-content-between"><a href="#" class="feed-profile"><img src='{{URL::asset("orgAdmin/img/$request->logo")}}' alt="logo" class="img-fluid rounded-circle"></a>
                          <div class="content"><strong>{{$request->name}}</strong>
                            <div class="full-date"><small>{{$request->request_Date}}</small></div>
                            <div class="CTAs">
                            
                            <a href="{{route('allowrequest', ['id' => $request->id])}}" class="btn btn-xs btn-success"><i class="fas fa-check"></i>Allow</a>
                            <a href="{{route('refuserequest', ['id' => $request->id])}}" class="btn btn-xs btn-danger"><i class="fas fa-ban"></i>Refuse</a>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="message-card"> <small>{{$request->message_content}}</small></div>
                    </li>
                    @endforeach
                    @else
                    <li class="clearfix text-center">
                      <div class="feed d-flex justify-content-between">
                      <div ><strong>No Requests</strong>
                      </div>
                      <div > <small>There is no unreaded Requests</small></div>
                    </li>
                    @endif
                  </ul>
                </div>
              </div>
            </div>
            <!-- End Partner Requests-->
          </div>
        </div>
      </section>



@endsection