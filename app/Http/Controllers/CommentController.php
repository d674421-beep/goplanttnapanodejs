<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Forum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $forumId)
    {
        $request->validate([
            'isi' => 'required'
        ]);

        Comment::create([
            'isi' => $request->isi,
            'user_id' => Auth::id(),
            'forum_id' => $forumId,
        ]);

        return back();
    }

    public function edit($id)
	{
		$comment = Comment::findOrFail($id);

		if ($comment->user_id !== Auth::id()) {
			abort(403);
		}

		return view('admin.comments.forum.edit', compact('comment'));
	}


    public function update(Request $request, $id)
	{
		$comment = Comment::findOrFail($id);

		$comment->update([
			'comment' => $request->comment
		]);

		if (auth()->user()->is_admin) {
			return redirect()->route(
				'admin.forums.show',
				$comment->forum_id
			);
		}

		return redirect()->route(
			'user.forum.show',
			$comment->forum_id
		);
	}


    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);

        if ($comment->user_id !== Auth::id()) {
            abort(403);
        }

        $comment->delete();
        return back();
    }
}

