<div class='row'>
    <form method="POST" action="{{route('post.store')}}" class='col-md-4'>
        {{csrf_field()}}
        @foreach ($errors->all() as $error)
            <div class='text-danger'>{{$error}}</div>
        @endforeach
        <input type='hidden' name='mobID' value='{{$mob_id}}' />
        <div class='form-group'>
            <label>Title</label>
            <input type='text' name='title' class='form-control'/>
        </div>
        <div class='form-group'>
            <label>Type:</label>
            <label><input type='radio' name='type' value="1" 
              id='replace-primary-post' class='replace-primary-button' checked/>text</label>
            <label><input type='radio' name='type' value="0" 
              id='replace-secondary-post' class='replace-secondary-button'/>link</label>
        
        </div>
        <div  id='post-primary' class='form-group'>
            <label>Text:</label>
            <textarea name='text' class='form-control'></textarea>
        </div>
        <div id='post-secondary' class='form-group hidden'>
            <label>URL:</label>
            <input type='url' name='url' />
        </div>
        <div class='form-group'>
            @if (Auth::guest())
            <span class='text-danger'>You are not logged in. This is an anonymous posting.</span>
            @endif
            <input type='submit' class='btn btn-default pull-right'/>
        </div>
    </form>
    <div class='col-md-8'></div>
</div>
