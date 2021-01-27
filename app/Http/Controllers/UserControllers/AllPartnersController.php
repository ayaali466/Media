<?php
/* Change namespace from 
   namespace App\Http\Controllers;
To:namespace App\Http\Controllers\OrganizationControllers;
   add use App\Http\Controllers\Controller;
*/
namespace App\Http\Controllers\UserControllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Redirect;

class AllPartnersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
    function show(){
        $rhosbital = DB::table('organizations')->inRandomOrder()->get();
        $rlab = DB::table('labs_centers')->where('lab_or_center','=','1')->inRandomOrder()->get();
        $rcenter = DB::table('labs_centers')->where('lab_or_center','=','0')->inRandomOrder()->get();
        $rbloodbank= DB::table('blood_banks')->inRandomOrder()->get();
        return view('allPartners',['rhosbital'=>$rhosbital, 'rlab'=>$rlab, 'rcenter'=>$rcenter,'rbloodbank'=>$rbloodbank]);       
    }


    
}
