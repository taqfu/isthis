
<?php
    use App\Judgement;
    $judgement = Judgement::fetch_current($post->id);
?>
<div class='text-center'>
@foreach ($errors->all() as $error)
    <div class='text-danger'>{{$error}}</div>
@endforeach
</div>
<h1 class='text-center' >
    {{$post->title}}
</h1>
@if ($post->url == null)
<div class='container'>
    <div id='post-primary'  class='panel panel-default padding-1'>
        <div class='row'>
        <div class='col-xs-1 text-center'>
        @include ('Vote.create', ['table_ref'=>'post', 'table_id'=>$post->id])
        </div><div class='col-xs-11'>
            {{$post->text}}
        </div>
        </div>
    </div>
    @include ('Post.edit')
</div>
@endif
<div class='container'>
    <h4 class='col-md-6'>
        By:
        @include ('Post.user-link')
        @if(Auth::user())
            @if ($post->user_id==Auth::user()->id)
            <input type='button' value='Edit' class='btn btn-link replace-primary-button' id='replace-primary-post'/>
                @include ('Post.destroy')
            @endif
        @endif
        @include ('Post.tag')
    </h4>
    <h4 class='col-md-6 text-right'>
        @if (Auth::user())
            <a href="{{route('m.show', ['name'=>$post->mob->name])}}">
            {{$post->mob->name}}? 
            </a>
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
    <div class='container'>
        <input type='button' value='Comment'
          id='show-create-comment0' class='show-button btn btn-link'/>
        @include ('Comment.create', ['reply_to'=>0])
    </div>
@endif
