@extends('layouts.app')

@section ('content')
    @include('User.menu')
    @foreach ($judgements as $judgement)
        <div>
            @include ('Post.link', ['post'=>$judgement->post, 'home'=>true, 'judgement'=>$judgement])
        </div>
    @endforeach
@endsection
