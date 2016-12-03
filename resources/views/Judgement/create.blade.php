<form method="POST" action="{{route('judgement.store')}}" class='inline'>
    {{csrf_field()}}
    <input type='hidden' name='postID' value='{{$post->id}}' />
    <input type='hidden' name='judgement' value="1" />
    <input type='submit' value='Yes' class='btn btn-success' />
</form> 
<form method="POST" action="{{route('judgement.store')}}" class='inline'>
    {{csrf_field()}}
    <input type='hidden' name='postID' value='{{$post->id}}' />
    <input type='hidden' name='judgement' value="0" />
    <input type='submit' value='No' class='btn btn-danger' />
</form> 
