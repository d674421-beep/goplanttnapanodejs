@extends('user.layouts.app')

@section('content')
<a href="{{ route('user.forums.index') }}" class="btn-back">
    ← Kembali ke Forum
</a>

<div class="card">
    <h2 class="text-xl font-bold mb-4">Edit Forum</h2>

    <form id="updateForumForm"
          method="POST"
          action="{{ route('user.forums.update', $forum) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Judul</label>
            <input type="text"
                   name="judul"
                   value="{{ old('judul', $forum->judul) }}"
                   required>
        </div>

        <div class="form-group">
            <label>Isi</label>
            <textarea name="isi"
                      rows="5"
                      required>{{ old('isi', $forum->isi) }}</textarea>
        </div>

        <div class="flex gap-3 mt-4">
            {{-- tombol buka modal --}}
            <button type="button"
                    onclick="openUpdateModal()"
                    class="btn btn-primary">
                Simpan
            </button>

            <a href="{{ route('user.forums.index') }}"
               class="btn btn-secondary">
                Batal
            </a>
        </div>
    </form>
</div>

{{-- ================= MODAL UPDATE ================= --}}
<div id="updateModal" class="modal-overlay">
    <div class="modal-box">

        <h3>Simpan Perubahan</h3>

        <p class="text-muted" style="margin:10px 0 20px;">
            Apakah kamu yakin ingin menyimpan perubahan pada forum ini?
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
    document.getElementById('updateForumForm').submit();
}

// klik luar modal = tutup
const updateModal = document.getElementById('updateModal');
updateModal.addEventListener('click', function(e){
    if (e.target === updateModal) {
        closeUpdateModal();
    }
});
</script>

@endsection
