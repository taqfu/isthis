<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Moderator extends Model
{
    public static function are_they_a_moderator(){
        if (Auth::guest()){
            return false;
        }
        return count(Moderator::where('user_id', Auth::user()->id)->get())>0;
    }
    public static function fetch_moderator_by_user_id_and_mob_id($mob_id, $user_id){
        $moderators = Moderator::where('user_id', Auth::user()->id)->where('mob_id', $mob_id)->get(); 
        if (count ($moderators)>1){
            trigger_error("User #" . Auth::user()->id . " has two moderator slots for Mob #" . $mob_id);
        }
        return $moderators->first();

    }
    public static function fetch_all_moderated_mobs(){
        $mobs = [];
        if (Auth::guest()){
            return false;
        }
        if (!Moderator::are_they_a_moderator()){
            trigger_error("fetch_all_moderated_mobs() called when user #" . Auth::user()->id . " is not a moderator.");
        }
        foreach (Moderator::where('user_id', Auth::user()->id)->get() as $moderator){
            $mobs[] = $moderator->mob;
        }
        return $mobs;
    }
    public function mob(){
        return $this->belongsTo('\App\mob');
    }
    public static function remove($id){
        $moderator = Moderator::find($id);
        $moderator->delete();
        return back();
    }
    public function user(){
        return $this->belongsTo('\App\User');
    }
}
