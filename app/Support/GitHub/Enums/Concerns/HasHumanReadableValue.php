<?php

namespace App\Support\GitHub\Enums\Concerns;

use Illuminate\Support\Str;

trait HasHumanReadableValue
{
    public function humanReadableValue(): string
    {
        return Str::of($this->value)
            ->ucfirst()
            ->replace('_', ' ');
    }
}
