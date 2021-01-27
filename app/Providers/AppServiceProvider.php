<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $countrequest=$this->countrequest();
        $countrecent_activitie=$this->countrecent_activitie();
        $countnotifi=$this->countNotifi();
        $countmessage=$this->countmessage();
        $messages=$this->showMsg();
        $websocial=$this->websocial();
        view()->share('websocial',   $websocial);
        view()->share('countrequest', $countrequest);
        view()->share('countrecent_activitie', $countrecent_activitie);
        view()->share('countnotifi', $countnotifi);
        view()->share('countmessage', $countmessage);
        view()->share('messages', $messages);
    }
    public function countrecent_activitie(){
        
        $count=DB::table('recent_activities')
        ->select(DB::raw('count(id) as count'))->first();
        return $count;
    }
    public function countNotifi(){
        
        $countNotifi=DB::select('select count(id) as count from actions where seen=0')[0]; 
        return $countNotifi;
    }
    public function countrequest(){
        
        $count=DB::table('partner_requests')
        ->select(DB::raw('count(id) as count'))->where('partner_requests.approve','=',Null)->first();
        return $count;
    }
    public function countmessage(){
        
        $countmessage=DB::table('user_messages')
        ->select(DB::raw('count(id) as count'))->where('seen','=',0)->first();
        return $countmessage;
    }
    public function showMsg(){
        $allMsgs=DB::table('user_messages')
           ->select('*')
           ->get();
           return $allMsgs;
       }
       public function websocial(){
        
        $websocial=DB::select('select *  from  website_social')[0]; 
        return  $websocial;
    }
    
}
