<form method="POST"
      action="{{ route('user.forums.comments.update', $comment->id) }}">
    @csrf
    @method('PUT')

    <input type="hidden" name="action_type" id="action_type" value="update">

    <div class="form-group">
        <label for="isi">Isi Komentar</label>
        <textarea name="isi"
                  id="isi"
                  rows="4"
                  required>{{ old('isi', $comment->isi) }}</textarea>
    </div>

    <div style="margin-top:10px; display:flex; gap:8px;">
        <button type="submit" class="btn-primary">
            Simpan
        </button>

        <button type="button"
                class="btn-delete"
                onclick="hapusSementara()">
            Hapus
        </button>
    </div>
</form>

<hr>

<div style="margin-top:12px;">
    <a href="{{ route('user.forums.show', $forum->id) }}"
       class="btn-secondary">
        ← Kembali ke Forum
    </a>
</div>

<script>
function hapusSementara() {
    document.getElementById('isi').value = '';
    document.getElementById('action_type').value = 'delete';
}
</script>
