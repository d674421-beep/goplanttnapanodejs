<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     */
    public function create(): View|RedirectResponse
    {
        if (!session('password_reset_email')) {
            return redirect()->route('password.request');
        }

        return view('auth.reset-password');
    }
  

    /**
     * Handle an incoming new password request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'otp' => ['required','digits:6'],
            'password' => ['required','confirmed', Rules\Password::defaults()],
        ]);

        $email = session('password_reset_email');
        $user = User::where('email', $email)->first();

        if (
            !$user ||
            $user->password_reset_otp !== $request->otp ||
            $user->passwordResetOtpExpired()
        ) {
            return back()->withErrors(['otp' => 'OTP salah atau kedaluarsa']);
        }

        $user->update([
            'password' => Hash::make($request->password),
            'password_reset_otp' => null,
            'password_reset_otp_expires_at' => null,
        ]);

        session()->forget('password_reset_email');

        return redirect()->route('login')->with('status','Password berhasil direset.');
    }

}
