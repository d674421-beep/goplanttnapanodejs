<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Daftarkan command custom aplikasi.
     */
    protected $commands = [
        \App\Console\Commands\SendReminderEmails::class,
    ];

    /**
     * Definisi scheduler Laravel.
     */
    protected function schedule(Schedule $schedule)
	{
		$schedule->command('reminders:send')->everyMinute();
	}


    /**
     * Load command artisan.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
