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

class ArticleTpeController extends Controller
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
    
     
    public function show_add_articleType(){

        return view('superAdmin.admin_add_articleType');
    }
    public function add_articleType(Request $r){
        $r->validate([
            'type_name' => 'required|unique:article_types'
        ]);
        DB::insert('INSERT INTO `article_types`( `type_name`) VALUES (?)', [$r->type_name]);
        DB::table('recent_activities')->insert(['activity_content'=>"Add  New Article Type ( ".$r->type_name." )"]);
        return redirect()->back()->with('success',"New Article Type ( ".$r->type_name." ) is Added");
    }

   public function show_delete_articleType(){

        $all_article_types = DB::select('SELECT * FROM `article_types`');
        return view('superAdmin.admin_delete_articleType',['all_article_types'=>$all_article_types]);
}
    public function delete_articleType(Request $r){
        $r->validate([
            'article_types_id' =>'required'
        ]);
        $analysis_name = DB::select('SELECT `type_name` FROM `article_types` WHERE id = ?',[$r->article_types_id])[0]->type_name;
        DB::delete('DELETE FROM `article_types` where id = ?', [$r->article_types_id]);
        DB::table('recent_activities')->insert(['activity_content'=>"Delete Article Type ( ".$analysis_name." )"]);
        return redirect()->back()->with('success',"Article Type ($analysis_name) is Deleted");
    }


    
}
