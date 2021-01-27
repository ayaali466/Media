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

class UserProfileUpdatedController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
    public function index(){
        // dd(auth()->user());
        $U_B_T = auth()->user()->blood_type_id;
        $All_bloods = DB::select('SELECT * FROM blood_types');
        if(!is_null($U_B_T))
            $Blood_type_name = DB::select('SELECT `blood_type` FROM blood_types WHERE id = ?', [$U_B_T])[0]->blood_type;
        else
            $Blood_type_name = "";
        $treatments = DB::select('SELECT `name`, `id` FROM treatments WHERE user_id = ?', [auth()->user()->national_id]);
        $diseases = DB::select('SELECT `name`, `id` FROM diseases WHERE user_id = ?', [auth()->user()->national_id]);
        $reports = DB::select('SELECT `report_name`, `report_file`, `id` FROM medical_reports WHERE user_id = ?', [auth()->user()->national_id]);
        // dd($diseases);
        return view('user_profile_updated',['Blood_type_name' => $Blood_type_name,'treatments' => $treatments ,'diseases' => $diseases, 'reports'=> $reports,'All_bloods' => $All_bloods]);
    }

    public function delete_treatment($id){
        DB::delete('DELETE FROM `treatments` where `id` = ?', [$id]);
        return redirect()->back();
    }
    
    public function delete_disease($id){
        DB::delete('DELETE FROM `diseases` where `id` = ?', [$id]);
        return redirect()->back();
    }

    public function delete_report($id){
        $deleted_filename_name = DB::select('SELECT `report_file` FROM `medical_reports` WHERE id = ?',[$id]);
        if(!empty($deleted_filename_name))
            $deleted_filename_name = $deleted_filename_name[0]->report_file;

        if(!is_null($deleted_filename_name))
            unlink(public_path("user/files/$deleted_filename_name"));
        DB::delete('DELETE FROM `medical_reports` where `id` = ?', [$id]);
        return redirect()->back();
    }

    public function update_user_photo (Request $r) { 
        $userId = auth()->user()->id;
        $userPhoto = auth()->user()->photo;
        $r->validate([
            'photo' => 'required|image|max:4096|mimes:jpeg,jpg,png',
        ],[],
        [
            'photo' => "Profile Image ",
        ]);
        // Save Logo Image To sever
        if ($r->hasFile('photo')) {
            $image = $r->file('photo');
            $photo_name = $userId.'1'.time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/user/img');
            $image->move($destinationPath, $photo_name);
        }
        // Delete Stored Logo
        if(!is_null($userPhoto))
            unlink(public_path("user/img/$userPhoto"));

        DB::update('UPDATE `users` SET `photo` = ? WHERE `id` = ?', [$photo_name,$userId]);
        return redirect()->back();
    }
    
 
    public function add_disease (Request $r){
        $r->validate([
            'disease' => 'required'
        ]);
        DB::insert('INSERT INTO `diseases`(`user_id`, `name`) VALUES (?, ?)', [auth()->user()->national_id,$r->disease]);
        return redirect()->back();
    }    
    public function add_treatment (Request $r){
        $r->validate([
            'treatment' => 'required'
        ]);
        DB::insert('INSERT INTO `treatments`(`user_id`, `name`) VALUES (?, ?)', [auth()->user()->national_id,$r->treatment]);
        return redirect()->back();
    }
    public function add_report (Request $r){
        $userId = auth()->user()->id;
        $r->validate([
            'report' => 'required|mimes:pdf|max:4096',
            'report_name'=>'required|max:70'
        ]);
        if ($r->hasFile('report')) {
            $report = $r->file('report');
            $report_file_name = $userId.'1'.time().'.'.$report->getClientOriginalExtension();
            $destinationPath = public_path('/user/files');
            $report->move($destinationPath, $report_file_name);
        }

        DB::insert('INSERT INTO `medical_reports`(`user_id`, `report_file`, `report_name`) VALUES (?, ?, ?)', [auth()->user()->national_id, $report_file_name,$r->report_name]);
        return redirect()->back();
    }

    public function edit_profile(Request $r) {
        $userId = auth()->user()->id;
        $r->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'BD' => 'required|date',
            'phone' => 'required|max:11|min:11',
            'Ephone' => 'required|max:11|min:11',
            'address' => 'required|max:255',
            'blood_type_id' => 'required'
        ],[],
        [
            'name' => "User Name ",
            'email' => "User Email ",
            'BD' => "Date Of Birth ",
            'phone' => "User Mobile Phone Number",
            'Ephone' => "User Mobile Phone Emenrgency Number",
            'address' => "User Address ", 
            'blood_type_id'=> "User Blood Type "
        ]);

        DB::update('UPDATE `users` SET `name`= ?,`email`= ?,`address`= ?,`birth_date`= ? ,`blood_type_id`= ?,`mobile_number`= ?,`emenrgency_number`= ? WHERE id = ?', [
            $r->name,
            $r->email,
            $r->address,
            $r->BD,
            $r->blood_type_id,
            $r->phone,
            $r->Ephone,
            $userId
        ]);
        
        return redirect()->back();

    }

    public function delete_profile(Request $r){
        $userId = auth()->user()->id;
        DB::table('users')
        ->where('id', '=', $userId)
        ->delete();
        return redirect('/');
    }
}
