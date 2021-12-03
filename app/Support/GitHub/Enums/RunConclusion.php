<?php

namespace App\Support\GitHub\Enums;

enum RunConclusion: string
{
    case actionRequired = 'action_required';
    case cancelled = 'cancelled';
    case failure = 'failure';
    case neutral = 'neutral';
    case success = 'success';
    case skipped = 'skipped';
    case stale = 'stale';
    case timedOut = 'timed_out';

    public function color(): string
    {
        return match($this)
        {
            self::actionRequired => 'bg-orange-100',
            self::cancelled, self::skipped => 'bg-grey-100',
            self::failure, self::stale, self::timedOut => 'bg-red-100',
            self::neutral, self::success => 'bg-green-1OO',
        };
    }
}
