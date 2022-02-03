<?php

namespace App\Support\GitHub\Enums;

use App\Support\GitHub\Enums\Concerns\HasHumanReadableValue;
use MyCLabs\Enum\Enum;

class RunConclusion extends Enum
{
    use HasHumanReadableValue;

    private const ActionRequired = 'action_required';
    private const Cancelled = 'cancelled';
    private const Failure = 'failure';
    private const Neutral = 'neutral';
    private const Success = 'success';
    private const Skipped = 'skipped';
    private const Stale = 'stale';
    private const TimedOut = 'timed_out';

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
