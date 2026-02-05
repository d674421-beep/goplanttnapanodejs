<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plant;

class PlantController extends Controller
{
    public function index()
    {
        $plants = Plant::all();
        return view('admin.plants.index', compact('plants'));
    }
}
