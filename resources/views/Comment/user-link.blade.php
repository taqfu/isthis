
@if ($comment->user_id==0)
    Anonymous
@else
    <a href="{{route('user.show', ['username'=>$comment->user->username])}}">
        {{$comment->user->username}}
    </a>
@endif 
