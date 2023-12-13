<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MonthlySaleController extends Controller
{
    public function monthlySale()
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

        // return $average;
        return response()->json([
            "monthlySales" => $monthlySales,
            "totalMonthlySalesAmount" => $total,
            "averageAmount" => $averageAmount,
            "highestSale" => $highestSellingDateOfMonth,
            "lowestSale" => $lowestSellingDateOfMonth
        ]);
    }
}
