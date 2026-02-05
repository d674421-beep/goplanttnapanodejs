@extends('layouts.guest')

@section('content')

<div style="max-width:420px; margin:80px auto; padding:32px; background:white; border-radius:8px; text-align:center">

    <h2 style="margin-bottom:16px">Verifikasi Email</h2>

    <p style="color:#4b5563; margin-bottom:20px">
        Terima kasih telah mendaftar.
        Silakan cek email kamu dan klik link verifikasi.
    </p>

    @if (session('status') === 'verification-link-sent')
        <p style="color:green; margin-bottom:16px">
            Link verifikasi baru telah dikirim.
        </p>
    @endif

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button style="width:100%; padding:10px; background:#16a34a; color:white; border:none; border-radius:6px">
            Kirim Ulang Email Verifikasi
        </button>
    </form>

    <form method="POST" action="{{ route('logout') }}" style="margin-top:12px">
        @csrf
        <button style="width:100%; padding:10px; background:#6b7280; color:white; border:none; border-radius:6px">
            Logout
        </button>
    </form>

</div>

@endsection
