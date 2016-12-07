<input type='button' class='btn btn-default show-button' id='show-create-post' value='Post'/>
<div id='create-post' class='row hidden'>
    <div class='col-md-4'></div>
    <form method="POST" action="{{route('post.store')}}" class='col-md-4'>
        {{csrf_field()}}
        @foreach ($errors->all() as $error)
            <div class='text-danger'>{{$error}}</div>
        @endforeach
        <input type='hidden' name='mobID' value='{{$mob_id}}' />
        <div class='form-group'>
            <label>Title - (<span id='new-post-title-num-of-chars'>150</span>) characters remaining</label>
            <input id='new-post-title' type='text' name='title' class='form-control'
              value="{{old('title')}}" maxlength="150" >
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
            <div class='col-xs-6 text-right'>
            @if (Auth::guest())
            <span class='text-danger'>You are not logged in. This is an anonymous posting.</span>
            @endif
            </div><div class='col-xs-6 text-right'>
                <input type='button' class='btn btn-default cancel-button' id='cancel-create-post' value='Cancel' />
                <input type='submit' class='btn btn-default pull-right'/>
            </div>
        </div>
    </form>
    <div class='col-md-4'></div>
</div>
