<?php

namespace Database\Seeders;

use App\Models\ChartOfAccounts;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\JournalEntry;
use App\Models\JournalEntryLine;
use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItem;
use App\Models\SalesOrder;
use App\Models\SalesOrderItem;
use App\Models\Vendor;
use Illuminate\Database\Seeder;

class ErpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create chart of accounts
        $this->createChartOfAccounts();

        // Create vendors
        $vendors = Vendor::factory()->count(15)->active()->create();

        // Create customers
        $customers = Customer::factory()->count(25)->active()->create();

        // Create products
        $rawMaterials = Product::factory()->count(20)->rawMaterial()->create();
        $finishedGoods = Product::factory()->count(15)->finishedGood()->create();
        $wipProducts = Product::factory()->count(10)->create(['type' => 'work_in_progress']);

        // Create some low stock products
        Product::factory()->count(8)->lowStock()->create();

        // Create employees
        Employee::factory()->count(35)->active()->create();

        // Create purchase orders with items
        $purchaseOrders = PurchaseOrder::factory()->count(20)->create([
            'vendor_id' => fn() => $vendors->random()->id,
        ]);

        foreach ($purchaseOrders as $po) {
            $items = PurchaseOrderItem::factory()->count(random_int(1, 5))->create([
                'purchase_order_id' => $po->id,
                'product_id' => fn() => $rawMaterials->random()->id,
            ]);

            // Update total amount
            $po->update(['total_amount' => $items->sum('total_price')]);
        }

        // Create sales orders with items
        $salesOrders = SalesOrder::factory()->count(30)->create([
            'customer_id' => fn() => $customers->random()->id,
        ]);

        foreach ($salesOrders as $so) {
            $items = SalesOrderItem::factory()->count(random_int(1, 4))->create([
                'sales_order_id' => $so->id,
                'product_id' => fn() => $finishedGoods->random()->id,
            ]);

            // Update totals
            $subtotal = $items->sum('total_price');
            $taxAmount = $subtotal * 0.1;
            $total = $subtotal + $taxAmount;

            $so->update([
                'subtotal' => $subtotal,
                'tax_amount' => $taxAmount,
                'total_amount' => $total,
            ]);
        }

        // Create some journal entries
        $accounts = ChartOfAccounts::active()->get();
        $journalEntries = JournalEntry::factory()->count(50)->create();

        foreach ($journalEntries as $entry) {
            // Create 2-4 journal entry lines for each entry
            $lineCount = random_int(2, 4);
            $totalDebit = 0;
            $totalCredit = 0;

            for ($i = 0; $i < $lineCount; $i++) {
                $amount = fake()->randomFloat(2, 100, 5000);
                $isDebit = $i < ($lineCount / 2); // First half are debits

                JournalEntryLine::factory()->create([
                    'journal_entry_id' => $entry->id,
                    'account_id' => $accounts->random()->id,
                    'debit_amount' => $isDebit ? $amount : 0,
                    'credit_amount' => !$isDebit ? $amount : 0,
                ]);

                if ($isDebit) {
                    $totalDebit += $amount;
                } else {
                    $totalCredit += $amount;
                }
            }

            // Balance the entry by adjusting the last credit
            if ($totalDebit > $totalCredit) {
                $lastLine = JournalEntryLine::where('journal_entry_id', $entry->id)
                    ->where('credit_amount', '>', 0)
                    ->latest()
                    ->first();
                if ($lastLine) {
                    $difference = $totalDebit - $totalCredit;
                    $lastLine->update(['credit_amount' => $lastLine->credit_amount + $difference]);
                    $totalCredit += $difference;
                }
            }

            $entry->update([
                'total_debit' => $totalDebit,
                'total_credit' => $totalCredit,
            ]);
        }
    }

    /**
     * Create basic chart of accounts.
     */
    protected function createChartOfAccounts(): void
    {
        $accounts = [
            // Assets
            ['code' => '1000', 'name' => 'Cash', 'type' => 'asset', 'sub_type' => 'current_asset', 'normal_balance' => 'debit'],
            ['code' => '1100', 'name' => 'Accounts Receivable', 'type' => 'asset', 'sub_type' => 'current_asset', 'normal_balance' => 'debit'],
            ['code' => '1200', 'name' => 'Inventory - Raw Materials', 'type' => 'asset', 'sub_type' => 'current_asset', 'normal_balance' => 'debit'],
            ['code' => '1210', 'name' => 'Inventory - Work in Progress', 'type' => 'asset', 'sub_type' => 'current_asset', 'normal_balance' => 'debit'],
            ['code' => '1220', 'name' => 'Inventory - Finished Goods', 'type' => 'asset', 'sub_type' => 'current_asset', 'normal_balance' => 'debit'],
            ['code' => '1500', 'name' => 'Equipment', 'type' => 'asset', 'sub_type' => 'fixed_asset', 'normal_balance' => 'debit'],
            ['code' => '1600', 'name' => 'Building', 'type' => 'asset', 'sub_type' => 'fixed_asset', 'normal_balance' => 'debit'],

            // Liabilities
            ['code' => '2000', 'name' => 'Accounts Payable', 'type' => 'liability', 'sub_type' => 'current_liability', 'normal_balance' => 'credit'],
            ['code' => '2100', 'name' => 'Accrued Expenses', 'type' => 'liability', 'sub_type' => 'current_liability', 'normal_balance' => 'credit'],
            ['code' => '2500', 'name' => 'Long-term Debt', 'type' => 'liability', 'sub_type' => 'long_term_liability', 'normal_balance' => 'credit'],

            // Equity
            ['code' => '3000', 'name' => 'Owner\'s Equity', 'type' => 'equity', 'sub_type' => 'equity', 'normal_balance' => 'credit'],
            ['code' => '3100', 'name' => 'Retained Earnings', 'type' => 'equity', 'sub_type' => 'equity', 'normal_balance' => 'credit'],

            // Revenue
            ['code' => '4000', 'name' => 'Sales Revenue', 'type' => 'revenue', 'sub_type' => 'operating_revenue', 'normal_balance' => 'credit'],
            ['code' => '4100', 'name' => 'Service Revenue', 'type' => 'revenue', 'sub_type' => 'operating_revenue', 'normal_balance' => 'credit'],

            // Expenses
            ['code' => '5000', 'name' => 'Cost of Goods Sold', 'type' => 'expense', 'sub_type' => 'operating_expense', 'normal_balance' => 'debit'],
            ['code' => '6000', 'name' => 'Salaries Expense', 'type' => 'expense', 'sub_type' => 'operating_expense', 'normal_balance' => 'debit'],
            ['code' => '6100', 'name' => 'Rent Expense', 'type' => 'expense', 'sub_type' => 'operating_expense', 'normal_balance' => 'debit'],
            ['code' => '6200', 'name' => 'Utilities Expense', 'type' => 'expense', 'sub_type' => 'operating_expense', 'normal_balance' => 'debit'],
            ['code' => '6300', 'name' => 'Depreciation Expense', 'type' => 'expense', 'sub_type' => 'operating_expense', 'normal_balance' => 'debit'],
        ];

        foreach ($accounts as $accountData) {
            ChartOfAccounts::create(array_merge($accountData, [
                'description' => 'Standard ' . $accountData['name'] . ' account',
                'balance' => fake()->randomFloat(2, 0, 50000),
                'is_active' => true,
            ]));
        }
    }
}