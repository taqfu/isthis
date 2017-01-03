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
use App\Subscription;

Route::get('/', function (){
        $subscriptions = null;
        $posts = Post::where('tag', null)->get();
        $subscribed_mobs=[];
        if (Auth::user()){
            $subscriptions = Subscription::where('user_id', Auth::user()->id)->get();
            if (count($subscriptions)==0){
                return redirect(route('m.index'));
            }
            foreach ($subscriptions as $follow){
                $subscribed_mobs[]=$follow->mob_id;
            }
            
            $posts = Post::whereIn('mob_id', $subscribed_mobs)
              ->orderBy('created_at', 'desc')->where('tag', null)->get();
        } 
        return view('home', [
            'posts'=>$posts,
            'subscriptions'=>$subscriptions,
        ]);

});
        

Auth::routes();
Route::post("/unban", ['as'=>'unban', 'uses'=>'BanController@unban']);

Route::get('/home', 'HomeController@index');
Route::resource('ballot', 'BallotController');
Route::resource('ban', 'BanController');
Route::resource('comment', 'CommentController');
Route::resource('election', 'ElectionController');
Route::resource('judgement', 'JudgementController');
Route::resource('m', 'MobController');
Route::resource('moderator', 'ModeratorController');
Route::resource('post', 'PostController');
Route::resource('subscription', 'SubscriptionController');
Route::resource('user', 'UserController');
Route::resource('vote', 'VoteController');

Route::put('/post/{id}/tag/{tag}', ['as'=>'post.tag', 'uses'=>'PostController@tag']);
Route::put('/comment/{id}/tag/{tag}', ['as'=>'comment.tag', 'uses'=>'CommentController@tag']);
Route::delete('/post/{id}/untag', ['as'=>'post.untag', 'uses'=>'PostController@untag']);
Route::delete('/comment/{id}/untag', ['as'=>'comment.untag', 'uses'=>'CommentController@untag']);
Route::get('/u/{username}/posts', ['as'=>'user.posts', 'uses'=>'UserController@showPosts']);
Route::get('/u/{username}/comments', ['as'=>'user.comments', 'uses'=>'UserController@showComments']);
Route::get('/u/{username}/judgements', ['as'=>'user.judgements', 'uses'=>'UserController@showJudgements']);

Route::get('/m/{mob_name}/{title_url}', ['as'=>'post.show', 'uses'=>'PostController@show']);
