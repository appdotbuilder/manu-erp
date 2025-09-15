<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PurchaseOrder;
use App\Models\Vendor;
use Inertia\Inertia;

class PurchasingController extends Controller
{
    /**
     * Display a listing of purchase orders.
     */
    public function index()
    {
        $purchaseOrders = PurchaseOrder::with(['vendor', 'items'])
            ->latest()
            ->paginate(20);

        $metrics = [
            'total_pos' => PurchaseOrder::count(),
            'pending_pos' => PurchaseOrder::whereIn('status', ['draft', 'sent'])->count(),
            'total_vendors' => Vendor::active()->count(),
            'total_value' => PurchaseOrder::where('status', '!=', 'cancelled')->sum('total_amount'),
        ];

        return Inertia::render('purchasing/index', [
            'purchaseOrders' => $purchaseOrders,
            'metrics' => $metrics,
        ]);
    }

    /**
     * Display the specified purchase order.
     */
    public function show(PurchaseOrder $purchaseOrder)
    {
        $purchaseOrder->load(['vendor', 'items.product']);

        return Inertia::render('purchasing/show', [
            'purchaseOrder' => $purchaseOrder,
        ]);
    }
}