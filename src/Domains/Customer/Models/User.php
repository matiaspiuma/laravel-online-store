<?php

declare(strict_types=1);

namespace Domains\Customer\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Domains\Shared\Models\Concerns\HasUuid;
use Illuminate\Database\Eloquent\Relations\HasOne;

final class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasUuid;
    use Notifiable;
    use SoftDeletes;

    /** @var array */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
    ];

    /** @var array*/
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function addresses(): HasMany
    {
        return $this->hasMany(
            Address::class,
            'user_id'
        );
    }

    public function cart(): HasOne
    {
        return $this->hasOne(
            Cart::class,
            'user_id'
        );
    }

    public function defaultBillingAddress(): BelongsTo
    {
        return $this->belongsTo(
            Address::class,
            'billing_address_id'
        );
    }

    public function defaultShippinggAddress(): BelongsTo
    {
        return $this->belongsTo(
            Address::class,
            'shipping_address_id'
        );
    }

    protected static function newFactory(): Factory
    {
        return UserFactory::new();
    }
}
