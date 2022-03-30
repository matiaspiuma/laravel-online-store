<?php

declare(strict_types=1);

namespace Database\Seeders;

use Domains\Catalog\Models\Variant;
use Domains\Customer\Models\Address;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Address::factory()
            ->count(5)
            ->create();

        Variant::factory(100)->create();
    }
}
