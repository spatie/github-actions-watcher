<?php

namespace App\Support\GitHub\Entities;

use App\Support\GitHub\Enums\RunConclusion;
use App\Support\GitHub\Enums\RunStatus;
use Illuminate\Support\Arr;

/**
 * @property-read $name
 * @property-read $html_url
 * @property-read $status
 * @property-read $conclusion
 */
class WorkflowRun
{
    public function __construct(public array $properties)
    {

    }

    public function __get(string $propertyName): mixed
    {
        return Arr::get($this->properties, $propertyName);
    }

    public function status(): RunStatus
    {
        return RunStatus::from($this->status);
    }

    public function conclusion(): RunConclusion
    {
        return RunConclusion::from($this->conclusion);

    }
}
