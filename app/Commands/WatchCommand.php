<?php

namespace App\Commands;

use App\Services\GitHub\GitHub;
use LaravelZero\Framework\Commands\Command;
use function Termwind\render;

class WatchCommand extends Command
{
    protected $signature = 'watch';

    protected $description = 'Watch the GitHub actions of a repo';

    public function handle(GitHub $gitHub)
    {
        $runs = $gitHub->getLatestWorkflowRuns('spatie/ray');

        render(view('runs', compact('runs')));
    }

}
