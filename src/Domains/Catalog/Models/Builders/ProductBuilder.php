<?php

declare(strict_types=1);

use Domains\Shared\Models\Builders\HasActiveScope;
use Illuminate\Database\Eloquent\Builder;

final class ProductBuilder extends Builder
{
    use HasActiveScope;
}