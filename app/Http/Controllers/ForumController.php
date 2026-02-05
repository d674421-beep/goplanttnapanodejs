<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    public function index()
    {
        $forums = Forum::latest()->get();
        return view('forum.index', compact('forums'));
    }

    public function create()
    {
        return view('forums.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'isi' => 'required',
        ]);

        Forum::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'user_id' => Auth::id(),
        ]);

        return redirect('/forum');
    }
}

