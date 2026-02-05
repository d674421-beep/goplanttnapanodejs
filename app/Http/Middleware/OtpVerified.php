<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class OtpVerified
{
    public function handle($request, Closure $next)
	{
		if (
			auth()->check() &&
			auth()->user()->email_verified_at === null &&
			!$request->routeIs('otp.*')
		) {
			return redirect()->route('otp.verify.form');
		}

		return $next($request);
	}

}
