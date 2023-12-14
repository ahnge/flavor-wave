<?php

namespace App\Jobs;

use App\Constants\OrderStatusEnum;
use App\Exports\TruckOrderAssign;
use App\Models\Order;
use App\Models\Truck;
use App\Models\TruckOrders;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class AssignTruckOrder implements ShouldQueue {
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    // public $user;
    /**
    * Create a new job instance.
    */

    public function __construct() {
        //
    }

    /**
    * Execute the job.
    */

    public function handle(): void {
        $truckOrders = TruckOrders::select( 'truck_id', DB::raw( 'GROUP_CONCAT(order_id) as order_ids' ) )
        ->groupBy( 'truck_id' )
        ->get();

        $truckIds = $truckOrders->pluck( 'truck_id' );

        $trucks = Truck::whereIn( 'id', $truckIds )->with( 'user' )->get();
        $orders  = [];

        foreach ( $trucks as  $i=> $driver ) {
            $orders  = Order::whereIn( 'id', explode( ',', $truckOrders->where( 'truck_id', $driver->id )->first()->order_ids ) )->where( 'status', OrderStatusEnum::Assigned->value )
            ->with( 'distributor' )
            ->get();
            if ( count( $orders ) >  0 ) {
                $folderPath = storage_path( 'app/public/pdf/' . now()->format( 'dmY' ) . '/' );
                File::makeDirectory( $folderPath, 0777, true, true );

                $filePath = $folderPath . str_replace( ' ', '_', ( $driver->user->name ?? 'unknown' ) ) . '-orders.pdf';

                Pdf::loadView( 'mail.table', compact( 'orders', 'driver' ) )->save( $filePath );
            }
        }
    }
}
