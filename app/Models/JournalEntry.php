<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\JournalEntry
 *
 * @property int $id
 * @property string $entry_number
 * @property string $date
 * @property string $description
 * @property string|null $reference
 * @property float $total_debit
 * @property float $total_credit
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\JournalEntryLine> $lines
 * @property-read int|null $lines_count
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|JournalEntry newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|JournalEntry newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|JournalEntry query()
 * @method static \Illuminate\Database\Eloquent\Builder|JournalEntry whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JournalEntry whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JournalEntry whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JournalEntry whereEntryNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JournalEntry whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JournalEntry whereReference($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JournalEntry whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JournalEntry whereTotalCredit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JournalEntry whereTotalDebit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JournalEntry whereUpdatedAt($value)
 * @method static \Database\Factories\JournalEntryFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class JournalEntry extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'entry_number',
        'date',
        'description',
        'reference',
        'total_debit',
        'total_credit',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date' => 'date',
        'total_debit' => 'decimal:2',
        'total_credit' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the lines for this journal entry.
     */
    public function lines(): HasMany
    {
        return $this->hasMany(JournalEntryLine::class);
    }
}