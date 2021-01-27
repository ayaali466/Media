<?php
/* Change namespace from 
   namespace App\Http\Controllers;
To:namespace App\Http\Controllers\OrganizationControllers;
   add use App\Http\Controllers\Controller;
*/
namespace App\Http\Controllers\AdminControllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Redirect;

class FunctionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
     
     ///----------------- Request -----------------------//////
    public function request(){
        $request1= DB::table('partner_requests')
        ->leftJoin('organizations', 'organizations.id', '=', 'partner_requests.hospital_id')
        ->where('partner_requests.approve','=',Null)
        ->where('organizations.delete_status','=',0)
        ->select('partner_requests.*', 'organizations.name','organizations.logo')
        ->get();
        
        $request2= DB::table('partner_requests')
        ->leftJoin('labs_centers', 'labs_centers.id', '=', 'partner_requests.lab_center_id')
        ->where('partner_requests.approve','=',Null)
        ->where('labs_centers.delete_status','=',0)
        ->select('partner_requests.*', 'labs_centers.name', 'labs_centers.logo')
        ->get();

        $request3= DB::table('partner_requests')
        ->leftJoin('blood_banks', 'blood_banks.id', '=', 'partner_requests.BB_id')
        ->where('partner_requests.approve','=',Null)
        ->where('blood_banks.delete_status','=',0)
        ->select('partner_requests.*', 'blood_banks.name', 'blood_banks.logo')
        ->get();

            $requests=$request1->merge($request3)->merge($request2);
        
        return $requests;
    }



    ///-------------- recent activites   ----------------////
    public function recent_activitie(){
        
        $recent_activitie=DB::table('recent_activities')
        ->select('*')->get();
        return $recent_activitie;
    }

    
    ////------------notifications -----------------///////////

    public function selectNotifi(){
        $allActions=DB::table('organizations')
           ->join('actions','organizations.id','=','actions.hospital_id')
           ->select('actions.*','organizations.logo','organizations.name')
           ->get();
           return $allActions;
    }

    //-----------------message--------------//
    public function showMsg(){
        $allMsgs=DB::table('user_messages')
           ->select('*')
           ->get();
           return $allMsgs;
    }


    
}
