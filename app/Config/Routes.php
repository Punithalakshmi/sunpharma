<?php

namespace Config;


// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('info', 'Home::info');

$routes->get('aboutus', 'Home::aboutus');
$routes->get('annual_activities', 'Home::annualActivities');
$routes->get('roundtable', 'Home::roundtable');
$routes->get('annualforeign_scientist', 'Home::annualforeign_scientist');
$routes->get('symposium', 'Home::symposium');
$routes->get('contact', 'Home::contact');
$routes->post('contact', 'Home::contact');
$routes->get('research_awards','ResearchAwards::index');
$routes->get('directory_research_awardees','DirectoryResearchAwardees::index');
$routes->get('directory_clinical_research_fellows','DirectoryClinicalResearchAwardees::index');
$routes->get('special_awards','SpecialAwards::index');
$routes->get('latest_winners_of_science_scholars_awards','LatestWinnersOfScienceScholarsAwards::index');
$routes->get('directory_of_science_scholars','DirectoryScienceScholars::index');
$routes->get('spsfn','Nomination::index',['filter' => 'redirect_home']);
$routes->post('spsfn','Nomination::index',['filter' => 'redirect_home']);
$routes->get('ssan','Nomination::ssan',['filter' => 'redirect_home']);
$routes->post('ssan','Nomination::ssan',['filter' => 'redirect_home']);
$routes->get('nomination_preview', 'Home::nominationPreview');
$routes->get('latest_winners_of_research_awards','LatestWinnersOfResearchAwards::index');
$routes->get('latest_winners_of_science_scholar_awards','LatestWinnersOfScienceScholarsAwards::index');
$routes->get('latest_winners_of_clinical_research_fellows','LatestWinnersOfClinicalResearchFellowships::index');
//$routes->get('research_awards','Home::research_awards');
$routes->get('science_scholar_awards','Home::science_scholar_awards');


$routes->get('ssan/(:any)','Nomination::ssan/$1',['filter' =>'check_date']);
$routes->get('spsfn/(:any)','Nomination::index/$1',['filter' =>'check_date']);
$routes->post('ssan/(:any)','Nomination::ssan/$1',['filter' =>'check_date']);
$routes->post('spsfn/(:any)','Nomination::index/$1',['filter' =>'check_date']);
$routes->get('preview/(:any)','Nomination::preview/$1');
$routes->post('getPostedData','Nomination::getPostedData');

//$routes->get('fellowship','Fellowship::index');
$routes->post('login','User::login');
$routes->get('login','User::login');

$routes->post('forgot_password','User::forget_password');
$routes->get('forgot_password','User::forget_password');

$routes->post('reset_password','User::reset_password');
$routes->get('reset_password/(:any)','User::reset_password/$1');
$routes->get('reset_password','User::reset_password');
$routes->post('reset_password/(:any)','User::reset_password/$1');
$routes->post('applicant/view','Nomination::view');
$routes->get('view/(:any)/(:any)','Nomination::view/$1/$1');

$routes->get('crf_read_more','Fellowship::read_more');
$routes->get('ageCalculation/(:any)','Fellowship::ageCalculation/$1');
$routes->get('fellowship/pdf/(:num)','Fellowship::pdfGeneration/$1');
$routes->get('fellowship/print/(:any)','Fellowship::print/$1');
$routes->get('fellowship/view/(:any)/(:any)','Fellowship::view/$1/$1');
$routes->post('fellowship/view/','Fellowship::view');
$routes->get('fellowship/(:any)','Fellowship::index/$1',['filter' =>'check_date']);
$routes->post('fellowship/(:any)','Fellowship::index/$1',['filter' =>'check_date']);


$routes->get('logout','User::logout');
$routes->get('form','User::validForm');
$routes->get('sendMail','User::sendMail');
$routes->get('user_check','User::user_check');

$routes->post('uniqueValidation','User::uniqueValidation');
$routes->get('success','Nomination::Success');

$routes->get('event','EventRegistration::index');
$routes->get('event/registration','EventRegistration::event');
$routes->get('event/registration/(:any)','EventRegistration::event/$1');
$routes->post('event/registration','EventRegistration::event');

$routes->get('event/close','EventRegistration::close');

$routes->get('event/read_more','EventRegistration::read_more');

$routes->get('event/read_more_images','EventRegistration::read_more_images');

