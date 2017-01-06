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
            $unread = $message->to == Auth::user()->id && !$message->read ? "unread" : "";
            $button_caption = (boolean) $message->read ? "Unread" : "Read";
            $read_status = (boolean)$message->read ? "0" : "1";
        ?>
        <div class='row'>
            <div class='col-md-2'></div>
            <div class='panel {{$panel_class}} col-md-8'> 
                <div class='panel-heading'>
                    <div class='inline margin-right'>
                        @if ($message->from!=Auth::user()->id)
                        From:
                        <a href="{{route('user.show', ['username'=>$message->sender->username])}}"       
                         class='{{$unread}}'>
                            {{$message->sender->username}} 
                        </a>
                        @else
                        To:
                        <a href="{{route('user.show', ['username'=>$message->recipient->username])}}"    
                         class='{{$unread}}'>
                            {{$message->recipient->username}}
                        </a>  
                        @endif
                        - {{interval($message->created_at, 'now')}} ago
                    </div>
                    @if ($message->to==Auth::user()->id)
                        <form method="POST" action="{{route('message.update', ['id'=>$message->id])}}" class='inline'>
                            {{csrf_field()}}
                            {{method_field("PUT")}}
                            <input type='hidden' name='read_status' value='{{$read_status}}' />
                            <input type='submit' class='btn btn-default' 
                              value='Mark As {{$button_caption}}' />
                        </form>
                    @endif
                </div>
                <div class='panel-body'>
                    <div class='margin-top'>
                    {{$message->text}}
                    </div>
                @if ($message->to == Auth::user()->id)
                    <div class='margin-top'>
                        <input type='button' class='btn btn-link show-button'
                          id='show-message{{$message->id}}' value='Reply' />
                    </div>
                @endif
                </div>
                @if ($message->to==Auth::user()->id)
                    @include ("Message.reply", ["recipient"=>$message->sender])
                @endif
            </div>
            <div class='col-md-2'></div>
        </div>
    @endforeach
@endsection
