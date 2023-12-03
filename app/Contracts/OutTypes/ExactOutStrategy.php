<?php

namespace App\Contracts\OutTypes;

use App\Contracts\OutTypeStrategyInterface;

class ExactOutStrategy implements OutTypeStrategyInterface
{
    public function isValidOut(int $currentScore, bool $withDouble = null): bool
    {
        // In ExactOutStrategy, the last hit must make the score exactly zero
        // but does not need to be a double.
        return $currentScore === 0;
    }

    public function validateScore(int $currentScore, int $hitScore, bool $withDouble): bool
    {
        // Must finish exactly on 0, but doubles are not required
        return $currentScore - $hitScore >= 0;
    }

    public function getTitle(): string
    {
        return 'Out without double';
    }
}
