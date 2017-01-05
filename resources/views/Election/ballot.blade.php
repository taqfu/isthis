<?php 
    $caption = App\Ballot::fetch_caption($ballot->measure);
?>
<div class="well">
    
    {{$caption}}   
    @if ($caption==null)
        {{$ballot->measure}}
    @endif
    @if ($ballot->measure == "ban user" || $ballot->measure == "remove mod" || $ballot->measure == "new mod") 
        <a href="{{route('user.show', ['username'=>$ballot->info])}}">{{$ballot->info}}</a>
    @elseif ($ballot->measure == "change days for election")
        <i>(currently {{$election->mob->num_of_election_days}})</i>
    @elseif ($ballot->measure == "change num of mods")
        <i>(currently {{$election->mob->num_of_moderators}})</i>
    @elseif ($ballot->measure == "new rule")
        {{$ballot->info}}
    @elseif ($ballot->measure == "remove rule")
    @endif
</div>
