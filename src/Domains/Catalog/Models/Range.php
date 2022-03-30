<?php

declare(strict_types=1);

namespace Domains\Catalog\Models;

use Database\Factories\RangeFactory;
use Domains\Shared\Models\Concerns\HasUuid;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use ProductBuilder;

final class Range extends Model
{
    use HasFactory;
    use HasUuid;
    use SoftDeletes;

    /** @var array */
    protected $fillable = [
        'name',
        'description',
        'is_active',
    ];

    /** @var array */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(
            Product::class,
            'range_id',
        );
    }

    public function newEloquentBuilder($query): Builder
    {
        return new ProductBuilder($query);
    }

    protected static function newFactory(): Factory
    {
        return RangeFactory::new();
    }
}
