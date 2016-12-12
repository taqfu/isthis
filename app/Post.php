<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function user(){
        return $this->belongsTo('App\User');

    } 
    public function mob(){
        return $this->belongsTo('App\mob');
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
