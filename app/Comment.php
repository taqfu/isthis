<?php

namespace App;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function post(){
        return $this->belongsTo('App\Post');
    }
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
    public function user_that_tagged(){
        return $this->belongsTo('App\user', 'tagger', 'id');
    }
    public static function update_score($id){
        $ayes = count(Vote::where('up', true)->where('table_ref', 'comment')->where('table_id', $id)->get());
        $nays = count(Vote::where('up', false)->where('table_ref', 'comment')->where('table_id', $id)->get());
        $comment = Comment::find($id);
        $comment->score = $ayes-$nays;
        $comment->save();
    }
}
