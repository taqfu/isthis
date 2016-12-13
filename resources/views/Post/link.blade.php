<div class='container'>
    <a href="{{route('post.show', ['mob_name'=>$post->mob->name, 'title_url'=>$post->title_url])}}">
        {{$post->title}}
    </a> 
    ({{$post->score}}) - 
    @include ('Post.user-link')
    - <i>{{interval($post->created_at, date('y-m-d H:i:s'))}} ago...</i>
    @if ($home)
        <a href="{{route('m.show', ['name'=>$post->mob->name])}}">
            [{{$post->mob->name}}?] 
        </a>
    @endif
</div>
