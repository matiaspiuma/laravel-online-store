<?php

declare(strict_types=1);

namespace Database\Factories;

use Domains\Customer\Models\Cart;
use Domains\Customer\Models\User;
use Domains\Customer\States\Statuses\CartStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cart>
 */
final class CartFactory extends Factory
{
    /** @var string */
    protected $model = Cart::class;

    public function definition(): array
    {
        $useCoupon = $this->faker->boolean();

        return [
            'status' => $this->faker->randomElement(CartStatus::cases()),
            'total' => $this->faker->numberBetween(0, 100),
            'coupon' => $useCoupon
                ? $this->faker->imei()
                : null,
            'reduction' => $useCoupon
                ? $this->faker->numberBetween(0, 100)
                : null,
            'user_id' => User::factory()->create(),
        ];
    }
}
