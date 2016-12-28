@extends('layouts.app')
@section('mob')
    <strong><a href="{{route('m.show', ['name'=>$mob->name])}}" class='navbar-text'>
        {{$mob->name}}?
    </a></strong>
    &nbsp;
    <span class='navbar-text'>
    @if (count($moderators)==1)
        Moderator:
    @elseif (count($moderators)==0)
        Moderator: None
    @else 
        Moderators:
    @endif
    @foreach($moderators as $moderator)
        @if (Auth::user() && $moderator->user_id == Auth::user()->id)
            @include ('Moderator.destroy')
        @endif
        <a href="{{route('user.show', ['username'=>$moderator->user->username])}}">{{$moderator->user->username}}</a>
    @endforeach
    </span>
@endsection
@section('content')
   <h1 class='text-center'> You are banned.</h1> 
@endsection
