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
Route::group(['middleware' => 'locale'], function() {
	Route::get('change-language/{language}', 'Admin\HomeController@ChangeLanguage') ->name('user.change-language');
});
Route::get('/', function () {
    return view('welcome');
});
//User
Route::get('/Hellowebsite','Admin\HelloController@getHello');
Route::get('/GetListCategory','Admin\HelloController@getCategory');
Route::post('/Account/PrepareEdit','Admin\HelloController@PrepareEdit');
Route::post('/Account/Edit','Admin\HelloController@Edit');
Route::post('/Account/Delete','Admin\HelloController@Delete');
Route::post('/Account/Add','Admin\HelloController@AddNew');

//Book
Route::get('/Book','Hieuadmin\BookController@getview');
Route::get('/Book/Getlist','Hieuadmin\BookController@getlist');
Route::get('/Book/GetGenre','Hieuadmin\BookController@getgenrelist');
Route::post('/Book/PrepareEdit','Hieuadmin\BookController@PrepareEdit');
Route::post('/Book/Edit','Hieuadmin\BookController@Edit');
Route::post('/Book/Delete','Hieuadmin\BookController@Delete');
Route::post('/Book/Add','Hieuadmin\BookController@AddNew');

//Genre
Route::get('/Genre','Hieuadmin\GenreController@getview');
Route::get('/Genre/Getlist','Hieuadmin\GenreController@getlist');
Route::post('/Genre/PrepareEdit','Hieuadmin\GenreController@PrepareEdit');
Route::post('/Genre/Edit','Hieuadmin\GenreController@Edit');
Route::post('/Genre/Delete','Hieuadmin\GenreController@Delete');
Route::post('/Genre/Add','Hieuadmin\GenreController@AddNew');

//Card
Route::get('/Card','Hieuadmin\CardController@getview');
Route::get('/Card/Getlist','Hieuadmin\CardController@getlist');
Route::post('/Card/PrepareEdit','Hieuadmin\CardController@PrepareEdit');
Route::post('/Card/Edit','Hieuadmin\CardController@Edit');
Route::post('/Card/Delete','Hieuadmin\CardController@Delete');
Route::post('/Card/Add','Hieuadmin\CardController@AddNew');