<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Encyclopedia;

class EncyclopediaController extends Controller
{
    public function index()
    {
        // user hanya boleh lihat data
        $items = Encyclopedia::latest()->get();

        return view('user.encyclopedia.index', compact('items'));
    }
}
