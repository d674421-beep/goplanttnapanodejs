{{-- resources/views/admin/comments/post/_form.blade.php --}}

<form method="POST"
      action="{{ route('admin.posts.comments.update', $comment) }}">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="comment">Isi Komentar</label>
        <textarea
            name="comment"
            id="comment"
            rows="4"
            required>{{ old('comment', $comment->comment) }}</textarea>
    </div>

    <div style="margin-top:10px; display:flex; gap:6px;">
        <!-- Simpan -->
        <button type="submit" class="btn-primary">
            Simpan
        </button>

        <!-- Kosongkan (HANYA UI, tidak submit) -->
        <button type="button"
                class="btn-delete"
                onclick="document.getElementById('comment').value = ''">
            Kosongkan
        </button>

        <!-- Kembali -->
        <a href="{{ route('admin.posts.show', $post) }}"
           class="btn-back-secondary">
            Kembali
        </a>
    </div>
</form>

        
