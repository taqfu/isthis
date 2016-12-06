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

Route::get('/', function () {
    return redirect(route('m.index'));
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::resource('comment', 'CommentController');
Route::resource('judgement', 'JudgementController');
Route::resource('m', 'MobController');
Route::resource('post', 'PostController');
Route::resource('user', 'UserController');
