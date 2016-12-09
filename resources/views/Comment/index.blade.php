<?php use App\Comment; ?>
@extends ('layouts.app')

@section('content')
    @include('Post.header', ['create_comments_enabled'=>false])
    <div class='lead container'>
        You're checking out comment #{{$comment->id}} and on level {{$comment->level}} of the comments for this post...
        <a href="{{route('post.show', ['mob_name'=>$post->mob->name, 'title_url'=>$post->title_url])}}">Top Level Comments </a>
        
        @if ($comment->level>0)
        /
        <a href="{{route('comment.show', ['id'=>$comment->reply_to])}}">Parent Comment</a>
        @endif
    </div>
    @include('Comment.show', ['end_at'=> $comment->level+4])
@endsection
