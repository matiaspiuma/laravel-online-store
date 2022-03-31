<?php

declare(strict_types=1);

namespace Domains\Fulfilment\States;

enum OrderState: string
{
    case Pending = 'pending';
    case Processed = 'processed';
    case Completed = 'completed';
    case Cancelled = 'cancelled';
    case Refunded = 'refunded';
}
