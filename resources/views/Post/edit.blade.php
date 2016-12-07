<form method="POST" action="{{route('post.update', ['id'=>$post->id])}}" class='row hidden' id='edit-post'>
    {{csrf_field()}}
    {{method_field('PUT')}}
    <div class='col-md-4'></div>
    <div class='form-group col-md-4'>
        <textarea class='form-control' rows='4'>{{$post->text}}</textarea>
        <input type='submit' class='btn btn-default pull-right'/>
        <input type='button' class='btn btn-default pull-right cancel-button' value='Cancel' id='cancel-edit-post'/>
    </div>
    <div class='col-md-4'></div>
</form>
