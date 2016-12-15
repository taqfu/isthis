<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    public function mob(){
        return $this->belongsTo('App\mob');

    }
}
