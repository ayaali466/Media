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

class OrganizationController extends Controller
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
    public function index()
    {
        $userId = auth('organization')->user()->id; // get user id
        $Organization_departments = DB::select('SELECT departments.name from departments INNER JOIN departments_hospitals
        on departments_hospitals.department_id = departments.id
        where departments_hospitals.hospital_id =?',[$userId]); // get all departments id which is in this organization
        // dd($Organization_departments);
        $hospital_data = DB::select('SELECT `name`, `email` , `address`, `phone`, `logo`, `profile_image`, `about_us`,`gov_id`, `city_id`, `social_link_id` FROM `organizations` WHERE id = ?', [$userId])[0];
        
        $governorate_name = DB::select('SELECT `gov_name` FROM `governorates` WHERE id = ?',[$hospital_data ->gov_id ]);
        if(!empty($governorate_name))
            $governorate_name = $governorate_name[0]->gov_name;

        $city_name = DB::select('SELECT `city_name` FROM `cities` WHERE id = ?',[$hospital_data ->city_id ]);
        if(!empty($city_name))
            $city_name = $city_name[0]->city_name;

        // get Social links
        $social_links = DB::select('SELECT `youtube`, `instagram`, `twitter`, `facebook`, `google_map`, `website` FROM `social_links` WHERE id = ?', [$hospital_data -> social_link_id]);
        if(!empty($social_links))
            $social_links=$social_links[0];
        
        // get Laboratories
        $laboratories = DB::select('SELECT  `name` FROM `labs_centers` WHERE `hospital_id` = ? AND `lab_or_center` = ?',[$userId,1]);
        // get Centers
        $centers = DB::select('SELECT  `name` FROM `labs_centers` WHERE `hospital_id` = ? AND `lab_or_center` = ?',[$userId,0]);

        //Get Blood Banks
        $BloodBanks = DB::select('SELECT `id`, `name` FROM `blood_banks` WHERE `hospital_id` = ?',[$userId]);

        // Get Incubaters Data
        $incubater = DB::select('SELECT `num_of_units`, `Available_units` FROM `incubators` WHERE  `hospital_id` = ?', [$userId]);
        if(!empty($incubater))
            $incubater=$incubater[0];


        // Get Intensive Care Data
        $intensiveCare = DB::select('SELECT `num_of_rooms`, `Available_rooms` FROM `intensive_care` WHERE  `hospital_id` = ?', [$userId]);
        if(!empty($intensiveCare))
            $intensiveCare=$intensiveCare[0];

        return view('orgAdmin.o_dashboard',[ 'hospital' => $hospital_data ,'incubater' => $incubater , 'intensiveCare' => $intensiveCare,'laboratories' => $laboratories,'centers' => $centers ,'BloodBanks' => $BloodBanks ,'social_links' => $social_links ,'departments' => $Organization_departments , "governorate" => $governorate_name ,'city' => $city_name]);
        // return view('orgAdmin.o_dashboard');

    }

    public function show_edit_profile() {
        $userId = auth('organization')->user()->id;
        $hospital_data = DB::select('SELECT `name`, `phone`,  `about_us` FROM `organizations` WHERE id = ?', [$userId])[0];
        // dd($hospital_data);
        return view('orgAdmin.org_edit_profile',['hospital' => $hospital_data]);
    }

    // Search About Patient
    public function show_search_patient() {
        // return view('orgAdmin.org_patient_search');
        return view('orgAdmin.org_patient_search');
    }

    public function search_patient($id) {
        $user_data = DB::select('select * from users where id = ?', [$id]);
        if(empty($user_data))
            abort(404);
        $user_BT = DB::select('SELECT `blood_type` FROM `blood_types` WHERE id = ?', [$user_data[0]->blood_type_id])[0]->blood_type;
        $user_treatments= DB::select('SELECT `name` FROM `treatments` WHERE user_id = ?', [$user_data[0]->national_id]);
        $user_diseases= DB::select('SELECT `name` FROM  diseases WHERE user_id = ?', [$user_data[0]->national_id]);
        $user_reports = DB::select('SELECT `report_name`, `report_file`, `id` FROM medical_reports WHERE user_id = ?', [$user_data[0]->national_id]);
        // dd($user_data,$user_treatments,$user_diseases);
        return view('orgAdmin.org_patient_profile',['user' => $user_data[0], 'treatments' => $user_treatments,'diseases' => $user_diseases,'photo' => $user_data[0]->photo,'reports' => $user_reports,'user_BT' => $user_BT]);
    }

    public function edit_profile(Request $r) {
        
        $userId = auth('organization')->user()->id;
        $r->validate([
            'name' => 'required|min:4|max:100',
            'about_us' => 'required|max:5000',
            'phone' => 'required|max:8',
        ], [], 
        [
            'name' => 'Hospital Name',
            'Phone' => 'DHospital Phone',
            'about_us==='=> 'About US',
        ]);
        // Handle phone content
        $phone="";
        if($r -> pre_phone_code != 'hotline')
            $phone = $r -> pre_phone_code.$r ->phone;
        else
        $phone = $r ->phone;
        DB::update('UPDATE `organizations` SET `name` = ? ,`phone` = ? ,`about_us` = ?  WHERE id = ?', [$r->name,$phone,$r->about_us,$userId]);
        return redirect()->route('o_dashboard');
    }
    // edit Profile Image
    public function show_edit_profile_image () {     
        $userId = auth('organization')-> user()->id;
        $profile_image = DB::select('SELECT `profile_image` FROM `organizations` WHERE `id` = ?', [$userId])[0]->profile_image; 
        return view('orgAdmin.org_edit_profile_profileImage',['profile_image' => $profile_image]);
    }
    public function edit_profile_image (Request $r) {
        $userId = auth('organization')->user()->id;
        $r->validate([
            'profileImage' => 'required|image|max:4096|mimes:jpeg,jpg,png',
        ],[],
        [
            'profileImage' => "Profile Image ",
        ]);
        // Save Logo Image To sever
        if ($r->hasFile('profileImage')) {
            $image = $r->file('profileImage');
            $p_image = $userId.'1'.time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/orgAdmin/img');
            $image->move($destinationPath, $p_image);
        }

        // Delete Stored Profile Image
        $deleted_image_name = DB::select('SELECT `profile_image` FROM `organizations` WHERE `id` = ?', [$userId])[0]->profile_image;
        if(!is_null($deleted_image_name) && file_exists(public_path("orgAdmin/img/$deleted_image_name")))
            $files = unlink(public_path("orgAdmin/img/$deleted_image_name"));

        DB::update('UPDATE `organizations` SET `profile_image` = ? WHERE `id` = ?', [$p_image,$userId]);
        // return view('orgAdmin.org_edit_profile_profileImage',['status' => 'The Profile Image is changed ):' , 'profile_image' => $p_image]);
        return redirect()->route('o_dashboard');

    }

    // edit Logo Image
    public function show_edit_logo_image () {
        $userId = auth('organization')-> user()->id;
        $logo_image = DB::select('SELECT `logo` FROM `organizations` WHERE `id` = ?', [$userId])[0]->logo; 
        return view('orgAdmin.org_edit_profile_logo',['logo_image' => $logo_image]);
    }
    public function edit_logo_image (Request $r) {
        
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
        $deleted_image_name = DB::select('SELECT `logo` FROM `organizations` WHERE `id` = ?', [$userId])[0]->logo;
        if(!is_null($deleted_image_name) && file_exists(public_path("orgAdmin/img/$deleted_image_name")))
            $files = unlink(public_path("orgAdmin/img/$deleted_image_name"));

        DB::update('UPDATE `organizations` SET `logo` = ? WHERE `id` = ?', [$p_image,$userId]);
        $deleted_image_name = DB::select('SELECT `logo` FROM `organizations` WHERE `id` = ?', [$userId])[0]->logo;
        // return view('orgAdmin.o_dashboard',['status' => 'The Logo Image is changed ):' , 'logo_image' => $p_image]);
        return redirect()->route('o_dashboard');
    }

    //address

    public function show_edit_address(){
        $userId = auth('organization')->user()->id;
        $hospital_data = DB::select('SELECT `address`, `gov_id`, `city_id` FROM `organizations` WHERE id = ?', [$userId])[0];
        // get all Cities where gov_id = last gov_id of BB
        $cities = DB::select('select * from cities where gov_id = ?',[$hospital_data->gov_id]);
        $governorates = DB::select('select * from governorates');
        return view('orgAdmin.org_edit_address',['hospital_data' => $hospital_data, 'governorates' => $governorates,'cities' => $cities]);
    }

    public function edit_address(Request $r){

        $r->validate([
            'address' => 'required|min:4|max:100',
            'governorate' => 'required',
            'city' => 'required',
        ]);
        $userId = auth('organization')->user()->id;
        DB::update('UPDATE organizations SET `address` = ? , `gov_id` = ? , `city_id` = ? where id = ?', [$r->address,$r->governorate,$r->city,$userId]);

        // Prepare Action Content
        $action_content = "Hospital: ".DB::select('select name from organizations where id = ?', [$userId])[0]->name." Updated Its address: ".$r->address;
        // Insert Data into Actions table
        DB::insert("INSERT INTO `actions`(`action_content`, `hospital_id`)  VALUES (?,?)",[$action_content,$userId]);


        $userId = auth('organization')->user()->id;
        $hospital_data = DB::select('SELECT `address`, `gov_id`, `city_id` FROM `organizations` WHERE id = ?', [$userId])[0];
        $cities = DB::select('select * from cities where gov_id = ?',[$hospital_data->gov_id]);
        $governorates = DB::select('select * from governorates');
        return view('orgAdmin.org_edit_address',['hospital_data' => $hospital_data, 'governorates' => $governorates,'cities' => $cities]);
        return view('orgAdmin.org_edit_address',['status' => "Your address is updated to: $r->address "],['address' => $r->address]);
    }

    // links

    // Website
     // Facebook
     public function show_edit_website(){
        $userId = auth('organization')->user()->id; // get user id
        $social_link = DB::select('SELECT `social_link_id` FROM organizations WHERE id = ?', [$userId])[0]->social_link_id;
        $website = DB::select('SELECT `website` FROM `social_links` WHERE id = ?',[$social_link])[0]->website;
        // dd($website);
        return view('orgAdmin.org_edit_website',['website' => $website]);
    }
    
    public function edit_website(Request $r){
        $userId = auth('organization')->user()->id; // get user id
        $r->validate([
            'website' => 'url|required',
        ]);
        $social_link = DB::select('SELECT `social_link_id` FROM organizations WHERE id = ?', [$userId])[0]->social_link_id;
        // if There is no Social links to this organization
        if(is_null($social_link)) {
            DB::insert('INSERT INTO `social_links` (website) values (?)', [$r->website]);
            $new_social_recoed = DB::select('SELECT id FROM `social_links` WHERE  website= ?', [$r->website])[0]->id;
            DB::update('UPDATE organizations SET social_link_id = ? where id = ?', [$new_social_recoed,$userId]);
        }
        else {
            DB::update('UPDATE `social_links` SET `website`= ? WHERE id =?',[$r->website,$social_link]);
        }

        // Prepare Action Content
        $action_content = "Hospital: ".DB::select('select name from organizations where id = ?', [$userId])[0]->name." Updated Its website : ".$r->website;
        // Insert Data into Actions table
        DB::insert("INSERT INTO `actions`(`action_content`, `hospital_id`)  VALUES (?,?)",[$action_content,$userId]);

        
        return view('orgAdmin.org_edit_website',['status' => "Your website link is updated to: $r->website ","website" => $r->website]);
    }
    // map
    public function show_edit_map_link(){
        $userId = auth('organization')->user()->id; // get user id
        $social_link = DB::select('SELECT `social_link_id` FROM organizations WHERE id = ?', [$userId])[0]->social_link_id;
        $map_link = DB::select('SELECT `google_map` FROM `social_links` WHERE id = ?',[$social_link])[0]->google_map;
        return view('orgAdmin.org_edit_map',['map' => $map_link]);
    }

    public function edit_map_link(Request $r){

        $userId = auth('organization')->user()->id; // get user id
        $r->validate([
            'map' => 'url|required',
        ]);
        $social_link = DB::select('SELECT `social_link_id` FROM organizations WHERE id = ?', [$userId])[0]->social_link_id;
        
        if(is_null($social_link)) {
            DB::insert('INSERT INTO `social_links` (google_map) values (?)', [$r->map]);
            $new_social_recoed = DB::select('SELECT id FROM `social_links` WHERE  google_map= ?', [$r->map])[0]->id;
            DB::update('UPDATE organizations SET social_link_id = ? where id = ?', [$new_social_recoed,$userId]);
        }
        else {
            DB::update('UPDATE `social_links` SET `google_map`= ? WHERE id =?',[$r->map,$social_link]);
        }

        // Prepare Action Content
        $action_content = "Hospital: ".DB::select('select name from organizations where id = ?', [$userId])[0]->name." Updated Google Map: ".$r->map;
        // Insert Data into Actions table
        DB::insert("INSERT INTO `actions`(`action_content`, `hospital_id`)  VALUES (?,?)",[$action_content,$userId]);

        
        return view('orgAdmin.org_edit_map',['status' => "Your Google map link is updated to: $r->map ","map" => $r->map]);
    }
    // Facebook
    public function show_edit_facebook(){
        $userId = auth('organization')->user()->id; // get user id
        $social_link = DB::select('SELECT `social_link_id` FROM organizations WHERE id = ?', [$userId])[0]->social_link_id;
        $facebook_link = DB::select('SELECT `facebook` FROM `social_links` WHERE id = ?',[$social_link])[0]->facebook;
        return view('orgAdmin.org_edit_social_facebook',['facebook' => $facebook_link]);
    }
    
    public function edit_facebook(Request $r){

        $userId = auth('organization')->user()->id; // get user id
        $r->validate([
            'facebook' => 'url|required',
        ]);
        $social_link = DB::select('SELECT `social_link_id` FROM organizations WHERE id = ?', [$userId])[0]->social_link_id;
        
        if(is_null($social_link)) {
            DB::insert('INSERT INTO `social_links` (facebook) values (?)', [$r->facebook]);
            $new_social_recoed = DB::select('SELECT id FROM `social_links` WHERE  facebook= ?', [$r->facebook])[0]->id;
            DB::update('UPDATE organizations SET social_link_id = ? where id = ?', [$new_social_recoed,$userId]);
        }
        else {
            DB::update('UPDATE `social_links` SET `facebook`= ? WHERE id =?',[$r->facebook,$social_link]);
        }

        // Prepare Action Content
        $action_content = "Hospital: ".DB::select('select name from organizations where id = ?', [$userId])[0]->name." Updated Facebook: ".$r->facebook;
        // Insert Data into Actions table
        DB::insert("INSERT INTO `actions`(`action_content`, `hospital_id`)  VALUES (?,?)",[$action_content,$userId]);
        
        return view('orgAdmin.org_edit_social_facebook',['status' => "Your facebook link is updated to: $r->facebook ","facebook" => $r->facebook]);
    }
    // Instagram
    public function show_edit_instagram(){
        $userId = auth('organization')->user()->id; // get user id
        $social_link = DB::select('SELECT `social_link_id` FROM organizations WHERE id = ?', [$userId])[0]->social_link_id;
        $instagram_link = DB::select('SELECT `instagram` FROM `social_links` WHERE id = ?',[$social_link])[0]->instagram;
        return view('orgAdmin.org_edit_social_instagram',['instagram' => $instagram_link]);
    }
    
    public function edit_instagram(Request $r){ 
        $userId = auth('organization')->user()->id; // get user id
        $r->validate([
            'instagram' => 'url|required',
        ]);
        $social_link = DB::select('SELECT `social_link_id` FROM organizations WHERE id = ?', [$userId])[0]->social_link_id;
        
        if(is_null($social_link)) {
            DB::insert('INSERT INTO `social_links` (instagram) values (?)', [$r->instagram]);
            $new_social_recoed = DB::select('SELECT id FROM `social_links` WHERE  instagram= ?', [$r->instagram])[0]->id;
            DB::update('UPDATE organizations SET social_link_id = ? where id = ?', [$new_social_recoed,$userId]);
        }
        else {
            DB::update('UPDATE `social_links` SET `instagram`= ? WHERE id =?',[$r->instagram,$social_link]);
        }
        
        // Prepare Action Content
        $action_content = "Hospital: ".DB::select('select name from organizations where id = ?', [$userId])[0]->name." Updated Instagram: ".$r->instagram;
        // Insert Data into Actions table
        DB::insert("INSERT INTO `actions`(`action_content`, `hospital_id`)  VALUES (?,?)",[$action_content,$userId]);

        return view('orgAdmin.org_edit_social_instagram',['status' => "Your instagram link is updated to: $r->instagram ","instagram" => $r->instagram]);
    }
    // Twitter
    public function show_edit_twitter(){
        $userId = auth('organization')->user()->id; // get user id
        $social_link = DB::select('SELECT `social_link_id` FROM organizations WHERE id = ?', [$userId])[0]->social_link_id;
        $twitter_link = DB::select('SELECT `twitter` FROM `social_links` WHERE id = ?',[$social_link])[0]->twitter;
        return view('orgAdmin.org_edit_social_twitter',['twitter' => $twitter_link]);
    }
    
    public function edit_twitter(Request $r){ 
        $userId = auth('organization')->user()->id; // get user id
        $r->validate([
            'twitter' => 'url|required',
        ]);
        $social_link = DB::select('SELECT `social_link_id` FROM organizations WHERE id = ?', [$userId])[0]->social_link_id;
        
        if(is_null($social_link)) {
            DB::insert('INSERT INTO `social_links` (twitter) values (?)', [$r->twitter]);
            $new_social_recoed = DB::select('SELECT id FROM `social_links` WHERE  twitter= ?', [$r->twitter])[0]->id;
            DB::update('UPDATE organizations SET social_link_id = ? where id = ?', [$new_social_recoed,$userId]);
        }
        else {
            DB::update('UPDATE `social_links` SET `twitter`= ? WHERE id =?',[$r->twitter,$social_link]);
        }

         // Prepare Action Content
         $action_content = "Hospital: ".DB::select('select name from organizations where id = ?', [$userId])[0]->name." Updated Twitter: ".$r->twitter;
         // Insert Data into Actions table
         DB::insert("INSERT INTO `actions`(`action_content`, `hospital_id`)  VALUES (?,?)",[$action_content,$userId]);

        return view('orgAdmin.org_edit_social_twitter',['status' => "Your twitter link is updated to: $r->twitter ","twitter" => $r->twitter]);
    }
    // Youtube
    public function show_edit_youtube(){
        $userId = auth('organization')->user()->id; // get user id
        $social_link = DB::select('SELECT `social_link_id` FROM organizations WHERE id = ?', [$userId])[0]->social_link_id;
        $youtube_link = DB::select('SELECT `youtube` FROM `social_links` WHERE id = ?',[$social_link])[0]->youtube;
        return view('orgAdmin.org_edit_social_youtube',['youtube' => $youtube_link]);
    }
    
    public function edit_youtube(Request $r){ 
        
        $userId = auth('organization')->user()->id; // get user id
        $r->validate([
            'youtube' => 'url|required',
        ]);
        
        $social_link = DB::select('SELECT `social_link_id` FROM organizations WHERE id = ?', [$userId])[0]->social_link_id;
        
        if(is_null($social_link)) {
            DB::insert('INSERT INTO `social_links` (youtube) values (?)', [$r->youtube]);
            $new_social_recoed = DB::select('SELECT id FROM `social_links` WHERE  youtube= ?', [$r->youtube])[0]->id;
            DB::update('UPDATE organizations SET social_link_id = ? where id = ?', [$new_social_recoed,$userId]);
        }
        else {
            DB::update('UPDATE `social_links` SET `youtube`= ? WHERE id =?',[$r->youtube,$social_link]);
        }

        // Prepare Action Content
        $action_content = "Hospital: ".DB::select('select name from organizations where id = ?', [$userId])[0]->name." Updated Youtube Channel: ".$r->youtube;
        // Insert Data into Actions table
        DB::insert("INSERT INTO `actions`(`action_content`, `hospital_id`)  VALUES (?,?)",[$action_content,$userId]);
        
        return view('orgAdmin.org_edit_social_youtube',['status' => "Your youtube link is updated to: $r->youtube ","youtube" => $r->youtube]);
    }


    // Incubaters
    public function show_edit_incubaters() {
        $userId = auth('organization')->user()->id;
        $incubater = DB::select('SELECT `num_of_units`, `Available_units` FROM `incubators` WHERE  `hospital_id` = ?', [$userId]);
        if(!empty($incubater)) {
            $incubater = $incubater[0];
            return view('orgAdmin.org_edit_incubater',['all_incubaters' => $incubater->num_of_units, 'available_incubaters' => $incubater->Available_units]);
        }
        else {
            return view('orgAdmin.org_edit_incubater');
        }
    }
    public function edit_incubaters(Request $r) {
        $r->validate([
            'all_incubaters' => 'required|numeric|min:1',
            'available_incubaters' => 'required|numeric|min:0',
        ]);
        if($r->all_incubaters < $r->available_incubaters) {
            return  Redirect::back()->withErrors("All incubater units ($r->all_incubaters) must be less than or equal all available incubater units ($r->available_incubaters).");
        }
        $userId = auth('organization')->user()->id;
        $incubater = DB::select('SELECT `num_of_units`, `Available_units` FROM `incubators` WHERE  `hospital_id` = ?', [$userId]);
        if(!empty($incubater)) {
            DB::update('UPDATE `incubators` SET `num_of_units`=?,`Available_units`=? WHERE `hospital_id` = ?', [$r->all_incubaters,$r->available_incubaters, $userId]);

            // Prepare Action Content
            $action_content = "Hospital: ".DB::select('select name from organizations where id = ?', [$userId])[0]->name." Updated Incubaters Data";
            // Insert Data into Actions table
            DB::insert("INSERT INTO `actions`(`action_content`, `hospital_id`)  VALUES (?,?)",[$action_content,$userId]);
        }
        else {
            DB::insert('INSERT INTO incubators (hospital_id, num_of_units, Available_units) VALUES (?, ?  ,?)', [$userId,$r->all_incubaters, $r->available_incubaters]);

            // Prepare Action Content
            $action_content = "Hospital: ".DB::select('select name from organizations where id = ?', [$userId])[0]->name." Added Incubaters.";
            // Insert Data into Actions table
            DB::insert("INSERT INTO `actions`(`action_content`, `hospital_id`)  VALUES (?,?)",[$action_content,$userId]);
        }
        return view('orgAdmin.org_edit_incubater',['all_incubaters' => $r->all_incubaters, 'available_incubaters' => $r->available_incubaters,'status' => "Your Incubater Date is updated, All incubater units is [$r->all_incubaters] And available incubater units is [$r->available_incubaters]."]);
    }

    // Intensive care
    public function show_edit_intensiveCare() {
        $userId = auth('organization')->user()->id;
        $intensiveCare = DB::select('SELECT `num_of_rooms`, `Available_rooms` FROM `intensive_care` WHERE  `hospital_id` = ?', [$userId]);
        if(!empty($intensiveCare)) {
            $intensiveCare = $intensiveCare[0];
            return view('orgAdmin.org_edit_intensive_care',['all_intensiveCare' => $intensiveCare->num_of_rooms, 'available_intensiveCare' => $intensiveCare->Available_rooms]);
        }
        else {
            return view('orgAdmin.org_edit_intensive_care');
        }
    }

    public function edit_intensiveCare(Request $r) {
        $r->validate([
            'all_intensiveCare' => 'required|numeric|min:1',
            'available_intensiveCare' => 'required|numeric|min:0',
        ]);
        if($r->all_intensiveCare < $r->available_intensiveCare) {
            return  Redirect::back()->withErrors("All Intensive care rooms ($r->all_intensiveCare) must be less than or equal all available intensive Care rooms($r->available_incubaters).");
        }
        $userId = auth('organization')->user()->id;
        $intensiveCare = DB::select('SELECT `num_of_rooms`, `Available_rooms` FROM `intensive_care` WHERE  `hospital_id` = ?', [$userId]);
        if(!empty($intensiveCare)) {
            DB::update('UPDATE `intensive_care` SET `num_of_rooms`=?,`Available_rooms`=? WHERE `hospital_id` = ?', [$r->all_intensiveCare,$r->available_intensiveCare, $userId]);

            // Prepare Action Content
            $action_content = "Hospital: ".DB::select('select name from organizations where id = ?', [$userId])[0]->name." Updated Intensive Care Data";
            // Insert Data into Actions table
        DB::insert("INSERT INTO `actions`(`action_content`, `hospital_id`)  VALUES (?,?)",[$action_content,$userId]);
        }
        else {
            DB::insert('INSERT INTO intensive_care (hospital_id, num_of_rooms, Available_rooms) VALUES (?, ?  ,?)', [$userId,$r->all_intensiveCare, $r->available_intensiveCare]);

            // Prepare Action Content
            $action_content = "Hospital: ".DB::select('select name from organizations where id = ?', [$userId])[0]->name." Added Intensive Care.";
            // Insert Data into Actions table
            DB::insert("INSERT INTO `actions`(`action_content`, `hospital_id`)  VALUES (?,?)",[$action_content,$userId]);
        }
        return view('orgAdmin.org_edit_intensive_care',['all_intensiveCare' => $r->all_intensiveCare, 'available_intensiveCare' => $r->available_intensiveCare,'status' => "Your Intensive care Date is updated , All intensive care rooms is [$r->all_intensiveCare] And available intensive care rooms is [$r->available_intensiveCare]."]);
    }




    
}
