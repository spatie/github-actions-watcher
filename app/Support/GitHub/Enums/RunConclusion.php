<?php

namespace App\Support\GitHub\Enums;

use App\Support\GitHub\Enums\Concerns\HasHumanReadableValue;

enum RunConclusion: string
{
    use HasHumanReadableValue;

    case ActionRequired = 'action_required';
    case Cancelled = 'cancelled';
    case Failure = 'failure';
    case Neutral = 'neutral';
    case Success = 'success';
    case Skipped = 'skipped';
    case Stale = 'stale';
    case TimedOut = 'timed_out';

    public function color(): string
    {
        return match($this)
        {
            self::ActionRequired => 'text-orange-400',
            self::Cancelled, self::Skipped => 'text-gray-400',
            self::Failure, self::Stale, self::TimedOut => 'text-red-400',
            self::Neutral, self::Success => 'text-green-400',
        };
    }
}
