<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\SalesOrder;
use Inertia\Inertia;

class SalesController extends Controller
{
    /**
     * Display a listing of sales orders.
     */
    public function index()
    {
        $salesOrders = SalesOrder::with(['customer', 'items'])
            ->latest()
            ->paginate(20);

        $metrics = [
            'total_sos' => SalesOrder::count(),
            'pending_sos' => SalesOrder::whereIn('status', ['draft', 'confirmed'])->count(),
            'total_customers' => Customer::active()->count(),
            'total_revenue' => SalesOrder::where('status', 'delivered')->sum('total_amount'),
            'monthly_revenue' => SalesOrder::where('status', 'delivered')
                ->whereBetween('order_date', [now()->startOfMonth(), now()->endOfMonth()])
                ->sum('total_amount'),
        ];

        return Inertia::render('sales/index', [
            'salesOrders' => $salesOrders,
            'metrics' => $metrics,
        ]);
    }

    /**
     * Display the specified sales order.
     */
    public function show(SalesOrder $salesOrder)
    {
        $salesOrder->load(['customer', 'items.product']);

        return Inertia::render('sales/show', [
            'salesOrder' => $salesOrder,
        ]);
    }
}