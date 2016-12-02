<div class='row'>
    <form method="POST" action="{{route('post.store')}}" class='col-md-4'>
        {{csrf_field()}}
        @foreach ($errors->all() as $error)
            <div class='text-danger'>{{$error}}</div>
        @endforeach
        {{var_dump(old('title'))}}
        <input type='hidden' name='mobID' value='{{$mob_id}}' />
        <div class='form-group'>
            <label>Title</label>
            <input type='text' name='title' class='form-control'
              value="{{old('title')}}" >
        </div>
        <div class='form-group'>
            <label>Type:</label>
            <label><input type='radio' name='type' value="1"
              id='replace-primary-post' class='replace-primary-button'
              @if (old('type')||old('type')==null)
              checked
              @endif
              />text</label>
            <label><input type='radio' name='type' value="0"
              id='replace-secondary-post' class='replace-secondary-button'
              @if (old('type')!=NULL && !old('type'))
              checked
              @endif
              />link</label>

        </div>
        <div  id='post-primary' class="form-group
        @if (old('type')!=NULL && !old('type'))
            hidden
        @endif
        ">
            <label>Text:</label>
            <textarea name='text' class='form-control'>{{old('text')}}</textarea>
        </div>
        <div id='post-secondary' class="form-group
        @if (old('type')||old('type')==null)
            hidden
        @endif
        ">
            <label>URL:</label>
            <input type='url' name='url'  value="{{old('url')}}"/>
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
