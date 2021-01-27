<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

// User
//-----------------------------------------------------------------------------------------------------//
// --------------------------------------------- Home Page --------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
Route::get('/','UserControllers\IndexController@index')->name('homePage');
Route::get('/home','UserControllers\IndexController@index')->name('homePage2');

//-----------------------------------------------------------------------------------------------------//
// ---------------------------------------------- Hospital --------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
Route::get('/hospitalPage','UserControllers\hospitalController@showrand')->name('hos_Page');
Route::get('/hospitalPartner/{id}','UserControllers\hospitalController@show');

//-----------------------------------------------------------------------------------------------------//
// --------------------------------------------- Laboratory -------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
Route::get('/labPage', 'UserControllers\Lab_CenterController@show_random_laboratory')->name('lab_Page');
Route::get('/labPartner/{id}', 'UserControllers\Lab_CenterController@show_laboratory');
//-----------------------------------------------------------------------------------------------------//
// ----------------------------------------------- Center ---------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
Route::get('/centerPage', 'UserControllers\Lab_CenterController@show_random_center')->name('center_Page');
Route::get('/centerPartner/{id}', 'UserControllers\Lab_CenterController@show_center');
//-----------------------------------------------------------------------------------------------------//
// --------------------------------------------- Blood Bank -------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
Route::get('/bloodBankPage', 'UserControllers\BloodBankController@showrand')->name('BB_Page');
Route::get('/bloodPartner/{id}', 'UserControllers\BloodBankController@show');
//-----------------------------------------------------------------------------------------------------//
// -------------------------------------------- All Partners ------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
Route::get('/allParts', 'UserControllers\AllPartnersController@show')->name('all_partners');
// Route::get('/allParts2/{count}', 'UserControllers\AllPartnersController@showall'); //Not Used and function not handled
//-----------------------------------------------------------------------------------------------------//
// -------------------------------------------- Uers Profile ------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
Route::resource('/profile', 'UserProfileController');
Route::get("/profile/{id}/edit","UserProfileController@edit")->name('pprofile.edit');
Route::PUT("/profile/{id}/update","UserProfileController@update")->name('pprofile.update');
//-----------------------------------------------------------------------------------------------------//
// ------------------------------------- Uers Profile Updated -----------------------------------------//
//-----------------------------------------------------------------------------------------------------//
Route::get('/userProfile','UserControllers\UserProfileUpdatedController@index')->name('userProfile.index');
Route::get('/delete_treatment/{id}','UserControllers\UserProfileUpdatedController@delete_treatment')->name('userProfile.delete_treatment');
Route::get('/delete_disease/{id}','UserControllers\UserProfileUpdatedController@delete_disease')->name('userProfile.delete_disease');
Route::get('/delete_report/{id}','UserControllers\UserProfileUpdatedController@delete_report')->name('userProfile.delete_report');
Route::post('/update_photo','UserControllers\UserProfileUpdatedController@update_user_photo')->name('userProfile.update_user_photo');

Route::post('/add_disease','UserControllers\UserProfileUpdatedController@add_disease')->name('userProfile.add_disease');
Route::post('/add_treatment','UserControllers\UserProfileUpdatedController@add_treatment')->name('userProfile.add_treatment');
Route::post('/add_report','UserControllers\UserProfileUpdatedController@add_report')->name('userProfile.add_report');

Route::post('/edit','UserControllers\UserProfileUpdatedController@edit_profile')->name('userProfile.edit_profile');

route::post('/delete_account','UserControllers\UserProfileUpdatedController@delete_profile')->name('userProfile.delete_profile');

//-----------------------------------------------------------------------------------------------------//
// ----------------------------------------------- Message --------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
Route::post('message','UserControllers\MessageController@store_message')->name('store.message');
//-----------------------------------------------------------------------------------------------------//
// ----------------------------------------------- Article --------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
Route::get('/allArts','UserControllers\ArticleController@showAllArts')->name("all_articles");
Route::post('/allArts','UserControllers\ArticleController@showArtsType');
Route::get('/oneArticle/{id}','UserControllers\ArticleController@showOneArt');
//-----------------------------------------------------------------------------------------------------//
// ----------------------------------------------- Doctor ---------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
Route::get('/doc/{id}','UserControllers\SearchController@showdoc');
Route::get("/dprofile/{id}","UserProfileController@showdprofile");
//-----------------------------------------------------------------------------------------------------//
// ----------------------------------------------- Search ---------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
Route::post('/AllCards','UserControllers\SearchController@AllCards');
Route::post('/Cards','UserControllers\SearchController@AllCardsinside')->name("Home_seach");






