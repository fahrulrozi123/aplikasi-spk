<?php

namespace App\Console;

use DB;
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
        'App\Console\Commands\StatusReservation',
        'App\Console\Commands\StatusCreditReservation',
        'App\Console\Commands\CheckAllotment',
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // reset allotment
        $schedule->command('set:allotment')->dailyAt('23:00')->timezone('Asia/Jakarta');

        // check debit reservation
        $schedule->command('status:rsvp')->everyMinute()->timezone('Asia/Jakarta');

        // check credit reservation
        $schedule->command('credit:rsvp')->everyMinute()->timezone('Asia/Jakarta');
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
