@extends('user.layouts.app')

@section('content')
<div class="card">
    <h1 class="text-xl font-bold mb-4">Forum Diskusi</h1>

    <a href="{{ route('user.forums.create') }}"
       class="btn btn-primary mb-4">
        + Ajukan Forum
    </a>

    {{-- SORT BAR --}}
    <form method="GET"
          action="{{ route('user.forums.index') }}"
          class="sort-bar">

        <div class="sort-group">
            <label>Urutkan</label>
            <select name="order">
                <option value="date_desc" {{ request('order','date_desc') === 'date_desc' ? 'selected' : '' }}>
                    Tanggal (Terbaru)
                </option>
                <option value="date_asc" {{ request('order') === 'date_asc' ? 'selected' : '' }}>
                    Tanggal (Terlama)
                </option>
                <option value="title_asc" {{ request('order') === 'title_asc' ? 'selected' : '' }}>
                    Judul (A–Z)
                </option>
                <option value="title_desc" {{ request('order') === 'title_desc' ? 'selected' : '' }}>
                    Judul (Z–A)
                </option>
            </select>
        </div>

        <button type="submit" class="btn btn-sort">
            Terapkan
        </button>
    </form>

    {{-- TABLE --}}
    <table class="table">
        <thead>
            <tr>
                <th>Nama Forum</th>
                <th>Pembuat</th>
                <th>Tanggal Dibuat</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
        @forelse ($forums as $forum)
            <tr>
                <td>{{ $forum->judul }}</td>
                <td>{{ $forum->user->name }}</td>
                <td>{{ $forum->created_at->format('d M Y') }}</td>

                {{-- STATUS --}}
                <td>
                    <div class="status-box">
                        @if($forum->is_approved)
                            <span class="status approved">Approved</span>
                        @else
                            <span class="status pending">Pending</span>
                        @endif
                    </div>
                </td>

                {{-- AKSI --}}
                <td>
                    <div class="action-buttons">

                        <a href="{{ route('user.forums.show', $forum) }}"
                           class="btn btn-view">
                            Lihat
                        </a>

                        @if($forum->user_id === auth()->id())
                            <a href="{{ route('user.forums.edit', $forum) }}"
                               class="btn btn-edit">
                                Edit
                            </a>

                            <button onclick="openDeleteModal('{{ route('user.forums.destroy', $forum) }}')"
                                    class="btn btn-delete">

                                Hapus
                            </button>
                        @endif

                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center text-muted">
                    Belum ada forum.
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

{{-- ================= MODAL DELETE ================= --}}
<div id="deleteModal" class="modal-overlay">

    <div class="modal-box">

        <h3>Hapus Forum</h3>

        <p class="text-muted" style="margin:10px 0 20px;">
            Apakah kamu yakin ingin menghapus forum ini?
            <br>
            <span style="color:var(--danger); font-weight:600;">
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


{{-- ================= SCRIPT ================= --}}
<script>
function openDeleteModal(url) {
    document.getElementById('deleteForm').action = url;
    document.getElementById('deleteModal').classList.add('show');
}

function closeDeleteModal() {
    document.getElementById('deleteModal').classList.remove('show');
}
</script>
@endsection
