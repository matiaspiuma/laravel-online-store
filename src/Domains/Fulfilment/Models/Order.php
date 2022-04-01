<?php

declare(strict_types=1);

namespace Domains\Fulfilment\Models;

use Database\Factories\OrderFactory;
use Domains\Customer\Models\Address;
use Domains\Customer\Models\User;
use Domains\Fulfilment\States\OrderState;
use Domains\Shared\Models\Concerns\HasUuid;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

final class Order extends Model
{
    use HasFactory;
    use HasUuid;
    use SoftDeletes;

    /** @var array */
    protected $fillable = [
        'number',
        'state',
        'cupon',
        'user_id',
        'shipping_address_id',
        'billing_address_id',
        'processed_at',
        'completed_at',
        'cancelled_at',
        'refunded_at',
    ];

    /** @var array */
    protected $casts = [
        'processed_at' => 'datetime',
        'completed_at' => 'datetime',
        'cancelled_at' => 'datetime',
        'refunded_at' => 'datetime',
        'state' => OrderState::class,
    ];

    /** @var array */
    protected $dates = [
        'processed_at',
        'completed_at',
        'cancelled_at',
        'refunded_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'user_id'
        );
    }

    public function shippingAddress(): BelongsTo
    {
        return $this->belongsTo(
            Address::class,
            'shipping_address_id'
        );
    }

    public function billingAddress(): BelongsTo
    {
        return $this->belongsTo(
            Address::class,
            'billing_address_id'
        );
    }

    public function lines(): HasMany
    {
        return $this->hasMany(
            OrderLine::class,
            'order_id'
        );
    }

    protected static function newFactory(): Factory
    {
        return OrderFactory::new();
    }
}
