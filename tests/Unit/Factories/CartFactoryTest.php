<?php

declare(strict_types=1);

use Domains\Customer\Factories\CartFactory;
use Domains\Customer\ValueObjects\CartValueObject;

it(
    description: 'can create a cart value object',
    closure: function () {
        expect(
            value: CartFactory::make(
                attributes: [
                    'status' => 'pending',
                    'user_id' => 1,
                ]
            )
        )->toBeInstanceOf(
            class: CartValueObject::class
        )->status->toBe('pending')->userId->toBe(1);
    }
);
