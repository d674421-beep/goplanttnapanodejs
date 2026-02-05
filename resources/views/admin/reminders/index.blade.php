@extends('admin.layouts.app')

@section('content')
<div class="card">
    <h1 class="text-xl font-bold mb-4">Reminder</h1>

    <a href="{{ route('admin.reminders.create') }}"
       class="btn btn-primary mb-4">
        + Tambah Reminder
    </a>

    {{-- SORT BAR --}}
    <form method="GET" action="{{ route('admin.reminders.index') }}" class="sort-bar mb-4">
        <div class="sort-group">
            <label>Urutkan</label>
            <select name="order">
                <option value="time_asc" {{ $order === 'time_asc' ? 'selected' : '' }}>Waktu (Terbaru)</option>
                <option value="time_desc" {{ $order === 'time_desc' ? 'selected' : '' }}>Waktu (Terlama)</option>
                <option value="status_waiting" {{ $order === 'status_waiting' ? 'selected' : '' }}>Status (Menunggu dulu)</option>
                <option value="status_sent" {{ $order === 'status_sent' ? 'selected' : '' }}>Status (Terkirim dulu)</option>
            </select>
        </div>
        <button type="submit" class="btn btn-sort">Terapkan</button>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Waktu</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @forelse($reminders as $r)
            <tr>
                <td>{{ $r->title }}</td>
                <td>{{ $r->remind_at }}</td>
                <td>
                    @if($r->email_sent)
                        <span class="status approved">Terkirim</span>
                    @else
                        <span class="status pending">Menunggu</span>
                    @endif
                </td>
                <td>
                    <div class="action-buttons flex flex-wrap gap-2">
                        <a href="{{ route('admin.reminders.edit', $r) }}" class="btn btn-edit">Edit</a>
                        <button onclick="openDeleteModal('{{ route('admin.reminders.destroy', $r) }}')"
                                class="btn btn-delete">
                            Hapus
                        </button>

                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="text-center text-muted">Belum ada reminder</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

{{-- ================= MODAL DELETE ================= --}}
<div id="deleteReminderModal" class="modal hidden">
    <div class="card max-w-md w-full p-6">
        <h3 class="text-lg font-bold mb-3">Hapus Reminder</h3>
        <p class="text-muted mb-6">
            Apakah kamu yakin ingin menghapus reminder ini?
            <br>
            <span class="text-red-600 font-semibold">Tindakan ini tidak dapat dibatalkan.</span>
        </p>

        <div class="flex justify-end gap-3">
            <button onclick="closeDeleteModal()" class="btn btn-secondary">Batal</button>
            <form id="deleteReminderForm" method="POST">
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
function openDeleteModal(url) {
    const form = document.getElementById('deleteReminderForm');
    form.action = url;
    document.getElementById('deleteReminderModal').classList.remove('hidden');
}

function closeDeleteModal() {
    document.getElementById('deleteReminderModal').classList.add('hidden');
}
</script>
@endsection
