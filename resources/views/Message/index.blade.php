@extends ("layouts.app")

@section('content')
    @foreach ($errors->all() as $error)
        {{$error}}
    @endforeach 

    @foreach ($messages as $message)
        <?php
            if ($message->from==Auth::user()->id){
                $panel_class = "panel-default";
            } else {
                $panel_class = $message->read ? "panel-info" : "panel-primary";
            }
            $unread = !$message->read ? "unread" : "";
            $button_caption = (boolean) $message->read ? "Unread" : "Read";
            $read_status = (boolean)$message->read ? "0" : "1";
        ?>
        <div class='row'>
            <div class='col-md-2'></div>
            <div class='panel {{$panel_class}} col-md-8'> 
                <div class='panel-heading'>
                    <form method="POST" action="{{route('message.update', ['id'=>$message->id])}}" class='inline margin-right'>
                        {{csrf_field()}}
                        {{method_field("PUT")}}
                        <input type='hidden' name='read_status' value='{{$read_status}}' />
                        <input type='submit' class='btn btn-default' 
                          value='Mark As {{$button_caption}}' />
                    </form>
                    <div class='inline'>
                    From:
                    <a href="{{route('user.show', ['username'=>$message->sender->username])}}"       
                     class='{{$unread}}'>
                        {{$message->sender->username}} 
                    </a>
                    To:
                    <a href="{{route('user.show', ['username'=>$message->recipient->username])}}"    
                     class='{{$unread}}'>
                        {{$message->recipient->username}}
                    </a>  
                    </div>
                </div>
                <div class='panel-body'>
                    <div class='margin-top'>
                    {{$message->text}}
                    </div>
                </div>
            </div>
            <div class='col-md-2'></div>
        </div>
    @endforeach
@endsection
