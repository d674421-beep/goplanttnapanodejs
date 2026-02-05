<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Forum;
use App\Models\Comment;
use Illuminate\Http\Request;

class ForumCommentController extends Controller
{
    public function store(Request $request, Forum $forum)
    {
        $request->validate([
            'isi' => 'required|string'
        ]);

        Comment::create([
            'isi'      => $request->isi,
            'user_id'  => auth()->id(),
            'forum_id' => $forum->id,
        ]);

        return back()->with('success', 'Komentar berhasil dikirim');
    }



    public function edit(Comment $comment)
	{
		abort_if($comment->user_id !== auth()->id(), 403);

		return view('user.comments.forum.edit', [
			'comment' => $comment,
			'forum'   => $comment->forum,
		]);
	}

    

    public function update(Request $request, Comment $comment)
	{
		abort_if($comment->user_id !== auth()->id(), 403);

		if ($request->action_type === 'delete') {
			$comment->delete();

			return redirect()
				->route('user.forums.show', $comment->forum_id)
				->with('success', 'Komentar berhasil dihapus.');
		}

		$request->validate([
			'isi' => 'required'
		]);

		$comment->update([
			'isi' => $request->isi
		]);

		return redirect()
			->route('user.forums.show', $comment->forum_id)
			->with('success', 'Komentar berhasil diperbarui.');
	}



    public function destroy(Comment $comment)
    {
        if ($comment->user_id !== auth()->id()) {
            abort(403);
        }

        $comment->delete();

        return back()->with('success', 'Komentar dihapus');
    }
}
