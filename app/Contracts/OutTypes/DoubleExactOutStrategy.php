<?php

namespace App\Contracts\OutTypes;

use App\Contracts\OutTypeStrategyInterface;

class DoubleExactOutStrategy implements OutTypeStrategyInterface
{
    public function isValidOut(int $currentScore, bool $withDouble = null): bool
    {
        // In DoubleExactOutStrategy, the last hit must make the score exactly zero
        // and it must be a double.
        return ($currentScore === 0) && $withDouble;
    }

    public function validateScore(int $currentScore, int $hitScore, bool $withDouble): bool {
        $newScore = $currentScore - $hitScore;
        // Must finish on double and not leave 1 point
        return !($newScore < 0 || $newScore === 1 || ($newScore === 0 && !$withDouble));
    }

    public function getTitle(): string
    {
        return 'Double Out';
    }
}
