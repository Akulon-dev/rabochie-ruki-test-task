<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule): void
    {
        // Запускаем команду queue:work каждые 10 секунд
        $schedule->command('queue:work --sleep=3 --tries=3')->everyTenSeconds();
    }

    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');
    }
}
