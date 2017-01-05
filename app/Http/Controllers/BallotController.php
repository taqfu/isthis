<?php

namespace App\Http\Controllers;

use App\Ballot;
use App\Election;
use App\mob;
use App\Moderator;
use App\Subscription;
use App\User;
use Auth;
use Illuminate\Http\Request;

class BallotController extends Controller
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
        if (Auth::guest()){
            return View('Ballot.errors.guest');
        }
        $subscriptions = Subscription::where('user_id', Auth::user()->id)->get();

        if (count($subscriptions)==0){
            return View('Ballot.errors.noSubscriptions');
        }
        return View('Ballot.create', [
            'subscriptions'=>$subscriptions,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::guest()){
            trigger_error("Guest is attempting to create a ballot.");
            return;
        }

        $this->validate($request, [
            "mob_id"=>"required|integer|min:1",
            "measure"=>"required|string",
        ]);

        $mob = Mob::find($request->mob_id);
        if ($mob==null){
            trigger_error("User #" . Auth::user()->id . " tried to create a ballot for a mob #" . $request->mob_id . ", which does not exist."); 
        }

        if ( Subscription::fetch_subscription($request->mob_id) == 0){
            trigger_error("User #" . Auth::user()->id . " is not subscribed to Mob #" . $request->mob_id);
        }

        $valid_measures = ["ban user", "change days for election",  "change num of mods", "new mod", "new rule", "remove mod", "remove rule",  "change anonymity"];
        if (!in_array($request->measure, $valid_measures)){
            trigger_error("User #" . Auth::user()->id . " is attempting to create a ballot for Mob #". $request->mob_id . " with an invalid measure " . $request->measure);
        }
        if ($request->measure=="ban user" || $request->measure=="new mod" 
          || $request->measure == "remove mod"){
            $user = User::fetch_user_by_username($request->info); 
            if ($user==null){
                return back()->withErrors("'" . $request->info . "' is not a valid username.");
            }

            if ($request->measure == "ban user" && Ban::are_they_banned($request->mob_id, 
              $request->info)){
                return back()->withErrors("'" . $request->info . " is already banned.");
            } else if ($request->measure == "remove mod"){
                $moderator = Moderator::fetch_moderator_by_user_id_and_mob_id($request->mob_id, 
                  $user->id);
                if ($moderator==null){
                    return back()->withErrors("'" . $request->info . " is not a moderator.");
                }
            } else if ($request->measure == "new mod"){
                $mob = Mob::find($request->mob_id);
                $num_of_moderators = Moderator :: fetch_num_of_moderators($request->mob_id);
                if ($num_of_moderators<$mob->num_of_moderators){

                }
            }
        }
        $election_id = Election::fetch_next($request->mob_id)->id;

        $ballot = new Ballot; 
        $ballot->election_id = $election_id;
        $ballot->measure = $request->measure;
        $ballot->info = $request->info;
        $ballot->creator = Auth::user()->id;
        $ballot->save();
        return redirect(route('election.show', ['id'=>$election_id]));
     
        
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
    public function destroy($id)
    {
        //
    }
}
