<?php
    use App\Comment;
?>
<div class='row'>
        <div class='panel panel-default '>
            <div class='panel-heading'>
                @if (Auth::user() && Comment::does_user_own_this($comment->id))
                    <input type='button' class='btn btn-danger' value='X'/>
                @endif
                {{$comment->created_at}}
                -
                @if ($comment->user_id==0)
                    Anonymous
                @else
                    <a href="{{route('user.show', ['username'=>$comment->user->username])}}">
                        {{$comment->user->username}}
                    </a>
                @endif 
            </div><div class='panel-body'>
                {{$comment->text}}
            </div>
            <div class'panel-footer'>
            <!--
                @if($comment->level<4)
                    <input type='button' value='Reply'
                      id='show-create-comment{{$comment->id}}' class='show-button btn btn-link'/>
                @endif
             -->   
            </div>
        </div>
</div>
