@extends('admin.layouts.app')

@section('content')
<a href="{{ route('admin.forums.index') }}" class="btn-back">← Kembali ke Forum</a>

<div class="card">
    <h2>Edit Forum</h2>

    <form method="POST" action="{{ route('admin.forums.update', $forum) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Judul</label>
            <input type="text" name="judul"
                   value="{{ old('judul', $forum->judul) }}" required>
        </div>

        <div class="form-group">
            <label>Isi</label>
            <textarea name="isi" rows="5" required>{{ old('isi', $forum->isi) }}</textarea>
        </div>
        <div style="margin-top: 12px;">
			<button type="submit" class="btn-primary">
				Simpan Perubahan
			</button>

			<a href="{{ route('admin.forums.index') }}"
			   class="btn-secondary"
			   style="margin-left: 8px;">
				Batal
			</a>
		</div>

    </form>
</div>
@endsection
