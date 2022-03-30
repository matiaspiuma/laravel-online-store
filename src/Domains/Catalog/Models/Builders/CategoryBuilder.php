<?php

declare(strict_types=1);

use Domains\Shared\Models\Builders\HasActiveScope;
use Illuminate\Database\Eloquent\Builder;

final class CategoryBuilder extends Builder
{
    use HasActiveScope;
}