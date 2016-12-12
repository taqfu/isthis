<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Vote;
use App\Comment;
use App\Post;

class VoteController extends Controller
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
            'vote'=>'required|boolean',
            'tableRef'=>'required|string',
            'tableID'=>'required|integer:min:1',  
        ]);
        if ($request->tableRef!="post" && $request->tableRef!="comment"){
            trigger_error("tableRef request was not post or comment : $request->tableRef");
            return back()->withErrors("This is not a valid way to vote."); 
        }
        $vote = new Vote;
        $vote->table_ref = $request->tableRef;
        $vote->table_id = $request->tableID;
        $vote->up = (boolean) $request->vote;
        $vote->user_id = Auth::user()->id;
        $vote->save();
        if ($request->tableRef=="post"){
            Post::update_score($request->tableID);
        } else if ($request->tableRef=="comment"){
            Comment::update_score($request->tableID);
        }
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
            'vote'=>'required|boolean',
        ]);
        $vote = Vote::find($id);
        $vote->up = $request->vote;
        $vote->save();
        if ($vote->table_ref=="post"){
            Post::update_score($vote->table_id);
        } else if ($vote->table_ref=="comment"){
            Comment::update_score($vote->table_id);
        }
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
}
