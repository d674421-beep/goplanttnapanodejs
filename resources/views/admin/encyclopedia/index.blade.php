@extends('admin.layouts.app')

@section('content')
<div class="card">
    <h1 class="page-title">Ensiklopedia Tanaman</h1>

    <a href="{{ route('admin.encyclopedia.create') }}" class="btn btn-primary mb-4">
        + Tambah Ensiklopedia
    </a>

    {{-- FILTER BAR --}}
    <form method="GET" action="{{ route('admin.encyclopedia.index') }}" class="filter-bar mb-4">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari judul atau isi...">
        <select name="sort">
            <option value="latest" {{ request('sort') === 'latest' ? 'selected' : '' }}>Tanggal (Terbaru)</option>
            <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>Tanggal (Terlama)</option>
            <option value="az" {{ request('sort') === 'az' ? 'selected' : '' }}>Judul (A–Z)</option>
            <option value="za" {{ request('sort') === 'za' ? 'selected' : '' }}>Judul (Z–A)</option>
        </select>
        <button type="submit" class="btn btn-sort">Terapkan</button>
        <a href="{{ route('admin.encyclopedia.index') }}" class="btn btn-secondary">Reset</a>
    </form>

    @if($data->isEmpty())
        <p class="text-muted">Belum ada data.</p>
    @else
        @foreach ($data as $item)
            <div class="card item-card mb-4 p-4">
                <h3 class="item-title mb-2">{{ $item->title }}</h3>

                @if($item->image)
                    <img src="{{ asset($item->image) }}" class="item-image mb-2">
                @endif


                <p class="item-content mb-2">{{ $item->content }}</p>

                @if($item->video_url)
                    @php
                        preg_match(
                            '%(?:youtube\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i',
                            $item->video_url,
                            $match
                        );
                        $videoId = $match[1] ?? null;
                    @endphp

                    @if($videoId)
                        <iframe
                            class="item-video mb-2"
                            src="https://www.youtube.com/embed/{{ $videoId }}"
                            allowfullscreen>
                        </iframe>
                    @endif
                @endif


                <div class="action-buttons flex gap-2">
                    <a href="{{ route('admin.encyclopedia.edit', $item->id) }}" class="btn btn-edit">Edit</a>
                    <button onclick="openDeleteModal({{ $item->id }})" class="btn btn-delete">Hapus</button>
                </div>
            </div>
        @endforeach
    @endif
</div>

{{-- ================= MODAL DELETE ================= --}}
<div id="deleteEncyclopediaModal" class="modal-overlay hidden">
    <div class="modal-box card p-6 max-w-md w-full">
        <h3 class="modal-title text-lg font-bold mb-3">Hapus Ensiklopedia</h3>
        <p class="modal-text text-muted mb-6">
            Apakah kamu yakin ingin menghapus data ini?
            <br>
            <strong class="text-danger">Tindakan ini tidak dapat dibatalkan.</strong>
        </p>

        <div class="modal-actions flex justify-end gap-3">
            <button onclick="closeDeleteModal()" class="btn btn-secondary">Batal</button>
            <form id="deleteEncyclopediaForm" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-delete">Ya, Hapus</button>
            </form>
        </div>
    </div>
</div>


{{-- ================= SCRIPT ================= --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const deleteModal = document.getElementById('deleteEncyclopediaModal');
    const deleteForm = document.getElementById('deleteEncyclopediaForm');

    window.openDeleteModal = function(id) {
        deleteForm.action = `/admin/encyclopedia/${id}`;
        deleteModal.classList.add('show');
    }

    window.closeDeleteModal = function() {
        deleteModal.classList.remove('show');
    }


    // Klik overlay untuk close modal
    deleteModal.addEventListener('click', function(e) {
        if (e.target === deleteModal) closeDeleteModal();
    });
});
</script>
@endsection
