@extends('user.layouts.app')

@section('content')
<div class="card">
    <h2>Edit Komentar</h2>

    @include('user.comments.forum._form', [
        'comment' => $comment,
        'forum'   => $forum
    ])
</div>
@endsection
