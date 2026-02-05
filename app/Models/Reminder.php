<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reminder extends Model
{
    use HasFactory;

    protected $table = 'reminders';

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'remind_at',
        'email_sent',
        'sent_at',
    ];

    protected $casts = [
        'remind_at'  => 'datetime',
        'sent_at'    => 'datetime',
        'email_sent' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
