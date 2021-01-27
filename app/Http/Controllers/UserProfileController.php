<?php
use App\Http\Request;
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // return view("create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            "name"=>"required",
            "email"=>"required|email|unique:users",
            "password"=>"required|min:6|max:20",
            "national_id_image"=>"required|image",
            "national_id"=>"required|min:14|max:14",
            "photo"=>"required|min:14|max:14",
            "phone number"=>"required|min:11|max:11"

            
        ]);
        $imgname=time().".".$request->photo->extension();
        $request->photo->move(public_path('myimg'),$imgname);
        $data=$request->except(["_token"]);
        $data["photo"]="public/myimg".$imgname;
        DB::table("users")->insert($data);
        return back()->with("success","inserted");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($national_id)
    {
        if(auth()->user()->national_id != $national_id)
            abort(404);
        $users = DB::select('select * from users where national_id = ?', [$national_id]);
        $usersBT=DB::select(' select blood_types.blood_type ,users.national_id from blood_types 
        left outer join users  on  users.blood_type_id = blood_types.id where national_id = ?', [$national_id]);
        $usersDI=DB::select(' select diseases.name ,users.national_id from diseases 
        left outer join users  on  users.national_id = diseases.user_id  where national_id = ?', [$national_id]);
        $usersTR=DB::select(' select  treatments.name ,users.national_id from  treatments 
        left outer join users  on  users.national_id =  treatments.user_id  where national_id = ?', [$national_id]);
        $usersMR=DB::select(' select  medical_reports.report_name ,users.national_id from medical_reports 
        left outer join users  on  users.national_id =  medical_reports.user_id  where national_id = ?', [$national_id]);
        if(empty($users))abort(404);
           return view('pprofile', ['users' => $users,
           "usersBT"=>$usersBT,"usersDI"=>$usersDI,"usersTR"=>$usersTR,"usersMR"=>$usersMR]);

      }


    public function showdprofile($id)
    {
        $doctors = DB::select('select * from doctors where id = ?', [$id]);        
        $doctorsDE=DB::select(' select availbale_days.day_name ,availbale_days.start_time ,availbale_days.end_time ,
        doctors.id from availbale_days 
        left outer join doctors  on  doctors.id = availbale_days.doctor_id  where doctors.id = ?', [$id]);
        if(empty($doctors))
        abort(404);
        return view('dprofile', ['doctors' => $doctors,'doctorsDE' => $doctorsDE]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($national_id)
    {
        if(auth()->user()->national_id != $national_id)
        abort(404);
        $userinfo=DB::select("select * from users where national_id=?",[$national_id]);
        $All_bloods = DB::select('SELECT * FROM blood_types');

        if(empty($userinfo))
            abort(404);
        return view("userform",['userinfo' => $userinfo,'All_bloods' => $All_bloods]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $national_id)
    {
        //
        DB::table('users')->where('national_id', $national_id)->update([
           
            'name'=> $request->input('name'),
            'email'=> $request->input('email'),
            'address'=> $request->input('address'),
            'birth_date'=> $request->input('BD'),
            'mobile_number'=> $request->input('phone'),
            'emenrgency_number'=> $request->input('Ephone'),
            'gender'=> $request->input('gender'),
            'blood_type_id'=> $request->input('blood_type_id')
    ]);

    return  ("data edited");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
