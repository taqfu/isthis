<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mob;
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
            'mobs'=>Mob::get(),
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
            "mobName"=>"required|string|max:255|unique:mobs,name"
        ]);
        if (Auth::guest()){
            return back()->withErrors("You need to be logged in to create a mob.");
        }
        $mob = new Mob;
        $mob->name = $request->mobName;
        $mob->creator = Auth::user()->id;
        $mob->save();
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
        return View('Mob.show', [
            'posts'=>Post::where('mob_id', $id)->get(),
            'mob_id'=>$id,
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
