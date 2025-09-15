<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Inertia\Inertia;

class InventoryController extends Controller
{
    /**
     * Display a listing of inventory items.
     */
    public function index()
    {
        $products = Product::with(['purchaseOrderItems', 'salesOrderItems'])
            ->active()
            ->paginate(20);

        $lowStockCount = Product::lowStock()->active()->count();
        $totalValue = Product::active()->sum(\DB::raw('stock_quantity * cost'));

        return Inertia::render('inventory/index', [
            'products' => $products,
            'lowStockCount' => $lowStockCount,
            'totalValue' => $totalValue,
        ]);
    }

    /**
     * Display the specified inventory item.
     */
    public function show(Product $product)
    {
        $product->load(['purchaseOrderItems.purchaseOrder.vendor', 'salesOrderItems.salesOrder.customer']);

        return Inertia::render('inventory/show', [
            'product' => $product,
        ]);
    }
}