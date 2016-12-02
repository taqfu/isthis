        <form method="POST" action="{{route('judgement.store')}}" class='inline'>
            {{csrf_field()}}
            <input type='hidden' value='postID' value='{{$post->id}}' />
            <input type='hidden' value='judgement' value="1" />
            <input type='submit' value='Yes' class='btn btn-success' />
        </form> 
        <form method="POST" action="{{route('judgement.store')}}" class='inline'>
            {{csrf_field()}}
            <input type='hidden' value='postID' value='{{$post->id}}' />
            <input type='hidden' value='judgement' value="0" />
            <input type='submit' value='No' class='btn btn-danger' />
        </form> 