// user
// Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/HomePage',function (){return view('index');})->name('homePage');
Route::get('/profile',function (){return view('profile');})->name('userProfile');
Route::get('/userLoginTest',function (){return view('signinUp');})->name('userLoginTest');

// ---------------------------------------------------------------------------------------------------------------------------------------------------------- //


// Organization Admin routes

// show the organization admin login form
Route::get('/org_admin/login','Auth\OrganizationLoginController@showOrganizationLoginForm')->name('show_oa_login');
// Authenticate the organization Admin
Route::post('/org_admin/login', 'Auth\OrganizationLoginController@authenticate_o_admin_Login')->name('o_authenticate_login');
// Logout The Organization Admin
Route::post('/org_admin/loout','Auth\OrganizationLoginController@o_admin_logout')->name('oa_logout');
// show the organization admin dashboard
Route::get('/org_admin','OrganizationControllers\OrganizationController@index')->name('o_dashboard');

//-----------------------------------------------------------------------------------------------------//
// ---------------------------------------- Search About Patient --------------------------------------//
//-----------------------------------------------------------------------------------------------------//
// Show send Request
Route::get('/org_admin/search_patient', 'OrganizationControllers\OrganizationController@show_search_patient')->name('showsearchPatient');
// Invoke send Request
Route::get('/org_admin/search_patient/{id}', 'OrganizationControllers\OrganizationController@search_patient')->name('searchPatient');

//-----------------------------------------------------------------------------------------------------//
// ---------------------------------------------- Request ---------------------------------------------//
//-----------------------------------------------------------------------------------------------------//

// Show send Request
Route::get('/org_admin/request', 'OrganizationControllers\RequestOrganizationController@show_request')->name('show_request');
// Invoke send Request
Route::post('/org_admin/request', 'OrganizationControllers\RequestOrganizationController@send_request')->name('send_request');

//-----------------------------------------------------------------------------------------------------//
// ---------------------------------------------- Article ---------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
// Show send Request
Route::get('/org_admin/article', 'OrganizationControllers\ArticleOrganizationController@show_post_article')->name('show_article');
// Invoke send Request
Route::post('/org_admin/article', 'OrganizationControllers\ArticleOrganizationController@post_article')->name('post_article');



//-----------------------------------------------------------------------------------------------------//
// -------------------------------------------- Departments -------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
//add
// Show Add
Route::get('/org_admin/add_dep', 'OrganizationControllers\DepartmentOrganizationController@show_add_department')->name('showaddDepartment');
// Invoke Add
Route::post('/org_admin/add_dep', 'OrganizationControllers\DepartmentOrganizationController@add_department')->name('addDepartment');
//delete
// Show Delete
Route::get('/org_admin/del_dep', 'OrganizationControllers\DepartmentOrganizationController@show_delete_department')->name('showdeleteDepartment');
//Invoke Delete
Route::post('/org_admin/del_dep', 'OrganizationControllers\DepartmentOrganizationController@delete_department')->name('deleteDepartment');

//-----------------------------------------------------------------------------------------------------//
// -------------------------------------------- Blood Bank --------------------------------------------//
//-----------------------------------------------------------------------------------------------------//

//add
Route::get('/org_admin/add_BB', 'OrganizationControllers\BloodBankOrganizationController@show_add_bloodBank')->name('showaddBloodBank');
Route::post('/org_admin/add_BB', 'OrganizationControllers\BloodBankOrganizationController@add_bloodBank')->name('addBloodBank');

//delete
Route::get('/org_admin/del_BB', 'OrganizationControllers\BloodBankOrganizationController@show_delete_bloodBank')->name('showdeleteBloodBank');
Route::post('/org_admin/del_BB', 'OrganizationControllers\BloodBankOrganizationController@delete_bloodBank')->name('deleteBloodBank');

