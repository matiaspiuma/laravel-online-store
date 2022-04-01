<?php

declare(strict_types=1);

namespace Database\Factories;

use Domains\Catalog\Models\Product;
use Domains\Catalog\Models\Variant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Variant>
 */
final class VariantFactory extends Factory
{
    /** @var string */
    protected $model = Variant::class;

    public function definition(): array
    {
        $product = Product::factory()->create();
        $cost = $this->faker->boolean()
            ? $product->cost
            : ($product->cost + $this->faker->numberBetween(100, 7500));

        $shippable = $this->faker->boolean();

        return [
            'title' => $this->faker->words(3, true),
            'cost' => $cost,
            'retail' => ($product->cost === $cost)
                ? $product->retail
                : ($product->retail + $this->faker->numberBetween(100, 7500)),
            'height' => $shippable ? $this->faker->numberBetween(0, 1000) : null,
            'width' => $shippable ? $this->faker->numberBetween(0, 1000) : null,
            'length' => $shippable ? $this->faker->numberBetween(0, 1000) : null,
            'weight' => $shippable ? $this->faker->numberBetween(0, 1000) : null,
            'is_active' => $this->faker->boolean(),
            'shippable' => $shippable,
            'product_id' => $product,
        ];
    }
}
