<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class judgement extends Model
{
    public static function fetch_current($post_id){
        $ayes = count(Judgement :: where("post_id", $post_id)->where('for', true)->get());
        $nays = count(Judgement :: where("post_id", $post_id)->where('for', false)->get());
        return [$nays, $ayes];
    }
}
