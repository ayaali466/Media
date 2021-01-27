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

class BloodBankOrganizationController extends Controller
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
    public function show_add_bloodBank()
    {
        $governorates = DB::select('select * from governorates'); // get all governorates
        return view('orgAdmin.org_add_blood_bank',['governorates' => $governorates]);
    }
    public function add_bloodBank(Request $r)
    {
        $userId = auth('organization')->user()->id; // get user id
        $userPassword = auth('organization')->user()->password;
        $r->validate([
            'blood_bank_name' => 'required|min:4|max:100',
            'blood_bank_email' => 'required|email|max:255',
            'governorate' => 'required',
            'city' => 'required',
            'address' => 'required|min:10|max:150',
            'blood_bank_phone' => 'required|max:8',
            'blood_bank_profileImage' => 'required|image|max:4096|mimes:jpeg,jpg,png',
            'blood_bank_logogImage' => 'required|image|max:4096|mimes:jpeg,jpg,png',
            'blood_bank_website' => 'url|nullable',
            'blood_bank_facebook' => 'url|nullable',
            'blood_bank_twitter' => 'url|nullable',
            'blood_bank_instagram' => 'url|nullable',
            'blood_bank_youtube' => 'url|nullable',
            'blood_bank_map' => 'url|nullable',
            'about_us' => 'required|max:5000',
        ]);
        
        // Save Profile Image To sever
        if ($r->hasFile('blood_bank_profileImage')) {
            /* $p_image = $r->file('blood_bank_profileImage');
            $name = $userId.time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/orgAdmin/img');
            $p_image->move($destinationPath, $name); */
            $p_image = $userId.time().'.'.request()->blood_bank_profileImage->getClientOriginalExtension();
            request()->blood_bank_profileImage->move(public_path('/orgAdmin/img'), $p_image);
        }
        // Save Logo Image To sever
        if ($r->hasFile('blood_bank_logogImage')) {
            $image = $r->file('blood_bank_logogImage');
            $l_image = $userId.'1'.time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/orgAdmin/img');
            $image->move($destinationPath, $l_image);
        }
        // Handle phone content
        $phone="";
        if($r -> pre_phone_code != 'hotline')
            $phone = $r -> pre_phone_code.$r ->blood_bank_phone;
        else
        $phone = $r ->blood_bank_phone;

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
            return  redirect('org_admin/edit_BB')->withErrors($erors_array);
        }

        // Insert Data into scoial links table
        DB::insert("INSERT INTO `social_links`(`youtube`, `instagram`, `twitter`, `facebook`, `google_map`, `website`) VALUES (?,?,?,?,?,?)", [
            $r ->blood_bank_youtube ,$r->blood_bank_instagram, $r ->blood_bank_twitter ,$r->blood_bank_facebook, $r ->blood_bank_map ,$r->blood_bank_website
            ]);
        // Get Id for the inserted social link
        $social_links_id = DB::select("SELECT id FROM `social_links` ORDER BY id DESC LIMIT 1")[0]->id;
        // Insert Data into Blood Banks table
        DB::insert("INSERT INTO `blood_banks` ( `name`, `email`, `password`, `address`, `phone`, `logo`, `profile_image`, `about_us`, `hospital_id`, `social_link_id`, `gov_id`, `city_id`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", [
            $r->blood_bank_name,$r -> blood_bank_email,$userPassword,$r->address,$phone,$l_image,$p_image,$r->about_us,$userId,$social_links_id,$r-> governorate,$r-> city
        ]);
        // added records to new blood bank to its store with default ZERO
        $add_BB_id = DB::select("SELECT `id` FROM `blood_banks` ORDER BY id DESC LIMIT 1")[0]->id;

        DB::insert("INSERT INTO `bloods_blood_banks` (`blood_type_id`, `blood_bank_id`, `number_of_cases`) VALUES ( '1', ?, '0'), ( '2', ?, '0'), ( '3', ?, '0'), ( '4', ?, '0'), ( '5', ?, '0'), ( '6', ?, '0'), ( '7', ?, '0'), ( '8', ?, '0')", [$add_BB_id,$add_BB_id,$add_BB_id,$add_BB_id,$add_BB_id,$add_BB_id,$add_BB_id,$add_BB_id]);

        // Prepare Action Content
        $action_content = "Hospital: ".DB::select('select name from organizations where id = ?', [$userId])[0]->name." Added New Blood Bank: ".$r->blood_bank_name;
        // Insert Data into Actions table
        DB::insert("INSERT INTO `actions`(`action_content`, `hospital_id`)  VALUES (?,?)",[$action_content,$userId]);

        $governorates = DB::select('select * from governorates'); // get all governorates
        return view('orgAdmin.org_add_blood_bank',['governorates' => $governorates,'result' => $r-> blood_bank_name]);
    }

    // Delete
    public function show_delete_bloodBank()
    {
        $userId = auth('organization')->user()->id; // get user id
        $blood_banks =  DB::select('SELECT id, name FROM  blood_banks WHERE hospital_id = ?',[$userId]);
        return view('orgAdmin.org_delete_blood_bank',['blood_banks' => $blood_banks]);
    }
    public function delete_bloodBank(Request $r)
    {
        //blood_bank_id
        $r->validate([
            'blood_bank_id' => 'required',
        ],[],[
            'blood_bank_id' => 'Blood Bank',
        ]);
        $userId = auth('organization')->user()->id; // get user id
        $deleted_blood_bank=  DB::select('SELECT `name`,`social_link_id`, `logo` , `profile_image` FROM  blood_banks WHERE id = ?',[$r->blood_bank_id])[0];
        // delete corresponging social links
        DB::delete('DELETE FROM `social_links` WHERE `id` = ?', [$deleted_blood_bank->social_link_id]);
        // delete corresponging blood bank cases
        DB::delete('DELETE FROM `bloods_blood_banks` WHERE `blood_bank_id` = ?', [$r->blood_bank_id]);
        
        // Delete Stored Images
        // Delete Stored Logo
        if(!is_null($deleted_blood_bank->logo) && file_exists(public_path("orgAdmin/img/$deleted_blood_bank->logo")))
            unlink(public_path("orgAdmin/img/$deleted_blood_bank->logo"));

        // Delete Stored Profile Image
        if(!is_null($deleted_blood_bank->profile_image) && file_exists(public_path("orgAdmin/img/$deleted_blood_bank->profile_image")))
            unlink(public_path("orgAdmin/img/$deleted_blood_bank->profile_image"));

        // delete Blood Bank
        DB::delete('DELETE FROM blood_banks WHERE id = ?', [$r->blood_bank_id]);
        
        // Prepare Action Content
        $action_content = "Hospital: ".DB::select('select name from organizations where id = ?', [$userId])[0]->name." delete Blood Bank: ".$deleted_blood_bank->name;
        // Insert Data into Actions table
        DB::insert("INSERT INTO `actions`(`action_content`, `hospital_id`)  VALUES (?,?)",[$action_content,$userId]);
        // send the rest Blood banks
        $blood_banks =  DB::select('SELECT id, name FROM  blood_banks WHERE hospital_id = ?',[$userId]);
        return view('orgAdmin.org_delete_blood_bank',['blood_banks' => $blood_banks, 'deleted_blood_bank_name' => $deleted_blood_bank->name  ]);
        
    }
    // I amn't handle remove images from the server will come!!!!!!!

    //Update
    public function show_select_to_update_bloodBank() {
        $userId = auth('organization')->user()->id; // get user id
        // Get all blood banks related to This Organization
        $blood_banks =  DB::select('SELECT id, name FROM  blood_banks WHERE hospital_id = ?',[$userId]);
        return view('orgAdmin.org_edit_blood_bank_select_one',['blood_banks' => $blood_banks ]);
    }
    
    public function redirect_to_show_select_to_update_bloodBank() {
        return redirect()->back();
    }

    public function redirect_to_show_update_bloodBank(){
        return redirect()->back();
    }

    public function show_update_bloodBank(Request $r) {

        $r->validate([
            'blood_bank_id' => 'required',
        ],[],
        [
            'blood_bank_id' => 'Blood Bank'
        ]);
        // dd(url()->previous());
        // dd($r);
        // Get all avialable cases for the first blood bank
        $blood_available_cases =  DB::select('SELECT number_of_cases,blood_type FROM  bloods_blood_banks INNER JOIN blood_types
        ON  blood_types.id = bloods_blood_banks.blood_type_id
        WHERE blood_bank_id = ?',[$r->blood_bank_id]);
        // dd($blood_available_cases);
        // Get all data selected blood bank
        $all_BB_data =  DB::select('SELECT * FROM  blood_banks where id = ?',[$r->blood_bank_id]);
        // get all governorates
        $governorates = DB::select('select * from governorates');

        // get all Cities where gov_id = last gov_id of BB
        $cities = DB::select('select * from cities where gov_id = ?',[$all_BB_data[0]->gov_id]); 

        // get all socila_links of BB
        $socila_links = DB::select('select * from social_links where id = ?',[$all_BB_data[0]->social_link_id]); 
        // dd($socila_links);
        $BB_name=DB::select('SELECT `name` FROM `blood_banks` WHERE id = ?', [$r->blood_bank_id])[0]->name;

        return view('orgAdmin.org_edit_blood_bank',['blood_available_cases' => $blood_available_cases,'all_BB_data' => $all_BB_data,'governorates' => $governorates, 'cities' => $cities ,'socila_links' => $socila_links,'BB_id' => $r->blood_bank_id, 'BB_name' => $BB_name] );
    }
    
    
    public function update_bloodBank(Request $r) {
        // dd(url()->previous());
        $BB_name = $r->BB_name;
        /* $r->validate([
            'blood_bank_name' => 'required|min:4|max:100',
            'blood_bank_email' => 'required|email|max:255',
            'governorate' => 'required',
            'city' => 'required',
            'address' => 'required|min:10|max:150',
            'blood_bank_phone' => 'required|max:8',
            'blood_bank_website' => 'url|nullable',
            'blood_bank_facebook' => 'url|nullable',
            'blood_bank_twitter' => 'url|nullable',
            'blood_bank_instagram' => 'url|nullable',
            'blood_bank_youtube' => 'url|nullable',
            'blood_bank_map' => 'url|nullable',
            'about_us' => 'required|max:5000',
            'O_minus' => 'required',
            'O_plus' => 'required',
            'A_minus' => 'required',
            'A_plus' => 'required',
            'B_minus' => 'required',
            'B_plus' => 'required',
            'AB_minus' => 'required',
            'AB_plus' => 'required',

        ]); */
        
        // Handle errors
        $erors_array = [];
        $checkerrors = FALSE;
        // Check uique on social links
        // blood_bank_website

        $social_link_id = $r->social_id;
        // dd($social_link_id);
        if(!is_null($r->blood_bank_website) && DB::select('SELECT COUNT(*) as count from social_links where website = ? AND id != ?', [$r->blood_bank_website,$social_link_id])[0]->count) {
            array_push($erors_array,"The Website link: ($r->blood_bank_website) has already been taken.");
            $checkerrors = true;
        }
        // blood_bank_facebook
        if(!is_null($r->blood_bank_facebook) && DB::select('SELECT COUNT(*) as count from social_links where facebook = ? AND id != ?', [$r->blood_bank_facebook,$social_link_id])[0]->count) {
            array_push($erors_array,"The Facebook link: ($r->blood_bank_facebook) has already been taken.");
            $checkerrors = true;
        }
        // blood_bank_twitter
        if(!is_null($r->blood_bank_twitter) && DB::select('SELECT COUNT(*) as count from social_links where twitter = ? AND id != ?', [$r->blood_bank_twitter,$social_link_id])[0]->count) {
            array_push($erors_array,"The Twitter link: ($r->blood_bank_twitter) has already been taken.");
            $checkerrors = true;
        }
        // blood_bank_instagram
        if(!is_null($r->blood_bank_instagram) && DB::select('SELECT COUNT(*) as count from social_links where instagram = ? AND id != ?', [$r->blood_bank_instagram,$social_link_id])[0]->count) {
            array_push($erors_array,"The Instagram link: ($r->blood_bank_instagram) has already been taken.");
            $checkerrors = true;
        }
        // blood_bank_youtube
        if(!is_null($r->blood_bank_youtube) && DB::select('SELECT COUNT(*) as count from social_links where youtube = ? AND id != ?', [$r->blood_bank_youtube,$social_link_id])[0]->count) {
            array_push($erors_array,"The Youtube link: ($r->blood_bank_youtube) has already been taken.");
            $checkerrors = true;
        }
        // blood_bank_map
        if(!is_null($r->blood_bank_map) && DB::select('SELECT COUNT(*) as count from social_links where google_map = ? AND id != ?', [$r->blood_bank_map,$social_link_id])[0]->count) {
            array_push($erors_array,"The Google Map link: ($r->blood_bank_map) has already been taken.");
            $checkerrors = true;
        }
        // email
        if(!is_null($r->blood_bank_email) && DB::select('SELECT COUNT(*) as count from blood_banks where email = ?  AND id != ?', [$r->blood_bank_email,$r->BB_id])[0]->count) {
            array_push($erors_array,"The email: ($r->blood_bank_email) has already been taken.");
            $checkerrors = true;
        }
        if($checkerrors) {
            return  Redirect::back()->withErrors($erors_array);
        }

        //-------------------------------------------------------------------------------

        $userId = auth('organization')->user()->id; // get user id
        $phone="";
        if($r -> pre_phone_code != 'hotline')
            $phone = $r -> pre_phone_code.$r ->blood_bank_phone;
        else
        $phone = $r ->blood_bank_phone;
        
        // Update Data into scoial links table
        DB::update('UPDATE  `social_links` SET `youtube`= ?, `instagram`=?, `twitter`=?, `facebook`=?,`google_map`=?, `website`=? WHERE id = ?',[$r->blood_bank_youtube,$r->blood_bank_instagram,$r->blood_bank_twitter,$r->blood_bank_facebook,$r->blood_bank_map,$r->blood_bank_website,$r->social_id] );

        // Update Data into Blood Banks table
        DB::update('UPDATE `blood_banks` SET `name`=?,`email`=?,`address`=?,`phone`=?,`about_us`=?, `gov_id`=?,`city_id`=? WHERE id = ?', [$r->blood_bank_name, $r->blood_bank_email, $r->address, $phone, $r->about_us, $r->governorate, $r->city ,$r->BB_id]);

        // Get all avialable cases for the first blood bank
        $blood_available_cases =  DB::select('SELECT number_of_cases,blood_type FROM  bloods_blood_banks INNER JOIN blood_types
        ON  blood_types.id = bloods_blood_banks.blood_type_id
        WHERE blood_bank_id = ?',[$r->BB_id]);
        $blood_types_cases = [
            'A+' => 0,
            'A-' => 0,
            'O+' => 0,
            'O-' => 0,
            'B+' => 0,
            'B-' => 0,
            'AB+' => 0,
            'AB-' => 0,
        ];
       
        foreach($blood_available_cases as $one){
            $blood_types_cases[$one->blood_type] = $one->number_of_cases;
        }
        $blood_types_cases['O+']+=$r->O_plus;
        $blood_types_cases['O-']+=$r->O_minus;
        $blood_types_cases['A+']+=$r->A_plus;
        $blood_types_cases['A-']+=$r->A_minus;
        $blood_types_cases['B+']+=$r->B_plus;
        $blood_types_cases['B-']+=$r->B_minus;
        $blood_types_cases['AB+']+=$r->AB_plus;
        $blood_types_cases['AB-']+=$r->AB_minus;
        // dd($blood_types_cases);

         /* Static Data
        O-  => 1
        O+  => 2
        A-  => 3
        A+  => 4
        B-  => 5 
        B+  => 6
        AB- => 7
        AB+ => 8
        */
        // Update Number of available cases
        DB::update("UPDATE `bloods_blood_banks` SET `number_of_cases`=? WHERE blood_type_id = ?  AND blood_bank_id = ?", [$blood_types_cases['O-'],1,$r->BB_id]);
        DB::update("UPDATE `bloods_blood_banks` SET `number_of_cases`=? WHERE blood_type_id = ?  AND blood_bank_id = ?", [$blood_types_cases['O+'],2,$r->BB_id]);
        DB::update("UPDATE `bloods_blood_banks` SET `number_of_cases`=? WHERE blood_type_id = ?  AND blood_bank_id = ?", [$blood_types_cases['A-'],3,$r->BB_id]);
        DB::update("UPDATE `bloods_blood_banks` SET `number_of_cases`=? WHERE blood_type_id = ?  AND blood_bank_id = ?", [$blood_types_cases['A+'],4,$r->BB_id]);
        DB::update("UPDATE `bloods_blood_banks` SET `number_of_cases`=? WHERE blood_type_id = ?  AND blood_bank_id = ?", [$blood_types_cases['B-'],5,$r->BB_id]);
        DB::update("UPDATE `bloods_blood_banks` SET `number_of_cases`=? WHERE blood_type_id = ?  AND blood_bank_id = ?", [$blood_types_cases['B+'],6,$r->BB_id]);
        DB::update("UPDATE `bloods_blood_banks` SET `number_of_cases`=? WHERE blood_type_id = ?  AND blood_bank_id = ?", [$blood_types_cases['AB-'],7,$r->BB_id]);
        DB::update("UPDATE `bloods_blood_banks` SET `number_of_cases`=? WHERE blood_type_id = ?  AND blood_bank_id = ?", [$blood_types_cases['AB+'],8,$r->BB_id]);
        // dd(DB::select('select name from blood_banks where id = ?', [$r->BB_id]),$r->BB_id);
        // dd("UPDATE `bloods_blood_banks` SET `number_of_cases`=? WHERE blood_type_id = ?  AND blood_bank_id = ?",$blood_types_cases['O+'],1,$r->BB_id);

        
        // Prepare Action Content
        $action_content = "Hospital: ".DB::select('select name from organizations where id = ?', [$userId])[0]->name." Updated Blood bank: ".DB::select('select name from blood_banks where id = ?', [$r->BB_id])[0]->name;
        
        // Insert Data into Actions table
        DB::insert("INSERT INTO `actions`(`action_content`, `hospital_id`)  VALUES (?,?)",[$action_content,$userId]);


        // all Code of Show edit

        // Get all avialable cases for the first blood bank
        /* $blood_available_cases =  DB::select('SELECT number_of_cases,blood_type FROM  bloods_blood_banks INNER JOIN blood_types
        ON  blood_types.id = bloods_blood_banks.blood_type_id
        WHERE blood_bank_id = ?',[$r->BB_id]); */
        // dd($blood_available_cases);
        // Get all data selected blood bank
        // $all_BB_data =  DB::select('SELECT * FROM  blood_banks where id = ?',[$r->BB_id]);
        
        // get all governorates
        // $governorates = DB::select('select * from governorates');

        // get all Cities where gov_id = last gov_id of BB
        // $cities = DB::select('select * from cities where gov_id = ?',[$all_BB_data[0]->gov_id]); 

        // get all socila_links of BB
        // $socila_links = DB::select('select * from social_links where id = ?',[$all_BB_data[0]->social_link_id]); 
        // dd($socila_links);
        // dd($BB_name);
        $userId = auth('organization')->user()->id; // get user id
        // Get all blood banks related to This Organization
        $blood_banks =  DB::select('SELECT id, name FROM  blood_banks WHERE hospital_id = ?',[$userId]);
        return view('orgAdmin.org_edit_blood_bank_select_one',['blood_banks' => $blood_banks , "last_BB_name" => $BB_name]);
    }

    // Edit Profile
    public function show_edit_BB_Profile_image($id) {
        $userId = auth('organization')->user()->id; // get user id
        $BB_profile = DB::select('SELECT profile_image FROM blood_banks WHERE hospital_id = ? AND id = ?', [$userId, $id]);
        if(empty($BB_profile))
            abort(404);
        else
            $BB_profile = $BB_profile[0]->profile_image;
            // dd($lab_profile);
        return view('orgAdmin.org_edit_BB_profile_image',['profile_image' => $BB_profile, 'BB_id' => $id]);
    }

    public function edit_BB_Profile_image(Request $r){
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
        DB::update('UPDATE `blood_banks` SET `profile_image` = ? WHERE `id` = ?', [$p_image,$r->BB_id]);
        return redirect()->back();
    }

    
    // edit Logo Image
    public function show_edit_BB_logo_image ($id) {
        $userId = auth('organization')->user()->id; // get user id
        $BB_logo = DB::select('SELECT logo FROM blood_banks WHERE hospital_id = ? AND id = ?', [$userId, $id]);
        if(empty($BB_logo))
            abort(404);
        else
            $BB_logo = $BB_logo[0]->logo;
            // dd($lab_profile);
        return view('orgAdmin.org_edit_BB_logo',['logo_image' => $BB_logo, 'BB_id' => $id]);
    }
    public function edit_BB_logo_image (Request $r) {
        
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
        DB::update('UPDATE `blood_banks` SET `logo` = ? WHERE `id` = ?', [$l_image,$r->BB_id]);
        return redirect()->back();
    }

}
