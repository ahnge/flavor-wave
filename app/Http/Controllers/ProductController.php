<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Product;
use App\Models\OrderProduct;

use Illuminate\Http\Request;
use Akaunting\Apexcharts\Chart;
use App\Constants\OrderStatusEnum;
use App\Exports\ProductExport;
use App\Http\Resources\ProductResource;
use App\Imports\ProductImport;
use App\Models\Order;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;


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
            ->latest("id")
            ->paginate(5)
            ->withQueryString();

        $allProducts = Product::all();

        $totalQty = 0;
        $availableTotal = 0;

        foreach ($allProducts as $product) {
            $totalQty += $product->total_box_count;
            $availableTotal += $product->available_box_count;
        }


        $productLists = ProductResource::collection($products);

        return view('warehouse.index', [
            'products' => $productLists->resource,
            'totalProducts' => Product::all()->count(),
            'totalQty' => $totalQty,
            'availableTotal' => $availableTotal
        ]);
    }

    public function changeQty(Product $product)
    {
        return view('warehouse.product.index', ['product' => $product]);
    }

    public function edit(Request $request, $id)
    {

        $request->validate([
            "quantity" => ["required", "integer"],
            "type" => ["required"],
        ]);

        if (request('type') == '') {
            return redirect()->back()->with('error');
        }

        $product = Product::find($id);

        $productTotalBoxCount = $product->total_box_count;

        $productAvailableBoxCount = $product->available_box_count;

        $type = $request->type;
        $quantity = intval($request->quantity);

        if ($type === "expire") {
            $productTotalBoxCount -=  $quantity;
            $productAvailableBoxCount -= $quantity;
            $product->update(['total_box_count' => max(0, $productTotalBoxCount), 'available_box_count' => max(0, $productAvailableBoxCount)]);
        } elseif ($type === "produce") {
            $productTotalBoxCount += $quantity;
            $productAvailableBoxCount += $quantity;
            $product->update(['total_box_count' => $productTotalBoxCount, 'available_box_count' => $productAvailableBoxCount]);
        }

        return redirect()->back()->with('success', 'Quantity Updated.');
    }

    public function charts()
    {
        $products = Product::withCount('product')
            // ->withSum('productSaleAmount', 'total')
            ->get();

        if ($products->empty()) {
            return redirect()->back()->with('success', "There is not products currently in warehouse.");
        };

        foreach ($products as $product) {
            $productName = $product->title;
            $productCount = $product->product_count;

            $productInfo[] = [
                'name' => $productName,
                'quantity' => $productCount

            ];
        }

        $productNames = collect($productInfo)->map(function ($item) {
            return $item['name'];
        })->toArray();
        $productQuantity = collect($productInfo)->map(function ($item) {
            return $item['quantity'];
        })->toArray();

        /////////////////////////////////////////////////////////////////////////////////
        /* For weekly best seller products  */
        $startDate = Carbon::now()->startOfWeek()->format("Y-m-d H:i:s");
        $endDate = Carbon::now()->endOfWeek()->format("Y-m-d H:i:s");
        $soldOrders  = Order::where('status', OrderStatusEnum::Delivered->value)->pluck('id');
        $weeklyBestSellerProduct = OrderProduct::selectRaw("sum(quantity) as quantity, product_id")
            ->whereIn('order_id', $soldOrders)
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

        if (count($weeklyBestProductNames) == 0) {
            $weeklyBestProductNames = ['No Data'];
            $weeklyBestProductQuantity = [100];
        }


        $chartsData = [$weeklyBestProductNames, $weeklyBestProductQuantity, $productNames, $productQuantity];
        return view('warehouse.charts')->with("chartsData", $chartsData);
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
            'product_photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'pc_per_box' => 'required|integer',
            'total_box_count' => 'required|integer',
        ]);

        // Upload image to AWS S3
        $path = $request->file('product_photo')->store('images/products', 's3');


        // Create new product
        Product::create([
            'title' => $request->input('title'),
            'price' => $request->input('price'),
            'product_photo' => Storage::disk('s3')->url($path),
            'pc_per_box' => $request->input('pc_per_box'),
            'total_box_count' => $request->input('total_box_count'),
            'available_box_count' => $request->input('total_box_count'),
        ]);

        return redirect()->route('warehouse.productList')->with('success', 'Product created successfully!');
    }

    // exel import
    public function import(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'excel_file' => 'required|mimes:xlsx,xls',
        ]);

        // Get the uploaded file
        $file = $request->file('excel_file');

        // Process the Excel file
        Excel::import(new ProductImport, $file);

        return redirect()->route('warehouse.productList')->with('success', 'Excel file imported successfully!');
    }

    public function exportProducts()
    {
        return Excel::download(new ProductExport, 'products.xlsx');
    }

    public function editDetails(Request $request, Product $product)
    {

        $oldData = [$product->title, $product->price, $product->pc_per_box, $product->product_photo];

        $updatedDetail = request()->validate([
            'title' => ['required', 'min:2'],
            'price' => ['required', 'integer'],
            'ppb' => ['required', 'integer'],
        ]);

        $path = $request->file('product_photo') ? $request->file('product_photo')->store('images/products', 's3') : '';
        $product->update([
            'title' => request('title'),
            'price' => request('price'),
            'pc_per_box' => request('ppb'),
            'product_photo' => $path ? Storage::disk('s3')->url($path) : $product->product_photo,
        ]);

        $newData = [$product->title, $product->price, $product->pc_per_box, $product->product_photo];

        /*   $product->update([
            'title' => request('title'),
            'price' => request('price'),
            'pc_per_box' => request('ppb'),
        ]); */

        if ($oldData != $newData) {

            return redirect()->back()->with('success', 'Details Updated.');
        }

        return redirect()->back()->with('error', 'No details changed.');
    }

    public function showInfo(Product $product)
    {
        return view('warehouse.product.edit', ['product' => $product]);
    }
}
