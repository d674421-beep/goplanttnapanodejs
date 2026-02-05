<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Mail\EmailOtpMail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     */
    public function store(Request $request): RedirectResponse
    {
        // 1️⃣ Validasi input
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                'unique:' . User::class
            ],
            'password' => [
                'required',
                'confirmed',
                Rules\Password::defaults()
            ],
        ]);

        // 2️⃣ Buat user
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            // email_verified_at BIARKAN NULL
        ]);

        // 3️⃣ Generate OTP
        $otp = random_int(100000, 999999);

        $user->update([
            'email_otp' => $otp,
            'email_otp_expires_at' => now()->addMinutes(5),
        ]);

        // 4️⃣ Kirim OTP ke email
        Mail::to($user->email)->send(
            new EmailOtpMail($otp)
        );

        // 5️⃣ Login sementara (UNTUK HALAMAN OTP SAJA)
        Auth::login($user);
        $request->session()->regenerate();

        // 6️⃣ Redirect ke halaman verifikasi OTP
        return redirect()->route('otp.verify.form');
    }
}
