<?php

namespace App\Http\Controllers;

use App\Constants\OrderStatusEnum;
use App\Exports\OrdersExport;
use App\Models\Order;
use App\Models\Truck;
use App\Models\TruckOrders;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TruckController extends Controller
{
    public function show($truck_id)
    {
        $truck = Truck::with('orders')->findOrFail($truck_id);

        $assignOrders = $truck->orders()
            ->whereIn('status', [OrderStatusEnum::Assigned, OrderStatusEnum::Shipped])
            ->paginate(10);

        return view('trucks.show', compact('truck', 'assignOrders'));
    }

    // Truck detail page controller for order deliver feature to be used by logistic
    // to change status of the order when the order is delivered.
    public function updateOrderStatus(Request $request, $truck_id, $orderId)
    {
        $order = Order::findOrFail($orderId);

        // Check if the requested status is valid
        if (!in_array(intval($request->status), [0, 1, 2, 3, 4, 5])) {
            return response()->json(['message' => 'Invalid order status.'], 422);
        }

        // Update order status
        $order->update(['status' => $request->status]);

        // make the total_quantity of 'truck_orders' tables right on 'Delivered' or 'Returned'
        //  just substract 'quantity' of 'order_products' from 'total_quantity' of 'truck_orders' 
        $truckOrder = TruckOrders::where('truck_id', $truck_id)
            ->where('order_id', $orderId)
            ->first();

        foreach ($order->orderProducts as $orderProduct) {
            $truckOrder->total_quantity -= $orderProduct->quantity;
        };


        // update the product quantity on 'Returned' or 'Shipped'.
        if ($request->status == OrderStatusEnum::Shipped->value) {
            $orderProducts = $order->orderProducts;

            foreach ($orderProducts as $orderProduct) {
                // Get the related product
                $product = $orderProduct->product;

                // Subtract the quantity from the total_box_count
                $product->total_box_count -= $orderProduct->quantity;
                $product->save();
            }
        }

        if ($request->status == OrderStatusEnum::Returned->value) {
            $orderProducts = $order->orderProducts;

            foreach ($orderProducts as $orderProduct) {
                // Get the related product
                $product = $orderProduct->product;

                // Add the quantity
                $product->total_box_count += $orderProduct->quantity;
                $product->available_box_count += $orderProduct->quantity;
                $product->save();
            }
        }

        return response()->json(['message' => 'Order status updated successfully.']);
    }

    public function orderDetail($truck_id, $orderId)
    {


        $order = Order::findOrFail($orderId);

        return view('trucks.order-detail', compact('truck_id', 'order'));
    }

    public function updateTruckStatus(Request $request, $truckId)
    {
        $truck = Truck::findOrFail($truckId);

        // Check if the requested status is valid
        if (!in_array(intval($request->status), [0, 1])) {
            return response()->json(['message' => 'Invalid truck status.'], 422);
        }

        // Update order status
        $truck->update(['status' => $request->status]);

        return response()->json(['message' => 'Truck status updated successfully.']);
    }


    public function returnOrder(Request $request, $truckId, $orderId)
    {
        $order = Order::findOrFail($orderId);

        // Update order status
        $order->update(['status' => OrderStatusEnum::Returned->value]);

        // Update the warehouse inventory

        return redirect()->back()->with("success", "Success!");
    }

    public function exportAssignedOrders($truckId)
    {
        return Excel::download(new OrdersExport($truckId), 'assigned_orders.xlsx');
    }
}
