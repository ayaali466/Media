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

class DepartmentController extends Controller
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
    
     
    public function show_add_department(){

        return view('superAdmin.admin_add_department');
    }
    public function add_department(Request $r){
        $r->validate([
            'name' => 'required|unique:departments'
        ]);
        DB::insert('INSERT INTO `departments`( `name`) VALUES (?)', [$r->name]);
        DB::table('recent_activities')->insert(['activity_content'=>"Add  New Department Name ( ".$r->name." )"]);
        return redirect()->back()->with('success',"New Department ( ".$r->name." ) is Added");
    }

   public function show_delete_department(){

        $all_departments = DB::select('SELECT * FROM `departments`');
        return view('superAdmin.admin_delete_department',['all_departments'=>$all_departments]);

}

    public function delete_department(Request $r){
        
        $r->validate([
            'department_id' =>'required'
        ]);
        $department_name = DB::select('SELECT `name` FROM `departments` WHERE id = ?',[$r->department_id])[0]->name;
        DB::delete('DELETE FROM `departments` where id = ?', [$r->department_id]);
        DB::table('recent_activities')->insert(['activity_content'=>"Delete Department Name ( ".$department_name." )"]);
        return redirect()->back()->with('success',"Department ($department_name) is Deleted");
    }


    
}
