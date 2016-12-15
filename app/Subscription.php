<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Subscription extends Model
{
    public static function fetch_subscription($mob_id){
        $subscriptions = Subscription::where('mob_id', $mob_id)->where('user_id', Auth::user()->id)->get();
        if (count($subscriptions)>1){
            trigger_error("More than one subscription for $mob_id for " . Auth::user()->id);
        } else if (count($subscriptions)==1){
            return $subscriptions->first()->id;
        }
        return 0;
    }
    public function mob(){
        return $this->belongsTo('App\mob');
    }
}
