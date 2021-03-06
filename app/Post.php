<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public static function fetch_num_of_comments($id){
        return count(Comment::where('post_id', $id)->get());
    }
    public function user(){
        return $this->belongsTo('App\User');

    } 
    public function mob(){
        return $this->belongsTo('App\mob');
    } 
    public function user_that_tagged(){
        return $this->belongsTo('App\user', 'tagger', 'id');
    }
    public static function update_score($id){
        $ayes = count(Vote::where('up', true)->where('table_ref', 'post')->where('table_id', $id)->get());
        $nays = count(Vote::where('up', false)->where('table_ref', 'post')->where('table_id', $id)->get());
        var_dump($ayes, $nays, $ayes-$nays);
        $post = Post::find($id);
        $post->score = $ayes-$nays;
       
        $post->save();
    }
}
