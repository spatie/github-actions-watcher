<?php

namespace App\Exceptions;

use Exception;

class NotExecutingInLocalGitRepo extends Exception
{
    public static function make(): self
    {
        return new static("Could not determine the GitHub URL. Make sure that you are executing this command in a git repo.");
    }
}
