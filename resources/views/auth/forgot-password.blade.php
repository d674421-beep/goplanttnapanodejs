@extends('layouts.guest')

@section('content')

<div style="max-width:400px; margin:80px auto; padding:24px; background:white; border-radius:8px">

    <p style="font-size:14px; color:#4b5563; margin-bottom:16px">
        Forgot your password? No problem.
        Enter your email address and we will send you a password reset link.
    </p>

    {{-- Session status --}}
    @if (session('status'))
        <div style="margin-bottom:12px; color:green; font-size:14px">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div style="margin-bottom:16px">
            <label for="email" style="display:block; margin-bottom:6px">
                Email
            </label>

            <input
                type="email"
                name="email"
                id="email"
                value="{{ old('email') }}"
                required
                autofocus
                style="width:100%; padding:10px; border:1px solid #d1d5db; border-radius:6px"
            >

            @error('email')
                <div style="color:red; font-size:13px; margin-top:4px">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <button
            type="submit"
            style="
                width:100%;
                background:#16a34a;
                color:white;
                padding:10px;
                border:none;
                border-radius:6px;
                cursor:pointer;
            "
        >
            Email Password Reset Link
        </button>
    </form>

</div>

@endsection
