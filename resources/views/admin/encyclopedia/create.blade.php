@extends('admin.layouts.app')

@section('content')

<h1 class="page-title">
    Tambah Ensiklopedia
</h1>

<form action="{{ route('admin.encyclopedia.store') }}"
      method="POST"
      enctype="multipart/form-data"
      class="form-wrapper">

    @csrf

    <div class="form-group">
        <label>Judul</label>
        <input type="text" name="title" required>
    </div>

    <div class="form-group">
        <label>Isi Artikel</label>
        <textarea name="content" rows="6" required></textarea>
    </div>

    <div class="form-group">
        <label>Foto</label>
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <label>Video URL</label>
        <input type="url" name="video_url">
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-primary">
            Simpan
        </button>

        <a href="{{ route('admin.encyclopedia.index') }}"
           class="btn btn-secondary">
            Batal
        </a>
    </div>

</form>

@endsection
