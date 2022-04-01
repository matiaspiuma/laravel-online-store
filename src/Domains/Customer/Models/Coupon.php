<?php

declare(strict_types=1);

namespace Domains\Customer\Models;

use Database\Factories\CouponFactory;
use Domains\Shared\Models\Concerns\HasUuid;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

final class Coupon extends Model
{
    use HasFactory;
    use HasUuid;
    use SoftDeletes;

    /** @var array */
    protected $fillable = [
        'code',
        'reduction',
        'uses',
        'max_uses',
        'is_active',
    ];

    /** @var array */
    protected $casts = [
        'reduction' => 'integer',
        'is_active' => 'boolean',
    ];

    public function carts(): HasMany
    {
        return $this->hasMany(
            Cart::class,
            'code',
        );
    }

    protected static function newFactory(): Factory
    {
        return CouponFactory::new();
    }
}
