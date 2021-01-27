@extends('superAdmin.layouts.master')
@section('title', 'Home')
@section('content')
<!-- text first part -->
<div class="container p-0" style="width: 85%;">
      
      <!-- Statistics Section-->
      <section class="statistics">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4">
              <!-- All users-->
              <div class="card income text-center">
                <div class="icon"><i class="fas fa-user"></i></div>
                
                <div class="number">{{$user->count}}</div><strong class="text-primary">All Users</strong>
              </div> 
              
            </div>
            <div class="col-lg-4">
              <!-- All hospitals-->
              <div class="card income text-center">
                <div class="icon"><i class="fas fa-hospital"></i></div>
                @foreach($hospital as $hospitalcount)
                <div class="number">{{$hospitalcount}}</div><strong class="text-primary">All Hospitals</strong>
              </div>
              @endforeach
            </div>
            <div class="col-lg-4">
              <!-- All Labs-->
              <div class="card income text-center">
                <div class="icon"><i class="fas fa-flask"></i></div>
                @foreach($labs as $labscount)
                <div class="number">{{$labscount}}</div><strong class="text-primary">All Laboratories</strong>
              </div>
              @endforeach
            </div>
            <div class="col-lg-4">
              <!-- All Doctors-->
              <div class="card income text-center">
                <div class="icon"><i class="fas fa-user-md"></i></div>
                @foreach($doctor as $doctorcount)
                <div class="number">{{$doctorcount}}</div><strong class="text-primary">All Doctors</strong>
              </div>
              @endforeach
            </div>
           <div class="col-lg-4">
              <!-- All Orders-->
             <div class="card income text-center">
                <div class="icon"><i class="far fa-newspaper"></i></div>
                @foreach($article as $articlecount)
                <div class="number">{{$articlecount}}</div><strong class="text-primary">All Articales</strong>
              </div>
              @endforeach
            </div>
          
            </div>
          </div>
      </section>

    </div>
    <!-- text first part -->


    <!-- Updates Section -->
    <section class="mt-30px mb-30px">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-lg-4 col-md-12">
            <!-- Recent Updates Widget          -->
            <div id="new-updates" class="card updates recent-updated">
              <div id="updates-header" class="card-header d-flex justify-content-between align-items-center">
                <h2 class="h5 display"><a data-toggle="collapse" data-parent="#new-updates" href="#updates-box"
                    aria-expanded="true" aria-controls="updates-box">Partners Requests</a></h2>
                <div class="right-column">
                  <div class="badge badge-primary mr-2">{{$countrequest->count}} Requests</div><a data-toggle="collapse"
                    data-parent="#daily-feeds" href="#updates-box" aria-expanded="true" aria-controls="feeds-box"><i
                      class="fa fa-angle-down"></i></a>
                </div>
              </div>
              <div id="updates-box" role="tabpanel" class="collapse show">
                <div class="feed-box">
                  <ul class="feed-elements list-unstyled mb-0">
                    <!-- List-->
                    @if(($countrequest->count) > 0)
                    <?php $i=-1; ?>
                    @foreach($requests as $request)
                    <?php $i+=1; ?>
                    @if($i < 5)
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
                    
                    @elseif($i == 5)
                    <div class="text-center py-3" onMouseOver="this.style.backgroundColor='#ddd'" onMouseOut="this.style.backgroundColor='#FFFFFF'"><a href="{{route('admin.request')}}"> <i class="fas fa-sms"></i> See All Requests</a></div>
                    @endif
                    @endforeach
                    
                    @else

                    <li class="clearfix text-center">
                      <div class="feed d-flex justify-content-between">
                      <div ><strong>No Requests</strong>
                      </div>
                      <div > <small>There is no unreaded Requests</small></div>
                      </div>
                    </li>
                    @endif
                  </ul>
                </div>
              </div>
            </div>
            <!-- Recent Updates Widget End-->
          </div>
          <div class="col-lg-4 col-md-6">
            <!-- Daily Feed Widget-->
            <div id="daily-feeds" class="card updates daily-feeds">
              <div id="feeds-header" class="card-header d-flex justify-content-between align-items-center">
                <h2 class="h5 display"><a data-toggle="collapse" data-parent="#daily-feeds" href="#feeds-box"
                    aria-expanded="true" aria-controls="feeds-box">Notifications </a></h2>
                <div class="right-column">
                  <div class="badge badge-primary">{{$countnotifi->count}} Notifications</div><a data-toggle="collapse" data-parent="#daily-feeds"
                    href="#feeds-box" aria-expanded="true" aria-controls="feeds-box"><i
                      class="fa fa-angle-down"></i></a>
                </div>
              </div>
              <div id="feeds-box" role="tabpanel" class="collapse show">
                <div class="feed-box">
                  <ul class="feed-elements list-unstyled mb-0">
        
                  @if(($countnotifi->count) >0)
                  <?php $i=0; ?>
                    @foreach($actions as $action)
                    <?php $i+=1; ?>
                    @if($i < 5)
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
                    @elseif($i == 5)
                    <div class="text-center py-3" onMouseOver="this.style.backgroundColor='#ddd'" onMouseOut="this.style.backgroundColor='#FFFFFF'"><a href="{{route('admin.notifications')}}"> <i class="fas fa-bell"></i> See All Partner Actions</a></div>
                    @endif
                    @endforeach
                    @else
                    <li class="clearfix text-center">
                      <div class="feed d-flex justify-content-between">
                      <div ><strong>No Requests</strong>
                      </div>
                      <div > <small>There is no unreaded Requests</small></div>
                      </div>
                    </li>
                    @endif 
                  </ul>
                </div>
              </div>
            </div>
            <!-- Daily Feed Widget End-->
          </div>
          <div class="col-lg-4 col-md-6">
            <!-- Recent Activities Widget      -->
            <div id="recent-activities-wrapper" class="card updates activities">
              <div id="activites-header" class="card-header d-flex justify-content-between align-items-center">
                <h2 class="h5 display"><a data-toggle="collapse" data-parent="#recent-activities-wrapper"
                    href="#activities-box" aria-expanded="true" aria-controls="activities-box">Recent Activities</a>
                </h2><a data-toggle="collapse" data-parent="#recent-activities-wrapper" href="#activities-box"
                  aria-expanded="true" aria-controls="activities-box"><i class="fa fa-angle-down"></i></a>
              </div>
              <div id="activities-box" role="tabpanel" class="collapse show">
                <ul class="activities list-unstyled mb-0">
                @if(($countrecent_activitie->count)>0)
                <?php $i=-1; ?>
                @foreach($recent_activitie as $one)
                <?php $i+=1; ?>
                    @if($i < 5)
                  <!-- Item-->
                  <li>
                    <div class="row">
                      <div class="col-4 date-holder text-right">
                        <div class="icon"><i class="icon-clock"></i></div>
                        <div class="date "><span style="line-height: 1em;" class="text-info">{{$one->recent_activities_Date}}</span></div>
                      </div>
                      <div class="col-8 content">
                        <strong>{{$one->activity_content}}</strong>
                        <div class="text-right"><a href="{{route('delactivities', ['id' => $one->id])}}" ><i class="fas fa-trash-alt  text-danger" style="font-size: 20px;"></i></a></div>
                       </div>
                      
                    </div>
                    
                  </li>
                    @elseif($i == 5)
                      <div class="text-center py-3" onMouseOver="this.style.backgroundColor='#ddd'" onMouseOut="this.style.backgroundColor='#FFFFFF'"><a href="{{route('admin.activities')}}"> <i class="far fa-comment"></i> See AllRecent Activities</a></div>
                    @endif
                    @endforeach
                  @else
                  <li class="content text-center">
                      <div class="feed d-flex justify-content-between">
                      <div ><strong>No Recent Activities</strong>
                      </div>
                      <div > <small>There is no unreaded Recent Activities</small></div>
                      </div>
                    </li>
                  @endif
                  

                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    @endsection