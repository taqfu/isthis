<?php
    if(isset($judgement)){
        $bg_class = $judgement->in_favor ? "bg-success" : "bg-danger";
    } else {
        $bg_class = "";
    }
?>
<div class='container {{$bg_class}} 
  @if ($post->tag!=null)
      bg-info  
  @endif
  '>
    <div class='col-xs-1 text-center'>
        {{$post->score }}
    </div><div class='col-xs-11'>
        <a href="{{route('post.show', ['mob_name'=>$post->mob->name, 'title_url'=>$post->title_url])}}">
            {{$post->title}}
        </a> 
         ({{App\Post::fetch_num_of_comments($post->id)}} comments) - 
        @include ('Post.user-link')
        - <i>{{interval($post->created_at, date('y-m-d H:i:s'))}} ago...</i>
        @if ($home)
            <a href="{{route('m.show', ['name'=>$post->mob->name])}}">
                [{{$post->mob->name}}?] 
            </a>
        @endif
        @if ($post->tag!=null)
            <strong>{{$post->tag}}</strong>
        @endif
    </div>
</div>
