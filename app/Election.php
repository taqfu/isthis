<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Election extends Model
{
    public static function fetch_end($mob_id, $start){
        $end = new Datetime($start);
        $end->add(new DateInterval('PT7D'));
        return $end;
    }
    public static function fetch_order($mob_id){
        $last_election = Election::where('mob_id', $mob_id)->orderBy('created_at', 'desc')->first();         if ($last_election->order!=count(Election::where('mob_id', $mob)->get()){
            trigger_error("");
        }
    }
}
