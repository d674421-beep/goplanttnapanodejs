<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Reminder;
use App\Models\PostComment;
use App\Models\ForumComment;
use App\Policies\CommentPolicy;
use App\Policies\ReminderPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
		Reminder::class => ReminderPolicy::class,
		PostComment::class => CommentPolicy::class,
        ForumComment::class => CommentPolicy::class,
	];


    public function boot(): void
    {
        //
    }
}
