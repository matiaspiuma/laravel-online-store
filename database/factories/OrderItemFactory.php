<?php

declare(strict_types=1);

namespace Database\Factories;

use Domains\Fulfilment\Models\OrderItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
final class OrderItemFactory extends Factory
{
    /** @var string */
    protected $model = OrderItem::class;

    public function definition(): array
    {
        return [
            //
        ];
    }
}
