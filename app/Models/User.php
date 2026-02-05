<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;


class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, HasFactory;

    protected $fillable = [
    'name',
    'email',
    'password',
    'role',
    'email_otp',
    'email_otp_expires_at',
    'password_reset_otp',
    'password_reset_otp_expires_at',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'email_otp_expires_at' => 'datetime',
        'password_reset_otp_expires_at' => 'datetime',
    ];

    public function passwordResetOtpExpired(): bool
    {
        return !$this->password_reset_otp_expires_at
            || now()->gt($this->password_reset_otp_expires_at);
    }
    
    public function otpExpired(): bool
    {
        if (!$this->email_otp_expires_at) {
            return true;
        }

        return Carbon::now()->gt($this->email_otp_expires_at);
    }

}
