@extends('user.layouts.app')

@section('content')
<div class="card">
    <h1 class="text-xl font-bold mb-4">
        {{ $item->title }}
    </h1>

    @if($item->image)
        <img src="{{ asset('storage/'.$item->image) }}"
             class="rounded mb-4"
             style="max-width:400px;">
    @endif

    @if($item->video_url)
        <div class="video-wrapper">
            <iframe
                src="{{ str_replace('watch?v=', 'embed/', $item->video_url) }}"
                allowfullscreen>
            </iframe>
        </div>
    @endif

    <p style="margin-top:15px; white-space:pre-line;">
        {{ $item->content }}
    </p>

    <a href="{{ route('user.encyclopedia.index') }}"
       class="btn-secondary"
       style="margin-top:20px;">
        ← Kembali
    </a>
</div>
@endsection
