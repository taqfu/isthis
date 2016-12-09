<?php

namespace App;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function user(){
        return $this->belongsTo('App\User');

    } 
    public static function does_user_own_this($id){
        $comment = Comment::find($id);
        return Auth::user()->id==$comment->user_id;
    }
    public static function replies ($id){
        return Comment::where('reply_to', $id)->get();
        
    }
}
