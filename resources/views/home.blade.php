@extends('layouts.app')
@section ('mob')
    <a class='navbar-text' href="{{route('m.index')}}">Mob Index</a>
    @if (count($subscriptions)>0)
        <span class='navbar-text'>Subscriptions:
        @foreach ($subscriptions as $subscription)
            <a href="{{route('m.show', ['name'=>$subscription->mob->name])}}">
                {{$subscription->mob->name}}? 
            </a>
        @endforeach
        </span>
    @else
        <span class='navbar-text'>All</span>
    @endif
@endsection
@section('content')
    @foreach($posts as $post)
        @include ('Post.link', ['home'=>true])
    @endforeach
    
@endsection
