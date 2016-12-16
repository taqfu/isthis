<?php
    
?>
@if (Moderator::are_they_a_moderator())
<form method="POST" action="{{route('ban.store')}}">
    {{csrf_field()}}
    @foreach (Moderator::fetch_all_moderated_mobs() as $mob)

    @endforeach
</form>
