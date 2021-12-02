<?php

namespace App\Support\GitHub;

use App\Support\GitHub\Entities\WorkflowRun;
use Illuminate\Support\Collection;

use Illuminate\Http\Client\PendingRequest;

class GitHub
{
    public function __construct(public PendingRequest $gitHub)
    {

    }

    /**
     * @param string $vendorAndRepo
     *
     * @return Collection<WorkflowRun>
     */
    public function getWorkflowRuns(string $vendorAndRepo): Collection
    {
        [$vendor, $repo] = explode('/', $vendorAndRepo);

        return $this->gitHub
            ->get("/api.github.com/repos/{$vendor}/{$repo}/actions/runs")
            ->map('workflow_runs', fn(array $workflowRunProperties) => new WorkflowRun($workflowRunProperties));
    }

    /**
     * @param string $vendorAndRepo
     *
     * @return Collection<WorkflowRun>
     */
    public function getLatestWorkflowRuns(string $vendorAndRepo): Collection
    {
        return $this
            ->getWorkflowRuns($vendorAndRepo)
            ->unique(fn(WorkflowRun $workflowRun) => $workflowRun->name);
    }
}
