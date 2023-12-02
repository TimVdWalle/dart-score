<?php

namespace App\Contracts\OutTypes;

use App\Contracts\OutTypeStrategyInterface;

class AnyOutStrategy implements OutTypeStrategyInterface
{
    public function isValidOut(int $currentScore, bool $withDouble = null): bool
    {
        // In this strategy, a player can win by reducing the score to zero or below.
        return $currentScore <= 0;
    }

    public function validateScore(int $currentScore, int $hitScore, bool $withDouble): bool
    {
        // Allow any score, since hitting zero or below is considered a win.
        return true;
    }

    public function getTitle(): string
    {
        return 'Simple out';
    }
}
