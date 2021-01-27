<?php
/* Change namespace from 
   namespace App\Http\Controllers;
To:namespace App\Http\Controllers\OrganizationControllers;
   add use App\Http\Controllers\Controller;
*/
namespace App\Http\Controllers\AdminControllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Redirect;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
   
    public function index(){
        $data= DB::table("organizations")->orderBy("name","desc")->get();
        return view("live_search",["data"=>$data]);
 
    }
     public function search(Request $request){
         $request->validate([
            "naorem" =>"required"
         ]);
         $q=$request->naorem;
        $filterhosp=
        DB::table("organizations")->where("name","like","%". $q.'%')->orwhere("email","like","%". $q.'%')->get();
        if( $filterhosp->count()){
            return view("live_search")->with(["data"=>$filterhosp]);
                        }
        else{
            return redirect("/hospitals")->with(["status"=>" no results found"]);
        }
    }
 
     public function delete($id){
         $hos_data = DB::select('SELECT * from organizations where id=?',[$id])[0];
        
         // Delete Labs And Centers
        $all_labs_centers = DB::select("SELECT * FROM labs_centers WHERE hospital_id = ?",[$id]);
        foreach($all_labs_centers as $one){ // Labs And Centers
            DB::delete('DELETE FROM `social_links` WHERE `id` = ?', [$one->social_link_id]); // delete scoial link
            // Delete Stored Logo
            if(!is_null($one->logo) && file_exists(public_path("orgAdmin/img/$one->logo")))
                $files = unlink(public_path("orgAdmin/img/$one->logo"));

            // Delete Stored Profile Image
            if(!is_null($one->profile_image) && file_exists(public_path("orgAdmin/img/$one->profile_image")))
                $files = unlink(public_path("orgAdmin/img/$one->profile_image"));
                DB::delete('DELETE FROM labs_centers WHERE id = ?', [$one->id]); // Delete Automatic As on DELETE CASCADE
        }

        // Delete Blood Banks
        $all_BBs = DB::select("SELECT * FROM blood_banks WHERE hospital_id = ?",[$id]);
        foreach($all_BBs as $one){ // Blood Banks
            DB::delete('DELETE FROM `social_links` WHERE `id` = ?', [$one->social_link_id]); // delete scoial link
            // Delete Stored Logo
            if(!is_null($one->logo)  && file_exists(public_path("orgAdmin/img/$one->logo")))
                $files = unlink(public_path("orgAdmin/img/$one->logo"));

            // Delete Stored Profile Image
            if(!is_null($one->profile_image) && file_exists(public_path("orgAdmin/img/$one->profile_image")))
                $files = unlink(public_path("orgAdmin/img/$one->profile_image"));
                DB::delete('DELETE FROM labs_centers WHERE id = ?', [$one->id]); // Delete Automatic As on DELETE CASCADE
        }
        // Delete Doctors
        $all_deps = DB::select("SELECT `id` FROM `departments_hospitals` WHERE  `hospital_id` = ?",[$id]);
        foreach($all_deps as $onedep){ // departments
            $all_doctor = DB::select('SELECT doctors.photo FROM doctors INNER JOIN departments_hospitals ON doctors.department_id = departments_hospitals.id WHERE departments_hospitals.id = ?',[$onedep->id]);
            foreach($all_doctor as $one_doctor){ // Doctors
                if(!is_null($one_doctor->photo) && file_exists(public_path("orgAdmin/img/$one_doctor->photo")) ) {
                    $files = unlink(public_path("orgAdmin/img/$one_doctor->photo"));
                }
                    
            }
        }
        
        DB::delete('DELETE FROM `social_links` WHERE `id` = ?', [$hos_data->social_link_id]);
        
        DB::delete("delete from organizations where id=?",[$id]);
        if(!is_null($hos_data->logo)) // Delete Hospital Logo
           unlink(public_path("orgAdmin/img/$hos_data->logo"));

        if(!is_null($hos_data->profile_image)) // Delete Hospital Profile Image
           unlink(public_path("orgAdmin/img/$hos_data->profile_image"));

        DB::table('recent_activities')->insert(['activity_content'=>"Delete Hospital (".$hos_data->name.")"]);

        //  return redirect('admin/live_search');
        return redirect()->back()->with("success","hospital ($hos_data->name) deleted  successfully");

    }
}
