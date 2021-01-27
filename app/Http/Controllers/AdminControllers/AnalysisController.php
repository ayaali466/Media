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

class AnalysisController extends Controller
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
    
     
    public function show_add_analysis(){

        return view('superAdmin.admin_add_analysis');
    }
    public function add_analysis(Request $r){
        $r->validate([
            'analysis_name' => 'required|unique:medical_analysis'
        ]);
        DB::insert('INSERT INTO `medical_analysis`( `analysis_name`) VALUES (?)', [$r->analysis_name]);
        DB::table('recent_activities')->insert(['activity_content'=>"Add  New Analysis Name ( ".$r->analysis_name." )"]);
        return redirect()->back()->with('success',"New Analysis ( ".$r->analysis_name." ) is Added");
    }

   public function show_delete_analysis(){

        $all_analysis = DB::select('SELECT * FROM `medical_analysis`');
        return view('superAdmin.admin_delete_analysis',['all_analysis'=>$all_analysis]);
    }
    public function delete_analysis(Request $r){
        $r->validate([
            'analysis_id' =>'required'
        ]);
        $analysis_name = DB::select('SELECT `analysis_name` FROM `medical_analysis` WHERE id = ?',[$r->analysis_id])[0]->analysis_name;
        DB::delete('DELETE FROM `medical_analysis` where id = ?', [$r->analysis_id]);
        DB::table('recent_activities')->insert(['activity_content'=>"Delete Analysis Name ( ".$analysis_name." )"]);
        return redirect()->back()->with('success',"Analysis ($analysis_name) is Deleted");
    }


    
}
