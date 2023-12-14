<?php

namespace App\Http\Controllers;

use App\Constants\OrderStatusEnum;
use App\Models\Order;
use App\Models\Truck;
use Illuminate\Http\Request;

class TruckController extends Controller
{
    public function show($id)
    {
        $truck = Truck::with('orders')->findOrFail($id);

        $assignOrders = $truck->orders()->paginate(10);

        return view('trucks.show', compact('truck', 'assignOrders'));
    }

    // Truck detail page controller for order deliver feature to be used by logistic
    // to change status of the order when the order is delivered.
    public function updateOrderStatus(Request $request, $orderId)
    {
        $order = Order::findOrFail($orderId);

        // Check if the requested status is valid
        if (!in_array(intval($request->status), [0, 1, 2, 3, 4, 5])) {
            return response()->json(['message' => 'Invalid order status.'], 422);
        }

        // Update order status
        $order->update(['status' => $request->status]);

        return response()->json(['message' => 'Order status updated successfully.']);
    }

    public function orderDetail($orderId)
    {
        $order = Order::findOrFail($orderId);

        return view('trucks.order-detail', compact('order'));
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
}
