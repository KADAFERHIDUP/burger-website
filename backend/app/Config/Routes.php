<?php

use CodeIgniter\Router\RouteCollection;
use App\Filters\AdminAuth;

/**
 * @var RouteCollection $routes
 */

// ---------- Halaman publik ----------
$routes->get('/', 'Home::index');
$routes->get('keranjang', 'Cart::index');
$routes->get('checkout', 'Checkout::index');
$routes->get('pesanan/(:segment)', 'Checkout::success/$1');

$routes->group('', ['filter' => 'csrf'], static function ($routes) {
    $routes->post('keranjang/tambah', 'Cart::add');
    $routes->post('keranjang/ubah', 'Cart::update');
    $routes->post('keranjang/hapus/(:num)', 'Cart::remove/$1');
    $routes->post('checkout', 'Checkout::store');
    $routes->post('kontak', 'Contact::send');
    $routes->post('admin/login', 'Auth::attempt');
});

// ---------- Login admin ----------
$routes->get('admin/login', 'Auth::login');
$routes->get('admin/logout', 'Auth::logout');

// ---------- Panel admin (wajib login) ----------
$routes->group('admin', ['filter' => AdminAuth::class], static function ($routes) {
    $routes->get('/', 'Admin\Dashboard::index');

    $routes->get('menu', 'Admin\Menus::index');
    $routes->get('menu/tambah', 'Admin\Menus::new');
    $routes->post('menu', 'Admin\Menus::create');
    $routes->get('menu/(:num)/edit', 'Admin\Menus::edit/$1');
    $routes->post('menu/(:num)', 'Admin\Menus::update/$1');
    $routes->post('menu/(:num)/toggle', 'Admin\Menus::toggle/$1');
    $routes->post('menu/(:num)/hapus', 'Admin\Menus::delete/$1');

    $routes->get('pesanan', 'Admin\Orders::index');
    $routes->get('pesanan/(:num)', 'Admin\Orders::show/$1');
    $routes->post('pesanan/(:num)/status', 'Admin\Orders::updateStatus/$1');

    $routes->get('pesan', 'Admin\Messages::index');
    $routes->post('pesan/(:num)/dibaca', 'Admin\Messages::markRead/$1');
    $routes->post('pesan/(:num)/hapus', 'Admin\Messages::delete/$1');
});
