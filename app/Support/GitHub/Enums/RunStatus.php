<?php

namespace App\Support\GitHub\Enums;

use App\Support\GitHub\Enums\Concerns\HasHumanReadableValue;
use MyCLabs\Enum\Enum;

class RunStatus extends Enum
{
    use HasHumanReadableValue;

    public const Queued = 'queued';
    public const InProgress = 'in_progress';
    public const Completed = 'completed';

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
