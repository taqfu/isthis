@extends('layouts.app')

@section('content')
    <div class='error container text-danger lead text-center'>
        @foreach ($errors->all() as $error)
            {{$error}}
        @endforeach
    </div>
    <div class='col-md-5'></div>
    <div class='col-md-2'>
    <form method="POST" action="{{route('ballot.store')}}" class=''>
        {{csrf_field()}}
        <div class='form-group'>
            <label>Mob:
                <select name='mob_id' class='form-control'>
                    @foreach ($subscriptions as $subscription)
                        <option value='{{$subscription->mob_id}}'>
                            {{$subscription->mob->name}}
                        </option>
                    @endforeach
                </select>
            </label>
        </div>
        <div class='form-group'>
            <label>Ballot Measure:
                <select name='measure' class='form-control'>
                    <option></option>
                    <option value='ban user'>Ban User</option>
                    <option value='change days for election'>Change Number Of Days For Election</option>
                    <option value='change num of mods'>Change Number Of Moderators</option>
                    <option value='new mod'>New Moderator</option>
                    <option value='new rule'>New Rule</option>
                    <option value='remove mod'>Remove Moderator</option>
                    <option value='remove rule'>Remove Rule</option> 
                    <option value='change anonymity'>Toggle Anonymity</option>
                </select>
            </label>
        </div>
        <div id='text-input' class='hidden'>
            <label>
                <span id='text-input-caption'></span>
                <input type='text' name='info' class='form-control' />
            </label>
        </div>
        <input type='submit' class='btn btn-default pull-right hidden create-ballot' value='Submit' />
    </form>
    </div>
    <div class='col-md-5'></div>
@endsection
