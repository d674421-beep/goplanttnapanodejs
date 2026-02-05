{{-- resources/views/admin/comments/forum/_form.blade.php --}}

<form method="POST"
      action="{{ route('admin.forums.comments.update', $comment) }}">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="isi">Isi Komentar</label>
        <textarea
            name="isi"
            id="isi"
            rows="4"
            required>{{ old('isi', $comment->isi) }}</textarea>
    </div>

    <div style="margin-top:10px; display:flex; gap:6px;">
        <!-- Simpan -->
        <button type="submit" class="btn-primary">
            Simpan
        </button>

        <!-- Kosongkan (HANYA UI) -->
        <button
            type="button"
            class="btn-delete"
            onclick="document.getElementById('isi').value = ''">
            Kosongkan
        </button>

        <!-- Kembali -->
        <a href="{{ route('admin.forums.show', $forum) }}"
           class="btn-back-secondary">
            Kembali
        </a>
    </div>
</form>


	