<?php

declare(strict_types=1);

namespace Database\Factories;

use Domains\Customer\Models\Address;
use Domains\Customer\Models\User;
use Domains\Fulfilment\Models\Order;
use Domains\Fulfilment\States\OrderState;
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
        $useCoupon = $this->faker->boolean();

        $state = $this->faker->randomElement(OrderState::cases());

        return [
            'number' => $this->faker->numerify('ORD-####-####-####'),
            'state' => $state,
            'coupon' => $useCoupon
                ? $this->faker->imei()
                : null,
            'total' => $this->faker->numberBetween(10000, 100000),
            'reduction' => $useCoupon
                ? $this->faker->numberBetween(250, 2500)
                : 0,
            'user_id' => User::factory()->create(),
            'shipping_address_id' => Address::factory()->create(),
            'billing_address_id' => Address::factory()->create(),
            'processed_at' => $state !== OrderState::Pending
                ? $this->faker->dateTimeBetween('-1 year', 'now')
                : null,
            'completed_at' => $state === OrderState::Completed || $state === OrderState::Cancelled || $state === OrderState::Refunded
                ? $this->faker->dateTimeBetween('-1 year', 'now')
                : null,
            'cancelled_at' => $state === OrderState::Cancelled || $state === OrderState::Refunded
                ? $this->faker->dateTimeBetween('-1 year', 'now')
                : null,
            'refunded_at' => $state === OrderState::Refunded
                ? $this->faker->dateTimeBetween('-1 year', 'now')
                : null,
        ];
    }
}
