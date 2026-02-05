@extends('user.layouts.app')

@section('content')
<h1 class="mb-4 text-xl font-bold">Edit Pengingat</h1>

<form id="updateReminderForm"
      action="{{ route('user.reminders.update', $reminder) }}"
      method="POST">
    @csrf
    @method('PUT')

    @include('user.reminders._form')

    <div class="mt-4 flex gap-3">
        {{-- tombol buka modal --}}
        <button type="button"
                onclick="openUpdateModal()"
                class="btn btn-primary">
            Update
        </button>

        <a href="{{ route('user.reminders.index') }}"
           class="btn btn-secondary">
            Batal
        </a>
    </div>
</form>

{{-- ================= MODAL UPDATE ================= --}}
<div id="updateModal" class="modal-overlay">
    <div class="modal-box">
        <h3 class="modal-title">Simpan Perubahan</h3>

        <p class="text-muted mb-6">
            Apakah kamu yakin ingin menyimpan perubahan pada pengingat ini?
        </p>

        <div class="modal-actions">
            <button onclick="closeUpdateModal()" class="btn btn-secondary">
                Batal
            </button>

            <button onclick="submitUpdateForm()" class="btn btn-primary">
                Ya, Simpan
            </button>
        </div>
    </div>
</div>


{{-- ================= SCRIPT ================= --}}
<script>
function openUpdateModal() {
    document.getElementById('updateModal').classList.add('show');
}

function closeUpdateModal() {
    document.getElementById('updateModal').classList.remove('show');
}

function submitUpdateForm() {
    document.getElementById('updateReminderForm').submit();
}
</script>

@endsection
