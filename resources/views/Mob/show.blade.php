@extends('layouts.app')
@section('mob')
    <strong><a href="{{route('m.show', ['name'=>$mob->name])}}" class='navbar-text'>
        {{$mob->name}}?
    </a></strong>
    <input type='button' class='show-button navbar-btn btn-default' id='show-create-post' value='Post' />
    &nbsp;
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
@endsection
@section('content')
    @if (Auth::user())
        <?php $subscription_id = \App\Subscription::fetch_subscription($mob->id); ?>
        @if ($subscription_id==0)
            @include ('Subscription.create')
        @else
            @include ('Subscription.destroy')
        @endif
        &nbsp;
    @endif
    @include ('Post.create')
    @foreach ($posts as $post)
        @include ('Post.link', ['home'=>false])
    @endforeach
    
@endsection
