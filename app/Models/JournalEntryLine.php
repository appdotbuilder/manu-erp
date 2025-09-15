<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\JournalEntryLine
 *
 * @property int $id
 * @property int $journal_entry_id
 * @property int $account_id
 * @property string|null $description
 * @property float $debit_amount
 * @property float $credit_amount
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\JournalEntry $journalEntry
 * @property-read \App\Models\ChartOfAccounts $account
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|JournalEntryLine newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|JournalEntryLine newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|JournalEntryLine query()
 * @method static \Illuminate\Database\Eloquent\Builder|JournalEntryLine whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JournalEntryLine whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JournalEntryLine whereCreditAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JournalEntryLine whereDebitAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JournalEntryLine whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JournalEntryLine whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JournalEntryLine whereJournalEntryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JournalEntryLine whereUpdatedAt($value)
 * @method static \Database\Factories\JournalEntryLineFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class JournalEntryLine extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'journal_entry_id',
        'account_id',
        'description',
        'debit_amount',
        'credit_amount',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'debit_amount' => 'decimal:2',
        'credit_amount' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the journal entry that owns this line.
     */
    public function journalEntry(): BelongsTo
    {
        return $this->belongsTo(JournalEntry::class);
    }

    /**
     * Get the account for this line.
     */
    public function account(): BelongsTo
    {
        return $this->belongsTo(ChartOfAccounts::class, 'account_id');
    }
}