<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->setAutoRoute(false);

// ==========================
// ROUTES UNTUK HALAMAN UTAMA (PUBLIC)
// ==========================
$routes->get('/', 'Home::index');

// Tentang GESID
$routes->get('about', 'Home::about');
$routes->get('latar-belakang', 'Home::latarBelakang');
$routes->get('visi-misi', 'Home::visiMisi');
$routes->get('pengurus-bpn', 'Home::pengurusBpn');

// Artikel
// $routes->get('artikel', 'Home::artikel');
// $routes->get('artikel-kategori/(:num)', 'Home::artikelkategori/$1');
// $routes->get('artikel-detail/(:num)/(:num)', 'Home::detailKategori/$1/$2');
// $routes->get('artikel-detail/(:num)', 'Home::artikelDetail/$1');

// Event
$routes->get('event', 'Home::event');

// Member
$routes->get('halaman-member', 'Home::halamanMember');
$routes->get('cara-daftar', 'Home::caraDaftar');
// $routes->get('formulir-pendaftaran', 'Home::formulirPendaftaran');

// Contact & Login
$routes->get('contact', 'Home::contact');
$routes->get('login', 'Home::login');




// ==========================
// MEMBER AREA
// ==========================
$routes->get('member', 'Home::member'); // member_index.php
$routes->get('cara', 'Member::caraDaftar');
$routes->get('formulir', 'Home::formulir'); // member_formulir_pendaftaran.php
$routes->get('data', 'Home::dataMember'); // member_data.php


/// ==========================
// ROUTES UNTUK MEMBER
// ==========================
$routes->group('member', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/', 'MemberController::index');
    $routes->get('dashboard', 'MemberController::dashboard');
    $routes->get('view/(:num)', 'MemberController::view/$1');
    $routes->get('activate/(:num)', 'MemberController::activate/$1');
    $routes->get('deactivate/(:num)', 'MemberController::deactivate/$1');

    // Aduan
    $routes->get('aduan', 'MemberController::aduanForm');
    $routes->post('aduan', 'MemberController::kirimAduan');

    $routes->get('profil', 'MemberController::profile');
    $routes->post('profil/update', 'MemberController::updateProfile');

    $routes->get('respons', 'MemberController::respons');

});
// ==========================
// ARTIKEL
// ==========================
$routes->get('/artikel', 'Artikel::index');
$routes->get('/artikel-kategori/(:num)', 'Artikel::kategori/$1');
$routes->get('/artikel/detail/(:num)', 'Artikel::detail/$1');


// ==========================
// KONTAK & LOGIN
// ==========================
$routes->get('kontak', 'Home::kontak'); // kontak_index.php
$routes->get('login', 'Home::login'); // auth_login.php

// ==========================
// ROUTES UNTUK ADMIN
// ==========================

// Login & Logout Admin
$routes->get('admin/login', 'Auth::login');
$routes->post('admin/loginPost', 'Auth::loginPost');
$routes->get('admin/logout', 'Admin::logout');
$routes->get('/logout', 'Admin::logout');

// Dashboard
$routes->get('admin/dashboard', 'Admin::dashboard');



// Manajemen Member
$routes->get('admin/member', 'Admin::manageMember');
$routes->get('admin/create', 'Admin::createMember');
$routes->post('admin/store', 'Admin::storeMember');
$routes->get('admin/edit/(:num)', 'Admin::editMember/$1');
$routes->post('admin/update/(:num)', 'Admin::updateMember/$1');
$routes->get('admin/delete/(:num)', 'Admin::deleteMember/$1');

// Verifikasi Member BPN
$routes->get('bpnadmin/verifikasi', 'Admin::verifikasiMember'); // tampilkan semua member
$routes->get('bpnadmin/verifikasi/activate/(:num)', 'MemberController::activate/$1');
$routes->get('bpnadmin/verifikasi/deactivate/(:num)', 'MemberController::deactivate/$1');

// ==========================
// PENDAFTARAN MEMBER
// ==========================
$routes->get('formulir-pendaftaran', 'Register::index'); // Formulir awal
$routes->post('formulir', 'Register::saveFinalRegistration');
$routes->get('formulir/akun', 'Register::akun');
$routes->post('formulir/submit', 'Register::submit');
$routes->get('formulir/selesai', 'Register::selesai');

