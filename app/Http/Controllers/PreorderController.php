<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Akaunting\Apexcharts\Chart;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Resources\PreorderListsResource;

class PreorderController extends Controller
{
    public function preorderLists()
    {

        $orders = Order::when(request()->has("keyword"), function ($query) {
            $query->where(function (Builder $builder) {
                $keyword = request()->keyword;

                $builder->where("order_no", "LIKE", "%" . $keyword . "%")
                    ->orWhereHas('Distributor', function ($q) {
                        $q->where('name', "LIKE", "%" . request()->keyword . "%");
                    });
            });
        })

            ->when(request()->has("orderStatus"), function ($query) {
                $query->where(function (Builder $builder) {
                    $status = request()->orderStatus;
                    if ($status != 10) {
                        $builder->where("status", $status);
                    }
                });
            })

            ->latest("is_urgent")
            ->orderBy("due_date", "asc")
            ->paginate(10)
            ->withQueryString();

        $orderLists = PreorderListsResource::collection($orders);

        return view('sales.index', ['preorders' => $orderLists->resource]);
    }

    //  public function filteredPreorderList(int $status)
    // {

    //     if ($status == 10) {
    //         return redirect()->route('preorder.preorderList');
    //     }

    //     $orders = Order::where('status', $status)
    //         ->when(request()->has("keyword"), function ($query) {
    //             $query->where(function (Builder $builder) {
    //                 $keyword = request()->keyword;

    //                 $builder->where("order_no", "LIKE", "%" . $keyword . "%")
    //                     ->orWhereHas('Distributor', function ($q) {
    //                         $q->where('name', "LIKE", "%" . request()->keyword . "%");
    //                     });
    //             });
    //         })
    //         ->when(request()->has('id'), function ($query) {
    //             $sortType = request()->id ?? 'asc';
    //             $query->orderBy("id", $sortType);
    //         })
    //         ->latest("is_urgent")
    //         ->paginate(10)
    //         ->withQueryString();

    //     $orderLists = PreorderListsResource::collection($orders);

    //     return view('sales.index', ['preorders' => $orderLists->resource, 'status' => $status]);
    // }

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

