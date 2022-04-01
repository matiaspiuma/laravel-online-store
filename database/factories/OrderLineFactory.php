<?php

declare(strict_types=1);

namespace Database\Factories;

use Domains\Catalog\Models\Variant;
use Domains\Fulfilment\Models\Order;
use Domains\Fulfilment\Models\OrderLine;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderLine>
 */
final class OrderLineFactory extends Factory
{
    /** @var string */
    protected $model = OrderLine::class;

    public function definition(): array
    {
        $variant = Variant::factory()->create();

        return [
            'title' => $variant->title,
            'description' => $variant->product->description,
            'cost' => $variant->cost,
            'retail' => $variant->retail,
            'quantity' => $this->faker->numberBetween(1, 10),
            'purchasable_id' => $variant->id,
            'purchasable_type' => 'variant',
            'order_id' => Order::factory()->create(),
        ];
    }
}
