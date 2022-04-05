<?php

declare(strict_types=1);

namespace Domains\Customer\Actions;

use Domains\Customer\Models\Cart;
use Domains\Customer\Models\CartItem;
use Domains\Customer\ValueObjects\CartItemValueObject;

final class AddProductToCart
{
    public static function handle(CartItemValueObject $cartItem, Cart $cart): CartItem
    {
        return $cart->items()->create($cartItem->toArray());
    }
}