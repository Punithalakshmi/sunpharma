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
$routes->get('aboutus', 'Home::aboutus');
$routes->get('annual_activities', 'Home::annualActivities');
$routes->get('roundtable', 'Home::roundtable');
$routes->get('annualforeign_scientist', 'Home::annualforeign_scientist');
$routes->get('symposium', 'Home::symposium');
$routes->get('contact', 'Home::contact');
$routes->post('contact', 'Home::contact');
$routes->get('research_awards','ResearchAwards::index');
$routes->get('directory_research_awardees','DirectoryResearchAwardees::index');
$routes->get('special_awards','SpecialAwards::index');
$routes->get('latest_winners_of_science_scholars_awards','LatestWinnersOfScienceScholarsAwards::index');
$routes->get('directory_of_science_scholars','DirectoryScienceScholars::index');
$routes->get('spsfn','Nomination::index');
$routes->post('spsfn','Nomination::index');
$routes->get('ssan','Nomination::ssan');
$routes->post('ssan','Nomination::ssan');
$routes->get('nomination_preview', 'Home::nominationPreview');
$routes->get('latest_winners_of_research_awards','LatestWinnersOfResearchAwards::index');
$routes->get('latest_winners_of_science_scholar_awards','LatestWinnersOfScienceScholarsAwards::index');
//$routes->get('research_awards','Home::research_awards');
$routes->get('science_scholar_awards','Home::science_scholar_awards');

$routes->get('ssan/(:any)','Nomination::ssan/$1',['filter' =>'check_date']);
$routes->get('spsfn/(:any)','Nomination::index/$1',['filter' =>'check_date']);
$routes->get('preview/(:any)','Nomination::preview/$1');
$routes->post('getPostedData','Nomination::getPostedData');

$routes->post('login','User::login');
$routes->get('login','User::login');

$routes->post('forget_password','User::forget_password');
$routes->get('forget_password','User::forget_password');

$routes->post('reset_password','User::reset_password');
$routes->get('reset_password','User::reset_password');
$routes->get('view/(:any)','Nomination::view/$1');
$routes->post('view','Nomination::view');

$routes->get('logout','User::logout');
$routes->get('form','User::validForm');
$routes->get('sendMail','User::sendMail');

$routes->post('uniqueValidation','User::uniqueValidation');

$routes->get('success','Nomination::Success');

$routes->get('event','EventRegistration::index');
$routes->get('event/registration','EventRegistration::event');
$routes->get('event/registration/(:any)','EventRegistration::event/$1');
$routes->post('event/registration','EventRegistration::event');

$routes->get('event/close','EventRegistration::close');

$routes->get('event/read_more','EventRegistration::read_more');

$routes->get('event/read_more/(:any)','EventRegistration::read_more/$1');

$routes->get('csrf_token','Nomination::get_new_csrf_token');

$routes->get('bulkEmails','User::bulkEmails');

$routes->get('bulkEmailSuccess','User::bulkEmailSuccess');

$routes->get('attendMode/(:any)/(:any)','User::attendMode/$1/$2');

$routes->get('sendMailToRegistrationUsers','User::sendMailToRegistrationUsers');

$routes->get('nomination/close','EventRegistration::close');