    public function charts()
    {
        $currentDate = Carbon::now();
        // return $currentDate;
        $startOfMonth = $currentDate->startOfMonth();
        // return $startOfMonth;

        if ($currentDate->isLastOfMonth()) {
            // If today is the last day of the current month, retrieve sales for the entire month.
            $endOfMonth = $currentDate->endOfMonth();
        } else {
            // If today is not the last day of the current month, set the end date to today.
            $endOfMonth = Carbon::now();
        }

        // return $endOfMonth;

        $monthlySales = DB::table('orders')
            ->select(DB::raw("DATE_FORMAT(created_at, '%d/%m/%Y') as date"), DB::raw('CAST(SUM(total) AS SIGNED) as total_sales'))
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%d/%m/%Y')"))
            ->get();

        // return $monthlySales;

        $monthly = collect($monthlySales);

        $total = $monthly->sum('total_sales');
        // return $total;

        //Highest Sales
        $highest = $monthly->max('total_sales');
        // return $highest;
        $highestSellingDate = $monthly->where('total_sales', $highest)->pluck('date')->first();
        // return $highestSellingDate;

        $highestSellingDateOfMonth = [
            "highestSaleAmount" => $highest,
            "highestSellingDateOfMonth" => $highestSellingDate
        ];

        // return $highestSellingDateOfMonth;


        //Lowest Sales
        $lowest = $monthly->min('total_sales');
        // return $lowest;

        if ($lowest == 0) {
            $lowestSellingDates = $monthly->where('total_sales', $lowest)->pluck('date');
            // return $lowestSellingDates;
            $lowestDays = [];
            foreach ($lowestSellingDates as $day) {
                // $date = $day->format('m/d/Y');
                $lowestSaleAmount = $lowest;
                $lowestSellingDateOfMonth[] = [
                    'lowestSaleAmount' => $lowestSaleAmount,
                    'lowestSellingDateOfMonth' => $day
                ];
            }
            // return $lowestDays;
        } else {
            $lowestSellingDate = $monthly->where('total_sales', $lowest)->pluck('date')->first();
            // return  $lowestSellingDate;

            $lowestSellingDateOfMonth = [
                "lowestSaleAmount" => $lowest,
                "lowestSellingDateOfMonth" => $lowestSellingDate
            ];
        }

        // return $lowestDays;

        $average = $monthly->avg('total_sales');
        $averageAmount = round($average, 2);
        $dates = $monthlySales->pluck('date')->toArray();
        //dd($monthlySales);
        // dd([
        //     "monthlySales" => $monthlySales,
        //     "totalMonthlySalesAmount" => $total,
        //     "averageAmount" => $averageAmount,
        //     "highestSale" => $highestSellingDateOfMonth,
        //     "lowestSale" => $lowestSellingDateOfMonth
        // ]);


        $dateValuesArray = $monthlySales->map(function ($item) {
            return $item->date;
        })->toArray();
        $totalSalesValuesArray = $monthlySales->map(function ($item) {
            return $item->total_sales;
        })->toArray();

        //dd($dateValuesArray);


        ////////////////////////////////////////////////////////////////////
        // for weekly
        $weeklySales = Order::select(
            DB::raw('DATE(created_at) as sale_date'),
            DB::raw('CAST(SUM(total) AS SIGNED) as total_sales')
        )
            ->whereBetween('created_at', [
                now()->startOfWeek(),
                now()->endOfWeek()
            ])
            ->groupBy('sale_date')
            ->get();
        // return $weeklySales;
        // dd($weeklySales);

        // Calculate the best-selling day
        $bestSellingDay = $weeklySales->max('total_sales');

        // Find the date of the best-selling day
        $bestSellingDate = $weeklySales->where('total_sales', $bestSellingDay)->pluck('sale_date')->first();
        // return $bestSellingDate; //2023-09-09

        // Convert the date to a Carbon instance
        $bestSellingDateFormatted = Carbon::parse($bestSellingDate);

        // Get the day name (e.g., Monday, Tuesday)
        $bestSellingDayName = $bestSellingDateFormatted->formatLocalized('%A');
        // return $bestSellingDayName; //Saturday

        // Create an array to store day names and total sales for the entire week
        $daysOfWeek = [];

        // Loop through the week and get day names
        for ($i = 0; $i < 7; $i++) {
            $day = Carbon::parse($bestSellingDate)->startOfWeek()->addDays($i);
            $dayName = $day->formatLocalized('%A');
            // $date = $day->format("m/d/Y");

            // Calculate sales for the current day
            $daySales = $weeklySales->where('sale_date', $day->format('Y-m-d'))->first()?->total_sales ?? 0;
            // return $daySales;

            $daysOfWeek[] = [
                'dayName' => $dayName,
                'daySales' => $daySales,
                'date' => $day
            ];
        }
        // return $daysOfWeek;
        // dd($daysOfWeek);

        // dd(collect($daysOfWeek));

        $all = collect($daysOfWeek);


        $total = $weeklySales->sum('total_sales');
        // return $total;

        //Highest Sales
        $highest = $all->max('daySales');
        // return $highest;
        $highestSellingDate = $all->where('daySales', $highest)->pluck('date')->first();
        // return  $highestSellingDate;
        $highestSellingDateFormat = $highestSellingDate->format('m/d/Y');
        $highestDay = [
            "highestSaleAmount" => $highest,
            "highestSellingDate" => $highestSellingDateFormat
        ];

        // return $highestSellingDateFormat;
        // return $highestDay;

        //Lowest Sales
        $lowest = $all->min('daySales');
        // return $lowest;

        if ($lowest == 0) {
            $lowestSellingDays = $all->where('daySales', $lowest)->pluck('date');
            // return $lowestSellingDays;
            $lowestDays = [];
            foreach ($lowestSellingDays as $day) {
                $date = $day->format('m/d/Y');
                $lowestSaleAmount = $lowest;
                $lowestDays[] = [
                    'lowestSaleAmount' => $lowestSaleAmount,
                    'lowestSellingDay' => $date
                ];
            }
            // return $lowestDays;
        } else {
            $lowestSellingDate = $all->where('daySales', $lowest)->pluck('date')->first();
            // return  $lowestSellingDate;
            $lowestSellingDateFormat = $lowestSellingDate->format('m/d/Y');
            $lowestDays = [
                "lowestSaleAmount" => $lowest,
                "lowestSellingDate" => $lowestSellingDateFormat
            ];
        }

        // return $lowestDays;

        $average = $weeklySales->avg('total_sales');
        $averageAmount = round($average, 2);
        // return $average;
        // dd(
        //     $all
        // );

        $dayValuesArray = $all->map(function ($item) {
            return $item['dayName'];
        })->toArray();
        $daySalesValuesArray = $all->map(function ($item) {
            return $item['daySales'];
        })->toArray();

        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        //yearly chart
        $monthlySales = Order::select(
            DB::raw('MONTH(created_at) as sale_month'),
            DB::raw('CAST(SUM(total) AS SIGNED) as total_sales')
        )
            ->whereBetween('created_at', [
                now()->startOfYear(),
                now()->endOfYear()
            ])
            ->groupBy('sale_month')
            ->get();

        // return $monthlySales;

        // Get the current year
        $currentYear = now()->year;

        // Format the sale_month as "YYYY-MM-DD"
        $monthlySales->transform(function ($item) use ($currentYear) {
            $formattedDate = Carbon::create($currentYear, $item->sale_month, 1)->format('Y-m-d');
            // Replace the sale_month with the formatted date
            $item->sale_month = $formattedDate;

            return $item;
        });

        // return $monthlySales;


        // Calculate the best-selling month
        $bestSellingMonth = $monthlySales->max('total_sales');

        // Find the date of the best-selling month
        $bestSellingDate = $monthlySales->where('total_sales', $bestSellingMonth)->pluck('sale_month')->first();
        // return $bestSellingDate; //2023-08-01

        $date = Carbon::createFromFormat('Y-m-d', $bestSellingDate);
        // return $date;
        $monthName = $date->format('F');
        // return $monthName;

        //Calculate start of month of current year
        $month = Carbon::parse($bestSellingDate)->startOfYear();
        $monthName = $month->format('F');
        // return $monthName; //January
        // return $month; //2023-01-01T00:00:00.000000Z

        // Create an array to store day names and total sales for the entire month
        $daysOfMonth = [];

        // Loop through the month and get month names
        for ($i = 0; $i < 12; $i++) {
            $month = Carbon::parse($bestSellingDate)->startOfYear()->addMonths($i);
            $monthName = $month->format('F');

            // Calculate sales for the current month
            $monthSales = $monthlySales->where('sale_month', $month->format('Y-m-d'))->first()?->total_sales ?? 0;
            // return $monthlySales;

            $daysOfMonth[] = [
                'monthName' => $monthName,
                'monthSales' => $monthSales,
                'date' => $month
            ];
        }
        // return $daysOfMonth;
        // dd($daysOfMonth);

        // dd(collect($daysOfMonth));

        $all = collect($daysOfMonth);


        $total = $monthlySales->sum('total_sales');
        // return $total;

        //Highest Sales
        $highest = $all->max('monthSales');
        // return $highest;
        $highestSellingMonth = $all->where('monthSales', $highest)->pluck('date')->first();
        // return  $highestSellingDate;
        $highestSellingDateFormat = $highestSellingMonth->format('m/d/Y');
        $highestMonth = [
            "highestSaleAmount" => $highest,
            "highestSellingMonth" => $highestSellingDateFormat
        ];

        // return $highestSellingDateFormat;
        // return $highestDay;

        //Lowest Sales
        $lowest = $all->min('monthSales');
        // return $lowest;

        if ($lowest == 0) {
            $lowestSellingMonths = $all->where('monthSales', $lowest)->pluck('date');
            // return $lowestSellingDays;
            $lowestDays = [];
            foreach ($lowestSellingMonths as $day) {
                $date = $day->format('m/d/Y');
                $lowestSaleAmount = $lowest;
                $lowestMonths[] = [
                    'lowestSaleAmount' => $lowestSaleAmount,
                    'lowestSellingMonth' => $date
                ];
            }
            // return $lowestDays;
        } else {
            $lowestSellingDate = $all->where('monthSales', $lowest)->pluck('date')->first();
            // return  $lowestSellingDate;
            $lowestSellingDateFormat = $lowestSellingDate->format('m/d/Y');
            $lowestMonths = [
                "lowestSaleAmount" => $lowest,
                "lowestSellingDate" => $lowestSellingDateFormat
            ];
        }

        // return $lowestDays;

        $average = $monthlySales->avg('total_sales');
        $averageAmount = round($average, 2);
        // return $average;
        // return response()->json([
        //     "yearlySales" => $daysOfMonth,
        //     "totalYearlySalesAmount" => $total,
        //     "averageAmount" => $averageAmount,
        //     "highestSale" => $highestMonth,
        //     "lowestSale" => $lowestMonths
        // ]);



        $yearMonthValuesArray = $all->map(function ($item) {
            return $item['monthName'];
        })->toArray();
        $yearSaleValuesArray = $all->map(function ($item) {
            return $item['monthSales'];
        })->toArray();


        $chartsData = [$yearMonthValuesArray, $yearSaleValuesArray, $dateValuesArray, $totalSalesValuesArray, $dayValuesArray, $daySalesValuesArray];

        return view('sales.charts')->with("chartsData", $chartsData);
    }

    public function preorderDetails(Request $request)
    {
        $order = Order::findOrFail($request->id);
        return view("logistic.approvedProducts", compact('order'));
    }
}
