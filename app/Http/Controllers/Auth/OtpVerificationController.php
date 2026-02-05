<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\EmailOtpMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OtpVerificationController extends Controller
{
    public function show()
    {
        return view('auth.verify-otp');
    }

   public function verify(Request $request)
	{
		$request->validate([
			'otp' => ['required', 'digits:6'],
		]);

		$user = auth()->user();

		if ($user->otpExpired()) {
			return back()->withErrors([
				'otp' => 'Kode OTP sudah kedaluwarsa.',
			]);
		}

		if ((string) $request->otp !== (string) $user->email_otp) {
			return back()->withErrors([
				'otp' => 'Kode OTP salah.',
			]);
		}

		// ✅ UPDATE USER
		$user->forceFill([
			'email_verified_at' => now(),
			'email_otp' => null,
			'email_otp_expires_at' => null,
		])->save();

		// 🔴 KRITIS: refresh auth state
		auth()->setUser($user->fresh());

		// ✅ JANGAN redirect ke dashboard langsung
		return redirect()->intended(route('dashboard'));
	}



    public function resend()
    {
        $user = auth()->user();

        $otp = random_int(100000, 999999);

        $user->update([
            'email_otp' => $otp,
            'email_otp_expires_at' => now()->addMinutes(5),
        ]);

        Mail::to($user->email)->send(
            new EmailOtpMail($otp)
        );

        return back()->with('success', 'OTP baru telah dikirim');
    }
}
