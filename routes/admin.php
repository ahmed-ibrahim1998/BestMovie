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

Route::get('/', 'HomeController@index')->name('dashboard');

Route::group(['prefix' => '/'], function () {
    Auth::routes();
});


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale() . '/',
        'middleware' => ['localizationRedirect', 'localeViewPath', 'localeSessionRedirect', 'auth']
    ], function () {

    Route::get('/dashboard', 'HomeController@index')->name('dashboard');

    //==============================================Dashboard==========================================
    Route::group(['namespace' => 'Admin', 'middleware' => ['auth']], function () {


        // User And Roles And Permissions
        Route::resource('users', 'UserController');
        Route::put('users/change-status/{id}', 'UserController@changeStatus')->name('changeStatus');
        Route::resource('roles', 'RoleController');
        Route::resource('permissions', 'PermissionController');
    });

});
