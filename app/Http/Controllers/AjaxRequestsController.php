<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class AjaxRequestsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showCorrespondingCities(Request $r) {
       
        if($r->ajax())
            {
                $category = $r-> governorate;
                if(DB::select("select id from governorates where id = ?",[$r -> governorate])){
                    $cities = DB::select('select id, city_name from cities where gov_id = ?',[$r -> governorate]);
                }
                return json_encode( $cities );
            }
    }

    public function getPatients(Request $r) {
        if($r->ajax())
            {
                $searchValue = $r -> SearchValue;
                $result = [];
                if(!empty($searchValue))
                {
                    // $result = DB::select("SELECT `id`, `name`, `national_id`  FROM `users` WHERE `national_id`  LIKE  :letter ",['letter'=> "%$searchValue%"]);
                    $result = DB::select("SELECT `id`, `name`, `national_id`, `gender`  FROM `users` WHERE `national_id`  LIKE  :letter1 OR `name` LIKE  :letter2 ",['letter1'=> "%$searchValue%" , 'letter2'=> "%$searchValue%"]);
                    // $result = array_merge($result,DB::select("SELECT `id`, `name`, `national_id`  FROM `users` WHERE `name`  LIKE  :letter ",['letter'=> "%$searchValue%"]));
                }
                return json_encode( $result );
            }
    }

    public function showCorrespondingCategory(Request $r) {
        if($r->ajax())
            {
                $result = [];
                // dump($r);
                if($r->category_id == 1){ // Blood Bank
                    $result = DB::select("SELECT `id`, `blood_type` AS name FROM `blood_types`");
                }
                else if($r->category_id == 2){ // Medical Analysis
                    $result = DB::select("SELECT `id`, `analysis_name` AS name FROM `medical_analysis`");
                }
                else if($r->category_id == 3){ // Medical Radiation Centers
                    $result = DB::select("SELECT `id`, `radiation_name` AS name FROM `medical_radiations`");
                }
                else if($r->category_id == 4){ // medical Examination
                    $result = DB::select("SELECT `id`, `name` FROM `departments`");
                }
                /* else if($r->category_id == 5){ // Intensive Care
                    
                }
                else if($r->category_id == 6){ // Incubators
                    $result = 6;
                } */
                
                return json_encode( $result );
            }

    }

}
