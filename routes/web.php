<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes(['register' => false]);


//Admin

Route::resource('dashboard/admin','Dashboard\AdminController');
Route::get('/editPassword/{id}','Dashboard\AdminController@editPassword')->name('editPassword');
Route::post('/updatePassword/{id}','Dashboard\AdminController@updatePassword')->name('updatePassword');
Route::get('/showChangePasswordForm','Auth\ChangePasswordController@showChangePasswordForm')->name('showChangePasswordForm');
Route::post('/changePassword','Auth\ChangePasswordController@changePassword')->name('changePassword');

Route::resource('dashboard/article','Dashboard\ArticleController');
Route::resource('dashboard/post','Dashboard\PostController');
Route::resource('dashboard/video','Dashboard\VideoController');
Route::resource('dashboard/tag','Dashboard\TagController');