$routes->get('event/read_more/(:any)','EventRegistration::read_more/$1');

$routes->get('csrf_token','Nomination::get_new_csrf_token');

$routes->get('bulkEmails','User::bulkEmails');

$routes->get('bulkEmailSuccess','User::bulkEmailSuccess');

$routes->get('attendMode/(:any)/(:any)','User::attendMode/$1/$2');

$routes->get('sendMailToRegistrationUsers','User::sendMailToRegistrationUsers');

$routes->get('nomination/close','Nomination::close');

$routes->post('nomination/check_unique_award_by_user','Nomination::checkUniqueEmailForAward');

$routes->get('print/(:any)','Nomination::print/$1');

$routes->get('import/users','Import::usersImport');

$routes->get('import/nominationsImport','Import::nominationsImport');

$routes->get('import/uploadAttachment','Import::uploadAttachment');

$routes->get('import/ratingImport','Import::ratingImport');

$routes->get('import/nominationsImportSS','Import::nominationsImportSS');

$routes->get('import/uploadAttachmentSS','Import::uploadAttachmentSS');

$routes->get('import/uploadAttachmentSS','Import::uploadAttachmentSS');

$routes->get('testform','User::testForm');

$routes->post('testform','User::testForm');
$routes->get('getPdf/(:any)','Nomination::pdfGeneration/$1');

$routes->get('getAuth/(:any)','User::approve/$1');


