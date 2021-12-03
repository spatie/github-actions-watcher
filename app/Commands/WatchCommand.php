<?php

namespace App\Commands;

use App\Support\GitHub\Entities\WorkflowRun;
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
        $vendorAndRepo = $this->getVendorAndRepo();

        $branch = $this->getBranch();

        do {
            $hasRunningWorkflows = $this->displayWorkflows($this->gitHub, $vendorAndRepo, $branch);
        } while ($this->shouldContinueWatching($hasRunningWorkflows));

        return static::SUCCESS;
    }

    protected function getVendorAndRepo(): string
    {
        if ($vendorAndRepo = $this->option('repo')) {
            return $vendorAndRepo;
        }

        $localGitRepo = new LocalGitRepo(base_path());

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
            return $branch;
        }

        $localGitRepo = new LocalGitRepo(base_path());

        try {
            $vendorAndRepo = $localGitRepo->getCurrentBranch();
        } catch (Exception $exception) {
            $this->showError($exception->getMessage());

            exit(static::FAILURE);
        }

        return $vendorAndRepo;
    }

    protected function displayWorkflows(GitHub $gitHub, string $vendorAndRepo, string $branch): bool
    {
        $runs = $gitHub->getLatestWorkflowRuns($vendorAndRepo, $branch);

        $this->clearScreen();

        $view = view('runs', compact('runs', 'vendorAndRepo', 'branch'));
        render($view);

        $hasRunningWorkflows = $runs->contains(fn(WorkflowRun $workflowRun) => $workflowRun->didNotComplete());

        return ! $hasRunningWorkflows;
    }

    private function shouldContinueWatching(bool $hasRunningWorkflows): bool
    {
        if (! $hasRunningWorkflows) {
            return false;
        }

        if ($this->option('single-pass')) {
            return false;
        }

        sleep(5);

        return true;
    }


}
