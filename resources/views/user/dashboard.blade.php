@extends('user.layouts.app')

@section('content')

<h1 class="page-title">Dashboard</h1>

<div class="dashboard-grid">

    {{-- POSTS --}}
    <div class="dashboard-card card-green">
        <div class="card-top">
            <div class="card-icon">📝</div>
            <div class="card-info">
                <div class="card-label">Post Saya</div>
                <div class="card-value">{{ $postCount }}</div>
            </div>
        </div>
        <a href="{{ route('user.posts.index') }}" class="card-link">
            Lihat Post →
        </a>
    </div>

    {{-- FORUM --}}
    <div class="dashboard-card card-blue">
        <div class="card-top">
            <div class="card-icon">💬</div>
            <div class="card-info">
                <div class="card-label">Forum Aktif</div>
                <div class="card-value">{{ $forumCount }}</div>
            </div>
        </div>
        <a href="{{ route('user.forums.index') }}" class="card-link">
            Lihat Forum →
        </a>
    </div>

    {{-- REMINDER --}}
    <div class="dashboard-card card-orange">
        <div class="card-top">
            <div class="card-icon">⏰</div>
            <div class="card-info">
                <div class="card-label">Reminder</div>
                <div class="card-value">{{ $reminderCount }}</div>
            </div>
        </div>
        <a href="{{ route('user.reminders.index') }}" class="card-link">
            Lihat Reminder →
        </a>
    </div>

</div>

@endsection