// ==========================
// HALAMAN ADMIN BERDASARKAN ROLE
// ==========================
// $routes->get('superadminadmin', 'Admin::superadmin');
$routes->get('bpnadmin', 'Admin\Bpn::dashboard');
$routes->get('bpwadmin', 'Admin::bpw');
// $routes->get('bpdadmin', 'Admin\Bpd::dashboard');
$routes->get('bpdesadmin', 'Admin::bpdes');

$routes->get('member', 'MemberController::dashboard');


// ==========================
// AJAX WILAYAH (Dropdown Berantai)
// ==========================
$routes->group('wilayah', function ($routes) {
    $routes->get('kota/(:num)', 'Wilayah::getKota/$1');
    $routes->get('kecamatan/(:num)', 'Wilayah::getKecamatan/$1');
    $routes->get('desa/(:num)', 'Wilayah::getDesa/$1');
});

// ==========================
// ROUTE KHUSUS SUPERADMIN
// ==========================
// $routes->get('superadmin/dashboard', 'Superadmin\Dashboard::index');
$routes->group('admin/superadmin', ['namespace' => 'App\Controllers\admin'], function ($routes) {
    $routes->get('/', 'superadmin::dashboard'); // akses via /admin/bpn
    $routes->get('data-member', 'superadmin::dataMember');
});
$routes->group('admin/superadmin', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('verifikasi-artikel', 'VerifikasiArtikel::index');
    $routes->get('verifikasi-artikel/approve/(:num)', 'VerifikasiArtikel::approve/$1');
    $routes->get('verifikasi-artikel/reject/(:num)', 'VerifikasiArtikel::reject/$1');
    $routes->get('verifikasi-acara', 'VerifikasiAcara::index');
    $routes->get('verifikasi-acara/approve/(:num)', 'VerifikasiAcara::approve/$1');
    $routes->get('verifikasi-acara/reject/(:num)', 'VerifikasiAcara::reject/$1');
});


$routes->group('admin/superadmin', ['namespace' => 'App\Controllers\admin\TambahAdmin'], function ($routes) {

    $routes->get('adminbpn', 'BpnController::index');
    $routes->get('adminbpn/create', 'BpnController::create');
    $routes->post('adminbpn/store', 'BpnController::store');
    $routes->get('adminbpn/edit/(:num)', 'BpnController::edit/$1');
    $routes->post('adminbpn/update/(:num)', 'BpnController::update/$1');
    $routes->get('adminbpn/delete/(:num)', 'BpnController::delete/$1');
});
// ==========================
// BPN ADMIN AREA
// ==========================
$routes->group('admin/bpn', ['namespace' => 'App\Controllers\admin'], function ($routes) {
    $routes->get('/', 'Bpn::index'); // akses via /admin/bpn
    $routes->get('data-member', 'Bpn::dataMember');
    // $routes->get('dashboard', 'Bpn::dashboard'); // akses via /admin/bpn/dashboard
    $routes->get('verifikasi-member', 'Bpn::verifikasiMember');
    $routes->get('artikel', 'Bpn::indexArtikel');
    $routes->get('buat-artikel', 'Bpn::buatArtikel');
    $routes->post('simpan-artikel', 'Bpn::simpanArtikel');
    $routes->get('edit-artikel/(:num)', 'Bpn::editArtikel/$1');
    $routes->post('update-artikel/(:num)', 'Bpn::updateArtikel/$1');
    $routes->post('delete-artikel/(:num)', 'Bpn::deleteArtikel/$1');
    $routes->get('acara', 'Bpn::indexAcara');
    $routes->get('buat-acara', 'Bpn::buatAcara');
    $routes->post('simpan-acara', 'Bpn::simpanAcara');
    $routes->get('edit-acara/(:num)', 'Bpn::editAcara/$1');
    $routes->post('update-acara/(:num)', 'Bpn::updateAcara/$1');
    $routes->post('delete-acara/(:num)', 'Bpn::deleteAcara/$1');
    // $routes->get('aduan', 'Bpn::listAduan');
    // $routes->get('admin/adminbpn', 'Bpn::listAduan');

});

$routes->group('admin/bpn', ['namespace' => 'App\Controllers\admin\TambahAdmin'], function ($routes) {
    $routes->get('adminbpw', 'BpwController::index');
    $routes->get('adminbpw/create', 'BpwController::create');
    $routes->post('adminbpw/store', 'BpwController::store');
    $routes->get('adminbpw/edit/(:num)', 'BpwController::edit/$1');
    $routes->post('adminbpw/update/(:num)', 'BpwController::update/$1');
    $routes->get('adminbpw/delete/(:num)', 'BpwController::delete/$1');

});

