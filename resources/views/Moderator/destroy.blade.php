<form id='quit-moderator{{$moderator->id}}' method="POST" action="{{route('moderator.destroy', ['id'=>$moderator->id])}}" class='inline'>
    {{csrf_field()}}
    {{method_field('delete')}}
    <input type='submit' class='btn btn-link text-danger' value='[quit]' />

</form>
