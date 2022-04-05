<?php

declare(strict_types=1);

namespace Domains\Customer\Actions;

use Domains\Customer\Models\Cart;
use Domains\Customer\ValueObjects\CartValueObject;
use Illuminate\Database\Eloquent\Model;

final class CreateCartAction
{
    public static function handle(CartValueObject $cart): Model
    {
        return Cart::query()
            ->create(
                $cart->toArray()
            );
    }
}
