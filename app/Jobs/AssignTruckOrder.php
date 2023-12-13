<?php

namespace App\Jobs;

use App\Exports\TruckOrderAssign;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Mail;

class AssignTruckOrder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    // public $user;
    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $driver = User::where("role",6)->get();
        for($i=0;$i<3;$i++){
            Excel::store(new TruckOrderAssign,'public/pdf/'. now()->format('dmY') .'/' . rand(0,400) . '-orders.pdf');
        }
    }
}
