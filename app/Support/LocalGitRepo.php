<?php

namespace App\Support;

use App\Exceptions\GitNotFound;
use App\Exceptions\NotAGitHubRemoteUrl;
use App\Exceptions\NotExecutingInLocalGitRepo;
use Illuminate\Support\Str;
use Symfony\Component\Process\ExecutableFinder;
use Symfony\Component\Process\Process;

class LocalGitRepo
{
    public function __construct(
        protected string $directory = __DIR__
    ) {}

    public function getVendorAndRepo(): string
    {
        $gitPath = $this->findGitBinaryPath();

        $gitUrl = $this->getConfiguredGitUrl($gitPath);

        return $this->extractVendorAndRepo($gitUrl);
    }

    public function getCurrentBranch(): string
    {
        $gitPath = $this->findGitBinaryPath();

        $command = "{$gitPath} rev-parse --abbrev-ref HEAD";

        $process = PRocess::fromShellCommandline($command, $this->directory);

        $process->run();

        if (!$process->isSuccessful()) {
            throw NotExecutingInLocalGitRepo::make();
        }

        return trim($process->getOutput());
    }

    protected function findGitBinaryPath(): string
    {
        $executableFinder = new ExecutableFinder();
        $gitPath = $executableFinder->find('git');

        if (!$gitPath) {
            throw GitNotFound::make($this->directory);
        }
        return $gitPath;
    }

    protected function getConfiguredGitUrl(string $gitPath): string
    {
        $command = "{$gitPath} config --get remote.origin.url";

        $process = PRocess::fromShellCommandline($command, $this->directory);

        $process->run();

        if (!$process->isSuccessful()) {
            throw NotExecutingInLocalGitRepo::make();
        }

        return trim($process->getOutput());
    }

    protected function extractVendorAndRepo(string $gitHubRemoteUrl): string
    {
        $start = 'git@github.com:';
        $end = '.git';

        if (! Str::startsWith($gitHubRemoteUrl, $start)) {
            throw NotAGitHubRemoteUrl::make($gitHubRemoteUrl);
        }

        if (! Str::endsWith($gitHubRemoteUrl, $end)) {
            throw NotAGitHubRemoteUrl::make($gitHubRemoteUrl);
        }

        return Str::between($gitHubRemoteUrl, $start, $end);
    }
}
