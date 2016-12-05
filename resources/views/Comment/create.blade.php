<div  id='create-comment{{$reply_to}}' class='hidden'>
    <form method="POST" action="{{route('comment.store')}}" class='col-md-6'>
        {{csrf_field()}}
        <textarea name='text' class='form-control' rows='4'></textarea>
        <input type='hidden' name='replyTo' value='{{$reply_to}}' />
        <input type='hidden' name='postID' value='{{$post->id}}' />
        @if (Auth::guest())
            <span class='text-danger'>You are commenting anonymously.</span>
        @endif
        <input type='submit' value='Comment' class='btn btn-default pull-right'/>
        <input type='button' value='Cancel' 
          id='cancel-create-comment{{$reply_to}}' class='cancel-button btn btn-default pull-right'/>
    </form>
</div>
