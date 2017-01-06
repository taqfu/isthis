@extends ('layouts.app')
@section('content')
    <div class='text-danger lead text-center'>
        @foreach ($errors->all() as $error)
            {{$error}}
        @endforeach

    </div>
    <div class='col-md-4'></div>
    <div class='col-md-4'>
        <form method="POST" action="{{route('message.store')}}" >
            {{csrf_field()}}
            <div class='form-group'>
                <label for='to'>Sending Message To:</label>
                <input type='text' value='{{$user->username}}' name='username' class='form-control' readonly id='to'/>
                
                <textarea  rows='5' class='form-control' name='text'></textarea>
                <input type='submit' class='btn btn-default pull-right' value='Send'/>
            </div>
        </form>
    </div>
    <div class='col-md-4'></div>
@endsection
