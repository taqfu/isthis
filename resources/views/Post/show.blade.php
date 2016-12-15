@extends ('layouts.app')
@section('content')
@include ('Post.header', ['create_comments_enabled'=>true])
@foreach ($comments as $comment)
    @include('Comment.show', ['end_at'=> $comment->level+4, 'with_replies'=>true])
@endforeach
@endsection
