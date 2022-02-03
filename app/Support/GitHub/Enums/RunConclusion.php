<?php

namespace App\Support\GitHub\Enums;

use App\Support\GitHub\Enums\Concerns\HasHumanReadableValue;
use MyCLabs\Enum\Enum;

class RunConclusion extends Enum
{
    use HasHumanReadableValue;

    public const ActionRequired = 'action_required';
    public const Cancelled = 'cancelled';
    public const Failure = 'failure';
    public const Neutral = 'neutral';
    public const Success = 'success';
    public const Skipped = 'skipped';
    public const Stale = 'stale';
    public const TimedOut = 'timed_out';

    public function color(): string
    {
        return match($this->value)
        {
            self::ActionRequired => 'text-orange-400',
            self::Cancelled, self::Skipped => 'text-gray-400',
            self::Failure, self::Stale, self::TimedOut => 'text-red-400',
            self::Neutral, self::Success => 'text-green-400',
        };
    }
}
