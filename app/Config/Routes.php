<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::login');
$routes->get('login', 'Auth::login');
$routes->post('loginprocess', 'Auth::submitlogin');
$routes->get('logout', 'Auth::logout');
$routes->get('csrf-refresh', 'Auth::refreshCsrfToken');

$routes->get('dashboard', 'Home::dashboard');
$routes->get('tambaharsip', 'Home::tambaharsip');
$routes->get('tambahkategori', 'Home::tambahkategori');

// $routes->get('kotak/nomor-kotak', 'KotakPenyimpanan::getNomorKotakTerakhir');
// $routes->get('kotak/nomor-akhir', 'KotakPenyimpanan::getNomorAkhirTerakhir');
// $routes->get('/kotak/tersedia/(:num)', 'KotakPenyimpanan::getNomorTersedia/$1');

$routes->get('kotak/get-nomor-by-tahun', 'KotakPenyimpanan::getNomorByTahun');
$routes->post('/kotak/pesan', 'KotakPenyimpanan::simpanPesanNomor');

$routes->get('/arsipinaktif/recent', 'ArsipInaktif::getRecentAllArsip');

$routes->get('/arsipinaktif/get-boxes-by-year/(:num)', 'ArsipInaktif::getBoxesByYear/$1');
$routes->get('/arsipinaktif/get-info-box/(:num)', 'ArsipInaktif::getInfoBox/$1');
$routes->get('/arsipinaktif/get-options/(:segment)', 'ArsipInaktif::getOptions/$1');
$routes->post('/arsipinaktif/simpan', 'ArsipInaktif::simpan');

$routes->get('templatesurat', 'TemplateSurat::templateSurat');
$routes->get('templatesurat/ambil', 'TemplateSurat::getTemplateBySubKategori');
$routes->post('templatesurat/simpan', 'TemplateSurat::simpanData');


$routes->get('logactivity', 'Home::logactivity');
