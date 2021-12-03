<?php

namespace App\Exceptions;

use Exception;

class NotExecutingInLocalGitRepo extends Exception
{
    public static function make(): self
    {
        return new self("Make sure that you are executing this command in a git repo.");
    }
}
