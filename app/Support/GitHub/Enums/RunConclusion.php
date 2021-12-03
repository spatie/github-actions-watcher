<?php

namespace App\Support\GitHub\Enums;

enum RunConclusion: string
{
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
            self::ActionRequired => 'bg-orange-100',
            self::Cancelled, self::Skipped => 'bg-grey-100',
            self::Failure, self::Stale, self::TimedOut => 'bg-red-100',
            self::Neutral, self::Success => 'bg-green-1OO',
        };
    }
}
