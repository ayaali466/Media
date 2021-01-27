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

class RequestOrganizationController extends Controller
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
    public function show_request (){
        return view('orgAdmin.org_request');
    }

    public function send_request(Request $r) {
        $r->validate([
            'requestContent' => 'required|min:10|max:5000',
        ]);
        $userId = auth('organization')->user()->id; // get user id
        DB::insert('INSERT INTO `partner_requests` (`message_content`, `hospital_id`) values (?, ?)', [$r->requestContent, $userId]);
        return view('orgAdmin.org_request',['status' => "Your request is sended to Medical Care Website Stuff, and we will reply as soon as possible ):"]);
    }
}
