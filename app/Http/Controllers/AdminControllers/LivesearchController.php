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

class LivesearchController extends Controller
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
    
     
    function index(){
        return view("superAdmin.live_search");
     }
 
     function action(Request $request) //will recieve ajax request for fetch data from hospital table
     {
         if($request->ajax()) //this will check if this method had recived any ajax request or not  then will execute ablock of code
         {
              $query=$request->get("query")  ;      //here will store value of query variable
              if($query !="")
                {
                $data=DB::table("organizations")->where("name","like","%". $query.'%')->orwhere("email","like","%". $query.'%')->get();
                  }
              else{
                  $data=DB::table("organizations")->orderBy("id","desc")->get();//this method will execute query and return data at php object
                 
                 }
                 $total_row=$data->count();//this method will return number of rows in query execution
                 $output="";
                 if($total_row > 0){
                     foreach($data as $row){
                    $output .='<tr><td>'.$row->name.'</td><td>'.$row->email.
                    '</td> <td><a href="hospitals/'.$row->id.'/delete" class="btn btn-danger btn-sm">delete</a></td></tr>';
                     }
                 }
  
                 else{
                     $output='<tr><td align="center" colspan="5">no data found</td></tr>';
                     
                 }
            $data=array(
                "table_data" => $output,
                 "total_data" =>$total_row
            );
               return json_encode($data) ;        //to send data to ajax request
         }
     }



    
}
