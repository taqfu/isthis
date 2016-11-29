@extends ('layouts.app')
@section('content')
<h1 class='text-center' >
    {{$post->title}}
</h1>
<div>
    By: 
    @if ($post->user_id == 0)
        Anonymous 
    @else
        <a href="route('user.show', ['id'=>$post->user_id])}}">{{$post->user->username}}</a>
    @endif
</div>
@if ($post->url == null)
<div class='col-xs-2'>
</div>
<div class='panel panel-default col-md-8'>
    {{$post->text}}
</div>
<div class='col-xs-2'></div>
@endif
@endsection
