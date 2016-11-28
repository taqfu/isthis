<form method="POST" action="{{route('post.store')}}">
    {{csrf_field()}}
    <input type='text' name='title' />
    <textarea name='text'></textarea>
    <input type='submit' />
</form>
