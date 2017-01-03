<?php
    use App\Election;
    $election = Election::fetch_current($mob->id);
?>
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
        <a href="{{route('user.show', ['username'=>$moderator->user->username])}}">{{$moderator->user->username}}</a>
        @if (Auth::user() && $moderator->user_id == Auth::user()->id)
            @include ('Moderator.destroy')
        @endif
    @endforeach
    <span class='navbar-text pull-right'>
        <a href="{{route('election.show', ['id'=>$election->id])}}">
            Election #{{$election->iteration}}  Due {{$election->end}}
        </a>
    </span>
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
    @forelse ($posts as $post)
        @include ('Post.link', ['home'=>false])
    @empty
        <div class='container'>
            No one has posted yet.
        </div> 
    @endforelse
    
@endsection
