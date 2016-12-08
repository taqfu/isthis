<form method="POST" action="{{route('post.update', ['id'=>$post->id])}}" class='row hidden' id='post-secondary'>
    {{csrf_field()}}
    {{method_field('PUT')}}
    <div class='form-group'>
        <textarea name='newPostText' class='form-control' rows='4'>{{$post->text}}</textarea>
        <input type='submit' class='btn btn-default pull-right'/>
        <input type='button' class='btn btn-default pull-right replace-secondary-button' value='Cancel' id='replace-secondary-post'/>
    </div>
</form>
