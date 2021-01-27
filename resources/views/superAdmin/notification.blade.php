@extends('superAdmin.layouts.master')
@section('title', 'Add Blood Bank')
@section('content')

<section class="container">
        <div class="row justify-content-center">
        <h3 class="text-center col-12 h1 my-5 text-muted">All Actions</h3>
          <div class="col-lg-8 col-sm-10">
            <!-- Partner Requests-->
            <div id="daily-feeds" class="card updates daily-feeds">
              <div id="feeds-header" class="card-header d-flex justify-content-between align-items-center">
                <h2 class="h5 display"><a data-toggle="collapse" data-parent="#daily-feeds" href="#feeds-box" aria-expanded="true" aria-controls="feeds-box">Partners Actions </a></h2>
                <div class="right-column">
                  <div class="badge badge-primary">{{$countnotifi->count}} Actions not Readed</div>
                </div>
              </div>
              <div id="feeds-box" role="tabpanel" class="collapse show">
                <div class="feed-box">
                  <ul class="feed-elements list-unstyled">
                    <!-- List-->
                    @if(($countnotifi->count) >0)
                    @foreach($actions as $action)
                    <li class="clearfix">
                      <div class="feed d-flex justify-content-between">
                        <div class="feed-body d-flex justify-content-between"><a href="#" class="feed-profile"><img src='{{url("orgAdmin/img/$action->logo")}}'  class="img-fluid rounded-circle"></a>
                          <div class="content"><strong>{{$action->name}}</strong> <!--<small>Posted a new blog </small> -->
                            <div class="full-date"><small>{{$action->action_Date}}</small></div>
                            <div class="CTAs"><a href='{{url("admin/notifications/".$action->id)}}' class="btn btn-xs btn-success">
                            @if($action->seen)
                            <i class="far fa-eye" style="font-size: 20px;"></i>
                           @else <i class="far fa-eye-slash" style="font-size: 20px;"></i></a>
                           @endif
                            <a href='{{url("admin/delNotifi/".$action->id)}}' class="btn btn-xs btn-danger"><i class="fas fa-trash-alt" style="font-size: 20px;"></i></a></div>
                          </div>
                        </div>
                        <!-- <div class="date"><small>1min ago</small></div> -->
                      </div>
                      <div class="message-card"> <small>{{$action->action_content}}</small></div>
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