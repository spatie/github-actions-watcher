<?php

namespace App\Support\GitHub\Enums;

use App\Support\GitHub\Enums\Concerns\HasHumanReadableValue;
use MyCLabs\Enum\Enum;

class RunStatus extends Enum
{
    use HasHumanReadableValue;

    private const Queued = 'queued';
    private const InProgress = 'in_progress';
    private const Completed = 'completed';

    public function color(): string
    {
        return match($this->value)
        {
            self::Queued => 'text-gray-400',
            self::InProgress => 'text-orange-400',
            self::Completed => 'text-red-400',
        };
    }
}
