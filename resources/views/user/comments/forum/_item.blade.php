{{-- ================= LIST KOMENTAR ================= --}}
@forelse ($forum->comments as $comment)
    <div class="comment-item">
        <div class="comment-header">
            <strong>{{ $comment->user->name }}</strong>
            <small class="text-muted">
                {{ $comment->created_at->diffForHumans() }}
            </small>
        </div>

        <div class="comment-text">
            {{ $comment->isi }}
        </div>

        @if(auth()->id() === $comment->user_id)
            <div class="comment-actions">
                <a href="{{ route('user.forums.comments.edit', $comment->id) }}"
                   class="btn btn-edit">
                    Edit
                </a>

                <button type="button"
                        onclick="openDeleteCommentModal({{ $comment->id }})"
                        class="btn btn-delete">
                    Hapus
                </button>
            </div>
        @endif
    </div>
@empty
    <p><em>Belum ada komentar.</em></p>
@endforelse


{{-- ================= MODAL DELETE KOMENTAR ================= --}}
<div id="deleteCommentModal"
     class="fixed inset-0 z-50 hidden
            bg-black/50 flex items-center justify-center">

    <div class="card max-w-md w-full">
        <h3 class="text-lg font-bold mb-3">
            Hapus Komentar
        </h3>

        <p class="text-muted mb-6">
            Apakah kamu yakin ingin menghapus komentar ini?
            <br>
            <span class="text-red-600 font-semibold">
                Tindakan ini tidak dapat dibatalkan.
            </span>
        </p>

        <div class="flex justify-end gap-3">
            <button type="button"
                    onclick="closeDeleteCommentModal()"
                    class="btn btn-secondary">
                Batal
            </button>

            <form id="deleteCommentForm"
                  method="POST">
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


{{-- ================= SCRIPT MODAL ================= --}}
<script>
function openDeleteCommentModal(commentId) {
    const form = document.getElementById('deleteCommentForm');
    form.action = `/user/forums/comments/${commentId}`;

    document.getElementById('deleteCommentModal')
        .classList.remove('hidden');
}

function closeDeleteCommentModal() {
    document.getElementById('deleteCommentModal')
        .classList.add('hidden');
}
</script>
