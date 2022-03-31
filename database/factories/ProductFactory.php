<?php

declare(strict_types=1);

namespace Database\Factories;

use Domains\Catalog\Models\Category;
use Domains\Catalog\Models\Product;
use Domains\Catalog\Models\Range;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
final class ProductFactory extends Factory
{
    /** @var string */
    protected $model = Product::class;

    public function definition(): array
    {
        $cost = $this->faker->numberBetween(100, 10000);

        return [
            'name' => $this->faker->words(4, true),
            'description' => $this->faker->paragraphs(3, true),
            'cost' => $cost,
            'retail' => ($cost / config('shop.profit_margin')),
            'is_active' => $this->faker->boolean(),
            'vat' => config('shop.vat'),
            'category_id' => Category::factory()->create(),
            'range_id' => $this->faker->boolean() ? Range::factory()->create() : null,
        ];
    }
}
