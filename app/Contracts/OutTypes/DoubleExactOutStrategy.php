<?php

namespace App\Contracts\OutTypes;

use App\Contracts\OutTypeStrategyInterface;

class DoubleExactOutStrategy implements OutTypeStrategyInterface
{
    public function isValidOut(int $currentScore, int $hitScore): bool
    {
        // In DoubleExactOutStrategy, the last hit must make the score exactly zero
        // and it must be a double.
        // Assuming a method `isDoubleHit` determines if the hit was a double.
        return ($currentScore - $hitScore === 0) && $this->isDoubleHit($hitScore);
    }

    public function validateScore(int $currentScore, int $hitScore, bool $withDouble): bool {
        $newScore = $currentScore - $hitScore;
        // Must finish on double and not leave 1 point
        return !($newScore < 0 || $newScore === 1 || ($newScore === 0 && !$withDouble));
    }

    private function isDoubleHit(int $hitScore): bool
    {
        // Implement logic to check if the hit was a double
        // For example, if hitScore is exactly twice of some segment score.

        return true;
    }

    public function getTitle(): string
    {
        return 'Double Out';
    }
}
