@extends('user.layouts.app')

@section('content')
<div class="card">
    <h1 class="text-xl font-bold mb-4">
        {{ $item->title }}
    </h1>

    @if($item->image)
        <img src="{{ asset($item->image) }}"
            class="rounded mb-4"
            style="max-width:400px;">

    @endif

    @if($item->video_url)
        @php
            preg_match(
                '%(?:youtube\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i',
                $item->video_url,
                $match
            );
            $videoId = $match[1] ?? null;
        @endphp

        @if($videoId)
            <div class="video-wrapper">
                <iframe
                    src="https://www.youtube.com/embed/{{ $videoId }}"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen>
                </iframe>
            </div>
        @endif
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
