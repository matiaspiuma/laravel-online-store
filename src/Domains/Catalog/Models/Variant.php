<?php

declare(strict_types=1);

namespace Domains\Catalog\Models;

use Database\Factories\VariantFactory;
use Domains\Catalog\Models\Builders\VariantBuilder;
use Domains\Shared\Models\Concerns\HasUuid;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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

    public function newEloquentBuilder($query): Builder
    {
        return new VariantBuilder($query);
    }

    protected static function newFactory(): Factory
    {
        return VariantFactory::new();
    }
}
