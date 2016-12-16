
<?php
    $vote = \App\Vote::fetch_vote($table_ref, $table_id);
?>
@if (Auth::user())
    @if ($vote==null)
    <form method="POST" action="{{route('vote.store')}}" class='text-center'>
        {{csrf_field()}}
        <input type='hidden' name='tableRef' value='{{$table_ref}}' />
        <input type='hidden' name='tableID' value='{{$table_id}}' />
        <input type='hidden' name='vote' value='1' />
        <input type='submit' class='btn btn-link' value='&uarr;' />
    </form>
    <div class='text-center'>{{$$table_ref->score}}</div>
    <form method="POST" action="{{route('vote.store')}}" class='text-center'>
        {{csrf_field()}}
        <input type='hidden' name='tableRef' value='{{$table_ref}}' />
        <input type='hidden' name='tableID' value='{{$table_id}}' />
        <input type='hidden' name='vote' value='0' />
        <input type='submit' class='btn btn-link' value='&darr;' />
    </form>
    @else 
        @if ($vote->up)
            <div class='text-center'><strong>
                &uarr;
            </strong></div>
        @else
            <form method="POST" action="{{route('vote.update', ['id'=>$vote->id])}}" class='text-center'>
                {{csrf_field()}}
                {{method_field("PUT")}}
                <input type='hidden' name='vote' value='1' />
                <input type='submit' class='btn btn-link' value='&uarr;' />
            </form>

        @endif

        <div class='text-center'>{{$$table_ref->score}}</div>
        @if ($vote->up)
            <form method="POST" action="{{route('vote.update', ['id'=>$vote->id])}}" class='text-center'>
                {{csrf_field()}}
                {{method_field("PUT")}}
                <input type='hidden' name='vote' value='0' />
                <input type='submit' class='btn btn-link' value='&darr;' />
            </form>
            
        @else
            <div class='text-center'><strong>
                &darr;
            </strong></div>

        @endif
    @endif
@else
    <div class=''>
        {{$$table_ref->score}}   
    </div>
@endif
