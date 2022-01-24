<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/login','AuthController@login')->name('login');
Route::get('/register','AuthController@register')->name('register');
Route::post('/create','AuthController@daftar')->name('create');
Route::post('/postlogin','AuthController@postlogin');
Route::get('/logout','AuthController@logout');

Route::group(['middleware' => ['auth','checkRole:admin,pemohon']], function () {

    Route::get('/', function () {
        return view('/dashboard');
    });

    Route::get('/dashboard','DashboardController@index');
    //peralihanjualbeli
    Route::get('/peralihanjualbeli','PeralihanJualBeliController@index');
    Route::get('/peralihanjualbeli/index','PeralihanJualBeliController@index');
    Route::get('/peralihanjualbeli/create','PeralihanJualBeliController@create');
    Route::post('/peralihanjualbeli/tambah','PeralihanJualBeliController@tambah');
    Route::get('/peralihanjualbeli/{id}/edit','PeralihanJualBeliController@edit');
    Route::post('/peralihanjualbeli/{id}/update','PeralihanJualBeliController@update');
    Route::get('/peralihanjualbeli/{id}/delete','PeralihanJualBeliController@delete');
    Route::get('/peralihanjualbeli/{id}/reject','PeralihanJualBeliController@reject');
    Route::get('/peralihanjualbeli/{id}/process','PeralihanJualBeliController@process');
    Route::get('/peralihanjualbeli/{id}/resend','PeralihanJualBeliController@resend');
    Route::post('/peralihanjualbeli/{id}/upload','PeralihanJualBeliController@upload');
    Route::get('/peralihanjualbeli/{id}/dokumen','PeralihanJualBeliController@see');
    Route::get('/peralihanjualbeli/tampil','PeralihanJualBeliController@downfunc');
    Route::get('/peralihanjualbeli/{id}/upload-akta','PeralihanJualBeliController@upload_akta');
    Route::post('/peralihanjualbeli/{id}/confirm','PeralihanJualBeliController@confirm');
    //tandaterima
    Route::get('/tandaterima','TandaTerimaController@index');
    Route::get('/tandaterima/index','TandaTerimaController@index');
    Route::get('/tandaterima/create','TandaTerimaController@create');
    Route::post('/tandaterima/tambah','TandaTerimaController@tambah');
    Route::get('/tandaterima/{id}/delete','TandaTerimaController@delete');
    Route::get('/tandaterima/{id}/cetak_pdf', 'TandaTerimaController@cetak_pdf');

    //hibah
    Route::get('/peralihanhibah','PeralihanHibahController@index');
    Route::get('/peralihanhibah/index','PeralihanHibahController@index');
    Route::get('/peralihanhibah/create','PeralihanHibahController@create');
    Route::post('/peralihanhibah/tambah','PeralihanHibahController@tambah');
    Route::get('/peralihanhibah/{id}/edit','PeralihanHibahController@edit');
    Route::post('/peralihanhibah/{id}/update','PeralihanHibahController@update');
    Route::get('/peralihanhibah/{id}/delete','PeralihanHibahController@delete');
     Route::post('/peralihanhibah/{id}/confirm','PeralihanHibahController@confirm');
     Route::get('/peralihanhibah/{id}/upload-akta','PeralihanHibahController@upload_akta');
     Route::get('/peralihanhibah/{id}/reject','PeralihanHibahController@reject');
     Route::get('/peralihanhibah/{id}/process','PeralihanHibahController@process');
     Route::post('/peralihanhibah/{id}/upload','PeralihanHibahController@upload');
     Route::get('/peralihanhibah/{id}/dokumen','PeralihanHibahController@see');
     Route::get('/peralihanhibah/tampil','PeralihanHibahController@downfunc');

 //waris
    Route::get('/peralihanwaris','PeralihanWarisController@index');
    Route::get('/peralihanwaris/index','PeralihanWarisController@index');
    Route::get('/peralihanwaris/create','PeralihanWarisController@create');
    Route::post('/peralihanwaris/tambah','PeralihanWarisController@tambah');
    Route::get('/peralihanwaris/{id}/edit','PeralihanWarisController@edit');
    Route::post('/peralihanwaris/{id}/update','PeralihanWarisController@update');
    Route::get('/peralihanwaris/{id}/delete','PeralihanWarisController@delete');
     Route::post('/peralihanwaris/{id}/confirm','PeralihanWarisController@confirm');
     Route::get('/peralihanwaris/{id}/upload-akta','PeralihanWarisController@upload_akta');
     Route::get('/peralihanwaris/{id}/reject','PeralihanWarisController@reject');
     Route::get('/peralihanwaris/{id}/process','PeralihanWarisController@process');
     Route::post('/peralihanwaris/{id}/upload','PeralihanWarisController@upload');
     Route::get('/peralihanwaris/{id}/dokumen','PeralihanWarisController@see');
     Route::get('/peralihanwaris/tampil','PeralihanWarisController@downfunc');

 //lelang
    Route::get('/peralihanlelang','PeralihanLelangController@index');
    Route::get('/peralihanlelang/index','PeralihanLelangController@index');
    Route::get('/peralihanlelang/create','PeralihanLelangController@create');
    Route::post('/peralihanlelang/tambah','PeralihanLelangController@tambah');
    Route::get('/peralihanlelang/{id}/edit','PeralihanLelangController@edit');
    Route::post('/peralihanlelang/{id}/update','PeralihanLelangController@update');
    Route::get('/peralihanlelang/{id}/delete','PeralihanLelangController@delete');
     Route::post('/peralihanlelang/{id}/confirm','PeralihanLelangController@confirm');
     Route::get('/peralihanlelang/{id}/upload-akta','PeralihanLelangController@upload_akta');
     Route::get('/peralihanlelang/{id}/reject','PeralihanLelangController@reject');
     Route::get('/peralihanlelang/{id}/process','PeralihanLelangController@process');
     Route::post('/peralihanlelang/{id}/upload','PeralihanLelangController@upload');
     Route::get('/peralihanlelang/{id}/dokumen','PeralihanLelangController@see');
     Route::get('/peralihanlelang/tampil','PeralihanLelangController@downfunc');
 //pemberianpembaruan
    Route::get('/pemberianhak','PemberianHakController@index');
    Route::get('/pemberianhak/index','PemberianHakController@index');
    Route::get('/pemberianhak/create','PemberianHakController@create');
    Route::post('/pemberianhak/tambah','PemberianHakController@tambah');
    Route::get('/pemberianhak/{id}/edit','PemberianHakController@edit');
    Route::post('/pemberianhak/{id}/update','PemberianHakController@update');
    Route::get('/pemberianhak/{id}/delete','PemberianHakController@delete');
     Route::post('/pemberianhak/{id}/confirm','PemberianHakController@confirm');
     Route::get('/pemberianhak/{id}/upload-akta','PemberianHakController@upload_akta');
     Route::get('/pemberianhak/{id}/reject','PemberianHakController@reject');
     Route::get('/pemberianhak/{id}/process','PemberianHakController@process');
     Route::post('/pemberianhak/{id}/upload','PemberianHakController@upload');
     Route::get('/pemberianhak/{id}/dokumen','PemberianHakController@see');
     Route::get('/pemberianhak/tampil','PemberianHakController@downfunc');
 //penghapusan
    Route::get('/penghapusanhak','PenghapusanHakController@index');
    Route::get('/penghapusanhak/index','PenghapusanHakController@index');
    Route::get('/penghapusanhak/create','PenghapusanHakController@create');
    Route::post('/penghapusanhak/tambah','PenghapusanHakController@tambah');
    Route::get('/penghapusanhak/{id}/edit','PenghapusanHakController@edit');
    Route::post('/penghapusanhak/{id}/update','PenghapusanHakController@update');
    Route::get('/penghapusanhak/{id}/delete','PenghapusanHakController@delete');
     Route::post('/penghapusanhak/{id}/confirm','PenghapusanHakController@confirm');
     Route::get('/penghapusanhak/{id}/upload-akta','PenghapusanHakController@upload_akta');
     Route::get('/penghapusanhak/{id}/reject','PenghapusanHakController@reject');
     Route::get('/penghapusanhak/{id}/process','PenghapusanHakController@process');
     Route::post('/penghapusanhak/{id}/upload','PenghapusanHakController@upload');
     Route::get('/penghapusanhak/{id}/dokumen','PenghapusanHakController@see');
     Route::get('/penghapusanhak/tampil','PenghapusanHakController@downfunc');
 //suratkuasa
    Route::get('/suratkuasamenjual','SuratKuasaMenjualController@index');
    Route::get('/suratkuasamenjual/index','SuratKuasaMenjualController@index');
    Route::get('/suratkuasamenjual/create','SuratKuasaMenjualController@create');
    Route::post('/suratkuasamenjual/tambah','SuratKuasaMenjualController@tambah');
    Route::get('/suratkuasamenjual/{id}/edit','SuratKuasaMenjualController@edit');
    Route::post('/suratkuasamenjual/{id}/update','SuratKuasaMenjualController@update');
    Route::get('/suratkuasamenjual/{id}/delete','SuratKuasaMenjualController@delete');
     Route::post('/suratkuasamenjual/{id}/confirm','SuratKuasaMenjualController@confirm');
     Route::get('/suratkuasamenjual/{id}/upload-akta','SuratKuasaMenjualController@upload_akta');
     Route::get('/suratkuasamenjual/{id}/reject','SuratKuasaMenjualController@reject');
     Route::get('/suratkuasamenjual/{id}/process','SuratKuasaMenjualController@process');
     Route::post('/suratkuasamenjual/{id}/upload','SuratKuasaMenjualController@upload');
     Route::get('/suratkuasamenjual/{id}/dokumen','SuratKuasaMenjualController@see');
     Route::get('/suratkuasamenjual/tampil','SuratKuasaMenjualController@downfunc');
 //suratkuasa
    Route::get('/suratpernyataanwaris','SuratPernyataanWarisController@index');
    Route::get('/suratpernyataanwaris/index','SuratPernyataanWarisController@index');
    Route::get('/suratpernyataanwaris/create','SuratPernyataanWarisController@create');
    Route::post('/suratpernyataanwaris/tambah','SuratPernyataanWarisController@tambah');
    Route::get('/suratpernyataanwaris/{id}/edit','SuratPernyataanWarisController@edit');
    Route::post('/suratpernyataanwaris/{id}/update','SuratPernyataanWarisController@update');
    Route::get('/suratpernyataanwaris/{id}/delete','SuratPernyataanWarisController@delete');
     Route::post('/suratpernyataanwaris/{id}/confirm','SuratPernyataanWarisController@confirm');
     Route::get('/suratpernyataanwaris/{id}/upload-akta','SuratPernyataanWarisController@upload_akta');
     Route::get('/suratpernyataanwaris/{id}/reject','SuratPernyataanWarisController@reject');
     Route::get('/suratpernyataanwaris/{id}/process','SuratPernyataanWarisController@process');
     Route::post('/suratpernyataanwaris/{id}/upload','SuratPernyataanWarisController@upload');
     Route::get('/suratpernyataanwaris/{id}/dokumen','SuratPernyataanWarisController@see');
     Route::get('/suratpernyataanwaris/tampil','SuratPernyataanWarisController@downfunc');
    //arsip
    Route::get('/arsip-peralihan-hak-jual-beli','ArsipController@jualbeli');
    Route::get('/arsip-peralihan-hak-hibah','ArsipController@hibah');
    Route::get('/arsip-peralihan-hak-waris','ArsipController@waris');
    Route::get('/arsip-peralihan-hak-lelang','ArsipController@lelang');
    Route::get('/arsip-pemberian-pembaruan-hak','ArsipController@pemberianhak');
    Route::get('/arsip-penghapusan-hak','ArsipController@penghapusanhak');
    Route::get('/arsip-surat-kuasa-menjual','ArsipController@suratkuasamenjual');
    Route::get('/arsip-surat-pernyataan-waris','ArsipController@suratpernyataanwaris');
});

Route::group(['middleware' => ['auth','checkRole:admin,pemohon']], function () {
    Route::resource('/instansi','InstansiController');
    Route::resource('/pengguna','PenggunaController');
});
