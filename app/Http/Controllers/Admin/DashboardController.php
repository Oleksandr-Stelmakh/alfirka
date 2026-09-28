<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\SiteVisit;
use Carbon\Carbon;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
   public function index(): Response
   {
      $now = Carbon::now();

      $visitorsToday = SiteVisit::query()
         ->whereDate('visit_date', $now->toDateString())
         ->count();

      $visitorsThisMonth = SiteVisit::query()
         ->whereBetween('visit_date', [
            $now->copy()->startOfMonth()->toDateString(),
            $now->copy()->endOfMonth()->toDateString(),
         ])
         ->distinct('session_id')
         ->count('session_id');

      $visitorsByMonth = SiteVisit::query()
         ->selectRaw("DATE_FORMAT(visit_date, '%Y-%m') as month, COUNT(DISTINCT session_id) as visitors")
         ->groupByRaw("DATE_FORMAT(visit_date, '%Y-%m')")
         ->orderByDesc('month')
         ->limit(6)
         ->get();   

      $startOfMonth = $now->copy()->startOfMonth();
      $endOfMonth = $now->copy()->endOfMonth();

      $monthOrders = Order::query()
         ->whereBetween('created_at', [$startOfMonth, $endOfMonth]);

      $ordersToday = Order::query()
         ->whereDate('created_at', $now->toDateString())
         ->count();

      $ordersThisMonth = (clone $monthOrders)->count();

      $totalThisMonth = (clone $monthOrders)->sum('price');

      $averageOrderThisMonth = (clone $monthOrders)->avg('price');

      $recentOrders = Order::query()
         ->latest('id')
         ->limit(5)
         ->get([
               'id',
               'name',
               'phone',
               'bouquet_title',
               'size',
               'price',
               'created_at',
         ]);

      $popularProducts = Order::query()
         ->selectRaw('bouquet_title, COUNT(*) as orders_count')
         ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
         ->groupBy('bouquet_title')
         ->orderByDesc('orders_count')
         ->limit(5)
         ->get();

      $chartStartDate = $now->copy()->startOfMonth()->startOfDay();
      $chartEndDate = $now->copy()->endOfDay();

      $ordersByDate = Order::query()
         ->selectRaw('DATE(created_at) as date, COUNT(*) as orders_count')
         ->whereBetween('created_at', [$chartStartDate, $chartEndDate])
         ->groupByRaw('DATE(created_at)')
         ->orderBy('date')
         ->pluck('orders_count', 'date');

      $ordersChart = collect();

      for ($date = $chartStartDate->copy(); $date->lte($chartEndDate); $date->addDay()) {

         $dateKey = $date->toDateString();

         $ordersChart->push([
            'date' => $dateKey,
            'orders' => (int) ($ordersByDate[$dateKey] ?? 0),
         ]);
      }

      return Inertia::render('Admin/Dashboard', [
         'stats' => [
            'ordersToday' => $ordersToday,
            'ordersThisMonth' => $ordersThisMonth,
            'totalThisMonth' => $totalThisMonth,
            'averageOrderThisMonth' => $averageOrderThisMonth,

            'visitorsToday' => $visitorsToday,
            'visitorsThisMonth' => $visitorsThisMonth,
         ],

         'visitorsByMonth' => $visitorsByMonth,

         'recentOrders' => $recentOrders,

         'popularProducts' => $popularProducts,

         'ordersChart' => $ordersChart,
      ]);
   }
}