//edit
Route::get('/org_admin/edit_BB', 'OrganizationControllers\BloodBankOrganizationController@show_select_to_update_bloodBank')->name('showSelectToeditBloodBank');
Route::post('/org_admin/selectedToedit_BB', 'OrganizationControllers\BloodBankOrganizationController@show_update_bloodBank')->name('showeditBloodBank');
Route::post('/org_admin/edit_BBB', 'OrganizationControllers\BloodBankOrganizationController@update_bloodBank')->name('editBloodBank');
Route::get('/org_admin/selectedToedit_BB', 'OrganizationControllers\BloodBankOrganizationController@redirect_to_show_update_bloodBank')->name('redirect_to_show_update_bloodBank');
Route::get('/org_admin/edit_BBB', 'OrganizationControllers\BloodBankOrganizationController@redirect_to_show_select_to_update_bloodBank')->name('redirect_to_showSelectToeditBloodBank');

// Update Profile
Route::get('/org_admin/edit_BB_profileImage/{id}','OrganizationControllers\BloodBankOrganizationController@show_edit_BB_Profile_image')->name('showeditBBProfileImage');
Route::post('/org_admin/edit_BB_profileImage','OrganizationControllers\BloodBankOrganizationController@edit_BB_Profile_image')->name('editBBProfileImage');
// edit Logo Image
Route::get('/org_admin/edit_BB_logoImage/{id}','OrganizationControllers\BloodBankOrganizationController@show_edit_BB_logo_image')->name('showeditBBLogoImage');
Route::post('/org_admin/edit_BB_logoImage','OrganizationControllers\BloodBankOrganizationController@edit_BB_logo_image')->name('editBBLogoImage');
//-----------------------------------------------------------------------------------------------------//
// -------------------------------------------- Laboratory --------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
//add
Route::get('/org_admin/add_lab', 'OrganizationControllers\LaboratoryOrganizationController@show_add_laboratory')->name('showaddLaboratory');
Route::post('/org_admin/add_lab', 'OrganizationControllers\LaboratoryOrganizationController@add_laboratory')->name('addLaboratory');

//delete
Route::get('/org_admin/del_lab', 'OrganizationControllers\LaboratoryOrganizationController@show_delete_laboratory')->name('showdeleteLaboratory');
Route::post('/org_admin/del_lab', 'OrganizationControllers\LaboratoryOrganizationController@delete_laboratory')->name('deleteLaboratory');

//edit
Route::get('/org_admin/edit_lab', 'OrganizationControllers\LaboratoryOrganizationController@show_select_to_update_laboratory')->name('showSelectToeditLaboratory');
Route::post('/org_admin/selectedToedit_lab', 'OrganizationControllers\LaboratoryOrganizationController@show_update_laboratory')->name('showeditLaboratory');
Route::post('/org_admin/edit_lab', 'OrganizationControllers\LaboratoryOrganizationController@update_laboratory')->name('editLaboratory');
Route::get('/org_admin/selectedToedit_laboratory', 'OrganizationControllers\LaboratoryOrganizationController@redirect_to_show_update_laboratory')->name('redirect_to_show_update_laboratory');
Route::get('/org_admin/edit_laboratory', 'OrganizationControllers\LaboratoryOrganizationController@redirect_to_show_select_to_update_laboratory')->name('redirect_to_showSelectToeditlaboratory');
// Analysis
//add
Route::get('/org_admin/edit_laboratory_add_analysis', 'OrganizationControllers\LaboratoryOrganizationController@show_select_lab_to_add_analysis')->name('showSelectLabToAddAnalysis');
Route::post('/org_admin/edit_laboratory_add_analysis', 'OrganizationControllers\LaboratoryOrganizationController@show_add_medical_analysis')->name('showAddAnalysis');
Route::post('/org_admin/edit_laboratory_add_analysis_do', 'OrganizationControllers\LaboratoryOrganizationController@add_medical_analysis')->name('addAnalysis');
//delete
Route::get('/org_admin/edit_laboratory_del_analysis', 'OrganizationControllers\LaboratoryOrganizationController@show_select_lab_to_delete_analysis')->name('showSelectLabToDeleteAnalysis');
Route::post('/org_admin/edit_laboratory_del_analysis', 'OrganizationControllers\LaboratoryOrganizationController@show_delete_medical_analysis')->name('showDeleteAnalysis');
Route::post('/org_admin/edit_laboratory_del_analysis_do', 'OrganizationControllers\LaboratoryOrganizationController@delete_medical_analysis')->name('deleteAnalysis');
// Update Profile
Route::get('/org_admin/edit_laboratory_profileImage/{id}','OrganizationControllers\LaboratoryOrganizationController@show_edit_lab_Profile_image')->name('showeditLabProfileImage');
Route::post('/org_admin/edit_laboratory_profileImage','OrganizationControllers\LaboratoryOrganizationController@edit_lab_Profile_image')->name('editLabProfileImage');
// edit Logo Image
Route::get('/org_admin/edit_laboratory_logoImage/{id}','OrganizationControllers\LaboratoryOrganizationController@show_edit_lab_logo_image')->name('showeditLabLogoImage');
Route::post('/org_admin/edit_laboratory_logoImage','OrganizationControllers\LaboratoryOrganizationController@edit_lab_logo_image')->name('editLabLogoImage');


