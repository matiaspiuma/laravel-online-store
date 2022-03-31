<?php

declare(strict_types=1);

namespace Database\Factories;

use Domains\Customer\Models\CartItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CartItem>
 */
final class CartItemFactory extends Factory
{
    /** @var string */
    protected $model = CartItem::class;

    public function definition(): array
    {
        return [
            //
        ];
    }
}
