<?php

namespace App\Commands;

use App\Support\GitHub\Entities\WorkflowRun;
use App\Support\GitHub\GitHub;
use App\Support\LocalGitRepo;
use Exception;
use LaravelZero\Framework\Commands\Command;
use function Termwind\render;

class WatchCommand extends Command
{
    protected $signature = 'watch';

    protected $description = 'Watch the GitHub actions of a repo';

    public function handle(GitHub $gitHub): int
    {
        $vendorAndRepo = $this->getVendorAndRepo();

        do {
            $hasRunningWorkflows = $this->displayWorkflows($gitHub, $vendorAndRepo);

            if ($hasRunningWorkflows) {
                sleep(2);
            }
        } while ($hasRunningWorkflows);

        return static::SUCCESS;
    }

    protected function getVendorAndRepo(): string
    {
        $localGitRepo = new LocalGitRepo(base_path());

        try {
            $vendorAndRepo = $localGitRepo->getVendorAndRepo();
        } catch (Exception $exception) {
            $this->renderError($exception->getMessage());

            exit(static::FAILURE);
        }

        return $vendorAndRepo;
    }

    protected function displayWorkflows(GitHub $gitHub, string $vendorAndRepo): bool
    {
        $runs = $gitHub->getLatestWorkflowRuns($vendorAndRepo);

        $this
            ->clearScreen()
            ->renderTitle();

        render(view('runs', compact('runs')));

        $hasRunningWorkflows = $runs->contains(fn(WorkflowRun $workflowRun) => $workflowRun->didNotComplete());

        return ! $hasRunningWorkflows;
    }

    public function clearScreen(): self
    {
        $this->output->write(sprintf("\033\143"));

        return $this;
    }

    protected function renderTitle(): self
    {
        render("<p class='m-1 bg-green-800 text-white p-1'>GitHub Actions Watcher by Spatie</p>");

        return $this;
    }

    public function renderError(string $message): self
    {
        render("<p class='m-1 bg-red-800 text-white'>{$message}</p>");

        return $this;
    }



}
