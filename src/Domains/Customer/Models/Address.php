<?php

declare(strict_types=1);

namespace Domains\Customer\Models;

use Database\Factories\AddressFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class Address extends Model
{
    use HasFactory;

    /** @var array */
    protected $fillable = [
        'label',
        'billing',
    ];

    /** @var array */
    protected $casts = [
        'billing' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'user_id'
        );
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(
            Location::class,
            'location_id'
        );
    }

    protected static function newFactory(): Factory
    {
        return AddressFactory::new();
    }
}
