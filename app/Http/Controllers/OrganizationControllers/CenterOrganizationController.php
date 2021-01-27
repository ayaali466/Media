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

class CenterOrganizationController extends Controller
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
    public function show_add_center()
    {
        $governorates = DB::select('select * from governorates'); // get all governorates
        return view('orgAdmin.org_add_center',['governorates' => $governorates]);
    }
    public function add_center(Request $r)
    {
        $userId = auth('organization')->user()->id; // get user id
        $userPassword = auth('organization')->user()->password;
        $r->validate([
            'laboratory_name' => 'required|min:4|max:100',
            'laboratory_email' => 'required|email|max:255',
            'governorate' => 'required',
            'city' => 'required',
            'address' => 'required|min:10|max:150',
            'laboratory_phone' => 'required|max:8',
            'laboratory_profileImage' => 'required|image|max:4096|mimes:jpeg,jpg,png',
            'laboratory_logogImage' => 'required|image|max:4096|mimes:jpeg,jpg,png',
            'laboratory_website' => 'url|nullable',
            'laboratory_facebook' => 'url|nullable',
            'laboratory_twitter' => 'url|nullable',
            'laboratory_instagram' => 'url|nullable',
            'laboratory_youtube' => 'url|nullable',
            'laboratory_map' => 'url|nullable',
            'about_us' => 'required|max:5000',
        ],[],
        [
            'laboratory_name' => 'Center Neme',
            'laboratory_email' => 'Center Email',
            'governorate' => 'Governorate ',
            'city' => 'City',
            'address' => 'Address',
            'laboratory_phone' => 'Center Phone',
            'laboratory_profileImage' => 'Center Profile Image',
            'laboratory_logogImage' => 'Center Logo Image',
            'laboratory_website' => 'Center Website',
            'laboratory_facebook' => 'Center Facebook Link',
            'laboratory_twitter' => 'Center Twitter Link',
            'laboratory_instagram' => 'Center Instagram Link',
            'laboratory_youtube' => 'Center Youtube Link',
            'laboratory_map' => 'Center Google Map link',
            'about_us' => 'Center About Us',
        ]);
        
        
        // Handle phone content
        $phone="";
        if($r -> pre_phone_code != 'hotline')
            $phone = $r -> pre_phone_code.$r ->laboratory_phone;
        else
        $phone = $r ->laboratory_phone;

        // Handle errors
        $erors_array = [];
        $checkerrors = FALSE;
        // Check uique on social links
        // laboratory_website
        if(!is_null($r->laboratory_website) && DB::select('SELECT COUNT(*) as count from social_links where website = ?', [$r->website])[0]->count) {
            array_push($erors_array,"The Website link: ($r->website) has already been taken.");
            $checkerrors = true;
        }
        // laboratory_facebook
        if(!is_null($r->laboratory_facebook) && DB::select('SELECT COUNT(*) as count from social_links where facebook = ?', [$r->laboratory_facebook])[0]->count) {
            array_push($erors_array,"The Facebook link: ($r->laboratory_facebook) has already been taken.");
            $checkerrors = true;
        }
        // laboratory_twitter
        if(!is_null($r->laboratory_twitter) && DB::select('SELECT COUNT(*) as count from social_links where twitter = ?', [$r->laboratory_twitter])[0]->count) {
            array_push($erors_array,"The Twitter link: ($r->laboratory_twitter) has already been taken.");
            $checkerrors = true;
        }
        // laboratory_instagram
        if(!is_null($r->laboratory_instagram) && DB::select('SELECT COUNT(*) as count from social_links where instagram = ?', [$r->laboratory_instagram])[0]->count) {
            array_push($erors_array,"The Instagram link: ($r->laboratory_instagram) has already been taken.");
            $checkerrors = true;
        }
        // laboratory_youtube
        if(!is_null($r->laboratory_youtube) && DB::select('SELECT COUNT(*) as count from social_links where youtube = ?', [$r->laboratory_youtube])[0]->count) {
            array_push($erors_array,"The Youtube link: ($r->laboratory_youtube) has already been taken.");
            $checkerrors = true;
        }
        // laboratory_map
        if(!is_null($r->laboratory_map) && DB::select('SELECT COUNT(*) as count from social_links where google_map = ?', [$r->laboratory_map])[0]->count) {
            array_push($erors_array,"The Google Map link: ($r->laboratory_map) has already been taken.");
            $checkerrors = true;
        }
        // email
        if(DB::select('SELECT COUNT(*) as count from labs_centers where email = ?', [$r->laboratory_email])[0]->count) {
            array_push($erors_array,"The email: ($r->laboratory_email) has already been taken.");
            $checkerrors = true;
        }
        // phone
        if(DB::select('SELECT COUNT(*) as count from labs_centers where phone = ?', [$phone])[0]->count) {
            array_push($erors_array,"The email: ($phone) has already been taken.");
            $checkerrors = true;
        }
        if($checkerrors) {
            return  Redirect::back()->withErrors($erors_array);
        }

        // Save Profile Image To sever
        if ($r->hasFile('laboratory_profileImage')) {
            $p_image = $userId.time().'.'.request()->laboratory_profileImage	->getClientOriginalExtension();
            request()->laboratory_profileImage	->move(public_path('/orgAdmin/img'), $p_image);
        }
        // Save Logo Image To sever
        if ($r->hasFile('laboratory_logogImage')) {
            $image = $r->file('laboratory_logogImage');
            $l_image = $userId.'1'.time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/orgAdmin/img');
            $image->move($destinationPath, $l_image);
        }


        // Insert Data into scoial links table
        DB::insert("INSERT INTO `social_links`(`youtube`, `instagram`, `twitter`, `facebook`, `google_map`, `website`) VALUES (?,?,?,?,?,?)", [
            $r ->laboratory_youtube ,$r->laboratory_instagram, $r ->laboratory_twitter ,$r->laboratory_facebook, $r ->laboratory_map ,$r->laboratory_website
            ]);
        // Get Id for the inserted social link
        $social_links_id = DB::select("SELECT id FROM `social_links` ORDER BY id DESC LIMIT 1")[0]->id;
        // Insert Data into labs_centers table
        DB::insert("INSERT INTO `labs_centers` ( `name`, `email`, `password`, `address`, `phone`, `logo`, `profile_image`, `about_us`, `hospital_id`, `social_link_id`, `gov_id`, `city_id`,`lab_or_center`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)", [
            $r->laboratory_name,$r -> laboratory_email,$userPassword,$r->address,$phone,$l_image,$p_image,$r->about_us,$userId,$social_links_id,$r-> governorate,$r-> city,false
        ]);

        // Prepare Action Content
        $action_content = "Hospital: ".DB::select('select name from organizations where id = ?', [$userId])[0]->name." Added New Center: ".$r->laboratory_name;
        // Insert Data into Actions table
        DB::insert("INSERT INTO `actions`(`action_content`, `hospital_id`)  VALUES (?,?)",[$action_content,$userId]);

        $governorates = DB::select('select * from governorates'); // get all governorates
        return view('orgAdmin.org_add_center',['governorates' => $governorates,'result' => $r-> laboratory_name]);
    }

    // Delete
    public function show_delete_center()
    {
        $userId = auth('organization')->user()->id; // get user id
        $labs =  DB::select('SELECT id, name FROM  labs_centers WHERE hospital_id = ? AND lab_or_center = ?',[$userId,0]);
        return view('orgAdmin.org_delete_center',['labs' => $labs]);
    }
    public function delete_center(Request $r)
    {
        $r->validate([
            'laboratory_id' => 'required',
        ],[],[
            'laboratory_id' => 'Center',
        ]);
        $userId = auth('organization')->user()->id; // get user id

        $deleted_laboratory=  DB::select('SELECT `name`,`social_link_id` , `logo` , `profile_image` FROM  `labs_centers` WHERE id = ?',[$r->laboratory_id])[0];
        // delete corresponging social links
        DB::delete('DELETE FROM `social_links` WHERE `id` = ?', [$deleted_laboratory->social_link_id]);

        // Delete Stored Images
        // Delete Stored Logo
        if(!is_null($deleted_laboratory->logo) && file_exists(public_path("orgAdmin/img/$deleted_laboratory->logo")))
            $files = unlink(public_path("orgAdmin/img/$deleted_laboratory->logo"));

        // Delete Stored Profile Image
        if(!is_null($deleted_laboratory->profile_image) && file_exists(public_path("orgAdmin/img/$deleted_laboratory->profile_image")))
            $files = unlink(public_path("orgAdmin/img/$deleted_laboratory->profile_image"));

        // delete corresponging social links
        DB::delete('DELETE FROM labs_centers WHERE id = ?', [$r->blood_bank_id]);

        // Prepare Action Content
        $action_content = "Hospital: ".DB::select('select name from organizations where id = ?', [$userId])[0]->name." Deleted Center: ".$deleted_laboratory->name;
        
        // Insert Data into Actions table
        DB::insert("INSERT INTO `actions`(`action_content`, `hospital_id`)  VALUES (?,?)",[$action_content,$userId]);

        // send the rest Laboratories
        $labs =  DB::select('SELECT id, name FROM  labs_centers WHERE hospital_id = ? AND lab_or_center = ?',[$userId,0]);
        return view('orgAdmin.org_delete_center',['labs' => $labs, 'deleted_laboratory_name' => $deleted_laboratory->name]);
    }
    // I amn't handle remove images from the server will come!!!!!!!


    //Update
    public function show_select_to_update_center() {
        $userId = auth('organization')->user()->id; // get user id
        $labs =  DB::select('SELECT id, name FROM  labs_centers WHERE hospital_id = ? AND lab_or_center = ?',[$userId,0]);
        return view('orgAdmin.org_edit_center_select_one',['labs' => $labs]);
    }
    public function redirect_to_show_select_to_update_center() {
        return redirect()->back();
    }

    public function redirect_to_show_update_center(){
        return redirect()->back();
    }


    public function show_update_center(Request $r) {

        $r->validate([
            'laboratory_id' => 'required',
        ],[],
        [
            'laboratory_id' => 'Blood Bank'
        ]);
        // Get all data selected Lab
        $all_laboratory_data =  DB::select('SELECT * FROM  labs_centers where `id` = ? AND `lab_or_center` = ?',[$r->laboratory_id,0]);
        // dd($all_laboratory_data[0]->name);
        // get all governorates
        $governorates = DB::select('select * from governorates');
        // get all Cities where gov_id = last gov_id of BB
        $cities = DB::select('select * from cities where gov_id = ?',[$all_laboratory_data[0]->gov_id]);

        // get all socila_links of BB
        $socila_links = DB::select('select * from social_links where id = ?',[$all_laboratory_data[0]->social_link_id]); 
        // dd($socila_links);

        return view('orgAdmin.org_edit_center',['all_laboratory_data' => $all_laboratory_data,'governorates' => $governorates, 'cities' => $cities ,'socila_links' => $socila_links,'laboratory_id' => $r->laboratory_id ,'laboratory_name' => $all_laboratory_data[0]->name ]);
    }
    
    
    public function update_center(Request $r) {
       
        $lab_name = $r->lab_name;
        // dd($lab_name);
        $r->validate([
            'laboratory_name' => 'required|min:4|max:100',
            'laboratory_email' => 'required|email|max:255',
            'governorate' => 'required',
            'city' => 'required',
            'address' => 'required|min:10|max:150',
            'laboratory_phone' => 'required|max:8',
            'laboratory_website' => 'url|nullable',
            'laboratory_facebook' => 'url|nullable',
            'laboratory_twitter' => 'url|nullable',
            'laboratory_instagram' => 'url|nullable',
            'laboratory_youtube' => 'url|nullable',
            'laboratory_map' => 'url|nullable',
            'about_us' => 'required|max:5000',
        ]);

        $userId = auth('organization')->user()->id; // get user id
        $phone="";
        if($r -> pre_phone_code != 'hotline')
            $phone = $r -> pre_phone_code.$r ->laboratory_phone;
        else
        $phone = $r ->laboratory_phone;

        // Handle errors
        $erors_array = [];
        $checkerrors = FALSE;
        // Check uique on social links
        // laboratory_website

        $social_link_id = $r->social_id;
        // dd($social_link_id);
        if(!is_null($r->laboratory_website) && DB::select('SELECT COUNT(*) as count from social_links where website = ? AND id != ?', [$r->laboratory_website,$social_link_id])[0]->count) {
            array_push($erors_array,"The Website link: ($r->laboratory_website) has already been taken.");
            $checkerrors = true;
        }

        // laboratory_facebook
        if(!is_null($r->laboratory_facebook) && DB::select('SELECT COUNT(*) as count from social_links where facebook = ? AND id != ?', [$r->laboratory_facebook,$social_link_id])[0]->count) {
            array_push($erors_array,"The Facebook link: ($r->laboratory_facebook) has already been taken.");
            $checkerrors = true;
        }

        // laboratory_twitter
        if(!is_null($r->laboratory_twitter) && DB::select('SELECT COUNT(*) as count from social_links where twitter = ? AND id != ?', [$r->laboratory_twitter,$social_link_id])[0]->count) {
            array_push($erors_array,"The Twitter link: ($r->laboratory_twitter) has already been taken.");
            $checkerrors = true;
        }

        // laboratory_instagram
        if(!is_null($r->laboratory_instagram) && DB::select('SELECT COUNT(*) as count from social_links where instagram = ? AND id != ?', [$r->laboratory_instagram,$social_link_id])[0]->count) {
            array_push($erors_array,"The Instagram link: ($r->laboratory_instagram) has already been taken.");
            $checkerrors = true;
        }

        // laboratory_youtube
        if(!is_null($r->laboratory_youtube) && DB::select('SELECT COUNT(*) as count from social_links where youtube = ? AND id != ?', [$r->laboratory_youtube,$social_link_id])[0]->count) {
            array_push($erors_array,"The Youtube link: ($r->laboratory_youtube) has already been taken.");
            $checkerrors = true;
        }

        // laboratory_map
        if(!is_null($r->laboratory_map) && DB::select('SELECT COUNT(*) as count from social_links where google_map = ? AND id != ?', [$r->laboratory_map,$social_link_id])[0]->count) {
            array_push($erors_array,"The Google Map link: ($r->laboratory_map) has already been taken.");
            $checkerrors = true;
        }

         // email
         if(DB::select("SELECT COUNT(*) as count from labs_centers where email = ? AND id != ?", [$r->laboratory_email,$r->laboratory_id])[0]->count) {
            array_push($erors_array,"The email: ($r->laboratory_email) has already been taken.");
            $checkerrors = true;
        }

        // phone
        if(DB::select("SELECT COUNT(*) as count from labs_centers where phone = ? AND id != ?", [$phone,$r->laboratory_id])[0]->count) {
            array_push($erors_array,"The email: ($phone) has already been taken.");
            $checkerrors = true;
        }

        if($checkerrors) {
            return  redirect('org_admin/edit_center')->withErrors($erors_array);
        }

        //-------------------------------------------------------------------------------

        
        // Update Data into scoial links table
        DB::update('UPDATE  `social_links` SET `youtube`= ?, `instagram`=?, `twitter`=?, `facebook`=?,`google_map`=?, `website`=? WHERE id = ?',[$r->laboratory_youtube,$r->laboratory_instagram,$r->laboratory_twitter,$r->laboratory_facebook,$r->laboratory_map,$r->laboratory_website,$r->social_id] );

        // Update Data into labs_centers table
        DB::update('UPDATE `labs_centers` SET `name`=?,`email`=?,`address`=?,`phone`=?,`about_us`=?, `gov_id`=?,`city_id`=? WHERE id = ?', [$r->laboratory_name, $r->laboratory_email, $r->address, $phone, $r->about_us, $r->governorate, $r->city ,$r->laboratory_id]);

       
        // Prepare Action Content
        $action_content = "Hospital: ".DB::select('select name from organizations where id = ?', [$userId])[0]->name." Updated Laboratory: ".DB::select('select name from labs_centers where id = ?', [$r->laboratory_id])[0]->name;
        
        // Insert Data into Actions table
        DB::insert("INSERT INTO `actions`(`action_content`, `hospital_id`)  VALUES (?,?)",[$action_content,$userId]);


        // all Code of Show edit

        $userId = auth('organization')->user()->id; // get user id
        // Get all labs related to This Organization
        $labs =  DB::select('SELECT id, name FROM  labs_centers WHERE hospital_id = ? AND lab_or_center = ?',[$userId,0]);

        // dd($socila_links);
        return view('orgAdmin.org_edit_center_select_one',['labs' => $labs,  'last_laboratory_name' => $lab_name]);
    }

    // add Radition
    public function show_select_lab_to_add_radition() {
        $userId = auth('organization')->user()->id; // get user id
        // Get all data selected Lab
        $labs =  DB::select('SELECT id, name FROM  labs_centers WHERE hospital_id = ? AND lab_or_center = ?',[$userId,0]);
        return view('orgAdmin.org_center_add_radition_select_one',['labs' => $labs]);
    }

    public function show_add_medical_radition(Request $r) {
        $r->validate([
            'laboratory_id' => 'required',
        ],[],
        [
            'laboratory_id' => 'Center'
        ]);
        $all_medical_radiation_in_hospital = DB::select('SELECT `medical_radiation_id` FROM labscenters_medicalradiations WHERE  lab_center_id =?', [$r->laboratory_id]);
        $all_radition = [];
        foreach($all_medical_radiation_in_hospital as $one) {
            array_push($all_radition,$one->medical_radiation_id);
        }
        $all_radition = implode(",", $all_radition);
        if(empty($all_radition)) 
            $all_radition = -1;
        $all_medical_all_radition = DB::select("SELECT * FROM `medical_radiations` WHERE id NOT IN($all_radition)");

        return view('orgAdmin.org_center_add_radition',['medical_analysis' => $all_medical_all_radition, 'lab_id' => $r->laboratory_id]);
    }
    public function add_medical_radition(Request $r) {
        $r->validate([
            'analysis_id' => 'required',
            'price' => 'required',
        ],[],
        [
            'analysis_id' => 'Radition',
            'price' => 'Radition Price',
        ]);
        
        DB::insert('INSERT INTO `labscenters_medicalradiations`(`lab_center_id`, `medical_radiation_id`, `price`) VALUES (?,?,?)', [$r->lab_id,$r->analysis_id,$r->price]);
        
        $added_analysis_name = DB::select('SELECT radiation_name FROM `medical_radiations` WHERE id = ?', [$r->analysis_id])[0]->radiation_name;
        $userId = auth('organization')->user()->id; // get user id
        // Get all data selected Lab
        $labs =  DB::select('SELECT id, name FROM  labs_centers WHERE hospital_id = ? AND lab_or_center = ?',[$userId,0]);
        return view('orgAdmin.org_center_add_radition_select_one',['labs' => $labs, 'status' => "New Radition: ($added_analysis_name) is added, With price = $r->price"]);
    }
    // delete analysis
    public function show_select_center_to_delete_radition() {
        $userId = auth('organization')->user()->id; // get user id
        // Get all data selected Lab
        $labs =  DB::select('SELECT id, name FROM  labs_centers WHERE hospital_id = ? AND lab_or_center = ?',[$userId,0]);
        return view('orgAdmin.org_center_delete_radition_select_one',['labs' => $labs]);
    }
    public function show_delete_medical_radition(Request $r) {
        $r->validate([
            'laboratory_id' => 'required',
        ],[],
        [
            'laboratory_id' => 'Center'
        ]);
        $all_medical_radition_in_hospital = DB::select('SELECT labscenters_medicalradiations.id, medical_radiations.radiation_name 
        FROM medical_radiations 
        INNER JOIN labscenters_medicalradiations
        ON medical_radiations.id = labscenters_medicalradiations.medical_radiation_id
        WHERE
        labscenters_medicalradiations.lab_center_id = ? ', [$r->laboratory_id]);
        

        return view('orgAdmin.org_center_delete_radition',['medical_analysis' => $all_medical_radition_in_hospital]);
    }

    public function delete_medical_radition(Request $r) {
        $r->validate([
            'analysis_id' => 'required',
        ],[],
        [
            'analysis_id' => 'Radition',
        ]);
        DB::delete('DELETE FROM `labscenters_medicalradiations` WHERE id = ?', [$r->analysis_id]);
        
        
        $userId = auth('organization')->user()->id; // get user id
        // Get all data selected Lab
        $labs =  DB::select('SELECT id, name FROM  labs_centers WHERE hospital_id = ? AND lab_or_center = ?',[$userId,0]);
        return view('orgAdmin.org_center_delete_radition_select_one',['labs' => $labs, 'status' => "The analysis already Deleted"]);
    }

    
    // Edit Profile
    public function show_edit_center_Profile_image($id) {
        $userId = auth('organization')->user()->id; // get user id
        $lab_profile = DB::select('SELECT profile_image FROM labs_centers WHERE hospital_id = ? AND lab_or_center = ? AND id = ?', [$userId, 0, $id]);
        if(empty($lab_profile))
            abort(404);
        else
            $lab_profile = $lab_profile[0]->profile_image;
            // dd($lab_profile);
        return view('orgAdmin.org_edit_center_profile_image',['profile_image' => $lab_profile, 'lab_id' => $id]);
    }

    public function edit_center_Profile_image(Request $r){
        $userId = auth('organization')->user()->id; // get user id

        $r->validate([
            'profileImage' => 'required|image|max:4096|mimes:jpeg,jpg,png',
        ],[],
        [
            'profileImage' => "Profile Image ",
        ]);
        // dd($r->id);
        // Save Logo Image To sever
        if ($r->hasFile('profileImage')) {
            $image = $r->file('profileImage');
            $p_image = $userId.'1'.time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/orgAdmin/img');
            $image->move($destinationPath, $p_image);
        }
        // Delete Stored Profile Image
        $deleted_image_name = $r->lab_profile;
        if(!is_null($deleted_image_name) && file_exists(public_path("orgAdmin/img/$deleted_image_name")))
            $files = unlink(public_path("orgAdmin/img/$deleted_image_name"));
        DB::update('UPDATE `labs_centers` SET `profile_image` = ? WHERE `id` = ?', [$p_image,$r->lab_id]);
        return redirect()->back();
    }

    
    // edit Logo Image
    public function show_edit_center_logo_image ($id) {
        $userId = auth('organization')->user()->id; // get user id
        $lab_logo = DB::select('SELECT logo FROM labs_centers WHERE hospital_id = ? AND lab_or_center = ? AND id = ?', [$userId,0, $id]);
        if(empty($lab_logo))
            abort(404);
        else
            $lab_logo = $lab_logo[0]->logo;
            // dd($lab_profile);
        return view('orgAdmin.org_edit_center_logo',['logo_image' => $lab_logo, 'lab_id' => $id]);
    }
    public function edit_center_logo_image (Request $r) {
        
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
            $l_image = $userId.'1'.time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/orgAdmin/img');
            $image->move($destinationPath, $l_image);
        }
        
        // Delete Stored Logo Image
        $deleted_image_name = $r->lab_logo;
        if(!is_null($deleted_image_name) && file_exists(public_path("orgAdmin/img/$deleted_image_name")))
            $files = unlink(public_path("orgAdmin/img/$deleted_image_name"));
        // dump($deleted_image_name,$l_image);
        DB::update('UPDATE `labs_centers` SET `logo` = ? WHERE `id` = ?', [$l_image,$r->lab_id]);
        return redirect()->back();
    }

    

}
