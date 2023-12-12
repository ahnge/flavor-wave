<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Truck;
use App\Models\TruckOrders;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;
use App\Http\Resources\TruckResource;

class LogisticController extends Controller
{
    public function index(Request $request)
    {
        $trucks = Truck::when($request->has("keyword"), function ($query) use ($request) {
            $query->where("order_no", "LIKE", "%" . $request->keyword . "%");
        })
            ->when($request->has('id'), function ($query) use ($request) {
                $sortType = $request->id ?? 'asc';
                $query->orderBy("id", $sortType);
            })
            ->latest("id")
            ->paginate(10)
            ->withQueryString();

        $trucks = TruckResource::collection($trucks);

        return view('logistic.index', compact("trucks"));
    }


    public function orderAssign(Request $request)
    {
        $approvedOrders = Order::where('status', 1)
            ->with("orderProducts")
            ->paginate(10);
        $truck = Truck::find($request->id);

        $truckOrders = TruckOrders::where('truck_id', $truck->id)->get();
        $currentTotalOrders = 0;
        if ($truckOrders) {
            foreach ($truckOrders as $order) {
                $currentTotalOrders += $order->total_quantity;
            }
        }

        // Loop through each order to calculate total product quantities
        foreach ($approvedOrders as $order) {
            $totalQuantity = 0;

            // Loop through orderProducts and sum their quantities
            foreach ($order->orderProducts as $product) {
                $totalQuantity += $product->quantity; // Assuming quantity is the field storing product quantities
            }
            $order->totalProductQuantity = $totalQuantity; // Assign the total to a new property in the Order object
        }

        return view('logistic.assignOrder', compact("approvedOrders", "truck", "currentTotalOrders"));
    }


    public function addOrderToTruck(Request $request)
    {
        $truck = Truck::find($request->truck_id);
        $truckOrdersTotal = TruckOrders::where('truck_id', $request->truck_id)->get();
        $currentTotalOrders = 0;
        if ($truckOrdersTotal) {
            foreach ($truckOrdersTotal as $order) {
                $currentTotalOrders += $order->total_quantity;
            }
        }
        $availableCapacity = $truck->capacity - $currentTotalOrders;
        if ($request->total_quantity > $availableCapacity) {
            return redirect()->back()->withErrors(['error' => 'Truck Capacity is not enough']);
        }

        // change order status
        $order = Order::find($request->order_id);
        $order->status = 3;
        $order->save();

        // truck orders
        $truckOrders = new TruckOrders();
        $truckOrders->truck_id = $request->truck_id;
        $truckOrders->order_id = $request->order_id;
        $truckOrders->total_quantity = $request->total_quantity;
        $truckOrders->save();
        return redirect()->back()->with("success", $order->order_no . " was assigned successfully");
    }
}
