@extends('layouts.app')
@section('mob')
    <strong><a href="{{route('m.show', ['name'=>$mob->name])}}" class='navbar-text'>
        {{$mob->name}}?
    </a></strong>
    <a href="#" class="navbar-text subscribe-button" id='subscribe{{$mob->id}}'>Subscribe</a>
    <a href='#' class='show-button navbar-text' id='show-create-post'>Post</a>
@endsection
@section('content')
    @include ('Post.create')

    @foreach ($posts as $post)
        @include ('Post.link', ['home'=>false])
    @endforeach
    
@endsection
