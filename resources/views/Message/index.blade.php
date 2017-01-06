@extends ("layouts.app")

@section('content')

    @foreach ($messages as $message)
        <div class='row'>
            <div class='col-md-2'></div>
            <div class='panel panel-default col-md-8'> 
                <div class='panel-heading'>
                    From:
                    <a href="{{route('user.show', ['username'=>$message->sender->username])}}">
                        {{$message->sender->username}} 
                    </a>
                    To:
                    <a href="{{route('user.show', ['username'=>$message->recipient->username])}}">
                        {{$message->recipient->username}}
                    </a>
                </div>
                <div class='panel-body'>
                    {{$message->text}}
                </div>
                <div class='panel-footer'>
                    Mark as read
                </div>
            </div>
            <div class='col-md-2'></div>
        </div>
    @endforeach
@endsection
