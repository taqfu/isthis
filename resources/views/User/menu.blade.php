<h1 class='text-center'>{{$user->username}}</h1>
    
<nav class="navbar ">
    <ul class='nav navbar-nav lead'>
        <li>
            <a href="{{route('user.posts', ['username'=>$user->username])}}">
                Submissions
            </a>
        </li><li>
            <a href="{{route('user.comments', ['username'=>$user->username])}}">
                Comments
            </a>
        </li><li>
            <a href="{{route('user.judgements', ['username'=>$user->username])}}">
                Judgements
            </a>
        </li>
    </ul>
</nav>
