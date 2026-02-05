<?php

namespace App\Http\Controllers\User;

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Encyclopedia;
use Illuminate\Http\Request;

class EncyclopediaController extends Controller
{
    public function index(Request $request)
	{
		$q = $request->q;
		$sort = $request->sort ?? 'latest';

		$query = \App\Models\Encyclopedia::query();

		if ($q) {
			$query->where(function ($q2) use ($q) {
				$q2->where('title', 'like', "%$q%")
				   ->orWhere('content', 'like', "%$q%");
			});
		}

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

		$data = $query->get();

		return view('user.encyclopedia.index', compact('data', 'sort'));
	}


    public function show(Encyclopedia $item)
    {
        return view('user.encyclopedia.show', compact('item'));
    }
}
