<?php

declare(strict_types=1);

namespace Domains\Customer\Factories;

use Domains\Customer\ValueObjects\CartItemValueObject;

final class CartItemFactory
{
    public static function make(array $attributes): CartItemValueObject
    {
        return new CartItemValueObject(
            purchasableId: $attributes['purchasable_id'],
            purchasableType: $attributes['purchasable_type'],
            quantity: $attributes['quantity'],
        );
    }
}