<?php

namespace App\Http\Controllers;

use App\Http\Resources\PreorderListsResource;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class PreorderController extends Controller
{
    public function preorderLists()
    {
        $orders = Order::when(request()->has("keyword"), function ($query) {
            $query->where(function (Builder $builder) {
                $keyword = request()->keyword;

                $builder->where("order_no", "LIKE", "%" . $keyword . "%");
            });
        })

            ->when(request()->has("orderStatus"), function ($query) {
                $query->where(function (Builder $builder) {
                    $status = request()->orderStatus;

                    $builder->where("status", $status);
                });
            })

            ->latest("is_urgent")
            ->orderBy("due_date", "desc")
            ->paginate(10)
            ->withQueryString();

        $orderLists = PreorderListsResource::collection($orders);
        return response()->json([
            "orders" => $orderLists->resource
        ], 200);
    }

    public function CheckStatus(Request $request)
    {
        $ordersFromDistributor = collect($request->orders)->pluck("id");
        $orders = Order::whereIn("id", $ordersFromDistributor)->get();

        $orderedProductsIds = [];

        foreach ($orders as $order) {
            // return $order;
            $orderedProductsIds = $order->orderProduct->pluck('id');
            foreach ($orderedProductsIds as $id) {
                $orderProducts = OrderProduct::where("id", $id)->get();
                // return $orderProducts;
                $orderQuantity = $orderProducts->pluck("quantity");
                // return $orderQuantity;
                $productId = $orderProducts->pluck("product_id");
                $products = Product::where("id", $productId)->get();
                $productQuantity = $products->pluck("total_box_count");
                // return $productQuantity;

                if ($productQuantity > $orderQuantity) {
                    $order->status = 1;
                    $order->update();
                } elseif ($productQuantity < $orderQuantity) {
                    $order->status = 2;
                    $order()->update();
                }
            }
            return response()->json([
                "status" => $order->status
            ], 200);
        }
    }
}
