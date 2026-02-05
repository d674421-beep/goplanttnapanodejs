@extends('layouts.guest')

@section('content')

<div style="max-width:400px; margin:80px auto; padding:24px; background:white; border-radius:8px">

    <p style="font-size:14px; color:#4b5563; margin-bottom:16px">
        This is a secure area of the application.
        Please confirm your password before continuing.
    </p>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div style="margin-bottom:16px">
            <label for="password" style="display:block; margin-bottom:6px">
                Password
            </label>

            <input
                type="password"
                name="password"
                id="password"
                required
                style="width:100%; padding:10px; border:1px solid #d1d5db; border-radius:6px"
            >

            @error('password')
                <div style="color:red; font-size:13px; margin-top:4px">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div style="text-align:right">
            <button
                type="submit"
                style="
                    background:#16a34a;
                    color:white;
                    padding:10px 16px;
                    border:none;
                    border-radius:6px;
                    cursor:pointer;
                "
            >
                Confirm
            </button>
        </div>

    </form>

</div>

@endsection
