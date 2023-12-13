<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\SendTruckAssignMail;
use App\Models\Truck;
use App\Models\TruckOrders;
use Illuminate\Support\Facades\DB;
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

        $truckOrders = TruckOrders::select('truck_id', DB::raw('GROUP_CONCAT(order_id) as order_ids'))
        ->groupBy('truck_id')
        ->get();

        $truckIds = $truckOrders->pluck('truck_id');

        $trucks = Truck::
        whereIn('id',$truckIds)
        ->with('user')->get();

        $truckOrders = TruckOrders::select('truck_id', DB::raw('GROUP_CONCAT(order_id) as order_ids'))
        ->groupBy('truck_id')
        ->get();

        $truckIds = $truckOrders->pluck('truck_id');

        $trucks = Truck::
        whereIn('id',$truckIds)
        ->with('user')->get();


        foreach($trucks as $truck){
            $path = "public/pdf/".now()->format('dmY')."/".$truck->user->id."-orders.pdf";
            Mail::to($truck->user->email)->queue(new SendTruckAssignMail($path) );
        }


        $this->info('Email sent successfully.');
    }
}


