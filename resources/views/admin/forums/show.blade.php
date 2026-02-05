@extends('admin.layouts.app')

@section('content')
<div class="card mt-4 p-3">
    

    <div class="card">
        <h2>{{ $forum->judul }}</h2>
        <p style="white-space: pre-line;">
            {{ $forum->isi }}
        </p>
    </div>

    {{-- INI YANG BARU --}}
    @include('admin.comments.forum._item')

</div>

@auth
<div class="card">
    <h3>Tulis Komentar</h3>

    <form method="POST"
          action="{{ route('admin.forums.comments.store', $forum) }}">
        @csrf

        <div class="form-group">
            <textarea name="content" rows="4" required>{{ old('content') }}</textarea>
        </div>

        <div style="margin-top: 10px;">
            <button type="submit" class="btn-primary">Simpan</button>

            <button type="reset" class="btn-secondary" style="margin-left:6px;">
				Hapus
			</button>

        </div>
    </form>
	
	
	<a href="{{ route('admin.forums.index') }}"
       class="btn-secondary"
       style="margin-top:20px; display:inline-block;">
        Kembali
    </a>
</div>
@endauth
@endsection
