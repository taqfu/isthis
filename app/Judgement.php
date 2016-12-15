<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Judgement extends Model
{
    public static function fetch_current($post_id){
        $ayes = count(Judgement :: where("post_id", $post_id)->where('in_favor', true)->get());
        $nays = count(Judgement :: where("post_id", $post_id)->where('in_favor', false)->get());
        $total = $nays + $ayes;
        if ($total==0){
            return NULL;

        }
        if ($ayes > $nays){
            $swing = 1;
            $degree = ($ayes-$nays);
        } else if ($ayes < $nays){
            $swing = -1;
            $degree = ($nays-$ayes);
        } else if ($ayes == $nays){
            $swing = 0;
            $degree=0;
        }
        return ['swing'=>$swing, 'degree'=>$degree/$total*100, 'total'=>$total];
    }

    public static function have_they_already_judged($post_id){
        $num_of_judgements = count(Judgement::where('post_id', $post_id)->where('user_id', Auth::user()->id)->get());
        if ($num_of_judgements>1){
           trigger_error("User #". Auth::user()->id . " has more than one judgement for post #". $post_id, E_USER_WARNING); 

        }
        return $num_of_judgements>0;
    }

    public function post (){
        return $this->belongsTo('\App\Post');
    }
}
