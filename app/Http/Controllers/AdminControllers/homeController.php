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

class homeController extends FunctionController
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
    
     
     ///----------------- Request -----------------------//////
     public function user(){
        //--------------/ all count   -----------------///
        $user = DB::select('SELECT count(id) as count from users')[0];
        $hospital = DB::select('SELECT count(id) as count from organizations')[0];
        $labs = DB::select('SELECT count(id) as count from labs_centers')[0];
        $doctor=DB::select('SELECT COUNT(id) as count from doctors')[0];
        $article = DB::select('SELECT COUNT(id) as count from articles')[0];


        ///=-----------------equest  -----------------///
        $requests=$this->request();

        //---------------- recent activites -----------------//

        $recent_activitie=$this->recent_activitie();

        ///------------------notifications------------------//
        $actions=$this->selectNotifi();

        ///------------------Message------------------//
        $messages=$this->showMsg();

        return view('superAdmin.index',['user'=>$user,'hospital'=>$hospital,'labs'=>$labs,'doctor'=>$doctor,'article'=>$article, 'requests'=>$requests, 'recent_activitie'=>$recent_activitie, 'actions'=>$actions, 'messages'=>$messages]);
    }


    
}
