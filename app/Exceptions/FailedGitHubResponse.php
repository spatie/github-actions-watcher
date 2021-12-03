<?php

namespace App\Exceptions;

use Illuminate\Http\Client\Response;

class FailedGitHubResponse extends \Exception
{
    public static function make(Response $response): self
    {
        $exception = $response->toException();

        return new static("GitHub didn't response successfully. Response:  {$exception->getMessage()}", previous: $exception);
    }
}
