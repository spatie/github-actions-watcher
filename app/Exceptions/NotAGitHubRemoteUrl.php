<?php

namespace App\Exceptions;

use Exception;

class NotAGitHubRemoteUrl extends Exception
{
    public static function make(string $remoteUrl): self
    {
        return new static("It seems you are executing this in a git repo that was not cloned from GitHub. Detected remote URL: `{$remoteUrl}`");
    }
}
