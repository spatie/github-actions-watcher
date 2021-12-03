<?php

namespace App\Support\GitHub\Enums;

use App\Support\GitHub\Enums\Concerns\HasHumanReadableValue;

enum RunStatus: string
{
    use HasHumanReadableValue;

    case Queued = 'queued';
    case InProgress = 'in_progress';
    case Completed = 'completed';

    public function color(): string
    {
        return match($this)
        {
            self::Queued => 'text-gray-400',
            self::InProgress => 'text-orange-400',
            self::Completed => 'text-red-400',
        };
    }
}
