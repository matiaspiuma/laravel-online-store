<?php

declare(strict_types=1);

namespace Domains\Catalog\Models;

use CategoryBuilder;
use Database\Factories\CategoryFactory;
use Domains\Shared\Models\Concerns\HasUuid;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

final class Category extends Model
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
            'category_id',
        );
    }

    public function newEloquentBuilder($query): Builder
    {
        return new CategoryBuilder($query);
    }

    protected static function newFactory(): Factory
    {
        return CategoryFactory::new();
    }
}
