<?php
    
    $route_name = \Request::route()->getName();
    $route_name = substr($route_name, 5, strlen($route_name)-5);
?>
<h1 class='text-center'>{{$user->username}}</h1>
@include ('Ban.create')
<nav class="navbar navbar-default">
    <ul class='nav navbar-nav lead'>
        <li @if ($route_name=="posts")class="active"@endif>
            <a href="{{route('user.posts', ['username'=>$user->username])}}">
                Submissions
            </a>
        </li><li @if ($route_name=="comments")class="active"@endif>
            <a href="{{route('user.comments', ['username'=>$user->username])}}">
                Comments
            </a>
        </li><li @if ($route_name=="judgements")class="active"@endif>
            <a href="{{route('user.judgements', ['username'=>$user->username])}}">
                Judgements
            </a>
        </li>
    </ul>
</nav>
