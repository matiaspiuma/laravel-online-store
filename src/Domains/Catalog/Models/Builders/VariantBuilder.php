<?php

declare(strict_types=1);

namespace Domains\Catalog\Models\Builders;

use Domains\Shared\Models\Builders\HasActiveScope;
use Illuminate\Database\Eloquent\Builder;

final class VariantBuilder extends Builder
{
    use HasActiveScope;

    public function physical(): self
    {
        return $this->where('shippable', true);
    }

    public function digital(): self
    {
        return $this->where('shippable', false);
    }

    public function downloadable(): self
    {
        return $this->digital();
    }
}