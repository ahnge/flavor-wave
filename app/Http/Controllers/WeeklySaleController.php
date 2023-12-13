<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WeeklySaleController extends Controller
{
    public function weeklySale()
    {

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

        return response()->json([
            "weeklySales" => $daysOfWeek,
            "totalWeeklySalesAmount" => $total,
            "averageAmount" => $averageAmount,
            "highestSale" => $highestDay,
            "lowestSale" => $lowestDays
        ]);
    }
}
