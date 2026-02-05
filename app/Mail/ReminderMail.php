<?php

namespace App\Mail;

use App\Models\Reminder;
use Illuminate\Mail\Mailable;
use Illuminate\Contracts\Queue\ShouldQueue; // ⬅️ INI YANG KURANG

class ReminderMail extends Mailable implements ShouldQueue
{
    public Reminder $reminder;

    public function __construct(Reminder $reminder)
    {
        $this->reminder = $reminder;
    }

    public function build()
    {
        return $this->subject('Pengingat Tanaman')
                    ->view('emails.reminder');
    }
}
