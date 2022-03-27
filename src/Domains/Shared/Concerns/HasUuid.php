<?php

declare(strict_types=1);

namespace Domains\Shared\Concerns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait HasUuid
{
    public static function bootHasUuid(): void
    {
        static::creating(fn (Model $model) => $model->uuid = (string) Str::uuid());
    }
}
