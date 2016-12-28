<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ban extends Model
{
    public static function are_they_banned($mob_id, $user_id){
        $bans = Ban::where('user_id', $user_id)->where('mob_id', $mob_id)->get();
        if (count($bans) > 1){
            trigger_error("User #" . $user_id . " was banned twice from mob #" . $mob_id);
        }
        return count($bans)>0;
    }
    public static function response($mob_id){
            trigger_error("User #" . Auth::user()->id . " is banned from Mob #" . $mob_id . " but was still attempting to post.");
            return back->withErrors("You are banned from this Mob.");
    
    }
}
