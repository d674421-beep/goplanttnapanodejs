@extends('layouts.guest')

@section('content')

<div class="auth-wrapper">
    <div class="auth-card">

        <h2 class="auth-title">Reset Password</h2>

        @if (session('status'))
            <div class="status approved">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.store') }}" class="auth-form">
            @csrf

            <input
                type="text"
                class="auth-input"
                required
            >
                <div class="status pending">{{ $message }}</div>
            @enderror

            <input
                type="password"
                name="password"
                placeholder="Password baru"
                class="auth-input"
                required
            >
            @error('password')
                <div class="status pending">{{ $message }}</div>
            @enderror

            <input
                type="password"
                name="password_confirmation"
                placeholder="Konfirmasi password"
                class="auth-input"
                required
            >

            <button type="submit" class="btn-primary full">
                Reset Password
            </button>

            <div class="auth-switch">
                <a href="{{ route('login') }}">← Kembali ke login</a>
            </div>

        </form>

    </div>
</div>

@endsection
