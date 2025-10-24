<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('absen/simpan', 'Home::simpan');
$routes->get('dashboard', 'Dashboard::index');
$routes->get('pegawai', 'Pegawai::index');
$routes->get('pegawai/tambah', 'Pegawai::tambah');
$routes->post('pegawai/insert', 'Pegawai::insert');
$routes->get('pegawai/edit/(:num)', 'Pegawai::edit/$1');
$routes->post('pegawai/update/(:num)', 'Pegawai::update/$1');
$routes->get('pegawai/delete/(:num)', 'Pegawai::delete/$1');
$routes->get('login', 'Login::login');
$routes->post('login/cekLogin', 'Login::cekLogin');
$routes->get('logout', 'Login::logout');
$routes->get('/absensi', 'Absensi::index');
$routes->post('/absensi/tambah', 'Absensi::tambah');
$routes->get('absensi/insert', 'Absensi::insert');
$routes->get('absensi/tandaitidakhadir', 'Absensi::tandaiTidakHadirHariIni');
$routes->get('qrcodepegawai', 'QrcodePegawai::index');
$routes->get('qrcodepegawai/generate/(:segment)', 'QrcodePegawai::generate/$1');
$routes->get('absensi/detail/(:num)', 'Absensi::detail/$1');
$routes->get('laporanabsen', 'LaporanAbsen::index');
$routes->get('laporanabsen/detail/(:num)', 'LaporanAbsen::detail/$1');
$routes->get('cetak-pdf', 'LaporanAbsen::cetak_pdf');
$routes->get('user/profil/(:num)', 'User::Profil/$1');
$routes->post('user/UpdateData/(:num)', 'User::UpdateData/$1');
