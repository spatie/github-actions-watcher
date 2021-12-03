<?php

namespace App\Support\GitHub\Enums;

enum RunStatus: string
{
    case Queued = 'queued';
    case InProgress = 'in_progress';
    case Completed = 'completed';

    public function color(): string
    {
        return match($this)
        {
            self::Queued => 'bg-grey-100',
            self::InProgress => 'bg-orange-100',
            self::Completed => 'bg-red-100',
        };
    }
}
