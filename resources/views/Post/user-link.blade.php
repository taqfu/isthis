@if ($post->user_id == 0)
    Anonymous
@else
    <a href="{{route('user.show', ['username'=>$post->user->username])}}">{{$post->user->username}}</a>
@endif
