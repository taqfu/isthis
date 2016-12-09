@if (Auth::user())
    <form method="POST" action="{{route('vote.store')}}" class='text-center'>
        {{csrf_field()}}
        <input type='hidden' name='tableRef' value='{{$table_ref}}' />
        <input type='hidden' name='tableID' value='{{$table_id}}' />
        <input type='hidden' name='vote' value='1' />
        <input type='submit' class='btn btn-link' value='&uarr;' />
    </form>
    <form method="POST" action="{{route('vote.store')}}" class='text-center'>
        {{csrf_field()}}
        <input type='hidden' name='tableRef' value='{{$table_ref}}' />
        <input type='hidden' name='tableID' value='{{$table_id}}' />
        <input type='hidden' name='vote' value='0' />
        <input type='submit' class='btn btn-link' value='&darr;' />
    </form>
@endif
