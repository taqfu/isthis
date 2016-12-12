@extends('layouts.app')
@section('content')
<div class="container">
    @foreach($posts as $post)
        <div class='row'>
                <a href="{{route('post.show', ['mob_name'=>$post->mob->name, 'title_url'=>$post->title_url])}}">
                {{$post->title}} - 
                <a href="{{route('m.show',['name'=>$post->mob->name])}}">
                    {{$post->mob->name}}?
                </a>
        </div>
    @endforeach
    
</div>
@endsection
