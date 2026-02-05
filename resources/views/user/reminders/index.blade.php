@extends('user.layouts.app')

@section('content')
<div class="card">
    <h1 class="text-xl font-bold mb-4">Pengingat Saya</h1>

    <a href="{{ route('user.reminders.create') }}"
       class="btn btn-primary mb-4">
        + Tambah Reminder
    </a>

    {{-- SORT BAR --}}
    <div>
        <form method="GET"
              action="{{ route('user.reminders.index') }}"
              class="sort-bar">

            <div class="sort-group">
                <label>Urutkan</label>
                <select name="order">
                    <option value="time_asc" {{ request('order','time_asc') === 'time_asc' ? 'selected' : '' }}>
                        Waktu (Terdekat)
                    </option>
                    <option value="time_desc" {{ request('order') === 'time_desc' ? 'selected' : '' }}>
                        Waktu (Terlama)
                    </option>
                    <option value="status_waiting" {{ request('order') === 'status_waiting' ? 'selected' : '' }}>
                        Status (Menunggu dulu)
                    </option>
                    <option value="status_sent" {{ request('order') === 'status_sent' ? 'selected' : '' }}>
                        Status (Terkirim dulu)
                    </option>
                </select>
            </div>

            <button type="submit" class="btn btn-sort">
                Terapkan
            </button>
        </form>
    </div>

    {{-- TABLE --}}
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
                <td>{{ $r->remind_at->format('d M Y H:i') }}</td>
                <td>
                    @if($r->email_sent)
                        <span class="status approved">Terkirim</span>
                    @else
                        <span class="status pending">Menunggu</span>
                    @endif
                </td>
                <td>
                    <div class="action-buttons">
                        <a href="{{ route('user.reminders.edit', $r) }}"
                           class="btn btn-edit">
                            Edit
                        </a>

                        <button type="button"
                                onclick="openDeleteModal('{{ route('user.reminders.destroy', $r) }}')"
                                class="btn btn-delete">
                            Hapus
                        </button>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="text-center text-muted">
                    Belum ada reminder
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>


{{-- ================= MODAL DELETE ================= --}}
<div id="deleteModal" class="modal-overlay hidden">
    <div class="modal-box">

        <h3>Hapus Reminder</h3>

        <p class="text-muted" style="margin:10px 0 20px;">
            Apakah kamu yakin ingin menghapus reminder ini?
            <br>
            <span style="color:var(--danger); font-weight:600;">
                Tindakan ini tidak dapat dibatalkan.
            </span>
        </p>

        <div class="modal-actions">
            <button type="button"
                    onclick="closeDeleteModal()"
                    class="btn btn-secondary">
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
@endsection


@push('scripts')
<script>
function openDeleteModal(url) {
    const form = document.getElementById('deleteForm');
    const modal = document.getElementById('deleteModal');

    form.action = url;
    modal.classList.remove('hidden');
    modal.classList.add('show');
}

function closeDeleteModal() {
    const modal = document.getElementById('deleteModal');
    modal.classList.remove('show');
    modal.classList.add('hidden');
}

// klik area gelap = tutup
document.addEventListener('click', function(e){
    const modal = document.getElementById('deleteModal');
    if (e.target === modal) closeDeleteModal();
});
</script>
@endpush
