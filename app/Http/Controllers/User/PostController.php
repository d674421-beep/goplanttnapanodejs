<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
	{
		$sort = $request->get('sort', 'latest');

		$query = Post::query(); // 🔑 HAPUS filter user_id

		switch ($sort) {
			case 'oldest':
				$query->orderBy('created_at', 'asc');
				break;

			case 'az':
				$query->orderBy('title', 'asc');
				break;

			case 'za':
				$query->orderBy('title', 'desc');
				break;

			default:
				$query->orderBy('created_at', 'desc');
		}

		return view('user.posts.index', [
			'posts' => $query->get(),
			'sort'  => $sort
		]);
	}

	 public function show(Post $post)
	{
		return view('user.posts.show', compact('post'));
	}
	
    public function create()
    {
        return view('user.posts.create');
    }
	
    public function store(Request $request)
	{
		$data = $request->validate([
			'title'    => 'required|string|max:255',
			'content'  => 'required|string',
			'category' => 'required|string',
			'image'    => 'nullable|image|max:2048',
		]);

		if ($request->hasFile('image')) {
			$data['image'] = $request->file('image')->store('posts', 'public');
		}

		// 🔑 KUNCI UTAMA
		$data['user_id'] = auth()->id();

		Post::create($data);

		return redirect()
			->route('user.posts.index')
			->with('success', 'Postingan berhasil dibuat');
	}

    public function edit(Post $post)
	{
		abort_if($post->user_id !== auth()->id(), 403);

		return view('user.posts.edit', compact('post'));
	}


    public function update(Request $request, Post $post)
	{
		abort_if($post->user_id !== auth()->id(), 403);

		$data = $request->validate([
			'title'    => 'required|string|max:255',
			'content'  => 'required|string',
			'category' => 'required|string',
			'image'    => 'nullable|image|max:2048',
		]);

		if ($request->hasFile('image')) {
			$data['image'] = $request->file('image')->store('posts', 'public');
		}

		$post->update($data);

		// 🔥 Redirect dinamis
		if ($request->redirect_to === 'show') {
			return redirect()->route('user.posts.show', $post)
				->with('success', 'Postingan berhasil diperbarui');
		}

		return redirect()->route('user.posts.index')
			->with('success', 'Postingan berhasil diperbarui');
	}




    public function destroy(Post $post)
    {
        abort_if($post->user_id !== auth()->id(), 403);

        $post->delete();

        return redirect()
            ->route('user.posts.index')
            ->with('success', 'Post berhasil dihapus');
    }
}
