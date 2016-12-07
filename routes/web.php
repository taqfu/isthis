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
Route::get('/u/{username}/posts', ['as'=>'user.posts', 'uses'=>'UserController@showPosts']);
Route::get('/u/{username}/comments', ['as'=>'user.comments', 'uses'=>'UserController@showComments']);

Route::get('/m/{mob_name}/{title_url}', ['as'=>'post.show',  function($mob_name, $title_url){
    $mob = Mob::fetch_mob_by_name($mob_name);   
    $posts = Post::where('mob_id', $mob->id)->where('title_url', $title_url)->get();
    if (count ($posts)>1){
       trigger_error("There is more than one post with the $mob_name and $title_url"); 
    } 
    $post = $posts->first();
    return View('Post.show', [
        'post'=>$post,
        'comments'=>Comment::where('post_id', $post->id)->get(),
    ]);
}]);
