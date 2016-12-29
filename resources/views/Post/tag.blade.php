<?php use App\Moderator; ?>

@if (Moderator::are_they_a_moderator($post->mob_id))
    @if ($post->tag==null)
    <form method="POST" action="{{route('post.tag', ['id'=>$post->id, 'tag'=>'spam'])}}" class='inline'>
        {{csrf_field()}}
        {{method_field("PUT")}}
        <input type='submit' class='btn btn-info' value='Spam' />
    </form>
    <form method="POST" action="{{route('post.tag', ['id'=>$post->id, 'tag'=>'censor'])}}" class='inline'>
        {{csrf_field()}}
        {{method_field("PUT")}}
        <input type='submit' class='btn btn-info' value='Censor' />
    </form>
    <form method="POST" action="{{route('post.tag', ['id'=>$post->id, 'tag'=>'off-topic'])}}" class='inline'>
        {{csrf_field()}}
        {{method_field("PUT")}}
        <input type='submit' class='btn btn-info' value='Off Topic' />
    </form>
    @else
        Marked as {{$post->tag}} by  <a href="{{route('user.show', ['username'=>$post->user_that_tagged->username])}}">
        {{$post->user_that_tagged->username}}
    </a>
    @endif
@endif
