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

class Lab_CenterController extends Controller
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
    
    function show_laboratory($id){
        
        $lab = DB::table('labs_centers')->where('id',$id)->where('lab_or_center', 0)->first();
        // $lab = DB::table('labs_centers')->where(['id' => "$id", 'lab_or_center' => '1'])->first(); // Two Are equavilant

        if(empty($lab))
            abort(404);

        return view('labPartner',['lab'=> $lab]);
    }
    function show_random_laboratory(){
        
        $rlab = DB::table('labs_centers')->where('lab_or_center','=','0')->get()->random(3);
        return view('labPage',['rlab'=> $rlab]);
    }

//////////////////////////////

    function show_center($id){
        
        $center = DB::table('labs_centers')->where('id',$id)->where('lab_or_center', 1)->first();
        if(empty($center))
            abort(404);

        return view('centerPartner',['center'=> $center]);
    }
    function show_random_center(){
        
        $rcenter = DB::table('labs_centers')->where('lab_or_center','=','1')->get()->random(3);
        return view('centerPage',['rcenter'=> $rcenter]);
    }

    
}
