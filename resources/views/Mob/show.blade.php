@extends('layouts.app')

@section('content')
    @include ('Post.create')

    @foreach ($posts as $post)
        <div class='lead'><a href="{{route('post.show', ['id'=>$post->id])}}">{{$post->title}}</a></div>
    @endforeach
@endsection
