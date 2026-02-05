@extends('layouts.guest')

@section('content')
<div class="auth-wrapper">
    <div class="auth-card">

        <h2 class="auth-title">
            Daftar Akun GoPlant
        </h2>

        <form method="POST" action="{{ route('register') }}" class="auth-form">
            @csrf

            <input type="text" name="name" placeholder="Nama"
                   class="auth-input" required>

            <input type="email" name="email" placeholder="Email"
                   class="auth-input" required>

            <input type="password" name="password" placeholder="Password"
                   class="auth-input" required>

            <input type="password" name="password_confirmation"
                   placeholder="Konfirmasi Password"
                   class="auth-input" required>

            <button type="submit" class="btn-primary full">
                Daftar
            </button>

            <div class="auth-switch">
                Sudah punya akun?
                <a href="{{ route('login') }}">Masuk di sini</a>
            </div>

        </form>

    </div>
</div>
@endsection
