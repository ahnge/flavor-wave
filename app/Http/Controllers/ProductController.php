<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Product;
use App\Models\OrderProduct;

use Illuminate\Http\Request;
use Akaunting\Apexcharts\Chart;
use App\Http\Resources\ProductResource;
use Illuminate\Database\Eloquent\Builder;


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

        return view('warehouse.index', ['products' => $productLists->resource]);
    }

    public function show(Product $product)
    {
        return view('warehouse.product.index', ['product' => $product]);
    }

    public function edit(Request $request, $id)
    {

        $request->validate([
            "quantity" => ["required", "integer"],
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

    public function charts()
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


        // return response()->json([
        //     'productsInfo' => $productInfo
        // ], 200);

        $productNames = collect($productInfo)->map(function ($item) {
            return $item['name'];
        })->toArray();
        $productQuantity = collect($productInfo)->map(function ($item) {
            return $item['quantity'];
        })->toArray();




        $productChart = (new Chart)
            ->setWidth('100%')
            ->setHeight(400)
            ->setTitle("Product")
            ->setSubtitle("Products")
            ->setType("donut")
            ->setDataLabelsEnabled(true)
            ->setSeries($productQuantity)
            ->setLabels($productNames);


        /////////////////////////////////////////////////////////////////////////////////
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

        //dd(collect($weeklyBestSellerProducts));
        // return response()->json(
        //     [
        //         "weekly_best_seller_products" => $weeklyBestSellerProducts,
        //         "weekly_total_selling_total_amount" => $weeklyBestSellerTotalAmount,
        //     ],
        //     200
        // );
        $weeklyBestProductNames = collect($weeklyBestSellerProducts)->map(function ($item) {
            return $item['product_name'];
        })->toArray();
        $weeklyBestProductQuantity = collect($weeklyBestSellerProducts)->map(function ($item) {
            return intval($item['quantity']);
        })->toArray();

        //dd($weeklyBestProductNames, $weeklyBestProductQuantity, $productQuantity, $productNames);




        $weeklyBestProductChart = (new Chart)
            ->setWidth('100%')
            ->setHeight(400)
            ->setTitle("Best Sale Products of last week")
            ->setSubtitle("Top 7 Products")
            ->setType("pie")
            ->setDataLabelsEnabled(true)
            ->setSeries($weeklyBestProductQuantity)
            ->setLabels($weeklyBestProductNames);

        return view('warehouse.charts', compact("productChart", "weeklyBestProductChart"));
    }

    // To create new product
    public function create()
    {
        return view('warehouse.product.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric',
            'product_photo' => 'required|url',
            'pc_per_box' => 'required|integer',
            'total_box_count' => 'required|integer',
            'available_box_count' => 'required|integer',
            'reserving_box_count' => 'required|integer',
        ]);

        // Create new product
        Product::create([
            'title' => $request->input('title'),
            'price' => $request->input('price'),
            'product_photo' => $request->input('product_photo'),
            'pc_per_box' => $request->input('pc_per_box'),
            'total_box_count' => $request->input('total_box_count'),
            'available_box_count' => $request->input('available_box_count'),
            'reserving_box_count' => $request->input('reserving_box_count'),
        ]);

        return redirect()->route('warehouse.createProduct')->with('success', 'Product created successfully!');
    }
}
