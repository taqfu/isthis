<?php
    use App\Judgement;
    $judgement = Judgement::fetch_judgement_from_user( $comment->post->id, $comment->post->user_id); 
?>
@if ($comment->user_id==0)
    Anonymous
@else
    <a href="{{route('user.show', ['username'=>$comment->user->username])}}" class="
      @if ($comment->user_id==$comment->post->user_id)
        comment-OP
      @elseif ($judgement!=null && (boolean) $judgement->in_favor)
        voted-yes
      @elseif ($judgement!=null && !(boolean) $judgement->in_favor)
        voted-no
      @endif
      ">      
        {{$comment->user->username}}
    </a>
    
@endif 
