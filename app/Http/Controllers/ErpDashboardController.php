<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\SalesOrder;
use App\Models\Vendor;
use Inertia\Inertia;

class ErpDashboardController extends Controller
{
    /**
     * Display the ERP dashboard.
     */
    public function index()
    {
        // Get key metrics
        $metrics = [
            'total_customers' => Customer::active()->count(),
            'total_vendors' => Vendor::active()->count(),
            'total_products' => Product::active()->count(),
            'total_employees' => Employee::active()->count(),
            'low_stock_products' => Product::lowStock()->active()->count(),
            'pending_purchase_orders' => PurchaseOrder::whereIn('status', ['draft', 'sent'])->count(),
            'pending_sales_orders' => SalesOrder::whereIn('status', ['draft', 'confirmed'])->count(),
            'monthly_revenue' => SalesOrder::where('status', 'delivered')
                ->whereBetween('order_date', [now()->startOfMonth(), now()->endOfMonth()])
                ->sum('total_amount'),
        ];

        // Get recent activities
        $recentPurchaseOrders = PurchaseOrder::with('vendor')
            ->latest()
            ->take(5)
            ->get();

        $recentSalesOrders = SalesOrder::with('customer')
            ->latest()
            ->take(5)
            ->get();

        $lowStockProducts = Product::lowStock()
            ->active()
            ->take(10)
            ->get();



        return Inertia::render('dashboard', [
            'metrics' => $metrics,
            'recentPurchaseOrders' => $recentPurchaseOrders,
            'recentSalesOrders' => $recentSalesOrders,
            'lowStockProducts' => $lowStockProducts,
        ]);
    }
}