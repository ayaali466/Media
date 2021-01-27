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

class RaditionController extends Controller
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
    
     
    public function show_add_radition(){
        
        return view('superAdmin.admin_add_radition');
    }
    public function add_radition(Request $r){
        $r->validate([
            'radiation_name' => 'required|unique:medical_radiations'
        ]);
        DB::insert('INSERT INTO `medical_radiations`( `radiation_name`) VALUES (?)', [$r->radiation_name]);
        DB::table('recent_activities')->insert(['activity_content'=>"Add  New Radition Name ( ".$r->radiation_name." )"]);
        return redirect()->back()->with('success',"New Radition ( ".$r->radiation_name." ) is Added");
    }

   public function show_delete_radition(){

        $all_raditions = DB::select('SELECT * FROM `medical_radiations`');
        return view('superAdmin.admin_delete_radition',['all_raditions'=>$all_raditions]);
    }
    public function delete_radition(Request $r){
        $r->validate([
            'radition_id' =>'required'
        ]);
        $radition_name = DB::select('SELECT `radiation_name` FROM `medical_radiations` WHERE id = ?',[$r->radition_id])[0]->radiation_name;
        DB::delete('DELETE FROM `medical_radiations` where id = ?', [$r->radition_id]);
        DB::table('recent_activities')->insert(['activity_content'=>"Delete Radition Name ( ".$radition_name." )"]);
        return redirect()->back()->with('success',"Radition ($radition_name) is Deleted");
    }


    
}
