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
Auth::routes();
//User
Route::get('/User','Admin\UserController@getview');
Route::get('/Account/Getlist','Admin\UserController@getUser');
Route::post('/Account/PrepareEdit','Admin\UserController@PrepareEdit');
Route::post('/Account/Edit','Admin\UserController@Edit');
Route::post('/Account/Delete','Admin\UserController@Delete');
Route::post('/Account/Add','Admin\UserController@AddNew');

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

//Student
Route::get('/Student','Hieuadmin\StudentController@getview');
Route::get('/Student/Getlist','Hieuadmin\StudentController@getlist');
Route::get('/Student/GetCard','Hieuadmin\StudentController@getcardlist');
Route::post('/Student/PrepareEdit','Hieuadmin\StudentController@PrepareEdit');
Route::post('/Student/Edit','Hieuadmin\StudentController@Edit');
Route::post('/Student/Delete','Hieuadmin\StudentController@Delete');
Route::post('/Student/Add','Hieuadmin\StudentController@AddNew');

//BorrowList
Route::get('/BorrowList','Hieuadmin\BorrowController@getview');
Route::get('/BorrowList/Getlist','Hieuadmin\BorrowController@getlist');
Route::get('/BorrowList/Getdetail','Hieuadmin\BorrowController@getdetaillist');
Route::post('/BorrowList/PrepareEdit','Hieuadmin\BorrowController@PrepareEdit');
Route::post('/BorrowList/Edit','Hieuadmin\BorrowController@Edit');
Route::post('/BorrowList/Delete','Hieuadmin\BorrowController@Delete');
Route::post('/BorrowList/Return','Hieuadmin\BorrowController@Return');
Route::post('/BorrowList/Lost','Hieuadmin\BorrowController@Lost');
Route::post('/BorrowList/Add','Hieuadmin\BorrowController@AddNew');

//LostList
Route::get('/LostList','Hieuadmin\LostController@getview');
Route::get('/LostList/Getlist','Hieuadmin\LostController@getlist');
Route::get('/LostList/GetCard','Hieuadmin\LostController@getcardlist');
Route::post('/LostList/PrepareEdit','Hieuadmin\LostController@PrepareEdit');
Route::post('/LostList/Edit','Hieuadmin\LostController@Edit');
Route::post('/LostList/Delete','Hieuadmin\LostController@Delete');
Route::post('/LostList/Add','Hieuadmin\LostController@AddNew');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
