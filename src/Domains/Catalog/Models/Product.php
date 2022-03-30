<?php

declare(strict_types=1);

namespace Domains\Catalog\Models;

use Database\Factories\ProductFactory;
use Domains\Shared\Models\Concerns\HasUuid;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use ProductBuilder;

final class Product extends Model
{
    use HasFactory;
    use HasUuid;
    use SoftDeletes;

    /** @var array */
    protected $fillable = [
        'name',
        'description',
        'cost',
        'retail',
        'is_active',
        'vat',
    ];

    /** @var array */
    protected $casts = [
        'is_active' => 'boolean',
        'vat' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(
            Category::class,
            'category_id',
        );
    }

    public function range(): BelongsTo
    {
        return $this->belongsTo(
            Range::class,
            'range_id',
        );
    }

    public function newEloquentBuilder($query): Builder
    {
        return new ProductBuilder($query);
    }

    protected static function newFactory(): Factory
    {
        return ProductFactory::new();
    }
}
