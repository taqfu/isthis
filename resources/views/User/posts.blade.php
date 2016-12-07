@extends('layouts.app')
@section('content')
@include('User.menu')
@foreach ($posts as $post)
    <div>
    <a href="{{route('post.show', ['mob_name'=>$post->mob->name, 'title_url'=>$post->title_url])}}">
        {{$post->title}}
    </a>
     - 
    <a href="{{route('m.show', ['mob_name'=>$post->mob->name])}}">
        /u/{{$post->mob->name}}    
    </a>
    </div>
@endforeach
@endsection
