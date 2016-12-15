@extends('layouts.app')
@section('mob')
    @if (Auth::user())
        <?php $subscription_id = \App\Subscription::fetch_subscription($mob->id); ?>
        @if ($subscription_id==0)
            @include ('Subscription.create')
        @else
            @include ('Subscription.destroy')
        @endif
        &nbsp;
    @endif
    <strong><a href="{{route('m.show', ['name'=>$mob->name])}}" class='navbar-text'>
        {{$mob->name}}?
    </a></strong>
    <input type='button' class='show-button navbar-btn btn-default' id='show-create-post' value='Post' />
@endsection
@section('content')
    @include ('Post.create')
    @foreach ($posts as $post)
        @include ('Post.link', ['home'=>false])
    @endforeach
    
@endsection
