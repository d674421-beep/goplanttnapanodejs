<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Forum;
use App\Models\Comment;

class ForumCommentController extends Controller
{
    // Menyimpan komentar baru di forum
    public function store(Request $request, Forum $forum)
    {
        // Validasi input
        $data = $request->validate([
            'content' => 'required|string',
        ]);

        // Mapping ke nama kolom database
        Comment::create([
            'isi' => $data['content'],
            'user_id' => auth()->id(),
            'forum_id' => $forum->id,
        ]);
		
        return redirect()
            ->route('admin.forums.show', $forum)
            ->with('success', 'Komentar berhasil ditambahkan');
    }
	public function edit(Comment $comment)
	{
		$forum = $comment->forum;
		return view('admin.comments.forum.edit', compact('comment', 'forum'));
	}



	public function update(Request $request, Comment $comment)
	{
		$comment->update([
			'isi' => $request->isi ?? ''
		]);

		return redirect()
			->route('admin.forums.show', $comment->forum_id)
			->with('success', 'Komentar diperbarui');
	}

	
	
	public function destroy(Comment $comment)
	{
		$forumId = $comment->forum_id;

		$comment->delete();

		return redirect()
			->route('admin.forums.show', $forumId)
			->with('success', 'Komentar berhasil dihapus');
	}


}
	

