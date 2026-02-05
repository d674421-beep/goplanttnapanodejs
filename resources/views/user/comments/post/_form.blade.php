<form method="POST"
      action="{{ route('user.posts.comments.update', $comment) }}">
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
        <button type="submit" class="btn-primary">
            Simpan
        </button>

        <button type="button"
                class="btn-delete"
                onclick="document.getElementById('comment').value = ''">
            Kosongkan
        </button>

        <a href="{{ route('user.posts.show', $post) }}"
           class="btn-back-secondary">
            Kembali
        </a>
    </div>
</form>
