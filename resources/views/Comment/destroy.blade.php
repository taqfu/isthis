<form method="POST" action="{{route('comment.destroy', ['id'=>$comment->id])}}" class='inline'>
    {{csrf_field()}}
    {{method_field('delete')}}
    <input type='button' class='btn btn-link abandon-btn' value='Abandon' />
</form>
