@extends('admin.layouts.app')

@section('content')
    
    <div class="card form-wrapper">
        <h2>Edit Komentar</h2>
        @include('admin.comments.forum._form', ['comment' => $comment, 'forum' => $forum])
    </div>
@endsection
