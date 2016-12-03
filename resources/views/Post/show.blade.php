<?php
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
<div>
    <h4 class='col-md-6'>
        By: 
        @if ($post->user_id == 0)
            Anonymous 
        @else
            <a href="route('user.show', ['id'=>$post->user_id])}}">{{$post->user->username}}</a>
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
@include ('Comment.create', ['reply_to'=>0])
</div>
<div>
@foreach ($comments as $comment)
    <div class='row'>
        <div class='col-md-6'>
        {{$comment->id}} - {{$comment->text}} 
        </div> 
    </div>
@endforeach
</div>
@endsection
