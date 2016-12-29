<?php use App\Moderator; ?>
@if (Moderator::are_they_a_moderator($comment->post->mob_id))
    @if ($comment->tag==null)
        <form method="POST" action="{{route('comment.tag', ['id'=>$comment->id, 'tag'=>'spam'])}}" class='inline'>
            {{csrf_field()}}
            {{method_field("PUT")}}
            <input type='submit' class='btn btn-info' value='Spam' />
        </form>
        <form method="POST" action="{{route('comment.tag', ['id'=>$comment->id, 'tag'=>'censor'])}}" class='inline'>
            {{csrf_field()}}
            {{method_field("PUT")}}
            <input type='submit' class='btn btn-info' value='Censor' />
        </form>
        <form method="POST" action="{{route('comment.tag', ['id'=>$comment->id, 'tag'=>'off-topic'])}}" class='inline'>
            {{csrf_field()}}
            {{method_field("PUT")}}
            <input type='submit' class='btn btn-info' value='Off Topic' />
        </form>
    @else
        Marked as {{$comment->tag}} by  <a href="{{route('user.show', ['username'=>$comment->user_that_tagged->username])}}">
        {{$comment->user_that_tagged->username}}
    </a>
    @endif
@endif
