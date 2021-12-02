<?php

namespace App\Commands;

use App\Support\GitHub\GitHub;
use App\Support\LocalGitRepo;
use LaravelZero\Framework\Commands\Command;
use League\Flysystem\Adapter\Local;
use function Termwind\render;

class WatchCommand extends Command
{
    protected $signature = 'watch';

    protected $description = 'Watch the GitHub actions of a repo';

    public function handle(GitHub $gitHub)
    {
        $localGitRepo = new LocalGitRepo(base_path());

        $vendorAndRepo = $localGitRepo->getVendorAndRepo();

        $runs = $gitHub->getLatestWorkflowRuns($vendorAndRepo);

        render(view('runs', compact('runs')));
    }

}
