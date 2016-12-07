@extends('layouts.app')

@section('content')
    @include ('Post.create')

    @foreach ($posts as $post)
        <div class='lead'><a href="{{route('post.show', 
            ['mob'=>$post->mob->name, 'post_title'=>$post->title_url])}}">{{$post->title}}</a></div>
    @endforeach
@endsection
