<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class YearlySaleController extends Controller
{
    public function yearlySale()
    {

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
        return response()->json([
            "yearlySales" => $daysOfMonth,
            "totalYearlySalesAmount" => $total,
            "averageAmount" => $averageAmount,
            "highestSale" => $highestMonth,
            "lowestSale" => $lowestMonths
        ]);
    }
}
