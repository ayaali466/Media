@extends('superAdmin.layouts.master')
@section('title', 'Requests')
@section('content')
<section class="container">
        <div class="row justify-content-center">
        <h3 class="text-center col-12 h1 my-5 text-muted">All Recent Activities</h3>
          <div class="col-lg-8 col-sm-10">
            <!-- Partner Requests-->
            <div class="col-lg-12 col-md-6">
            <!-- Recent Activities Widget      -->
            <div id="recent-activities-wrapper" class="card updates activities">
              <div id="activites-header" class="card-header d-flex justify-content-between align-items-center">
                <h2 class="h5 display"><a data-toggle="collapse" data-parent="#recent-activities-wrapper"
                    href="#activities-box" aria-expanded="true" aria-controls="activities-box">Recent Activities</a>
                </h2>
                <div class="right-column">
                  <div class="badge badge-primary">{{$countrecent_activitie->count}} activites Not readed</div>
                </div>
              </div>
              <div id="activities-box" role="tabpanel" class="collapse show">
                <ul class="activities list-unstyled">
                @if(($countrecent_activitie->count)>0)
                @foreach($recent_activitie as $one)
                  <!-- Item-->
                  <li>
                    <div class="row">
                      <div class="col-4 date-holder text-right">
                        <div class="icon"><i class="icon-clock"></i></div>
                        <div class="date"><span style="line-height: 1em;"  class="text-info">{{$one->recent_activities_Date}}</span></div>
                      </div>
                      <div class="col-8 content">
                        <strong>{{$one->activity_content}}</strong>
                        <div class="text-right"><a href="{{route('delactivities', ['id' => $one->id])}}" ><i class="fas fa-trash-alt  text-danger" style="font-size: 20px;"></i></a></div>
                       </div>
                      
                    </div>
                    
                  </li>
                  @endforeach
                  @else
                  <li class="content text-center">
                      <div class="feed d-flex justify-content-between">
                      <div ><strong>No Recent Activities</strong>
                      </div>
                      <div > <small>There is no unreaded Recent Activities</small></div>
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