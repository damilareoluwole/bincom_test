<?php

namespace App\Console;

use App\Jobs\RunUserSchedule;
use App\Jobs\RunUserWelcomeEmail;
use App\Jobs\AutoReleaseFund;
use App\Jobs\ReleaseNotificationEmail;
use App\Jobs\RunVerifyPayment;
use App\Jobs\SendMeMail;
use App\Jobs\SendAbelMail;
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
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {


        $schedule->job(new RunUserWelcomeEmail)->everyFifteenMinutes()->withoutOverlapping();
        $schedule->job(new ReleaseNotificationEmail)->everyThreeMinutes()->withoutOverlapping();
        $schedule->job(new AutoReleaseFund)->everyThreeMinutes()->withoutOverlapping();
        $schedule->job(new RunUserSchedule(true))->everyTwoMinutes()->withoutOverlapping();

        //$schedule->job(new RunVerifyPayment)->everyTwoHours()->withoutOverlapping();

        $schedule->job(new SendMeMail)->everyThreeHours();
        $schedule->job(new SendAbelMail(true))->everyThreeHours();
        /*
        $schedule->command('queue:work --daemon')->everyMinute()->withoutOverlapping();
        */

        // $schedule->command('inspire')->hourly();
        //run user schedule every 10mins
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
