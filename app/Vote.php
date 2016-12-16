<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Vote extends Model
{
    public static function fetch_vote($table_ref, $id){
        if (Auth::guest()){
            return null;
        }
        $votes = Vote::where('user_id', Auth::user()->id)->where('table_ref', $table_ref)->where('table_id', $id)->get();
        if (count($votes)>1){
            trigger_error("User has voted more than once on $table_ref #".$id);
        }
        return $votes->first();
    }
}
