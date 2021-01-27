<?php
/* Change namespace from 
   namespace App\Http\Controllers;
To:namespace App\Http\Controllers\OrganizationControllers;
   add use App\Http\Controllers\Controller;
*/
namespace App\Http\Controllers\UserControllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Redirect;

class ArticleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function showAllArts(){

        $allArts=DB::select('SELECT * FROM articles WHERE approved = 1 ORDER BY id DESC LIMIT 12');
        $countart=count($allArts);
        return view ('allArticles',['articles'=>$allArts, 'countart'=>$countart]);
        
    }

    public function showArtsType(Request $request){

       $data = $request->only('articleTypes');
       $allArts=DB::select('SELECT * FROM articles WHERE type_id=? AND approved = 1 ORDER BY id DESC limit 12 ',[$data['articleTypes']]);
       $countart=count($allArts);
       return view ('allArticles',['articles'=>$allArts,'countart'=>$countart]);
    }

    public function showOneArt($id){
        /* $oneArt=DB::select('select articles.title,articles.content,articles.profile_image,
        articles.hospital_id,article_types.type_name, articles.type_id from articles inner join article_types
         on articles.type_id = article_types.id && articles.id=?',[$id]); */

         
        
        $oneArt = DB::select('SELECT articles.title, articles.content, articles.profile_image, articles.hospital_id, article_types.type_name, articles.type_id, organizations.name
        FROM articles join article_types ON articles.type_id = article_types.id
        join organizations ON organizations.id = articles.hospital_id WHERE articles.id=? AND approved = 1', [$id]);

        if(empty($oneArt))
            $oneArt = DB::select('SELECT articles.title,articles.content,articles.profile_image,
            articles.hospital_id,article_types.type_name, articles.type_id from articles inner join article_types
            on articles.type_id = article_types.id && articles.id=? WHERE approved = 1',[$id]);

         if(empty($oneArt))
            abort(404);
            
        $RelatedArt=DB::select('select * from articles where type_id=? && id != ?  limit 3',[$oneArt[0]->type_id, $id]);
        return view('oneArticle',['arts'=>$oneArt,'RelatedArts'=>$RelatedArt]);
    }



    
}
