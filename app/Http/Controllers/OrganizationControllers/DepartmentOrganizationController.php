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

class DepartmentOrganizationController extends Controller
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
    public function get_Organization_departments() {
        $userId = auth('organization')->user()->id; // get user id
        $Organization_departments = DB::select("SELECT departments_hospitals.id, departments.name from departments INNER JOIN departments_hospitals
        on departments_hospitals.department_id = departments.id
        where departments_hospitals.hospital_id =?",[$userId]); // get all departments id which is in this organization
        return $Organization_departments;
    }
    public function get_other_departments() {
        // $user = auth('organization')->user();
        // $data = "id: $user->id, Username: $user->name, E-mail: $user->email";
        $userId = auth('organization')->user()->id; // get user id
        $Organization_departments = DB::select('SELECT department_id from departments_hospitals where hospital_id=?',[$userId]); // get all departments id which is in this organization
        $Organization_departmentsIDs = ''; // string will contain all department ids of this organization
        foreach($Organization_departments as $one){ // loop on data from DB to get all ids in string
            $Organization_departmentsIDs.=$one -> department_id .",";
        }
        $Organization_departmentsIDs = substr($Organization_departmentsIDs,0,strlen($Organization_departmentsIDs)-1);//remove the last added [ , ]
        if(empty($Organization_departmentsIDs)) 
            $Organization_departmentsIDs = -1;
        $allOtherdepartments = DB::select("SELECT * from departments where id not in($Organization_departmentsIDs)");
        return $allOtherdepartments;
    }
    public function show_add_department()
    {
        $allOtherdepartments = $this->get_other_departments();
        return view('orgAdmin.org_add_department',['all_other_dep' => $allOtherdepartments]);
    }
    public function add_department(Request $r)
    {
        $userId = auth('organization')->user()->id; // get user id
        if(DB::select("select id from departments where id = ?",[$r -> selected_department])){
            $dep_name = DB::select("select name from departments where id = ?",[$r -> selected_department])[0]->name;
            DB::insert('insert into departments_hospitals (department_id, hospital_id) values (?, ?)', [$r -> selected_department, $userId]);
            $msg = "New Department ( $dep_name ) Is added";
        // Prepare Action Content
        $action_content = "Hospital: ".DB::select('select name from organizations where id = ?', [$userId])[0]->name." Added New department: ".$dep_name;
        // Insert Data into Actions table
        DB::insert("INSERT INTO `actions`(`action_content`, `hospital_id`)  VALUES (?,?)",[$action_content,$userId]);
        }
        else {
        $msg = "New Department Isn\'t added Error !!!";
        }
        // Work on normal but there is error i don't understand it
        /* $allOtherdepartments = $this->get_other_departments();
        return view('orgAdmin.org_add_department',['all_other_dep' => $allOtherdepartments , "msg" , $msg]); */

        // All nest section to handle $msg
        $allOtherdepartments = $this->get_other_departments();
        $msgobj =  $allOtherdepartments[0];
        $msgobj->id = "message";
        $msgobj->name = $msg;
        array_push($allOtherdepartments,$msgobj);
        return view('orgAdmin.org_add_department',['all_other_dep' => $allOtherdepartments]);
    }
    public function show_delete_department()
    {
        $Organization_departments = $this->get_Organization_departments();
        // dd($Organization_departments);
        return view('orgAdmin.org_delete_department',['all_deps' => $Organization_departments]);
    }
    public function delete_department(Request $r)
    {
        $r->validate([
            'selected_department' => 'required',
        ],[],[
            'selected_department' => 'Department',
        ]);
        $dep_table_id = DB::select("select department_id from departments_hospitals where id = ?",[$r -> selected_department])[0]->department_id;
        $dep_name = DB::select("select name from departments where id = ?",[$dep_table_id])[0]->name;
        if(DB::delete('delete from departments_hospitals where id=?',[$r -> selected_department])) {
            $msg = "Department ( $dep_name ) Is deleted";

        $userId = auth('organization')->user()->id; // get user id
        // Prepare Action Content
        $action_content = "Hospital: ".DB::select('select name from organizations where id = ?', [$userId])[0]->name." delete department: ".$dep_name;
        // Insert Data into Actions table
        DB::insert("INSERT INTO `actions`(`action_content`, `hospital_id`)  VALUES (?,?)",[$action_content,$userId]);
        }
            
        else
            $msg = "This Department not founded Error !!!";
        $Organization_departments = $this->get_Organization_departments();
        return view('orgAdmin.org_delete_department',['msg' => $msg , 'all_deps' => $Organization_departments]);
    }
}
