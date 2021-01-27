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
use Illuminate\Support\Facades\Hash;

class RequestController extends FunctionController
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
    
     
     //-----------------------add hosbital-----------------//
    public function showAdd(){
        return view('superAdmin.addHospital');
    }
    public function Add(Request $r){
     
     $r->validate([
         'name' => 'required|min:4',
         'email'=>'required|email|unique:organizations',
         'password'=>'required|min:8|max:20'
     ]);
    //  dd($r->all());
     $email_founded = DB::select('select count(*)  as count from organizations where email = ?', [$r->email])[0]->count;
     if($email_founded != 0){
     return redirect()->back()->withErrors(["The email ($r->email) has already been taken"]);
                   }
    DB::insert("INSERT INTO `social_links`(`youtube`) VALUES (?)", [NULL]);
    $social_id = DB::select('SELECT * FROM `social_links` ORDER BY `social_links`.`id` DESC limit 1')[0]->id;
     $data=$r->except(['_token']);
     $data['password']= Hash::make($data['password']);
    //  bcrypt($data['password']);
     $row=DB::table('organizations')->insert(['email'=>$data['email'],'password'=>$data['password'],'name'=>$data['name'],'social_link_id' =>$social_id]);
     if($row){   
         DB::table('recent_activities')->insert(['activity_content'=>"Add Hospital (".$data['email'].")"]);
      }
     return redirect()->back()->with('success',"New Hospital ($r->name) is added");
    }


    ///------------------------request-------------------//
    public function showrequest(){
        $requests=$this->request();
        return view('superAdmin.requests',['requests'=>$requests]);
    }

    public function allow($id){

        DB::table('partner_requests')
        ->where('id', '=', $id)
        ->update(['approve' => 1]);
        return back();
    }

    public function refuse($id){
        DB::table('partner_requests')
        ->where('id', '=', $id)
        ->update(['approve' => 0]);
        
        return back();
    }

    public function showactivities(){
        $recent_activitie=$this->recent_activitie();

        return view('superAdmin.recent_activitie',['recent_activitie'=>$recent_activitie]);
    }
    public function delactivities($id){

        DB::table('recent_activities')
        ->where('id', '=', $id)->delete();
        
        return redirect()->back();
    }

    ///----------notification------------//
    public function getNotifi(){
        $actions=$this->selectNotifi();
        return view('superAdmin.notification',['actions'=>$actions]);
    }

    public function editseen($id){

        $seenStat=DB::select('select seen from actions where id=?',[$id])[0]->seen;
        $newStat=DB::update('update actions set seen=? where id=?',[!$seenStat,$id]);
        return redirect()->back();
    }

    public function delNotifi($id){
        
        $delNotifi=DB::delete('delete from actions where id=?',[$id]);
        return redirect()->back();
    }

    /////------------message-----------------////

    public function getMsg(){
        $messages=$this->showMsg();
          return view('superAdmin.messages',['messages'=>$messages]);
    }
    
    public function editMsg($id){
        $seenMsg=DB::select('select seen from user_messages where id=?',[$id]);
        $newMsgStat=DB::update('update user_messages set seen=? where id=?',[!$seenMsg[0]->seen,$id]);
          return redirect()->back();
    }

    public function delMsg($id){
        $deletedMsg=DB::delete('delete from user_messages where id=?',[$id]);
           return redirect()->back();
    }


    
}
