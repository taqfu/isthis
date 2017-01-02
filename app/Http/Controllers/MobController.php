<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ban;
use App\mob;
use App\Moderator;
use App\Post;

use Auth;

class MobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View("Mob.index",[
            'mobs'=>Mob::orderBy('name','asc')->get(),
        ]);
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
            "mobName"=>"required|string|max:32|unique:mobs,name|regex:/^[a-zA-Z0-9]+$/"
        ]);
        if (Auth::guest()){
            return back()->withErrors("You need to be logged in to create a mob.");
        }
        $mob = new Mob;
        $mob->name = $request->mobName;
        $mob->creator = Auth::user()->id;
        $mob->save();
        $moderator = new Moderator;
        $moderator->user_id = Auth::user()->id;
        $moderator->mob_id = $mob->id;
        $moderator->save();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $name)
    {
        $mob = Mob::fetch_mob_by_name($name);
        $view_name = (Auth::user() && Ban::are_they_banned($mob->id, Auth::user()->id)) ? "Mob.banned" : "Mob.show";
        $posts = Auth::user() && Moderator::are_they_a_moderator($mob->id) 
          ? Post::where('mob_id', $mob->id)->get() 
          : Post::where('mob_id', $mob->id)->where('tag', null)->get();
        return View($view_name, [
            'posts'=>$posts,
            'mob'=>$mob,
            'moderators'=>Moderator::where('mob_id', $mob->id)->get(),
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
    }
}
