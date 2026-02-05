@extends('user.layouts.app')

@section('content')
<div class="form-wrapper">
    <h1 class="text-xl font-bold mb-4">Tulis Postingan</h1>

    <form method="POST"
          action="{{ route('user.posts.store') }}"
          enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label>Judul</label>
            <input type="text" name="title" required>
        </div>

        <div class="form-group">
            <label>Kategori</label>
            <select name="category">
                <option value="news">Berita</option>
                <option value="info">Informasi</option>
                <option value="announcement">Pengumuman</option>
            </select>
        </div>

        <div class="form-group">
            <label>Isi</label>
            <textarea name="content" rows="6"></textarea>
        </div>

        <div class="form-group">
            <label>Gambar</label>
            <input type="file" name="image">
        </div>

        <div style="display:flex; gap:10px;">
            <button class="btn-primary">Simpan</button>
            <a href="{{ route('user.posts.index') }}"
               class="btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
