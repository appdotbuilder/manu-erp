<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\SalesOrder
 *
 * @property int $id
 * @property string $so_number
 * @property int $customer_id
 * @property string $order_date
 * @property string|null $delivery_date
 * @property float $subtotal
 * @property float $tax_amount
 * @property float $total_amount
 * @property string $status
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Customer $customer
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SalesOrderItem> $items
 * @property-read int|null $items_count
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|SalesOrder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SalesOrder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SalesOrder query()
 * @method static \Illuminate\Database\Eloquent\Builder|SalesOrder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesOrder whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesOrder whereDeliveryDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesOrder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesOrder whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesOrder whereOrderDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesOrder whereSoNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesOrder whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesOrder whereSubtotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesOrder whereTaxAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesOrder whereTotalAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesOrder whereUpdatedAt($value)
 * @method static \Database\Factories\SalesOrderFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class SalesOrder extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'so_number',
        'customer_id',
        'order_date',
        'delivery_date',
        'subtotal',
        'tax_amount',
        'total_amount',
        'status',
        'notes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'order_date' => 'date',
        'delivery_date' => 'date',
        'subtotal' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the customer that owns this sales order.
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the items for this sales order.
     */
    public function items(): HasMany
    {
        return $this->hasMany(SalesOrderItem::class);
    }
}