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

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function (){
    Route::resource('user', 'UserController');

    Route::resource('roles', 'RoleListController');

    Route::resource('users', 'UserListController');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('verifyEmail', 'Auth\RegisterController@verifyEmail')->name('verifyEmail');

Route::get('verify/{email}/{verify_token}', 'Auth\RegisterController@emailDone')->name('emailDone');

