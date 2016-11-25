@extends ('layouts.app')
@section ('content')
    @include ('Mob.create')
    @forelse ($mobs as $mob)
        <div>
            {{$mob->name}}
        </div>
    @empty
        <div>
            There are no Mobs. OMG! How is this possible?!?
        </div>
    @endforeach
@endsection
