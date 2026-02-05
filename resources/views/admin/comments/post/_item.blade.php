

@forelse ($comments as $comment)
    <div class="comment-item">
        <div class="comment-header">
            <strong>{{ $comment->user?->name }}</strong>
            <small class="text-muted">
                {{ $comment->created_at->diffForHumans() }}
            </small>
        </div>

        <div class="comment-text">
            {{ $comment->comment }}
        </div>

        @if(auth()->id() === $comment->user_id)
            <div class="comment-actions flex gap-2 mt-2">
                <a href="{{ route('admin.posts.comments.edit', $comment) }}"
                class="btn btn-edit">
                    Edit
                </a>
                <button onclick="openDeleteCommentModal('{{ route('admin.posts.comments.destroy', $comment) }}')"
                        class="btn btn-delete">
                    Hapus
                </button>
            </div>
        @endif
    </div>
@empty
    <p><em>Belum ada komentar.</em></p>
@endforelse

{{-- ================= MODAL DELETE COMMENT ================= --}}
<div id="deleteCommentModal" class="comment-modal">
    <div class="card max-w-md w-full">
        <h3 class="text-lg font-bold mb-3">Hapus Komentar</h3>

        <p class="text-muted mb-6">
            Apakah kamu yakin ingin menghapus komentar ini?
            <br>
            <span class="text-red-600 font-semibold">
                Tindakan ini tidak dapat dibatalkan.
            </span>
        </p>

        <div class="flex justify-end gap-3">
            <button onclick="closeDeleteCommentModal()" class="btn btn-secondary">
                Batal
            </button>

            <form id="deleteCommentForm" method="POST">
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
function openDeleteCommentModal(url) {
    const modal = document.getElementById('deleteCommentModal');
    const form  = document.getElementById('deleteCommentForm');

    form.action = url;
    modal.classList.add('show');
}

function closeDeleteCommentModal() {
    document.getElementById('deleteCommentModal').classList.remove('show');
}

// klik area gelap = tutup
document.getElementById('deleteCommentModal')
    .addEventListener('click', function(e) {
        if (e.target === this) {
            closeDeleteCommentModal();
        }
    });
</script>

