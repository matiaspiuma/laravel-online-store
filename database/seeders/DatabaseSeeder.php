<?php

declare(strict_types=1);

namespace Database\Seeders;

use Domains\Customer\Models\Address;
use Domains\Customer\Models\Cart;
use Domains\Fulfilment\Models\OrderLine;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Address::factory()->create();

        Cart::factory(30)->create();

        OrderLine::factory(30)->create();
    }
}
