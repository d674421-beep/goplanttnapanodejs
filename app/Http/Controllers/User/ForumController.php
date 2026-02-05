<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Forum;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function index(Request $request)
	{
		// Sort eksplisit (aman & jelas)
		$order = $request->get('order', 'date_desc');

		$query = Forum::with('user')
			->where(function ($q) {
				$q->where('is_approved', true)
				  ->orWhere('user_id', auth()->id());
			});

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

		return view('user.forums.index', compact('forums', 'order'));
	}



    public function create()
    {
        return view('user.forums.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'isi'   => 'required|string',
        ]);

        $data['user_id'] = auth()->id();
        $data['is_approved'] = false; // 🔑 REQUEST APPROVAL

        Forum::create($data);

        return redirect()
            ->route('user.forums.index')
            ->with('success', 'Forum berhasil dikirim dan menunggu persetujuan admin.');
    }

    public function show(Forum $forum)
	{
		if (
			!$forum->is_approved &&
			$forum->user_id !== auth()->id()
		) {
			abort(403, 'Forum belum disetujui');
		}

		return view('user.forums.show', compact('forum'));
	}


	public function edit(Forum $forum)
	{
		abort_if($forum->user_id !== auth()->id(), 403);

		return view('user.forums.edit', compact('forum'));
	}


	public function update(Request $request, Forum $forum)
	{
		$request->validate([
			'judul' => 'required|string|max:255',
			'isi'   => 'required|string',
		]);

		$forum->update([
			'judul' => $request->judul,
			'isi'   => $request->isi,
			// JANGAN sentuh is_approved
		]);

		return redirect()
			->route('user.forums.index')
			->with('success', 'Forum berhasil diperbarui');
	}

	public function destroy(\App\Models\Forum $forum)
	{
		// Pastikan user hanya bisa hapus forum miliknya
		if ($forum->user_id !== auth()->id()) {
			abort(403);
		}

		$forum->delete();

		return redirect()
			->route('user.forums.index')
			->with('status', 'Forum berhasil dihapus.');
	}
			
}

