@extends('admin.layouts.app')

@section('content')
<div class="form-wrapper">
    <h1 class="text-xl font-bold mb-4">Buat Forum Baru</h1>

    <form method="POST" action="{{ route('admin.forums.store') }}">
        @csrf

        <div class="form-group">
			<label>Judul</label>
			<input type="text" name="judul" value="{{ old('judul') }}" required>
			@error('judul')
				<div class="text-red-600">{{ $message }}</div>
			@enderror
		</div>

		<div class="form-group">
			<label>Isi</label>
			<textarea name="isi" rows="6" required>{{ old('isi') }}</textarea>
			@error('isi')
				<div class="text-red-600">{{ $message }}</div>
			@enderror
		</div>


        <div class="form-group" style="display:flex; gap:10px;">
            <button type="submit" class="btn-primary">Simpan</button>
            <a href="{{ route('admin.forums.index') }}" class="btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
