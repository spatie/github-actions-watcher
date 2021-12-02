<?php

namespace App\Support\GitHub\Enums;

enum RunStatus: string
{
    case queued = 'queued';
    case inProgress = 'in_progress';
    case completed = 'completed';

    public function color(): string
    {
        return match($this)
        {
            self::queued => 'bg-grey-100',
            self::inProgress => 'bg-orange-100',
            self::completed => 'bg-red-100',
        };
    }
}
