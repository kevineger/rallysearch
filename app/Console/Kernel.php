<?php

namespace App\Console;

use App\Jobs\AnnotateTopPosts;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel {

    use DispatchesJobs;
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        // Commands\Inspire::class,
        Commands\AnnotateTop::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('annotate:top')->twiceDaily();
//        $schedule->call(function ()
//        {
//            error_log("Hitting cloud url");
//        })->everyMinute()->thenPing(url('cloud'));
    }
}
