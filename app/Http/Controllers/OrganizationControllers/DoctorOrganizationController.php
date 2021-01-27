<?php
/* Change namespace from 
   namespace App\Http\Controllers;
To:namespace App\Http\Controllers\OrganizationControllers;
   add use App\Http\Controllers\Controller;
*/
namespace App\Http\Controllers\OrganizationControllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Redirect;

class DoctorOrganizationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:organization');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

     //Add
    public function show_add_doctor()
    {
        $userId = auth('organization')->user()->id;
        $departments = DB::select('SELECT departments_hospitals.id, departments.name from departments_hospitals INNER JOIN departments ON departments_hospitals.department_id = departments.id WHERE departments_hospitals.hospital_id = ?',[$userId]);
        // dd($departments);
        return view('orgAdmin.org_add_doctor',['departments' => $departments]);
    }
    public function add_doctor(Request $r)
    {
        $userId = auth('organization')->user()->id;
        $r->validate([
            'name' => 'required|min:4|max:100',
            'department' => 'required',
            'job_title' => 'required|min:4|max:150',
            'profileImage' => 'required|image|max:4096|mimes:jpeg,jpg,png',
            'fees' => 'required|numeric|min:20|max:99999',
            'job_description' => 'required|min:10|max:255',
            'day-1' => 'required',
            'from-1' => 'required',
            'to-1' => 'required'
        ], [], 
        [
            'name' => 'Doctor Name',
            'department' => 'Doctor Department',
            'job_title' => 'Doctor Job title',
            'profileImage'=> 'Doctor Image',
            'fees' => 'Doctor fees',
            'job-description'=> 'Doctor job description',
            'day-1'=> 'Available doctor time in day as "Saturday"',
            'from-1'=> 'Available doctor time From HH:MM',
            'to-1'=> 'Available doctor time To HH:MM',
        ]);
        
        // Handle errors
        $errors_array = [];
        $checkerrors = FALSE;
        $day = null;
        $from = null;
        $i=1;
        $available_days =[]; // to contain All days
        $fromTime =[]; // to contain all time from
        $toTime=[]; // to contain all time to
        $indexDay = 0;
        $indexFrom = 0;
        $indexTo = 0;
        foreach($r->all() as $key => $value) { // to validate days with available (from time) less than (to time)
            if(strpos($key, "day-") !== false) {
                $indexDay++;
                $day = $value;
            }
            if(strpos($key, "from-") !== false) {
                $indexFrom++;
                $from = $value;
            }
            if(strpos($key, "to-") !== false) {
                $indexTo++;
                if($from >= $value) {
                    array_push($errors_array,"The Day: ".$day." => ( From: ".$from." To: ".$value.") Not available as from time must be smaller than to time please check it again !!!");
                    $checkerrors = TRUE;
                }
                else {
                    if($indexDay == $indexFrom && $indexDay == $indexFrom) {
                        array_push($available_days,$day);
                        array_push($fromTime,$from);
                        array_push($toTime,$value);
                    }
                    else {
                        array_push($errors_array,"The Day name is not selected for the time => ( From: ".$from." To: ".$value.") Not available as from time must be smaller than to time please check it again !!!");
                    $checkerrors = TRUE;
                    }
                    
                }
                
            }
        }
        if($checkerrors) {
            return  Redirect::back()->withErrors($errors_array);
        }
        // Save Profile Image To sever
        if ($r->hasFile('profileImage')) {
            $p_image = $r->file('profileImage');
            $photoName = $userId.time().'.'.$p_image->getClientOriginalExtension();
            $destinationPath = public_path('/orgAdmin/img');
            $p_image->move($destinationPath, $photoName);
        }
        DB::insert('INSERT INTO `doctors`(`name`, `title`, `description`, `photo`, `department_id`, `fees`) VALUES (?,?,?,?,?,?)',[$r->name,$r->job_title,$r->job_description,$photoName,$r->department,$r->fees]); 

        $doc_id = DB::select('SELECT `id` FROM `doctors` WHERE `name` = ? AND `title` = ? AND `description` = ? AND `photo` = ? AND `department_id` = ? AND  `fees` = ?',[$r->name,$r->job_title,$r->job_description,$photoName,$r->department,$r->fees])[0]->id;

        $num_of_days = count($available_days);
        for($i=0;$i<$num_of_days;$i++) {
            DB::insert('INSERT INTO `availbale_days`(`day_name`, `start_time`, `end_time`, `doctor_id`) VALUES (?,?,?,?)',[$available_days[$i],$fromTime[$i],$toTime[$i],$doc_id]);
        }
        $userId = auth('organization')->user()->id;
        // Prepare Action Content
        $action_content = "Hospital: ".DB::select('select name from organizations where id = ?', [$userId])[0]->name." Added New Doctor: ".$r->name;
        // Insert Data into Actions table
        DB::insert("INSERT INTO `actions`(`action_content`, `hospital_id`)  VALUES (?,?)",[$action_content,$userId]);
        
        $departments = DB::select('SELECT departments_hospitals.id, departments.name from departments_hospitals INNER JOIN departments ON departments_hospitals.department_id = departments.id WHERE departments_hospitals.hospital_id = ?',[$userId]);
        return view('orgAdmin.org_add_doctor',['departments' => $departments , 'status' => "New doctor ($r->name) is added ): "]);
    }

    // Delete
    public function show_delete_dcotor()
    {
        $userId = auth('organization')->user()->id;
        $all_doctor = DB::select('SELECT doctors.id, doctors.name, doctors.title, doctors.fees, departments.name as depName FROM doctors INNER JOIN departments_hospitals ON doctors.department_id = departments_hospitals.id INNER JOIN departments ON departments.id = departments_hospitals.department_id WHERE departments_hospitals.hospital_id = ?
        ',[$userId]);
        return view('orgAdmin.org_delete_doctor',['doctors' => $all_doctor]);
    }
    public function delete_doctor($id)
    {
        //check if exist
        if(DB::select('SELECT  `name` FROM `doctors` WHERE id = ?',[$id])  == null)
            abort(404); // show 404 error page
        $deleted_doctor = DB::select('SELECT  `name` , `photo` FROM `doctors` WHERE id = ?',[$id])[0];
        DB::delete('DELETE FROM `availbale_days` WHERE doctor_id = ?', [$id]);
        DB::delete('DELETE FROM `doctors` WHERE id = ?', [$id]);

        // Delete Stored Photo
        if(!is_null($deleted_doctor->photo) && file_exists(public_path("orgAdmin/img/$deleted_doctor->photo")))
            $files = unlink(public_path("orgAdmin/img/$deleted_doctor->photo"));

        $userId = auth('organization')->user()->id;
        // Prepare Action Content
        $action_content = "Hospital: ".DB::select('select name from organizations where id = ?', [$userId])[0]->name." delete doctor: ".$deleted_doctor->name;
        // Insert Data into Actions table
        DB::insert("INSERT INTO `actions`(`action_content`, `hospital_id`)  VALUES (?,?)",[$action_content,$userId]);

        session()->flash('status' , "Already Doctor ($deleted_doctor->name) is deleted");
        return Redirect::back();
    }
    // I amn't handle remove images from the server will come!!!!!!!
    //Update
    public function show_doctors_to_update() {
        $userId = auth('organization')->user()->id;
        $all_doctor = DB::select('SELECT doctors.id, doctors.name, doctors.title, doctors.fees, doctors.photo, departments.name as depName FROM doctors INNER JOIN departments_hospitals ON doctors.department_id = departments_hospitals.id INNER JOIN departments ON departments.id = departments_hospitals.department_id WHERE departments_hospitals.hospital_id = ?
        ',[$userId]);
        return view('orgAdmin.org_edit_select_doctor',['doctors' => $all_doctor]);
    }
    public function show_update_doctor($id) {
        $userId = auth('organization')->user()->id;
        //check if exist
        if(DB::select('SELECT  `name` FROM `doctors` WHERE id = ?',[$id])  == null)
            abort(404); // show 404 error page
        
        $doctor_data = DB::select('SELECT  * FROM `doctors` WHERE id = ?',[$id]); // get doctor data to show it in form

        $doctor_department_id = $doctor_data[0]->department_id;
        if(empty(DB::select('SELECT id from departments_hospitals WHERE id = ? AND hospital_id = ?',[$doctor_department_id,$userId])))
            abort(404);
        $available_days= DB::select('SELECT `day_name`, `start_time`, `end_time` FROM `availbale_days` WHERE `doctor_id` = ?',[$id]);

        
        $departments = DB::select('SELECT departments_hospitals.id, departments.name from departments_hospitals INNER JOIN departments ON departments_hospitals.department_id = departments.id WHERE departments_hospitals.hospital_id = ?',[$userId]);

        return view('orgAdmin.org_edit_doctor',['doctor_data' => $doctor_data, 'available_days' => $available_days , 'departments' => $departments , 'doctor_id' => $id]);
    }
    
    public function update_doctor(Request $r) {
        ///////////////////////////////////////////////////////////////
        $r->validate([
            'name' => 'required|min:4|max:100',
            'department' => 'required',
            'job_title' => 'required|min:4|max:100',
            'fees' => 'required|numeric|min:20|max:99999',
            'job_description' => 'required|min:10|max:200',
            'day-1' => 'required',
            'from-1' => 'required',
            'to-1' => 'required'
        ], [], 
        [
            'name' => 'Doctor Name',
            'department' => 'Doctor Department',
            'job_title' => 'Doctor Job title',
            'fees' => 'Doctor fees',
            'job-description'=> 'Doctor job description',
            'day-1'=> 'Available doctor time in day as "Saturday"',
            'from-1'=> 'Available doctor time From HH:MM',
            'to-1'=> 'Available doctor time To HH:MM',
        ]);
        
        // Handle errors
        $errors_array = [];
        $checkerrors = FALSE;
        $day = null;
        $from = null;
        $i=1;
        $available_days =[]; // to contain All days
        $fromTime =[]; // to contain all time from
        $toTime=[]; // to contain all time to
        $indexDay = 0;
        $indexFrom = 0;
        $indexTo = 0;
        foreach($r->all() as $key => $value) { // to validate days with available (from time) less than (to time)
            if(strpos($key, "day-") !== false) {
                $indexDay++;
                $day = $value;
            }
            if(strpos($key, "from-") !== false) {
                $indexFrom++;
                $from = $value;
            }
            if(strpos($key, "to-") !== false) {
                $indexTo++;
                if($from >= $value) {
                    array_push($errors_array,"The Day: ".$day." => ( From: ".$from." To: ".$value.") Not available as from time must be smaller than to time please check it again !!!");
                    $checkerrors = TRUE;
                }
                else {
                    if($indexDay == $indexFrom && $indexDay == $indexFrom) {
                        array_push($available_days,$day);
                        array_push($fromTime,$from);
                        array_push($toTime,$value);
                    }
                    else {
                        array_push($errors_array,"The Day name is not selected for the time => ( From: ".$from." To: ".$value.") Not available as from time must be smaller than to time please check it again !!!");
                    $checkerrors = TRUE;
                    }
                    
                }
                
            }
        }
        if($checkerrors) {
            return  Redirect::back()->withErrors($errors_array);
        }
        
        DB::update('UPDATE `doctors` SET `name`= ? ,`title`= ?,`description`= ?,`department_id`= ? ,`fees`= ? WHERE id = ?', [$r->name,$r->job_title,$r->job_description,$r->department,$r->fees,$r->doctor_id]);
        
        DB::delete('DELETE FROM `availbale_days` WHERE doctor_id = ?', [$r->doctor_id]); // delete previous available hours

        $num_of_days = count($available_days);
        for($i=0;$i<$num_of_days;$i++) {
            DB::insert('INSERT INTO `availbale_days`(`day_name`, `start_time`, `end_time`, `doctor_id`) VALUES (?,?,?,?)',[$available_days[$i],$fromTime[$i],$toTime[$i],$r->doctor_id]);
        }

        $userId = auth('organization')->user()->id;
        // Prepare Action Content
        $action_content = "Hospital: ".DB::select('select name from organizations where id = ?', [$userId])[0]->name." Updated dcotor: ".$r->name;
        
        // Insert Data into Actions table
        DB::insert("INSERT INTO `actions`(`action_content`, `hospital_id`)  VALUES (?,?)",[$action_content,$userId]);


        session()->flash('status' , "Already Doctor ($r->name) is Updated");
        return Redirect::action('OrganizationControllers\DoctorOrganizationController@show_doctors_to_update');

    }

    // edit Logo Image
    public function show_edit_doc_logo_image ($id) {
        $userId = auth('organization')->user()->id;
        $logo_image = DB::select('SELECT `photo` FROM `doctors` WHERE `id` = ?', [$id]);
        if(!empty($logo_image))
            $logo_image = $logo_image[0]->photo;
        else
            abort(404);
        //doctor belong to this hospital
        $doctor_department_id = DB::select('SELECT  `department_id` FROM `doctors` WHERE id = ?',[$id])[0]->department_id; // get doctor data to show it in form

        if(empty(DB::select('SELECT id from departments_hospitals WHERE id = ? AND hospital_id = ?',[$doctor_department_id,$userId])))
            abort(404);

        return view('orgAdmin.org_edit_doctor_logo',['logo_image' => $logo_image, 'doc_id' => $id]);
    }

    public function edit_doc_logo_image (Request $r) { 
        $userId = auth('organization')->user()->id;
        $r->validate([
            'logo_image' => 'required|image|max:4096|mimes:jpeg,jpg,png',
        ],[],
        [
            'logo_image' => "Profile Image ",
        ]);
        // Save Logo Image To sever
        if ($r->hasFile('logo_image')) {
            $image = $r->file('logo_image');
            $p_image = $userId.'1'.time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/orgAdmin/img');
            $image->move($destinationPath, $p_image);
        }
        // Delete Stored Logo
        $deleted_image_name = $r->doc_photo_name;
        if(!is_null($deleted_image_name) && file_exists(public_path("orgAdmin/img/$deleted_image_name")))
            $files = unlink(public_path("orgAdmin/img/$deleted_image_name"));

        DB::update('UPDATE `doctors` SET `photo` = ? WHERE `id` = ?', [$p_image,$r->doc_id]);
        $deleted_image_name = DB::select('SELECT `logo` FROM `organizations` WHERE `id` = ?', [$userId])[0]->logo;
        return redirect()->route('editDoctor');
    }

}
