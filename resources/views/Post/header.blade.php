
<?php
    use App\Judgement;
    $judgement = Judgement::fetch_current($post->id);
?>
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
<div class='container'>
    <div id='post-primary'  class='panel panel-default padding-1'>
        {{$post->text}}
    </div>
    @include ('Post.edit')
</div>
@endif
<div class='container'>
    <h4 class='col-md-6'>
        By: 
        @if ($post->user_id == 0)
            Anonymous 
        @else
            <a href="{{route('user.show', ['username'=>$post->user->username])}}">{{$post->user->username}}</a>
        @endif
        @if($post->url==null)
            <input type='button' value='Edit' class='btn btn-link replace-primary-button' id='replace-primary-post'/>
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
    @if ($create_comments_enabled)
<input type='button' value='Comment'
  id='show-create-comment0' class='show-button btn btn-link'/>
@include ('Comment.create', ['reply_to'=>0])
    @endif
