<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Forum;
use App\Models\Reminder;

class DashboardController extends Controller
{
    public function index()
    {
        return view('user.dashboard', [
            'postCount'     => Post::where('user_id', auth()->id())->count(),
            'forumCount'    => Forum::where('is_approved', true)->count(),
            'reminderCount' => Reminder::where('user_id', auth()->id())->count(),
        ]);
    }
}

