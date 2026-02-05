<h3 class="mb-2">Komentar</h3>
@forelse ($forum->comments as $comment)
    <div class="comment-item">
        <div class="flex justify-between items-start">
            <div>
                <strong>{{ $comment->user->name }}</strong>:
                <span>{{ $comment->isi }}</span>
            </div>

            @if(auth()->id() === $comment->user_id)
                <div class="comment-actions">
                    <a href="{{ route('admin.forums.comments.edit', $comment->id) }}"
                       class="btn btn-edit">✏️</a>

                    <button type="button"
                            class="btn btn-delete"
                            onclick="openDeleteForumCommentModal('{{ route('admin.forums.comments.destroy', $comment->id) }}')">
                        🗑️
                    </button>
                </div>
            @endif
        </div>
    </div>
@empty
    <p><em>Belum ada komentar.</em></p>
@endforelse
<div id="deleteForumCommentModal" class="comment-modal">
    <div class="card max-w-md w-full">
        <h3 class="text-lg font-bold mb-3">Hapus Komentar</h3>

        <p class="text-muted mb-6">
            Yakin ingin menghapus komentar ini?
            <br>
            <span class="text-danger font-semibold">
                Tindakan ini tidak dapat dibatalkan.
            </span>
        </p>

        <div class="modal-actions">
            <button onclick="closeDeleteForumCommentModal()" class="btn btn-secondary">
                Batal
            </button>

            <form id="deleteForumCommentForm" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-delete">
                    Ya, Hapus
                </button>
            </form>
        </div>
    </div>
</div>
<script>
function openDeleteForumCommentModal(url) {
    const modal = document.getElementById('deleteForumCommentModal');
    const form  = document.getElementById('deleteForumCommentForm');

    form.action = url;
    modal.classList.add('show');
}

function closeDeleteForumCommentModal() {
    document.getElementById('deleteForumCommentModal')
        .classList.remove('show');
}

// klik area gelap = tutup
document.getElementById('deleteForumCommentModal')
    .addEventListener('click', function(e) {
        if (e.target === this) {
            closeDeleteForumCommentModal();
        }
    });
</script>

