@extends('user.layouts.app')

@section('content')
<div class="form-wrapper">
    <h1 class="text-xl font-bold mb-4">Ajukan Forum Baru</h1>

    <form method="POST" action="{{ route('user.forums.store') }}">
        @csrf

        <div class="form-group">
            <label>Judul</label>
            <input type="text" name="judul" value="{{ old('judul') }}" required>
        </div>

        <div class="form-group">
            <label>Isi</label>
            <textarea name="isi" rows="6" required>{{ old('isi') }}</textarea>
        </div>

        <div style="display:flex;gap:10px;">
            <button class="btn-primary">Kirim</button>
            <a href="{{ route('user.forums.index') }}"
               class="btn-secondary">Batal</a>
        </div>
    </form>

    <p style="margin-top:10px;color:#666;font-size:13px;">
        Forum akan ditinjau admin sebelum ditampilkan.
    </p>
</div>
@endsection
