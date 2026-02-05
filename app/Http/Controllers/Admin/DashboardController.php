<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plant;
use App\Models\Forum;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalPlants' => Plant::count(),
            'totalForums' => Forum::count(),
            'totalUsers'  => User::count(),
        ]);
    }
}
