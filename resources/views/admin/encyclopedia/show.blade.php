@extends('admin.layouts.app')

@section('content')

<h1 class="page-title">
    {{ $item->title }}
</h1>

@if($item->image)
    <img src="{{ asset($item->image) }}"
        class="detail-image">

@endif

@if($item->video_url)
    <iframe class="detail-video"
        src="{{ str_replace('watch?v=', 'embed/', $item->video_url) }}"
        allowfullscreen>
    </iframe>
@endif

<div class="detail-content">
    {!! nl2br(e($item->content)) !!}
</div>

@endsection
