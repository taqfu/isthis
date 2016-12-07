<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mob extends Model
{
    public static function fetch_mob_by_name($name){
        $mobs = Mob::where('name', $name)->get();
        if (count($mobs)>1){
            trigger_error("There are multiple mobs with the name : $name");
        }
        return $mobs->first();

    }
}
