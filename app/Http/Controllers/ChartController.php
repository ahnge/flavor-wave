<?php

namespace App\Http\Controllers;

use App\Constants\OrderStatusEnum;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\TruckOrders;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    //all products quantity that have been sold until now
    public function ProductSale()
    {

        $products = Product::withCount('product')->get();
        // return $products;

        foreach ($products as $product) {
            $productName = $product->title;
            $productCount = $product->product_count;

            $productInfo[] = [
                'name' => $productName,
                'quantity' => $productCount

            ];
        }

        return response()->json([
            'productsInfo' => $productInfo
        ], 200);
    }

    /*  weekly best seller products for this week */
    public function weeklyBestSellerProduct()
    {

        $startDate = Carbon::now()->startOfWeek()->format("Y-m-d H:i:s");
        $endDate = Carbon::now()->endOfWeek()->format("Y-m-d H:i:s");

        $soldOrders  = Order::where('status',OrderStatusEnum::Delivered->value)->pluck('id');

        $weeklyBestSellerProduct = OrderProduct::selectRaw("sum(quantity) as quantity, product_id")
            ->whereIn('order_id',$soldOrders)
            ->whereBetween("created_at", [$startDate, $endDate])
            ->groupBy("product_id")
            ->orderBy("quantity", "desc")
            ->get()
            ->pluck("quantity", "product_id")
            ->toArray();

        // return $weeklyBestSellerProduct;

        $weeklyBestSellerProducts = [];
        foreach ($weeklyBestSellerProduct as $prodID => $quantity) {
            $productName = Product::where("id", $prodID)
                ->get()
                ->pluck("title")
                ->toArray();

            $weeklyBestSellerProducts[] = [
                "product_name" => implode($productName),
                "quantity" => $quantity,
            ];
        }

        /* Total cash for weekly best selling products   */
        $weeklyBestSellerTotalAmount = 0;
        foreach ($weeklyBestSellerProduct as $prodID => $quantity) {
            $price = Product::where("id", $prodID)->value("price");
            $total_amount = $price * $quantity;
            $weeklyBestSellerTotalAmount += $total_amount;
        }

        return response()->json(
            [
                "weekly_best_seller_products" => $weeklyBestSellerProducts,
                "weekly_total_selling_amount" => $weeklyBestSellerTotalAmount,
            ],
            200
        );
    }
}
