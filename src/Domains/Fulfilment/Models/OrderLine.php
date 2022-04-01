<?php

declare(strict_types=1);

namespace Domains\Fulfilment\Models;

use Database\Factories\OrderLineFactory;
use Domains\Shared\Models\Concerns\HasUuid;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

final class OrderLine extends Model
{
    use HasFactory;
    use HasUuid;
    use SoftDeletes;

    /** @var array */
    protected $fillable = [
        'title',
        'description',
        'cost',
        'retail', 
        'quantiy',
    ];

    /** @var array */
    protected $casts = [
        'cost' => 'integer',
        'retail' => 'integer',
        'quantity' => 'integer',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(
            Order::class,
            'order_id'
        );
    }

    public function purchasable(): MorphTo
    {
        return $this->morphTo();
    }

    protected static function newFactory(): Factory
    {
        return OrderLineFactory::new();
    }
}
