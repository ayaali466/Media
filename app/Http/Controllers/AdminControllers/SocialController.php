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

class SocialController extends Controller
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
    
     
    public function facebook(){

        $facebook = DB::select('SELECT * FROM `website_social`');
        return view('superAdmin.editfacebook',['facebook'=>$facebook]);
    }
    public function updatefacebook(Request $r ){
        $r->validate([
            'facebook'=>'url|nullable'
        ]);
        $facebook = $r->input('facebook');
        $update = DB::update('update website_social set facebook=?',[$facebook]);
        DB::table('recent_activities')->insert(['activity_content'=>"Update Facebook link ($facebook)"]);
        return redirect()->back()->with('success',"Facebook link ($facebook) is Updated");
    }

   public function twitter(){

        $twitter = DB::select('SELECT * FROM `website_social`');
        return view('superAdmin.edittwitter',['twitter'=>$twitter]);
    }
    public function updatetwitter(Request $r ){
        $r->validate([
            'twitter'=>'url|nullable'
        ]);
        $twitter = $r->input('twitter');
        $update = DB::update('update website_social set twitter=?',[$twitter]);
        DB::table('recent_activities')->insert(['activity_content'=>"Update Twitter link ($twitter)"]);
        return redirect()->back()->with('success',"Twitter link ($twitter) is Updated");
    }

    public function googleplus(){

        $googleplus = DB::select('SELECT * FROM `website_social`');
        return view('superAdmin.editgoogleplus',['googleplus'=>$googleplus,]);
    }
    public function updategoogleplus(Request $r ){
        $r->validate([
            'googleplus'=>'url|nullable'
        ]);
        $googleplus = $r->input('googleplus');
        $update = DB::update('update website_social set google_plus=?',[$googleplus]);
        DB::table('recent_activities')->insert(['activity_content'=>"Update Google Plus link ($googleplus)"]);
        return redirect()->back()->with('success',"Google Plus link ($googleplus) is Updated");
    }

    public function youtube(){

        $youtube = DB::select('SELECT * FROM `website_social`');
        return view('superAdmin.edityoutube',['youtube'=>$youtube]);
    }
    public function updateyoutube(Request $r ){
        $r->validate([
            'youtube'=>'url|nullable'
        ]);
        $youtube = $r->input('youtube');
        $update = DB::update('update website_social set youtube=?',[$youtube]);
        DB::table('recent_activities')->insert(['activity_content'=>"Update Youtube link ($youtube)"]);
        return redirect()->back()->with('success',"Youtube link ($youtube) is Updated");
    }


    
}
