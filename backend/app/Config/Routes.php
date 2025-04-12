<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->group('api', static function ($routes) {
    // Endpoint Auth (tidak diproteksi, karena user butuh akses register/login)
    $routes->post('register', 'AuthController::register');
    $routes->post('login', 'AuthController::login');
    $routes->get('logout', 'AuthController::logout');

    // Proteksi partlists dengan filter 'auth'
    // $routes->group('', ['filter' => 'auth'], function ($routes) {
    //     // Asumsikan Anda punya ResourceController PartListController
    //     // yang mengelola /api/partlists
    //     $routes->resource('partlists', [
    //         'controller' => 'PartListController'
    //     ]);
    // });

    $routes->resource('partlists', [
        'controller' => 'PartListController'
    ]);
});
