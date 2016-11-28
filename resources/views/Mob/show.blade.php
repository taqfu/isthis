@extends('layouts.app')

@section('content')
    @include ('Post.create')
    @foreach ($posts as $post)

    @endforeach
@endsection
