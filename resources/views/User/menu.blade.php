<h1 class='text-center'>{{$user->username}}</h1>
<navbar>
    <a href="{{route('user.posts', ['username'=>$user->username])}}">
        Submissions
    </a>
    <a href="{{route('user.comments', ['username'=>$user->username])}}">
        Comments
    </a>
</navbar>
