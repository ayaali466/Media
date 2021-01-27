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

class ArticleController extends Controller
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
    public function show_post_article (){
        $article_types = DB::select('SELECT * FROM `article_types`');
        return view('superAdmin.admin_article',['article_types' => $article_types]);
    }
    public function post_article (Request $r){
        
        $r->validate([
            'article_title' => 'required|min:4|max:100',
            'article_Image' => 'required|image|max:4096|mimes:jpeg,jpg,png',
            'articleContent' => 'required|min:100|max:5000',
            'article_type_id' => 'required',
        ]);

        // Save Profile Image To sever
        if ($r->hasFile('article_Image')) {
            $a_image = $r->file('article_Image');
            $image_name = "article".time().'.'.$a_image->getClientOriginalExtension();
            $destinationPath = public_path('/user/img/articles');
            $a_image->move($destinationPath, $image_name);
        }
        DB::insert('INSERT INTO `articles`(`title`, `content`, `profile_image`, `type_id`,`approved`) VALUES (?,?,?,?,?)',[$r->article_title,"$r->articleContent",$image_name,$r->article_type_id,1]);
        $article_types = DB::select('SELECT * FROM `article_types`');
        DB::table('recent_activities')->insert(['activity_content'=>"Add  New Article Name ( ".$r->article_title." )"]);

        return view('superAdmin.admin_article',['status' => "The Article is Published now" ,'article_types' => $article_types]);
    }
}
