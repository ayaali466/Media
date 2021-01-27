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

class SearchController extends Controller
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
    
    public function AllCards(Request $request){
        $allSelect=$request->all();
         if($allSelect['department']==4){  
        $cards=DB:: select('select * from organizations where city_id=? XOR gov_id =?',[$allSelect['city'] , $allSelect['governorate']]);
         
          }
          elseif($allSelect['department']==1){
            $cards=DB:: select('select* from blood_banks where city_id=? XOR gov_id =?',[$allSelect['city'] , $allSelect['governorate']]);
            
          }
          elseif($allSelect['department']==2){  
            $cards=DB:: select('select * from labs_centers where city_id=? XOR gov_id=? &&lab_or_center=2 ',[$allSelect['city'] , $allSelect['governorate']]);
            
          }

          elseif($allSelect['department']==3){  
            $cards=DB:: select('select * from labs_centers where city_id=? XOR gov_id=? &&lab_or_center=1 ',[$allSelect['city'] , $allSelect['governorate']]);
             
          }


          elseif($allSelect['department']==5){ 
          $cards=DB::table('organizations')
          ->join('intensive_care','organizations.id','=','intensive_care.hospital_id')
          ->where('intensive_care.Available_rooms','<>',0)
          ->Where(function($query)use($request,$allSelect) {
            
              $query->where('organizations.city_id','=', $allSelect['city']  )
                    ->orwhere('organizations.gov_id','=', $allSelect['governorate']);})
          ->select('*')
          ->Get();
           
        }

        elseif($allSelect['department']==6){ 
            $cards=DB::table('organizations')
            ->join('incubators','organizations.id','=','incubators.hospital_id')
            ->where('incubators.Available_units','<>',0)
            ->Where(function($query)use($request,$allSelect) {
              
                $query->where('organizations.city_id','=', $allSelect['city']  )
                      ->orwhere('organizations.gov_id','=', $allSelect['governorate']);})
            ->select('*')
            ->Get();
             
          }
          if($allSelect['department']==1)
          {
            $page="bloodPartner";
            $photo="blood_bank";
          }
          elseif($allSelect['department']==2)
          {
            $page="labPartner";
            $photo="labs";
          }
          elseif($allSelect['department']==3)
          {
            $page="centerPartner";
            $photo="centers";
          }
          else
          {
            $page="hospitalPartner";
            $photo="hospitals";
          }
          
          return view('AllCards2',['cards'=>$cards, 'allSelect'=>$allSelect, 'page'=>$page, 'photo'=>$photo]);
    } 

    public function AllCardsinside(Request $request){
      // dump($request->all());
      if($request->category == 1){ // Blood Bank
        $result1 = DB::select("SELECT blood_banks.* FROM `blood_banks` 
        INNER JOIN bloods_blood_banks
        ON blood_banks.id = bloods_blood_banks.blood_bank_id
        WHERE `city_id` = ? AND `blood_type_id` = ? AND `number_of_cases` > 0 ",[$request->city, $request->type]); // first With City
        // dump($result1);

        $result2 = DB::select("SELECT blood_banks.* FROM `blood_banks` 
        INNER JOIN bloods_blood_banks
        ON blood_banks.id = bloods_blood_banks.blood_bank_id
        WHERE `gov_id` = ? AND `city_id` != ? AND `blood_type_id` = ?  AND `number_of_cases` > 0 ",[$request->governorate, $request->city, $request->type]); // second With Governorate but not Equal City
        // dump($result2);

        $result3 = DB::select("SELECT blood_banks.* FROM `blood_banks` 
        INNER JOIN bloods_blood_banks
        ON blood_banks.id = bloods_blood_banks.blood_bank_id
        WHERE `gov_id` != ? AND `blood_type_id` = ?  AND `number_of_cases` > 0 ",[$request->governorate, $request->type]); // Third Without Governorate but not equal Governorate
        // dump($result3);

        $result = array_merge($result1,$result2,$result3);
        // dd($result);
      }
      else if($request->category == 2){ // Medical Analysis
        // dump($request->all());
        $result1 = DB::select("SELECT labs_centers.* FROM `labs_centers` 
        INNER JOIN labscenters_medicalanalysis
        ON labs_centers.id = labscenters_medicalanalysis.lab_center_id  
        WHERE `city_id` = ? AND `medical_analysis_id` = ?",[$request->city, $request->type]); // first With City
        // dump($result1);

        $result2 = DB::select("SELECT labs_centers.* FROM `labs_centers` 
        INNER JOIN labscenters_medicalanalysis
        ON labs_centers.id = labscenters_medicalanalysis.lab_center_id
        WHERE `gov_id` = ? AND `city_id` != ? AND `medical_analysis_id` = ?",[$request->governorate, $request->city, $request->type]); // second With Governorate but not Equal City
        // dump($result2);

        $result3 = DB::select("SELECT labs_centers.* FROM `labs_centers` 
        INNER JOIN labscenters_medicalanalysis
        ON labs_centers.id = labscenters_medicalanalysis.lab_center_id
        WHERE `gov_id` != ? AND `medical_analysis_id` = ?",[$request->governorate, $request->type]); // Third Without Governorate but not equal Governorate
        // dump($result3);

        $result = array_merge($result1,$result2,$result3);
        // dd($result);

      }
      else if($request->category == 3){ // Medical Radiation Centers
        // dump($request->all());
        $result1 = DB::select("SELECT labs_centers.* FROM `labs_centers` 
        INNER JOIN labscenters_medicalradiations
        ON labs_centers.id = labscenters_medicalradiations.lab_center_id  
        WHERE `city_id` = ? AND `medical_radiation_id` = ?",[$request->city, $request->type]); // first With City
        // dump($result1);

        $result2 = DB::select("SELECT labs_centers.* FROM `labs_centers` 
        INNER JOIN labscenters_medicalradiations
        ON labs_centers.id = labscenters_medicalradiations.lab_center_id
        WHERE `gov_id` = ? AND `city_id` != ? AND `medical_radiation_id` = ?",[$request->governorate, $request->city, $request->type]); // second With Governorate but not Equal City
        // dump($result2);

        $result3 = DB::select("SELECT labs_centers.* FROM `labs_centers` 
        INNER JOIN labscenters_medicalradiations
        ON labs_centers.id = labscenters_medicalradiations.lab_center_id
        WHERE `gov_id` != ? AND `medical_radiation_id` = ?",[$request->governorate, $request->type]); // Third Without Governorate but not equal Governorate
        // dump($result3);
        
        $result = array_merge($result1,$result2,$result3);
        // dd($result);
      }
      else if($request->category == 4){ // medical Examination
        // dump($request->all());
        $result1 = DB::select("SELECT organizations.* FROM `organizations` 
        INNER JOIN departments_hospitals
        ON organizations.id = departments_hospitals.hospital_id  
        WHERE `city_id` = ? AND `department_id` = ?",[$request->city, $request->type]); // first With City
        // dump($result1);

        $result2 = DB::select("SELECT organizations.* FROM `organizations` 
        INNER JOIN departments_hospitals
        ON organizations.id = departments_hospitals.hospital_id
        WHERE `gov_id` = ? AND `city_id` != ? AND `department_id` = ?",[$request->governorate, $request->city, $request->type]); // second With Governorate but not Equal City
        // dump($result2);

        $result3 = DB::select("SELECT organizations.* FROM `organizations` 
        INNER JOIN departments_hospitals
        ON organizations.id = departments_hospitals.hospital_id
        WHERE `gov_id` != ? AND `department_id` = ?",[$request->governorate, $request->type]); // Third Without Governorate but not equal Governorate
        // dump($result3);
        
        $result = array_merge($result1,$result2,$result3);
        // dd($result);
      }
      else if($request->category == 5){ // Intensive Care
        // dump($request->all());
        $result1 = DB::select("SELECT organizations.* FROM `organizations` 
        INNER JOIN intensive_care
        ON organizations.id = intensive_care.hospital_id  
        WHERE `city_id` = ? AND `Available_rooms` > 0",[$request->city]); // first With City
        // dump($result1);

        $result2 = DB::select("SELECT organizations.* FROM `organizations` 
        INNER JOIN intensive_care
        ON organizations.id = intensive_care.hospital_id
        WHERE `gov_id` = ? AND `city_id` != ? AND `Available_rooms` > 0",[$request->governorate, $request->city]); // second With Governorate but not Equal City
        // dump($result2);

        $result3 = DB::select("SELECT organizations.* FROM `organizations` 
        INNER JOIN intensive_care
        ON organizations.id = intensive_care.hospital_id
        WHERE `gov_id` != ? AND `Available_rooms` > 0",[$request->governorate]); // Third Without Governorate but not equal Governorate
        // dump($result3);
        
        $result = array_merge($result1,$result2,$result3);
        // dd($result);
      }
      else if($request->category == 6){ // Incubators
        // dump($request->all());
        $result1 = DB::select("SELECT organizations.* FROM `organizations` 
        INNER JOIN incubators
        ON organizations.id = incubators.hospital_id  
        WHERE `city_id` = ? AND `Available_units` > 0",[$request->city]); // first With City
        // dump($result1);

        $result2 = DB::select("SELECT organizations.* FROM `organizations` 
        INNER JOIN incubators
        ON organizations.id = incubators.hospital_id
        WHERE `gov_id` = ? AND `city_id` != ? AND `Available_units` > 0",[$request->governorate, $request->city]); // second With Governorate but not Equal City
        // dump($result2);

        $result3 = DB::select("SELECT organizations.* FROM `organizations` 
        INNER JOIN incubators
        ON organizations.id = incubators.hospital_id
        WHERE `gov_id` != ? AND `Available_units` > 0",[$request->governorate]); // Third Without Governorate but not equal Governorate
        // dump($result3);
        
        $result = array_merge($result1,$result2,$result3);
        // dd($result);
      }
  /* 
        $allSelect=$request->all();
        if($allSelect['department']==4){
          $cards=DB:: select('select * from organizations where city_id=? XOR gov_id =?',[$allSelect['city'] , $allSelect['governorate']]);
        }
        elseif($allSelect['department']==1){
          $cards=DB:: select('select * from blood_banks where city_id=? XOR gov_id =?',[$allSelect['city'] , $allSelect['governorate']]);
        }
        elseif($allSelect['department']==2){ 
          $cards=DB:: select('select * from labs_centers where city_id=? XOR gov_id=? &&lab_or_center=1 ',[$allSelect['city'] , $allSelect['governorate']]); 
        }

        elseif($allSelect['department']==3){ 
          $cards=DB:: select('select * from labs_centers where city_id=? XOR gov_id=? &&lab_or_center=0 ',[$allSelect['city'] , $allSelect['governorate']]);
        }


        elseif($allSelect['department']==5){ 
          $cards=DB::table('organizations')
          ->join('intensive_care','organizations.id','=','intensive_care.hospital_id')
          ->where('intensive_care.Available_rooms','<>',0)
          ->Where(function($query)use($request,$allSelect) {
            
              $query->where('organizations.city_id','=', $allSelect['city']  )
                    ->orwhere('organizations.gov_id','=', $allSelect['governorate']);})
          ->select('*')
          ->Get();
        }

        elseif($allSelect['department']==6){ 
          $cards=DB::table('organizations')
          ->join('incubators','organizations.id','=','incubators.hospital_id')
          ->where('incubators.Available_units','<>',0)
          ->Where(function($query)use($request,$allSelect) {
            
              $query->where('organizations.city_id','=', $allSelect['city']  )
                    ->orwhere('organizations.gov_id','=', $allSelect['governorate']);})
          ->select('*')
          ->Get();
        } 
*/
        /* foreach($result as $one){
          dump($one->id);
        } */
        $cards = $result;
        $allSelect=$request->all();
        if($allSelect['category']==1)
        {
          $page="bloodPartner";
        }
        elseif($allSelect['category']==2)
        {
          $page="labPartner";
        }
        elseif($allSelect['category']==3)
        {
          $page="centerPartner";
        }
        else
        {
          $page="hospitalPartner";
        }
        $gov = DB::select('select * from governorates');

        
        return view('AllCards2',['cards'=>$cards, 'allSelect'=>$allSelect, 'page'=>$page,'governorates'=>$gov]);
    } 
  
    function showdoc($id){
         $doc = DB::table('doctors')
          ->Join('departments_hospitals', 'departments_hospitals.department_id', '=', 'doctors.department_id')
            ->where('departments_hospitals.hospital_id','=',$id)
            
            ->select('doctors.*')
            ->get(); 
            

        // $doc = DB::select('SELECT doctors.*,departments.name AS dep_name , organizations.name As hos_name
        // FROM doctors join departments_hospitals 
        // ON departments_hospitals.id = doctors.department_id
        // join departments 
        // ON departments.id = departments_hospitals.department_id
        // join organizations 
        // ON organizations.id = departments_hospitals.hospital_id
        // WHERE doctors.id = ?', [$id]); 

        // $doc = DB::select('SELECT doctors.id, doctors.name, doctors.title, doctors.fees, doctors.photo, departments.name as depName FROM doctors INNER JOIN departments_hospitals ON doctors.department_id = departments_hospitals.id INNER JOIN departments ON departments.id = departments_hospitals.department_id WHERE departments_hospitals.hospital_id = ?
        // ',[$hos_id]); 

        // $doc = DB::select('SELECT doctors.* , departments.name as depName FROM doctors INNER JOIN departments_hospitals ON doctors.department_id = departments_hospitals.id INNER JOIN departments ON departments.id = departments_hospitals.department_id');
        if(empty($doc))
        abort(404);
    
        return view('doctor',['doc'=> $doc]);
    }

    
}