$routes->group("admin", ["namespace" => "App\Controllers\Admin"] , function($routes){
	 
    $routes->get("/", "Dashboard::index",['filter' =>'auth']);
    $routes->get("access", "Dashboard::access");

    // URL - /admin/about
    $routes->get("dashboard", "Dashboard::index",['filter' =>'auth']);
    // URL - /admin/product
    $routes->post("login/loginAuth", "Login::loginAuth");

    $routes->get("login", "Login::index");
    $routes->get("logout", "Login::logout");

    $routes->post('forgot_password','Login::forget_password');
    $routes->get('forgot_password','Login::forget_password');

    $routes->post('update_password/(:any)','Login::reset_password/$1');
    $routes->get('update_password/(:any)','Login::reset_password/$1');

    $routes->get("user", "User::index",['filter' =>'auth']);
    $routes->post("user", "User::index",['filter' =>'auth']);
    $routes->get("reset_password/(:any)", "User::resetpassword/$1",['filter' =>'auth']);
    $routes->post("reset_password", "User::resetpassword",['filter' =>'auth']);
    //$routes->get("user/add", "User::add");
    ///$routes->match(["get", "post"], "user/add/(:any)", "User::add/$1");

    $routes->get('user/add','User::add',['filter' =>'auth']);
    $routes->post('user/add',"User::add",['filter' =>'auth']);
    $routes->get('user/add/(:any)','User::add/$1',['filter' =>'auth']);
    $routes->get("user/delete/(:any)", "User::delete/$1",['filter' =>'auth']);
    $routes->post("user/delete/(:any)", "User::delete/$1",['filter' =>'auth']);
    $routes->get("user/changepassword/(:any)", "User::changepassword/$1",['filter' =>'auth']);
    $routes->post("user/changepassword", "User::changepassword",['filter' =>'auth']);
    $routes->get("user/checkIfNominationClosed/(:any)", "User::checkIfNominationClosed/$1",['filter' =>'auth']);
     $routes->get("user/sendMailToAllJury", "User::sendMailToAllJury",['filter' =>'auth']);
    
    $routes->get("profile", "User::profile",['filter' =>'auth']);
    $routes->post("profile", "User::profile",['filter' =>'auth']);

    $routes->get("nominee", "Nominee::index",['filter' =>'auth']);
    $routes->post("nominee", "Nominee::index",['filter' =>'auth']);
    $routes->get('nominee/view/(:any)','Nominee::view/$1',['filter' =>'auth']);
    $routes->post('nominee/view/(:any)','Nominee::view/$1',['filter' =>'auth']);
    $routes->post('nominee/view','Nominee::view',['filter' =>'auth']);
    
    $routes->post('nominee/assignJury','Nominee::assignJury',['filter' =>'auth']);
  
    $routes->get('nominee/ratings','Nominee::ratings',['filter' =>'auth']);
    $routes->get('nominee/getApproval/(:any)','Nominee::getApproval/$1',['filter' =>'auth']);
    $routes->post('nominee/approve','Nominee::approve',['filter' =>'auth']);
    $routes->get('nominee/update/(:any)','Nominee::update/$1',['filter' =>'auth']);
    $routes->post('nominee/update/(:any)','Nominee::update/$1',['filter' =>'auth']);
    $routes->post('nominee/removeFile','Nominee::removeFile',['filter' => 'auth']);
    $routes->get('nominee/export','Nominee::export',['filter' => 'auth']);
    $routes->post('nominee/export','Nominee::export',['filter' => 'auth']);
     $routes->post('nominee/statuslists','Nominee::nominationStatusExport',['filter' => 'auth']);
$routes->get('nominee/carryForwardToNextYear/(:any)','Nominee::carryForwardToNextYear/$1',['filter' => 'auth']); 
	   //  $routes->get('nominee/statuslists/(:any)','Nominee::nominationStatusExport/$1',['filter' => 'auth']);
	
    $routes->post('nominee/nomination_status_export','Nominee::nominationStatusExport',['filter' => 'auth']);

    $routes->get('category','Category::index',['filter' =>'auth']);
    $routes->post('category','Category::index',['filter' =>'auth']);
    $routes->post('category/add','Category::add',['filter' =>'auth']);
    $routes->get('category/add','Category::add',['filter' =>'auth']);
    $routes->get('category/add/(:any)','Category::add/$1',['filter' =>'auth']);
    $routes->get('category/delete/(:any)','Category::delete/$1',['filter' =>'auth']);
    $routes->post('category/delete/(:any)','Category::delete/$1',['filter' =>'auth']);

    $routes->get('nomination','Nomination::index',['filter' =>'auth']);
    $routes->post('nomination','Nomination::index',['filter' =>'auth']);
    $routes->post('nomination/add','Nomination::add',['filter' =>'auth']);
    $routes->get('nomination/add','Nomination::add',['filter' =>'auth']);
    $routes->get('nomination/add/(:any)','Nomination::add/$1',['filter' =>'auth']);
    $routes->get('nomination/delete/(:any)','Nomination::delete/$1',['filter' =>'auth']);
    $routes->post('nomination/delete/(:any)','Nomination::delete/$1',['filter' =>'auth']);
    $routes->get('nomination/getCategoryById/(:any)','Nomination::getCategoryById/$1',['filter' => 'auth']);
    $routes->get('nomination/assigned_jury_lists/(:any)','Nomination::assigned_jury_lists/$1',['filter' => 'auth']);
    $routes->get('nomination/remove_jury_from_award/(:any)','Nomination::remove_jury_from_award/$1',['filter' => 'auth']);
    $routes->get('nomination/extendNomination/(:any)','Nomination::extendNomination/$1',['filter' => 'auth']);
    $routes->post('nomination/extendNomination','Nomination::extendNomination',['filter' => 'auth']);
    
    
    $routes->get('rating/add/(:any)','Rating::add/$1',['filter' =>'auth']);
    $routes->post('rating/add/(:any)','Rating::add/$1',['filter' =>'auth']);
    $routes->post('rating/add','Rating::add',['filter' =>'auth']);
    $routes->get('rating/delete/(:any)/(:any)','Rating::delete/$1/$1',['filter' =>'auth']);
    $routes->post('rating/delete/(:any)/(:any)','Rating::delete/$1/$1',['filter' =>'auth']);

    $routes->get('workshops','Workshops::index',['filter' =>'auth']);
    $routes->post('workshops','Workshops::index',['filter' =>'auth']);
    $routes->get('workshops/add','Workshops::add',['filter' =>'auth']);
    $routes->get('workshops/add/(:any)','Workshops::add/$1',['filter' =>'auth']);
    $routes->post('workshops/add','Workshops::add',['filter' =>'auth']);
    $routes->get('workshops/delete/(:any)','Workshops::delete/$1',['filter' =>'auth']);
    $routes->post('workshops/delete/(:any)','Workshops::delete/$1',['filter' =>'auth']);
 //   $routes->post('workshops/onsite_user_limit','Workshops::onsite_user_limit',['filter' =>'auth']);
    $routes->get('workshops/onsite_user_limit/(:any)/(:any)','Workshops::onsite_user_limit/$1/$1',['filter' =>'auth']);
    
    $routes->get('awards','Awards::index',['filter' =>'auth']);
    $routes->post('awards/index','Awards::index',['filter' =>'auth']);
    $routes->get('awards/export','Awards::export',['filter' =>'auth']);
    $routes->post('awards/export','Awards::export',['filter' =>'auth']);

    $routes->get('awards/getJuryListsByNominee/(:any)','Awards::getJuryListsByNominee/$1',['filter' =>'auth']);
    $routes->post('awards/getJuryListsByNominee/(:any)','Awards::getJuryListsByNominee/$1',['filter' =>'auth']);
    $routes->post('awards/getJuryListsByNominee','Awards::getJuryListsByNominee',['filter' =>'auth']);

    $routes->get('eventregisteration','EventRegisteration::index',['filter' =>'auth']);
    $routes->post('eventregisteration','EventRegisteration::index',['filter' =>'auth']);
    $routes->post('eventregisteration/add','EventRegisteration::add',['filter' =>'auth']);
    $routes->get('eventregisteration/add','EventRegisteration::add',['filter' =>'auth']);
    $routes->get('eventregisteration/add/(:any)','EventRegisteration::add/$1',['filter' =>'auth']);
    $routes->get('eventregisteration/delete/(:any)','EventRegisteration::delete/$1',['filter' =>'auth']);
    $routes->post('eventregisteration/delete/(:any)','EventRegisteration::delete/$1',['filter' =>'auth']);
    $routes->get('eventregisteration/checkIfEventIsCompleted/(:any)','EventRegisteration::checkIfEventIsCompleted/$1',['filter' =>'auth']);

    
    $routes->get('nominee/extend/(:any)','Nominee::extend/$1',['filter' =>'auth']);
    $routes->post('nominee/extend','Nominee::extend',['filter' =>'auth']);

    $routes->post('eventregisteration/export','EventRegisteration::export',['filter' =>'auth']);

    $routes->post('mappedjuries','JuryMapping::index',['filter' =>'auth']);
    $routes->get('mappedjuries','JuryMapping::index',['filter' =>'auth']);

    $routes->post('jury/mapping','JuryMapping::mapping',['filter' =>'auth']);
    $routes->get('jury/mapping','JuryMapping::mapping',['filter' =>'auth']);

    $routes->get('winners','Winners::lists',['filter' =>'auth']);
    $routes->post('winners','Winners::lists',['filter' =>'auth']);
    $routes->get('winners/add','Winners::add',['filter' =>'auth']);
    $routes->post('winners/add','Winners::add',['filter' =>'auth']);
    $routes->get('winners/add/(:any)','Winners::add/$1',['filter' =>'auth']);
    $routes->post('winners/delete/(:any)','Winners::delete/$1',['filter' =>'auth']);
	

});


