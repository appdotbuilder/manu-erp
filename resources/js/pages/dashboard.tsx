import React from 'react';
import { Head } from '@inertiajs/react';
import { AppShell } from '@/components/app-shell';

interface Metrics {
  total_customers: number;
  total_vendors: number;
  total_products: number;
  total_employees: number;
  low_stock_products: number;
  pending_purchase_orders: number;
  pending_sales_orders: number;
  monthly_revenue: number;
}

interface PurchaseOrder {
  id: number;
  po_number: string;
  vendor: {
    name: string;
  };
  total_amount: number;
  status: string;
  order_date: string;
}

interface SalesOrder {
  id: number;
  so_number: string;
  customer: {
    name: string;
  };
  total_amount: number;
  status: string;
  order_date: string;
}

interface Product {
  id: number;
  code: string;
  name: string;
  stock_quantity: number;
  reorder_level: number;
  type: string;
}

interface Props {
  metrics: Metrics;
  recentPurchaseOrders: PurchaseOrder[];
  recentSalesOrders: SalesOrder[];
  lowStockProducts: Product[];
  [key: string]: unknown;
}

export default function Dashboard({
  metrics,
  recentPurchaseOrders,
  recentSalesOrders,
  lowStockProducts,
}: Props) {
  const formatCurrency = (amount: number) => {
    return new Intl.NumberFormat('en-US', {
      style: 'currency',
      currency: 'USD',
    }).format(amount);
  };

  const getStatusBadge = (status: string) => {
    const statusColors = {
      draft: 'bg-gray-100 text-gray-800',
      sent: 'bg-blue-100 text-blue-800',
      confirmed: 'bg-blue-100 text-blue-800',
      received: 'bg-green-100 text-green-800',
      delivered: 'bg-green-100 text-green-800',
      cancelled: 'bg-red-100 text-red-800',
    };

    return (
      <span
        className={`inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${
          statusColors[status as keyof typeof statusColors] || 'bg-gray-100 text-gray-800'
        }`}
      >
        {status.charAt(0).toUpperCase() + status.slice(1)}
      </span>
    );
  };

  return (
    <AppShell>
      <Head title="ERP Dashboard" />

      <div className="p-6">
        {/* Header */}
        <div className="mb-8">
          <h1 className="text-3xl font-bold text-gray-900 dark:text-white">
            🏭 Manufacturing ERP Dashboard
          </h1>
          <p className="mt-2 text-gray-600 dark:text-gray-400">
            Welcome to your comprehensive business management system
          </p>
        </div>

        {/* Key Metrics Grid */}
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
          <div className="bg-white dark:bg-gray-800 p-6 rounded-lg shadow border dark:border-gray-700">
            <div className="flex items-center">
              <div className="p-2 bg-blue-500 rounded-lg">
                <span className="text-white text-2xl">👥</span>
              </div>
              <div className="ml-4">
                <p className="text-sm font-medium text-gray-600 dark:text-gray-400">Customers</p>
                <p className="text-2xl font-bold text-gray-900 dark:text-white">
                  {metrics.total_customers.toLocaleString()}
                </p>
              </div>
            </div>
          </div>

          <div className="bg-white dark:bg-gray-800 p-6 rounded-lg shadow border dark:border-gray-700">
            <div className="flex items-center">
              <div className="p-2 bg-green-500 rounded-lg">
                <span className="text-white text-2xl">🏪</span>
              </div>
              <div className="ml-4">
                <p className="text-sm font-medium text-gray-600 dark:text-gray-400">Vendors</p>
                <p className="text-2xl font-bold text-gray-900 dark:text-white">
                  {metrics.total_vendors.toLocaleString()}
                </p>
              </div>
            </div>
          </div>

          <div className="bg-white dark:bg-gray-800 p-6 rounded-lg shadow border dark:border-gray-700">
            <div className="flex items-center">
              <div className="p-2 bg-purple-500 rounded-lg">
                <span className="text-white text-2xl">📦</span>
              </div>
              <div className="ml-4">
                <p className="text-sm font-medium text-gray-600 dark:text-gray-400">Products</p>
                <p className="text-2xl font-bold text-gray-900 dark:text-white">
                  {metrics.total_products.toLocaleString()}
                </p>
              </div>
            </div>
          </div>

          <div className="bg-white dark:bg-gray-800 p-6 rounded-lg shadow border dark:border-gray-700">
            <div className="flex items-center">
              <div className="p-2 bg-orange-500 rounded-lg">
                <span className="text-white text-2xl">👨‍💼</span>
              </div>
              <div className="ml-4">
                <p className="text-sm font-medium text-gray-600 dark:text-gray-400">Employees</p>
                <p className="text-2xl font-bold text-gray-900 dark:text-white">
                  {metrics.total_employees.toLocaleString()}
                </p>
              </div>
            </div>
          </div>

          <div className="bg-white dark:bg-gray-800 p-6 rounded-lg shadow border dark:border-gray-700">
            <div className="flex items-center">
              <div className="p-2 bg-red-500 rounded-lg">
                <span className="text-white text-2xl">⚠️</span>
              </div>
              <div className="ml-4">
                <p className="text-sm font-medium text-gray-600 dark:text-gray-400">Low Stock</p>
                <p className="text-2xl font-bold text-gray-900 dark:text-white">
                  {metrics.low_stock_products}
                </p>
              </div>
            </div>
          </div>

          <div className="bg-white dark:bg-gray-800 p-6 rounded-lg shadow border dark:border-gray-700">
            <div className="flex items-center">
              <div className="p-2 bg-cyan-500 rounded-lg">
                <span className="text-white text-2xl">📋</span>
              </div>
              <div className="ml-4">
                <p className="text-sm font-medium text-gray-600 dark:text-gray-400">Pending POs</p>
                <p className="text-2xl font-bold text-gray-900 dark:text-white">
                  {metrics.pending_purchase_orders}
                </p>
              </div>
            </div>
          </div>

          <div className="bg-white dark:bg-gray-800 p-6 rounded-lg shadow border dark:border-gray-700">
            <div className="flex items-center">
              <div className="p-2 bg-indigo-500 rounded-lg">
                <span className="text-white text-2xl">🛒</span>
              </div>
              <div className="ml-4">
                <p className="text-sm font-medium text-gray-600 dark:text-gray-400">Pending SOs</p>
                <p className="text-2xl font-bold text-gray-900 dark:text-white">
                  {metrics.pending_sales_orders}
                </p>
              </div>
            </div>
          </div>

          <div className="bg-white dark:bg-gray-800 p-6 rounded-lg shadow border dark:border-gray-700">
            <div className="flex items-center">
              <div className="p-2 bg-green-600 rounded-lg">
                <span className="text-white text-2xl">💰</span>
              </div>
              <div className="ml-4">
                <p className="text-sm font-medium text-gray-600 dark:text-gray-400">Monthly Revenue</p>
                <p className="text-2xl font-bold text-gray-900 dark:text-white">
                  {formatCurrency(metrics.monthly_revenue)}
                </p>
              </div>
            </div>
          </div>
        </div>

        {/* Recent Activities */}
        <div className="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
          {/* Recent Purchase Orders */}
          <div className="bg-white dark:bg-gray-800 p-6 rounded-lg shadow border dark:border-gray-700">
            <h3 className="text-lg font-semibold text-gray-900 dark:text-white mb-4">
              📋 Recent Purchase Orders
            </h3>
            <div className="space-y-4">
              {recentPurchaseOrders.map((po) => (
                <div key={po.id} className="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                  <div>
                    <p className="font-medium text-gray-900 dark:text-white">{po.po_number}</p>
                    <p className="text-sm text-gray-600 dark:text-gray-400">{po.vendor.name}</p>
                  </div>
                  <div className="text-right">
                    <p className="font-medium text-gray-900 dark:text-white">
                      {formatCurrency(po.total_amount)}
                    </p>
                    {getStatusBadge(po.status)}
                  </div>
                </div>
              ))}
              {recentPurchaseOrders.length === 0 && (
                <p className="text-gray-500 dark:text-gray-400 text-center py-4">
                  No recent purchase orders
                </p>
              )}
            </div>
          </div>

          {/* Recent Sales Orders */}
          <div className="bg-white dark:bg-gray-800 p-6 rounded-lg shadow border dark:border-gray-700">
            <h3 className="text-lg font-semibold text-gray-900 dark:text-white mb-4">
              🛒 Recent Sales Orders
            </h3>
            <div className="space-y-4">
              {recentSalesOrders.map((so) => (
                <div key={so.id} className="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                  <div>
                    <p className="font-medium text-gray-900 dark:text-white">{so.so_number}</p>
                    <p className="text-sm text-gray-600 dark:text-gray-400">{so.customer.name}</p>
                  </div>
                  <div className="text-right">
                    <p className="font-medium text-gray-900 dark:text-white">
                      {formatCurrency(so.total_amount)}
                    </p>
                    {getStatusBadge(so.status)}
                  </div>
                </div>
              ))}
              {recentSalesOrders.length === 0 && (
                <p className="text-gray-500 dark:text-gray-400 text-center py-4">
                  No recent sales orders
                </p>
              )}
            </div>
          </div>
        </div>

        {/* Low Stock Products */}
        {lowStockProducts.length > 0 && (
          <div className="bg-white dark:bg-gray-800 p-6 rounded-lg shadow border dark:border-gray-700 mb-8">
            <h3 className="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
              ⚠️ Low Stock Alert
              <span className="ml-2 bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                {lowStockProducts.length}
              </span>
            </h3>
            <div className="overflow-x-auto">
              <table className="min-w-full">
                <thead>
                  <tr className="border-b border-gray-200 dark:border-gray-700">
                    <th className="px-4 py-2 text-left text-sm font-medium text-gray-900 dark:text-white">Product</th>
                    <th className="px-4 py-2 text-left text-sm font-medium text-gray-900 dark:text-white">Type</th>
                    <th className="px-4 py-2 text-center text-sm font-medium text-gray-900 dark:text-white">Current Stock</th>
                    <th className="px-4 py-2 text-center text-sm font-medium text-gray-900 dark:text-white">Reorder Level</th>
                  </tr>
                </thead>
                <tbody>
                  {lowStockProducts.map((product) => (
                    <tr key={product.id} className="border-b border-gray-100 dark:border-gray-700">
                      <td className="px-4 py-3">
                        <div>
                          <p className="font-medium text-gray-900 dark:text-white">{product.name}</p>
                          <p className="text-sm text-gray-600 dark:text-gray-400">{product.code}</p>
                        </div>
                      </td>
                      <td className="px-4 py-3">
                        <span className="capitalize text-sm text-gray-600 dark:text-gray-400">
                          {product.type.replace('_', ' ')}
                        </span>
                      </td>
                      <td className="px-4 py-3 text-center">
                        <span className="font-medium text-red-600 dark:text-red-400">
                          {product.stock_quantity}
                        </span>
                      </td>
                      <td className="px-4 py-3 text-center">
                        <span className="text-gray-900 dark:text-white">{product.reorder_level}</span>
                      </td>
                    </tr>
                  ))}
                </tbody>
              </table>
            </div>
          </div>
        )}
      </div>
    </AppShell>
  );
}