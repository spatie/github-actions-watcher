<?php

namespace App\Services\Entities;

use Illuminate\Support\Arr;

class WorkflowRun
{
    public function __construct(public array $properties)
    {

    }

    public function __get(string $propertyName): mixed
    {
        return Arr::get($this->properties, $propertyName);
    }
}