//-----------------------------------------------------------------------------------------------------//
// ---------------------------------------------- Center ----------------------------------------------//
//-----------------------------------------------------------------------------------------------------//

//add
Route::get('/org_admin/add_center', 'OrganizationControllers\CenterOrganizationController@show_add_center')->name('showaddCenter');
Route::post('/org_admin/add_center', 'OrganizationControllers\CenterOrganizationController@add_center')->name('addCenter');

//delete
Route::get('/org_admin/del_center', 'OrganizationControllers\CenterOrganizationController@show_delete_center')->name('showdeleteCenter');
Route::post('/org_admin/del_center', 'OrganizationControllers\CenterOrganizationController@delete_center')->name('deleteCenter');

//edit
Route::get('/org_admin/edit_center', 'OrganizationControllers\CenterOrganizationController@show_select_to_update_center')->name('showSelectToeditCenter');
Route::post('/org_admin/selectedToedit_center', 'OrganizationControllers\CenterOrganizationController@show_update_center')->name('showeditCenter');
Route::post('/org_admin/edit_center', 'OrganizationControllers\CenterOrganizationController@update_center')->name('editCenter');
Route::get('/org_admin/selectedToedit_centers', 'OrganizationControllers\CenterOrganizationController@redirect_to_show_update_center')->name('redirect_to_show_update_center');
Route::get('/org_admin/edit_centers', 'OrganizationControllers\CenterOrganizationController@redirect_to_show_select_to_update_center')->name('redirect_to_showSelectToeditcenter');

// Radition
//add
Route::get('/org_admin/edit_center_add_radition', 'OrganizationControllers\CenterOrganizationController@show_select_lab_to_add_radition')->name('showSelectLabToAddRadition');
Route::post('/org_admin/edit_center_add_radition', 'OrganizationControllers\CenterOrganizationController@show_add_medical_radition')->name('showRadition');
Route::post('/org_admin/edit_center_add_radition_do', 'OrganizationControllers\CenterOrganizationController@add_medical_radition')->name('addRadition');
//delete
Route::get('/org_admin/edit_center_del_radition', 'OrganizationControllers\CenterOrganizationController@show_select_center_to_delete_radition')->name('showSelectLabToDeleteRadition');
Route::post('/org_admin/edit_center_del_radition', 'OrganizationControllers\CenterOrganizationController@show_delete_medical_radition')->name('showDeleteRadition');
Route::post('/org_admin/edit_center_del_radition_do', 'OrganizationControllers\CenterOrganizationController@delete_medical_radition')->name('deleteRadition');

// Update Profile
Route::get('/org_admin/edit_center_profileImage/{id}','OrganizationControllers\CenterOrganizationController@show_edit_center_Profile_image')->name('showeditCenterProfileImage');
Route::post('/org_admin/edit_center_profileImage','OrganizationControllers\CenterOrganizationController@edit_center_Profile_image')->name('editCenterProfileImage');
// edit Logo Image
Route::get('/org_admin/edit_center_logoImage/{id}','OrganizationControllers\CenterOrganizationController@show_edit_center_logo_image')->name('showeditCenterLogoImage');
Route::post('/org_admin/edit_center_logoImage','OrganizationControllers\CenterOrganizationController@edit_center_logo_image')->name('editCenterLogoImage');


