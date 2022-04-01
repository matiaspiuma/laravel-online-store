<?php

declare(strict_types=1);

namespace Database\Factories;

use Domains\Customer\Models\Coupon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Coupon>
 */
final class CouponFactory extends Factory
{
    /** @var string */
    protected $model = Coupon::class;

    public function definition(): array
    {
        $max = $this->faker->numberBetween(0, 1000);

        return [
            'code' => $this->faker->unique()->bothify('COUP-???-????'),
            'reduction' => $this->faker->numberBetween(0, 1000),
            'uses' => $this->faker->numberBetween(0, $max),
            'max_uses' => $max,
            'is_active' => $this->faker->boolean(),
        ];
    }
}
