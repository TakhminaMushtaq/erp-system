<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SalesOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSales = SalesOrder::sum('total_amount');
        $totalOrders = SalesOrder::count();
        $lowStockProducts = Product::where('quantity', '<=', 5)->get();

        // 1. Generate last 7 days (daily)
    $dailyDays = collect();
    for ($i = 6; $i >= 0; $i--) {
        $dailyDays->push(Carbon::today()->subDays($i)->format('Y-m-d'));
    }

    $dailySalesRaw = DB::table('sales_orders')
        ->selectRaw('DATE(sale_date) as date, SUM(total_amount) as total')
        ->whereBetween('sale_date', [Carbon::today()->subDays(6), Carbon::today()])
        ->groupBy('date')
        ->pluck('total', 'date');

    $dailySales = $dailyDays->map(function ($date) use ($dailySalesRaw) {
        return [
            'date' => $date,
            'total' => $dailySalesRaw[$date] ?? 0,
        ];
    });

    // 2. Generate weekly sales for current month
    $startOfMonth = Carbon::now()->startOfMonth();
    $endOfMonth = Carbon::now()->endOfMonth();

    $weeklySalesRaw = DB::table('sales_orders')
        ->selectRaw('WEEK(sale_date, 1) as week, SUM(total_amount) as total')
        ->whereBetween('sale_date', [$startOfMonth, $endOfMonth])
        ->groupBy('week')
        ->pluck('total', 'week');

    // Generate all week numbers in current month
    $weeksInMonth = [];
    $current = $startOfMonth->copy()->startOfWeek(Carbon::MONDAY);
    while ($current->lt($endOfMonth)) {
        $weeksInMonth[] = $current->week(); // get ISO week number
        $current->addWeek();
    }

    $weeklySales = collect($weeksInMonth)->map(function ($weekNum) use ($weeklySalesRaw) {
        return [
            'week' => $weekNum,
            'total' => $weeklySalesRaw[$weekNum] ?? 0,
        ];
    });

        return view('dashboard', compact(
            'totalSales', 'totalOrders', 'lowStockProducts',
            'dailySales', 'weeklySales'
        ));
    }
}
