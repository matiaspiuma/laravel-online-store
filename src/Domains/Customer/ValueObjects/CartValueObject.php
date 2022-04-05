<?php

declare(strict_types=1);

namespace Domains\Customer\ValueObjects;

/**
 * @template TValue
 */
class CartValueObject
{
    /**
     * @params string $status
     * @params int $userId
     */
    public function __construct(
        public string $status,
        public null|int $userId
    ) {}

    /**
     * @return array<string, TValue>
     */
    public function toArray(): array
    {
        return [
            'status' => $this->status,
            'user_id' => $this->userId,
        ];
    }
}