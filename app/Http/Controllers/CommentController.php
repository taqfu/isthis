<?php

namespace App\Http\Controllers;

use Auth;
use App\Comment;
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
        if ($request->replyTo>0){
            $reply = Comment::find($request->replyTo);
        }
        $comment = new Comment; 
        $comment->text = $request->text;
        $comment->reply_to = $request->replyTo;
        $comment->post_id = $request->postID;
        $comment->user_id = Auth::user() ? Auth::user()->id : 0; 
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
        //
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
}
