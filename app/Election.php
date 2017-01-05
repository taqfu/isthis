<?php

namespace App;
use App\mob;
use App\Election;

use Illuminate\Database\Eloquent\Model;

class Election extends Model
{
    public static function fetch_current($mob_id){
        $elections = Election::where('mob_id', $mob_id)->orderBy('created_at', 'desc')->get();
        if (count($elections)==0){
            trigger_error("Mob #" . $mob_id . " has no elections.");
        }
        return Election::where('mob_id', $mob_id)->orderBy('created_at', 'desc')->skip(1)->first();
    }
    public static function fetch_next($mob_id){
        $elections = Election::where('mob_id', $mob_id)->orderBy('created_at', 'desc')->get();
        if (count($elections)==0){
            trigger_error("Mob #" . $mob_id . " has no elections.");
        }
        return $elections->first();
    }
    public static function fetch_end($mob_id, $start){
        $end = new Datetime($start);
        $mob = Mob::find($mob_id);
        $end->add(new DateInterval('PT' . $mob->num_of_election_days . 'D'));
        return $end;
    }
    public static function fetch_iteration($mob_id){
        $last_election = Election::where('mob_id', $mob_id)->orderBy('created_at', 'desc')->first(); 
        $num_of_elections = count(Election::where('mob_id', $mob)->get());
        if ($last_election->iteration!=$num_of_elections){
            trigger_error("Number of elections does not match last election's iteration 
              ($num_of_elections / $last_election->iteration");
        }
        return $last_election->iteration;
    }
    public function mob(){
        return $this->belongsTo('App\mob');
    }
}