// ==========================
// BPD ADMIN AREA
// ==========================
$routes->group('admin/bpd', ['namespace' => 'App\Controllers\admin'], function ($routes) {
    $routes->get('/', 'Bpd::index');
    $routes->get('data-member', 'Bpd::dataMember');
    // $routes->get('dashboard', 'Bpd::dashboard');
    // $routes->get('verifikasi-member', 'Bpd::verifikasiMember');
    $routes->get('aduan', 'Bpd::listAduan');
    // $routes->post('aduan/kirim', 'Bpd::kirimAduan');
    $routes->post('kirimRespons/(:num)', 'Bpd::kirimRespons/$1');
    $routes->get('artikel', 'Bpd::indexArtikel');
    $routes->get('buat-artikel', 'Bpd::buatArtikel');
    $routes->post('simpan-artikel', 'Bpd::simpanArtikel');
    $routes->get('edit-artikel/(:num)', 'Bpd::editArtikel/$1');
    $routes->post('update-artikel/(:num)', 'Bpd::updateArtikel/$1');
    $routes->post('delete-artikel/(:num)', 'Bpd::deleteArtikel/$1');
    $routes->get('acara', 'Bpd::indexAcara');
    $routes->get('buat-acara', 'Bpd::buatAcara');
    $routes->post('simpan-acara', 'Bpd::simpanAcara');
    $routes->get('edit-acara/(:num)', 'Bpd::editAcara/$1');
    $routes->post('update-acara/(:num)', 'Bpd::updateAcara/$1');
    $routes->post('delete-acara/(:num)', 'Bpd::deleteAcara/$1');
});

$routes->group('admin/bpd', ['namespace' => 'App\Controllers\admin\TambahAdmin'], function ($routes) {
    $routes->get('adminbpdes', 'BpdesController::index');
    $routes->get('adminbpdes/create', 'BpdesController::create');
    $routes->post('adminbpdes/store', 'BpdesController::store');
    $routes->get('adminbpdes/edit/(:num)', 'BpdesController::edit/$1');
    $routes->post('adminbpdes/update/(:num)', 'BpdesController::update/$1');
    $routes->get('adminbpdes/delete/(:num)', 'BpdesController::delete/$1');

    $routes->get('adminbpdes/desa-by-kecamatan/(:num)', 'BpdesController::desaByKecamatan/$1');

});


// ==========================
// BPW ADMIN AREA
// ==========================
$routes->group('admin/bpw', ['namespace' => 'App\Controllers\admin'], function ($routes) {
    $routes->get('/', 'Bpw::index');
    $routes->get('data-member', 'Bpw::dataMember');
    $routes->get('artikel', 'Bpw::indexArtikel');
    $routes->get('buat-artikel', 'Bpw::buatArtikel');
    $routes->post('simpan-artikel', 'Bpw::simpanArtikel');
    $routes->get('edit-artikel/(:num)', 'Bpw::editArtikel/$1');
    $routes->post('update-artikel/(:num)', 'Bpw::updateArtikel/$1');
    $routes->post('delete-artikel/(:num)', 'Bpw::deleteArtikel/$1');
    $routes->get('acara', 'Bpw::indexAcara');
    $routes->get('buat-acara', 'Bpw::buatAcara');
    $routes->post('simpan-acara', 'Bpw::simpanAcara');
    $routes->get('edit-acara/(:num)', 'Bpw::editAcara/$1');
    $routes->post('update-acara/(:num)', 'Bpw::updateAcara/$1');
    $routes->post('delete-acara/(:num)', 'Bpw::deleteAcara/$1');
});

$routes->group('admin/bpw', ['namespace' => 'App\Controllers\admin\TambahAdmin'], function ($routes) {
    $routes->get('adminbpd', 'BpdController::index');
    $routes->get('adminbpd/create', 'BpdController::create');
    $routes->post('adminbpd/store', 'BpdController::store');
    $routes->get('adminbpd/edit/(:num)', 'BpdController::edit/$1');
    $routes->post('adminbpd/update/(:num)', 'BpdController::update/$1');
    $routes->get('adminbpd/delete/(:num)', 'BpdController::delete/$1');

});

