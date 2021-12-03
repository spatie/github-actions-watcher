<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Client\Response;

class FailedGitHubResponse extends Exception
{
    public static function make(Response $response): self
    {
        /** @var Exception $exception */
        $exception = $response->toException();

        return new self("GitHub didn't response successfully. Response:  {$exception->getMessage()}", previous: $exception);
    }
}
