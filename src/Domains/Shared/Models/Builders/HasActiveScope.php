<?php

declare(strict_types=1);

namespace Domains\Shared\Models\Builders;

trait HasActiveScope
{
    public function active(): self
    {
        return $this->where('is_active', true);
    }

    public function inactive(): self
    {
        return $this->where('is_active', false);
    }
}