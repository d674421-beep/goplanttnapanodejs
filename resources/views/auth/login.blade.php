@extends('layouts.guest')

@section('content')

<div class="auth-wrapper">
    <div class="auth-card">

        <h2 class="auth-title">
            Login GoPlant
        </h2>

        {{-- SUCCESS MESSAGE --}}
        @if (session('success'))
            <div class="auth-alert success">
                {{ session('success') }}
            </div>
        @endif

        {{-- ERROR MESSAGE --}}
        @if (session('status'))
            <div class="auth-alert error">
                {{ session('status') }}
            </div>
        @endif


        <form method="POST" action="{{ route('login') }}" class="auth-form">
            @csrf

            <input
                type="email"
                name="email"
                placeholder="Email"
                class="auth-input"
                required
            >

            <input
                type="password"
                name="password"
                placeholder="Password"
                class="auth-input"
                required
            >
           
            <div class="auth-extra">
                <a href="{{ route('password.check.form') }}">Lupa password?</a>

            </div>

            <button type="submit" class="btn-primary full">
                Login
            </button>

            <div class="auth-switch">
                Belum punya akun?
                <a href="{{ route('register') }}">Daftar di sini</a>
            </div>

        </form>

    </div>
</div>

@endsection
