<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    public static function do_they_have_unread_msgs(){
        return count(Message::where('read', false)->where('to', Auth::user()->id)->get())>0;
    }
    public function sender(){
        return $this->belongsTo('App\User', 'from', 'id');
    }
    public function recipient(){
        return $this->belongsTo('App\User', 'to', 'id');
    }
}
