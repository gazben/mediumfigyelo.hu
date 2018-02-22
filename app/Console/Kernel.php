<?php

namespace App\Console;

use App\Console\Commands\EvaluateKeywords;
use App\Console\Commands\Format;
use App\Console\Commands\Inspect;
use App\Console\Commands\Lint;
use App\Console\Commands\ScrapeSite;
use App\Console\Commands\Test;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Format::class,
        Inspect::class,
        Lint::class,
        Test::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command(ScrapeSite::class)->hourly();
        $schedule->command(EvaluateKeywords::class)->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
