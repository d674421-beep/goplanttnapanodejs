<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

{
    public function show()
    {
    }

   public function verify(Request $request)
	{
		$request->validate([
		]);

		$user = auth()->user();

			return back()->withErrors([
			]);
		}

			return back()->withErrors([
			]);
		}

		// ✅ UPDATE USER
		$user->forceFill([
			'email_verified_at' => now(),
		])->save();

		// 🔴 KRITIS: refresh auth state
		auth()->setUser($user->fresh());

		// ✅ JANGAN redirect ke dashboard langsung
		return redirect()->intended(route('dashboard'));
	}



    public function resend()
    {
        $user = auth()->user();


        $user->update([
        ]);

        Mail::to($user->email)->send(
        );

    }
}
