<?php

declare(strict_types=1);

namespace Domains\Customer\Events;

use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

abstract class PurchasableCartEvent extends ShouldBeStored
{
    public function __construct(
        public int $purchasableId,
        public string $purchasableType,
        public int $cartId,
    ) {
    }
}
