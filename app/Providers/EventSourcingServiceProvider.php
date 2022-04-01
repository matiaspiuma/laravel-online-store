<?php

declare(strict_types=1);

namespace App\Providers;

use Domains\Customers\Projectors\CartProjector;
use Illuminate\Support\ServiceProvider;
use Spatie\EventSourcing\Facades\Projectionist;

final class EventSourcingServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        Projectionist::addProjector([
            CartProjector::class
        ]);
    }

    public function boot(): void
    {
        //
    }
}
