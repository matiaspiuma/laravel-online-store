<?php

declare(strict_types=1);

namespace Domains\Customer\Aggregates;

use Domains\Customer\Events\DecreaseCartQuantity;
use Domains\Customer\Events\IncreaseCartQuantity;
use Domains\Customer\Events\PurchasableWasAddedToCart;
use Domains\Customer\Events\PurchasableWasRemovedFromCart;
use Spatie\EventSourcing\AggregateRoots\AggregateRoot;

final class CartAggregate extends AggregateRoot
{
    public function addPurchasable(int $purchasableId, string $purchasableType, int $cartId): self
    {
        $this->recordThat(
            domainEvent: new PurchasableWasAddedToCart(
                purchasableId: $purchasableId,
                purchasableType: $purchasableType,
                cartId: $cartId,
            )
        );

        return $this;
    }

    public function removePurchasable(int $purchasableId, string $purchasableType, int $cartId): self
    {
        $this->recordThat(
            domainEvent: new PurchasableWasRemovedFromCart(
                purchasableId: $purchasableId,
                purchasableType: $purchasableType,
                cartId: $cartId,
            )
        )->persist();

        return $this;
    }

    public function increateQuantity(int $cartId, int $cartItemId, int $quantity): self
    {
        $this->recordThat(
            domainEvent: new IncreaseCartQuantity(
                cartId: $cartId,
                cartItemId: $cartItemId,
                quantity: $quantity,
            )
        );

        return $this;
    }

    public function decreateQuantity(int $cartId, int $cartItemId, int $quantity): self
    {
        $this->recordThat(
            domainEvent: new DecreaseCartQuantity(
                cartId: $cartId,
                cartItemId: $cartItemId,
                quantity: $quantity,
            )
        );

        return $this;
    }
}
