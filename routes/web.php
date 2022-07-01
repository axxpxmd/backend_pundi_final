<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function () {
    // Master Role
    Route::prefix('master-roles')->namespace('MasterRole')->name('master-role.')->group(function () {
        // Role
        Route::resource('role', 'RoleController');
        Route::prefix('role')->name('role.')->group(function () {
            Route::post('api', 'RoleController@api')->name('api');
            Route::get('{id}/addPermissions', 'RoleController@permission')->name('addPermissions');
            Route::post('storePermissions', 'RoleController@storePermission')->name('storePermissions');
            Route::get('{id}/getPermissions', 'RoleController@getPermissions')->name('getPermissions');
            Route::delete('{name}/destroyPermission', 'RoleController@destroyPermission')->name('destroyPermission');
        });
        // Permission
        Route::resource('permission', 'PermissionController');
        Route::post('permission/api', 'PermissionController@api')->name('permission.api');
    });

    // Profile
    Route::namespace('Profile')->group(function () {
        Route::resource('profile', 'ProfileController');
        Route::get('profile/{id}/edit-password', 'ProfileController@editPassword')->name('profile.editPassword');
        Route::post('profile/{id}/update-password', 'ProfileController@updatePassword')->name('profile.updatePassword');
    });

    // Master Pengguna
    Route::namespace('MasterPengguna')->group(function () {
        Route::resource('pengguna', 'PenggunaController');
        Route::prefix('pengguna')->name('pengguna.')->group(function () {
            Route::post('api', 'PenggunaController@api')->name('api');
            Route::get('show-data-modal/{id}', 'PenggunaController@showDataModal')->name('showDataModal');
            Route::get('{id}/edit-password', 'PenggunaController@editPassword')->name('editPassword');
            Route::post('{id}/update-password', 'PenggunaController@updatePassword')->name('updatePassword');
        });
    });

    // Master Kategori
    Route::namespace('MasterKategori')->group(function () {
        // Kategori
        Route::resource('kategori', 'KategoriController');
        Route::post('kategori/api', 'KategoriController@api')->name('kategori.api');
        // Sub Kategori
        Route::resource('sub-kategori', 'SubKategoriController');
        Route::post('sub-kategori/api', 'SubKategoriController@api')->name('sub-kategori.api');
        // Judul Section
        Route::resource('judul-section', 'JudulSectionController');
        Route::post('judul-section/api', 'JudulSectionController@api')->name('judul-section.api');
    });

    // Master User
    Route::namespace('MasterUser')->group(function () {
        Route::resource('master-user', 'UserController');
        Route::post('master-user/api', 'UserController@api')->name('master-user.api');
    });

    // Master Article
    Route::namespace('MasterArtikel')->name('artikel.')->group(function () {
        // Artikel
        Route::resource('semua', 'SemuaArtikelController');
        Route::post('semua/api', 'SemuaArtikelController@api')->name('semua.api');
        // Publish
        Route::resource('publish', 'UnverifikasiController');
        Route::post('publish/api', 'UnverifikasiController@api')->name('publish.api');
        Route::post('publish/publish-artikel/{id}', 'UnverifikasiController@publish')->name('publish.publishArticle');
        Route::post('publis/un-publish-artikel/{id}', 'UnverifikasiController@unPublish')->name('publish.unPublishArticle');
        Route::get('publish/sub-category-by-category/{category_id}', 'UnverifikasiController@subCategoryByCategory')->name('publish.subCategoryByCategory');
    });

    // Master Gambar
    Route::namespace('MasterGambar')->name('gambar.')->group(function () {
        // Poster
        Route::resource('poster', 'PosterController');
        Route::post('poster/api', 'PosterController@api')->name('poster.api');
    });

    Route::namespace('MasterKomen')->group(function () {
        Route::resource('komentar', 'KomenController');
        Route::post('komentar/api', 'KomenController@api')->name('komentar.api');
    });

    Route::namespace('MasterKonsultasi')->group(function () {
        Route::resource('konsultasi', 'KonsultasiController');
        Route::post('konsultasi/api', 'KonsultasiController@api')->name('konsultasi.api');
        Route::get('konsultasi/update-status/{id}', 'KonsultasiController@updateStatus')->name('konsultasi.update-status');
    });
});
