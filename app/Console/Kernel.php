<?php

namespace App\Console;

use App\Jobs\AssignTruckOrder;
use App\Mail\SendTruckAssignMail;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Mail;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
    //   (new AssignTruckOrder())->dispatch();
      $schedule->job(new AssignTruckOrder())->everyFifteenSeconds();
      $schedule->command("send:mailTruck")->everyFifteenSeconds();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
