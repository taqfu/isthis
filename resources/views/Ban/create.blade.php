<?php
   use App\Moderator; 
    use App\Ban;
?>
@if (Auth::user() && Auth::user()->id != $user->id && Moderator::are_they_a_moderator())
    @foreach ($errors->all() as $error)
        <div class='error'> {{$error}} </div>
    @endforeach
    @foreach (Moderator::fetch_all_moderated_mobs() as $mob)
        @if (Ban::are_they_banned($mob->id, $user->id))
            <form method="POST" action="{{route('unban')}}" class='inline'>
                {{csrf_field()}}
                <input type='hidden' name='user_id' value='{{$user->id}}' />
                <input type='hidden' name='mob_id' value='{{$mob->id}}' />
                <input type='submit' class='btn btn-success' 
                  value='Unban {{$user->username}} From /m/{{$mob->name}}' />
            </form>
        @else
            <form method="POST" action="{{route('ban.store')}}" class='inline'>
                {{csrf_field()}}
                <input type='hidden' name='user_id' value='{{$user->id}}' />
                <input type='hidden' name='mob_id' value='{{$mob->id}}' />
                <input type='submit' class='btn btn-danger' 
                  value='Ban {{$user->username}} From /m/{{$mob->name}}' />
            </form>
        @endif 
    @endforeach
@endif
