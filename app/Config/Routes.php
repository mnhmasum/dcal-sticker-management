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
//$routes->setDefaultController('Home');
//$routes->setDefaultMethod('index');
//$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

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
$routes->resource('record');

$routes->match(['get', 'post'], 'Login/login_submit', 'Login::login_submit');
$routes->match(['get', 'post'], 'Records/save_record', 'Records::save_record');
$routes->match(['get', 'post'], 'Users/save_user', 'Users::save_user');
$routes->match(['get', 'post'], 'Records/search_by_date', 'Records::search_by_date');
$routes->match(['get', 'post'], 'Users/edit_user_save/(:segment)', 'Users::edit_user_save/$1');
$routes->match(['get', 'post'], 'Records/update_note/(:segment)', 'Records::update_record/$1');

$routes->get('/', 'Login::login');
$routes->get('/records', 'Records::view_records');

$routes->get('/ ', 'Records::create_record');
$routes->get('/logout', 'Login::logout');
$routes->get('/delete_record/(:segment)', 'Records::delete_record/$1');
$routes->get('/edit_record/(:segment)', 'Records::edit_record/$1');
$routes->get('/create_user', 'Users::create_user');
$routes->get('/users', 'Users::view_users');
$routes->get('/delete_user/(:segment)', 'Users::delete_user/$1');
$routes->get('/edit_user/(:segment)', 'Users::edit_user/$1');

$routes->match(['get', 'post'], 'records/api/create/(:segment)', 'Records::create_record_by_user/$1');
$routes->get('/api/records', 'Records::records');
// $routes->match(['get', 'post'],'api/record/create', 'Record::create');
// $routes->match(['get', 'post'],'api/record/login', 'Record::login');
$routes->match(['get', 'post'], 'api/record/delete/(:segment)', 'Record::delete/$1');


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
