@extends('layouts.app')
@section('content')
@include('User.menu')
@foreach ($posts as $post)
    <div>
        @include ('Post.link', ['home'=>true])
    </div>
@endforeach
@endsection
