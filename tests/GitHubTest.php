<?php

use App\Support\GitHub\GitHub;

it('can get all workflows', function () {
    app(GitHub::class)->getLatestWorkflowRuns('spatie/ray');
});
