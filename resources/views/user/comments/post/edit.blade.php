@extends('user.layouts.app')

@section('content')
<h3>Edit Komentar Post</h3>

@include('user.comments.post._form', [
    'comment' => $comment,
    'post' => $post
])
@endsection
