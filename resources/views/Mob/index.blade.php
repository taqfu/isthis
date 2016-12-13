@extends ('layouts.app')
@section ('mob')
@endsection
@section ('content')
    @if (Auth::user())
        @include ('Mob.create')
    @endif 
    @foreach ($errors->all() as $error)
        <div class='text-danger'>
            {{$error}}
        </div>
    @endforeach
    @forelse ($mobs as $mob)
        <div>
            <a href="{{route('m.show', ['name'=>$mob->name])}}">{{$mob->name}}</a>
        </div>
    @empty
        <div>
            There are no Mobs. OMG! How is this possible?!?
        </div>
    @endforelse
@endsection
