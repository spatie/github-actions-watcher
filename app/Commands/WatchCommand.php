<?php

namespace App\Commands;

use App\Support\GitHub\Entities\WorkflowRunCollection;
use App\Support\GitHub\GitHub;
use App\Support\LocalGitRepo;
use Exception;

use function Termwind\render;

class WatchCommand extends Command
{
    protected $signature = 'watch {--R|repo=} {--B|branch=} {--single-pass}';

    protected $description = 'Watch the GitHub actions of a repo';

    public function handle(): int
    {
        $this
            ->clearScreen()
            ->showHeader();

        render('<div class="mt-2 mx-4">Fetching GitHub workflow runs...</div>');

        $vendorAndRepo = $this->getVendorAndRepo();

        $branch = $this->getBranch();

        do {
            $workflowRuns = $this->displayWorkflows($this->gitHub, $vendorAndRepo, $branch);
        } while ($this->shouldContinueWatching($workflowRuns));

        if (! $workflowRuns->allCompletedSuccessfully()) {
            $this->showError('Some workflows failed...');

            return static::FAILURE;
        }

        $this->showSuccess('All workflows finished successfully.');

        return static::SUCCESS;
    }

    protected function getVendorAndRepo(): string
    {
        if ($vendorAndRepo = $this->option('repo')) {
            return (string)$vendorAndRepo;
        }

        $localGitRepo = new LocalGitRepo($this->getCurrentDirectory());

        try {
            $vendorAndRepo = $localGitRepo->getVendorAndRepo();
        } catch (Exception $exception) {
            $this->showError($exception->getMessage());

            exit(static::FAILURE);
        }

        return $vendorAndRepo;
    }

    protected function getBranch(): string
    {
        if ($branch = $this->option('branch')) {
            return (string)$branch;
        }

        $localGitRepo = new LocalGitRepo($this->getCurrentDirectory());

        try {
            $vendorAndRepo = $localGitRepo->getCurrentBranch();
        } catch (Exception $exception) {
            $this->showError($exception->getMessage());

            exit(static::FAILURE);
        }

        return $vendorAndRepo;
    }

    protected function displayWorkflows(GitHub $gitHub, string $vendorAndRepo, string $branch): WorkflowRunCollection
    {
        $runs = $gitHub->getLatestWorkflowRuns($vendorAndRepo, $branch);

        $this
            ->clearScreen()
            ->showHeader();

        $view = view('runs', [
            'runs' => $runs,
            'vendorAndRepo' => $vendorAndRepo,
            'branch' => $branch,
        ]);

        render($view);

        return $runs;
    }

    private function shouldContinueWatching(WorkflowRunCollection $workflowRuns): bool
    {
        if (! $workflowRuns->containsActiveRuns()) {
            return false;
        }

        if ($this->option('single-pass')) {
            return false;
        }

        sleep(8);

        return true;
    }

    protected function getCurrentDirectory(): string
    {
        return (string)getcwd();
    }
}
