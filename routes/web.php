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

Auth::routes(['register' => false]);

/*
Admin
*/
Route::resource('dashboard/admin','Dashboard\Admin\AdminController');
Route::get('/editPassword/{id}','Dashboard\Admin\AdminController@editPassword')->name('editPassword');
Route::post('/updatePassword/{id}','Dashboard\Admin\AdminController@updatePassword')->name('updatePassword');
Route::get('/showChangePasswordForm','Auth\ChangePasswordController@showChangePasswordForm')->name('showChangePasswordForm');
Route::post('/changePassword','Auth\ChangePasswordController@changePassword')->name('changePassword');

Route::resource('dashboard/article','Dashboard\Article\ArticleController');
Route::resource('dashboard/video','Dashboard\Video\VideoController');