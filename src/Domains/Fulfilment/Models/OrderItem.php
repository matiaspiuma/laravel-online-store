<?php

declare(strict_types=1);

namespace Domains\Fulfilment\Models;

use Database\Factories\OrderItemFactory;
use Domains\Shared\Models\Concerns\HasUuid;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

final class OrderItem extends Model
{
    use HasFactory;
    use HasUuid;
    use SoftDeletes;

    /** @var array */
    protected $fillable = [
        //
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(
            Order::class,
            'order_id'
        );
    }

    protected static function newFactory(): Factory
    {
        return OrderItemFactory::new();
    }
}
