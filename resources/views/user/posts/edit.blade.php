@extends('user.layouts.app')

@section('content')
<div class="form-wrapper">
    <h1 class="page-title">Edit Postingan</h1>

    <form id="updateForm"
        method="POST"
        action="{{ route('user.posts.update', $post) }}"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <input type="hidden" name="redirect_to"
            value="{{ request('redirect_to') }}">


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
            <label>Isi</label>
            <textarea name="content">{{ $post->content }}</textarea>
        </div>

        <div class="form-group">
            <label>Gambar</label>
            @if($post->image)
                <img src="{{ asset('storage/'.$post->image) }}" alt="thumbnail">
            @endif
            <input type="file" name="image">
        </div>

        <div class="action-buttons mt-4">
            <button type="button" onclick="openUpdateModal()" class="btn btn-primary">
                Update
            </button>

            @php
                $backRoute = request('redirect_to') === 'index'
                    ? route('user.posts.index')
                    : route('user.posts.show', $post);
            @endphp

            <a href="{{ $backRoute }}" class="btn btn-secondary">
                Batal
            </a>


        </div>
    </form>
</div>

{{-- MODAL --}}
<div id="updateModal" class="modal-overlay">
    <div class="modal-box">
        <h3 class="modal-title">Simpan Perubahan</h3>
        <p class="modal-text">
            Apakah kamu yakin ingin menyimpan perubahan pada postingan ini?
        </p>

        <div class="modal-actions">
            <button onclick="closeUpdateModal()" class="btn btn-secondary">Batal</button>
            <button onclick="submitUpdateForm()" class="btn btn-primary">Ya, Simpan</button>
        </div>
    </div>
</div>

<script>
function openUpdateModal() {
    document.getElementById('updateModal').classList.add('show');
}
function closeUpdateModal() {
    document.getElementById('updateModal').classList.remove('show');
}
function submitUpdateForm() {
    document.getElementById('updateForm').submit();
}
</script>
@endsection
