<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use \App\Post;
use Auth;

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
        ]);
        if ((trim($request->url)=="" && trim($request->text)=="")
            || ($request->type && trim($request->text)=="")
            || (!$request->type && trim($request->url)=="")){
            return back()->withErrors('URL or text must be filled out before submititng.');
        }
        $post = new Post;
        if (Auth::user()){
            $post->user_id=Auth::user()->id;
        }
        $post->mob_id = $request->mobID;
        $post->title = $request->title;
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
    public function show($id)
    {
        return View('Post.show', [
            'post'=>Post::find($id),
            'comments'=>Comment::where('post_id', $id)->get(),
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
