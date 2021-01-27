<?php
/* Change namespace from 
   namespace App\Http\Controllers;
To:namespace App\Http\Controllers\OrganizationControllers;
   add use App\Http\Controllers\Controller;
*/
namespace App\Http\Controllers\UserControllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
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
    public function index()
    {
        $gov = DB::select('select * from governorates');

        // $sql = DB::select('select logo,name,about_us from blood_banks limit 3');

        //partnershow
        $rhos = DB::table('organizations')->get()->random(1)[0];
        $rlab = DB::table('labs_centers')->where('lab_or_center','=','0')->get()->random(1)[0];
        $rcen = DB::table('labs_centers')->where('lab_or_center','=','1')->get()->random(1)[0];
        //articles
        $allArts=DB::select('select * from articles  order by id  desc limit 3');     

        return view('home',['governorates'=>$gov,'rhos'=>$rhos, 'rlab'=>$rlab, 'rcen'=>$rcen, 'articles'=>$allArts]);
    }



    
}
