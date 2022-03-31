<?php

declare(strict_types=1);

namespace Domains\Catalog\Models;

use Database\Factories\VariantFactory;
use Domains\Catalog\Models\Builders\VariantBuilder;
use Domains\Customer\Models\CartItem;
use Domains\Shared\Models\Concerns\HasUuid;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

final class Variant extends Model
{
    use HasFactory;
    use HasUuid;
    use SoftDeletes;

    /** @var array */
    protected $fillable = [
        'name',
        'cost',
        'retail',
        'height',
        'width',
        'length',
        'weight',
        'is_active',
        'shippable',
    ];

    /** @var array */
    protected $casts = [
        'is_active' => 'boolean',
        'shippable' => 'boolean',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(
            Product::class,
            'product_id',
        );
    }

    public function purchasables(): MorphMany
    {
        return $this->morphMany(
            CartItem::class,
            'purchasable',
        );
    }

    public function newEloquentBuilder($query): Builder
    {
        return new VariantBuilder($query);
    }

    protected static function newFactory(): Factory
    {
        return VariantFactory::new();
    }
}
