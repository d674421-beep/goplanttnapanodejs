<?php

protected function schedule(Schedule $schedule): void
{
    $schedule->command('reminders:send')->everyMinute();
}
