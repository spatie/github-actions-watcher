<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Client\Response;

class RateLimitExceeded extends Exception
{
    public static function make(Response $response): self
    {
        $exception = $response->toException();

        return new self("GitHub's rate limit has been exceeded. Try authentication using `actions-watcher login` to get a higher rating limit.", previous: $exception);
    }
}
