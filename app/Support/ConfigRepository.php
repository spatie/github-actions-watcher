<?php

namespace App\Support;

use Spatie\Valuestore\Valuestore;

/**
 * @property-read ?string $accessToken
 * @property-read ?string $gitHubUsername
 */
class ConfigRepository
{
    protected Valuestore $valuestore;

    public function __construct()
    {
        $path = "{$this->findHomeDirectory()}/.actions-watcher.json}";

        $this->valuestore = Valuestore::make($path);
    }

    public function setAccessToken(string $token): self
    {
        $this->valuestore->put('accessToken', $token);

        return $this;
    }

    public function setGitHubUsername(string $gitHubUsername): self
    {
        $this->valuestore->put('gitHubUsername', $gitHubUsername);

        return $this;
    }

    public function __get(string $name): ?string
    {
        return $this->valuestore->get($name);
    }

    public function flush(): self
    {
        $this->valuestore->flush();

        return $this;
    }

    protected function findHomeDirectory(): ?string
    {
        if (str_starts_with(PHP_OS, 'WIN')) {
            if (empty($_SERVER['HOMEDRIVE']) || empty($_SERVER['HOMEPATH'])) {
                return null;
            }

            $homeDirectory = $_SERVER['HOMEDRIVE'] . $_SERVER['HOMEPATH'];

            return rtrim($homeDirectory, DIRECTORY_SEPARATOR);
        }

        if ($homeDirectory = getenv('HOME')) {
            return rtrim($homeDirectory, DIRECTORY_SEPARATOR);
        }

        return null;
    }
}
