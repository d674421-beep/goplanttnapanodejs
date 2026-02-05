@extends('admin.layouts.app')

@section('content')
<div class="form-wrapper">
    <h1 class="text-xl font-bold mb-4">Edit Postingan</h1>

    <form method="POST" action="{{ route('admin.posts.update', $post) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Judul</label>
            <input type="text" name="title" value="{{ $post->title }}">
        </div>

        <div class="form-group">
            <label>Kategori</label>
            <select name="category">
                <option value="news" {{ $post->category=='news'?'selected':'' }}>Berita</option>
                <option value="info" {{ $post->category=='info'?'selected':'' }}>Informasi</option>
                <option value="announcement" {{ $post->category=='announcement'?'selected':'' }}>Pengumuman</option>
            </select>
        </div>

        <div class="form-group">
            <label>Konten</label>
            <textarea name="content">{{ old('content', $post->content) }}</textarea>
        </div>

        <div class="form-group">
            <label>Gambar</label>
            @if($post->image)
                <img src="{{ asset('storage/'.$post->image) }}" alt="thumbnail">
            @endif
            <input type="file" name="image">
        </div>

        <div class="form-group" style="display:flex; gap:10px;">
            <button type="submit" class="btn-primary">Update</button>
            <a href="{{ route('admin.posts.index') }}" class="btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
