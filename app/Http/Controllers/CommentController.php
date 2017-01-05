<?php

namespace App\Http\Controllers;

use Auth;
use App\Ban;
use App\Comment;
use App\Moderator;
use App\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
            "text"=>"required|string",
            "replyTo"=>"required|integer|min:0",
            "postID"=>"required|integer|min:0",
        ]);
        $post = Post::find($request->postID);
        if (Ban::are_they_banned($post->mob->id, Auth::user()->id)){
            Ban::response($post->mob->id);
        }
 
        if ($request->replyTo>0){
            $reply = Comment::find($request->replyTo);
        }
        $comment = new Comment; 
        $comment->text = $request->text;
        $comment->reply_to = $request->replyTo;
        $comment->post_id = $request->postID;
        $comment->user_id = Auth::user() ? Auth::user()->id : 0; 
        $comment->score = Auth::user() ? 1 : 0;
        $comment->level = isset($reply) ? $reply->level+1 : 0; 
        $comment->save();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comment = Comment::find($id);
        return View('Comment.index', [
            'comment'=>$comment,
            'post'=>Post::find($comment->post_id),
            'with_replies'=>true,
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
            'newText'=>'required|string|max:20000', 
        ]);
        $comment = Comment::find($id);
        $comment->text = $request->newText;
        $comment->save();
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
        $comment = Comment::find($id);
        if (Auth::guest()){
            return back()->withErrors("You need to be logged in to do this.");
        }
        if (Auth::user()->id != $comment->user_id){
            return back()->withErrors("You are not the owner.");
        }
        $comment->user_id =  0;
        $comment->save();
        return back();
    }
    public function tag($id, $tag){
        $comment = Comment :: find ($id);
        if (Auth::guest()){
            return back()->withErrors("You need to be logged in to do this.");
        }
        if (!Moderator::are_they_a_moderator($comment->post->mob_id)){
            return back()->withErrors("You are not a moderator of this mob.");
        }
        $comment->tag = $tag;
        $comment->tagger = Auth::user()->id;
        $comment->save();
        return back();
    }
    public function untag($id){
        $comment = Comment :: find ($id);
        if (Auth::guest()){
            return back()->withErrors("You need to be logged in to do this.");
        }
        if (!Moderator::are_they_a_moderator($comment->post->mob_id)){
            return back()->withErrors("You are not a moderator of this mob.");
        }
        $comment->tag = null;
        $comment->tagger = null;
        $comment->save();
        return back();
        
    }
}
