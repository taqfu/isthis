@extends ('layouts.app')
@section('mob')
    
    <a href="{{route('ballot.create')}}" class='navbar-text'>New Ballot</a>
@endsection
@section('content')
    <h1 class='text-center'>
        Election #{{$election->iteration}} -
        <a href="{{route('m.show', ['name'=>$election->mob->name])}}">
            <i>{{$election->mob->name}}?</i>
        </a>
    </h1>
<h2 class='text-center'>
    @if ($election->end!=null)
    {{date('F j, Y', strtotime($election->start))}}
     to
    {{date('F j, Y', strtotime($election->end))}}
    @else
        {{date('F j, Y', strtotime($election->start))}}
     to
        TBD
    @endif
</h2>
@forelse ($ballots as $ballot)
    @include ("Election.ballot")
@empty
    <div class='container text-center lead text-danger'>
        There are no ballots for this election.
    </div>
@endforelse
@endsection
