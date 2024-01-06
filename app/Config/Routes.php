<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('/login', 'Home::login');
$routes->get('/logout', 'Home::logout');
$routes->post('/absen', 'Home::absensi');

// Route Admin
$routes->get('/admin', 'Admin::index');
$routes->get('/admin/datasiswa', 'Admin::dataSiswa');
$routes->post('/admin/datasiswa', 'Admin::filterDataSiswa');
$routes->post('/admin/tambahsiswa', 'Admin::tambahDataSiswa');
$routes->post('/admin/ubahsiswa', 'Admin::ubahDataSiswa');
$routes->get('/admin/hapussiswa/(:num)', 'Admin::hapusDataSiswa/$1');
$routes->get('/admin/importdatasiswa', 'Admin::importSiswa');
$routes->post('/admin/importsiswa', 'Admin::importFileSiswa');
$routes->get('/admin/datakelas', 'Admin::dataKelas');
$routes->post('/admin/tambahdatakelas', 'Admin::tambahDataKelas');
$routes->post('/admin/ubahkelas', 'Admin::ubahDataKelas');
$routes->get('/admin/hapuskelas/(:num)', 'Admin::hapusDataKelas/$1');
$routes->get('/admin/dataguru', 'Admin::dataGuru');
$routes->post('/admin/tambahdataguru', 'Admin::tambahDataGuru');
$routes->post('/admin/ubahguru', 'Admin::ubahDataGuru');
$routes->get('/admin/hapusguru/(:num)', 'Admin::hapusDataGuru/$1');
$routes->get('/admin/dataabsen', 'Admin::dataAbsen');
$routes->get('/admin/belumabsen', 'Admin::belumAbsen');
$routes->post('/admin/presensi', 'Admin::presensi');
$routes->get('/admin/invalidcard', 'Admin::invalidCard');
$routes->post('/admin/convertdata', 'Admin::convertInvalidCard');
$routes->get('/admin/laporan', 'Admin::laporan');
$routes->post('/admin/cetaklaporan', 'Admin::cetakLaporan');
$routes->get('/admin/pengaturan', 'Admin::pengaturan');
