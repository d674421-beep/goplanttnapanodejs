@extends('admin.layouts.app')

@section('content')
<div class="card">
    <h1 class="text-xl font-bold mb-4">Postingan / Berita</h1>

    <a href="{{ route('admin.posts.create') }}"
       class="btn btn-primary mb-4 inline-block">
        + Tambah Postingan
    </a>

    {{-- SORT BAR --}}
    <form method="GET" action="{{ route('admin.posts.index') }}" class="sort-bar mb-4">
        <div class="sort-group">
            <label>Urutkan</label>
            <select name="sort">
                <option value="latest" {{ $sort === 'latest' ? 'selected' : '' }}>Tanggal (Terbaru)</option>
                <option value="oldest" {{ $sort === 'oldest' ? 'selected' : '' }}>Tanggal (Terlama)</option>
                <option value="az" {{ $sort === 'az' ? 'selected' : '' }}>Judul (A–Z)</option>
                <option value="za" {{ $sort === 'za' ? 'selected' : '' }}>Judul (Z–A)</option>
            </select>
        </div>
        <button type="submit" class="btn btn-sort">Terapkan</button>
    </form>

    {{-- TABLE --}}
    <div class="table-wrapper">
    <table class="table">

        <thead>
            <tr>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Pembuat</th>
                <th class="w-20 text-center">Gambar</th>

                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
        @forelse($posts as $post)
            <tr>
                <td class="max-w-xs truncate">{{ $post->title }}</td>
                <td>{{ ucfirst($post->category) }}</td>
                <td>{{ $post->user->name }}</td>
                <td class="img-col">
                    @if($post->image)
                        <div class="img-wrap">
                            <img src="{{ asset('storage/'.$post->image) }}">
                        </div>
                    @endif
                </td>


                <td>{{ $post->created_at->format('d M Y') }}</td>
                <td>
                    <div class="action-buttons flex flex-wrap gap-2">
                        <a href="{{ route('admin.posts.show', $post) }}" class="btn btn-view">Lihat</a>

                        {{-- Hanya pemilik --}}
                        @if($post->user_id === auth()->id())
                            <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-edit">Edit</a>
                            <button onclick="openDeleteModal({{ $post->id }})" class="btn btn-delete">Hapus</button>
                        @endif
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center text-muted">Belum ada postingan</td>
            </tr>
        @endforelse
        </tbody>
        </table>
    </div>

</div>

{{-- ================= MODAL DELETE ================= --}}
<div id="deletePostModal" class="modal hidden">
    <div class="card max-w-md w-full p-6">
        <h3 class="text-lg font-bold mb-3">Hapus Postingan</h3>
        <p class="text-muted mb-6">
            Apakah kamu yakin ingin menghapus postingan ini?
            <br>
            <span class="text-red-600 font-semibold">Tindakan ini tidak dapat dibatalkan.</span>
        </p>

        <div class="flex justify-end gap-3">
            <button onclick="closeDeleteModal()" class="btn btn-secondary">Batal</button>
            <form id="deletePostForm" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-delete">Ya, Hapus</button>
            </form>
        </div>
    </div>
</div>

{{-- ================= MODAL CSS ================= --}}
<style>
.modal {
    position: fixed;
    inset: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    background: rgba(0,0,0,0.5);
    z-index: 9999;
}
.modal.hidden {
    display: none;
}
</style>

{{-- ================= SCRIPT ================= --}}
<script>
function openDeleteModal(id) {
    const form = document.getElementById('deletePostForm');
    form.action = `/admin/posts/${id}`;
    document.getElementById('deletePostModal').classList.remove('hidden');
}

function closeDeleteModal() {
    document.getElementById('deletePostModal').classList.add('hidden');
}
</script>
@endsection
