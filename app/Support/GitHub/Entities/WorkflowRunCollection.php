<?php

namespace App\Support\GitHub\Entities;

use App\Support\GitHub\Enums\RunConclusion;
use Illuminate\Support\Collection;

class WorkflowRunCollection extends Collection
{
    /** @param array<int, WorkflowRun> $items */
    public function __construct($items = [])
    {
        parent::__construct($items);
    }

    public function containsActiveRuns(): bool
    {
        return $this->contains(fn (WorkflowRun $workflowRun) => $workflowRun->didNotComplete());
    }

    public function allCompletedSuccessfully(): bool
    {
        if ($this->containsActiveRuns()) {
            return false;
        }

        return ! $this->contains(fn (WorkflowRun $workflowRun) => ! ($workflowRun->conclusion()->getValue() === RunConclusion::Success));
    }
}
