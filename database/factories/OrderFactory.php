<?php

declare(strict_types=1);

namespace Database\Factories;

use Domains\Fulfilment\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
final class OrderFactory extends Factory
{
    /** @var string */
    protected $model = Order::class;

    public function definition(): array
    {
        return [
            //
        ];
    }
}
