<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\ChartOfAccounts
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string|null $description
 * @property string $type
 * @property string|null $sub_type
 * @property float $balance
 * @property string $normal_balance
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\JournalEntryLine> $journalEntryLines
 * @property-read int|null $journal_entry_lines_count
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|ChartOfAccounts newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChartOfAccounts newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChartOfAccounts query()
 * @method static \Illuminate\Database\Eloquent\Builder|ChartOfAccounts whereBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChartOfAccounts whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChartOfAccounts whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChartOfAccounts whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChartOfAccounts whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChartOfAccounts whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChartOfAccounts whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChartOfAccounts whereNormalBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChartOfAccounts whereSubType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChartOfAccounts whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChartOfAccounts whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChartOfAccounts active()
 * @method static \Database\Factories\ChartOfAccountsFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class ChartOfAccounts extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'code',
        'name',
        'description',
        'type',
        'sub_type',
        'balance',
        'normal_balance',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'balance' => 'decimal:2',
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the journal entry lines for this account.
     */
    public function journalEntryLines(): HasMany
    {
        return $this->hasMany(JournalEntryLine::class, 'account_id');
    }

    /**
     * Scope a query to only include active accounts.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}