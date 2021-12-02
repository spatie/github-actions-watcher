<?php

namespace App\Commands;

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
        $this
            ->clearScreen()
            ->renderTitle();

        $localGitRepo = new LocalGitRepo(base_path());

        try {
            $vendorAndRepo = $localGitRepo->getVendorAndRepo();
        } catch (Exception $exception) {
            $this->renderError($exception->getMessage());

            return static::FAILURE;
        }

        $runs = $gitHub->getLatestWorkflowRuns($vendorAndRepo);

        foreach(range(1, 5) as $i) {
            $this
                ->clearScreen()
                ->renderTitle()
                ->renderError("This is pass {$i}");

            render(view('runs', compact('runs')));

            sleep(1);
        }

        return static::SUCCESS;
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
