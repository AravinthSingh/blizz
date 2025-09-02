<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalCategories = Category::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $recentOrders = Order::with('orderItems.product')->latest()->take(5)->get();
        $lowStockProducts = Product::where('quantity', '<=', 5)->get();

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalOrders', 
            'totalCategories',
            'pendingOrders',
            'recentOrders',
            'lowStockProducts'
        ));
    }

    public function salesSummary()
    {
        $totalRevenue = Order::where('status', 'completed')->sum('total_amount');
        $monthlyRevenue = Order::where('status', 'completed')
            ->whereMonth('created_at', now()->month)
            ->sum('total_amount');
        
        $ordersByStatus = Order::selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status');

        $topProducts = Product::withCount('orderItems')
            ->orderBy('order_items_count', 'desc')
            ->take(10)
            ->get();

        return view('admin.sales-summary', compact(
            'totalRevenue',
            'monthlyRevenue',
            'ordersByStatus',
            'topProducts'
        ));
    }
}
