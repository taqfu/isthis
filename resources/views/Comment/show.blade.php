<?php
    use App\Comment;
?>
<div style='border-left:1px dashed #d0d0d0;'>
    <div class='panel panel-default'>
        <div class='panel-heading'>
            {{$comment->created_at}}
            -
            @include ('Comment.user-link')
            @if (!$with_replies)
                -
                @if ($comment->level==0)
                    From 
                @else 
                    Reply To 
                    <a href="{{route('comment.show',['id'=>$comment->id])}}">
                        Comment #{{$comment->id}}
                    </a>
                     From
                @endif
                    <a href="{{route('post.show', ['title_url'=>$comment->post->title_url, 'mob_name'=>$comment->post->mob->name])}}">{{$comment->post->title}}</a>
                 <a href="">[ {{$comment->post->mob->name}}? ]</a>
            @endif


            @include ("Comment.tag")  
            @if (Auth::user() && Auth::user()->id==$comment->user_id)
                <input type='button' class='btn btn-danger pull-right' value='X'/>
            @endif
            
        </div><div class='panel-body'>
            <div class='col-xs-1'>
                @include ('Vote.create', ['table_ref'=>'comment', 'table_id'=>$comment->id])
            </div><div class='col-xs-11 vertical-center'>
                <div id='edit-comment{{$comment->id}}-primary'>
                    {{$comment->text}}
                </div>
                @include ('Comment.edit')
            </div>
        </div>            
        <div class='panel-footer'>
            @if(route('comment.show', ['id'=>$comment->id])!=\Request::url())
                <a href="{{route('comment.show', ['id'=>$comment->id])}}">Permalink</a>
            @endif
            <input type='button' value='Reply'
              id='show-create-comment{{$comment->id}}' class='show-button btn btn-link'/> 
            @if (Auth::user() && Auth::user()->id==$comment->user_id)
                <input type='button' class='btn btn-link replace-primary-button' id='replace-primary-edit-comment{{$comment->id}}' value='Edit'/>
                @include ("Comment.destroy")
            @endif
            
        </div>
    </div>
@if ($with_replies)
    <div class='container'>
            @include ('Comment.create', ['reply_to'=>$comment->id])
    </div>
    <div>
        @if ($comment->level<$end_at)
            @foreach(Comment::replies($comment->id) as $reply)
                    <div class='margin-left-1 padding-left-1'>
                        @include ('Comment.show', ['comment'=>$reply, 'end_at'=>$end_at])
                    </div>
            @endforeach
        @elseif ($comment->level>=$end_at && count(Comment::replies($comment->id))>0)
            <a href="{{route('comment.show', ['id'=>$comment->id])}}">More...</a>
        @endif
    </div>
@endif
</div>
