<form method="POST" action="{{route('subscription.store')}}" class='inline'>
    {{csrf_field()}}
    <input type='hidden' name='mobID' value='{{$mob->id}}' />
    <input type='submit' value='Subscribe' class='navbar-btn btn-success'/>
</form>
