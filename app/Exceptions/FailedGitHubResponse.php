<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Client\Response;

class FailedGitHubResponse extends Exception
{
    public static function make(Response $response, string $vendorRepo, string $branch): self
    {
        /** @var Exception $exception */
        $exception = $response->toException();

        return new self("GitHub didn't response successfully for vendor/repo `{$vendorRepo}` on branch `{$branch}`. Url: {$response->effectiveUri()} Response:  {$exception->getMessage()}", previous: $exception);
    }
}
