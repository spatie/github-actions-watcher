<?php

use App\Support\GitHub\Entities\WorkflowRun;
use App\Support\GitHub\GitHub;

it('can get all workflows', function () {
    dd(app(GitHub::class)->getAuthorizedUser('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'));

    $workflowRuns = app(GitHub::class)->getLatestWorkflowRuns('spatie/github-actions-watcher');

    expect(count($workflowRuns))->toBeGreaterThan(0);
    expect($workflowRuns)->each->toBeInstanceOf(WorkflowRun::class);
});
