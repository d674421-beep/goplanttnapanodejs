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
        <a href="{{ route('admin.encyclopedia.index') }}" class="btn btn-view">Reset</a>
    </form>

    @if($data->isEmpty())
        <p class="text-muted">Belum ada data.</p>
    @else
        @foreach ($data as $item)
            <div class="card item-card mb-4 p-4">
                <h3 class="item-title mb-2">{{ $item->title }}</h3>

                @if($item->image)
                    <img src="{{ asset($item->image) }}" class="item-image mb-2" alt="{{ $item->title }}">
                @endif

                <p class="item-content mb-2">{{ Str::limit($item->content, 200) }}</p>

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
                            allowfullscreen
                            title="{{ $item->title }}">
                        </iframe>
                    @endif
                @endif

                <div class="action-buttons">
                    <a href="{{ route('admin.encyclopedia.edit', $item->id) }}" class="btn btn-edit">Edit</a>
                    <button type="button" onclick="openDeleteModal({{ $item->id }})" class="btn btn-delete">Hapus</button>
                </div>
            </div>
        @endforeach

        {{-- Pagination jika ada --}}
        @if(method_exists($data, 'links'))
            <div class="mt-4">
                {{ $data->links() }}
            </div>
        @endif
    @endif
</div>

{{-- ================= MODAL DELETE ================= --}}
<div id="deleteEncyclopediaModal" class="modal-overlay">
    <div class="modal-box">
        <h3 class="modal-title">Hapus Ensiklopedia</h3>
        <p class="modal-text">
            Apakah kamu yakin ingin menghapus data ini?
            <br>
            <strong class="text-danger">Tindakan ini tidak dapat dibatalkan.</strong>
        </p>

        <div class="modal-actions">
            <button type="button" onclick="closeDeleteModal()" class="btn btn-view">Batal</button>
            <form id="deleteEncyclopediaForm" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-delete">Ya, Hapus</button>
            </form>
        </div>
    </div>
</div>

{{-- ================= SCRIPT ================= --}}
<script>
(function() {
    'use strict';

    const deleteModal = document.getElementById('deleteEncyclopediaModal');
    const deleteForm = document.getElementById('deleteEncyclopediaForm');

    // Fungsi buka modal
    window.openDeleteModal = function(id) {
        if (!deleteModal || !deleteForm) {
            console.error('Modal atau Form tidak ditemukan!');
            return;
        }
        
        deleteForm.action = `/admin/encyclopedia/${id}`;
        deleteModal.classList.add('show');
        
        // Prevent body scroll saat modal terbuka
        document.body.style.overflow = 'hidden';
    };

    // Fungsi tutup modal
    window.closeDeleteModal = function() {
        if (!deleteModal) return;
        
        deleteModal.classList.remove('show');
        
        // Restore body scroll
        document.body.style.overflow = '';
    };

    // Klik di luar modal untuk menutup
    if (deleteModal) {
        deleteModal.addEventListener('click', function(e) {
            if (e.target === deleteModal) {
                closeDeleteModal();
            }
        });
    }

    // Tutup modal dengan ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && deleteModal.classList.contains('show')) {
            closeDeleteModal();
        }
    });

    // Konfirmasi sebelum submit
    if (deleteForm) {
        deleteForm.addEventListener('submit', function(e) {
            // Bisa ditambahkan loading state di sini
            const submitBtn = this.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.textContent = 'Menghapus...';
            }
        });
    }
})();
</script>

@if(session('success'))
<script>
    // Auto hide success message after 3 seconds
    setTimeout(function() {
        const alert = document.querySelector('.alert-success');
        if (alert) {
            alert.style.transition = 'opacity 0.3s';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 300);
        }
    }, 3000);
</script>
@endif
@endsection