// ==========================
// BPDES ADMIN AREA
// ==========================
$routes->group('admin/bpdes', ['namespace' => 'App\Controllers\admin'], function ($routes) {
    $routes->get('/', 'Bpdes::index');
    $routes->get('data-member', 'Bpdes::dataMember');
    // $routes->get('dashboard', 'Bpdes::dashboard');
    // $routes->get('verifikasi-member', 'Bpdes::verifikasiMember');
    $routes->get('aduan', 'Bpdes::listAduan');
    $routes->post('aduan/kirim', 'Bpdes::kirimAduan');
    $routes->get('artikel', 'Bpdes::indexArtikel');
    $routes->get('buat-artikel', 'Bpdes::buatArtikel');
    $routes->post('simpan-artikel', 'Bpdes::simpanArtikel');
    $routes->get('edit-artikel/(:num)', 'Bpdes::editArtikel/$1');
    $routes->post('update-artikel/(:num)', 'Bpdes::updateArtikel/$1');
    $routes->post('delete-artikel/(:num)', 'Bpdes::deleteArtikel/$1');
    $routes->get('acara', 'Bpdes::indexAcara');
    $routes->get('buat-acara', 'Bpdes::buatAcara');
    $routes->post('simpan-acara', 'Bpdes::simpanAcara');
    $routes->get('edit-acara/(:num)', 'Bpdes::editAcara/$1');
    $routes->post('update-acara/(:num)', 'Bpdes::updateAcara/$1');
    $routes->post('delete-acara/(:num)', 'Bpdes::deleteAcara/$1');


});



$routes->get('admin/data-member/(:num)', 'Admin\Bpn::reviewMember/$1');
$routes->get('bpnadmin/verifikasi', 'Admin\Bpn::verifikasiMember');
$routes->get('/logout', 'Auth::logout');
$routes->get('member/activate/(:num)', 'MemberController::activate/$1');
$routes->get('member/deactivate/(:num)', 'MemberController::deactivate/$1');
$routes->get('memberadmin', 'MemberController::dashboard');


$routes->group('admin', function ($routes) {
    $routes->get('slider', 'SliderController::index');
    $routes->get('slider/create', 'SliderController::create');
    $routes->post('slider/store', 'SliderController::store');
    $routes->get('slider/edit/(:num)', 'SliderController::edit/$1');
    $routes->post('slider/update/(:num)', 'SliderController::update/$1');
    $routes->get('slider/delete/(:num)', 'SliderController::delete/$1');
});
// File: app/Config/Routes.php
$routes->get('admin/selayang-pandang', 'SelayangController::index'); // Tampilkan semua data
$routes->get('admin/selayang-pandang/create', 'SelayangController::create'); // Form tambah data
$routes->post('admin/selayang-pandang/store', 'SelayangController::store'); // Simpan data baru
$routes->get('admin/selayang-pandang/edit/(:num)', 'SelayangController::edit/$1'); // Form edit data
$routes->post('admin/selayang-pandang/update/(:num)', 'SelayangController::update/$1'); // Simpan perubahan
$routes->get('admin/selayang-pandang/delete/(:num)', 'SelayangController::delete/$1'); // Hapus data



// FRONTEND
$routes->get('/visi-misi', 'VisiMisiController::index');

// ADMIN
$routes->get('/admin/visi-misi', 'VisiMisiController::adminIndex');
$routes->get('/admin/visi-misi/edit', 'VisiMisiController::edit');
$routes->post('/admin/visi-misi/update', 'VisiMisiController::update');


// Frontend
$routes->get('/pengurus', 'PengurusController::index');

// Admin

$routes->get('/', 'SelayangController::homeSelayang'); // halaman utama



$routes->get('event', 'Home::event');
$routes->group('admin/events', function ($routes) {
    $routes->get('/', 'EventController::index');                      // Tampilkan semua event
    $routes->get('create', 'EventController::create');               // Form tambah event
    $routes->post('store', 'EventController::store');               // Proses simpan event baru

    $routes->get('edit/(:num)', 'EventController::edit/$1');         // Form edit event
    $routes->post('update/(:num)', 'EventController::update/$1');    // Proses update event

    $routes->post('delete/(:num)', 'EventController::delete/$1');    // Proses hapus event
    $routes->get('show/(:num)', 'EventController::show/$1');         // Tampilkan detail event

    $routes->get('event', 'EventController::index');






});



