@extends('admin.layouts.app')

@section('content')
<h3>Edit Komentar Post</h3>

@include('admin.comments.post._form', [
    'comment' => $comment,
    'post' => $post
])
@endsection
