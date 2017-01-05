<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ballot extends Model
{
    public static function fetch_caption($measure){
        switch ($measure){
            case "ban user":
                return "Ban User:";
                break;
            case "remove mod":
                return "Remove Moderator:";
                break;
            case "new mod":
                return "New Moderator:";
                break;
            case "change anonymity":
                return "Toggle Anonymity";
                break;
            case "change num of mods":
                return "Change Maximum Number Of Mods";
                break;
            case "change days for election":
                return "Change Number Of Days For An Election";
                break;
            
        }
    }
}
