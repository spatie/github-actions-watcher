<?php

namespace App\Exceptions;

use Exception;

class GitNotFound extends Exception
{
    public static function make(): self
    {
        return new self("Could not find the `git` binary.");
    }
}
