<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Forum;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function index(Request $request)
	{
		$order = $request->get('order', 'date_desc');

		$query = Forum::with('user');

		switch ($order) {
			case 'date_asc':
				$query->orderBy('created_at', 'asc');
				break;

			case 'title_asc':
				$query->orderBy('judul', 'asc');
				break;

			case 'title_desc':
				$query->orderBy('judul', 'desc');
				break;

			case 'date_desc':
			default:
				$query->orderBy('created_at', 'desc');
				break;
		}

		$forums = $query->get();

		return view('admin.forums.index', compact('forums', 'order'));
	}

    public function create() {
        // Menampilkan form untuk buat forum baru
        return view('admin.forums.create');
    }

    public function store(Request $request)
	{
		$data = $request->validate([
			'judul' => 'required|string|max:255',
			'isi'   => 'required|string',
		]);

		$data['user_id'] = auth()->id();
		$data['is_approved'] = true; // ADMIN AUTO APPROVED

		$forum = Forum::create($data);

		return redirect()
			->route('admin.forums.index')
			->with('success', 'Forum berhasil dibuat');
	}



    public function show(Forum $forum)
	{
		$forum->load('comments.user'); // load user dari comments
		return view('admin.forums.show', compact('forum'));
	}

	public function edit(\App\Models\Forum $forum)
	{
		return view('admin.forums.edit', compact('forum'));
	}

    public function destroy(Forum $forum) {
        $forum->delete();
        return redirect()->route('admin.forums.index')
                         ->with('success','Forum berhasil dihapus');
    }
	public function update(Request $request, \App\Models\Forum $forum)
	{
		$request->validate([
			'judul' => 'required|string|max:255',
			'isi'   => 'required|string',
		]);

		$forum->update([
			'judul' => $request->judul,
			'isi'   => $request->isi,
		]);

		return redirect()
			->route('admin.forums.index', $forum)
			->with('success', 'Forum berhasil diperbarui');
	}

	public function approve(Forum $forum)
	{
		if ($forum->is_approved) {
			return back()->with('info', 'Forum sudah disetujui');
		}

		$forum->update([
			'is_approved' => true,
		]);

		return back()->with('success', 'Forum berhasil disetujui');
	}



}

