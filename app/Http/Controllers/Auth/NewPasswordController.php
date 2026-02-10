<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class NewPasswordController extends Controller
{
    /**
     * Tampilkan form reset password
     */
    public function create(): View|RedirectResponse
    {
        if (! session()->has('password_reset_email')) {
            return redirect()->route('password.request');
        }

        return view('auth.reset-password');
    }

    /**
     * Simpan password baru
     */
    public function store(Request $request): RedirectResponse
    {
        if (! session()->has('password_reset_email')) {
            return redirect()->route('password.request');
        }

        $request->validate([
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $email = session('password_reset_email');

        $user = User::where('email', $email)->firstOrFail();

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        // Hapus session reset
        session()->forget('password_reset_email');

        return redirect()
            ->route('login')
            ->with('success', 'Password berhasil diubah. Silakan login.');
    }
}
