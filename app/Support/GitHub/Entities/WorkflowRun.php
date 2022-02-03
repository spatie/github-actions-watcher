<?php

namespace App\Support\GitHub\Entities;

use App\Support\GitHub\Enums\RunConclusion;
use App\Support\GitHub\Enums\RunStatus;
use Illuminate\Support\Arr;

/**
 * @property-read string $name
 * @property-read string $html_url
 * @property-read string $status
 * @property-read string $conclusion
 */
class WorkflowRun
{
    /**
     * @param array<int, string> $properties
     */
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

    public function getListStatus(): RunStatus|RunConclusion
    {
        return $this->status()->getValue() === RunStatus::Completed
            ? $this->conclusion()
            : $this->status();
    }

    public function didComplete(): bool
    {
        return $this->status()->getValue() === RunStatus::Completed;
    }

    public function didNotComplete(): bool
    {
        return ! $this->didComplete();
    }
}
