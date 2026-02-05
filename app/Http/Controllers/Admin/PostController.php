<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->get('sort', 'latest');

        $query = Post::with('user');

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

            case 'latest':
            default:
                $query->orderBy('created_at', 'desc');
        }

        $posts = $query->get();

        return view('admin.posts.index', compact('posts', 'sort'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'    => 'required|string|max:255',
            'category' => 'required|string',
            'content'  => 'required|string',
            'image'    => 'nullable|image|max:2048',
        ]);

        $data['user_id'] = auth()->id();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')
                ->store('posts', 'public');
        }

        Post::create($data);

        return redirect()
            ->route('admin.posts.index')
            ->with('success', 'Postingan berhasil dibuat');
    }

    public function show(Post $post)
	{
		$comments = $post->comments()->with('user')->get();

		return view('admin.posts.show', compact('post', 'comments'));
	}


    public function edit(Post $post)
    {
        abort_if($post->user_id !== auth()->id(), 403);

        return view('admin.posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        abort_if($post->user_id !== auth()->id(), 403);

        $data = $request->validate([
            'title'    => 'required|string|max:255',
            'category' => 'required|string',
            'content'  => 'required|string',
            'image'    => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')
                ->store('posts', 'public');
        }

        $post->update($data);

        return redirect()
            ->route('admin.posts.index')
            ->with('success', 'Postingan berhasil diperbarui');
    }

    public function destroy(Post $post)
    {
        abort_if($post->user_id !== auth()->id(), 403);

        $post->delete();

        return back()
            ->with('success', 'Postingan berhasil dihapus');
    }
}
