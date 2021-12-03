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
        $path = storage_path('app/config.json');

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

    public function __get(string $name): string
    {
        return $this->valuestore->get($name);
    }

    public function flush(): self
    {
        $this->valuestore->flush();

        return $this;
    }
}
