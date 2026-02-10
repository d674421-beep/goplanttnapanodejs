@extends('layouts.guest')

@section('content')

<div class="auth-wrapper">
    <div class="auth-card">

        <h2 class="auth-title">
            Lupa Password
        </h2>

        <p class="auth-desc">
            Masukkan email akun kamu untuk melanjutkan reset password.
        </p>

        <form method="POST" action="{{ route('password.reset.simple') }}" class="auth-form">
            @csrf

            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="Email"
                class="auth-input"
                required
                autofocus
            >
            <div style="margin-bottom:16px">
                <label>Password Baru</label>
                <input type="password" name="password" required>
            </div>

            <div style="margin-bottom:16px">
                <label>Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required>
            </div>

            @error('email')
                <div class="form-error">
                    {{ $message }}
                </div>
            @enderror

            <button type="submit" class="btn-primary full">
                Lanjutkan
            </button>
        </form>

        <div class="auth-switch">
            <a href="{{ route('login') }}">Kembali ke login</a>
        </div>

    </div>
</div>

@endsection