//-----------------------------------------------------------------------------------------------------//
// ---------------------------------------------- Doctor ----------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
//add
Route::get('/org_admin/add_doc', 'OrganizationControllers\DoctorOrganizationController@show_add_doctor')->name('showaddDoctor');
Route::post('/org_admin/add_doc', 'OrganizationControllers\DoctorOrganizationController@add_doctor')->name('addDoctor');
//delete
Route::get('/org_admin/show_del_doc', 'OrganizationControllers\DoctorOrganizationController@show_delete_dcotor')->name('showdeleteDoctor');
Route::get('/org_admin/del_doc/{id}', 'OrganizationControllers\DoctorOrganizationController@delete_doctor')->name('deleteDoctor');
//edit
Route::get('/org_admin/edit_doc', 'OrganizationControllers\DoctorOrganizationController@show_doctors_to_update')->name('showDoctorsToUpdate');
Route::get('/org_admin/edit_doc/{id}', 'OrganizationControllers\DoctorOrganizationController@show_update_doctor')->name('showeditDoctor');
Route::post('/org_admin/edit_doc', 'OrganizationControllers\DoctorOrganizationController@update_doctor')->name('editDoctor');

// edit Logo Image
Route::get('/org_admin/edit_doc_logo/{id}', 'OrganizationControllers\DoctorOrganizationController@show_edit_doc_logo_image')->name('showeditDoctorLogoImage');
Route::post('/org_admin/edit_doc_logo','OrganizationControllers\DoctorOrganizationController@edit_doc_logo_image')->name('editDoctorLogoImage');

//-----------------------------------------------------------------------------------------------------//
// ---------------------------------------------- Profile ---------------------------------------------//
//-----------------------------------------------------------------------------------------------------//

Route::get('/org_admin/edit_profile','OrganizationControllers\OrganizationController@show_edit_profile')->name('showeditProfile');
Route::post('/org_admin/edit_profile','OrganizationControllers\OrganizationController@edit_profile')->name('editProfile');

// edit Profile Image
Route::get('/org_admin/edit_profile_image','OrganizationControllers\OrganizationController@show_edit_profile_image')->name('showeditProfileImage');
Route::post('/org_admin/edit_profile_image','OrganizationControllers\OrganizationController@edit_profile_image')->name('editProfileImage');

// edit Logo Image
Route::get('/org_admin/edit_profile_logo','OrganizationControllers\OrganizationController@show_edit_logo_image')->name('showeditLogoImage');
Route::post('/org_admin/edit_profile_logo','OrganizationControllers\OrganizationController@edit_logo_image')->name('editLogoImage');

//-----------------------------------------------------------------------------------------------------//
// --------------------------------------------- Location ---------------------------------------------//
//-----------------------------------------------------------------------------------------------------//

Route::get('/org_admin/edit_map', 'OrganizationControllers\OrganizationController@show_edit_map_link')->name('showeditMap');
Route::post('/org_admin/edit_map','OrganizationControllers\OrganizationController@edit_map_link')->name('editMap');

Route::get('/org_admin/edit_address', 'OrganizationControllers\OrganizationController@show_edit_address')->name('showeditAddress');
Route::post('/org_admin/edit_address','OrganizationControllers\OrganizationController@edit_address')->name('editAddress');

//-----------------------------------------------------------------------------------------------------//
// ------------------------------------------- Social Media -------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
// social media links

Route::get('/org_admin/edit_website', 'OrganizationControllers\OrganizationController@show_edit_website')->name('showeditWebsite');
Route::post('/org_admin/edit_website','OrganizationControllers\OrganizationController@edit_website')->name('editWebsite');

Route::get('/org_admin/edit_social_facebook', 'OrganizationControllers\OrganizationController@show_edit_facebook')->name('showeditFacebook');
Route::post('/org_admin/edit_social_facebook','OrganizationControllers\OrganizationController@edit_facebook')->name('editFacebook');

Route::get('/org_admin/edit_social_instagram', 'OrganizationControllers\OrganizationController@show_edit_instagram')->name('showeditInstagram');
Route::post('/org_admin/edit_social_instagram','OrganizationControllers\OrganizationController@edit_instagram')->name('editInstagram');

Route::get('/org_admin/edit_social_twitter', 'OrganizationControllers\OrganizationController@show_edit_twitter')->name('showeditTwitter');
Route::post('/org_admin/edit_social_twitter','OrganizationControllers\OrganizationController@edit_twitter')->name('editTwitter');

