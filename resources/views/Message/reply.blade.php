
<div id='message{{$message->id}}' class='hidden'>
    <hr>
    <form method="POST" action="{{route('message.store')}}" class='col-md-9'>
        {{csrf_field()}}
        <div class='form-group'>
            <input type='hidden' value='{{$recipient->username}}' name='username' />
            <textarea  rows='5' class='form-control' name='text'></textarea>
            <input type='submit' class='btn btn-default pull-right' value='Send'/>
            <input type='button' class='btn btn-default pull-right cancel-button' id='cancel-message{{$message->id}}' value='Cancel'/>
        </div>
    </form>
</div>
