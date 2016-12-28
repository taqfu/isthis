<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ban;
use App\Moderator;

use Auth;

class BanController extends Controller
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
            'user_id'=>'required|integer|min:1',
            'mob_id'=>'required|integer|min:1',
        ]);
        $moderator = Moderator::fetch_moderator_by_user_id_and_mob_id($request->mob_id, $request->user_id);
        $ban = new Ban;
        $ban->user_id = $request->user_id;
        $ban->mob_id = $request->mob_id;
        $ban->moderator_id = $moderator->id;
        $ban->save();
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
    public function destroy($id){
    }
    public function unban(Request $request)
    {
        $bans = Ban::where('user_id', $request->user_id)->where('mob_id', $request->mob_id)->get(); 
        if(count($bans)>1){
            trigger_error("User #" . $request->user_id . " has more than one ban for Mob #" . $request->mob_id );
        }
        $bans->first()->delete();
        return back();
    }

}
