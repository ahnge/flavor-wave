<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;

use Illuminate\Http\Request;


class ProductController extends Controller
{
    public function ProductList()
    {
        $products = Product::when(request()->has("keyword"), function ($query) {
            $query->where(function (Builder $builder) {
                $keyword = request()->keyword;

                $builder->where("title", "LIKE", "%" . $keyword . "%")
                    ->orWhere("price", "LIKE", "%" . $keyword . "%");
            });
        })
            ->paginate(5)
            ->withQueryString();

        $productLists = ProductResource::collection($products);

        return view('warehouse.index',['products'=>$productLists->resource]);

    }

    public function show(Product $product)
    {
        return view('warehouse.product.index',['product'=>$product]);
    }

    public function edit(Request $request, $id)
    {

        $request->validate([
            "quantity" => ["required" , "integer"],
            "type" => ["required"],
        ]);

        $product = Product::find($id);

        $productTotalBoxCount = $product->total_box_count;

        $type = $request->type;
        $quantity = intval($request->quantity);

        if ($type === "expire") {
            $productTotalBoxCount -=  $quantity;
            $product->update(['total_box_count' => $productTotalBoxCount]);
        } elseif ($type === "return") {
            $productTotalBoxCount += $quantity;
            $product->update(['total_box_count' => $productTotalBoxCount]);
        }

        return redirect()->back();
    }
}
