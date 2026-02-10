<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider

{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
	
	public static function redirectTo()
	{
		return auth()->user()->role === 'admin'
			? '/admin/encyclopedia'
			: '/encyclopedia';
	}

}
