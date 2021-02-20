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
});
