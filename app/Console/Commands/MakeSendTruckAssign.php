<?php

namespace App\Console\Commands;

use App\Constants\OrderStatusEnum;
use Illuminate\Console\Command;
use App\Mail\SendTruckAssignMail;
use App\Models\Order;
use App\Models\Truck;
use App\Models\TruckOrders;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class MakeSendTruckAssign extends Command {
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

    public function handle() {
        $orderIds  = Order::where( 'status', OrderStatusEnum::Assigned->value )->pluck( 'id' );

        $truckOrders = TruckOrders::select( 'truck_id', DB::raw( 'GROUP_CONCAT(order_id) as order_ids' ) )
        ->whereIn( 'order_id', $orderIds ) // Add this line to filter by status
        ->groupBy( 'truck_id' )
        ->get();

        $truckIds = $truckOrders->pluck( 'truck_id' );

        $trucks = Truck::
        whereIn( 'id', $truckIds )
        ->with( 'user' )->get();

        foreach ( $trucks as $driver ) {
            $path = 'public/pdf/' . now()->format( 'dmY' ) . '/' . str_replace( ' ', '_', ( $driver->user->name ?? 'unknown' ) ) . '-orders.pdf';
            Mail::to( $driver->user->email )->queue( new SendTruckAssignMail( $path ) );
        }

        $this->info( 'Email sent successfully.' );
    }
}