$routes->group("admin", ["namespace" => "App\Controllers\Admin"] , function($routes){
	 
    $routes->get("/", "Dashboard::index",['filter' =>'auth']);

    // URL - /admin/about
    $routes->get("dashboard", "Dashboard::index",['filter' =>'auth']);
    // URL - /admin/product
    $routes->post("login/loginAuth", "Login::loginAuth");

    $routes->get("login", "Login::index");
    $routes->get("logout", "Login::logout");
    $routes->get("user", "User::index",['filter' =>'auth']);
    //$routes->get("user/add", "User::add");
    ///$routes->match(["get", "post"], "user/add/(:any)", "User::add/$1");

    $routes->get('user/add','User::add',['filter' =>'auth']);
    $routes->post('user/add',"User::add",['filter' =>'auth']);
    $routes->get('user/add/(:any)','User::add/$1',['filter' =>'auth']);
    $routes->get("user/delete/(:any)", "User::delete/$1",['filter' =>'auth']);
    $routes->post("user/delete/(:any)", "User::delete/$1",['filter' =>'auth']);
    $routes->get("user/changepassword/(:any)", "User::changepassword/$1",['filter' =>'auth']);
    $routes->post("user/changepassword", "User::changepassword",['filter' =>'auth']);

    $routes->get("profile", "User::profile",['filter' =>'auth']);
    $routes->post("profile", "User::profile",['filter' =>'auth']);

    $routes->get("nominee", "Nominee::index",['filter' =>'auth']);
    $routes->get('nominee/view/(:any)','Nominee::view/$1',['filter' =>'auth']);
    $routes->get('nominee/lists','Nominee::nominee_lists_of_jury',['filter' =>'auth']);
    $routes->post('nominee/assignJury','Nominee::assignJury',['filter' =>'auth']);
    $routes->post('nominee/view','Nominee::view',['filter' =>'auth']);
    $routes->get('nominee/ratings','Nominee::ratings',['filter' =>'auth']);
    $routes->get('nominee/getApproval/(:any)','Nominee::getApproval/$1',['filter' =>'auth']);
    $routes->post('nominee/approve','Nominee::approve',['filter' =>'auth']);

    $routes->get('category','Category::index',['filter' =>'auth']);
    $routes->post('category/add','Category::add',['filter' =>'auth']);
    $routes->get('category/add','Category::add',['filter' =>'auth']);
    $routes->get('category/add/(:any)','Category::add/$1',['filter' =>'auth']);
    $routes->get('category/delete/(:any)','Category::delete/$1',['filter' =>'auth']);
    $routes->post('category/delete/(:any)','Category::delete/$1',['filter' =>'auth']);

    $routes->get('nomination','Nomination::index',['filter' =>'auth']);
    $routes->post('nomination/add','Nomination::add',['filter' =>'auth']);
    $routes->get('nomination/add','Nomination::add',['filter' =>'auth']);
    $routes->get('nomination/add/(:any)','Nomination::add/$1',['filter' =>'auth']);
    $routes->get('nomination/delete/(:any)','Nomination::delete/$1',['filter' =>'auth']);
    $routes->post('nomination/delete/(:any)','Nomination::delete/$1',['filter' =>'auth']);

    $routes->get('rating/add/(:any)','Rating::add/$1',['filter' =>'auth']);
    $routes->post('rating/add','Rating::add',['filter' =>'auth']);
    $routes->get('rating/delete/(:any)/(:any)','Rating::delete/$1/$1',['filter' =>'auth']);
    $routes->post('rating/delete/(:any)/(:any)','Rating::delete/$1/$1',['filter' =>'auth']);

    $routes->get('workshops','Workshops::index',['filter' =>'auth']);
    $routes->get('workshops/add','Workshops::add',['filter' =>'auth']);
    $routes->get('workshops/add/(:any)','Workshops::add/$1',['filter' =>'auth']);
    $routes->post('workshops/add','Workshops::add',['filter' =>'auth']);
    $routes->get('workshops/delete/(:any)','Workshops::delete/$1',['filter' =>'auth']);
    $routes->post('workshops/delete/(:any)','Workshops::delete/$1',['filter' =>'auth']);
    
    $routes->get('awards','Awards::index',['filter' =>'auth']);
    $routes->post('awards/index','Awards::index',['filter' =>'auth']);
    $routes->get('awards/export','Awards::export',['filter' =>'auth']);
    $routes->post('awards/export','Awards::export',['filter' =>'auth']);

    $routes->get('awards/getJuryListsByNominee/(:any)','Awards::getJuryListsByNominee/$1',['filter' =>'auth']);
    $routes->post('awards/getJuryListsByNominee/(:any)','Awards::getJuryListsByNominee/$1',['filter' =>'auth']);
    $routes->post('awards/getJuryListsByNominee','Awards::getJuryListsByNominee',['filter' =>'auth']);

    $routes->get('eventregisteration','EventRegisteration::index',['filter' =>'auth']);
    $routes->post('eventregisteration/add','EventRegisteration::add',['filter' =>'auth']);
    $routes->get('eventregisteration/add','EventRegisteration::add',['filter' =>'auth']);
    $routes->get('eventregisteration/add/(:any)','EventRegisteration::add/$1',['filter' =>'auth']);
    $routes->get('eventregisteration/delete/(:any)','EventRegisteration::delete/$1',['filter' =>'auth']);
    $routes->post('eventregisteration/delete/(:any)','EventRegisteration::delete/$1',['filter' =>'auth']);

    $routes->get('nominee/extend/(:any)','Nominee::extend/$1',['filter' =>'auth']);
    $routes->post('nominee/extend','Nominee::extend',['filter' =>'auth']);

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
