<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PostComment;
use Illuminate\Http\Request;
use App\Models\Post;


class PostCommentController extends Controller
{

    public function store(Request $request, Post $post)
    {
        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        PostComment::create([
            'post_id' => $post->id,
            'user_id' => auth()->id(),
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Komentar berhasil ditambahkan.');
    }

    public function edit(PostComment $comment)
    {
        $this->authorize('update', $comment);

        $post = $comment->post; // 🔥 ambil post dari relasi

        return view('admin.comments.post.edit', compact('comment', 'post'));
    }


    public function update(Request $request, PostComment $comment)
    {
        $this->authorize('update', $comment);

        $request->validate([
            'comment' => 'required|string',
        ]);

        $comment->update([
            'comment' => $request->comment,
        ]);

        return redirect()
            ->route('admin.posts.show', $comment->post_id)
            ->with('success', 'Komentar diperbarui');

    }

    public function destroy(PostComment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        return back()->with('success', 'Komentar dihapus');
    }
}
