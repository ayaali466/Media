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

class HospitalController extends Controller
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
    function show($id){
        $hospital = DB::table('organizations')->where('id',$id)->first();
        if(empty($hospital))
            abort(404);
            
        $departments= DB::table('departments_hospitals')
            ->Join('departments', 'departments_hospitals.department_id', '=', 'departments.id')
            ->where('departments_hospitals.hospital_id','=',$id)
            ->select('*')
            ->get();
            $blood = DB::table('blood_banks')->where('hospital_id',$id)->first();
            $lab = DB::table('labs_centers')->where('hospital_id',$id)->where('lab_or_center','=','1')->first();
            $center = DB::table('labs_centers')->where('hospital_id',$id)->where('lab_or_center','=','0')->first();
            $incubator = DB::table('incubators')->where('hospital_id',$id)->first();
            $intensive = DB::table('intensive_care')->where('hospital_id',$id)->first();
            // dd($departments,$blood,$lab,$center,$incubator,$intensive);
        return view('hospitalPartner',['hospital'=> $hospital, 'departments'=>$departments, 'incubator'=>$incubator, 'intensive'=>$intensive, 'blood'=>$blood, 'lab'=>$lab, 'center'=>$center]);
    }
    function showrand(){
        
        $rhospital = DB::table('organizations')->get()->random(3);
        // dd($rhospital);
        return view('hospitalPage',['rhospital'=> $rhospital]);
    }



    
}
