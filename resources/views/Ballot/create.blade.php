@extends('layouts.app')

@section('content')
    <form method="POST" action="{{route('ballot.store')}}">
        <label>Mob:
            <select name='mob_id' class=''>
                @foreach ($subscriptions as $subscription)
                    <option value='{{$subscription->mob_id}}'>
                        {{$subscription->mob->name}}
                    </option>
                @endforeach
            </select>
        </label>
        <select>

        </select>
    </form>
@endsection
