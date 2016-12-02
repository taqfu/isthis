
@extends ('layouts.app')
@section('content')
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
            {{var_dump(\App\judgement::fetch_current($post->id))}}
        @if (Auth::user())
            {{$post->mob->name}}? 
            @include ('Judgement.create')
        @else
            {{var_dump(\App\judgement::fetch_current($post->id))}}
        @endif 
    </h4>
</div>
@endsection
