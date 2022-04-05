<?php

declare(strict_types=1);

namespace Domains\Customer\Models;

use Database\Factories\CartFactory;
use Domains\Customer\Models\Concerns\CartBuilder;
use Domains\Customer\States\Statuses\CartStatus;
use Domains\Shared\Models\Concerns\HasUuid;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

final class Cart extends Model
{
    use HasFactory;
    use HasUuid;
    use Prunable;
    use SoftDeletes;

    /** @var array */
    protected $fillable = [
        'coupon',
        'status',
        'total',
        'reduction',
    ];

    /** @var array */
    protected $casts = [
        'status' => CartStatus::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'user_id',
        );
    }

    public function items(): HasMany
    {
        return $this->hasMany(
            CartItem::class,
            'cart_id',
        );
    }

    public function prunable(): Builder
    {
        return static::query()
            ->where('created_at', '<=', now()->subMonth());
    }

    public function newEloquentBuilder($query): Builder
    {
        return new CartBuilder($query);
    }

    protected static function newFactory(): Factory
    {
        return CartFactory::new();
    }
}
