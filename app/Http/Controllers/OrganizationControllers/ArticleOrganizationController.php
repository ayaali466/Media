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

class ArticleOrganizationController extends Controller
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
    public function show_post_article (){
        $article_types = DB::select('SELECT * FROM `article_types`');
        return view('orgAdmin.org_article',['article_types' => $article_types]);
    }
    public function post_article (Request $r){
        
        $r->validate([
            'article_title' => 'required|min:4|max:100',
            'article_Image' => 'required|image|max:4096|mimes:jpeg,jpg,png',
            'articleContent' => 'required|min:100|max:5000',
            'article_type_id' => 'required',
        ]);
        $userId = auth('organization')->user()->id; // get user id
        // Save Profile Image To sever
        if ($r->hasFile('article_Image')) {
            $a_image = $r->file('article_Image');
            $image_name = $userId.time().'.'.$a_image->getClientOriginalExtension();
            $destinationPath = public_path('/user/img/articles');
            $a_image->move($destinationPath, $image_name);
        }
        DB::insert('INSERT INTO `articles`(`title`, `content`, `profile_image`, `hospital_id`, `type_id`) VALUES (?,?,?,?,?)',[$r->article_title,"$r->articleContent",$image_name,$userId,$r->article_type_id]);
        $article_types = DB::select('SELECT * FROM `article_types`');
        return view('orgAdmin.org_article',['status' => "Your Article is sended to Medical Care Website Stuff, and we will approved as soon as possible ):" ,'article_types' => $article_types]);
    }
}
