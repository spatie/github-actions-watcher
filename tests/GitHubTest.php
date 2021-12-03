<?php

use App\Support\GitHub\Entities\WorkflowRun;
use App\Support\GitHub\GitHub;

it('can get all workflows', function () {
    $workflowRuns = app(GitHub::class)->getLatestWorkflowRuns('spatie/github-actions-watcher', 'main');

    expect(count($workflowRuns))->toBeGreaterThan(0);
    expect($workflowRuns)->each->toBeInstanceOf(WorkflowRun::class);
});
