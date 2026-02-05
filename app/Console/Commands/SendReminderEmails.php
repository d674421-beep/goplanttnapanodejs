<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reminder;
use App\Mail\ReminderMail;
use Illuminate\Support\Facades\Mail;


class SendReminderEmails extends Command
{
    protected $signature = 'reminders:send';
    protected $description = 'Kirim email reminder yang jatuh tempo';

    public function handle()
	{
		$this->info('COMMAND START');

		$items = Reminder::where('email_sent', 0)
			->where('remind_at', '<=', now())
			->get();


		$this->info('DUE COUNT: '.$items->count());

		foreach ($items as $reminder) {
			$this->info('PROCESS ID: '.$reminder->id);

			// kirim dulu (sementara send, bukan queue)
			Mail::to($reminder->user->email)->send(new ReminderMail($reminder));

			// update PALING AMAN
			$reminder->email_sent = 1;
			$reminder->sent_at = now();
			$reminder->save();

			$this->info('UPDATED ID: '.$reminder->id);
		}

		$this->info('COMMAND END');
	}



}
