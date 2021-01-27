@extends('superAdmin.layouts.master')
@section('title', 'Add Blood Bank')
@section('content')

<section class="container">
        <div class="row justify-content-center">
        <h3 class="text-center col-12 h1 my-5 text-muted">All Messages</h3>
          <div class="col-lg-8 col-sm-10">
            <!-- Partner Requests-->
            <div id="daily-feeds" class="card updates daily-feeds">
              <div id="feeds-header" class="card-header d-flex justify-content-between align-items-center">
                <h2 class="h5 display"><a data-toggle="collapse" data-parent="#daily-feeds" href="#feeds-box" aria-expanded="true" aria-controls="feeds-box">Messages </a></h2>
                <div class="right-column">
                  <div class="badge badge-primary">{{$countmessage->count}} Message Not readed</div>
                </div>
              </div>
              <div id="feeds-box" role="tabpanel" class="collapse show">
                <div class="feed-box">
                  <ul class="feed-elements list-unstyled">
                  @if(($countmessage->count) > 0)
                  @foreach($messages as $msg)
                    <li class="clearfix">
                      <div class="feed d-flex justify-content-between">
                        <div class="feed-body d-flex justify-content-between"><!--<a href="#" class="feed-profile"><img src="resources/img/avatar-5.png" alt="person" class="img-fluid rounded-circle"></a>-->
                          <div class="content"><strong>{{$msg->	email}}</strong> <!--<small>Posted a new blog </small> -->
                            <div class="full-date"><small>{{$msg->messages_Date}}</small></div>
                            <div class="CTAs"><a href='{{url("admin/editMsg/".$msg->id)}}'class="btn btn-xs btn-success">
                            @if($msg->seen)
                            <i class="far fa-eye" style="font-size: 20px;"></i>
                            @else <i class="far fa-eye-slash" style="font-size: 20px;"></i></a>
                            @endif
                            <a href='{{url("admin/delMsg/".$msg->id)}}' class="btn btn-xs btn-danger"><i class="fas fa-trash-alt" style="font-size: 20px;"></i></a></div>
                          </div>
                        </div>
                        <!--<div class="date"><small>1min ago</small></div>-->
                      </div>
                      <div class="message-card"> <small>{{$msg->message_content}}.</small></div>
                    </li>
                    @endforeach
                    @else
                    <li class="clearfix text-center">
                      <div class="feed d-flex justify-content-between">
                      <div ><strong>No Message</strong>
                      </div>
                      <div > <small>There is no Message</small></div>
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