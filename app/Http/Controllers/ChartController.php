<?php

namespace App\Http\Controllers;

use App\Models\OrderProduct;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function ProductSale()
    {

        $products = Product::withCount('product')
            // ->withSum('productSaleAmount', 'total')
            ->get();
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

    public function weeklyBestSellerProduct()
    {
        /* For weekly best seller products  */
        $startDate = Carbon::now()->startOfWeek()->format("Y-m-d H:i:s");
        $endDate = Carbon::now()->endOfWeek()->format("Y-m-d H:i:s");

        $weeklyBestSellerProduct = OrderProduct::selectRaw("sum(quantity) as quantity, product_id")
            ->whereBetween("created_at", [$startDate, $endDate])
            ->groupBy("product_id")
            ->orderBy("quantity", "desc")
            ->get()
            ->pluck("quantity", "product_id")
            ->toArray();

        // return $weeklyBestSellerProduct;

        $weeklyBestSellerProducts = [];
        foreach ($weeklyBestSellerProduct as $prodID => $quantity) {
            $productName = Product::whereHas("product", function (Builder $query) use ($prodID) {
                $query->where("id", $prodID);
            })
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
                "weekly_total_selling_total_amount" => $weeklyBestSellerTotalAmount,
            ],
            200
        );
    }
}
