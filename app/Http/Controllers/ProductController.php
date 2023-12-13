<?php

namespace App\Http\Controllers;

use App\Models\Product;
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

    public function chart()
    {
        $chart = (new Chart)
            ->setWidth('100%')
            ->setHeight(300)
            ->setTitle("Product Trends by Week")
            ->setSubtitle("Line chart")
            ->setDataset('Order count', 'line', [112, 225, 232, 433, 586, 363, 136, 533, 222])
            ->setDataset('pre count', 'line', [11, 25, 22, 433, 56, 36, 16, 33, 22])
            ->setXaxisCategories(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep']);

        return view('warehouse.cart', compact("chart"));
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
