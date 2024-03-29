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
$routes->group('', ['filter' => 'expiredfilter'], function ($routes) {
    $routes->get('/admin/login', 'Auth\AdminAuthController::index', ["as" => "admin.auth.login.index"]);
    $routes->post('/admin/login', 'Auth\AdminAuthController::store', ["as" => "admin.auth.login.store"]);

    $routes->group('admin', ['filter' => 'adminfilter'], function ($routes) {

        $routes->get('dashboards', 'Admin\DashboardController::index', ["as" => "admin.dashboards.index"]);

        $routes->get('reports', 'Admin\ReportController::index', ["as" => "admin.reports.index"]);
        $routes->get('reports/print', 'Admin\ReportController::print', ["as" => "admin.reports.print"]);

        $routes->get('bookings', 'Admin\BookingController::index', ["as" => "admin.bookings.index"]);
        $routes->get('bookings/(:num)', 'Admin\BookingController::show/$1', ["as" => "admin.bookings.show"]);
        $routes->put('bookings/(:num)', 'Admin\BookingController::update/$1', ["as" => "admin.bookings.update"]);
        $routes->put('bookings/(:num)/finish', 'Admin\BookingController::finish/$1', ["as" => "admin.bookings.finish"]);

        $routes->get('products/(:num)/subs/(:num)/medias', 'Admin\ProductMediaController::index/$1/$2', ["as" => "admin.product-medias.index"]);
        $routes->post('products/(:num)/subs/(:num)/medias', 'Admin\ProductMediaController::store/$1/$2', ["as" => "admin.product-medias.store"]);
        $routes->get('products/(:num)/subs/(:num)/medias/create', 'Admin\ProductMediaController::create/$1/$2', ["as" => "admin.product-medias.create"]);
        $routes->get('products/(:num)/subs/(:num)/medias/(:num)/edit', 'Admin\ProductMediaController::edit/$1/$2/$3', ["as" => "admin.product-medias.edit"]);
        $routes->put('products/(:num)/subs/(:num)/medias/(:num)', 'Admin\ProductMediaController::update/$1/$2/$3', ["as" => "admin.product-medias.update"]);
        $routes->delete('products/(:num)/subs/(:num)/medias/(:num)', 'Admin\ProductMediaController::destroy/$1/$2/$3', ["as" => "admin.product-medias.destroy"]);

        $routes->get('products/(:num)/subs/(:num)/vouchers', 'Admin\ProductVoucherController::index/$1/$2', ["as" => "admin.product-vouchers.index"]);
        $routes->post('products/(:num)/subs/(:num)/vouchers', 'Admin\ProductVoucherController::store/$1/$2', ["as" => "admin.product-vouchers.store"]);
        $routes->get('products/(:num)/subs/(:num)/vouchers/create', 'Admin\ProductVoucherController::create/$1/$2', ["as" => "admin.product-vouchers.create"]);
        $routes->get('products/(:num)/subs/(:num)/vouchers/(:num)/edit', 'Admin\ProductVoucherController::edit/$1/$2/$3', ["as" => "admin.product-vouchers.edit"]);
        $routes->put('products/(:num)/subs/(:num)/vouchers/(:num)', 'Admin\ProductVoucherController::update/$1/$2/$3', ["as" => "admin.product-vouchers.update"]);
        $routes->delete('products/(:num)/subs/(:num)/vouchers/(:num)', 'Admin\ProductVoucherController::destroy/$1/$2/$3', ["as" => "admin.product-vouchers.destroy"]);

        $routes->get('products/(:num)/subs', 'Admin\SubProductController::index/$1', ["as" => "admin.sub-products.index"]);
        $routes->post('products/(:num)/subs', 'Admin\SubProductController::store/$1', ["as" => "admin.sub-products.store"]);
        $routes->get('products/(:num)/subs/create', 'Admin\SubProductController::create/$1', ["as" => "admin.sub-products.create"]);
        $routes->get('products/(:num)/subs/(:num)/edit', 'Admin\SubProductController::edit/$1/$2', ["as" => "admin.sub-products.edit"]);
        $routes->put('products/(:num)/subs/(:num)', 'Admin\SubProductController::update/$1/$2', ["as" => "admin.sub-products.update"]);
        $routes->delete('products/(:num)/subs/(:num)', 'Admin\SubProductController::destroy/$1/$2', ["as" => "admin.sub-products.destroy"]);

        $routes->get('products', 'Admin\ProductController::index', ["as" => "admin.products.index"]);
        $routes->get('products/create', 'Admin\ProductController::create', ["as" => "admin.products.create"]);
        $routes->get('products/(:num)/edit', 'Admin\ProductController::edit/$1', ["as" => "admin.products.edit"]);
        $routes->put('products/(:num)', 'Admin\ProductController::update/$1', ["as" => "admin.products.update"]);
        $routes->post('products', 'Admin\ProductController::store', ["as" => "admin.products.store"]);
        $routes->delete('products/(:num)', 'Admin\ProductController::destroy/$1', ["as" => "admin.products.destroy"]);

        $routes->get('galleries', 'Admin\GalleryController::index', ["as" => "admin.galleries.index"]);
        $routes->get('galleries/create', 'Admin\GalleryController::create', ["as" => "admin.galleries.create"]);
        $routes->get('galleries/(:num)/edit', 'Admin\GalleryController::edit/$1', ["as" => "admin.galleries.edit"]);
        $routes->put('galleries/(:num)', 'Admin\GalleryController::update/$1', ["as" => "admin.galleries.update"]);
        $routes->post('galleries', 'Admin\GalleryController::store', ["as" => "admin.galleries.store"]);
        $routes->delete('galleries/(:num)', 'Admin\GalleryController::destroy/$1', ["as" => "admin.galleries.destroy"]);

        $routes->get('wedding-times', 'Admin\WeddingTimeController::index', ["as" => "admin.wedding-times.index"]);
        $routes->get('wedding-times/create', 'Admin\WeddingTimeController::create', ["as" => "admin.wedding-times.create"]);
        $routes->get('wedding-times/(:num)/edit', 'Admin\WeddingTimeController::edit/$1', ["as" => "admin.wedding-times.edit"]);
        $routes->put('wedding-times/(:num)', 'Admin\WeddingTimeController::update/$1', ["as" => "admin.wedding-times.update"]);
        $routes->post('wedding-times', 'Admin\WeddingTimeController::store', ["as" => "admin.wedding-times.store"]);
        $routes->delete('wedding-times/(:num)', 'Admin\WeddingTimeController::destroy/$1', ["as" => "admin.wedding-times.destroy"]);
    });

    $routes->get('/', 'Member\HomeController::index', ["as" => "member.home"]);
    $routes->get('/galleries', 'Member\GalleryController::index', ["as" => "member.gallery.index"]);
    $routes->get('/payments', 'Member\PaymentController::index', ["as" => "member.payments.index"]);
    $routes->get('/product/(:num)/sub/(:num)/booking/(:num)/payment', 'Member\PaymentController::edit/$1/$2/$3', ["as" => "member.payments.edit"]);
    $routes->post('/product/(:num)/sub/(:num)/booking/(:num)/payment', 'Member\PaymentController::store/$1/$2/$3', ["as" => "member.payments.store"]);
    $routes->get('/product/(:num)/sub/(:num)', 'Member\ProductController::index/$1/$2', ["as" => "member.product.detail"]);
    $routes->get('/product/(:num)/sub/(:num)/booking', 'Member\BookingController::index/$1/$2', ["as" => "member.booking.index"]);
    $routes->post('/product/(:num)/sub/(:num)/booking', 'Member\BookingController::store/$1/$2', ["as" => "member.booking.store"]);
    $routes->get('/login', 'Auth\MemberAuthController::login', ["as" => "member.auth.login.index"]);
    $routes->post('/login', 'Auth\MemberAuthController::store', ["as" => "member.auth.login.store"]);

    $routes->get('accounts', 'Member\AccountController::index', ["as" => "member.accounts.index"]);
    $routes->put('accounts/password', 'Member\AccountController::password', ["as" => "member.accounts.password.update"]);

    $routes->get('/register', 'Auth\MemberAuthController::register', ["as" => "member.auth.register.index"]);
    $routes->post('/register', 'Auth\MemberAuthController::doRegister', ["as" => "member.auth.register.store"]);
    $routes->get('/logout', 'Auth\AuthController::logout', ["as" => "logout"]);

    $routes->get('/forget-password', 'Auth\AuthController::forgetPasswordIndex', ["as" => "auth.password.email.index"]);
    $routes->post('/forget-password', 'Auth\AuthController::forgetPasswordStore', ["as" => "auth.password.email.store"]);
    $routes->get('/password', 'Auth\AuthController::passwordIndex', ["as" => "auth.password.index"]);
    $routes->post('/password', 'Auth\AuthController::passwordStore', ["as" => "auth.password.store"]);
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
