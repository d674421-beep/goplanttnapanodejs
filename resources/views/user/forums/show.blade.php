@extends('user.layouts.app')

@section('content')

<div class="card mt-4 p-3">
    <div class="card">
        <h2 class="text-xl font-bold mb-2">
            {{ $forum->judul }}
        </h2>

        <p style="white-space: pre-line;">
            {{ $forum->isi }}
        </p>
    </div>

    {{-- AKSI PEMILIK --}}
    @if($forum->user_id === auth()->id())
        <div class="mt-4 flex gap-3">
            <a href="{{ route('user.forums.edit', $forum) }}"
               class="btn btn-edit">
                Edit
            </a>

            <button onclick="openDeleteModal()"
                    class="btn btn-delete">
                Hapus
            </button>
        </div>
    @endif

    <hr class="my-6">

    {{-- Komentar --}}
    @include('user.comments.forum._item')
</div>


@auth
<div class="card">
    <h3>Tulis Komentar</h3>

    <form method="POST"
          action="{{ route('user.forums.comments.store', $forum->id) }}">
        @csrf

        <div class="form-group">
            <textarea name="isi" rows="4" required>{{ old('isi') }}</textarea>
        </div>

        <div class="mt-3">
            <button class="btn btn-primary">Kirim</button>
            <button type="reset" class="btn btn-secondary ml-2">
                Hapus
            </button>
        </div>
    </form>
</div>
@endauth


{{-- TOMBOL KEMBALI DI BAWAH --}}
<div class="mt-6">
    <a href="{{ route('user.forums.index') }}"
       class="btn btn-secondary">
        ← Kembali ke Forum
    </a>
</div>


{{-- ================= MODAL DELETE ================= --}}
<div id="deleteModal"
     class="fixed inset-0 z-50 hidden
            bg-black/50 flex items-center justify-center">

    <div class="card max-w-md w-full">
        <h3 class="text-lg font-bold mb-3">
            Hapus Forum
        </h3>

        <p class="text-muted mb-6">
            Apakah kamu yakin ingin menghapus forum ini?
            <br>
            <span class="text-red-600 font-semibold">
                Tindakan ini tidak dapat dibatalkan.
            </span>
        </p>

        <div class="flex justify-end gap-3">
            <button onclick="closeDeleteModal()"
                    class="btn btn-secondary">
                Batal
            </button>

            <form method="POST"
                  action="{{ route('user.forums.destroy', $forum) }}">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="btn btn-delete">
                    Ya, Hapus
                </button>
            </form>
        </div>
    </div>
</div>

<script>
function openDeleteModal() {
    document.getElementById('deleteModal')
        .classList.remove('hidden');
}

function closeDeleteModal() {
    document.getElementById('deleteModal')
        .classList.add('hidden');
}
</script>
@endsection



