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

        return view('sales.index', ['preorders' => $orderLists->resource]);
    }

    public function filteredPreorderList(int $status)
    {

        if($status == 10)
        {
            return redirect()->route('preorder.preorderList');
        }

        $orders = Order::where('status',$status)
        ->when(request()->has("keyword"), function ($query) {
            $query->where(function (Builder $builder) {
                $keyword = request()->keyword;

                $builder->where("order_no", "LIKE", "%" . $keyword . "%")
                ->orWhereHas('Distributor', function ($q) {
                    $q->where('name', "LIKE", "%" . request()->keyword . "%");
                });
            });
        })
            ->when(request()->has('id'), function ($query) {
                $sortType = request()->id ?? 'asc';
                $query->orderBy("id", $sortType);
            })
            ->latest("is_urgent")
            ->paginate(10)
            ->withQueryString();

        $orderLists = PreorderListsResource::collection($orders);

        return view('sales.index',['preorders'=>$orderLists->resource,'status'=>$status]);

    }

    public function showOrder(Order $preorder)
    {
        return view('sales.preorder.index', ['preorder' => $preorder]);
    }

    public function changeOrderStatus(Order $preorder)
    {
        if (request('status') == 'Approve') {

            $preorder->status = 1;

            $preorder->save();
        } elseif (request('status') == 'Reject') {

            $preorder->status = 2;

            $preorder->save();
        }

        return redirect()->route('preorder.preorderList');
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
