<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\SendTruckAssignMail;
use Illuminate\Support\Facades\Mail;

class MakeSendTruckAssign extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:mailTruck';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send mail  to driver';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Mail::to(config('control.hostMail'))->queue(new SendTruckAssignMail("") );

        $this->info('Email sent successfully.');
    }
}
