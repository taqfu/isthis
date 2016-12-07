
@extends('layouts.app')
@section('content')
@include('User.menu')
@foreach ($comments as $comment)
    @include ('Comment.show')

@endforeach
@endsection
