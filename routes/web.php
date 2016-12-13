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
use App\Comment;
use App\mob;
use App\Post;

Route::get('/', function (){
        return view('home', [
            'posts'=>Post::get(),
        ]);

});
        

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::resource('comment', 'CommentController');
Route::resource('judgement', 'JudgementController');
Route::resource('m', 'MobController');
Route::resource('post', 'PostController');
Route::resource('user', 'UserController');
Route::resource('vote', 'VoteController');
Route::get('/u/{username}/posts', ['as'=>'user.posts', 'uses'=>'UserController@showPosts']);
Route::get('/u/{username}/comments', ['as'=>'user.comments', 'uses'=>'UserController@showComments']);

Route::get('/m/{mob_name}/{title_url}', ['as'=>'post.show', 'uses'=>'PostController@show']);
