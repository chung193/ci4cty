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
$routes->get('auth/logout', 'auth\Login::logout');
// auth
$routes->group('auth', ['filter' => 'noauth'], function ($routes) {
    $routes->get('login', 'auth\Login::index', ['as' => 'login']);
    $routes->post('auth', 'auth\Login::auth');
    $routes->get('register', 'auth\Register::index');
    $routes->post('register/save', 'auth\Register::save');
    $routes->get('forgot', 'auth\Forgot::index');
    $routes->post('sendresetlink', 'auth\Forgot::sendresetlink');
    $routes->get('redirect/(:num)/(:any)', 'auth\Forgot::loadresetpage/$1/$2'); // 1st param is id, 2nd is token
    $routes->post('resetpassword', 'auth\Forgot::updatepassword');
});

$routes->group('manage', ['filter' => 'auth'], function ($routes) {

    // dashboard
    $routes->get('dashboard', 'manage\Dashboard::index');
    $routes->get('category', 'manage\Category::index');
    // page
    $routes->get('page', 'manage\Page::index');
    // shop-info
    $routes->get('info', 'manage\Info::index');
    // profile
    $routes->get('profile', 'manage\Profile::index');
    $routes->post('profile/update', 'manage\Profile::update');

    $routes->get('permission/(:num)', 'manage\Permission::index/$1');
    $routes->post('save-permission', 'manage\Permission::savePermission');
    // category
    $routes->add('category/edit/(:num)', 'manage\Category::edit/$1');
    $routes->get('category/add', 'manage\Category::add');
    $routes->post('category/save', 'manage\Category::save');
    $routes->post('category/update', 'manage\Category::update');
    $routes->get('category/delete/(:num)', 'manage\Category::delete/$1');


    // user group
    $routes->get('user-group', 'manage\User_group::index');
    $routes->get('user-group/add', 'manage\User_group::add');
    $routes->get('user-group/edit/(:num)', 'manage\User_group::edit/$1');
    $routes->post('user-group/save', 'manage\User_group::save');
    $routes->post('user-group/update', 'manage\User_group::update');
    $routes->get('user-group/delete/(:num)', 'manage\User_group::delete/$1');


    // menu
    $routes->get('menu', 'manage\Menu::index');
    $routes->get('menu/add', 'manage\Menu::add');
    $routes->get('menu/edit/(:num)', 'manage\Menu::edit/$1');
    $routes->post('menu/save', 'manage\Menu::save');
    $routes->post('menu/update', 'manage\Menu::update');
    $routes->get('menu/delete/(:num)', 'manage\Menu::delete/$1');
    $routes->get('menu/item/(:num)', 'manage\Menu::item/$1');
    $routes->post('menu/updateitem', 'manage\Menu::saveitem');

    // page
    $routes->get('page/add', 'manage\Page::add');
    $routes->get('page/edit/(:num)', 'manage\Page::edit/$1');
    $routes->post('page/save', 'manage\Page::save');
    $routes->post('page/update', 'manage\Page::update');
    $routes->get('page/delete/(:num)', 'manage\Page::delete/$1');

    // seo
    $routes->get('seo', 'manage\Seo::index');
    $routes->get('seo/add', 'manage\Seo::add');
    $routes->get('seo/edit/(:num)', 'manage\Seo::edit/$1');
    $routes->post('seo/save', 'manage\Seo::save');
    $routes->post('seo/update', 'manage\Seo::update');
    $routes->get('seo/delete/(:num)', 'manage\Seo::delete/$1');

    // post
    $routes->get('post', 'manage\Post::index');
    $routes->get('post/edit/(:num)', 'manage\Post::edit/$1');
    $routes->get('post/add', 'manage\Post::add');
    $routes->post('post/save', 'manage\Post::save');
    $routes->post('post/update', 'manage\Post::update');
    $routes->get('post/delete/(:num)', 'manage\Post::delete/$1');
    $routes->get('post/restore/(:num)', 'manage\Post::restore/$1');
    $routes->get('post/delete-from-trash/(:num)', 'manage\Post::delete_from_trash/$1');

    // user
    $routes->get('user', 'manage\User::index');
    $routes->get('user/add', 'manage\User::add');
    $routes->get('user/edit/(:num)', 'manage\User::edit/$1');
    $routes->post('user/save', 'manage\User::save');
    $routes->post('user/update', 'manage\User::update');
    $routes->get('user/delete/(:num)', 'manage\User::delete/$1');

    // option
    $routes->get('options', 'manage\Options::index');
    $routes->post('options/save', 'manage\Options::save');

    // shop_info
    $routes->add('info/edit/(:num)', 'manage\Info::edit/$1');
    $routes->get('info/add', 'manage\Info::add');
    $routes->post('info/save', 'manage\Info::save');
    $routes->post('info/update', 'manage\Info::update');
    $routes->get('info/delete/(:num)', 'manage\Info::delete/$1');
});

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

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
