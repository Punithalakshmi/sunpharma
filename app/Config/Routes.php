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
$routes->get('mission', 'Home::mission');
$routes->get('annual_activities', 'Home::annualActivities');
$routes->get('contact', 'Home::contact');
$routes->get('research_awards','ResearchAwards::index');
$routes->get('directory_research_awardees','DirectoryResearchAwardees::index');
$routes->get('special_awards','SpecialAwards::index');
$routes->get('latest_winners_of_science_scholars_awards','LatestWinnersOfScienceScholarsAwards::index');
$routes->get('directory_of_science_scholars','DirectoryScienceScholars::index');
$routes->get('ssan','Nomination::index');
$routes->get('spsfn','Nomination::spsfn');
$routes->post('spsfn','Nomination::spsfn');

$routes->get('ssan/(:any)','Nomination::index/$1');
$routes->get('spsfn/(:any)','Nomination::spsfn/$1');

$routes->post('login','User::login');
$routes->get('login','User::login');

$routes->post('forget_password','User::forget_password');
$routes->get('forget_password','User::forget_password');

$routes->post('reset_password','User::reset_password');
$routes->get('reset_password','User::reset_password');

$routes->get('logout','User::logout');

$routes->group("admin", ["namespace" => "App\Controllers\Admin"] , function($routes){
	 
    $routes->get("/", "Dashboard::index");

    // URL - /admin/about
    $routes->get("dashboard", "Dashboard::index");
    // URL - /admin/product
    $routes->post("login/loginAuth", "Login::loginAuth");

    $routes->get("login", "Login::index");
    $routes->get("logout", "Login::logout");
    $routes->get("user", "User::index");
    //$routes->get("user/add", "User::add");
    ///$routes->match(["get", "post"], "user/add/(:any)", "User::add/$1");

    $routes->get('user/add','User::add');
    $routes->post('user/add',"User::add");
    $routes->get('user/add/(:any)','User::add/$1');
    $routes->get("user/delete/(:any)", "User::delete/$1");
    $routes->get("user/changepassword/(:any)", "User::changepassword/$1");
    $routes->post("user/changepassword", "User::changepassword");

    $routes->get("profile", "User::profile");
    $routes->post("profile", "User::profile");

    $routes->get("nominee", "Nominee::index");
    $routes->get('nominee/view/(:any)','Nominee::view/$1');
    $routes->get('nominee/lists','Nominee::nominee_lists_of_jury');
    $routes->post('nominee/assignJury','Nominee::assignJury');
    $routes->post('nominee/view','Nominee::view');
    $routes->get('nominee/ratings','Nominee::ratings');
    $routes->get('nominee/getApproval/(:any)','Nominee::getApproval/$1');
    $routes->post('nominee/approve','Nominee::approve');


    $routes->get('category','Category::index');
    $routes->post('category/add','Category::add');
    $routes->get('category/add','Category::add');
    $routes->get('category/add/(:any)','Category::add/$1');
    $routes->get('category/delete/(:any)','Category::delete/$1');

    $routes->get('nomination','Nomination::index');
    $routes->post('nomination/add','Nomination::add');
    $routes->get('nomination/add','Nomination::add');
    $routes->get('nomination/add/(:any)','Nomination::add/$1');
    $routes->get('nomination/delete/(:any)','Nomination::delete/$1');

    $routes->get('rating/add/(:any)','Rating::add/$1');
    $routes->post('rating/add','Rating::add');
    $routes->get('rating/delete/(:any)/(:any)','Rating::delete/$1/$1');

    $routes->get('workshops/add/(:any)','Workshops::add/$1');
    $routes->post('workshops/add','Workshops::add');
    $routes->get('workshops/delete/(:any)','Workshops::delete/$1');


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
