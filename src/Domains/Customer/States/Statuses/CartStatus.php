<?php

declare(strict_types=1);

namespace Domains\Customer\States\Statuses;

enum CartStatus: string
{
    case Pending = 'pending';
    case CheckoutOut = 'checkout-out';
    case Completed = 'completed';
    case Abandoned = 'abandoned';
}
