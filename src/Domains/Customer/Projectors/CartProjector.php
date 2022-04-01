<?php

declare(strict_types=1);

namespace Domains\Customers\Projectors;

use Domains\Customer\Aggregates\CartAggregate;
use Domains\Customer\Events\DecreaseCartQuantity;
use Domains\Customer\Events\IncreaseCartQuantity;
use Domains\Customer\Events\PurchasableWasAddedToCart;
use Domains\Customer\Events\PurchasableWasRemovedFromCart;
use Domains\Customer\Models\Cart;
use Illuminate\Support\Str;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;

final class CartProjector extends Projector
{
    public function onPurchasableWasAddedToCart(PurchasableWasAddedToCart $event): void
    {
        $cart = Cart::query()
            ->findOrFail(
                id: $event->cartId
            );

        $cart->items()->create([
            'purchasable_id' => $event->purchasableId,
            'purchasable_type' => $event->purchasableType,
        ]);
    }

    public function onPurchasableWasRemovedFromCart(PurchasableWasRemovedFromCart $event): void
    {
        $cart = Cart::query()->findOrFail(
            id: $event->cartId
        );

        $cart->items()->where(
            column: 'purchasable_id',
            value: $event->purchasableId
        )->where(
            column: 'purchasable_type',
            value: $event->purchasableType,
        )->delete();
    }

    public function onIncreaseCartQuantity(IncreaseCartQuantity $event): void
    {
        $cart = Cart::query()->findOrFail(
            id: $event->cartId
        );

        $cart->items()->where(
            column: 'id',
            value: $event->cartItemId
        )->increment(
            column: 'quantity',
            value: $event->quantity
        );
    }

    public function onDecreaseCartQuantity(DecreaseCartQuantity $event): void
    {
        $cart = Cart::query()->findOrFail(
            id: $event->cartId
        );

        $cartItem = $cart->items()->where(
            column: 'id',
            value: $event->cartItemId
        )->first();

        if ($cartItem->quantity <= $event->quantity) {
            CartAggregate::retrieve(
                uuid: Str::uuid()->toString()
            )->removePurchasable(
                purchasableId: $cartItem->purchasable_id,
                purchasableType: $cartItem->purchasable_type,
                cartId: $event->cartId
            );

            return;
        }

        $cartItem->decrement(
            column: 'quantity',
            value: $event->quantity
        );
    }
}
