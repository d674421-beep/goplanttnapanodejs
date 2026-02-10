@extends('user.layouts.app')

@section('content')
<div class="card">
    <h1 class="text-xl font-bold mb-4">Postingan / Berita</h1>

    {{-- TOMBOL TAMBAH --}}
    <a href="{{ route('user.posts.create') }}"
       class="btn btn-primary mb-4 inline-block">
        + Tulis Postingan
    </a>

    {{-- SORT --}}
    <form method="GET"
          action="{{ route('user.posts.index') }}"
          class="sort-bar">

        <div class="sort-group">
            <label>Urutkan</label>
            <select name="sort">
                <option value="latest" {{ request('sort','latest')=='latest'?'selected':'' }}>
                    Tanggal (Terbaru)
                </option>
                <option value="oldest" {{ request('sort')=='oldest'?'selected':'' }}>
                    Tanggal (Terlama)
                </option>
                <option value="az" {{ request('sort')=='az'?'selected':'' }}>
                    Judul (A–Z)
                </option>
                <option value="za" {{ request('sort')=='za'?'selected':'' }}>
                    Judul (Z–A)
                </option>
            </select>
        </div>

        <button type="submit" class="btn btn-sort">
            Terapkan
        </button>
    </form>

    {{-- TABLE --}}
    <div class="table-wrapper">
    <table class="table">

        <thead>
            <tr>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Kategori</th>
                <th>Gambar</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
        @forelse($posts as $post)
            <tr>
                <td>{{ $post->title }}</td>

                {{-- PENULIS --}}
                <td>
                    {{ $post->user->name ?? '—' }}
                </td>

                <td>{{ ucfirst($post->category) }}</td>

                <td>
                    @if($post->image)
                        <div class="img-wrap">
                            <img src="{{ asset($post->image) }}">

                        </div>

                    @endif
                </td>

                <td>{{ $post->created_at->format('d M Y') }}</td>

                <td>
                    <div class="action-buttons">
                        <a href="{{ route('user.posts.show', $post) }}"
                           class="btn btn-view">
                            Lihat
                        </a>

                        @if($post->user_id === auth()->id())
                            <a href="{{ route('user.posts.edit', $post) }}?redirect_to=index"
                            class="btn btn-edit">
                            Edit
                        </a>

                            <button onclick="openDeleteModal('{{ route('user.posts.destroy', $post) }}')"
                                    class="btn btn-delete">

                                Hapus
                            </button>
                        @endif
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center text-muted">
                    Belum ada postingan.
                </td>
            </tr>
        @endforelse
        </tbody>
        </table>
        </div>

</div>

{{-- ================= MODAL DELETE ================= --}}
<div id="deleteModal" class="modal-overlay">
    <div class="modal-box">

        <h3 class="modal-title">
            Hapus Postingan
        </h3>

        <p class="modal-text">
            Apakah kamu yakin ingin menghapus postingan ini?
            <br>
            <span class="text-danger">
                Tindakan ini tidak dapat dibatalkan.
            </span>
        </p>

        <div class="modal-actions">
            <button onclick="closeDeleteModal()" class="btn btn-secondary">
                Batal
            </button>

            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-delete">
                    Ya, Hapus
                </button>
            </form>
        </div>

    </div>
</div>


<script>
function openDeleteModal(url) {
    document.getElementById('deleteForm').action = url;
    document.getElementById('deleteModal').classList.add('show');
}

function closeDeleteModal() {
    document.getElementById('deleteModal').classList.remove('show');
}

document.getElementById('deleteModal')?.addEventListener('click', function(e){
    if(e.target === this) closeDeleteModal();
});
</script>


@endsection
