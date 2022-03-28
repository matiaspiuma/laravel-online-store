<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
final class AddressFactory extends Factory
{
    /** @var string */
    protected $model = {{ $model }}::class;

    public function definition(): array
    {
        return [
            //
        ];
    }
}
