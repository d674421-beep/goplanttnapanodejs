<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plant;
use App\Models\Encyclopedia;
use Illuminate\Http\Request;


class EncyclopediaController extends Controller
{
    public function index(Request $request)
	{
		$search = $request->q;
		$sort   = $request->sort;

		$query = Encyclopedia::query();

		// SEARCH
		if ($search) {
			$query->where(function ($q) use ($search) {
				$q->where('title', 'like', "%{$search}%")
				  ->orWhere('content', 'like', "%{$search}%");
			});
		}

		// SORTING (EXPLICIT & TIDAK BISA KETIMPA)
		switch ($sort) {
			case 'oldest':
				$query->orderBy('created_at', 'asc')
					  ->orderBy('id', 'asc');
				break;

			case 'az':
				$query->orderBy('title', 'asc');
				break;

			case 'za':
				$query->orderBy('title', 'desc');
				break;

			default:
				$query->orderBy('created_at', 'desc')
					  ->orderBy('id', 'desc');
		}


		$data = $query->get();

		return view('admin.encyclopedia.index', compact('data'));
	}


    public function create()
	{
		return view('admin.encyclopedia.create', [
			'plants' => Plant::all()
		]);
	}


    public function store(Request $request)
	{
		$data = $request->validate([
			'title' => 'required|string|max:255',
			'content' => 'required',
			'plant_id' => 'nullable|exists:plants,id',
			'image' => 'nullable|image|max:2048',
			'video_url' => 'nullable|url'
		]);

		if ($request->hasFile('image')) {
			$file = $request->file('image');
			$filename = time().'_'.$file->getClientOriginalName();

			$file->move(public_path('uploads/encyclopedia'), $filename);

			$data['image'] = 'uploads/encyclopedia/'.$filename;
		}


		$data['created_by'] = auth()->id();

		Encyclopedia::create($data);

		return redirect()
			->route('admin.encyclopedia.index')
			->with('success', 'Artikel berhasil dibuat');
	}

    public function edit($id)
    {
        $item = Encyclopedia::findOrFail($id);
        return view('admin.encyclopedia.edit', compact('item'));
    }

    public function update(Request $request, $id)
	{
		$item = Encyclopedia::findOrFail($id);

		$data = $request->validate([
			'title' => 'required|string|max:255',
			'content' => 'required',
			'image' => 'nullable|image|max:2048',
			'video_url' => 'nullable|string'
		]);

		// jika upload gambar baru
		if ($request->hasFile('image')) {
			$file = $request->file('image');
			$filename = time().'_'.$file->getClientOriginalName();

			$file->move(public_path('uploads/encyclopedia'), $filename);

			$data['image'] = 'uploads/encyclopedia/'.$filename;
		}

		$item->update($data);

		return redirect()
			->route('admin.encyclopedia.index')
			->with('success', 'Data berhasil diupdate');
	}



    public function destroy($id)
	{
		$item = Encyclopedia::findOrFail($id);
		$item->delete();

		return redirect()
			->route('admin.encyclopedia.index')
			->with('success', 'Data berhasil dihapus');
	}

}
