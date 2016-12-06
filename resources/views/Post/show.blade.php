<?php
    use App\Comment;
    use App\Judgement;
    $judgement = Judgement::fetch_current($post->id);
?>
@extends ('layouts.app')
@section('content')
<div class='text-center'>
@foreach ($errors->all() as $error)
    {{var_dump($error)}}
    <div class='text-danger'>{{$error}}</div>
@endforeach
</div>
<h1 class='text-center' >
    {{$post->title}}
</h1>
@if ($post->url == null)
<div class='col-xs-2'>
</div>
<div class='panel panel-default col-md-8'>
    {{$post->text}}
</div>
<div class='col-xs-2'></div>
@endif
<div class='row'>
    <h4 class='col-md-6'>
        By: 
        @if ($post->user_id == 0)
            Anonymous 
        @else
            <a href="{{route('user.show', ['username'=>$post->user->username])}}">{{$post->user->username}}</a>
        @endif
    </h4>
    <h4 class='col-md-6 text-right'>
        @if (Auth::user())
            {{$post->mob->name}}? 
            @if (Judgement::have_they_already_judged($post->id))
                @include('Judgement.show')
            @else
                @include ('Judgement.create')
            @endif
        @else
            @include('Judgement.show')
        @endif 
    </h4>
</div>
<div class='row'>

    <input type='button' value='Comment'
      id='show-create-comment0' class='show-button btn btn-link'/>

    @include ('Comment.create', ['reply_to'=>0])
</div>
<div>
@foreach ($comments as $comment)
    <div class='row'>
            <div class='panel panel-default '>
                <div class='panel-heading'>
                    @if (Auth::user() && Comment::does_user_own_this($comment->id))
                        <input type='button' class='btn btn-danger' value='X'/>
                    @endif
                    {{$comment->created_at}} - 
                    -
                    @if ($comment->user_id==0)
                        Anonymous
                    @else
                        {{$comment->user->username}}
                    @endif 
                </div><div class='panel-body'>
                    {{$comment->text}}
                </div>
                <div class'panel-footer'>
                <!--
                    @if($comment->level<4)
                        <input type='button' value='Reply'
                          id='show-create-comment{{$comment->id}}' class='show-button btn btn-link'/>
                    @endif
                 -->   
                </div>
            </div>
            <!--
            @if($comment->level<4)
                @include ('Comment.create', ['reply_to'=>$comment->id])
            @endif
            -->
    </div>
    @endforeach
</div>
@endsection
