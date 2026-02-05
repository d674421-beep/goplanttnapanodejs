<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostComment;
use Illuminate\Http\Request;

class PostCommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'comment' => 'required|string',
        ]);

        $post->comments()->create([
            'comment' => $request->comment,
            'user_id' => auth()->id(),
        ]);

        return back()->with('success', 'Komentar ditambahkan');
    }

    public function edit(PostComment $comment)
    {
        // 🔒 USER HANYA BOLEH EDIT KOMENTARNYA SENDIRI
        abort_if($comment->user_id !== auth()->id(), 403);

        return view('user.comments.post.edit', [
            'comment' => $comment,
            'post'    => $comment->post,
        ]);
    }

    public function update(Request $request, PostComment $comment)
    {
        abort_if($comment->user_id !== auth()->id(), 403);

        $request->validate([
            'comment' => 'required|string',
        ]);

        $comment->update([
            'comment' => $request->comment,
        ]);

        return redirect()
            ->route('user.posts.show', $comment->post)
            ->with('success', 'Komentar diperbarui');
    }

    public function destroy(PostComment $comment)
    {
        abort_if($comment->user_id !== auth()->id(), 403);

        $comment->delete();

        return back()->with('success', 'Komentar dihapus');
    }
}