Route::get('/org_admin/edit_social_youtube', 'OrganizationControllers\OrganizationController@show_edit_youtube')->name('showeditYoutube');
Route::post('/org_admin/edit_social_youtube','OrganizationControllers\OrganizationController@edit_youtube')->name('editYoutube');

//-----------------------------------------------------------------------------------------------------//
// -------------------------------------------- Incubaters --------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
Route::get('/org_admin/edit_incubaters', 'OrganizationControllers\OrganizationController@show_edit_incubaters')->name('showeditincubaters');
Route::post('/org_admin/edit_incubaters','OrganizationControllers\OrganizationController@edit_incubaters')->name('editincubaters');

//-----------------------------------------------------------------------------------------------------//
// ------------------------------------------ Intensive Care ------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
Route::get('/org_admin/edit_intensiveCare', 'OrganizationControllers\OrganizationController@show_edit_intensiveCare')->name('showeditintensiveCare');
Route::post('/org_admin/edit_intensiveCare','OrganizationControllers\OrganizationController@edit_intensiveCare')->name('editintensiveCare');

// Super Admin routes
// ---------------------------------------------------------------------------------------------------------------------------------------------------------- //
//-----------------------------------------------------------------------------------------------------//
// ------------------------------------------- Super Admin --------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
// show the super admin login form
Route::get('/admin/login','Auth\AdminLoginController@showAdminLoginForm')->name('show_sa_login');
// Authenticate the Super Admin
Route::post('/admin/login', 'Auth\AdminLoginController@authenticate_s_admin_Login')->name('s_authenticate_login');
// show the super admin dashboard
Route::get('/admin','AdminController@index')->name('s_dashboard');
// Logout The Super Admin
Route::post('/admin/logout','Auth\AdminLoginController@s_admin_logout')->name('sa_logout');

// Article
// Show send Request
Route::get('/admin/article', 'AdminControllers\ArticleController@show_post_article')->name('show_admin_article');
// Invoke send Request
Route::post('/admin/article', 'AdminControllers\ArticleController@post_article')->name('post_admin_article');


// Analysis
// Show Add Analysis
Route::get('/admin/add_analysis', 'AdminControllers\AnalysisController@show_add_analysis')->name('admin.show_add_analysis');
// Invoke Add Analysis
Route::post('/admin/add_analysis', 'AdminControllers\AnalysisController@add_analysis')->name('admin.add_analysis');
// Show Delete Analysis
Route::get('/admin/delete_analysis', 'AdminControllers\AnalysisController@show_delete_analysis')->name('admin.show_delete_analysis');
// Invoke Delete Analysis
Route::post('/admin/delete_analysis', 'AdminControllers\AnalysisController@delete_analysis')->name('admin.delete_analysis');


// Radition
// Show Add Radition
Route::get('/admin/add_radition', 'AdminControllers\RaditionController@show_add_radition')->name('admin.show_add_radition');
// Invoke Add Radition
Route::post('/admin/add_radition', 'AdminControllers\RaditionController@add_radition')->name('admin.add_radition');
// Show Delete Radition
Route::get('/admin/delete_radition', 'AdminControllers\RaditionController@show_delete_radition')->name('admin.show_delete_radition');
// Invoke Delete Radition
Route::post('/admin/delete_radition', 'AdminControllers\RaditionController@delete_radition')->name('admin.delete_radition');

// Departments
// Show Add Departments
Route::get('/admin/add_department', 'AdminControllers\DepartmentController@show_add_department')->name('admin.show_add_department');
// Invoke Add Departments
Route::post('/admin/add_department', 'AdminControllers\DepartmentController@add_department')->name('admin.add_department');
// Show Delete Departments
Route::get('/admin/delete_department', 'AdminControllers\DepartmentController@show_delete_department')->name('admin.show_delete_department');
// Invoke Delete Departments
Route::post('/admin/delete_department', 'AdminControllers\DepartmentController@delete_department')->name('admin.delete_department');

