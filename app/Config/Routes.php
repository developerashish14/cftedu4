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
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
//$routes->get('default_controller', 'login');
$routes->get('/', 'Home::index');
$routes->get('/web-admin', 'AdminHome::index');

$routes->get('/catch_captcha', 'AdminHome::catch_captcha');
//Customer Panel Routes
$routes->post("/customer-login","Login::customer");
$routes->post("/customer-login-confirmation","Login::customer_verification");
//Admin Panel Routes
$routes->post("admin-login","Login::signin");

$routes->group('',['filter'=>'AuthCheck'], function($routes){
	//---------faculty------
	$routes->post('/web-admin/faculty/(:any)', 'AdminFaculty::action_update/$1');
    $routes->get('/web-admin/user/user_access', 'Admin_user::view');
    $routes->post('/web-admin/user/(:any)', 'Admin_user::action_update/$1');
    $routes->get('/web-admin/web_pages/addpage', 'Web_pages::addpage/$1');
	$routes->get('/web-admin/web_pages/editpage/(:any)', 'Web_pages::editpage/$1');
	$routes->post('/web-admin/web_pages/(:any)', 'Web_pages::action_update/$1');
	$routes->post('/web-admin/slider/(:any)', 'AdminSlider::action_update/$1');
    $routes->match(["post","get"],'/web-admin/(:any)', 'Admin::view/$1');
	
    
});


//$routes->post('(:any)', 'pages::view::$1');

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
