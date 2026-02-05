@extends('layouts.guest')

@section('content')

<div class="auth-wrapper">
    <div class="auth-card">

        <h2 class="auth-title">
            Verifikasi Kode OTP
        </h2>

        @if ($errors->any())
            <div class="alert alert-error">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('otp.verify') }}" class="auth-form">
            @csrf

            <input
                type="text"
                name="otp"
                maxlength="6"
                placeholder="Masukkan 6 digit OTP"
                class="auth-input otp-input"
                required
            >

            <button type="submit" class="btn-primary full">
                Verifikasi
            </button>
        </form>

        <form method="POST" action="{{ route('otp.resend') }}" style="margin-top:12px;">
            @csrf
            <button class="link-btn">
                Kirim ulang kode OTP
            </button>
        </form>

    </div>
</div>

@endsection
