@extends('layouts.app')
@section ('mob')
    <a class='navbar-text' href="{{route('m.index')}}">Index</a>
@endsection
@section('content')
    @foreach($posts as $post)
        @include ('Post.link', ['home'=>true])
    @endforeach
    
@endsection
