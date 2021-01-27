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

class BloodBankController extends Controller
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
        //$hos=DB::select("SELECT * FROM `hospitals` WHERE id=1");
        $bloodbank = DB::table('blood_banks')->where('id',$id)->first();
        if(empty($bloodbank))
            abort(404);
            
        // $rbloodbank = DB::table('blood_banks')->get()->random(3);
        //$dep = DB::table('departments_hospitals')->where('hospital_id',$id);
        // $dep=DB::select("Select departments_hospitals.id, departments_hospitals.hospital_id,
        //  departments_hospitals.department_id, departments.id, departments.dep_name,
        //  from product LEFT JOIN departments ON departments_hospitals.department_id=departments.id ")->where('hospital_id',$id);

        $bloodbag= DB::table('bloods_blood_banks')
            ->Join('blood_types', 'bloods_blood_banks.blood_type_id', '=', 'blood_types.id')
            ->where('bloods_blood_banks.blood_bank_id','=',$id)
            ->get();
        
        return view('bloodPartner',['bloodbank'=> $bloodbank,/* 'rbloodbank'=>$rbloodbank, */ 'bloodbag'=>$bloodbag]);
    }
    function showrand(){
        
        $rbloodbank = DB::table('blood_banks')->get()->random(3);
        return view('bloodBankPage',['rbloodbank'=> $rbloodbank]);
    }



    
}