// Article Type
// Show Add Article Type
Route::get('/admin/add_articleTpye', 'AdminControllers\ArticleTpeController@show_add_articleType')->name('admin.show_add_articleType');
// Invoke Add Article Type
Route::post('/admin/add_articleTpye', 'AdminControllers\ArticleTpeController@add_articleType')->name('admin.add_articleType');
// Show Delete Article Type
Route::get('/admin/delete_articleTpye', 'AdminControllers\ArticleTpeController@show_delete_articleType')->name('admin.show_delete_articleType');
// Invoke Delete Article Type
Route::post('/admin/delete_articleTpye', 'AdminControllers\ArticleTpeController@delete_articleType')->name('admin.delete_articleType');



Route::get('/admin/editfacebook','AdminControllers\SocialController@facebook')->name ('admin.showeditfacebook');
Route::post('/admin/editfacebook','AdminControllers\SocialController@updatefacebook')->name ('editfacebook');
/*===========================*/
Route::get('/admin/edittwitter','AdminControllers\SocialController@twitter')->name ('admin.showedittwitter');
Route::post('/admin/edittwitter','AdminControllers\SocialController@updatetwitter')->name ('edittwitter');
/*==================*/
Route::get('/admin/editgoogleplus','AdminControllers\SocialController@googleplus')->name ('admin.showeditgoogleplus');
Route::post('/admin/editgoogleplus','AdminControllers\SocialController@updategoogleplus')->name ('editgoogleplus');
/*===========*/
Route::get('/admin/edityoutube','AdminControllers\SocialController@youtube')->name ('admin.showedityoutube');
Route::post('/admin/edityoutube','AdminControllers\SocialController@updateyoutube')->name ('edityoutube');
/*================home page ==========*/

Route::get('/admin','AdminControllers\homeController@user')->name('Admin_home');

Route::get('/admin/request','AdminControllers\RequestController@showrequest')->name('admin.request');

Route::get('/admin/allowrequest/{id}','AdminControllers\RequestController@allow')->name('allowrequest');
Route::get('/admin/refuserequest/{id}','AdminControllers\RequestController@refuse')->name('refuserequest');

Route::get('/admin/activities','AdminControllers\RequestController@showactivities')->name('admin.activities');
Route::get('/admin/activities/{id}','AdminControllers\RequestController@delactivities')->name('delactivities');

/*=======================*/

// ---------add hospital ----------//
Route::get('/admin/AddHospital','AdminControllers\RequestController@showAdd')->name('admin.show_add_hospital');
Route::POST('/admin/AddHos','AdminControllers\RequestController@Add')->name('admin.add_hospital');

// ---------notification ----------//
Route::get('/admin/notifications','AdminControllers\RequestController@getNotifi')->name('admin.notifications');
Route::get('/admin/notifications/{Aid}','AdminControllers\RequestController@editseen');
Route::get('/admin/delNotifi/{id}','AdminControllers\RequestController@delNotifi');
//////////////////////////////////////////

Route::get('/admin/live_search','AdminControllers\LivesearchController@index')->name('live_search');
Route::get('/admin/live_search/action','AdminControllers\LivesearchController@action')->name('live_search.action');

Route::post('/admin/hospitals', "AdminControllers\UserController@search")->name("hospitals.index");
Route::get('/admin/hospitals/{id}/delete', "AdminControllers\UserController@delete")->name("hospitals.delete");


////////////////////
Route::get('/admin/messages','AdminControllers\RequestController@getMsg')->name('admin.messages');
Route::get('/admin/editMsg/{id}','AdminControllers\RequestController@editMsg');
Route::get('/admin/delMsg/{id}','AdminControllers\RequestController@delMsg');





//-----------------------------------------------------------------------------------------------------//
// --------------------------------------------- General ----------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
Route::post('/ajax/showCorrespondingCities','AjaxRequestsController@showCorrespondingCities')->name('showCorrespondingCities');
Route::post('/ajax/getPatients','AjaxRequestsController@getPatients')->name('getPatients');
Route::post('/ajax/showCorrespondingCategory','AjaxRequestsController@showCorrespondingCategory')->name('showCorrespondingCategory');

Route::get('/error404', function () { return view('error404');})->name('error404');


// ---- ///
Route::get('/test/{id}',function($hashedPassword){

    // $password = ;
    echo(Hash::make('00000000')."<br>");
    if(Hash::check($hashedPassword, Hash::make('00000000')))
        return "Match";
    else
        return "Don't Match";
});