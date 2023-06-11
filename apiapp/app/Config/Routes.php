<?php namespace Config;
// Create a new instance of our RouteCollection class.
$routes = Services::routes(true);
// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}
/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);
/**
 * --------------------------------------------------------------------
 * Route Definitions
 * -------------------------------------------------------------------- */
$routes->get('Reports', 'Reports::index');
$routes->post('Reports/generate/(:num)', 'Reports::generate/$1');
$routes->get('Reports/accept-report/(:num)', 'Reports::accept_report/$1');
$routes->get('Reports/(:num)', 'Reports::show/$1');
$routes->get('Proposes/show-by-user/(:num)', 'Proposes::showByUser/$1');
$routes->post('Proposes/give-prize', 'Proposes::givePrize');
$routes->post('Proposes/end-propose', 'Proposes::endPropose');
$routes->get('FrequencyData/show-by-propose/(:num)', 'FrequencyData::showByPropose/$1');
$routes->resource('Proposes');
$routes->resource('Users');
$routes->resource('FrequencyData');














/**
 *
 * get -->   http://frientek.com/Proposes  : get all Proposes
 * post -->   http://frientek.com/Proposes  : Create new Propose
 * get -->   http://frientek.com/Proposes/1  : get proposes that have id =1
 * get -->   http://frientek.com/Proposes/show-by-user/1  : get all proposes that created by user id =1
 * post -->   http://frientek.com/Proposes/give-prize  : Give prize to propose has been done bu user.
 * post -->   http://frientek.com/Proposes/end-propose  : end propose by user 1=> propose has been done / -1 has benn canceled.
 * get -->   http://frientek.com/Users  : get all Users
 * post -->   http://frientek.com/Users  : Create new User
 * get -->   http://frientek.com/Users/1  : get User that have id =1
 * Delete -->   http://frientek.com/Users/1  : delete User that have id =1
 *  post -->   http://frientek.com/user/login  : Login to app or to admin side
 *  post -->   http://frientek.com/user/register  : Register to app
 * get -->   http://frientek.com/FrequencyData  : get all FrequencyData
 * post -->   http://frientek.com/FrequencyData  : Create new FrequencyData
 * get -->   http://frientek.com/FrequencyData/1  : get FrequencyData that have id =1
 * Delete -->   http://frientek.com/FrequencyData/1  : delete FrequencyData that have id =1
 *get -->   http://frientek.com/Reports  : get all Reports
 *get -->   http://frientek.com/Reports/1  : get Report that have id =1
 * post -->   http://frientek.com/Reports/generate  : generate new report and link it to propose
 * get -->   http://frientek.com/Reports/accept-report  : accept report report by the admin
 *
 *
 */

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need to it be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