$routes->group("jury", ["namespace" => "App\Controllers\Admin"] , function($routes){
    $routes->get("/", "Dashboard::index",['filter' =>'auth_jury']);
    // URL - /jury
    $routes->post("login/loginAuth", "Login::loginAuth");

    $routes->get("login", "Login::index");
    $routes->get("logout", "Login::logout");

    $routes->post('forgot_password','Login::forget_password');
    $routes->get('forgot_password','Login::forget_password');

    $routes->post('update_password/(:any)','Login::reset_password/$1');
    $routes->get('update_password/(:any)','Login::reset_password/$1');

    $routes->get("profile", "User::profile",['filter' =>'auth_jury']);
    $routes->post("profile", "User::profile",['filter' =>'auth_jury']);

    $routes->get("reset_password/(:any)", "User::resetpassword/$1",['filter' =>'auth_jury']);
    $routes->post("reset_password", "User::resetpassword",['filter' =>'auth_jury']);

    $routes->get('nominations','Nominee::nominee_lists_of_jury',['filter' =>'auth_jury']);

    $routes->get("access", "Dashboard::access");

    $routes->get('nominee/view/(:any)','Nominee::view/$1',['filter' =>'auth_jury']);

    $routes->get('rating/add/(:any)','Rating::add/$1',['filter' =>'auth_jury']);
    $routes->post('rating/add/(:any)','Rating::add/$1',['filter' =>'auth_jury']);
    $routes->post('rating/add','Rating::add',['filter' =>'auth_jury']);
    $routes->post('nominee/view/(:any)','Nominee::view/$1',['filter' =>'auth_jury']);
    $routes->post('nominee/view','Nominee::view',['filter' =>'auth_jury']);


});


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
