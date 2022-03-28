<?php

declare(strict_types=1);

namespace Database\Factories;

use Domains\Customer\Models\Address;
use Domains\Customer\Models\Location;
use Domains\Customer\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
final class AddressFactory extends Factory
{
    /** @var string */
    protected $model = Address::class;

    public function definition(): array
    {
        return [
            'label' => Arr::random(['Home', 'Work', 'Mums House']),
            'billing' => $this->faker->boolean(),
            'user_id' => User::factory()->create(),
            'location_id' => Location::factory()->create(),
        ];
    }

    public function billing(): Factory
    {
        return $this->state(fn (array $attributes)  => ['billing' => true]);
    }

    public function shipping(): Factory
    {
        return $this->state(fn (array $attributes)  => ['billing' => false]);
    }
}
