<div class='row'>
    <form method="POST" action="{{route('comment.store')}}" class='col-md-4'>
        {{csrf_field()}}
        <textarea name='text' class='form-control' rows='4'></textarea>
        <input type='hidden' name='replyTo' value='{{$reply_to}}' />
        <input type='hidden' name='postID' value='{{$post->id}}' />
        <input type='submit' value='Comment' class='btn btn-default pull-right'/>
    </form>
</div>
