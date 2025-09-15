<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ChartOfAccounts;
use App\Models\JournalEntry;
use Inertia\Inertia;

class FinanceController extends Controller
{
    /**
     * Display the finance dashboard.
     */
    public function index()
    {
        $chartOfAccounts = ChartOfAccounts::active()
            ->orderBy('code')
            ->get()
            ->groupBy('type');

        $recentJournalEntries = JournalEntry::with(['lines.account'])
            ->latest()
            ->take(10)
            ->get();

        $metrics = [
            'total_accounts' => ChartOfAccounts::active()->count(),
            'total_assets' => ChartOfAccounts::where('type', 'asset')->active()->sum('balance'),
            'total_liabilities' => ChartOfAccounts::where('type', 'liability')->active()->sum('balance'),
            'total_equity' => ChartOfAccounts::where('type', 'equity')->active()->sum('balance'),
            'journal_entries_count' => JournalEntry::count(),
            'posted_entries' => JournalEntry::where('status', 'posted')->count(),
        ];

        return Inertia::render('finance/index', [
            'chartOfAccounts' => $chartOfAccounts,
            'recentJournalEntries' => $recentJournalEntries,
            'metrics' => $metrics,
        ]);
    }
}