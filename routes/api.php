<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});




Route::get('/articles','ArticleController@index');
Route::get('/articles/{id}','ArticleController@show');
Route::get('/articles/search/{search}','ArticleController@search');

Route::get('/posts','PostController@index');
Route::get('/posts/{id}','PostController@show');
Route::get('/posts/search/{search}','PostController@search');

Route::get('/videos','VideoController@index');
Route::get('/videos/search/{search}','VideoController@search');

Route::get('/tags/type/{type}','TagController@index');
Route::get('/types','TagController@types');

Route::post('subscribe','NewsletterController@store');

