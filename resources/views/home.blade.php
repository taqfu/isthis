@extends('layouts.app')
@section ('mob')
    <a class='navbar-text' href="{{route('m.index')}}">Index</a>
    @foreach ($subscriptions as $subscription)
        {{$subscription->mob->name}} 
    @endforeach
@endsection
@section('content')
    @foreach($posts as $post)
        @include ('Post.link', ['home'=>true])
    @endforeach
    
@endsection
