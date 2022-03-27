<?php

declare(strict_types=1);

namespace Database\Factories;

use Domains\Customer\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use JustSteveKing\LaravelPostcodes\Service\PostcodeService;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Location>
 */
final class LocationFactory extends Factory
{
    protected $model = Location::class;

    public function definition(): array
    {
        /** @var PostcodeService  */
        $service = resolve(PostcodeService::class);

        $location = $service->getRandomPostcode();

        $street = $this->faker->streetAddress();

        return [
            'house' => Str::of($street)->before(' '),
            'street' => Str::of($street)->after(' '),
            'parish' => data_get($location, 'parish'),
            'ward' => data_get($location, 'admin_ward'),
            'district' => data_get($location, 'admin_district'),
            'county' => data_get($location, 'admin_county'),
            'postcode' => data_get($location, 'postcode'),
            'country' => data_get($location, 'country'),
        ];
    }
}
