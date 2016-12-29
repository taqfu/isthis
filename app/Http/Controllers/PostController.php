<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ban;
use App\Comment;
use App\mob;
use App\Moderator;
use \App\Post;
use Auth;
use DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            "title"=>"required|string|max:150",
            "type"=>"required|boolean",
            "url"=>"url",
            "text"=>"string",
            "mobID"=>"required|integer|min:1",
        ]);
        if (Ban::are_they_banned($request->mobID, Auth::user()->id)){
            Ban::response($request->mobID);
        }

        if ((trim($request->url)=="" && trim($request->text)=="")
            || ($request->type && trim($request->text)=="")
            || (!$request->type && trim($request->url)=="")){
            return back()->withErrors('URL or text must be filled out before submititng.');
        }
        $title_url = preg_replace("/\s+/", "-", 
          trim(strtolower(preg_replace("/\p{P}/", " ", $request->title))));
        if (count($title_url)>249){
            $title_url = substr($title_url, 0, 250); 
        }
        $num_of_records = 
          count(DB::select("select * from posts where mob_id=? and substring(title_url, 1, length(?))=?", 
          [$request->mobID, $title_url, $title_url]));
        if ($num_of_records!=0){
            $title_url = $title_url . "-".++$num_of_records;
        }
        $post = new Post;
        if (Auth::user()){
            $post->user_id=Auth::user()->id;
        }
        $post->mob_id = $request->mobID;
        $post->title = $request->title;
        $post->score=1;
        $post->title_url = $title_url;
        
        if ($request->type){
            $post->text = $request->text;
        } else {
            $post->url = $request->url;
        }
        $post->save();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($mob_name, $title_url)
    {
        $mob = Mob::fetch_mob_by_name($mob_name);   
        $posts = Post::where('mob_id', $mob->id)->where('title_url', $title_url)->get();
        if (count ($posts)>1){
           trigger_error("There is more than one post with the $mob_name and $title_url"); 
        } 
        $post = $posts->first();
        return View('Post.show', [
            'post'=>$post,
            'comments'=>Comment::where('post_id', $post->id)->where('level', 0)->get(),
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'newPostText'=>"required|string",
        ]);
        $post = Post::find($id); 
        $post->text = $request->newPostText;
        $post->save();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function tag($id, $tag){
        $post = Post :: find ($id);
        if (Auth::guest()){
            return back()->withErrors("You need to be logged in to do this.");
        }
        if (!Moderator::are_they_a_moderator($post->mob_id)){
            return back()->withErrors("You are not a moderator of this mob.");
        }
        $post->tag = $tag;
        $post->tagger = Auth::user()->id;
        $post->save();
        return back();
    }

}
