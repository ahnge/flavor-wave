<?php

namespace App\Exports;

use App\Constants\OrderStatusEnum;
use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;


class OrdersExport implements FromQuery, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */

    use Exportable;

    protected $truckId;

    // Add a constructor to accept the truck ID
    public function __construct($truckId)
    {
        $this->truckId = $truckId;
    }

    public function query()
    {
        return Order::query()
            ->select(
                'orders.order_no',
                'regions.name as region_name',
                'orders.address',
                'orders.phone_no',
                'orders.total',
                'orders.due_date',
                DB::raw('GROUP_CONCAT(products.title, ", ", order_products.quantity SEPARATOR " | ") as product_info')
            )
            ->join('order_products', 'orders.id', '=', 'order_products.order_id')
            ->join('products', 'order_products.product_id', '=', 'products.id')
            ->join('regions', 'orders.region_code', '=', 'regions.code')
            ->where('orders.status', '=', 3)
            ->whereHas('trucks', function ($query) {
                $query->where('truck_id', $this->truckId);
            })
            ->groupBy('orders.id', 'orders.order_no', 'regions.name', 'orders.address', 'orders.phone_no', 'orders.total', 'orders.due_date');
    }

    public function headings(): array
    {
        // Define the column headings
        return [
            'Order No',
            'Region',
            'Address',
            'Phone No',
            'Total price(Ks)',
            'Due Date',
            'Product name, Qty(box)',
            'Status'
        ];
    }
}
