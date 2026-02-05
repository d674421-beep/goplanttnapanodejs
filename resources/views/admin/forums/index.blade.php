@extends('admin.layouts.app')

@section('content')
<div class="card">
    <h1 class="text-xl font-bold mb-4">Forum Diskusi</h1>

    <a href="{{ route('admin.forums.create') }}"
       class="btn btn-primary mb-4">
        + Buat Forum Baru
    </a>

    {{-- SORT BAR --}}
    <form method="GET" class="sort-bar mb-4">
        <div class="sort-group">
            <label>Urutkan</label>
            <select name="order">
                <option value="date_desc" {{ $order === 'date_desc' ? 'selected' : '' }}>
                    Tanggal (Terbaru)
                </option>
                <option value="date_asc" {{ $order === 'date_asc' ? 'selected' : '' }}>
                    Tanggal (Terlama)
                </option>
                <option value="title_asc" {{ $order === 'title_asc' ? 'selected' : '' }}>
                    Judul (A–Z)
                </option>
                <option value="title_desc" {{ $order === 'title_desc' ? 'selected' : '' }}>
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
                <th>Judul</th>
                <th>Pembuat</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
        @forelse($forums as $forum)
            <tr>
                <td>{{ $forum->judul }}</td>
                <td>{{ $forum->user->name }}</td>
                <td>{{ $forum->created_at->format('d M Y') }}</td>
                <td>
                    @if($forum->is_approved)
                        <span class="status approved">Approved</span>
                    @else
                        <span class="status pending">Pending</span>
                    @endif
                </td>
                <td>
                    <div class="action-buttons flex flex-wrap gap-2">
                        <a href="{{ route('admin.forums.show', $forum) }}" class="btn btn-view">Lihat</a>
                        <a href="{{ route('admin.forums.edit', $forum) }}" class="btn btn-edit">Edit</a>

                        @if(!$forum->is_approved)
                        <button onclick="openApproveModal({{ $forum->id }})" class="btn btn-approve">Approve</button>
                        @endif

                        <button onclick="openDeleteModal({{ $forum->id }})" class="btn btn-delete">Hapus</button>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center text-muted">
                    Belum ada forum
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

{{-- ================= MODAL DELETE ================= --}}
<div id="deleteForumModal" class="modal hidden">
    <div class="card max-w-md w-full p-6">
        <h3 class="text-lg font-bold mb-3">Hapus Forum</h3>
        <p class="text-muted mb-6">
            Forum ini akan dihapus secara permanen.
            <br>
            <span class="text-red-600 font-semibold">Tindakan ini tidak dapat dibatalkan.</span>
        </p>

        <div class="flex justify-end gap-3">
            <button onclick="closeDeleteModal()" class="btn btn-secondary">Batal</button>
            <form id="deleteForumForm" method="POST" data-base="{{ url('admin/forums') }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-delete">Ya, Hapus</button>
            </form>
        </div>
    </div>
</div>

{{-- ================= MODAL APPROVE ================= --}}
<div id="approveForumModal" class="modal hidden">
    <div class="card max-w-md w-full p-6">
        <h3 class="text-lg font-bold mb-3">Setujui Forum</h3>
        <p class="text-muted mb-6">
            Forum akan langsung tampil ke seluruh pengguna.
        </p>

        <div class="flex justify-end gap-3">
            <button onclick="closeApproveModal()" class="btn btn-secondary">Batal</button>
            <form id="approveForumForm" method="POST" data-base="{{ url('admin/forums') }}">
                @csrf
                @method('PUT')
                <button type="submit" class="btn btn-approve">Ya, Setujui</button>
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
    const form = document.getElementById('deleteForumForm');
    const base = form.dataset.base;
    form.action = `${base}/${id}`;
    document.getElementById('deleteForumModal').classList.remove('hidden');
}

function closeDeleteModal() {
    document.getElementById('deleteForumModal').classList.add('hidden');
}

function openApproveModal(id) {
    const form = document.getElementById('approveForumForm');
    const base = form.dataset.base;
    form.action = `${base}/${id}/approve`;
    document.getElementById('approveForumModal').classList.remove('hidden');
}

function closeApproveModal() {
    document.getElementById('approveForumModal').classList.add('hidden');
}
</script>
@endsection
