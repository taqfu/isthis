<form method="POST" action="{{route('subscription.store')}}">
    {{csrf_field()}}
    <input type='hidden' name='mobID' value='{{$mob->id}}' />
    <input type='submit' value='Subscribe' />
</form>
