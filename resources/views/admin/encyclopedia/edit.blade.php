@extends('admin.layouts.app')

@section('content')

<h1 class="page-title">
    Edit Ensiklopedia
</h1>

<form action="{{ route('admin.encyclopedia.update', $item->id) }}"
      method="POST"
      enctype="multipart/form-data"
      class="form-wrapper">

    @csrf
    @method('PUT')

    <div class="form-group">
        <label>Judul</label>
        <input type="text"
               name="title"
               value="{{ $item->title }}"
               required>
    </div>

    <div class="form-group">
        <label>Isi Artikel</label>
        <textarea name="content"
                  rows="6"
                  required>{{ $item->content }}</textarea>
    </div>

    <div class="form-group">
        <label>Gambar</label>

        @if($item->image)
            <img src="{{ asset('storage/'.$item->image) }}"
                 class="preview-image">
        @endif

        <input type="file" name="image">

        <small class="form-hint">
            Kosongkan jika tidak ingin mengganti gambar
        </small>
    </div>

    <div class="form-group">
        <label>Video URL</label>
        <input type="url"
               name="video_url"
               value="{{ $item->video_url }}">
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-primary">
            Update
        </button>

        <a href="{{ route('admin.encyclopedia.index') }}"
           class="btn btn-secondary">
            Batal
        </a>
    </div>

</form>

@endsection
