<?php

declare(strict_types=1);

use Domains\Catalog\Models\Variant;
use Domains\Customer\Aggregates\CartAggregate;
use Domains\Customer\Events\PurchasableWasAddedToCart;
use Domains\Customer\Models\Cart;

it('can store an event for adding a purchasable', function () {

    $purchasable = Variant::factory()->create();

    $cart = Cart::factory()->create();

    $event = new PurchasableWasAddedToCart(
        purchasableId: $purchasable->id,
        purchasableType: 'variant',
        cartId: $cart->id
    );

    CartAggregate::fake()
        ->given(
            events: [
                $event
            ]
        )
        ->when(
            callable: function (CartAggregate $cartAggregate) use ($purchasable, $cart): void {
                $cartAggregate->addPurchasable(
                    $purchasable->id,
                    'variant',
                    $cart->id
                );
            }
        )
        ->assertEventRecorded(
            expectedEvent: new PurchasableWasAddedToCart(
                purchasableId: $purchasable->id,
                purchasableType: 'variant',
                cartId: $cart->id
            )
        );
});
