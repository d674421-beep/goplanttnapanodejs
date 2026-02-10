@extends('user.layouts.app')

@section('content')
<div class="card">

    <h1 class="page-title">{{ $post->title }}</h1>

    <p class="text-muted">
        <strong>Kategori:</strong> {{ ucfirst($post->category) }} |
        <strong>Penulis:</strong> {{ $post->user->name }} |
        <strong>Tanggal:</strong> {{ $post->created_at->format('d M Y') }}
    </p>

    @if($post->image)
        <img src="{{ asset($post->image) }}" class="post-image">

    @endif

    <div class="content-text">
        {!! nl2br(e($post->content)) !!}
    </div>

    @if($post->user_id === auth()->id())
    <div class="action-buttons mt-4">
        <a href="{{ route('user.posts.edit', $post) }}?redirect_to=show"
            class="btn btn-edit">
            Edit
        </a>

        <button onclick="openDeleteModal()" class="btn btn-delete">Hapus</button>
    </div>
    @endif

    <hr class="divider">

    <h2 class="section-title">Komentar</h2>

    @if($post->comments->isEmpty())
        <p class="text-muted">Belum ada komentar.</p>
    @else
        @include('user.comments.post._item', ['comments' => $post->comments])
    @endif

    <hr class="divider">

    <h2 class="section-title">Tulis Komentar</h2>

    <form method="POST" action="{{ route('user.posts.comments.store', $post) }}">
        @csrf
        <textarea name="comment" rows="4" required class="textarea"></textarea>

        <div class="action-buttons mt-3">
            <button type="submit" class="btn btn-primary">Kirim</button>
            <button type="reset" class="btn btn-secondary">Hapus</button>
        </div>
    </form>

    <a href="{{ route('user.posts.index') }}" class="btn btn-secondary mt-4">
        ← Kembali ke Postingan
    </a>
</div>

{{-- MODAL DELETE --}}
<div id="deleteModal" class="modal-overlay">
    <div class="modal-box">
        <h3 class="modal-title">Hapus Postingan</h3>
        <p class="modal-text">
            Apakah kamu yakin ingin menghapus postingan ini?
            <span class="text-danger">Tindakan ini tidak dapat dibatalkan.</span>
        </p>

        <div class="modal-actions">
            <button onclick="closeDeleteModal()" class="btn btn-secondary">Batal</button>
            <form method="POST" action="{{ route('user.posts.destroy', $post) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-delete">Ya, Hapus</button>
            </form>
        </div>
    </div>
</div>

<script>
function openDeleteModal() {
    document.getElementById('deleteModal').classList.add('show');
}
function closeDeleteModal() {
    document.getElementById('deleteModal').classList.remove('show');
}
</script>
@endsection
