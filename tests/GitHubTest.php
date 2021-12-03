<?php

use App\Support\GitHub\Entities\WorkflowRun;
use App\Support\GitHub\GitHub;

it('can get all workflows', function () {
    dd(app(GitHub::class)->getAuthorizedUser('gho_uIYm2eCp41WCiHXX9Vztyjou0w6wQJ1be3q'));

    $workflowRuns = app(GitHub::class)->getLatestWorkflowRuns('spatie/github-actions-watcher');

    expect(count($workflowRuns))->toBeGreaterThan(0);
    expect($workflowRuns)->each->toBeInstanceOf(WorkflowRun::class);
});
