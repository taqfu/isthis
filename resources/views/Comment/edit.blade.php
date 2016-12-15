<form method="POST" action="{{route('comment.update', ['id'=>$comment->id])}}" id='edit-comment{{$comment->id}}-secondary' class='hidden col-md-6'>
    {{csrf_field()}}
    {{method_field('PUT')}}
    <div class='form-group'>
        <textarea class='form-control' name='newText' rows='4'>{{$comment->text}}</textarea>
    </div><div class='form-group'>
        <input type='button' class='btn btn-default replace-secondary-button' id='replace-secondary-edit-comment{{$comment->id}}' value='Cancel' />
        <input type='submit' class='btn btn-default' />
    </div>
</form>
